<?php

namespace App\Services;

use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;
use App\Library\Utility;
use App\Models\Certification;

class CategoryService
{
    public $model;
    function __construct()
    {
        $this->model = '\\App\\Models\\Category';
    }

    public function getAllCat()
    {
        $rec =  $this->model::orderBy('category', 'asc')->get();

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

        $records = $this->model::withCount('certifications');

        if(!empty($input['search']['value']))
        {
            $records = $records->where('category', 'LIKE', '%'.$input['search']['value'].'%'); 
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

    public function getCatCerts($catId)
    {
        return Certification::where('category_id', $catId)->pluck('id')->toArray();
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
        $rec->category = $request->category;
        return $rec;
    }


}
