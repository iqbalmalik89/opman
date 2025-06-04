<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\MediaController;
use App\Http\Controllers\Backend\PeopleController;
use App\Http\Controllers\Backend\SubcontractorController;
use App\Http\Controllers\Backend\SiteController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ReportingController;
use App\Http\Controllers\Backend\CertificationController;
use App\Http\Controllers\Backend\DocumentController;
use App\Http\Controllers\Backend\SuboperativeDocumentController;
use App\Http\Controllers\Backend\TeamController;
use App\Http\Controllers\Backend\SuboperativeController;
use App\Http\Controllers\Backend\ProjectController;
use App\Http\Controllers\Backend\TenantController;
use App\Http\Controllers\Backend\BackupController;
use App\Http\Controllers\Front\FrontController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




Route::get('generate', function (){

        $service = new App\Services\TenantService;
        $service->test();




    die();

        $tenants = tenancy()->all();
        p($tenants);

    \Artisan::call('cache:clear');


   \Illuminate\Support\Facades\Artisan::call('storage:link');
    echo 'ok';
});


Route::get('/', [FrontController::class, 'showHome'])->name('show-home');



Route::prefix('admin')->group(function () {
    Route::get('/permseeder', [TenantController::class, 'permseeder'])->name('permseeder');


    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
    Route::get('/login', [UserController::class, 'showLogin'])->name('login');
    Route::get('/register', [UserController::class, 'showRegister'])->name('register');
    Route::get('request-password', [UserController::class, 'showRequestPassword'])->name('request-password');
    Route::get('reset-password/token/{token}', [UserController::class, 'showResetPasswordByToken'])->name('reset-password');


    Route::middleware('auth')->group(function () {

        // admin routes
        // Route::middleware(['role:admin'])->group(function () {
            // Route::get('/backup', [BackupController::class, 'backup'])->name('backup');
            Route::get('/users', [UserController::class, 'show'])->name('users');
            Route::get('/user/add', [UserController::class, 'add'])->name('create-user');
            Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('update-user');
            Route::get('/settings', [SettingController::class, 'showSettings'])->name('settings');
        // });

        Route::get('/suspend/{id}', [TenantController::class, 'suspend'])->name('suspend');
        Route::get('/unsuspend/{id}', [TenantController::class, 'unsuspend'])->name('unsuspend');

        Route::get('/dashboard', [ReportingController::class, 'showDashboard'])->middleware('can:view dashboard')->name('dashboard');    
        Route::get('/profile', [UserController::class, 'showProfile'])->name('profile');    
        Route::get('security', [UserController::class, 'showSecuirty'])->name('security');

        Route::get('secure/{id}', [TenantController::class, 'secureLogin'])->name('secure_login');


        Route::get('/customers', [CustomerController::class, 'show'])->name('customers');    
        Route::get('/customer/add', [CustomerController::class, 'add'])->name('create-customer');
        Route::get('/customer/edit/{id}', [CustomerController::class, 'edit'])->name('update-customer');

        Route::get('/tenants', [TenantController::class, 'show'])->name('tenants');    
        Route::get('/tenant/add', [TenantController::class, 'add'])->name('create-tenant');
        Route::get('/tenant/edit/{id}', [TenantController::class, 'edit'])->name('update-tenant');

        Route::get('/projects', [ProjectController::class, 'show'])->name('projects');    
        Route::get('/project/add', [ProjectController::class, 'add'])->name('create-project');
        Route::get('/project/edit/{id}', [ProjectController::class, 'edit'])->name('update-project');

        Route::get('/sites', [SiteController::class, 'show'])->name('sites');    
        Route::get('/site/search', [SiteController::class, 'search'])->name('site-search');
        Route::get('/site/add', [SiteController::class, 'add'])->name('create-site');
        Route::get('/site/edit/{id}', [SiteController::class, 'edit'])->name('update-site');

        Route::get('/subcontractors', [SubcontractorController::class, 'show'])->name('subcontractors');    
        Route::get('/subcontractor/search', [SubcontractorController::class, 'search'])->name('subcontractor-search');
        Route::get('/subcontractor/add', [SubcontractorController::class, 'add'])->name('create-subcontractor');
        Route::get('/subcontractor/edit/{id}', [SubcontractorController::class, 'edit'])->name('update-subcontractor');

        Route::get('/subcontractor/{id}/teams', [TeamController::class, 'show'])->name('teams');
        Route::get('/subcontractor/{id}/team/add', [TeamController::class, 'add'])->name('create-team');
        Route::get('/team/edit/{id}', [TeamController::class, 'edit'])->name('update-team');

        // Route::get('/manage-teams', [TeamController::class, 'showManageTeam'])->name('manage-team');


        Route::get('/teams', [TeamController::class, 'viewTeams'])->name('subcontractor-teams');


        Route::get('/subcontractor/{id}/suboperatives', [SuboperativeController::class, 'show'])->name('suboperatives');
        Route::get('/subcontractor/{id}/suboperative/add', [SuboperativeController::class, 'add'])->name('create-suboperative');

        Route::get('/suboperative/add', [SuboperativeController::class, 'addSuboperative'])->name('add-suboperative');


        Route::get('/suboperative/edit/{id}', [SuboperativeController::class, 'edit'])->name('update-suboperative');




        Route::get('/categories', [CategoryController::class, 'show'])->name('categories');    
        Route::get('/category/add', [CategoryController::class, 'add'])->name('create-category');        
        Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('update-category');
        Route::get('/category/{id}/certifications', [CertificationController::class, 'show'])->name('certifications');    
        Route::get('/category/{id}/certification/add', [CertificationController::class, 'add'])->name('create-certification');
        Route::get('/certification/edit/{id}', [CertificationController::class, 'edit'])->name('update-certification');

        Route::get('/peoplesearch', [PeopleController::class, 'showPeopleSearch'])->name('people');
        Route::get('/people-list', [PeopleController::class, 'show'])->name('people-list');
        Route::get('/add-people', [PeopleController::class, 'showAddPeople'])->name('create-people');
        Route::get('/people/edit/{id}', [PeopleController::class, 'showEditPeople'])->name('edit-people');



    });



});





