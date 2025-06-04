<?php

namespace App\Services;

use Illuminate\Foundation\Http\Kernel as HttpKernel;
use App\Models\User;
use App\Models\Certification;
use App\Models\TaskSuboperative;
use App\Models\People;
use App\Models\SuboperativeDocument;
use App\Models\Suboperative;
use App\Mail\CommonMail;
use App\Mail\PasswordRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;
use App\Library\Utility;
use Illuminate\Support\Facades\File; 
use Illuminate\Pagination\Paginator;


class SuboperativeDocumentService
{
   public $curr_locale; 
   public $mediaService; 
    function __construct()
    {
        $this->mediaService = new MediaService;
    }


    public function get($col, $value, $detail = false)
    {
        $rec =  SuboperativeDocument::where($col, $value)->first();

        if($detail)
        {

        }

        return $rec;

    }

    public function getDrivingCert()
    {
        $catService = new CategoryService();
        $cat = $catService->get('category', 'Driving License');
        $catCerts = [];
        if(!empty($cat))
        {
            $catCerts = (array) $catService->getCatCerts($cat->id);
        }

        return $catCerts;
    }

    public function getDivingLicense($peopleId)
    {
        $catCerts = $this->getDrivingCert();
        $drivingDocs = SuboperativeDocument::where('suboperative_id', $peopleId)->with('skill')->whereIn('doc_class', $catCerts)->get();

        return ['cat_cert' => $catCerts, 'driving_docs' => $drivingDocs];
    }


    public function getAll($request)
    {
        if(!empty($request->id))
        {
            $id = $request->id;
        }
        else
        {
            $id = $request->rid;            
        }

        $drivingDocsData = $this->getDivingLicense($id);

        $docs = SuboperativeDocument::where('suboperative_id', $id)->with('skill')->whereNotIn('doc_class', $drivingDocsData['cat_cert'])->get();

        $drivingDocs = $drivingDocsData['driving_docs'];

        $related = $drivingDocs->merge($docs);

        $suboperative = Suboperative::where('id', $id)->first();

        return ['docs' => $related, 'suboperative' => $suboperative];

    }


    public static function getDocClass()
    {
        return Certification::get();
    }

    public function generateRandomString($length) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function checkSkillExists($peopleId, $skillId)
    {
        return SuboperativeDocument::where('suboperative_id', $peopleId)->where('doc_class', $skillId)->first();
    }


    public function saveDoc($request)
    {

        if(!empty($request->id))
            $id = $request->id;
        else
            $id = $request->rid;

        $rndSrting = $this->generateRandomString(10);
        $uploadDir = 'suboperative-documents/'.$id;

        if(!is_dir($uploadDir))
        {
            \Storage::makeDirectory($uploadDir);
        }


        foreach ($request->expire_at as $key => $expireAt) 
        {
            $docClass = $request->doc_class[$key];

            $data = $this->checkSkillExists($id, $docClass);
            if($data)
            {
                if($data->status == 'Expired')
                    return 'expired_exists';                    
                else
                    return 'exists';
            }

        }




        $filePath = ltrim($request->docfiles_path, ',');

        foreach ($request->expire_at as $key => $expireAt) 
        {
            $docClass = $request->doc_class[$key];
            $rec = new SuboperativeDocument;
            $rec->suboperative_id = $id;
            $rec->batch = $rndSrting;
            $rec->user_id = Auth::user()['id'];
            $rec->doc_class = $docClass;
            $rec->doc_path = $filePath;
            $rec->expire_at = date('Y-m-d', strtotime(str_replace('/', '-', $expireAt)));
            $rec->status = 'Active';
            $rec->save();

            $this->docStatusChange($rec);

        }


        // move document
        if(!empty($filePath))
        {
            foreach(explode(',', $filePath) as $singleFile)
            {
                $destination = $uploadDir.'/'.$singleFile;

                $this->mediaService->moveFile('tmp/'.$singleFile, $destination);
            }
            
        }

        
        return $rec;
    }

    public function expireCron($request)
    {

        $documents = SuboperativeDocument::get();
        foreach ($documents as $key => $document) 
        {
            $this->docStatusChange($document);
        }

        // $people = People::get();
        // foreach ($people as $key => $peop) 
        // {
        //     $this->dlStatusChange($peop);
        // }

        return true;
    }

    public function dlStatusChange($people)
    {
        $status = '';

        $status = $this->getStatus($people->dl_expire);

        if(!empty($status))
        {
            $people->dl_status = $status;
            $people->update();
        }
    }


