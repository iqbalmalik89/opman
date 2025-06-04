<?php

namespace App\Services;

use Illuminate\Foundation\Http\Kernel as HttpKernel;
use App\Models\People;
use App\Models\Document;
use App\Models\Holiday;
use App\Models\Training;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;
use App\Library\Utility;
use App\Library\S3;
use Illuminate\Support\Facades\File; 
use App\Models\ProjectAssignment;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;



class PeopleService
{
    public $model;
    function __construct()
    {
        $this->model = '\\App\\Models\\People';
    }

    public function get($col, $value, $detail = false)
    {
        $rec =  $this->model::where($col, $value)->first();

        return $rec;
    }


    public function deleteHolidays($peopleId)
    {
        Holiday::where('people_id', $peopleId)->delete();
    }


    public function getHolidays($peopleId)
    {
        return Holiday::where('people_id', $peopleId)->get();
    }

    public function getNearHolidays()
    {
        $threeMonths = date('Y-m-d', strtotime("+3 months", time()));
//->distinct()->groupBy('people_id')
        $holidays = Holiday::where('from', '<=', $threeMonths)->get();

        return $holidays;

    }




    public function addHolidays($request, $peopleId)
    {
        $this->deleteHolidays($peopleId);
        if(!empty($request->holiday_from))
        {
            $holidayTo = $request->holiday_to;

            foreach ($request->holiday_from as $key => $holidayFrom) 
            {
                if(!empty($holidayFrom) && !empty($holidayTo[$key]))
                {
                    $holiday = new Holiday;
                    $holiday->from = date('Y-m-d', strtotime(str_replace('/', '-', $holidayFrom)));
                    $holiday->to = date('Y-m-d', strtotime(str_replace('/', '-', $holidayTo[$key])));
                    $holiday->people_id = $peopleId;
                    $holiday->save();                    
                }

            }
        }
    }
    
    public function delete($id)
    {
        $docService = new DocumentService;
        $data = $this->model::find($id);
        if(!empty($data))
        {
            $data->delete();
            
            // delete all docs
            $docs = Document::where('people_id', $id)->get();

            foreach($docs as $doc)
            {
                $docService->delete($doc->id);
            }

            // delete holidays
            $this->deleteHolidays($id);

            // delete photo
            $this->deletePhoto($data->photo_path);

            // delete project assignments
            ProjectAssignment::where('people_id', $id)->delete();

            return $data;
        }
        else
        {
            return false;
        }
    }

    public function getAll($request)
    {
        $input = $request->all();

        // $today = date('Y-m-d');

        // if($input['people_type'] == 'active')
        // {
        //     $records = People::leftJoin('project_assignments', function($join) {
        //           $join->on('people.id', '=', 'project_assignments.people_id');
        //         })
        //         ->where('project_assignments.start_date', '<=', $today)
        //         ->where('project_assignments.end_date', '>=', $today);

        // }
        // else
        // {
        //     $records = People::leftJoin('project_assignments', function($join) {
        //           $join->on('people.id', '=', 'project_assignments.people_id');
        //         })
        //         ->where(function ($query) use ($today) {
        //             $query->where('project_assignments.start_date', '>', $today)
        //                   ->where('project_assignments.end_date', '>', $today);
        //         })
        //         ->orWhere(function ($query) use ($today) {
        //             $query->where('project_assignments.end_date', '<', $today);
        //         })
        //         ->orWhere(function ($query) use ($today) {
        //             $query->orWhereNull('project_assignments.people_id');
        //         });
        // }

        // $records =  $records->select('people.*');


        $this->changePeopleStatuses();


        $records = $this->model::where('status', $input['people_type']);

        if(!empty($input['search']['value']))
        {
            $records = $records->where('first_name', 'LIKE', '%'.$input['search']['value'].'%'); 
        }

        if(empty($input['start']))
            $page = 1;
        else
            $page = ($input['start'] / $input['length']) + 1;

        Paginator::currentPageResolver(function () use ($page) {
            return $page;
        });



        $records = $records->paginate($input['length']);

        foreach ($records as $key => &$record) 
        {
            $record->project = $record->project();
        }

        return $records;
    }



