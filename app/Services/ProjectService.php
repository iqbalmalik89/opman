<?php

namespace App\Services;

use Illuminate\Foundation\Http\Kernel as HttpKernel;
use App\Models\ProjectSchedule;
use App\Models\Team;
use App\Models\People;
use App\Models\ProjectLink;
use App\Models\TaskSuboperative;
use App\Models\TeamTask;
use App\Models\Document;
use App\Models\SuboperativeDocument;
use App\Models\Subcontractor;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;
use App\Library\Utility;
use App\Library\S3;
use App\Models\ProjectAssignment;
use Illuminate\Database\Query\Builder;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use Illuminate\Support\Facades\Storage;



class ProjectService
{
    public $model;
    function __construct()
    {
        $this->model = '\\App\\Models\\Project';
        $this->s3client = new S3();

    }


    public function getAssignment($col, $value)
    {
        return ProjectAssignment::where($col, $value)->first();

    }

    public function get($col, $value, $detail = false)
    {
        $rec =  $this->model::where($col, $value)->with('assignments');
        return $rec->first();
    }


    public function getAllProjects()
    {
        $rec =  $this->model::get();
        return $rec;
    }

    public function delete($id)
    {
        $data = $this->model::find($id);
        if(!empty($data))
        {
            $data->delete();
            
            ProjectAssignment::where('project_id', $id)->delete();

            return $data;
        }
        else
        {
            return false;
        }
    }


    public function getAllProjectsByStatus($request)
    {
        $allProjects = [];

        if(!empty($request->status))
            $projectStatuses = [$request->status => 'warning'];
        else
        {
            $projectStatuses = \App\Library\Utility::getProjectStatuses();
            unset($projectStatuses['Archived']);
        }


        foreach ($projectStatuses as $projectStatus => $class) 
        {
            $projects = $this->model::where('status', '=',$projectStatus);

            if($projects->count())
            {
                $allProjects[$projectStatus] = $projects->get();
            }

        }


        return $allProjects;

    }

    public function getAll($request)
    {
        $input = $request->all();

        $records = $this->model::where('id', '>',0);


        if(!empty($input['search']['value']))
        {
            $records = $records->where('name', 'LIKE', '%'.$input['search']['value'].'%'); 
            $records = $records->orWhere('job_no', 'LIKE', '%'.$input['search']['value'].'%'); 
        }

        $input['length'] = 9999;
        if(isset($input['start']) && isset($input['length']))
        {
            if(empty($input['start']))
                $page = 1;
            else
                $page = ($input['start'] / $input['length']) + 1;

            Paginator::currentPageResolver(function () use ($page) {
                return $page;
            });



            $records = $records->paginate($input['length']);            
        }
        else
        {
            return $records->get();
        }


        return $records;
    }

    public function addUpdateProjectLink($projectId, $request)
    {
        ProjectLink::where('project_id', $projectId)->delete();

        if(!empty($request->title))
        {
            foreach ($request->title as $key => $title) 
            {
                if(!empty($title) && !empty($request->link[$key]))
                {
                    $rec = new ProjectLink;
                    $rec->project_id = $projectId;
                    $rec->title = $title;
                    $rec->link = $request->link[$key];
                    $rec->save();                
                }
            }
            
        }
    }



    public function save($request)
    {
        $rec = new $this->model;
        $rec = $this->setter($rec, $request);
        $rec->save();

        $this->addUpdateProjectLink($rec->id, $request);

        return $rec;
    }

    public function update($request, $id)
    {
        $rec = $this->model::find($id);
        $rec = $this->setter($rec, $request);
        $rec->update();

        $this->addUpdateProjectLink($rec->id, $request);

        return $rec;
    }

    public function setter($rec, $request)
    {
        $rec->site_id = $request->site_id;
        $rec->job_no = $request->job_no;
        $rec->sheet_url = $request->sheet_url;
        $rec->name = $request->name;
        $rec->brief = $request->brief;
        $rec->client_id = $request->client_id;
        $rec->start_date = date('Y-m-d', strtotime(str_replace('/', '-', $request->start_date)));
        $rec->due_date = date('Y-m-d', strtotime(str_replace('/', '-', $request->due_date)));
        return $rec;
    }

    public function projectStatusChange($id, $status)
    {

        $rec = $this->model::find($id);
        if(!empty($rec))
        {
            $rec->status = $status;
            $rec->status_changed_at = date('Y-m-d');
            $rec->update();
        }

        // delete project tasks
        $teamTasks =  TeamTask::where('project_id', $id)->get();
        foreach ($teamTasks as $key => $teamTask) 
        {
            TaskSuboperative::where('task_id', $teamTask->id)->delete();
        }

        TeamTask::where('project_id', $id)->delete();

        return true;
    }

