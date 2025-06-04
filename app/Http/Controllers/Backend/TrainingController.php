<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Services\TrainingService;
use Illuminate\Http\Request;
use App\Http\Requests\TrainingRequest;
use App\Services\CategoryService;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use App\Library\ModuleConfig;

class TrainingController extends Controller
{
	public $service;
    public $module;
	function __construct(TrainingService $service)
	{
		$this->service = $service;
        $GLOBALS['module'] = 'training';
	}



    public function search()
    {
        return view('backend.'.$GLOBALS['module'] .'.search', ['data' => '', 'categories' => [], ]);
    }
    
    public function show()
    {

        $catService = new CategoryService;
        $categories = $catService->getAllCat();

        $active = $this->service->getCount('Active');
        $pending = $this->service->getCount('Pending');
        return view('backend.'.$GLOBALS['module'] .'.listing', ['categories' => $categories, 'active' => $active, 'pending' => $pending]);
    }


    public function pdf($id)
    {
        $rec = $this->service->pdf($id);

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



    public function save(TrainingRequest $request)
    {
        if(empty($request->training_id))
            $response = $this->service->save($request);
        else
            $response = $this->service->update($request);


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


    public function changeTrainingStatus(Request $request)
    {
        $training = $this->service->changeTrainingStatus($request->id, $request->status);

        if($training)
        {
            return response()->json([
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

    public function get($id)
    {
        $training = $this->service->get('id', $id, true);

        if($training)
        {
            return response()->json([
                'data' => $training,
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
