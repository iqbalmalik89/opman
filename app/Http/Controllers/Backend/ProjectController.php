<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Services\ProjectService;
use App\Services\SiteService;
use App\Services\ClientService;
use App\Services\TeamService;
use App\Services\CategoryService;
use App\Http\Requests\ProjectRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use App\Library\ModuleConfig;
use App\Library\S3;
use Illuminate\Support\Facades\Redirect;


class ProjectController extends Controller
{
	public $service;
    public $module;
	function __construct(ProjectService $service)
	{
		$this->service = $service;
        $GLOBALS['module'] = 'project';
	}


    public function showArchive()
    {
        return view('backend.'.$GLOBALS['module'] .'.listing', ['status' => 'Archived']);
    }

    public function show()
    {
        return view('backend.'.$GLOBALS['module'] .'.listing', []);
    }

    
    public function projectDownload($id)
    {
        $client = new S3();
        $archive = $this->service->projectDownload($id, 'people');

        header("Content-type: application/zip"); 
        header("Content-Disposition: attachment; filename=".basename($archive));
        header("Content-length: " . filesize(storage_path('/'.$archive)));
        header("Pragma: no-cache"); 
        header("Expires: 0"); 
        readfile(storage_path('/'.$archive));

        unlink(storage_path('/'.$archive));

        // if(!empty($archive))
        //     unlink(storage_path('/'.$archive));

        // $source = 's3://' . env('AWS_BUCKET').'/' .\Storage::path('/') .  basename($archive);

        // $manager = new \Aws\S3\Transfer($client, $source, storage_path('zip/'.basename($archive)));
        // $manager->transfer();

        // $client->downloadBucket(storage_path('zip/'.basename($archive)), env('AWS_BUCKET'), $archive);







        // p($archive);
        // $command = $client->getCommand('GetObject', array(
        //    'Bucket' => env('AWS_BUCKET'),
        //    'Key'    => $archive,  
        //    'ResponseContentDisposition' => 'attachment; filename="'.basename($archive).'"'
        // ));

        // $signedUrl = $command->createPresignedUrl('+15 minutes');
        // p($signedUrl);
        // return Redirect::to($signedUrl);
        // return Redirect::to(asset('zip/'. basename($archive)));


    }

    public function add()
    {
        $siteService = new SiteService;
        $clientService = new ClientService;

        $sites = $siteService->getAllSites();
        $clients = $clientService->getAllClients();

        return view('backend.'.$GLOBALS['module'] .'.form', ['data' => [], 'sites' => $sites, 'clients' => $clients]);
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
        $siteService = new SiteService;
        $clientService = new ClientService;
        $sites = $siteService->getAllSites();


        $clients = $clientService->getAllClients();

        
        $rec = $this->service->get('id', $id, true);
        if (!empty($rec)) {
            $data = ['data' => $rec, 'sites' => $sites, 'clients' => $clients];
            return view('backend.'.$GLOBALS['module'] .'.form', $data); 
        } else {
            abort(404);
        }      
    }


    public function projectStatusChange(ProjectRequest $request)
    {
        $response = $this->service->projectStatusChange($request->id, $request->status);

        if($response)
        {
            return response()->json([
                'status' => 'success',
                'code' => 200,
                'message' => ModuleConfig::getModuleConfig($GLOBALS['module'])['module_name'].' status changed successfully'
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



    public function addUpdateSuboperative(ProjectRequest $request)
    {
        $request->merge(['user_id' => Auth::user()['id']]);
        $response = $this->service->addUpdateSuboperative($request);

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

    public function update(ProjectRequest $request, $id)
    {
        $request->merge(['user_id' => Auth::user()['id']]);
        $response = $this->service->update($request, $id);

        if($response)
        {
            $request->session()->flash('message', 'Project updated successfully');

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

    public function assign(ProjectRequest $request)
    {
        if(empty($request->assign_id))
            $response = $this->service->assign($request);
        else
            $response = $this->service->updateAssign($request);

        if($response === 'overlapped')
        {
            return response()->json([
                'status' => 'error',
                'code' => 200,
                'message' => 'User already assigned to between these dates',
            ], 200);

        }
        elseif($response)
        {
            return response()->json([
                'status' => 'success',
                'code' => 200,
                'message' => 'User has been assigned successfully',
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

    public function save(ProjectRequest $request)
    {
        $response = $this->service->save($request);

        if($response)
        {
            $request->session()->flash('message', 'Project saved successfully');

            return response()->json([
                'status' => 'success',
                'code' => 200,
                'message' => ModuleConfig::getModuleConfig($GLOBALS['module'])['module_name']. ' has been saved successfully',
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


    public function getAssignment($id)
    {

        $response = $this->service->getAssignment('id', $id);

        if($response)
        {
            return response()->json([
                'data' => $response,
                'status' => 'success',
                'code' => 200,
                'message' => 'Assignment has been fetched',
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


    public function deleteAssignment($id)
    {
        $response = $this->service->deleteAssignment($id);

        if($response)
        {
            return response()->json([
                'status' => 'success',
                'code' => 200,
                'message' => 'Assignment has been deleted successfully',
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

    function get($projectId)
    {
        $project = $this->service->get('id', $projectId, true);

        $subcontractors = $this->service->getProjectSubcontractors($projectId);

        // foreach($subcontractors as $subcontractor)
        // {
        //     foreach ($subcontractor->teams as $key => $team) 
        //     {
        //         p($team->tasks->count());
        //     }
        // }

        $html = view('backend.'.$GLOBALS['module'] .'.project', compact('project', 'subcontractors'))->render();

        if($html)
        {
            return response()->json([
                'status' => 'success',
                'html'=> $html,
                'code' => 200,
                'message' => 'Project fetched'
            ], 200);
        }
        else
        {
            return response()->json([
                'status' => 'error',
                'message' => 'error occurred'
            ], 400);
        }               
    }

    function getAll(Request $request)
    {
        $allprojects = $this->service->getAllProjectsByStatus($request);

        $html = view('backend.'.$GLOBALS['module'] .'.projects', compact('allprojects'))->render();


        if($html)
        {
            return response()->json([
                'status' => 'success',
                'html'=> $html,
                'code' => 200,
                'message' => 'Projects fetched'
            ], 200);
        }
        else
        {
            return response()->json([
                'status' => 'error',
                'message' => 'error occurred'
            ], 400);
        }               
    }



    // public function getAll(Request $request)
    // {
    //     $response = $this->service->getAll($request);

    //     if($response)
    //     {
    //         if(isset($request->start) && isset($request->length))
    //         {
    //             return response()->json([
    //                 'recordsTotal' => $response->total(),
    //                 'recordsFiltered' => $response->total(),
    //                 'data' => $response->items(),
    //                 'status' => 'success',
    //                 'code' => 200,
    //                 'message' => ModuleConfig::getModuleConfig($GLOBALS['module'])['plural'].' fetched successfully'
    //             ], 200);                
    //         }
    //         else
    //         {
    //         return response()->json([
    //             'data' => $response,
    //             'status' => 'success',
    //             'code' => 200,
    //             'message' => ModuleConfig::getModuleConfig($GLOBALS['module'])['plural'].' fetched successfully'
    //         ], 200);                
    //         }


    //     }
    //     else
    //     {
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'Some error occurred',
    //         ], 200);
    //     }
    // }


}
