<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class TenantRequest extends FormRequest
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
                if($route == 'api/tenant/{id}')
                {

                    return [
                        'company' => 'required',
                        'status' => 'required',
                        'first_name' => 'required',
                        'last_name' => 'required',
                        'email' => 'required|email|unique:users,email,'.\Request::input('user_id'),
                        'phone' => 'required',

                    ];
                }
                else
                {
                     return [];                    
                }


                

                
            }
            case 'POST':
            {
                if($route == 'api/tenant')
                {
                    return [
                        'company' => 'required',
                        'first_name' => 'required',
                        'last_name' => 'required',
                        'email' => 'required|email|unique:users,email',
                        'password' => 'required',
                        'phone' => 'required',

                    ];
                }
                else
                {
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

        ];
    }

    public function response(array $errors) {
        return response()->json(['status' => 'error', 'message' => $errors, 'code' => 400], 400);
    }

}
