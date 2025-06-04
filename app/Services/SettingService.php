<?php

namespace App\Services;

use Illuminate\Foundation\Http\Kernel as HttpKernel;
use App\Models\Customer;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;
use App\Library\Utility;

class SettingService
{
    public $model;
    function __construct()
    {
        $this->model = '\\App\\Models\\Setting';
    }

    public function get($col, $value, $detail = false)
    {
        $rec =  $this->model::where($col, $value)->first();

        return $rec;
    }

    public static function getSetting()
    {
        $rec =  \App\Models\Setting::where('id', 1)->first();
        return $rec;
    }

    public function alertSettings($request)
    {
        $rec = $this->getSetting();
        $rec->alert_emails = $request->alert_emails;
        $rec->alert_phone_numbers = $request->alert_phone_numbers;
        $rec->update();
        return $rec;
    }

    public function save($title, $heading, $smallText)
    {
        $rec = new $this->model;
        $rec->site_title = $title;
        $rec->splash_heading = $heading;
        $rec->splash_small_text = $smallText;
        $rec->logo_img_path = '';
        $rec->save();
        return $rec;
    }



    public function updateSettings($request, $id)
    {
        $mediaService = new MediaService();

        $mediaService->moveFile($mediaService->tmp . $request->logo_img_path, 'site/' . $request->logo_img_path, true);

        $mediaService->moveFile($mediaService->tmp . $request->favicon_img_path, 'site/' . $request->favicon_img_path, true);

        $mediaService->moveFile($mediaService->tmp . $request->splash_img_path, 'site/' . $request->splash_img_path, true);

        $mediaService->moveFile($mediaService->tmp . $request->splash_bg_img_path, 'site/' . $request->splash_bg_img_path, true);


        $rec = $this->model::find($id);
        $rec = $this->setter($rec, $request);
        $rec->update();
        return $rec;
    }

    public function setter($rec, $request)
    {
        $rec->site_title = $request->site_title;
        $rec->logo_img_path = $request->logo_img_path;
        $rec->splash_img_path = $request->splash_img_path;
        $rec->splash_bg_img_path = $request->splash_bg_img_path;
        $rec->favicon_img_path = $request->favicon_img_path;
        $rec->splash_heading = $request->splash_heading;
        $rec->splash_small_text = $request->splash_small_text;

        return $rec;
    }


}
