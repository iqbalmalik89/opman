<?php

namespace App\Services;

use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;
use App\Library\Utility;


class ClientService
{
    public $model;
    function __construct()
    {
        $this->model = '\\App\\Models\\Client';
    }

    public function getAllClients()
    {
        $rec =  $this->model::orderBy('name', 'asc')->get();

        return $rec;
    }


    public function get($col, $value, $detail = false)
    {
        $rec =  $this->model::where($col, $value)->first();

        return $rec;
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

        $records = new $this->model;

        if(!empty($input['search']['value']))
        {
            $records = $records->where('name', 'LIKE', '%'.$input['search']['value'].'%'); 
        }

        if(empty($input['start']))
            $page = 1;
        else
            $page = ($input['start'] / $input['length']) + 1;

        Paginator::currentPageResolver(function () use ($page) {
            return $page;
        });



        $records = $records->paginate($input['length']);

        return $records;
    }

    public function save($request)
    {
        $rec = new $this->model;
        $rec = $this->setter($rec, $request);
        $rec->save();
        return $rec;
    }


    public function update($request, $id)
    {
        $rec = $this->model::find($id);
        $rec = $this->setter($rec, $request);
        $rec->update();
        return $rec;
    }

    public function setter($rec, $request)
    {
        $rec->name = $request->name;
        $rec->address = $request->address;
        $rec->contact_email = $request->contact_email;
        $rec->contact_name = $request->contact_name;
        $rec->contact_number = $request->contact_number;
        return $rec;
    }


}
