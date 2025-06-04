<?php

namespace App\Services;

use Illuminate\Foundation\Http\Kernel as HttpKernel;
use App\Models\Training;
use App\Models\Document;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;
use App\Library\Utility;

class TrainingService
{
    public $model;
    function __construct()
    {
        $this->model = '\\App\\Models\\Training';
    }

    public function getCount($status)
    {
        return $this->model::where('status', $status)->count();
    }

    public function trainingsStatusChange()
    {
        $trainings = Training::where('course_date', '<=', today()->subDays(14))->where('status', '=', 'Active')->get();

        foreach ($trainings as $key => $training) 
        {
            $this->changeTrainingStatus($training->id, 'Abandoned');
        }
    }

    function pdf($id)
    {
        $data = $this->get('id', $id);
        $mpdf = new \Mpdf\Mpdf(['tempDir' => storage_path('app/tmp/'), 'setAutoTopMargin' => 'stretch',        'autoMarginPadding' => 0,'margin_header' => 5, 'margin_footer' => 0,'margin_top' => 0,]);        

        $html = view('backend.training.pdf', compact('data'))->render();

        $mpdf->WriteHTML($html);
        $mpdf->Output($data->people->first_name.'-Training'. '.pdf', 'D');
    }

    public function getTrainingsByStatus($status)
    {
        // return Training::with('people', 'skill')->where('course_date', '>=', now()->subDays(7))->get();
        return Training::with('people', 'skill')->where('status', '=', $status)->get();
    }

    public function get($col, $value, $detail = false)
    {
        if($detail)
        {
            $rec =  $this->model::where($col, $value)->with('people', 'skill')->first();
//            $rec->skills = $rec->people->skills;            
        }
        else
            $rec =  $this->model::where($col, $value)->first();

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

    public function changeTrainingStatus($id, $status)
    {
        $data = $this->model::find($id);
        $data->status = $status;
        $data->update();
        return $data;
    }

    public function getAll($request)
    {
        $input = $request->all();

        $records = $this->model::with('people', 'skill', 'doc');

        $records = $this->model::with('people', 'skill', 'doc')->where('status', $request->status);

        if(!empty($input['search']['value']))
            $searchTerm = $input['search']['value'];

        if(!empty($input['search_term']))
            $searchTerm = $input['search_term'];

        if(!empty($searchTerm))
        {
            $records = $records->where('course_provider', 'LIKE', '%'.$searchTerm.'%'); 
        }


        $records = $records->orderBy('course_date', 'ASC');

        if(empty($input['nopage']))
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
            $records = $records->get();

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

    public function update($request)
    {
        $rec = $this->model::find($request->training_id);
        $rec = $this->setter($rec, $request);
        $rec->update();

        return $rec;
    }

    public function getDocId($peopleId, $docClass)
    {
        return Document::where('people_id', $peopleId)->where('doc_class', $docClass)->first();
    }

    public function setter($rec, $request)
    {
        if(!empty($request->people_id))
            $rec->people_id = $request->people_id;
        
        $doc = $this->getDocId($request->people_id, $request->doc_class);
        if(!empty($doc))
            $rec->doc_id = $doc->id;            
        else
            $rec->doc_id = Null;

        $rec->doc_class = $request->doc_class;
        $rec->course_provider = $request->course_provider;
        $rec->course_date = date('Y-m-d', strtotime(str_replace('/', '-', $request->course_date)));
        $rec->course_location = $request->course_location;
        return $rec;
    }


}
