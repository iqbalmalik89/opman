<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Services\TenantService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use App\Http\Requests\TenantRequest;
use Illuminate\Support\Facades\Crypt;
use App\Models\Tenant;
use App\Models\User;

class TenantController extends Controller
{
	public $service;
    public $module;
	function __construct(TenantService $service)
	{
		$this->service = $service;
        $GLOBALS['module'] = 'company';

	}

    public function secureLogin($id)
    {
        $tenant = Tenant::where('id', $id)->first();

        tenancy()->initialize($tenant);

        $superAdmin = User::role('super_admin')->first();
 
        $resp = ['token' => Crypt::encryptString($superAdmin->global_id),
                'url' => tenant_route($tenant->domains[0]->domain, 'secure')
                ];

        $redUrl = $resp['url'] . '?token=' . $resp['token'];                            

        return redirect($redUrl);

    }

    public function suspend($tenantId)
    {
        // $tenant = Tenant::find($tenantId);

        // $tenant->update([
        //     'status' => 'Suspended', // stored in the `data` JSON column
        // ]);

        \DB::statement("update tenants set status='Suspended' where id=" . "'".$tenantId. "'");

        // $rec = Tenant::find($tenantId);
        // p($rec->data);
        // if(!empty($rec))
        // {
        //     $rec->status = 'Suspended';
        //     $rec->update();
        // }

        // \DB::statement("update tenants set status='Suspended' where id='nazan'");
        
        // // $rec = \DB::table('tenants')
        // //         ->where('id', $tenantId)
        // //         ->update(['status' =>'Suspended']);


        return redirect()->route('tenants');

    }

    public function unsuspend($tenantId)
    {
        // $rec = $this->service->getTenant('id', $tenantId);
        // if(!empty($rec))
        // {
        //     $rec->status = 'Active';
        //     $rec->update();
        // }

        // \DB::statement("update tenants set status='Active' where id='nazan'");

        // $tenant = Tenant::find($tenantId);

        // $tenant->update([
        //     'status' => 'Active', // stored in the `data` JSON column
        // ]);

        \DB::statement("update tenants set status='Active' where id=" . "'".$tenantId. "'");


        return redirect()->route('tenants');

    }

    public function show()
    {
        $tenants = $this->service->tenantData();

        $title = 'Companies';
        return view('backend.'.$GLOBALS['module'] .'.listing', ['title' => $title, 'tenants' => $tenants]);
    }

    public function add(Request $request)
    {
        $data = ['data' => ''];
        return view('backend.'.$GLOBALS['module'] .'.form', $data);       
    }

    public function edit($id)
    {
        $rec = $this->service->get('id', $id, true);

        if (!empty($rec)) {
            $data = ['data' => $rec];
            return view('backend.'.$GLOBALS['module'] .'.form', $data); 
        } else {
            abort(404);
        }      
    }



    public function save(TenantRequest $request)
    {
        $response = $this->service->save($request);

        if($response)
        {
            return response()->json([
                'status' => 'success',
                'code' => 200,
                'message' => 'Company Added successfully'
            ], 200);
        }
        else
        {
            return response()->json([
                'status' => 'error',
                'message' => 'Some error Occurred',
            ], 200);
        }
    }

    public function update(TenantRequest $request, $id)
    {
        $response = $this->service->update($request, $id);

        if($response)
        {
            return response()->json([
                'status' => 'success',
                'code' => 200,
                'message' => 'Company updated successfully',
            ], 200);
        }
        else
        {
            return response()->json([
                'status' => 'error',
                'message' => \Lang::get('user.error_occurred'),
            ], 200);
        }
    }

    public function permseeder()
    {
        $response = $this->service->permseeder();
    }

    public function delete(Request $request)
    {
        $s = '';
        if(is_array($request->id) && !empty($request->id))
        {
            $s = 's';
            foreach($request->id as $id)
            {
                $response = $this->service->delete($id);
            }
        }
        else
        {
                $response = $this->service->delete($request->id);                
        }

        if($response)
        {
            return response()->json([
                'status' => 'success',
                'code' => 200,
                'message' => 'Record.'.$s.' has been deleted successfully',
            ], 200);
        }
        else
        {
            return response()->json([
                'status' => 'error',
                'message' => 'Some error occurred',
            ], 200);
        }
    }

    public function getAll(Request $request)
    {
        $response = $this->service->getAll($request);
        //p($response);
        if($response)
        {
            return response()->json([
                'recordsTotal' => $response->total(),
                'recordsFiltered' => $response->total(),
                'data' => $response->items(),
                'status' => 'success',
                'code' => 200,
                'message' => 'Users fetched successfully'
            ], 200);
        }
        else
        {
            return response()->json([
                'status' => 'error',
                'message' => 'Some error occurred',
            ], 200);
        }
    }



}
