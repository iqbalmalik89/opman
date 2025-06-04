<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Services\SubcontractorService;
use App\Services\SuboperativeService;
use App\Services\TeamService;
use App\Services\ProjectService;
use App\Services\CategoryService;
use App\Http\Requests\SuboperativeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use App\Library\ModuleConfig;
use Illuminate\Support\Facades\Redirect;


class SuboperativeController extends Controller
{
	public $service;
    public $module;
	function __construct(SuboperativeService $service, SubcontractorService $subcontractorService)
	{
		$this->service = $service;
        $this->subcontractor_service = $subcontractorService;
        $this->catService = new CategoryService;
        $GLOBALS['module'] = 'suboperative';
	}



    public function show($catId)
    {
        return view('backend.'.$GLOBALS['module'] .'.listing', ['subcontractor_id' => $catId]);
    }

    public function add($subcontractorId)
    {
        $teamService = new TeamService;
        $subcontractors = $this->subcontractor_service->getAllSubcontractors();


        $categories = $this->catService->getAllCat();

        return view('backend.'.$GLOBALS['module'] .'.form', ['people' => new \StdClass, 'data' => [], 'categories' => $categories, 'subcontractor_id' => $subcontractorId]);
    }

    public function addSuboperative()
    {
        $teamService = new TeamService;
        $subcontractors = $this->subcontractor_service->getAllSubcontractors();
        $categories = $this->catService->getAllCat();

        return view('backend.'.$GLOBALS['module'] .'.form', ['people' => new \StdClass, 'data' => [], 'categories' => $categories, 'subcontractors' => $subcontractors]);
    }




    public function edit($id)
    {
        $teamService = new TeamService;
        $categories = $this->catService->getAllCat();

        $rec = $this->service->get('id', $id, true);
        $subcontractors = $this->subcontractor_service->getAllSubcontractors();


        $subcontractors = $this->subcontractor_service->getAllSubcontractors();
        if (!empty($rec)) {
            $data = ['data' => $rec, 'categories' => $categories, 'subcontractors' => $subcontractors];
            return view('backend.'.$GLOBALS['module'] .'.form', $data); 
        } else {
            abort(404);
        }      
    }



    public function addUpdateSuboperative(SuboperativeRequest $request)
    {
        $request->merge(['user_id' => Auth::user()['id']]);
        $response = $this->service->addUpdateSuboperative($request);
        $request->session()->flash('msg', 'Data saved successfully.');


        if($response)
        {
            return response()->json([
                'id' => $response->id,
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

    public function update(SuboperativeRequest $request, $id)
    {
        $request->merge(['user_id' => Auth::user()['id']]);
        $response = $this->service->update($request, $id);
        $request->session()->flash('msg', 'Data updated successfully.');

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
                'message' => 'Record'.$s.' has been deleted successfully',
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

    public function getAll(Request $request)
    {
        $response = $this->service->getAll($request);

        if($response)
        {
            if(isset($request->start) && isset($request->length))
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
                'data' => $response,
                'status' => 'success',
                'code' => 200,
                'message' => ModuleConfig::getModuleConfig($GLOBALS['module'])['plural'].' fetched successfully'
            ], 200);                
            }


        }
        else
        {
            return response()->json([
                'status' => 'error',
                'message' => 'Some error occurred',
            ], 200);
        }
    }


    public function deleteSuboperatives($teamId)
    {
        $response = $this->service->deleteSuboperatives($teamId);

        if($response)
        {
            return response()->json([
                'data' => $response,
                'status' => 'success',
                'code' => 200,
                'message' => ModuleConfig::getModuleConfig($GLOBALS['module'])['module_name']. ' suboperatives deleted successfully'
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


    public function get($id)
    {
        $response = $this->service->get('id', $id);

        if($response)
        {
            return response()->json([
                'data' => $response,
                'status' => 'success',
                'code' => 200,
                'message' => ModuleConfig::getModuleConfig($GLOBALS['module'])['module_name']. ' fetched successfully'
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


    public function downloadSubop($projectId)
    {

        $projectService = new ProjectService;
        $archive = $projectService->projectDownload($projectId, 'subops');

        header("Content-type: application/zip"); 
        header("Content-Disposition: attachment; filename=".basename($archive));
        header("Content-length: " . filesize(storage_path('/'.$archive)));
        header("Pragma: no-cache"); 
        header("Expires: 0"); 
        readfile(storage_path('/'.$archive));
        unlink(storage_path('/'.$archive));
        // return Redirect::to(asset('zip/'. basename($archive)));
    }

}
