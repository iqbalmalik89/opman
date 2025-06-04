<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Services\SubcontractorService;
use App\Services\TeamService;
use App\Services\ProjectService;
use App\Services\SuboperativeService;
use Illuminate\Http\Request;
use App\Http\Requests\SubcontractorRequest;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use App\Library\ModuleConfig;

class SubcontractorController extends Controller
{
	public $service;
    public $module;
	function __construct(SubcontractorService $service)
	{
		$this->service = $service;
        $GLOBALS['module'] = 'subcontractor';
	}



    public function search(SubcontractorRequest $request)
    {

        return view('backend.'.$GLOBALS['module'] .'.search', ['data' => '', 'categories' => [], 'subcontractor_id' => $request->subcontractor_id]);
    }
        public function show()
    {
        return view('backend.'.$GLOBALS['module'] .'.listing');
    }

    public function add(Request $request)
    {
        return view('backend.'.$GLOBALS['module'] .'.form', ['data' => '']);       
    }

    public function edit($id)
    {
        $rec = $this->service->get('id', $id, true);
        $contacts = $this->service->getContacts($id);

        if (!empty($rec)) {
            $data = ['data' => $rec, 'contacts' => $contacts];
            return view('backend.'.$GLOBALS['module'] .'.form', $data); 
        } else {
            abort(404);
        }      
    }

    public function view($id)
    {
        $rec = $this->service->get('id', $id, true);
        $contacts = $this->service->getContacts($id);

        if (!empty($rec)) {
            $data = ['data' => $rec, 'contacts' => $contacts];
            return view('backend.'.$GLOBALS['module'] .'.form', $data); 
        } else {
            abort(404);
        }      
    }


    public function save(SubcontractorRequest $request)
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


    public function getSubcontractorTeams($subcontractorId)
    {
        $teams = $this->service->getSubcontractorTeams($subcontractorId);

        return response()->json([
            'html' => view('backend.suboperative.teams', compact('teams'))->render()
        ]);        

    }


    public function manageSubcontractorTeams($subcontractorId)
    {
        $teamService = new TeamService;
        $projectService = new ProjectService;

        $teams = $teamService->getAllTeams($subcontractorId);
        $projects = $projectService->getAllProjects();

        return response()->json([
            'html' => view('backend.suboperative.manage-teams', compact('teams', 'projects'))->render()
        ]);        

    }


    public function update(SubcontractorRequest $request, $id)
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
                'message' => 'Record.'.$s.' has been deleted successfully',
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
            if(!empty($request->nopage))
            {
                return response()->json([
                    'data' => $response,
                    'status' => 'success',
                    'code' => 200,
                    'message' => ModuleConfig::getModuleConfig($GLOBALS['module'])['plural'].' fetched successfully'
                ], 200);
            }
            else
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
        $suboperativeService = new SuboperativeService();
        $teamService = new TeamService;

        $teams = $teamService->getAllTeams($id);


        $data = $this->service->get('id', $id);
        $contacts = $this->service->getContacts($id);

        $request = new SubcontractorRequest([
            'subcontractor_id'   => $id,
        ]);

        $suboperatives = $suboperativeService->getAll($request);


        $html = view('backend.'.$GLOBALS['module'] .'.subcontractor-detail', compact('data', 'contacts', 'suboperatives', 'teams'))->render();

        if($html)
        {
            return response()->json([
                'html' => $html,
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



}
