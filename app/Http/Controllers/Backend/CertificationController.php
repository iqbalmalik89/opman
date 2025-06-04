<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Services\CategoryService;
use App\Services\CertificationService;
use App\Http\Requests\CertificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use App\Library\ModuleConfig;

class CertificationController extends Controller
{
	public $service;
    public $module;
	function __construct(CertificationService $service, CategoryService $catService)
	{
		$this->service = $service;
        $this->category_service = $catService;
        $GLOBALS['module'] = 'certification';
	}


    public function show($catId)
    {
        return view('backend.'.$GLOBALS['module'] .'.listing', ['category_id' => $catId]);
    }

    public function add($catId)
    {
        $categories = $this->category_service->getAllCat();

        return view('backend.'.$GLOBALS['module'] .'.form', ['data' => '', 'categories' => $categories, "cat_id" => $catId]);
    }

    public function edit($id)
    {
        $rec = $this->service->get('id', $id, true);
        $categories = $this->category_service->getAllCat();
        if (!empty($rec)) {
            $data = ['data' => $rec, 'categories' => $categories, 'cat_id' => $rec->category_id];
            return view('backend.'.$GLOBALS['module'] .'.form', $data); 
        } else {
            abort(404);
        }      
    }



    public function save(CertificationRequest $request)
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

    public function update(CertificationRequest $request, $id)
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



}
