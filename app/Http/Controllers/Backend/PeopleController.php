<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Services\PeopleService;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use App\Library\ModuleConfig;
use App\Http\Requests\PeopleRequest;
use Illuminate\Support\Facades\Redirect;


class PeopleController extends Controller
{
	public $service;
    public $module;
	function __construct(PeopleService $service, CategoryService $catService)
	{
		$this->service = $service;
        $this->catService = $catService;

        $GLOBALS['module'] = 'people';
	}

    public function downloadPeople($peopleId)
    {
        $archive = $this->service->downloadPeople($peopleId);

        header("Content-type: application/zip"); 
        header("Content-Disposition: attachment; filename=".basename($archive));
        header("Content-length: " . filesize(storage_path('/'.$archive)));
        header("Pragma: no-cache"); 
        header("Expires: 0"); 
        readfile(storage_path('/'.$archive));

        if(!empty($archive))
            unlink(storage_path('/'.$archive));
        // return Redirect::to(asset('zip/'. basename($archive)));
    }



    function changeStatus(PeopleRequest $request)
    {
        $resp = $this->service->changeStatus($request);

        if($resp)
        {
            return response()->json([
                'status' => 'success',
                'code' => 200,
                'message' => 'Status changed'
            ], 200);
        }
        else
        {
            return response()->json([
                'status' => 'error',
                'message' => 'error occurred'
            ], 400);
        }               
    }

    function addUpdatePeople(PeopleRequest $request)
    {
        $exists = $this->service->get('email', $request->email);

        if(!empty($exists) && in_array($exists->status, ['Banned', 'Deactivated']))
        {
            return response()->json([
                'status' => 'error',
                'code' => 200,
                'message' => 'User exists with status ' . $exists->status
            ], 200);

        }
        else
        {
            $request->merge(['user_id' => Auth::user()['id']]);
            //$request->merge(['param' => 'photo']);

            $resp = $this->service->addUpdatePeople($request);

            if($resp)
            {
                return response()->json([
                    'id' => $resp->id,
                    'status' => 'success',
                    'code' => 200,
                    'message' => 'People saved'
                ], 200);
            }
            else
            {
                return response()->json([
                    'status' => 'error',
                    'message' => 'error occurred'
                ], 400);
            }               

        }
    }

    public function showAddPeople()
    {
        $title = 'Add People';
        $categories = $this->catService->getAllCat();
        return view('backend.'.$GLOBALS['module'] .'.add-people', ['people' => new \StdClass, 'data' => [], 'title' => $title, 'categories' => $categories]);
    }


    public function showPeopleSearch()
    {
        $categories = $this->catService->getAllCat();
        $title = 'People Search';
        return view('backend.'.$GLOBALS['module'] .'.search', ['title' => $title, 'categories' => $categories, 'data' => '']);
    }



    public function showEditPeople($id)
    {
        $people = $this->service->get('id', $id);
        $holidays = $this->service->getHolidays($id);
//        $peopleCat = \App\Library\Utility::getCats();
        $categories = $this->catService->getAllCat();
        $title = 'Edit People';
        return view('backend.'.$GLOBALS['module'].'.add-people', ['title' => $title, 'data' => $people,  'categories' => $categories,  'holidays' => $holidays]);
    }

    public function showActive()
    {
        return view('backend.'.$GLOBALS['module'] .'.listing', ['type' => 'active']);
    }

    public function showInactive()
    {
        return view('backend.'.$GLOBALS['module'] .'.listing', ['type' => 'inactive']);
    }

    public function add(Request $request)
    {
        return view('backend.'.$GLOBALS['module'] .'.form', ['data' => '']);       
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



    public function save(Request $request)
    {

        $response = $this->service->save($request);

        if($response)
        {
            return response()->json([
                'status' => 'success',
                'code' => 200,
                'message' => ModuleConfig::getModuleConfig($GLOBALS['module'])['module_name'].' added successfully'
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

    public function update(Request $request, $id)
    {
        $response = $this->service->update($request, $id);

        if($response)
        {
            return response()->json([
                'status' => 'success',
                'code' => 200,
                'message' => ModuleConfig::getModuleConfig($GLOBALS['module'])['module_name']. ' has been updated successfully',
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



    public function getBanned(Request $request)
    {
        $response = $this->service->getBanned($request);
        if($response)
        {
            return response()->json([
                'recordsTotal' => $response->total(),
                'recordsFiltered' => $response->total(),
                'data' => $response->items(),
                'status' => 'success',
                'code' => 200,
                'message' => ModuleConfig::getModuleConfig($GLOBALS['module'])['plural'].' fetched successfully'
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
        if($response)
        {
            return response()->json([
                'recordsTotal' => $response->total(),
                'recordsFiltered' => $response->total(),
                'data' => $response->items(),
                'status' => 'success',
                'code' => 200,
                'message' => ModuleConfig::getModuleConfig($GLOBALS['module'])['plural'].' fetched successfully'
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


    public function get($id)
    {
        $response = $this->service->get('id', $id);

        if($response)
        {
            return response()->json([
                'data' => $response,
                'status' => 'success',
                'code' => 200,
                'message' => ModuleConfig::getModuleConfig($GLOBALS['module'])['module_name']. ' fetched successfully'
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



    function getPeopleDetail($id)
    {
        $people = $this->service->get('id', $id);

        $html = view('backend.'.$GLOBALS['module'] .'.people-detail', compact('people'))->render();


        if($html)
        {
            return response()->json([
                'status' => 'success',
                'html'=> $html,
                'data' => $people,
                'code' => 200,
                'message' => 'People fetched'
            ], 200);
        }
        else
        {
            return response()->json([
                'status' => 'error',
                'message' => 'error occurred'
            ], 400);
        }               
    }


    function searchPeople(Request $request)
    {
        $resp = $this->service->searchPeople($request);

            return response()->json([
                'status' => 'success',
                'data'=> $resp,
                'code' => 200,
                'message' => 'People searched'
            ], 200);

        // if(!empty($resp))
        // {
        //     return response()->json([
        //         'status' => 'success',
        //         'data'=> $resp,
        //         'code' => 200,
        //         'message' => 'People searched'
        //     ], 200);
        // }
        // else
        // {
        //     return response()->json([
        //         'status' => 'error',
        //         'data'=> $resp,                
        //         'message' => 'error occurred'
        //     ], 200);
        // }               
    }


    public function showBanned()
    {
        return view('backend.'.$GLOBALS['module'] .'.banned', []);         
    }

    public function showDeactivated()
    {
        return view('backend.'.$GLOBALS['module'] .'.deactivated', []);         
    }



    public function getDeactivated(Request $request)
    {
        $response = $this->service->getDeactivated($request);
        if($response)
        {
            return response()->json([
                'recordsTotal' => $response->total(),
                'recordsFiltered' => $response->total(),
                'data' => $response->items(),
                'status' => 'success',
                'code' => 200,
                'message' => ModuleConfig::getModuleConfig($GLOBALS['module'])['plural'].' fetched successfully'
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
