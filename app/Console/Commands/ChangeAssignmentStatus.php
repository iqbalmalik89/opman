<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\PeopleService;
// use Stancl\Tenancy\Concerns\TenantAwareCommand;
use App\Models\Tenant;

class ChangeAssignmentStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemanager:change-assignment-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change assisgnment status';

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
        $service = new PeopleService();
        $tenants = Tenant::get();
        foreach ($tenants as $key => $tenant) 
        {
            $tenant->run(function () use($service) {

                $service->changeAssignmentStatus();

            });

        }
    }
}