Route::prefix('api')->group(function () {

    Route::post('user/login', [UserController::class, 'login']);

    Route::post('request-password', [UserController::class, 'requestPassword']);
    Route::put('reset-password/{token}', [UserController::class, 'resetPasswordByToken']);

    Route::post('tenant', [TenantController::class, 'save']);

    // Auth routes
    Route::middleware('auth')->group(function () {

        Route::put('profile', [UserController::class, 'updateProfile']);
        Route::put('security', [UserController::class, 'updateSecurity']);

        Route::post('user', [UserController::class, 'save']);
        Route::delete('user', [UserController::class, 'delete']);
        Route::post('user/{id}', [UserController::class, 'update']);
        Route::get('users', [UserController::class, 'getAll']);


        Route::delete('tenant', [TenantController::class, 'delete']);
        Route::put('tenant/{id}', [TenantController::class, 'update']);
        Route::get('tenants', [TenantController::class, 'getAll']);


        Route::post('customer', [CustomerController::class, 'save']);
        Route::delete('customer', [CustomerController::class, 'delete']);
        Route::put('customer/{id}', [CustomerController::class, 'update']);
        Route::get('customers', [CustomerController::class, 'getAll']);

        Route::put('project/status/change', [ProjectController::class, 'projectStatusChange']);


        Route::post('project', [ProjectController::class, 'save']);
        Route::delete('project', [ProjectController::class, 'delete']);
        Route::get('project/{id}', [ProjectController::class, 'get']);
        Route::delete('project/{id}', [ProjectController::class, 'delete']);
        Route::put('project/{id}', [ProjectController::class, 'update']);
        Route::get('projects', [ProjectController::class, 'getAll']);
        Route::post('project/assign', [ProjectController::class, 'assign']);
        Route::delete('project/assignment/{id}', [ProjectController::class, 'deleteAssignment']);
        Route::get('project/assignment/{id}', [ProjectController::class, 'getAssignment']);

        Route::post('site', [SiteController::class, 'save']);
        Route::delete('site', [SiteController::class, 'delete']);
        Route::get('site/{id}', [SiteController::class, 'get']);
        Route::put('site/{id}', [SiteController::class, 'update']);
        Route::get('sites', [SiteController::class, 'getAll']);

        Route::post('subcontractor', [SubcontractorController::class, 'save']);
        Route::delete('subcontractor', [SubcontractorController::class, 'delete']);
        Route::get('subcontractor/{id}', [SubcontractorController::class, 'get']);
        Route::get('subcontractor/{id}/teams', [SubcontractorController::class, 'getSubcontractorTeams']);
        Route::get('subcontractor/{id}/manage-teams', [SubcontractorController::class, 'manageSubcontractorTeams']);

        Route::put('subcontractor/{id}', [SubcontractorController::class, 'update']);
        Route::get('subcontractors', [SubcontractorController::class, 'getAll']);

        Route::post('media/upload', [MediaController::class, 'upload']);
        Route::put('setting/{id}', [SettingController::class, 'updateSettings']);


        Route::post('category', [CategoryController::class, 'save']);
        Route::delete('category', [CategoryController::class, 'delete']);
        Route::put('category/{id}', [CategoryController::class, 'update']);
        Route::get('categories', [CategoryController::class, 'getAll']);


        Route::post('certification', [CertificationController::class, 'save']);
        Route::delete('certification', [CertificationController::class, 'delete']);
        Route::put('certification/{id}', [CertificationController::class, 'update']);
        Route::get('certifications/{category_id}', [CertificationController::class, 'getAll']);

        Route::post('team', [TeamController::class, 'save']);
        Route::delete('team', [TeamController::class, 'delete']);
        Route::put('team/{id}', [TeamController::class, 'update']);
        Route::get('teams/{subcontractor_id}', [TeamController::class, 'getAll']);



        Route::post('suboperative', [SuboperativeController::class, 'addUpdateSuboperative']);
        Route::delete('suboperative', [SuboperativeController::class, 'delete']);
        Route::put('suboperative/{id}', [SuboperativeController::class, 'update']);
        Route::get('suboperatives/{subcontractor_id}', [SuboperativeController::class, 'getAll']);
        Route::delete('suboperatives/team/{team_id}', [SuboperativeController::class, 'deleteSuboperatives']);

        Route::get('/people/search', [PeopleController::class, 'searchPeople'])->name('search-people');
        Route::get('/people/{id}', [PeopleController::class, 'getPeopleDetail'])->name('get-people-detail');
        Route::get('peoples', [PeopleController::class, 'getAll']);

        Route::delete('/people', [PeopleController::class, 'delete'])->name('delete-people');

        Route::post('/people', [PeopleController::class, 'addUpdatePeople'])->name('add-update-people');


        Route::get('/document/cron', [DocumentController::class, 'expireCron'])->name('doc-cron');
        Route::post('/document/upload', [DocumentController::class, 'uploadDocument'])->name('upload-doc');

        Route::post('/document', [DocumentController::class, 'saveDoc'])->name('saveDoc');
        Route::get('/documents', [DocumentController::class, 'getAll'])->name('get-all-doc');
        Route::get('/document/{id}', [DocumentController::class, 'get'])->name('get-doc');
        Route::put('/document/{id}', [DocumentController::class, 'update'])->name('update-doc');
        Route::delete('/document/{id}', [DocumentController::class, 'delete'])->name('delete-doc');



        Route::get('/suboperative-document/cron', [SuboperativeDocumentController::class, 'expireCron'])->name('doc-cron');
        Route::post('/suboperative-document/upload', [SuboperativeDocumentController::class, 'uploadDocument'])->name('upload-doc');

        Route::post('/suboperative-document', [SuboperativeDocumentController::class, 'saveDoc'])->name('saveSuboperativeDoc');
        Route::get('/suboperative-documents', [SuboperativeDocumentController::class, 'getAll'])->name('get-all-suboperative-doc');
        Route::get('/suboperative-document/{id}', [SuboperativeDocumentController::class, 'get'])->name('get-suboperative-doc');
        Route::put('/suboperative-document/{id}', [SuboperativeDocumentController::class, 'update'])->name('update-suboperative-doc');
        Route::delete('/suboperative-document/{id}', [SuboperativeDocumentController::class, 'delete'])->name('delete-suboperative-doc');



        Route::put('/dl', [PeopleController::class, 'updateDl'])->name('update-dl');


    });
    
});

// function p($data)
// {
//     echo "<pre>";
//     print_r($data);
//     die();
// }