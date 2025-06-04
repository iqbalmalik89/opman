<?php

namespace App\Services;

use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\Models\TaskSuboperative;
use Carbon\Carbon;
use App\Library\Utility;


class TeamTaskService
{
    public $model;
    function __construct()
    {
        $this->model = '\\App\\Models\\TeamTask';
    }

    public function deleteTaskSuboperative($id)
    {
        TaskSuboperative::where('id', $id)->delete();
        return true;
    }

    public function get($col, $val)
    {
        return $this->model::where($col, $val)->first();
    }

    public function getTaskSubops($taskId)
    {
        return TaskSuboperative::with('suboperative', 'document', 'document.skill')->where('task_id', $taskId)->get();
    }


  public function save($request)
    {
        $rec = new $this->model;
        $rec = $this->setter($rec, $request);
        $rec->save();

        $this->addTaskSubop($rec->id, $request);
        return $rec;
    }

    public function addTaskSubop($taskId, $request)
    {        
        $this->deleteTaskSubop($taskId);

        foreach ($request->suboperative as $key => $subopId) 
        {
            $docId = $request->skill[$key];
            $rec = new TaskSuboperative;
            $rec->task_id = $taskId;
            $rec->suboperative_id = $subopId;
            $rec->doc_id = $docId;
            $rec->save();
        }

    }

    public function delete($id)
    {
        $this->model::where('id', $id)->delete();
        TaskSuboperative::where('task_id', $id)->delete();
    }

    public function getAll($request)
    {
        $input = $request->all();

        $records = $this->model::with('project', 'suboperatives')->where('team_id', $request->team_id);

        if(!empty($input['search']['value']))
        {
            $records = $records->where('name', 'LIKE', '%'.$input['search']['value'].'%'); 
        }

        if(empty($input['start']))
            $page = 1;
        else
            $page = ($input['start'] / $input['length']) + 1;

        Paginator::currentPageResolver(function () use ($page) {
            return $page;
        });



        $records = $records->paginate($input['length']);


        // foreach($records as $record)
        // {

        //     foreach ($record->suboperatives as $key => $subop) 
        //     {
        //         $subop->suboperative;
        //         $subop->document->skill;

        //     }

        // }

        return $records;
    }

    public function update($request, $id)
    {
        $this->addTaskSubop($id, $request);

        $rec = $this->model::find($id);
        $rec = $this->setter($rec, $request);
        $rec->update();
        return $rec;
    }

    public function deleteTaskSubop($taskId)
    {
        TaskSuboperative::where('task_id', $taskId)->delete();
    }

    public function setter($rec, $request)
    {


        list($startDate, $endDate) = explode(' - ', $request->start_end);

        $rec->subcontractor_id = $request->subcontractor_id;
        $rec->project_id = $request->project_id;
        $rec->team_id = $request->team_id;
        $rec->task = $request->task;
        $rec->start_date = date('Y-m-d', strtotime(str_replace('/', '-', $startDate)));
        $rec->end_date = date('Y-m-d', strtotime(str_replace('/', '-', $endDate)));


        return $rec;
    }



}
