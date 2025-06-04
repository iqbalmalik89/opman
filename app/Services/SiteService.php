<?php

namespace App\Services;

use Illuminate\Foundation\Http\Kernel as HttpKernel;
use App\Models\Site;
use App\Models\SiteContact;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;
use App\Library\Utility;

class SiteService
{
    public $model;
    function __construct()
    {
        $this->model = '\\App\\Models\\Site';
    }

    public function get($col, $value, $detail = false)
    {
        $rec =  $this->model::where($col, $value)->first();

        return $rec;
    }

    public function getAllSites()
    {
        $rec =  $this->model::get();

        return $rec;
    }

    public function getContacts($siteId)
    {
        $rec =  SiteContact::where('site_id', $siteId)->get();

        return $rec;
    }

    public function deleteContacts($siteId)
    {
        SiteContact::where('site_id', $siteId)->delete();
    }
    
    public function addContact($siteId, $name, $mobile, $email, $position)
    {
        $contact = new SiteContact;
        $contact->site_id = $siteId;
        $contact->name = $name;
        $contact->mobile = $mobile;
        $contact->email = $email;
        $contact->position = $position;
        $contact->save();
        return $contact;
    }

    public function delete($id)
    {
        $data = $this->model::find($id);
        if(!empty($data))
        {
            $data->delete();

            $this->deleteContacts($id);

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
            $records = $records->where('site', 'LIKE', '%'.$searchTerm.'%'); 
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
        $rec->site = $request->site;
        $rec->address = $request->address;
        $rec->address2 = $request->address2;
        $rec->location = $request->location;
        $rec->postcode = $request->postcode;
        $rec->lat = $request->lat;
        $rec->lng = $request->lng;
        $rec->notes = $request->notes;
        return $rec;
    }


}
