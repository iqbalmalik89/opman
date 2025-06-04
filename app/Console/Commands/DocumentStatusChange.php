<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\DocumentService;
use App\Services\NotificationService;
// use Stancl\Tenancy\Concerns\TenantAwareCommand;
use App\Models\Tenant;

class DocumentStatusChange extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemanager:document-status-change';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */

    // protected function getTenants()
    // {
    //         $str = '';
    //         $tenants = Tenant::get()->pluck('id')->all();
    //         foreach ($tenants as $id) {
    //             $str .= " --tenants='{$id}'";
    //         }

    //         \Log::debug($str);


    //         p($str);
    //         return $str;

    //     // return Cache::remember('tenants-ids', now()->addHour(), function () {
    //     //     $str = '';
    //     //     foreach (Tenant::get()->pluck('id')->all() as $id) {
    //     //         $str .= " --tenants='{$id}'";
    //     //     }

    //     //     return $str;
    //     // });
    // }
    public function handle()
    {
        $notifservice = new NotificationService();
        $service = new DocumentService();
        $tenants = Tenant::get();
        foreach ($tenants as $key => $tenant) 
        {
            $tenant->run(function () use($service, $notifservice) {

                $service->expireCron('');
                $notifservice->sendDocNotifications();

            });

        }
    }
}