    public function addUpdatePeople($request)
    {
        if(empty($request->id))
        {
            $rec = new People;
        }
        else
        {
            $rec = $this->get('id', $request->id);
        }

        $rec = $this->propertySetter($rec, $request);

        if(empty($request->id))
        {
            $rec->save();

            //do sync of rid
            $this->docSync($request->rid, $rec->id);
        }
        else
        {
            $rec->update();
        }

        $this->addHolidays($request, $rec->id);

        return $rec;
    }


    public function propertySetter($rec, $request)
    {
       $documentService = new DocumentService;
       $mediaService = new MediaService;

//       p($request->all());

       $rec->added_by = $request->user_id;
       $rec->first_name = $request->first_name;
       $rec->last_name = $request->last_name;
       $rec->address1 = $request->address1;
       $rec->address2 = $request->address2;
       $rec->postcode = $request->postcode;
       $rec->country = $request->country;
       $rec->county = $request->county;
       $rec->mobile = $request->mobile;
       $rec->email = $request->email;
       $rec->nok = $request->nok;
       $rec->nok_contact = $request->nok_contact;
       $rec->ni_number = $request->ni_number;
       $rec->cpcs_number = $request->cpcs_number;
       $rec->eusr_number = $request->eusr_number;
       $rec->nposr_number = $request->nposr_number;
       $rec->utr_number = $request->utr_number;
       $rec->employ_start = date('Y-m-d', strtotime(str_replace('/', '-', $request->employ_start)));

       if(!empty($request->dob))
           $rec->dob = date('Y-m-d', strtotime(str_replace('/', '-', $request->dob)));

    
       if(isset($request->driving_license))
           $rec->driving_license = $request->driving_license;




       $photoPath = $mediaService->upload('photo', $request);



        if(!empty($request->dl_expire))
            $rec->dl_expire = date('Y-m-d', strtotime($request->dl_expire));

        if(!empty($request->dl_expire))
            $rec->dl_status = $documentService->getStatus($rec->dl_expire);

        if(!empty($photoPath['new']))
        {
            $destination = 'people-photos/'.$photoPath['new'];
            $mediaService->moveFile('tmp/'.$photoPath['new'], $destination);
            $dbPhotoPath = $photoPath['new'];

            if($rec->photo_path != $dbPhotoPath)
                $this->deletePhoto($rec->photo_path);


        }
        else
        {
            $dbPhotoPath = $request->photo_path;            
        }

        $rec->photo_path = $dbPhotoPath;


       //  $rec->cv_path = $request->cv_path;

       //  if(!empty($request->cv_path))
       //  {
       //      $destination = storage_path('app/public/misc_docs').'/'.$request->cv_path;
       //      $this->mediaService->moveFile($this->mediaService->tmpPath.$request->cv_path, $destination);            
       //  }

       //  $rec->driving_license_path = $request->driving_license_path;

       //  if(!empty($request->driving_license_path))
       //  {
       //      $destination = storage_path('app/public/misc_docs').'/'.$request->driving_license_path;
       //      $this->mediaService->moveFile($this->mediaService->tmpPath.$request->driving_license_path, $destination);            
       //  }

       // $rec->is_valid_driving_license = $request->is_valid_driving_license;
       $rec->bank_detail = $request->bank_detail;
       $rec->sort_code = $request->sort_code;
       $rec->category = $request->category;
       $rec->available_from = $request->available_from;
       $rec->cv_expire = $request->cv_expire;

       $rec->admin_notes = $request->admin_notes;
       if(isset($request->rating))
           $rec->rating = $request->rating;
       return $rec;
    }


    public function docSync($rid, $id)
    {
        // change db
        Document::where('people_id', $rid)->update(['people_id' => $id]);

        //rename folder name
        File::moveDirectory(storage_path('app/public/documents/' . $rid), storage_path('app/public/documents/' . $id));


    }



    public function filters($request, $records)
    {
        if(!empty($request->status))
        {
            $records = $records->where('people.status', $request->status);
        }

        // if(!empty($request->postcode))
        // {
        //     $records = $records->where('people.postcode', $request->postcode);
        // }

        return $records;
    }


