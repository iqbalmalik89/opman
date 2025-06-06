<?php

namespace App\Services;

use Illuminate\Foundation\Http\Kernel as HttpKernel;
use App\Models\SubcontractorContact;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;
use App\Library\Utility;

class SubcontractorService
{
    public $model;
    function __construct()
    {
        $this->model = '\\App\\Models\\Subcontractor';
    }

    public function getAllSubcontractors()
    {
        $rec =  $this->model::get();

        return $rec;
    }

    public function getSubcontractorTeams($subcontractorId)
    {
        $teamService = new TeamService;
        $teams = $teamService->getAllTeams($subcontractorId);
        
        return $teams;
    }


    public function get($col, $value, $detail = false)
    {
        $rec =  $this->model::where($col, $value)->first();

        return $rec;
    }

    public function getContacts($subcontractorId)
    {
        $rec =  SubcontractorContact::where('subcontractor_id', $subcontractorId)->get();

        return $rec;
    }

    public function deleteContacts($subcontractorId)
    {
        SubcontractorContact::where('subcontractor_id', $subcontractorId)->delete();
    }
    
    public function addContact($subcontractorId, $name, $mobile, $email, $position)
    {
        $contact = new SubcontractorContact;
        $contact->subcontractor_id = $subcontractorId;
        $contact->name = $name;
        $contact->mobile = $mobile;
        $contact->email = $email;
        $contact->position = $position;
        $contact->save();
        return $contact;
    }

    public function deleteGrossFile($file)
    {
        if(!empty($file))
        {

            $path = 'gross-status/'.$file;
            if(\Storage::disk('s3')->exists($path))
                \Storage::delete($path);



        }

    }


    public function delete($id)
    {
        $data = $this->model::find($id);
        if(!empty($data))
        {
            $data->delete();

            $this->deleteContacts($id);

            // delete gross file
            $this->deleteGrossFile($data->gross_status_path);

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

        $records = new $this->model;

        if(!empty($input['search']['value']))
            $searchTerm = $input['search']['value'];

        if(!empty($input['search_term']))
            $searchTerm = $input['search_term'];

        if(!empty($searchTerm))
        {
            $records = $records->where('name', 'LIKE', '%'.$searchTerm.'%'); 
        }



        if(empty($input['nopage']))
        {

            if(empty($input['start']))
                $page = 1;
            else
                $page = ($input['start'] / $input['length']) + 1;

            Paginator::currentPageResolver(function () use ($page) {
                return $page;
            });



            $records = $records->paginate($input['length']);            
        }
        else
        {
            $records = $records->get();

        }


        return $records;
    }

    public function save($request)
    {
        $teamService = new TeamService;
        $rec = new $this->model;
        $rec = $this->setter($rec, $request);
        $rec->save();

        // add contacts
        foreach ($request->name as $key => $name) 
        {
            if(!empty($name))
            {
                $this->addContact($rec->id, $name, $request->mobile[$key], $request->email[$key], $request->position[$key]);
            }
        }


        // Create teams
        // foreach(range(1,10) as $team)
        // {
        //     $request->merge(['team' => 'Team '. $team]);
        //     $request->merge(['subcontractor_id' => $rec->id]);
        //     $teamService->save($request);
        // }

        return $rec;
    }

    public function update($request, $id)
    {
        $rec = $this->model::find($id);
        $rec = $this->setter($rec, $request);
        $rec->update();

        // add contacts

        $this->deleteContacts($id);
        if(!empty($request->name))
        {
    
            foreach ($request->name as $key => $name) 
            {
                if(!empty($name))
                {
                    $this->addContact($rec->id, $name, $request->mobile[$key], $request->email[$key], $request->position[$key]);
                }
            }

        }


        return $rec;
    }

    public function setter($rec, $request)
    {

        $mediaService = new MediaService;

        if(!empty($request->gross_status_path))
        {
            $request->gross_status_path = ltrim($request->gross_status_path, ',');

            $destination = 'gross-status/'.$request->gross_status_path;

            if(\Storage::disk('s3')->exists('tmp/'.$request->gross_status_path))
            {
                $mediaService->moveFile('tmp/'.$request->gross_status_path, $destination);            
            
                if($rec->gross_status_path != $request->gross_status_path)
                    $this->deleteGrossFile($rec->gross_status_path);

            }

            $rec->gross_status_path = $request->gross_status_path;

        }
        else
        {
            if(!empty($rec->gross_status_path) &&  \Storage::disk('s3')->exists('gross-status/'.$request->gross_status_path))
            {
                $this->deleteGrossFile($rec->gross_status_path);
            }
            
            $rec->gross_status_path = null;            
        }


        $rec->name = $request->subcontractor_name;
        $rec->company_number = $request->company_number;
        $rec->address1 = $request->address1;
        $rec->address2 = $request->address2;
        $rec->postcode = $request->postcode;
        return $rec;
    }


}
