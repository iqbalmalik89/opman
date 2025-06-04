<?php

namespace App\Services;

use Illuminate\Foundation\Http\Kernel as HttpKernel;
use App\Models\Site;
use App\Models\NotificationLog;
use App\Models\Setting;
use App\Models\Document;
use App\Models\SuboperativeDocument;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;
use App\Mail\CommonMail;
use App\Library\Utility;

class NotificationService
{

    
    public function sendDocNotifications()
    {


        // $client = new \Twilio\Rest\Client(env('TWILIO_SID'), env('TWILIO_TOKEN'));


        // $client->messages->create(
        //     // The number you'd like to send the message to
        //     '+923363274033',
        //     [
        //         // A Twilio phone number you purchased at https://console.twilio.com
        //         'from' => env('TWILIO_NUMBER'),
        //         // The body of the text message you'd like to send
        //         'body' => "You site manager auth code is "
        //     ]
        // );        


        $emails = $this->getAlertEmails();
        // NotificationLog::truncate();
        $records = [
                ['init' => 60, 'days'=>90, 'channel'=>'email', 'type'=>'90doc'], 
                ['init' => 30, 'days'=>60, 'channel'=>'email', 'type'=>'60doc'], 
                ['init' => 1, 'days'=>30, 'channel'=>'email', 'type'=>'30doc'], 
                ['init' => 1, 'days'=>30, 'channel'=>'sms', 'type'=>'30doc'], 
                ['init' => 0, 'days'=>0, 'channel'=>'email', 'type'=>'0doc'], 
                ['init' => 0, 'days'=>0, 'channel'=>'sms', 'type'=>'0doc'], 

                ['init' => 60, 'days'=>90, 'channel'=>'email', 'type'=>'90subdoc'], 
                ['init' => 30, 'days'=>60, 'channel'=>'email', 'type'=>'60subdoc'], 
                ['init' => 1, 'days'=>30, 'channel'=>'email', 'type'=>'30subdoc'], 
                ['init' => 1, 'days'=>30, 'channel'=>'sms', 'type'=>'30subdoc'], 
                ['init' => 0, 'days'=>0, 'channel'=>'email', 'type'=>'0subdoc'], 
                ['init' => 0, 'days'=>0, 'channel'=>'sms', 'type'=>'0subdoc'], 

               ];


        foreach ($records as $key => $record) 
        {
            if (strpos($record['type'], 'sub') === false) 
            {
                $model = new Document;
                $docType = 'people';

            }
            else
            {
               $model = new SuboperativeDocument;
               $docType = 'subop';
            }



            $mailData =[];
            $mailDocs = [];
            if(empty($record['init']) && empty($record['days']))
            {
                $docs = $model::whereDate( 'expire_at', '=', now())->get();
                $docSubject = 'Expired';
            }
            else
            {
                $docs = $model::whereDate( 'expire_at', '<=', now()->addDays($record['days']))->whereDate( 'expire_at', '>=', now()->addDays($record['init']))->get();
                $docSubject = 'Expiring';

            }

 
            if(!empty($docs->count()))
            {
                foreach ($docs as $key => $doc) 
                {
                    $log = $this->get($doc->id, $record['type'], $docType, $record['channel']);
                    if(empty($log))
                    {
                        $this->save($doc->id, $record['type'], $docType, $record['channel']);

                        if(!in_array($doc->people->status, ['Banned', 'Deactivated']))
                        {
                            if($record['channel'] == 'email')
                            {
                                $mailDocs[] = $doc;
                            }
                            else if($record['channel'] == 'sms')
                            {

                            }                            
                        }


                    }


                }                
            }


            if(!empty($mailDocs))
            {
                    $mailData = array('documents' => $mailDocs,
                                       'subject' => 'Document ' . $docSubject,
                                       'view' => 'expiring',
                                       'doc_type' => $docType,
                                       'days' => $record['days'],
                                        );


                    try {
                        \Mail::to($emails['to'])->cc($emails['cc'])->send(new CommonMail($mailData));
                    } catch(\Exception $e){
                        echo $e;
                    }                
            }



        }


    }

    public function getAlertEmails()
    {
        $resp = ['to' => '', 'cc' => ''];
        $rec = Setting::first();
        if(!empty($rec->alert_emails))
        {
            $emailsArr = array_map('trim', explode(',', $rec->alert_emails));
            $resp['to'] = $emailsArr[0];
            unset($emailsArr[0]);
            $resp['cc'] = $emailsArr;
            return $resp;
        }
        else
        {
            return false;
        }
    }


    public function save($entityId, $type,$docType,  $channel)
    {
        $rec = new NotificationLog;
        $rec->entity_id = $entityId;
        $rec->type = $type;
        $rec->doc_type = $docType;
        $rec->channel = $channel;
        $rec->save();
    }


    public function get($entityId, $type, $docType, $channel)
    {
        return NotificationLog::where('entity_id', $entityId)->where('doc_type', $docType)->where('type', $type)->where('channel', $channel)->first();
    }


}
