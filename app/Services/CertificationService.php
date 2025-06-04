<?php

namespace App\Services;

use Illuminate\Foundation\Http\Kernel as HttpKernel;
use App\Models\ProjectSchedule;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;
use App\Library\Utility;

class CertificationService
{
    public $model;
    function __construct()
    {
        $this->model = '\\App\\Models\\Certification';
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

        $records = $this->model::where('category_id', $request->category_id);


        if(!empty($input['search']['value']))
        {
            $records = $records->where('certification', 'LIKE', '%'.$input['search']['value'].'%'); 
        }

        $records = $records->orderBy('certification', 'ASC');

        if(isset($input['start']) && isset($input['length']))
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
            return $records->get();
        }


        return $records;
    }

    public function save($request)
    {

        foreach ($request->certification as $key => $cert) 
        {
            $rec = new $this->model;
            $rec->category_id = $request->category_id;
            $rec->certification = $cert;
            $rec->save();
        }

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
        $rec->category_id = $request->category_id;
        $rec->certification = $request->certification;
        return $rec;
    }


}
