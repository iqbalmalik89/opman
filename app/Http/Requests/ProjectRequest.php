<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ProjectRequest extends FormRequest
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


                if($route == 'api/casitetegory/{id}')
                {
                    return [

                        'site' => 'required',
                        'address' => 'required',
                        'postcode' => 'required',
                        'lat' => 'required',
                        'lng' => 'required',
                        'notes' => 'required',
                        "name.*"  => "required",
                        "mobile.*"  => "required",
                        "email.*"  => "required|email",
                        "position.*"  => "required",
                    ];
                }
                 else {
                     return [];
                }

                
            }
            case 'POST':
            {
                
                if($route == 'api/suboperative-document/upload')
                {
                    return [
                        "cat_id.*"  => "required",
                        "expire_at.*"  => "required",
                        "doc_class.*"  => "required",
                        "docfiles_path"  => "required",


                    ];
                }
                if($route == 'api/project')
                {
                    return [
                        "job_no"  => "required",
                        "name"  => "required",
                        "client_id"  => "required",
                        "start_date"  => "required",
                        "due_date"  => "required",
                        "site_id"  => "required",
                    ];
                }
                elseif($route == 'api/project/assign')
                {
                    return [

                        "project_id"  => "required",
                        "assign_doc_id"  => "required",
                        "assign_start_date"  => "required|date_format:d/m/Y",
                        "assign_end_date"  => "required|date_format:d/m/Y|after_or_equal:assign_start_date",




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
            'cat_id.*' => 'Required',
            'expire_at.*' => 'Required',
            'doc_class.*' => 'Required',
            'docfiles_path' => 'Please upload at least one image',

        ];
    }

    public function response(array $errors) {
        return response()->json(['status' => 'error', 'message' => $errors, 'code' => 400], 400);
    }

}
