<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Services\BackupService;
use App\Http\Requests\DocumentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Library\ModuleConfig;

class BackupController extends Controller
{
	public $service;
    public $module;

	function __construct(BackupService $service)
	{
		$this->service = $service;
        $GLOBALS['module'] = 'backup';
        $this->maxBackups = 5;

	}


    public function restoreRequest($id)
    {
        $response = $this->service->restoreRequest($id);

        if($response)
        {
            return response()->json([
                'status' => 'success',
                'code' => 200,
                'message' => 'Backup restore request has been sent successfully',
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


    public function delete($id)
    {
        $response = $this->service->delete($id);                

        if($response)
        {
            return response()->json([
                'status' => 'success',
                'code' => 200,
                'message' => 'Backup has been deleted successfully',
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

    public function backup(Request $request)
    {
        $backupCount = $this->service->backupCount('tenant-' . tenant()['id']);

        if($backupCount < $this->maxBackups)
        {
            $response = $this->service->backup($request);


            if($response)
            {
                return response()->json([
                    'status' => 'success',
                    'code' => 200,
                    'message' => ModuleConfig::getModuleConfig($GLOBALS['module'])['module_name'].' created successfully'
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
        else
        {
                return response()->json([
                    'status' => 'error',
                    'message' => 'You have reached max ' . $this->maxBackups . ' backups.',
                ], 200);

        }

    }



    public function show()
    {
        return view('backend.'.$GLOBALS['module'] .'.listing');
    }



    public function getAll(Request $request)
    {
        $response = $this->service->getAll($request);

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



}