    public function checkIfAlreadyAssigned($peopleId, $startDate, $endDate)
    {
        $startDate = date('Y-m-d', strtotime(str_replace('/', '-', $startDate)));
        $endDate = date('Y-m-d', strtotime(str_replace('/', '-', $endDate)));

        $count = \DB::table('project_assignments')->where('people_id', $peopleId)
       ->where(function ($query) use ($startDate, $endDate) {
        $query->where(function ($q) use ($startDate, $endDate) {
            $q->where('start_date', '>=', $startDate)
               ->where('start_date', '<', $endDate);
        })->orWhere(function ($q) use ($startDate, $endDate) {
            $q->where('start_date', '<=', $startDate)
               ->where('end_date', '>', $endDate);
        })->orWhere(function ($q) use ($startDate, $endDate) {
            $q->where('end_date', '>', $startDate)
               ->where('end_date', '<=', $endDate);
        })->orWhere(function ($q) use ($startDate, $endDate) {
            $q->where('start_date', '>=', $startDate)
               ->where('end_date', '<=', $endDate);
        });
        })->whereNull('deleted_at')->count();


       return $count;
    }

    public function Zip($source, $destination)
    {
        $s3 = $this->s3client->client();
        $s3->registerStreamWrapper();

        $zip = new \ZipArchive;
        if(!file_exists(storage_path('/')))
            mkdir(storage_path('/'));
        if(!file_exists(storage_path('/zip')))
            mkdir(storage_path('/zip'));

        $zip->open(storage_path($destination), \ZipArchive::CREATE);

        $tenant = 'tenant-'.tenant()['id'].'/';

        $bucket = env('AWS_BUCKET');
        $objects = $s3->getIterator('ListObjects', array(
            'Bucket' => $bucket,
            'Prefix' => $tenant.$source

        ));


        foreach ($objects as $object) {
            $contents = file_get_contents("s3://{$bucket}/{$object['Key']}");
            $zip->addFromString(str_replace($tenant.'zip', '', $object['Key']) , $contents);
        }

        $zip->close();
        return $zip;

        // if (!extension_loaded('zip') || !\Storage::disk('s3')->exists($source)) {
        //     return false;
        // }

        // $origSource = $source;
        // $s3 = new S3;
        // $client = $s3->client();
        // $source = 's3://' . env('AWS_BUCKET').'/' .\Storage::path('/') .  trim($source, '/');

        // // $files = Storage::allFiles($source);
        // // p($files);
        // // echo $source .'<br>'.$destination;
        // // die();

        // $zip = new \ZipArchive();


        // if (!$zip->open(storage_path($destination), \ZIPARCHIVE::CREATE)) 
        // {
        //     return false;
        // }



        // // $source = str_replace('\\', '/', realpath($source));
        // // p($source);



        // if (\Storage::disk('s3')->exists($origSource) === true)
        // {



        //     $client->registerStreamWrapper();

        //     $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($source), \RecursiveIteratorIterator::SELF_FIRST);

        //     p($files);

        //     if (true) {

        //         $arr = explode("/",$source);
        //         $maindir = $arr[count($arr)- 1];

        //         $source = "";
        //         for ($i=0; $i < count($arr) - 1; $i++) { 
        //             $source .= '/' . $arr[$i];
        //         }

        //         $source = substr($source, 1);

        //         $zip->addEmptyDir($maindir);

        //     }
        //     foreach ($files as $file)
        //     {
        //         $file = str_replace('\\', '/', $file);
        //         // Ignore "." and ".." folders
        //         if( in_array(substr($file, strrpos($file, '/')+1), array('.', '..')) )
        //             continue;

        //         $file = realpath($file);

        //         if (is_dir($file) === true)
        //         {
        //             $zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));
        //         }
        //         else if (is_file($file) === true)
        //         {
        //             $zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));
        //         }
        //     }
        // }
        // else if (is_file($source) === true)
        // {
        //     $zip->addFromString(basename($source), file_get_contents($source));
        // }

        // $zip->close();

        // return $zip;
    }

    
    public function generateProjectExcel($project, $baseProject, $type)
    {
        $spreadsheet = new Spreadsheet();
        $activeWorksheet = $spreadsheet->getActiveSheet();
        $docClasses = [];

        if($type == 'people')
        {
            $projectAssignment = ProjectAssignment::where('project_id', $project->id)->get();

            foreach($projectAssignment as $assignment)
            {
                $peopleIds[$assignment->people_id] = $assignment->people->first_name .' '. $assignment->people->last_name;
                foreach ($assignment->people->documents as $key => $doc) 
                {
                    $docClasses[$doc->doc_class] = $doc->skill->certification;
                }
            }            
        }
        else
        {

            $teamTasks =  TeamTask::where('project_id', $project->id)->get();

            foreach($teamTasks as $teamTask)
            {
                if(date('Y-m-d') >= $teamTask->start_date  && date('Y-m-d') <= $teamTask->end_date)
                {
                    $tasks = TaskSuboperative::where('task_id', $teamTask->id)->get();
                    foreach ($tasks as $key => $task) 
                    {
                        $peopleIds[$task->suboperative_id] = $task->suboperative->first_name .' '. $task->suboperative->last_name;
                        foreach ($task->suboperative->documents as $key => $doc) 
                        {
                            $docClasses[$doc->doc_class] = $doc->skill->certification;
                        }
                    }
                }
            }
        }

        $activeWorksheet->setCellValue('A1', 'Name');
        $counter = 2;

        foreach ($docClasses as $key => $docClass) 
        {
            $cell = Coordinate::stringFromColumnIndex($counter);
            $activeWorksheet->setCellValue($cell . 1, $docClass);
            $counter++;
        }

        $counter = 2;
        if(!empty($peopleIds))
        {
            foreach ($peopleIds as $peopleId => $people) 
            {
                $activeWorksheet->setCellValue('A' . $counter, $people);
                $skillCounter = 2;
                foreach ($docClasses as $docClassId => $docClass) 
                {                
                    if($type == 'people')
                        $docData = Document::where('people_id', $peopleId)->where('doc_class', $docClassId)->first();
                    else
                        $docData = SuboperativeDocument::where('suboperative_id', $peopleId)->where('doc_class', $docClassId)->first();

                    $cell = Coordinate::stringFromColumnIndex($skillCounter);

                    if(!empty($docData) &&  $docData->status != 'Expired')
                    {

                        $expireAt = '';
                        if(!empty($docData->expire_at))
                            $expireAt = date('d/m/Y', strtotime($docData->expire_at));

                        $activeWorksheet->setCellValue($cell . $counter, $expireAt);

                    }


                    $skillCounter++;
                }            

                $counter++;
            }
            
        }



        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xls');
        $fileName = $project->job_no.'.xls';
    

        // Register the stream wrapper from an S3Client object
        $client = $this->s3client->client();
        $client->registerStreamWrapper();

        $writer->save('s3://'.env('AWS_BUCKET').'/tenant-'.tenant()['id'].'/'.$baseProject . '/' . $fileName);


    }

