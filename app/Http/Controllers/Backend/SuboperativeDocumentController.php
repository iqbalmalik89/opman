<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Services\SuboperativeDocumentService;
use App\Http\Requests\SuboperativeDocumentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuboperativeDocumentController extends Controller
{
	public $service;

	function __construct(SuboperativeDocumentService $service)
	{
		$this->service = $service;
	}




    public function getExpired(Request $request)
    {
        $response = $this->service->getExpired($request);

        if($response)
        {
			 return response()->json([
                'recordsTotal' => $response->total(),
                'recordsFiltered' => $response->total(),
                'data' => $response->items(),
                'status' => 'success',
                'code' => 200,
                'message' => 'Documents fetched successfully'
            ], 200);        }
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
        $docId = '';


        if($response)
        {
            return response()->json([
                'documents' => $response['docs'],
                'suboperative' => $response['suboperative'],
                'status' => 'success',
                'code' => 200,
                'message' => 'People fetched successfully'
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



    public function get($docId)
   	{
		$resp = $this->service->get('id', $docId);

		if($resp)
		{
			return response()->json([
				'data' => $resp,
			    'status' => 'success',
			    'code' => 200,
			    'message' => 'document fetched'
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

    public function uploadDocument(SuboperativeDocumentRequest $request)
   	{
		$resp = $this->service->saveDoc($request);

		if($resp === 'expired_exists')
		{
			return response()->json([
			    'status' => 'error',
			    'code' => 200,
			    'message' => 'This skill already exists in expired'
			], 200);

		}
		else if($resp === 'exists')
		{
			return response()->json([
			    'status' => 'error',
			    'code' => 200,
			    'message' => 'Skill already exists'
			], 200);

		}
		else if($resp)
		{
			return response()->json([
			    'status' => 'success',
			    'code' => 200,
			    'message' => 'document uploaded'
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

    public function update(SuboperativeDocumentRequest $request)
   	{
		$resp = $this->service->update($request);

		if($resp)
		{
			return response()->json([
			    'status' => 'success',
			    'code' => 200,
			    'message' => 'document saved'
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


    public function expireCron(Request $request)
   	{
		$resp = $this->service->expireCron($request);

		if($resp)
		{
			return response()->json([
			    'status' => 'success',
			    'code' => 200,
			    'message' => 'document cron'
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

    public function delete($id)
    {
		$response = $this->service->delete($id);

        if($response)
        {
            return response()->json([
                'status' => 'success',
                'code' => 200,
                'message' => 'Document has been deleted successfully',
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
