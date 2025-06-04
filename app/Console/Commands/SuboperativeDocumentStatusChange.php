<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\SuboperativeDocumentService;
use App\Models\Tenant;



class SuboperativeDocumentStatusChange extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemanager:suboperative-document-status-change';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change suboperative doc status';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $service = new SuboperativeDocumentService();

        $tenants = Tenant::get();
        foreach ($tenants as $key => $tenant) 
        {
            $tenant->run(function () use($service) {

                $service->expireCron('');

            });

        }



    }
}
