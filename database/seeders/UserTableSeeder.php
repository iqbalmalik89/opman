<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        \DB::table('role_has_permissions')->truncate();

        Permission::truncate();


        
















        $permission = Permission::create(['name' => 'view dashbard']);
        $permission = Permission::create(['name' => 'people search']);
        $permission = Permission::create(['name' => 'add people']);
        $permission = Permission::create(['name' => 'update people']);
        $permission = Permission::create(['name' => 'delete people']);
        $permission = Permission::create(['name' => 'add people document']);
        $permission = Permission::create(['name' => 'edit people document']);
        $permission = Permission::create(['name' => 'delete people document']);
        $permission = Permission::create(['name' => 'site search']);
        $permission = Permission::create(['name' => 'add site']);
        $permission = Permission::create(['name' => 'update site']);
        $permission = Permission::create(['name' => 'delete site']);
        $permission = Permission::create(['name' => 'people listing']);
        $permission = Permission::create(['name' => 'site listing']);
        $permission = Permission::create(['name' => 'subcontractor listing']);
        $permission = Permission::create(['name' => 'add subcontractor']);
        $permission = Permission::create(['name' => 'delete subcontractor']);
        $permission = Permission::create(['name' => 'update subcontractor']);
        $permission = Permission::create(['name' => 'view suboperatives of a subcontractor']);
        $permission = Permission::create(['name' => 'update suboperative']);
        $permission = Permission::create(['name' => 'add suboperative']);
        $permission = Permission::create(['name' => 'delete suboperative']);
        $permission = Permission::create(['name' => 'upload suboperative document']);
        $permission = Permission::create(['name' => 'delete suboperative document']);
        $permission = Permission::create(['name' => 'view suboperative document']);
        $permission = Permission::create(['name' => 'add project']);
        $permission = Permission::create(['name' => 'update project']);
        $permission = Permission::create(['name' => 'delete project']);
        $permission = Permission::create(['name' => 'change project status']);
        $permission = Permission::create(['name' => 'view projects']);
        $permission = Permission::create(['name' => 'view category listing']);
        $permission = Permission::create(['name' => 'add category']);
        $permission = Permission::create(['name' => 'update category']);
        $permission = Permission::create(['name' => 'delete category']);
        $permission = Permission::create(['name' => 'add certification']);
        $permission = Permission::create(['name' => 'view certification']);
        $permission = Permission::create(['name' => 'delete certification']);
        $permission = Permission::create(['name' => 'update certification']);

        // only admin perm starts
        $permission = Permission::create(['name' => 'view settings']);
        $permission = Permission::create(['name' => 'update settings']);
        $permission = Permission::create(['name' => 'view user listing']);
        $permission = Permission::create(['name' => 'add user']);
        $permission = Permission::create(['name' => 'update user']);
        $permission = Permission::create(['name' => 'delete user']);
        // only admin perm end

        $permission = Permission::create(['name' => 'view subcontractor teams']);
        $permission = Permission::create(['name' => 'add subcontractor team']);
        $permission = Permission::create(['name' => 'edit subcontractor team']);
        $permission = Permission::create(['name' => 'delete subcontractor team']);        

        $permission = Permission::create(['name' => 'view companies']);        
        $permission = Permission::create(['name' => 'add company']);        
        $permission = Permission::create(['name' => 'suspend company account']);        
        $permission = Permission::create(['name' => 'backup company data']);        
        $permission = Permission::create(['name' => 'backup all companies data']);                

        $permission = Permission::create(['name' => 'client listing']);
        $permission = Permission::create(['name' => 'add client']);
        $permission = Permission::create(['name' => 'delete client']);
        $permission = Permission::create(['name' => 'update client']);

        $permission = Permission::create(['name' => 'training listing']);
        $permission = Permission::create(['name' => 'add training']);
        $permission = Permission::create(['name' => 'delete training']);
        $permission = Permission::create(['name' => 'update training']);





        $superAdmin = Role::find(1);
        $admin = Role::find(2);
        $manager = Role::find(3);



        // $permissions = Permission::get();
        // foreach ($permissions as $key => $permission) 
        // {

        //     $company->givePermissionTo($permission->name);

        //     if(!in_array($permission->name, ['view settings', 'update settings', 'view user listing', 'add user', 'update user', 'delete user']))
        //     {
        //         $admin->givePermissionTo($permission->name);
        //     }


        //     if(!in_array($permission->name, ['view companies', 'add company', 'suspend company account', 'backup company data', 'backup all companies data']))
        //     {
        //         $admin->givePermissionTo($permission->name);
        //     }


        //     if(in_array($permission->name, ['subcontractor listing', 'training listing','view dashbard', 'people search', 'site search', 'people listing', 'site listing', 'view projects', 'view subcontractor teams']))
        //     {
        //         $manager->givePermissionTo($permission->name);
        //     }

        // }











        
        // $user = new User();
        // $user->first_name = 'Jason';
        // $user->last_name = 'Bourne';
        // $user->email = 'jasonbourne501@gmail.com';
        // $user->password = bcrypt('Qwerty89!');
        // $user->save();

        // $manager = new User();
        // $manager->first_name = 'Jason';
        // $manager->last_name = 'Bourne';
        // $manager->email = 'manager@gmail.com';
        // $manager->password = bcrypt('Qwerty89!');
        // $manager->save();


        // $engineer = new User();
        // $engineer->first_name = 'Jason';
        // $engineer->last_name = 'Bourne';
        // $engineer->email = 'engineer@gmail.com';
        // $engineer->password = bcrypt('Qwerty89!');
        // $engineer->save();


        // $owner = new Role();
        // $owner->name         = 'admin';
        // $owner->save(); 

        // $user->assignRole($owner);

        // $engineerRole = new Role();
        // $engineerRole->name         = 'engineer';
        // $engineerRole->save(); 

        // $engineer->assignRole($engineerRole);

        // $managerRole = new Role();
        // $managerRole->name         = 'manager';
        // $managerRole->save(); 

        // $manager->assignRole($managerRole);

        // $manager->assignRole($managerRole);





        Artisan::call('php artisan cache:forget spatie.permission.cache');

        


    }
}