    public function downloadPeopleFiles($peopleIds, $baseFolder, $type)
    {
        if($type == 'people')
            $docFolder = 'documents';
        else
            $docFolder = 'suboperative-documents';

        foreach($peopleIds as $peopleId => $people)
        {
            $peopleDir = $baseFolder . '/' . $people;

            if(!\Storage::disk('s3')->exists($peopleDir))
                \Storage::makeDirectory($peopleDir);

            $sourceDoc = $docFolder . '/' . $peopleId .'/';

            if($type == 'people')
                $documents = Document::where('people_id', $peopleId)->where('status', '!=', 'Expired')->get();
            else
                $documents = SuboperativeDocument::where('suboperative_id', $peopleId)->where('status', '!=', 'Expired')->get();


            foreach ($documents as $key => $document) 
            {
                $paths = explode(',', $document->doc_path);

                $inc = 0;
                foreach ($paths as $key => $path) 
                {
                    $inc = $inc + 1;
                    // $fileInc = ++$key;

                    $path = trim($path);
                    $dest = $document->skill->certification . '-'.$inc;
                    // $dest = pathinfo($path, PATHINFO_BASENAME);


    
                    $dest = preg_replace( '/[^a-z0-9]+/', '-', strtolower( $dest ) )  . '.'. pathinfo($path, PATHINFO_EXTENSION);

                    if(\Storage::disk('s3')->exists($sourceDoc . $path))
                    {

                        Storage::copy($sourceDoc . $path, $peopleDir .'/'. $dest);
                        

                       //  $this->s3client->copyObject([
                       //  'Bucket'     => env('AWS_BUCKET'),
                       //  'Key'        => $peopleDir .'/'. $dest,
                       //  'CopySource' => "{$sourceBucket}/{$sourceKeyname}",
                       //  ]);                       

                       // \File::copy($sourceDoc . $path, $peopleDir .'/'. $dest);

                    }


                }
            }

        }


    }

