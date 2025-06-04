<?php
namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Services\MediaService;

class MediaController extends Controller
{
	public $serviceInstance;
	function __construct(MediaService $customServiceInstance)
	{
		$this->serviceInstance = $customServiceInstance;
	}


    public function upload(Request $request)
    {
		$resp = $this->serviceInstance->upload('file', $request);

		if(!isset($resp['error']))
		{
			return response()->json([
			    'status' => 'success',
			    'orig' => $resp['orig'],
			    'new' => $resp['new'],
			    'code' => 200,
			    'message' => 'File uploaded'
			], 200);
		}
		else
		{
			return response()->json([
			    'status' => 'error',
			    'message' => $resp['error']
			], 401);
		}    	
    }



    public function download(Request $request) {
    	$file = urldecode($request->file); // Decode URL-encoded string
	    $filepath = $request->file_path;
	    
	    // Process download
	    if(file_exists($filepath)) {
	        header('Content-Description: File Transfer');
	        header('Content-Type: application/octet-stream');
	        header('Content-Disposition: attachment; filename="'.basename($filepath).'"');
	        header('Expires: 0');
	        header('Cache-Control: must-revalidate');
	        header('Pragma: public');
	        header('Content-Length: ' . filesize($filepath));
	        flush(); // Flush system output buffer
	        readfile($filepath);
	        exit;
	    }
    }

}
