<?php

namespace App\Services;

use Illuminate\Foundation\Http\Kernel as HttpKernel;
use App\Models\ProjectSchedule;
use App\Models\TeamTask;
use App\Models\TaskSuboperative;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\Models\SuboperativeDocument;
use Carbon\Carbon;
use Illuminate\Support\Facades\File; 

use App\Library\Utility;

class SuboperativeService
{
    public $model;
    function __construct()
    {
        $this->model = '\\App\\Models\\Suboperative';
    }

    public function get($col, $value, $detail = false)
    {
        $rec =  $this->model::where($col, $value)->first();
        return $rec;
    }

    public function getAllSuboperatives()
    {
        $rec =  $this->model::get(['id', 'first_name', 'last_name']);
        return $rec;
    }
    
    public function delete($id)
    {
        $data = $this->model::find($id);
        if(!empty($data))
        {
            $data->delete();
            
            

            return $data;
        }
        else
        {
            return false;
        }
    }

    public function getAll($request)
    {
        $input = $request->all();

        $records = $this->model::where('subcontractor_id', $request->subcontractor_id);


        if(!empty($input['search']['value']))
        {
            $records = $records->where('first_name', 'LIKE', '%'.$input['search']['value'].'%')->orWhere('last_name', 'LIKE', '%'.$input['search']['value'].'%'); 

        }

        if(isset($input['start']) && isset($input['length']))
        {
            if(empty($input['start']))
                $page = 1;
            else
                $page = ($input['start'] / $input['length']) + 1;

            Paginator::currentPageResolver(function () use ($page) {
                return $page;
            });



            $records = $records->paginate($input['length']);            
        }
        else
        {
            return $records->get();
        }


        return $records;
    }

    public function addUpdateSuboperative($request)
    {
        if(empty($request->id))
        {
            $rec = new $this->model;
        }
        else
        {
            $rec = $this->get('id', $request->id);
        }


        $rec = $this->setter($rec, $request);

        if(empty($request->id))
        {
            $rec->save();

            //do sync of rid
            $this->docSync($request->rid, $rec->id);
        }
        else
        {
            $rec->update();
        }


        // $rec->save();
        // $this->docSync($request->rid, $rec->id);
        return $rec;
    }

    public function docSync($rid, $id)
    {
        // change db
        SuboperativeDocument::where('suboperative_id', $rid)->update(['suboperative_id' => $id]);

        //rename folder name
        File::moveDirectory(storage_path('app/public/suboperative-documents/' . $rid), storage_path('app/public/suboperative-documents/' . $id));


    }


    public function update($request, $id)
    {
        $rec = $this->model::find($id);
        $rec = $this->setter($rec, $request);
        $rec->update();
        return $rec;
    }

    public function setter($rec, $request)
    {
       $documentService = new SuboperativeDocumentService;
       $mediaService = new MediaService;
       $rec->subcontractor_id = $request->subcontractor_id;
       $rec->added_by = $request->user_id;
       $rec->first_name = $request->first_name;
       $rec->last_name = $request->last_name;
       $rec->mobile = $request->mobile;
       $rec->email = $request->email;

       $photoPath = $mediaService->upload('photo', $request);

        if(!empty($photoPath['new']))
        {
            $destination = 'suboperative-pics/'.$photoPath['new'];
            $mediaService->moveFile($mediaService->tmp.$photoPath['new'], $destination);
            $dbPhotoPath = $photoPath['new'];
        }
        else
        {
            $dbPhotoPath = $request->photo_path;            
        }

        $rec->photo_path = $dbPhotoPath;


        return $rec;
    }

    public function deleteSuboperatives($teamId)
    {
        $teamService = new TeamService;

        // remove suboperatives
        $suboperatives = $this->model::where('team_id', $teamId)->delete();
        $team = $teamService->get('id', $teamId);

        if(!empty($team))
        {
            $team->task = null;
            $team->start_date = null;
            $team->end_date = null;
            $team->project_id = null;
            $team->update();
        }

        return true;

    }

    public function getSubops($projectId = 0)
    {
        $records = new TeamTask();

        if(!empty($projectId))
            $records->where('project_id', $projectId);

        $records = $records->get();

        $activeSubop = [];
        $inactiveSubop = [];
        foreach($records as $record)
        {
            if(date('Y-m-d') >= $record->start_date  && date('Y-m-d') <= $record->end_date)
            {
                $subops = TaskSuboperative::where('task_id', $record->id)->get();
                foreach($subops as $subop)
                {
                    $activeSubop[$subop->suboperative_id] = $subop->suboperative->first_name.' '.$subop->suboperative->last_name;
                }
            }
            else
            {
                $subops = TaskSuboperative::where('task_id', $record->id)->get();
                foreach($subops as $subop)
                {
                    if(!isset($activeSubop[$subop->suboperative_id]))
                        $inactiveSubop[$subop->suboperative_id] = $subop->suboperative->first_name.' '.$subop->suboperative->last_name;
                }
            }
        }

        return ['active' => $activeSubop, 'inactive' => $inactiveSubop];
    }


    public function suboperativeStatusChangeCron()
    {
        $resp = $this->getSubops(0);
        $this->model::whereIn('id', array_keys($resp['inactive']))->update(['status' => 'Inactive']);
        $this->model::whereIn('id', array_keys($resp['active']))->update(['status' => 'Active']);


    }


}
