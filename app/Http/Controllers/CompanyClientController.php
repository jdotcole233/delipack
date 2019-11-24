<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company_client;
use DB;
use Auth;
use App\Transaction;
use App\Company_rider;
use App\Payment;
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
                // ($company_client->location == null) ? "N/A" : $company_client->location,
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
        Company_client::where("company_clients_id", $request->company_client_id)
        ->update([
            "client_first_name" => $request->client_first_name_more,
            "client_last_name" => $request->client_last_name_more,
            "client_primary_number" => "0".$request->client_contact_number_more,
            "client_alt_number" => $request->client_contact_number_two_more,
            "location" => $request->customer_location_more,
            "email_address" => $request->email_more,
            "company_name" => $request->company_name_more
        ]);

        return response()->json(["response" => "Updated successfully"]);
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
        $riderScheduleData = Transaction::where('company_riderscompany_rider_id', $request->rider_id)
        ->join('company_clients','transactions.company_client_id','company_clients.company_clients_id')
        ->join('company_schedules','transactions.transaction_id','company_schedules.transactionstransaction_id')
        ->select("company_clients_id","schedule_date","schedule_time","client_first_name","client_last_name",
        "client_primary_number","source","destination")
        ->get();

        return ($riderScheduleData == null) ? response()->json("error",500):response()->json($riderScheduleData,200);
    }


}
