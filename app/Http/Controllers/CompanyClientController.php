<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company_client;
use DB;
use Auth;
use App\Transaction;
use App\Company_rider;
use App\Payment;
use App\Datacleaner;
use App\SmsMessaging;

class CompanyClientController extends Controller
{
    public function fetchCompanyClient(){
        $company_clients = DB::table('company_clients')->where('company_id', Auth::user()->companiescompanies_id)->get();
        $comp_client = [];
        if ($company_clients != null){
            foreach($company_clients as $company_client) {
                $encodeCompanyclients = json_encode($company_client);
                $temp_clients = [];
                $number = ($company_client->client_alt_number == null) ? $company_client->client_primary_number: $company_client->client_primary_number . "/".$company_client->client_alt_number;
                array_push($temp_clients,
                $company_client->client_first_name . " " .$company_client->client_last_name,
                $number,
                // ($company_client->çlocation == null) ? "N/A" : $company_client->location,
                // $company_client->email_address,
                // $company_client->company_name,
                date("jS F Y", strtotime($company_client->created_at)),
                "<button class='btn btn-info btn-outline clientMoreBtn'  data-clients='$encodeCompanyclients'> More </button>"
                );
                array_push($comp_client, $temp_clients);
            }
        } else {
            $empty = ["","","","","",""];
            array_push($comp_client, $empty);
        }


        return response()->json(['data' => $comp_client]);
    }


    public function updateCompanyClientData(Request $request){
        $update_name =  $request->client_first_name_more. " " . $request->client_last_name_more;
        $request = Datacleaner::cleaner($request->all());
        $company_client = Company_client::where("company_clients_id", $request["company_client_id"])
        ->update([
            "client_first_name" => $request["client_first_name_more"],
            "client_last_name" => $request["client_last_name_more"],
            "client_primary_number" => "0".$request["client_contact_number_more"],
            "client_alt_number" => $request["client_contact_number_two_more"],
            "location" => $request["customer_location_more"],
            "email_address" => $request["email_more"],
            "company_name" => $request["company_name_more"]
        ]);

        return  ($company_client == 1) ? response()->json(["success" => $update_name. " updated successfully "], 200) : response()->json(["error" => "Try again! "], 500) ;
    }


    public function quickQuery(Request $request){
        $quick = Payment::where('transaction_number', $request->searchData)
        ->join('transactions','payments.transactionstransaction_id', 'transactions.transaction_id')
        ->join('company_riders','transactions.company_riderscompany_rider_id','company_riders.company_rider_id')
        ->join('company_clients','transactions.company_client_id','company_clients.company_clients_id')
        ->select('transaction_number','first_name','last_name','source','destination','client_primary_number',
        'client_first_name','client_last_name','payments.created_at')
        ->first();

        return ($quick == null) ? response()->json("error ". $request->searchData, 500): response()->json($quick, 200);
    }


    public function riderSchedule(Request $request){
        $today = date("Y-m-d");
        $riderScheduleData = Transaction::where('company_riderscompany_rider_id', $request->rider_id)
        ->whereIn("transactions.delivery_status", ["Scheduled Delivery","Delivery started"])
        ->whereDate("company_schedules.schedule_date", $today)
        ->join('company_clients','transactions.company_client_id','company_clients.company_clients_id')
        ->join('company_schedules','transactions.transaction_id','company_schedules.transactionstransaction_id')
        ->join('payments','transactions.transaction_id','payments.transactionstransaction_id')
        ->select("transaction_id","company_clients_id","schedule_date","schedule_time","client_first_name","client_last_name",
        "client_primary_number","source","destination","delivery_status", "product_type", "quantity", "payment_type", "transaction_number")
        ->get();

        return ($riderScheduleData == null) ? response()->json("error",500):response()->json($riderScheduleData,200);
    }


    public function updateCustomerSchedule(Request $request){
        $delivery_status = $request->delivery_status;
        $customer_name = $request->customer_name;
        $phone_number = $this->processphonenumber($request->phone_number);
        $company_name = $request->company_name;
        $transaction_number = $request->transaction_number;
        $rider_name = $request->rider_name;
        $todayDate = date("Y-m-d");
        $sendMessage = new SmsMessaging($phone_number,explode(" ", $request->company_name)[0]);


         $transupdate  = Transaction::where("transaction_id", $request->transaction_id)->update(["delivery_status" => $delivery_status]);
          
         if ($delivery_status == "Delivery Started") {
            $message = "Dear " .  $customer_name . "\nYour order with ". $company_name;
            $message .= " for " . $todayDate . " has started.";
            $message .= "\npowered by DELIPACK";
            $sendMessage->sendSMS($message);
         } else if ($delivery_status == "Completed Delivery"){
            $message = "Dear " .  $customer_name . "\nYour order with trans # ". $transaction_number;
            $message .= "\nhas been delivered on " . $todayDate . " by " . $rider_name;
            $message .= "\nThank you for dealing with ". $company_name;
            $message .= "\npowered by DELIPACK";
            $sendMessage->sendSMS($message);            
         }

        //  $alert_message = new SmsMessaging();
         return ($transupdate != null) ? response()->json($request, 200) : response()->json($request, 500);
    }


     private function processphonenumber($phonenumber){
        $phone = str_split($phonenumber);
        if (count($phone) == 10){
            $phone = substr($phonenumber, 1);
            $phone = "233". $phone;
        }
        return $phone;
    }



    public function updateridertoken(Request $request){
        Company_rider::where("company_rider_id", $request->rider_id)
        ->update([
            "deviceToken" => $request->notification_token
        ]);
        
        $message = "Hi ". $request->rider_name. " welcome to DELIPACK services";
        $notification = new SmsMessaging(null, null);
        $notificationresponse = $notification->sendNotifcationToDevice($request->notification_token, $message, "DELIPACK");
        
        return ($notificationresponse)? response()->json(["success" => "Successful " . $request->notification_token . " " .$notificationresponse]) : response()->json(["error" => "Try Again!"]) ;
    }


  


}
