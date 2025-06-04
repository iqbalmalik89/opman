<?php

declare(strict_types=1);

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
use App\Http\Controllers\Backend\TrainingController;
use App\Http\Controllers\Backend\ClientController;
use App\Http\Controllers\Backend\TeamTaskController;

use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use Stancl\Tenancy\Middleware\InitializeTenancyByPath;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

// p(\Storage::url('tenant-dem/documents/1722591344/DSCN9038-e1680638722107-66aca8786258f.jpg'));

// Route::get('/permseeder', [TenantController::class, 'permseeder'])->name('permseeder');

Route::get('generate', function (){


$postcode1='W1J0DB';
$postcode2='W23UW';
$result = array();

$url = "http://maps.googleapis.com/maps/api/distancematrix/json?origins=$postcode1&destinations=$postcode2&mode=bicycling&language=en-EN&sensor=false";

$data = @file_get_contents($url);

$result = json_decode($data, true);
p($result);



});


Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {

    // Route::get('/', function () {
    //     return 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id');
    // });


Route::get('/', function () {
    
    return redirect()->route('login');

});

Route::get('/secure', [UserController::class, 'secure'])->name('secure');
Route::get('/suspended', [UserController::class, 'suspended'])->name('suspended');


Route::prefix('admin')->group(function () {
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
    Route::get('/login', [UserController::class, 'showLogin'])->name('login');
    // Route::get('/register', [UserController::class, 'showRegister'])->name('register');
    Route::get('request-password', [UserController::class, 'showRequestPassword'])->name('request-password');
    Route::get('reset-password/token/{token}', [UserController::class, 'showResetPasswordByToken'])->name('reset-password');


    Route::middleware('auth')->group(function () {


            Route::get('/backup', [BackupController::class, 'show'])->name('backups');

        // admin routes
        // Route::middleware(['role:admin'])->group(function () {
            Route::get('/users', [UserController::class, 'show'])->middleware('can:view user listing')->name('users');
            Route::get('/user/add', [UserController::class, 'add'])->middleware('can:add user')->name('create-user');
            Route::get('/user/edit/{id}', [UserController::class, 'edit'])->middleware('can:update user')->name('update-user');
            Route::get('/settings', [SettingController::class, 'showSettings'])->middleware('can:view settings')->name('settings');
        // });

        Route::get('/banned', [PeopleController::class, 'showBanned'])->middleware('can:view settings')->name('banned');
        Route::get('/deactivated', [PeopleController::class, 'showDeactivated'])->middleware('can:view settings')->name('deactivated');


        Route::get('/dashboard', [ReportingController::class, 'showDashboard'])->middleware('can:view dashboard')->name('dashboard');    
        Route::get('/profile', [UserController::class, 'showProfile'])->name('profile');    
        Route::get('security', [UserController::class, 'showSecuirty'])->name('security');

        Route::get('/tenants', [TenantController::class, 'show'])->middleware('can:view companies')->name('tenants');    
        Route::get('/tenant/add', [TenantController::class, 'add'])->middleware('can:add company')->name('create-tenant');
        Route::get('/tenant/edit/{id}', [TenantController::class, 'edit'])->middleware('can:add company')->name('update-tenant');

        Route::get('/projects', [ProjectController::class, 'show'])->middleware('can:view projects')->name('projects');    
        Route::get('/project/add', [ProjectController::class, 'add'])->middleware('can:add project')->name('create-project');
        Route::get('/project/edit/{id}', [ProjectController::class, 'edit'])->middleware('can:update project')->name('update-project');
        Route::get('/project/archive', [ProjectController::class, 'showArchive'])->middleware('can:add project')->name('project-archive');

        Route::get('/trainings', [TrainingController::class, 'show'])->middleware('can:view projects')->name('trainings');    
        Route::get('/training/add', [TrainingController::class, 'add'])->middleware('can:add project')->name('create-training');
        Route::get('/training/edit/{id}', [TrainingController::class, 'edit'])->middleware('can:update project')->name('update-training');
        Route::get('/training/pdf/{id}', [TrainingController::class, 'pdf'])->middleware('can:update project')->name('pdf-training');

        Route::get('/sites', [SiteController::class, 'show'])->middleware('can:site listing')->name('sites');    
        Route::get('/site/search', [SiteController::class, 'search'])->middleware('can:site search')->name('site-search');
        Route::get('/site/add', [SiteController::class, 'add'])->middleware('can:add site')->name('create-site');
        Route::get('/site/edit/{id}', [SiteController::class, 'edit'])->middleware('can:update site')->name('update-site');

        Route::get('/subcontractors', [SubcontractorController::class, 'show'])->middleware('can:subcontractor listing')->name('subcontractors');    
        Route::get('/subcontractor/search', [SubcontractorController::class, 'search'])->middleware('can:subcontractor listing')->name('subcontractor-search');
        Route::get('/subcontractor/add', [SubcontractorController::class, 'add'])->middleware('can:add subcontractor')->name('create-subcontractor');
        Route::get('/subcontractor/edit/{id}', [SubcontractorController::class, 'edit'])->middleware('can:update subcontractor')->name('update-subcontractor');

        Route::get('/subcontractor/view/{id}', [SubcontractorController::class, 'view'])->name('view-subcontractor');


        Route::get('/subcontractor/{id}/teams', [TeamController::class, 'show'])->middleware('can:view subcontractor teams')->name('teams');
        Route::get('/subcontractor/{id}/team/add', [TeamController::class, 'add'])->middleware('can:add subcontractor team')->name('create-team');
        Route::get('/team/edit/{id}', [TeamController::class, 'edit'])->middleware('can:edit subcontractor team')->name('update-team');

        // Route::get('/manage-teams', [TeamController::class, 'showManageTeam'])->name('manage-team');


        Route::get('/teams', [TeamTaskController::class, 'viewTeams'])->middleware('can:view subcontractor teams')->name('subcontractor-teams');


        Route::get('/subcontractor/{id}/suboperatives', [SuboperativeController::class, 'show'])->middleware('can:view suboperatives of a subcontractor')->name('suboperatives');
        Route::get('/subcontractor/{id}/suboperative/add', [SuboperativeController::class, 'add'])->middleware('can:add suboperative')->name('create-suboperative');
        Route::get('/suboperative/add', [SuboperativeController::class, 'addSuboperative'])->middleware('can:add suboperative')->name('add-suboperative');
        Route::get('/suboperative/edit/{id}', [SuboperativeController::class, 'edit'])->middleware('can:view suboperatives of a subcontractor')->name('update-suboperative');
        Route::get('/subop-download/{id}', [SuboperativeController::class, 'downloadSubop'])->middleware('can:view suboperatives of a subcontractor')->name('subop-download');





        Route::get('/clients', [ClientController::class, 'show'])->name('clients');    
        Route::get('/client/add', [ClientController::class, 'add'])->name('create-client');        
        Route::get('/client/edit/{id}', [ClientController::class, 'edit'])->name('update-client');

        Route::get('/document/expired', [DocumentController::class, 'showExpired'])->name('expired');


        Route::get('/categories', [CategoryController::class, 'show'])->middleware('can:view category listing')->name('categories');    
        Route::get('/category/add', [CategoryController::class, 'add'])->middleware('can:add category')->name('create-category');        
        Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->middleware('can:update category')->name('update-category');
        Route::get('/category/{id}/certifications', [CertificationController::class, 'show'])->middleware('can:view certification')->name('certifications');    
        Route::get('/category/{id}/certification/add', [CertificationController::class, 'add'])->middleware('can:add certification')->name('create-certification');
        Route::get('/certification/edit/{id}', [CertificationController::class, 'edit'])->middleware('can:update certification')->name('update-certification');

        Route::get('/peoplesearch', [PeopleController::class, 'showPeopleSearch'])->middleware('can:people search')->name('people');


        Route::get('/active-people', [PeopleController::class, 'showActive'])->middleware('can:people listing')->name('active-people');
        Route::get('/inactive-people', [PeopleController::class, 'showInactive'])->middleware('can:people listing')->name('inactive-people');



        Route::get('/add-people', [PeopleController::class, 'showAddPeople'])->middleware('can:add people')->name('create-people');
        Route::get('/people/edit/{id}', [PeopleController::class, 'showEditPeople'])->middleware('can:people listing')->name('edit-people');
        Route::get('/people/download/{id}', [PeopleController::class, 'downloadPeople'])->middleware('can:people listing')->name('download-people');


    });



});





Route::prefix('api')->group(function () {

    Route::post('user/login', [UserController::class, 'login']);
    Route::post('user/verify', [UserController::class, 'verifyCode']);

    Route::post('request-password', [UserController::class, 'requestPassword']);
    Route::put('reset-password/{token}', [UserController::class, 'resetPasswordByToken']);

    Route::post('tenant', [TenantController::class, 'save']);

    // Auth routes
    Route::middleware('auth')->group(function () {

        Route::put('profile', [UserController::class, 'updateProfile']);
        Route::put('security', [UserController::class, 'updateSecurity']);

        Route::post('user', [UserController::class, 'save'])->middleware('can:add user');
        Route::delete('user', [UserController::class, 'delete'])->middleware('can:delete user');
        Route::post('user/{id}', [UserController::class, 'update'])->middleware('can:update user');
        Route::get('users', [UserController::class, 'getAll'])->middleware('can:view user listing');


        Route::delete('tenant', [TenantController::class, 'delete'])->middleware('can:add company');
        Route::put('tenant/{id}', [TenantController::class, 'update'])->middleware('can:add company');
        Route::get('tenants', [TenantController::class, 'getAll'])->middleware('can:view companies');

        Route::get('project/download/{id}', [ProjectController::class, 'projectDownload'])->middleware('can:change project status')->name('project-download');


        Route::put('project/status/change', [ProjectController::class, 'projectStatusChange'])->middleware('can:change project status');

        Route::post('project', [ProjectController::class, 'save'])->middleware('can:add project');
        Route::delete('project', [ProjectController::class, 'delete'])->middleware('can:delete project');
        Route::get('project/{id}', [ProjectController::class, 'get'])->middleware('can:view projects');
        Route::delete('project/{id}', [ProjectController::class, 'delete'])->middleware('can:delete project');
        Route::put('project/{id}', [ProjectController::class, 'update'])->middleware('can:update project');
        Route::get('projects', [ProjectController::class, 'getAll'])->middleware('can:view projects');

        Route::post('project/assign', [ProjectController::class, 'assign']);
        Route::delete('project/assignment/{id}', [ProjectController::class, 'deleteAssignment']);
        Route::get('project/assignment/{id}', [ProjectController::class, 'getAssignment']);

        Route::post('site', [SiteController::class, 'save'])->middleware('can:add site');
        Route::delete('site', [SiteController::class, 'delete'])->middleware('can:delete site');
        Route::get('site/{id}', [SiteController::class, 'get'])->middleware('can:site listing');
        Route::put('site/{id}', [SiteController::class, 'update'])->middleware('can:update site');
        Route::get('sites', [SiteController::class, 'getAll'])->middleware('can:site listing');


        Route::put('training/status', [TrainingController::class, 'changeTrainingStatus'])->middleware('can:view training');
        Route::get('training/{id}', [TrainingController::class, 'get'])->middleware('can:view training');
        Route::post('training', [TrainingController::class, 'save'])->middleware('can:add training');
        Route::delete('training/{id}', [TrainingController::class, 'delete'])->middleware('can:delete training');
        Route::get('trainings', [TrainingController::class, 'getAll'])->middleware('can:view training');

        Route::get('backups', [BackupController::class, 'getAll'])->middleware('can:view user listing');
        Route::post('backup', [BackupController::class, 'backup'])->middleware('can:add user');
        Route::delete('backup/{id}', [BackupController::class, 'delete'])->middleware('can:add user');
        Route::post('restore/{id}', [BackupController::class, 'restoreRequest'])->middleware('can:view user listing');


        Route::post('subcontractor', [SubcontractorController::class, 'save'])->middleware('can:add site');
        Route::delete('subcontractor', [SubcontractorController::class, 'delete'])->middleware('can:delete subcontractor');
        Route::get('subcontractor/{id}', [SubcontractorController::class, 'get'])->middleware('can:subcontractor listing');
        Route::get('subcontractor/{id}/teams', [SubcontractorController::class, 'getSubcontractorTeams'])->middleware('can:view subcontractor teams');
        Route::get('subcontractor/{id}/manage-teams', [SubcontractorController::class, 'manageSubcontractorTeams'])->middleware('can:view subcontractor teams');

        Route::put('subcontractor/{id}', [SubcontractorController::class, 'update'])->middleware('can:update subcontractor');
        Route::get('subcontractors', [SubcontractorController::class, 'getAll'])->middleware('can:subcontractor listing');

        Route::post('media/upload', [MediaController::class, 'upload']);

        Route::put('setting/alert', [SettingController::class, 'alertSettings'])->middleware('can:update settings');

        Route::put('setting/{id}', [SettingController::class, 'updateSettings'])->middleware('can:update settings');

        Route::post('client', [ClientController::class, 'save']);
        Route::delete('client', [ClientController::class, 'delete']);
        Route::put('client/{id}', [ClientController::class, 'update']);
        Route::get('clients', [ClientController::class, 'getAll']);

        Route::get('teamtask/form', [TeamTaskController::class, 'get']);


        Route::post('category', [CategoryController::class, 'save'])->middleware('can:add category');
        Route::delete('category', [CategoryController::class, 'delete'])->middleware('can:delete category');
        Route::put('category/{id}', [CategoryController::class, 'update'])->middleware('can:update category');
        Route::get('categories', [CategoryController::class, 'getAll'])->middleware('can:view category listing');

        Route::post('certification', [CertificationController::class, 'save'])->middleware('can:add certification');
        Route::delete('certification', [CertificationController::class, 'delete'])->middleware('can:delete certification');
        Route::put('certification/{id}', [CertificationController::class, 'update'])->middleware('can:update certification');
        Route::get('certifications/{category_id}', [CertificationController::class, 'getAll'])->middleware('can:view certification');

        Route::post('team', [TeamController::class, 'save'])->middleware('can:add subcontractor team');
        Route::delete('team', [TeamController::class, 'delete'])->middleware('can:delete subcontractor team');
        Route::put('team/{id}', [TeamController::class, 'update'])->middleware('can:edit subcontractor team');
        Route::get('teams/{subcontractor_id}', [TeamController::class, 'getAll'])->middleware('can:view subcontractor teams');



        Route::post('suboperative', [SuboperativeController::class, 'addUpdateSuboperative'])->middleware('can:add suboperative');
        Route::delete('suboperative', [SuboperativeController::class, 'delete'])->middleware('can:delete suboperative');
        Route::put('suboperative/{id}', [SuboperativeController::class, 'update'])->middleware('can:update suboperative');
        Route::get('suboperatives/{subcontractor_id}', [SuboperativeController::class, 'getAll'])->middleware('can:view suboperatives of a subcontractor');
        Route::delete('suboperatives/team/{team_id}', [SuboperativeController::class, 'deleteSuboperatives'])->middleware('can:delete suboperative');



        Route::get('people/banned', [PeopleController::class, 'getBanned'])->name('get-banned');
        Route::get('people/deactivated', [PeopleController::class, 'getDeactivated'])->name('get-deactivated');
        Route::put('people/status', [PeopleController::class, 'changeStatus'])->name('get-expired');
        Route::get('people/documents/expired', [DocumentController::class, 'getExpired'])->name('get-expired');
        Route::get('suboperative/documents/expired', [SuboperativeDocumentController::class, 'getExpired'])->name('get-subop-expired');

        Route::get('/people/search', [PeopleController::class, 'searchPeople'])->middleware('can:people search')->name('search-people');
        Route::get('/people/{id}', [PeopleController::class, 'getPeopleDetail'])->middleware('can:people listing')->name('get-people-detail');
        Route::get('peoples', [PeopleController::class, 'getAll'])->middleware('can:people listing');



        Route::delete('/people', [PeopleController::class, 'delete'])->middleware('can:delete people')->name('delete-people');

        Route::post('/people', [PeopleController::class, 'addUpdatePeople'])->middleware('can:add people')->name('add-update-people');


        Route::get('/document/cron', [DocumentController::class, 'expireCron'])->name('doc-cron');
        Route::post('/document/upload', [DocumentController::class, 'uploadDocument'])->name('upload-doc');

        Route::post('/document', [DocumentController::class, 'saveDoc'])->middleware('can:add people document')->name('saveDoc');
        Route::get('/documents', [DocumentController::class, 'getAll'])->middleware('can:view people document')->name('get-all-doc');
        Route::get('/document/{id}', [DocumentController::class, 'get'])->middleware('can:view people document')->name('get-doc');
        Route::put('/document/{id}', [DocumentController::class, 'update'])->name('update-doc');
        Route::delete('/document/{id}', [DocumentController::class, 'delete'])->middleware('can:delete people document')->name('delete-doc');


        Route::post('/teamtask', [TeamTaskController::class, 'save'])->middleware('can:add people document')->name('save-task');
        Route::get('/teamtasks', [TeamTaskController::class, 'getAll'])->middleware('can:add people document')->name('save-task');
        Route::delete('/teamtask', [TeamTaskController::class, 'delete'])->middleware('can:add people document')->name('save-task');
        Route::put('teamtask/{id}', [TeamTaskController::class, 'update']);
        Route::get('/teamtask/{id}/suboperatives', [TeamTaskController::class, 'getTaskSubops'])->middleware('can:add people document')->name('view-subops');
        Route::delete('/teamtask/{id}/suboperative', [TeamTaskController::class, 'deleteTaskSubop'])->middleware('can:add people document')->name('delete-subops');





        Route::get('/suboperative-document/cron', [SuboperativeDocumentController::class, 'expireCron'])->middleware('can:delete people document')->name('doc-cron');
        Route::post('/suboperative-document/upload', [SuboperativeDocumentController::class, 'uploadDocument'])->name('upload-doc');

        Route::post('/suboperative-document', [SuboperativeDocumentController::class, 'saveDoc'])->middleware('can:upload suboperative document')->name('saveSuboperativeDoc');
        Route::get('/suboperative-documents', [SuboperativeDocumentController::class, 'getAll'])->middleware('can:view suboperative document')->name('get-all-suboperative-doc');
        Route::get('/suboperative-document/{id}', [SuboperativeDocumentController::class, 'get'])->middleware('can:view suboperative document')->name('get-suboperative-doc');
        Route::put('/suboperative-document/{id}', [SuboperativeDocumentController::class, 'update'])->middleware('can:upload suboperative document')->name('update-suboperative-doc');
        Route::delete('/suboperative-document/{id}', [SuboperativeDocumentController::class, 'delete'])->middleware('can:delete suboperative document')->name('delete-suboperative-doc');


        Route::get('/stats', [ReportingController::class, 'dashboardStats'])->middleware('can:view dashboard');


        Route::put('/dl', [PeopleController::class, 'updateDl'])->name('update-dl');


    });
    
});

});
