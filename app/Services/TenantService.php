<?php

namespace App\Services;

use Illuminate\Foundation\Http\Kernel as HttpKernel;
use App\Models\Company;
use App\Models\Category;
use App\Models\Certification;
use App\Models\BasePermission;

use App\Models\Suboperative;
use App\Models\Tenant;
use App\Models\CentralUser;
use App\Models\User;
use App\Models\Setting;
use App\Models\People;
use App\Models\PasswordReset;
use App\Mail\CommonMail;
use App\Mail\PasswordRequest;
use App\Mail\ContactEmail;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\File; 
use App\Library\Utility;

class TenantService
{
    public $model;
    function __construct()
    {
        $this->model = '\\App\\Models\\Tenant';
    }


    public function get($col, $value, $detail = false)
    {
        $user =  $this->model::where($col, $value)->with('super_admin')->first();

        return $user;
    }

    
    public function getTenant($col, $value)
    {
        $user =  $this->model::where($col, $value)->first();
        return $user;
    }


    public function delete($id)
    {
        $data = $this->model::find($id);
        if(!empty($data))
        {
            $data->delete();
            
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

        $users = $this->model::with('super_admin');
        if(!empty($input['search']['value']))
        {
            $users = $users->where('name', 'LIKE', '%'.$input['search']['value'].'%'); 
        }

        if(empty($input['start']))
            $page = 1;
        else
            $page = ($input['start'] / $input['length']) + 1;

        Paginator::currentPageResolver(function () use ($page) {
            return $page;
        });



        $users = $users->paginate($input['length']);

        return $users;
    }

    public function setupRolePermissions()
    {
        $superAdmin = $this->createRole('super_admin');
        $admin = $this->createRole('admin');
        $manager = $this->createRole('manager');


        $saPermissions = \App\Library\Utility::getPermissions('super_admin');

        foreach ($saPermissions as $key => $permission) 
        {
            $superAdmin->givePermissionTo($permission);
        }

        $aPermissions = \App\Library\Utility::getPermissions('admin');
        foreach ($aPermissions as $key => $permission) 
        {
            $admin->givePermissionTo($permission);
        }

        $mPermissions = \App\Library\Utility::getPermissions('manager');
        foreach ($mPermissions as $key => $permission) 
        {
            $manager->givePermissionTo($permission);
        }



    }

    public function initials($name)
    {
        $words = explode(" ", $name);
        $acronym = "";

        foreach ($words as $w) {
          $acronym .= mb_substr($w, 0, 1);
        }        

        return $acronym;
    }

    public function tenantData()
    {
        $tenants = Tenant::get();
        foreach ($tenants as $key => &$tenant) 
        {
            tenancy()->initialize($tenant);
            $settings = Setting::first();
            if(!empty($settings->logo_img_path))
                $tenant->logo =  asset('site/' . $settings->logo_img_path);
            else
                $tenant->logo = '';

            $tenant->initials = $this->initials($tenant->id);
            $tenant->owner = User::role('super_admin')->first();
            $tenant->admins = User::role('admin')->get();
            $tenant->people_count = People::count();
            $tenant->suboperative_count = Suboperative::count();
            $tenant->login_url = route('login');
            $tenant->status = $tenant->status;
        }

        return $tenants;
    }

    public function save($request)
    {
        $permissions = \App\Library\Utility::getPermissions();
        $saPermissions = \App\Library\Utility::getPermissions('super_admin');
        $aPermissions = \App\Library\Utility::getPermissions('admin');
        $mPermissions = \App\Library\Utility::getPermissions('manager');



        $subdomain = strtolower(preg_replace( '/[^A-Za-z0-9]/', '', $request->company));
        $parsedUrl = parse_url(url(''));

        $companyUrl = $subdomain . '.' . $parsedUrl['host'] ;


        $tenant = Tenant::create(['id' => $request->company]);
        $tenant->domains()->create(['domain' => $companyUrl]);

        // create roles
        // $tenant->run(function () use ($permissions) {

        //     $this->createPermissions($permissions);

        //     $this->setupRolePermissions();

        // });

        $request->merge(['global_id' => time()]);



        \Storage::makeDirectory('tmp');
        $directories = \App\Library\Utility::directories();
        foreach($directories as $directory)
        {
            \Storage::makeDirectory($directory);
        }

        // create central user
        $centralUser = new CentralUser;
        $centralUser->global_id = $request->global_id;
        $centralUser->first_name = $request->first_name;
        $centralUser->last_name = $request->last_name;
        $centralUser->phone = $request->phone_full;
        $centralUser->email = $request->email;
        $centralUser->password = \Hash::make($request->password);
        $centralUser->save();

        tenancy()->initialize($tenant);

        $this->createPermissions($permissions);

        $superAdmin = $this->createRole('super_admin');
        $admin = $this->createRole('admin');
        $manager = $this->createRole('manager');


        // $saPermissions = \App\Library\Utility::getPermissions('super_admin');

        foreach ($saPermissions as $key => $permission) 
        {
            $superAdmin->givePermissionTo($permission);
        }

        // $aPermissions = \App\Library\Utility::getPermissions('admin');
        foreach ($aPermissions as $key => $permission) 
        {
            $admin->givePermissionTo($permission);
        }

        // $mPermissions = \App\Library\Utility::getPermissions('manager');
        foreach ($mPermissions as $key => $permission) 
        {
            $manager->givePermissionTo($permission);
        }


        $user = new User;
        $user->global_id = $request->global_id;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->phone = $request->phone_full;
        $user->email = $request->email;
        $user->password = \Hash::make($request->password);
        $user->two_fact_auth = 'email';
        $user->save();


        $cat = new Category;
        $cat->category = 'Driving License';
        $cat->save();

        $cert = new Certification;
        $cert->category_id = $cat->id;
        $cert->certification = 'Standard Vehicle';
        $cert->save();


        // attach role
        $user->assignRole('super_admin');

        $settingService = new SettingService;
        $settingService->save($request->company, $request->company, '');

        // create directories
        // \Storage::makeDirectory('public');

   


        return true;

        // $tenant->run(function () use ($request) {


        // });


        // $userService = new UserService();
        // // $rec = new $this->model;
        // // $rec = $this->setter($rec, $request);
        // // $rec->save();

        // // $request->merge(['company_id' => $rec->id]);
        // $request->merge(['role' => 'super_admin']);

        // // // save super admin
        // $user = $userService->save($request);
        // return true;
    }

    public function createPermissions($permissions)
    {

        foreach ($permissions as $key => $perm) 
        {
            $rec = new BasePermission;
            $rec->permission = $perm;
            $rec->save();

            $permission = Permission::create(['name' => $perm]);
        }
    }

    public function createRole($role)
    {
        $rec = new Role();
        $rec->name = $role;
        $rec->save(); 
        return $rec;
    }

    public function update($request, $id)
    {
        $userService = new UserService();

        $rec = $this->model::find($id);
        $rec = $this->setter($rec, $request);
        $rec->update();

        $request->merge(['company_id' => $rec->id]);
        $request->merge(['role' => 'super_admin']);

        // save super admin
        $user = $userService->update($request, $rec->super_admin->id);
 

        return true;
    }

    public function setter($user, $request)
    {
    }

    public function filters($input, $objects) {
        if (!empty($input['query'])) {
            $searchQuery = trim($input['query']['generalSearch']);
            $requestData = ['first_name', 'last_name', 'email'];
              $objects = $objects->where(function($q) use($requestData, $searchQuery) {
                                    foreach ($requestData as $field)
                                       $q->orWhere($field, 'like', "%{$searchQuery}%");
                            });   
        }

        if (!empty($input['sort'])) {
            $objects = $objects->orderBy($input['sort']['field'], $input['sort']['sort']);   
        }

        return $objects;
    }

    public function formatData($input, $objects, $objectIdsPaginate) {
        $data = ['data'=>[]];
        if (count($objects) > 0) {
            $i = 0;
            foreach ($objects as $object) {

                $objectData = $this->get('id',$object->id, true);
                $data['data'][$i] = $objectData;      
                $i++;
            }
        } 

        if(!empty($input['pagination']))
        {
            $data = Utility::paginator($data, $objectIdsPaginate, $input['pagination']['perpage']);
        }

        return $data;
    }

    public function permseeder()
    {
        // $ownerPermissions = \App\Library\Utility::getPermissions('manager');
        // p($ownerPermissions);

        // $permissions = \App\Library\Utility::getPermissions();
        // p(count($permissions));
        // foreach ($permissions as $key => $permission) 
        // {
        //     $rec = new BasePermission;
        //     $rec->permission = $permission;
        //     $rec->save();
        // }



        die();

        $this->createPermissions();
        $owner = Role::where('name', 'owner')->first();
        
        $ownerPermissions = \App\Library\Utility::getPermissions('owner');
        foreach ($ownerPermissions as $key => $permission) 
        {
            $owner->givePermissionTo($permission);
        }


        // $tenant = Tenant::where('id', 'jacka')->first();
        // tenancy()->initialize($tenant);
        // \Storage::makeDirectory('public');

        // $directories = \App\Library\Utility::directories();
        // foreach($directories as $directory)
        // {
        //     \Storage::makeDirectory('public/' . $directory);
        // }


        die();

        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        \DB::table('role_has_permissions')->truncate();
        \DB::table('users')->truncate();
        \DB::table('model_has_roles')->truncate();
        \DB::table('permissions')->truncate();


        $this->createPermissions();

        $owner = Role::where('name', 'owner')->first();
        $superAdmin = Role::where('name', 'super_admin')->first();
        $admin = Role::where('name', 'admin')->first();
        $manager = Role::where('name', 'manager')->first();;



        $ownerPermissions = \App\Library\Utility::getPermissions('owner');
        foreach ($ownerPermissions as $key => $permission) 
        {
            $owner->givePermissionTo($permission);
        }


        $saPermissions = \App\Library\Utility::getPermissions('super_admin');
        foreach ($saPermissions as $key => $permission) 
        {
            $superAdmin->givePermissionTo($permission);
        }

        $aPermissions = \App\Library\Utility::getPermissions('admin');
        foreach ($aPermissions as $key => $permission) 
        {
            $admin->givePermissionTo($permission);
        }

        $mPermissions = \App\Library\Utility::getPermissions('manager');
        foreach ($mPermissions as $key => $permission) 
        {
            $manager->givePermissionTo($permission);
        }



        $rec = new CentralUser;
        $rec->first_name = 'Jason';
        $rec->last_name = 'Bourne';
        $rec->email = 'owner@gmail.com';
        $rec->password = bcrypt('a');
        $rec->save();

        $rec->assignRole($owner);
        die();
        $rec = new CentralUser;
        $rec->first_name = 'James';
        $rec->last_name = 'Smith';
        $rec->email = 'super_admin@gmail.com';
        $rec->password = bcrypt('a');
        $rec->save();

        $rec->assignRole($superAdmin);

        $rec = new CentralUser;
        $rec->first_name = 'Hedi';
        $rec->last_name = 'Kiran';
        $rec->email = 'admin@gmail.com';
        $rec->password = bcrypt('a');
        $rec->save();

        $rec->assignRole($admin);

        $rec = new CentralUser;
        $rec->first_name = 'Las';
        $rec->last_name = 'Lukas';
        $rec->email = 'manager@gmail.com';
        $rec->password = bcrypt('a');
        $rec->save();

        $rec->assignRole($manager);


    }



    public function test()
    {
        $tenant = Tenant::create(['id' => time()]);
        $tenant->domains()->create(['domain' => time().'.local']);
        // tenancy()->initialize($tenant);        

        \Storage::makeDirectory('public');

        // $directories = \App\Library\Utility::directories();

        // foreach($directories as $directory)
        // {
        //     \Storage::makeDirectory('public/' . $directory);
        // }

    }

}
