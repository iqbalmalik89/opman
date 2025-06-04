<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Services\UserService;
use App\Services\SiteService;
use App\Services\WebsiteService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
	public $service;
    public $module;
	function __construct(UserService $userService)
	{
		$this->service = $userService;
        $GLOBALS['module'] = 'user';


	}

    public function suspended()
    {
        return view('backend.'.$GLOBALS['module'] .'.suspended');        
    }

 

    public function showLogin(Request $request)
    {
        if(tenant())
        {
            if(tenant()->status == 'Suspended')
                return redirect()->route('suspended');
        }

        $accessToken = $request->access_login;;   
        if(!empty($accessToken))
        {
            $rec = $this->service->get('token', $accessToken);            

            if(!empty($rec))
            {
                \Auth::login($rec);
                return redirect($request->redirect_url);
            }
        }

        $title = \Lang::get('site.login_page_title');
        return view('backend.'.$GLOBALS['module'] .'.login', ['title' => $title]);
    }

    public function showRegister(Request $request)
    {
        return view('backend.'.$GLOBALS['module'] .'.register', ['title' => 'Register']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }


    public function show()
    {
        $roles = Role::get();
        $title = 'Users';
        return view('backend.'.$GLOBALS['module'] .'.listing', ['title' => $title, 'roles' => $roles]);
    }

    public function add(Request $request)
    {
        $title = \Lang::get('site.add_user_page_title');
        $roles = Role::get();
        $data = ['title' => $title, 'roles' => $roles, 'data' => ''];
        return view('backend.'.$GLOBALS['module'] .'.form', $data);       
    }

    public function edit($id)
    {
        $roles = Role::get();
        $title = \Lang::get('site.edit_user_page_title');
        $rec = $this->service->get('id', $id, true);

        if (!empty($rec)) {
            $data = ['data' => $rec,'title' => $title, 'roles' => $roles];
            return view('backend.'.$GLOBALS['module'] .'.form', $data); 
        } else {
            abort(404);
        }      
    }



    public function save(UserRequest $request)
    {
        $response = $this->service->save($request);

        if($response)
        {
            return response()->json([
                'status' => 'success',
                'code' => 200,
                'message' => 'User Added successfully'
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

    public function update(UserRequest $request, $id)
    {
        $response = $this->service->update($request, $id);

        if($response)
        {
            return response()->json([
                'status' => 'success',
                'code' => 200,
                'message' => \Lang::get('user.user_update_success'),
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


    public function login(UserRequest $request)
    {
        $response = $this->service->login($request);

        if($response === 'Suspended')
        {
            return response()->json([
                    'status' => 'suspended',
                    'message' => 'Account suspended. Contact administrator.'
                ], 200);

        }
        else if($response === 'code_error')
        {
            return response()->json([
                    'status' => 'code_error',
                    'message' => 'Code is incorrect'
                ], 200);

        }
        else if($response === 'sent')
        {
            $user = $this->service->get('email', $request->user_email);

            return response()->json([
                    'status' => 'sent',
                    'two_fact_auth' => ucfirst($user->two_fact_auth),
                    'message' => 'Code sent successfully'
                ], 200);

        }
        else if($response === true)
        {
            return response()->json([
                    'tenant' => 0,
                    'status' => 'success',
                    'data' => $response,
                    'message' => 'User logged in successfully'
                ], 200);
        }
        else if(!empty($response))
        {
            return response()->json([
                    'tenant' => 1,
                    'status' => 'success',
                    'data' => $response,
                    'message' => 'User logged in successfully'
                ], 200);
        }
        else if($response === false)
        {
            return response()->json([
                'status' => 'error',
                'message' => 'Email and password not correct'
            ], 401);
        }

    }

    public function register(UserRequest $request)
    {
        $response = $this->service->register($request);

        if(!empty($response))
        {
            return response()->json([
                    'status' => 'success',
                    'data' => $response,
                    'message' => 'Account Created successfully'
                ], 200);
        }
        else if($response === false)
        {
            return response()->json([
                'status' => 'error',
                'message' => 'Some error occurred'
            ], 401);
        }

    }
    public function showRequestPassword()
    {
       if(tenant())
        {
            if(tenant()->status == 'Suspended')
                return redirect()->route('suspended');
        }


        $title = \Lang::get('site.reset_pass_page_title');
        return view('backend.'.$GLOBALS['module'] .'.request-password', array('title' => $title));
    }

    public function showResetPasswordByToken($token)
    {
        $title = \Lang::get('site.reset_pass_page_title');
        return view('backend.'.$GLOBALS['module'] .'.reset-password', array('token' => $token, 'title' => $title));
    }


    public function showForgotPassword()
    {


        $title = \Lang::get('site.forgot_page_title');
        return view('backend.'.$GLOBALS['module'] .'.forgot-password', ['title' => $title]);
    }




    public function showProfile(Request $request)
    {
        $GLOBALS['module'] = 'profile';
        $title = \Lang::get('site.profile_page_title');
        $data = $this->service->get('id', Auth::user()['id']);
        return view('backend.user.profile', array('data' => $data, 'title' => $title));
    }

    public function showSecuirty(Request $request)
    {
        $GLOBALS['module'] = 'security';
        $title = 'Security';
        $data = $this->service->get('id', Auth::user()['id']);
        return view('backend.user.security', array('data' => $data, 'title' => $title));

    }

    public function showChangePassword(Request $request)
    {
        $title = \Lang::get('site.change_pass_page_title');
        return view('backend.'.$GLOBALS['module'] .'.change-password', ['title' => $title]);
    }

    public function error404()
    {
        return view('front.404');
    }


    public function confirmEmail($code)
    {
    	$response = $this->service->confirmEmail($code);
    	if(!empty($response))
    	{
	    	return view('front.confirm_email', ['success' => 1]);
    	}
    	else
    	{
	    	return view('front.confirm_email', ['success' => 0]);
    	}
    }



    public function requestPassword(UserRequest $request)
    {    	


		$auth = $this->service->requestPassword($request);

        if($auth === 'not_allowed')
        {
            return response()->json([
                'status' => 'not_allowed',
                'code' => 200,
                'message' =>  'Please request super admin to reset your password'
            ], 200);
        }
		else if($auth)
		{
			return response()->json([
			    'status' => 'success',
			    'code' => 200,
			    'message' =>  'Password reset link has been sent to your email address'
			], 200);
		}
		else
		{
			return response()->json([
			    'status' => 'success',
			    'message' => 'Some error occurred'
			], 200);
		}
    }

    public function resetPassword(Request $request)
    {
    	$checkOldPassword = $this->service->checkPassword(Auth::user()->email, $request->input('old_password'));
    	if ($checkOldPassword) {
    		$resp = $this->service->resetPassword(Auth::user()->email, $request->input('password'));

			if($resp)
			{
				return response()->json([
				    'status' => 'success',
				    'code' => 200,
				    'message' => \Lang::get('user.password_update_success'),
				], 200);
			}
			else
			{
				return response()->json([
				    'status' => 'error',
				    'message' => \Lang::get('user.error_occurred'),
				], 400);
			}
    	}
    	else
		{
			return response()->json([
			    'status' => 'error',
			    'message' => \Lang::get('user.old_pass_error'),
			], 404);
		}
    	
		
    }

    public function resetPasswordByToken(UserRequest $request)
    {
		$resp = $this->service->resetPasswordByToken($request);

		if($resp)
		{
			return response()->json([
			    'status' => 'success',
			    'code' => 200,
			    'message' => 'Password has been updated.'
			], 200);
		}
		else
		{
			return response()->json([
			    'status' => 'error',
			    'message' => 'Some error occurred'
			], 400);
		}
    }

    public function updateUser(Request $request, $id)
    {
		$resp = $this->service->updateUser($request, $id);

		if($resp)
		{
			return response()->json([
			    'status' => 'success',
			    'code' => 200,
			    'message' => \Lang::get('user.account_update_success')
			], 200);
		}
		else
		{
			return response()->json([
			    'status' => 'error',
			    'message' => \Lang::get('user.error_occurred')
			], 400);
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
                'message' => 'User fetched successfully'
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

    public function secure(Request $request)
    {
        $this->service->secure($request->token);            
        return redirect()->route('dashboard');

    }


    public function updateSecurity(Request $request)
     {
        $resp = $this->service->updateSecurity($request);

        if($resp)
        {
            return response()->json([
                'status' => 'success',
                'message' => 'Security settings updated successfully',
            ]);
        }
        else
        {
            return response()->json([
                'status' => 'error',
                'message' => 'Some error occurred',
            ]);
        }
    }

    public function updateProfile(Request $request)
     {
        $resp = $this->service->updateProfile($request);

        if($resp)
        {
            return response()->json([
                'status' => 'success',
                'message' => 'Profile Updated Successfully',
            ]);
        }
        else
        {
            return response()->json([
                'status' => 'error',
                'message' => 'Some error occurred',
            ]);
        }
    }

}
