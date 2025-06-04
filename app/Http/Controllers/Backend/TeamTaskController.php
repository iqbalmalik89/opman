<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Services\TeamTaskService;
use App\Services\SuboperativeService;
use App\Services\SubcontractorService;
use App\Services\ProjectService;
use App\Http\Requests\TeamTaskRequest;;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use App\Library\ModuleConfig;
use App\Http\Requests\SubcontractorRequest;

class TeamTaskController extends Controller
{
	public $service;
    public $module;
	function __construct(TeamTaskService $service, SubcontractorService $subcontractorService)
	{
		$this->service = $service;
        $this->subcontractor_service = $subcontractorService;

        $GLOBALS['module'] = 'teamtask';
	}


    // public function show()
    // {
    //     return view('backend.'.$GLOBALS['module'] .'.listing');
    // }

    // public function add()
    // {
    //     return view('backend.'.$GLOBALS['module'] .'.form', ['data' => '']);
    // }

    // public function edit($id)
    // {
    //     $rec = $this->service->get('id', $id, true);

    //     if (!empty($rec)) {
    //         $data = ['data' => $rec];
    //         return view('backend.'.$GLOBALS['module'] .'.form', $data); 
    //     } else {
    //         abort(404);
    //     }      
    // }


   
    public function getAll(Request $request)
    {
        $response = $this->service->getAll($request);
        //p($response);
        if($response)
        {
            return response()->json([
                'recordsTotal' => $response->total(),
                'recordsFiltered' => $response->total(),
                'data' => $response->items(),
                'status' => 'success',
                'code' => 200,
                'message' => ModuleConfig::getModuleConfig($GLOBALS['module'])['plural'].' fetched successfully'
            ], 200);
        }
        else
        {
            return response()->json([
                'status' => 'error',
                'message' => 'Some error occurred',
            ], 200);
        }
    }


    public function save(TeamTaskRequest $request)
    {
        $response = $this->service->save($request);

        if($response)
        {
            return response()->json([
                'status' => 'success',
                'code' => 200,
                'message' => ModuleConfig::getModuleConfig($GLOBALS['module'])['module_name'].' added successfully'
            ], 200);
        }
        else
        {
            return response()->json([
                'status' => 'error',
                'message' => 'Some error Occurred',
            ], 200);
        }
    }

    public function update(TeamTaskRequest $request, $id)
    {
        $response = $this->service->update($request, $id);

        if($response)
        {
            return response()->json([
                'status' => 'success',
                'code' => 200,
                'message' => ModuleConfig::getModuleConfig($GLOBALS['module'])['module_name']. ' has been updated successfully',
            ], 200);
        }
        else
        {
            return response()->json([
                'status' => 'error',
                'message' => 'Some error occurred',
            ], 200);
        }
    }

    public function delete(Request $request)
    {
        $s = '';
        if(is_array($request->id) && !empty($request->id))
        {
            $s = 's';
            foreach($request->id as $id)
            {
                $response = $this->service->delete($id);
            }
        }
        else
        {
                $response = $this->service->delete($request->id);                
        }

        if($response)
        {
            return response()->json([
                'status' => 'success',
                'code' => 200,
                'message' => 'Record has been deleted successfully',
            ], 200);
        }
    }

    // public function getAll(Request $request)
    // {
    //     $response = $this->service->getAll($request);
    //     //p($response);
    //     if($response)
    //     {
    //         return response()->json([
    //             'recordsTotal' => $response->total(),
    //             'recordsFiltered' => $response->total(),
    //             'data' => $response->items(),
    //             'status' => 'success',
    //             'code' => 200,
    //             'message' => ModuleConfig::getModuleConfig($GLOBALS['module'])['plural'].' fetched successfully'
    //         ], 200);
    //     }
    //     else
    //     {
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'Some error occurred',
    //         ], 200);
    //     }
    // }
    public function viewTeams(TeamTaskRequest $request)
    {
        $subcontractors = $this->subcontractor_service->getAllSubcontractors();

        return view('backend.'.$GLOBALS['module'] .'.teams', ['data' => '', 'subcontractor_id' => $request->subcontractor_id, 'subcontractors' => $subcontractors]);
    }

    public function getTaskSubops($id)
    {
        $task = $this->service->getTaskSubops($id);
        
        return response()->json([
                'subops' => $task,
                'status' => 'success',
                'code' => 200,
                'message' => 'Subops fetched successfully',
            ], 200);
    }

    public function deleteTaskSubop($id)
    {
        $task = $this->service->deleteTaskSuboperative($id);

        return response()->json([
                'status' => 'success',
                'code' => 200,
                'message' => 'suboperative removed successfully',
            ], 200);
    }

    public function get(TeamTaskRequest $request)
    {
        $projectService = new ProjectService;
        $suboperativeService = new SuboperativeService;


        $request = new SubcontractorRequest([
            'subcontractor_id'   => $request->subcontractor_id,
        ]);

        $suboperatives = $suboperativeService->getAll($request);


        // $suboperatives = $suboperativeService->getAllSuboperatives();


        $projects = $projectService->getAllProjects();

        $task = new \stdClass;;
        $taskSubops = new \stdClass;
        if(!empty($request->id))
        {
            $task = $this->service->get('id', $request->id);
            $taskSubops = $this->service->getTaskSubops($request->id);
        }

        return response()->json([
            'html' => view('backend.teamtask.form', compact('projects', 'suboperatives', 'task', 'taskSubops'))->render()
        ]);        

    }



}
