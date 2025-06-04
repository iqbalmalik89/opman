<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class TeamRequest extends FormRequest
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


                if($route == 'api/team/{id}')
                {
                     return [];
                    
                    return [
                        'team' => 'required',
                    ];
                }
                 else {
                     return [];
                }

                
            }
            case 'POST':
            {
                
                if($route == 'api/team')
                {
                    return [
                        'team' => 'required',
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
