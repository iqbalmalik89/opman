<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ProjectService;
// use Stancl\Tenancy\Concerns\TenantAwareCommand;
use App\Models\Tenant;

class ProjectStatusChange extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemanager:project-status-change';

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
        $service = new ProjectService();
        $tenants = Tenant::get();
        foreach ($tenants as $key => $tenant) 
        {
            $tenant->run(function () use($service) {

                $service->projectStatusChangeCron();

            });

        }
    }
}