    public function searchPeople($request)
    {
        $this->changePeopleStatuses();

        $documentService = new DocumentService;
        $drivingCerts = $documentService->getDrivingCert();

        if(!empty($request->skill[0]))
        {
            
            $records = \DB::table('people')
                        ->join('documents', 'people.id', '=', 'documents.people_id')
                        ->where('documents.status', '!=', 'Expired')->whereNotIn('people.status', ['Banned', 'Deactivated']);

            $records = $this->filters($request, $records);

            $records->whereIn('documents.doc_class', $request->skill)
            ->whereNull('documents.deleted_at')
            ->select('people.*', 'documents.status as doc_status');

        }
        else
        {
            $records = People::where(\DB::raw("CONCAT(`first_name`, ' ', `last_name`)"), 'LIKE','%'.$request->name.'%')->whereNotIn('people.status', ['Banned', 'Deactivated']);
//            $records = $this->filters($request, $records);
        }




        $records = $records->orderBy('first_name', 'asc')->get();

        $people = [];
        foreach($records as &$record)
        {
            $record->driving_license_status = 'NOT';
            $license = $documentService->getDivingLicense($record->id)['driving_docs'];
            if(!empty(count($license)))
            {
                $record->driving_license_status = $license[0]->status;
            }

            $found = true;
            if(!empty($request->skill[0]))
            {
                foreach($request->skill as $skill)
                {
                    $document = Document::where('people_id', $record->id)->pluck('doc_class')->toArray();
                    
                    if(!in_array($skill, $document))
                        $found = false;
                }                
            }



            if($found)
            {
                if(!empty($request->postcode) && $record->postcode)
                {
                    $r = \App\Library\Utility::haversineGreatCircleDistance($request->postcode,$record->postcode, 3959);
                    if(!empty($r))
                        $record->miles = round($r, 1);
                    else
                        $record->miles = '';                        
                }

                $people[$record->id] = $record;



            }
        }


        return $people;
    }

    public function deletePhoto($photo)
    {
        if(!empty($photo))
        {
            $path = 'people-photos/'.$photo;
            if(\Storage::disk('s3')->exists($path))
                \Storage::delete($path);
        }

    }

    public function generatePeopleExcel($peopleId, $basefolder)
    {
        $spreadsheet = new Spreadsheet();
        $activeWorksheet = $spreadsheet->getActiveSheet();
        $people = $this->get('id', $peopleId);

        $activeWorksheet->setCellValue('A1', 'Name');
        $activeWorksheet->setCellValue('A2', $people->first_name . ' '. $people->last_name);

        $activeWorksheet->setCellValue('A1', 'Name');
        $counter = 2;

        foreach ($people->documents as $key => $document) 
        {
            if($document->status != 'Expired')
            {

                $cell = Coordinate::stringFromColumnIndex($counter);
                $activeWorksheet->setCellValue($cell . 1, $document->skill->certification);

                $expireAt = '';
                if(!empty($document->expire_at))
                    $expireAt = date('d/m/Y', strtotime($document->expire_at));

                $activeWorksheet->setCellValue($cell . 2, $expireAt);

                $counter++;

            }
        }


        // $counter = 2;
        // foreach ($peopleIds as $peopleId => $people) 
        // {
        //     $activeWorksheet->setCellValue('A' . $counter, $people);
        //     $skillCounter = 2;
        //     foreach ($docClasses as $docClassId => $docClass) 
        //     {
        //         $cell = Coordinate::stringFromColumnIndex($skillCounter);

        //         $docData = Document::where('people_id', $peopleId)->where('doc_class', $docClassId)->first();

        //         $expireAt = '';
        //         if(!empty($docData->expire_at))
        //             $expireAt = date('d/m/Y', strtotime($docData->expire_at));

        //         $activeWorksheet->setCellValue($cell . $counter, $expireAt);


        //         $skillCounter++;
        //     }            

        //     $counter++;
        // }


        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xls');
        $fileName = $peopleId.'.xls';
    

        // Register the stream wrapper from an S3Client object
        $client = new S3();
        $client = $client->client();
        $client->registerStreamWrapper();

        $writer->save('s3://'.env('AWS_BUCKET').'/tenant-'.tenant()['id'].'/'.$basefolder . '/' . $fileName);


        // $writer->save($basefolder . '/' . $fileName);


    }    


