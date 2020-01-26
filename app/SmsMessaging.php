<?php

namespace App;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class SmsMessaging {
    private $APP_ID = "379d563e-dd7b-48e0-8eef-5b2e5be8223d";
    private $APP_SECRET = "KyhFRU5dFA3fI83daSTmpZBRwRqqnWID8ltQgOrus";
    private $SMS_ENDPOINT = "https://api.wittyflow.com/v1/messages/send";
    private $method = "POST";
    private $type = 1;
    private $message;
    private $phonenumber;
    private $from;

    //notification Server key
    private $server_key = "AAAAlCuZ-IY:AAAAlCuZ-IY:APA91bFMRFmqhmdSej91LAA4ZdxBKtYIcjquYbawZstNuD0hvqYf2m5lWCEKj6aqWFxYgf5CB5L8O1CBPy-_Qg2hSog3AkKD5HTEAOko7s3T3TQRMigso4apApJ_Q3goJHI9yGHQL1OT";
    private $legacy_server_key = "AIzaSyCGsksj7czYv05a9rNHEqe2ecugkj8VW4s";
    private $server_endpoint = "https://fcm.googleapis.com/fcm/send";

    public function __construct ($phonenumber, $from) {
        $this->phonenumber = $phonenumber;
        $this->from = $from;
    }


    public function sendSMS ($message){
        $client = new Client();
        $body = [
            "app_id" => $this->APP_ID,
            "app_secret" => $this->APP_SECRET,
            "from" => $this->from,
            "to" => $this->phonenumber,
            "message" => $message,
            "type" => $this->type
        ];
       $response =  $client->request($this->method, $this->SMS_ENDPOINT, [ 'form_params' => $body]);
       return response()->json($response);
    }

  public function sendNotifcationToDevice($riderDeviceToken, $message, $messagetitle){
        $headers = [
                'Authorization' => 'key=AIzaSyCGsksj7czYv05a9rNHEqe2ecugkj8VW4s',
                'Content-Type' => 'application/json'
            ];    
        $notification = new Client([
                'headers' => $headers
            ]);
            

        $notificatonData = [
            "to" => $riderDeviceToken,
             "notification" =>[
                 "body" => $message,
                "sound" => true
             ],
             "data" => $message
        ];
        // $notification->setDefaultOption('headers', $headers);
        $notification->request('POST', $this->server_endpoint,[
            'form_params' => $notificatonData
        ]);
        return ($notification != null) ? true : false;
    }


}
