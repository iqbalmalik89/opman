<?php

namespace App\Services;

use Illuminate\Foundation\Http\Kernel as HttpKernel;
use App\Models\ProjectSchedule;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;
use App\Library\Utility;

class TeamService
{
    public $model;
    function __construct()
    {
        $this->model = '\\App\\Models\\Team';
    }

    public function get($col, $value, $detail = false)
    {
        $rec =  $this->model::where($col, $value)->first();
        return $rec;
    }


    public function getAllTeams($subcontractorId)
    {
        $rec =  $this->model::where('subcontractor_id', $subcontractorId)->get();
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

        $records = $this->model::withCount('tasks')->where('subcontractor_id', $request->subcontractor_id);


        if(!empty($input['search']['value']))
        {
            $records = $records->where('team', 'LIKE', '%'.$input['search']['value'].'%'); 
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

    public function save($request)
    {
        $rec = new $this->model;
        $rec = $this->setter($rec, $request);
        $rec->save();
        return $rec;
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

        if(isset($request->subcontractor_id))
            $rec->subcontractor_id = $request->subcontractor_id;
    
        if(isset($request->team))
            $rec->team = $request->team;
    
        if(isset($request->project_id))
            $rec->project_id = $request->project_id;

        if(isset($request->task))
            $rec->task = $request->task;


        if(!empty($request->timeline))
        {
            list($startDate, $endDate) = explode(' - ', $request->timeline);
            $rec->start_date = date('Y-m-d', strtotime(str_replace('/', '-', $startDate)));
            $rec->end_date = date('Y-m-d', strtotime(str_replace('/', '-', $endDate)));
        }
        elseif(empty($request->timeline) && !empty($request->task))
        {
            $rec->start_date = null;
            $rec->end_date = null;            
        }


        return $rec;
    }


}
