<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Services\SettingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use App\Library\ModuleConfig;
use App\Http\Requests\SettingRequest;

class SettingController extends Controller
{
	public $service;
    public $module;
	function __construct(SettingService $service)
	{
		$this->service = $service;
        $GLOBALS['module'] = 'setting';
	}

    public function showSettings()
    {
        $data = $this->service->get('id', 1);

        return view('backend.'.$GLOBALS['module'] .'.setting', compact('data'));        
    }

    public function alertSettings(SettingRequest $request)
    {       
        $resp = $this->service->alertSettings($request);

        if($resp)
        {
            return response()->json([
                'status' => 'success',
                'code' => 200,
                'message' => ModuleConfig::getModuleConfig($GLOBALS['module'])['module_name'].' updated successfully'
            ], 200);
        }
        else
        {
            return response()->json([
                'status' => 'success',
                'message' => 'Some error occurred'
            ], 200);
        }
    }

    public function updateSettings(SettingRequest $request, $id)
    {       
        $resp = $this->service->updateSettings($request, $id);

        if($resp)
        {
            return response()->json([
                'status' => 'success',
                'code' => 200,
                'message' => ModuleConfig::getModuleConfig($GLOBALS['module'])['module_name'].' updated successfully'
            ], 200);
        }
        else
        {
            return response()->json([
                'status' => 'success',
                'message' => 'Some error occurred'
            ], 200);
        }
    }






}