    public function downloadPeople($peopleId)
    {
        $mediaService = new MediaService;
        $projectService = new ProjectService;
        $people = $this->get('id', $peopleId);
        $baseZip = 'zip';
        $baseProject = $baseZip . '/'. $mediaService->sanitizeFileName($people->first_name.' '.$people->last_name, false);

        $zipName = $baseZip . '/' .$peopleId . '.zip';

        if(\Storage::disk('s3')->exists($zipName))
            \Storage::delete($zipName); 


        if(!\Storage::disk('s3')->exists($baseZip))
        {
            \Storage::makeDirectory($baseZip);
        }

        if(!\Storage::disk('s3')->exists($baseProject))
        {
            \Storage::makeDirectory($baseProject);
        }

        $this->generatePeopleExcel($peopleId, $baseProject);
  
        $projectService->downloadPeopleFiles([$peopleId => $people->first_name.' '.$people->last_name], $baseProject, 'people');
    
        $zipName = $baseZip . '/' .$mediaService->sanitizeFileName($people->first_name.' '.$people->last_name, false) . '.zip';

        $zip = $projectService->Zip($baseProject . '/', $zipName);

        \Storage::delete($baseProject); 


       return  $zipName;

    }



    public function changeStatus($request)
    {
        $docService = new DocumentService;
        $rec = $this->get('id', $request->people_id);
        if(!empty($rec))
        {
            if($request->status == 'Inactive')
            {
                if(!empty($rec->project()))
                {
                    $rec->status = 'Active';
                }
                else
                {
                    $rec->status = 'Inactive';
                }                
            }
            else
            {
                $rec->status = $request->status;
            }

            if(in_array($request->status, ['Deactivated', 'Banned']))
            {
                // update training status
                Training::where('people_id', $request->people_id)->delete();

                // update document status
                Document::where('people_id', $request->people_id)->delete();

                // update project assignment status
                ProjectAssignment::where('people_id', $request->people_id)->delete();                
            }
            else
            {
                // change doc status
                $documents = Document::where('people_id', $request->people_id)->restore();
            }

            if($request->status == 'Banned')
            {
                // Delete documents
            }


            $rec->reason = $request->reason;

            $rec->status_date = date('Y-m-d');
            $rec->update();
        }

        return true;
    }


    public function getBanned($request)
    {
        $input = $request->all();


        $records = $this->model::where('status', 'Banned');

        if(!empty($input['search']['value']))
        {
            $records = $records->where('first_name', 'LIKE', '%'.$input['search']['value'].'%'); 
        }

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


    public function getDeactivated($request)
    {
        $input = $request->all();


        $records = $this->model::where('status', 'Deactivated');

        if(!empty($input['search']['value']))
        {
            $records = $records->where('first_name', 'LIKE', '%'.$input['search']['value'].'%'); 
        }

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

    public function changePeopleStatuses()
    {
        $people = People::whereNotIn('status', ['Banned', 'Deactivated'])->get(['id']);

        foreach($people as $peopleId)
        {
            $rec = People::find($peopleId->id);
            
            if(!empty($rec->project()))
            {
                $rec->status = 'Active';
            }
            else
            {
                $rec->status = 'Inactive';
            }
            $rec->update();
        }        
    }

    public function changeAssignmentStatus()
    {
        $upcoming = ProjectAssignment::where('start_date','>', date('Y-m-d'))->where('status','!=', 'Upcoming')->update(['status' => 'Upcoming']);

        $completed = ProjectAssignment::where('end_date','<', date('Y-m-d'))->where('status','!=', 'Completed')->update(['status' => 'Completed']);

        $active = ProjectAssignment::where('start_date','<=', date('Y-m-d'))->where('end_date','>', date('Y-m-d'))->where('status','!=', 'Active')->update(['status' => 'Active']);


    }

}
