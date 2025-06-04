<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Services\SiteService;
use Illuminate\Http\Request;
use App\Http\Requests\SiteRequest;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use App\Library\ModuleConfig;

class SiteController extends Controller
{
	public $service;
    public $module;
	function __construct(SiteService $service)
	{
		$this->service = $service;
        $GLOBALS['module'] = 'site';
	}



    public function search()
    {
        return view('backend.'.$GLOBALS['module'] .'.search', ['data' => '', 'categories' => [], ]);
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



    public function save(SiteRequest $request)
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

    public function update(SiteRequest $request, $id)
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
        $site = $this->service->get('id', $id);
        $contacts = $this->service->getContacts($id);

        $html = view('backend.'.$GLOBALS['module'] .'.site-detail', compact('site', 'contacts'))->render();

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
