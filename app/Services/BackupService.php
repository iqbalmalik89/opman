<?php

namespace App\Services;

use Illuminate\Foundation\Http\Kernel as HttpKernel;
use App\Models\User;
use App\Models\Certification;
use App\Models\RestoreRequest;
use App\Mail\CommonMail;
use App\Mail\PasswordRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;
use App\Library\Utility;
use App\Library\S3;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Facades\Artisan;
use Illuminate\Pagination\Paginator;

class BackupService
{
    public $model;
    function __construct()
    {
        $this->model = '\\App\\Models\\Backup';
    }

    public function backupCount($tenant)
    {
        return $this->model::where('tenant', $tenant)->count();
    }

    public function get($col, $value)
    {
        return $this->model::where($col, $value)->first();        
    }

    public function restoreRequest($backupId)
    {
        $rec = new RestoreRequest;
        $rec->backup_id = $backupId;
        $rec->requested_by = json_encode(Auth::user());
        $rec->save();
        $backup = $this->get('id', $backupId);
        $mailData = array(
                           'subject' => $backup->tenant . 'Backup Restore Request' ,
                           'view' => 'restore-backup',
                           'user' => Auth::user(),
                           'backup' => $backup,
                            );


        try {
            \Mail::to('jasonbourne501@gmail.com')->send(new CommonMail($mailData));
        } catch(\Exception $e){
            echo $e;
        }                

        return true;
    }

    public function backup()
    {
        // p(tenant());
        // exec('php artisan backup:run');        
        // \DB::purge('mysql');

        // config(['database.connections.mysql.database' => tenant()->tenancy_db_name]);


        \Config::set('filesystems.disks.s3.bucket', 'opman-dbs');

        // remaining operations on BackupWasSuccessfulListner

        \Artisan::call('backup:run --only-db');


        return true;


        // tenancy()->initialize(tenant());


        // $source = 's3://opmandata/tenant-asmir';

        // // Where the files will be transferred to.
        // $dest = 's3://opman-backups/test';

        // // Create a transfer object.
        // $manager = new \Aws\S3\Transfer($client, $source, $dest);

        // // Perform the transfer synchronously.
        // $manager->transfer();        



        // config(['backup.backup.source.files.include' => [storage_path()]]);

        // Artisan::call('backup:run');

        return true;

    }

    public function delete($id)
    {


        $rec = $this->model::find($id);


        // delete s3 files backup
        if(!empty($rec->backup))
        {

            exec('/usr/local/bin/aws s3 rm s3://opman-backups/tenant-' . tenant()['id'].'/'.pathinfo($rec->backup, PATHINFO_FILENAME).' --recursive --region ' . env('AWS_DEFAULT_REGION'));

            // delete database

            $s3 = new S3();
            $s3 = $s3->client();

            $result = $s3->deleteObject(array(
                    'Bucket' => 'opman-dbs',
                    'Key'    => 'tenant-' . tenant()['id'].'/'.$rec->backup
                ));        

        }


        $rec->delete();


        return true;
    }


    public function getAll($request)
    {
        $input = $request->all();

        $records = new $this->model();

        $records = $records->where('tenant', 'tenant-'.tenant()['id'])->orderBy('id', 'DESC');

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








}
