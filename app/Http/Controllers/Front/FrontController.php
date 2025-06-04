<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Services\FrontService;
use Illuminate\Support\Facades\Auth;

class FrontController extends Controller
{
	public $service;
	function __construct(FrontService $service)
	{
		$this->service = $service;

	}


    public function showHome(Request $request)
    {
        $title = \Lang::get('site.login_page_title');
        return view('front.home', ['title' => $title]);
    }


}
