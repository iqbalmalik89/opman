<?php

namespace App\Listeners;

use Spatie\Backup\Events\BackupWasSuccessful;
use App\Models\Backup;


class BackupWasSuccessfulListner
{
    public function handle(BackupWasSuccessful $event)
    {
        // tenancy()->initialize(tenant());

        $file = $event->backupDestination->backups()->first();
        $fileName = trim(basename($file->path()), '/');
        exec('/usr/local/bin/aws s3 cp s3://opmandata/tenant-'.tenant()['id'].' s3://opman-backups/tenant-' . tenant()['id'].'/'.pathinfo($fileName, PATHINFO_FILENAME).' --recursive --acl public-read');

        $this->saveBackup(basename($file->path()));

    }

    public function saveBackup($fileName)
    {
        $rec = new Backup;
        $rec->tenant = 'tenant-' . tenant()['id'];
        $rec->backup = $fileName;

        $rec->save();
    }


}