    public function getExpiredAssignedSkills()
    {
        return $docs = TaskSuboperative::whereRelation('document', 'status', 'Expired')->get();



        die();
        $documents = SuboperativeDocument::where('status', 'Expired')->get();
        return $documents;
        // TaskSuboperative::get();

        // return $documents;
    }

    public function docStatusChange($document)
    {
        $status = '';

        $status = $this->getStatus($document->expire_at);

        if($document->status == 'Active' && $status == 'Expiring')
        {

            // $emailData = array('document' => $document,
            //                    'user' => $document->people,
            //                    'subject' => 'Document Expiring',
            //                    'view' => 'expiring',
            //                     );


            // try {
            //     \Mail::to($document->people->email)->send(new CommonMail($emailData));
            // } catch(\Exception $e){
            //     echo $e;
            // }


            // $emailData = array('document' => $document,
            //                    'user' => $document->people,
            //                    'link' => tenant_route(tenant()->domains[0]->domain, 'update-suboperative', $document->suboperative_id),
            //                    'subject' => 'Document Expiring',
            //                    'view' => 'expiring-admin',
            //                     );



            // try {
            //     \Mail::to(Utility::getSuperAdmin()->email)->send(new CommonMail($emailData));
            // } catch(\Exception $e){
            //     echo $e;
            // }
        }


        if(!empty($status))
        {
            $document->status = $status;
            $document->update();
        }
    }



    public function getExpired($request)
    {
        $input = $request->all();

        $records = SuboperativeDocument::with('people', 'skill')->where('status', 'Expired');

        // if(!empty($input['search']['value']))
        // {
        //     $records = $records->where('name', 'LIKE', '%'.$input['search']['value'].'%'); 
        // }

        if(empty($input['start']))
            $page = 1;
        else
            $page = ($input['start'] / $input['length']) + 1;

        Paginator::currentPageResolver(function () use ($page) {
            return $page;
        });



        $records = $records->paginate($input['length']);

        return $records;

    }



    public function getStatus($date)
    {

        if($date >= date('Y-m-d', strtotime('+3 months', time())))
        {
            $status = 'Active';
        }
        else if($date < date('Y-m-d', strtotime('+3 months', time())) && $date > date('Y-m-d', strtotime('+1 months', time())))
        {
            $status = 'Expiring';
        }
        else if($date > date('Y-m-d') && $date < date('Y-m-d', strtotime('+1 months', time())))
        {
            $status = 'Critical';
        }
        else if($date <= date('Y-m-d'))
        {
            $status = 'Expired';
        }

        return $status;
    }



    public function update($request)
    {

        $rec = $this->get('id', $request->doc_id);
        // move document

        $replacePath = ltrim($request->replace_doc_path, ',');


        if(!empty($replacePath ) && $rec->doc_path != $replacePath)
        {
            $paths = explode(',', $replacePath);

            foreach($paths as $path)
            {
                $path = trim($path);
                $this->mediaService->moveFile('tmp/' . $path, 'suboperative-documents/'.$rec->suboperative_id.'/'.$path); 

                $this->deleteFile($rec->suboperative_id, $rec->doc_path);
                

            }
 
        }

        $rec->expire_at = date('Y-m-d', strtotime(str_replace('/', '-', $request->replace_expire_at)));
        $rec->update();

        // update doc path in all
        if(!empty($replacePath))
        {
            SuboperativeDocument::where('batch', $rec->batch)
          ->update(['doc_path' => $replacePath]);

        }


        $this->docStatusChange($rec);

        return true;
    }

    public function deleteFile($subOperativeId, $file)
    {
        if(!empty($file))
        {
            $path = 'suboperative-documents/'.$subOperativeId.'/'.$file;
            if(\Storage::disk('s3')->exists($path))
                \Storage::delete($path);
        }

    }

    public function delete($id)
    {
        $data = SuboperativeDocument::find($id);
        if(!empty($data))
        {
            // delete file
            $docCount = SuboperativeDocument::where('doc_path', $data->doc_path)->count();

            if($docCount == 1)
            {
                //delete file from disk
                $this->deleteFile($data->suboperative_id, $data->doc_path);

            }

            $data->delete();
            return $data;
        }
        else
        {
            return false;
        }
    }


    public function expireDocument($request)
    {
        $docs = SuboperativeDocument::whereDate('expire_at', '<=', now()->subDays(30))->delete();
    }

}