    public function projectDownload($id, $type)
    {


        $s3 = $this->s3client->client();

        $results = $s3->listObjectsV2([
            'Bucket' => env('AWS_BUCKET'),
            'Prefix' => 'tenant-' . tenant()['id'] .'/zip'
        ]);


        if (isset($results['Contents'])) {
            foreach ($results['Contents'] as $result) {
                $s3->deleteObject([
                    'Bucket' => env('AWS_BUCKET'),
                    'Key' => $result['Key']
                ]);
            }
        }


        $subOpService = new SuboperativeService;
        $project = $this->get('id', $id);
        // $zip = new \ZipArchive;
        $baseZip = 'zip';
        $baseProject = $baseZip . '/'. $project->job_no;


        $zipName = $baseZip . '/' .$project->job_no . '.zip';

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


        $this->generateProjectExcel($project, $baseProject, $type);


        $peopleIds = [];

        if($type == 'people')
        {
            $projectAssignment = ProjectAssignment::where('project_id', $id)->get();
            foreach($projectAssignment as $assignment)
            {
                if(!empty($assignment->people))
                {
                    $peopleIds[$assignment->people_id] = $assignment->people->first_name .' '. $assignment->people->last_name;
                }
            }

        }
        else
        {
            $peopleIds =$subOpService->getSubops($id)['active'];
        }


        // foreach($peopleIds as $peopleId => $people)
        // {
        //     $peopleDir = $baseProject . '/' . $people;

        //     if(!is_dir($peopleDir))
        //         \File::makeDirectory($peopleDir);

        //     $sourceDoc = $docFolder . '/' . $peopleId .'/';

        //     $documents = Document::where('people_id', $peopleId)->get();
        //     foreach ($documents as $key => $document) 
        //     {
        //         $paths = explode(',', $document->doc_path);

        
        //         foreach ($paths as $key => $path) 
        //         {
        //             $fileInc = ++$key;

        //             $path = trim($path);
        //             $dest = $fileInc .'-'. $document->skill->certification ;

    
        //             $dest = preg_replace( '/[^a-z0-9]+/', '-', strtolower( $dest ) )  . '.'. pathinfo($path, PATHINFO_EXTENSION);
        //            \File::copy($sourceDoc . $path, $peopleDir .'/'. $dest);


        //         }
        //     }

        // }

        $this->downloadPeopleFiles($peopleIds, $baseProject, $type);

        $zipName = $baseZip . '/' .$project->job_no . '.zip';

        $zip = $this->Zip($baseProject . '/', $zipName);

        // \Storage::delete($baseProject);

       return  $zipName;

    }

    public function assign($request)
    {
        $count = $this->checkIfAlreadyAssigned($request->people_id, $request->assign_start_date, $request->assign_end_date); 
        if($count)
            return 'overlapped';

        $rec = new ProjectAssignment;
        $rec = $this->assignSetter($rec, $request);
        $rec->save();
        return $rec;
    }

    public function updateAssign($request)
    {
        $rec = ProjectAssignment::find($request->assign_id);
        $rec = $this->assignSetter($rec, $request);
        $rec->update();
        return $rec;
    }

    public function assignSetter($rec, $request)
    {
        $rec->doc_id = $request->assign_doc_id;
        $rec->project_id = $request->project_id;
        $rec->people_id = $request->people_id;
        $rec->start_date = date('Y-m-d', strtotime(str_replace('/', '-', $request->assign_start_date)));
        $rec->end_date = date('Y-m-d', strtotime(str_replace('/', '-', $request->assign_end_date)));
        return $rec;

    }

    public function getProjectSubcontractors($projectId)
    {
        $subcontractorIds = Teamtask::where('project_id', $projectId)->select(['subcontractor_id'])->distinct('subcontractor_id')->get();

        $subcontractors = [];
        foreach ($subcontractorIds as $key => $subcontractorId) 
        {
            $subcontractors[] = Subcontractor::find($subcontractorId->subcontractor_id);
        }

        
        return $subcontractors;

        // // $teams = Team::where('project_id', $projectId)->get();

        // return $teams;

    }


    public function deleteAssignment($id)
    {
        ProjectAssignment::where('id', $id)->delete();
        return true;
    }


    public function projectStatusChangeCron()
    {
        $projects = $this->model::where('status', 'Handover')->where('status_changed_at', '<', now()->subDays(14))->get();
        foreach($projects as $project)
        {
            $this->projectStatusChange($project->id, 'Archived');
        }
    }



}






