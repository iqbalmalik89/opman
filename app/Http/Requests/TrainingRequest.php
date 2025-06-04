<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class TrainingRequest extends FormRequest
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


                if($route == 'api/training/{id}')
                {
                    return [

                    ];
                }
                 else {
                     return [];
                }

                
            }
            case 'POST':
            {
                
                if($route == 'api/training')
                {
                     return [];

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
            'name.*' => 'The Name field is required',
            'mobile.*' => 'The Mobile field is required',
            'email.*.required' => 'The Email field is required',
            'email.*.email' => 'Provide valid email address',
            'position.*' => 'The Position field is required',

        ];
    }

    public function response(array $errors) {
        return response()->json(['status' => 'error', 'message' => $errors, 'code' => 400], 400);
    }

}
