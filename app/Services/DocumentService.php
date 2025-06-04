<?php

namespace App\Services;

use Illuminate\Foundation\Http\Kernel as HttpKernel;
use App\Models\User;
use App\Models\Training;
use App\Models\Certification;
use App\Models\People;
use App\Models\Document;
use App\Mail\CommonMail;
use App\Mail\PasswordRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;
use App\Library\Utility;
use Illuminate\Support\Facades\File; 
use Illuminate\Pagination\Paginator;


class DocumentService
{
   public $curr_locale; 
   public $mediaService; 
    function __construct()
    {
        $this->mediaService = new MediaService;
    }

    public function get($col, $value, $detail = false)
    {
        $rec =  Document::where($col, $value)->first();

        if($detail)
        {

        }

        return $rec;

    }

    public function uploadDocument($request)
    {
        p($request->all());
    }

    public function addUpdatePeople($request)
    {
        if(empty($request->module_id))
        {
            $rec = new People;
        }
        else
        {
            $rec = $this->get('id', $request->module_id);
        }

        $rec = $this->propertySetter($rec, $request);

        if(empty($request->module_id))
        {
            $rec->save();
        }
        else
        {
            $rec->update();
        }
       

        return $rec;
    }


    public function propertySetter($rec, $request)
    {
       $rec->added_by = $request->user_id;
       $rec->first_name = $request->first_name;
       $rec->last_name = $request->last_name;
       $rec->address1 = $request->address1;
       $rec->address2 = $request->address2;
       $rec->postcode = $request->postcode;
       $rec->country = $request->country;
       $rec->photo = $request->photo;
       $rec->mobile = $request->mobile;
       $rec->email = $request->email;
       $rec->nok = $request->nok;
       $rec->nok_contact = $request->nok_contact;
       $rec->is_fit = $request->is_fit;
       $rec->ni_number = $request->ni_number;
       $rec->cpcs_number = $request->cpcs_number;
       $rec->eusr_number = $request->eusr_number;
       $rec->nposr_numbre = $request->nposr_numbre;
       $rec->utr_number = $request->utr_number;
       $rec->driving_license = $request->driving_license;
       // $rec->is_valid_driving_license = $request->is_valid_driving_license;
       $rec->bank_detail = $request->bank_detail;
       $rec->sort_code = $request->sort_code;
       $rec->cv = $request->cv;
       $rec->category = $request->category;
       $rec->available_from = $request->available_from;
       $rec->admin_notes = $request->admin_notes;
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
        $drivingDocs = Document::where('people_id', $peopleId)->with('skill')->whereIn('doc_class', $catCerts)->get();
        foreach($drivingDocs as &$record)
        {
            $record->training = $record->training();
        }


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

        $docs = Document::where('people_id', $id)->with('skill')
                ->leftJoin('certifications', 'certifications.id', '=', 'documents.doc_class')
                ->orderBy('certifications.certification','asc')
                ->whereNotIn('doc_class', $drivingDocsData['cat_cert'])->get('documents.*');

        foreach($docs as &$doc)
        {
            $doc->training = $doc->training();
        }

        $drivingDocs = $drivingDocsData['driving_docs'];

        $related = $drivingDocs->merge($docs);

        return $related;

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
        return Document::where('people_id', $peopleId)->where('doc_class', $skillId)->first();
    }

