<?php
  
namespace App\Library;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;
use App\Models\BasePermission;
use App\Models\User;

  
class S3
{
	
	public function client()
	{
        $client = new \Aws\S3\S3Client([
            'credentials' => [
                'key' => env('AWS_ACCESS_KEY_ID'),
                'secret' => env('AWS_SECRET_ACCESS_KEY'),
            ],
            'default_cache_config' => '',
            'certificate_authority' => true,
            'region' => env('AWS_DEFAULT_REGION'),
            'version' => 'latest'
        ]);
	
		return $client;		
	}



}


?>