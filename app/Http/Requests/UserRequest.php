<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $method = $this->method();
        $route = \Route::current()->uri;



        switch($method)
        {
            case 'GET':
            {
                return [];
            }
            case 'DELETE':
            {
                return [];
            }
            case 'PUT':
            {

                if($route == 'api/user/reset-password')
                {
                    return [
                        'password' => 'required',
                        'old_password' => 'required',
                    ];
                }
                else if($route == 'api/user/{id}')
                {
                    return [
                        'first_name' => 'required',
                        'last_name' => 'required',
                        'role' => 'required',
                        'email' => 'required|email|unique:users,email,'.\Request::input('module_id'),
                    ];
                }
                else if($route == 'api/reset-password/{token}')
                {
                    return [
                        'token' => 'required',
                        'password' => 'required',
                        'confirm-password' => 'required',
                    ];
                }
                 else {
                     return [];
                }
            }
            case 'POST':
            {
                if($route == 'api/user')
                {
                    return [
                        'first_name' => 'required',
                        'last_name' => 'required',
                        'role' => 'required',
                        'email' => 'required|email|unique:users,email',
                        'password' => 'required',
                        'phone' => 'required',
                    ];
                }
                else if($route == 'api/user/{id}')
                {
                    return [
                        'first_name' => 'required',
                        'last_name' => 'required',
                        'role' => 'required',
                        'email' => 'required|email|unique:users,email,'.\Request::input('module_id'),
                        'phone' => 'required',
                    ];
                }
                else if($route == 'api/user/login')
                {
                    return [
                        'user_email' => 'required',
                        'user_password' => 'required',
                    ];
                }
                else if($route == 'api/user/register')
                {
                    return [
                        'company' => 'required',
                        'first_name' => 'required',
                        'last_name' => 'required',
                        'email' => 'required|email|unique:users,email',
                        'password' => 'required',
                    ];
                }
                else if($route == 'api/request-password')
                {
                    return [
                        'forgot_email' => 'required|email',
                    ];
                }

                 else {
                     return [];
                }
            }
            case 'PATCH':
            {
                return [];
            }
            default:break;
        }
    }

    /*
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
         'file_path.required' => \Lang::get('user.company_proof_req'),
         'user_email.unique' => \Lang::get('register.unique_mail'),


        ];
    }

    public function response(array $errors) {
        return response()->json(['status' => 'error', 'message' => $errors, 'code' => 400], 400);
    }

}