    public function saveDoc($request)
    {
        if(!empty($request->id))
            $id = $request->id;
        else
            $id = $request->rid;

        $rndSrting = $this->generateRandomString(10);
        $uploadDir = 'documents/'.$id;



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
            $rec = new Document;
            $rec->people_id = $id;
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

        $documents = Document::get();
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


    public function getDocByStatus($status)
    {
        $documents = Document::whereIn('status', $status)->where('expire_at', '>=', now()->subDays(14))->get();
        return $documents;
    }

    public function docStatusChange($document)
    {
        $status = '';
        $status = $this->getStatus($document->expire_at);

        // if($document->status == 'Active' && $status == 'Expiring')
        // {
        //     $emailData = array('document' => $document,
        //                        'user' => $document->people,
        //                        'subject' => 'Document Expiring',
        //                        'view' => 'expiring',
        //                         );


        //     try {
        //         \Mail::to($document->people->email)->send(new CommonMail($emailData));
        //     } catch(\Exception $e){
        //         echo $e;
        //     }


        //     $emailData = array('document' => $document,
        //                        'user' => $document->people,
        //                        'link' => tenant_route(tenant()->domains[0]->domain, 'edit-people', $document->people_id),
        //                        'subject' => 'Document Expiring',
        //                        'view' => 'expiring-admin',
        //                         );



        //     try {
        //         \Mail::to(Utility::getSuperAdmin()->email)->send(new CommonMail($emailData));
        //     } catch(\Exception $e){
        //         echo $e;
        //     }
        // }



        if(!empty($status))
        {
            $document->status = $status;
            $document->update();
        }
    }

    public function getExpired($request)
    {
        $input = $request->all();

        $records = Document::with('people', 'skill')->has('people')->where('status', 'Expired');


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
        foreach($records->items() as &$record)
        {
            $record->training = $record->training();
        }

        return $records;

    }

    public function getStatus($date)
    {

        if($date >= date('Y-m-d', strtotime('+3 months', time())))
        {
            $status = 'Active';
        }
        else if($date <= date('Y-m-d', strtotime('+3 months', time())) && $date >= date('Y-m-d', strtotime('+1 months', time())))
        {
            $status = 'Expiring';
        }
        else if($date > date('Y-m-d') && $date <= date('Y-m-d', strtotime('+1 months', time())))
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

        if(!empty($request->training_id))
            $training = Training::find($request->training_id);

        if(empty($rec))
        {
            $rec = new Document;
            $rec->user_id = Auth::user()['id'];
            $rec->people_id = $training->people_id;
            $rec->doc_class = $training->doc_class;
            $rec->batch = $this->generateRandomString(10);
            $rec->status = 'Active';
        }


        if(!empty($replacePath ) && $rec->doc_path != $replacePath)
        {

            $paths = explode(',', $replacePath);

            foreach($paths as $path)
            {
                $path = trim($path);

                $this->mediaService->moveFile('tmp/'. $path, 'documents/'.$rec->people_id.'/'.$path); 

                // remove file
                if(!empty($rec->id))
                    $this->deleteFile($rec->people_id, $rec->doc_path);
            }
 
        }

        $rec->expire_at = date('Y-m-d', strtotime(str_replace('/', '-', $request->replace_expire_at)));

        if(empty($rec->id))
        {
            $rec->doc_path = $replacePath;
            $rec->save();
        }
        else
        {
            $rec->update();
        }

        //change training status

        if(!empty($training))
        {

            $training->doc_id = $rec->id;
            $training->status = 'Confirmed';
            $training->update();

        }


        // update doc path in all
        if(!empty($replacePath))
        {
            Document::where('batch', $rec->batch)
          ->update(['doc_path' => $replacePath]);

        }


        $this->docStatusChange($rec);

        return true;
    }


    public function deleteFile($peopleId, $file)
    {
        if(!empty($file))
        {
            $path = 'documents/'.$peopleId.'/'.$file;
            if(\Storage::disk('s3')->exists($path))
                \Storage::delete($path);
        }

    }



    public function delete($id)
    {
        $data = Document::find($id);
        if(!empty($data))
        {
            // delete file
            $docCount = Document::where('doc_path', $data->doc_path)->count();

            if($docCount == 1)
            {
                //delete file from disk
                $this->deleteFile($data->people_id, $data->doc_path);
                // File::delete(storage_path('app/public/documents/'..'/'.$data->doc_path));
            }

            $data->forceDelete();
            return $data;
        }
        else
        {
            return false;
        }
    }

    public function expireDocument($request)
    {
        $docs = Document::whereDate('expire_at', '<=', now()->subDays(30))->delete();
    }



}
