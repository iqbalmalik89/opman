<?php
namespace App\Services;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

  
class MediaService
{

    public $imageExtensions = [];
    public $tmp;

    function __construct()
    {
        $this->imageExtensions = ['jpg', 'jpeg', 'png', 'ico', 'pdf'];
        $this->tmp = 'tmp/';

    }

   

    public function upload($param, $request)
    {

        $file = $request->file($param);

        // if(!empty($request->samename))
        // {
        //     $unique = false;
        // }  
        // else
        // {
        //     $unique = true;            
        // }

        $unique = true;            

        if(!empty($file))
        {
            $originalName = $file->getClientOriginalName();
            $extension = strtolower($file->getClientOriginalExtension());
            // $modifiedName = str_shuffle(sha1(time())) . '.' . $extension;
            $modifiedName = $this->sanitizeFileName($originalName, $unique);
            if(in_array($extension, $this->imageExtensions))
            {

                $path = $file->storePubliclyAs(
                    'tmp', $modifiedName
                );


                return ['orig' => $originalName, 'new' => $modifiedName];

            }
            else
            {
                return ['error' => 'Invalid file extension'];
            }            
        }
        else
        {
            return [];
        }



     }



    public function sanitizeFileName($fileName, $uniqueId = true) 
    {
      $arr = ['?','[',']','/','\\','=','<','>',':',';',',', "'",'"','&','$','#','*','(',')','|','~','`','!','{','}','%','+','’','«','»','”','“'];
      $info = pathinfo($fileName);
      $name = $info['filename'];
      $ext  = $info['extension'] ?? '';
      
      $name = str_replace( $arr, '', $name );
      $name = preg_replace( '/[\. _-]+/', '-', $name );
      $name = trim( $name, '-' );
      $uniqid = '';
      if($uniqueId)
          $uniqid = uniqid('-');
    
        if(!empty($ext))
            $ext = '.'.$ext;
      return $this->stripAccents("$name$uniqid$ext"); 
     }

    public function stripAccents($str) {
       return strtr(utf8_decode($str), utf8_decode('àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ'), 'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY');
    }   
    
     public function moveFile($source, $destination, $replace = true)
     {
        if(\Storage::disk('s3')->exists($source))
        {
            if(!$replace && \Storage::disk('s3')->exists($destination))
            {
                return false;
            }
            else
            {

                \Storage::move($source, $destination);


                // File::move($source, $destination);
                return true;
            }
        }
        else
        {
            return false;
        }
     }

    

}


?>