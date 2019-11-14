<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use App\Payment;
use App\Rating;
use App\Company_rider;
use App\Company_address;
use App\User;
use App\Company;
use App\Customer;
use DB;
use Hash;
use Auth;
use Carbon\Carbon;
use Session;
use App\Companies_rider;
use App\Company_client;
use App\Company_schedule;

class CompanyController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function totalSales(Request $request){
        $annual_total = [];
        $totalsales = Transaction::join('payments', 'transactions.transaction_id', 'payments.transactionstransaction_id')
        ->where('transactions.companiescompanies_id', Auth::user()->companiescompanies_id)
        ->where('transactions.delivery_status', 'ACTIVE')
        ->select(DB::raw("DATE_FORMAT(transactions.created_at, '%m') as month"),DB::raw('delivery_charge'))->get()
        ->groupBy('month');

        $totalerrands = Transaction::where('companiescompanies_id', Auth::user()->companiescompanies_id)
        ->select(DB::raw("DATE_FORMAT(transactions.created_at, '%m') as month"),DB::raw('companiescompanies_id'))
        ->where('transactions.delivery_status', 'ACTIVE')
        ->get()
        ->groupBy('month');

        $totalratings = Rating::where('company_id', Auth::user()->companiescompanies_id)
       ->select(DB::raw("DATE_FORMAT(ratings.created_at, '%m') as month"),DB::raw('rate_value'))
        ->get()
        ->groupBy('month');

        $riderAssignedandTransactions = Company_rider::join('rider_assigned_motor_bikes', 'company_riders.company_rider_id', 'rider_assigned_motor_bikes.company_riderscompany_rider_id')
         ->join('motor_bikes', 'rider_assigned_motor_bikes.motor_bikesbike_id','motor_bikes.bike_id')
         ->select('company_rider_id','first_name','last_name','work_phone', 'brand_name','registered_number')
         ->where('rider_assigned_motor_bikes.companiescompanies_id', Auth::user()->companiescompanies_id)
         ->where('rider_assigned_motor_bikes.assigned_bike', 1)
         ->latest('rider_assigned_motor_bikes.created_at')
         ->get();

        $totalsalesdata =  json_encode($this->assortStats($totalsales,"delivery_charge"));
        $totalerrandsdata = json_encode($this->assortStats($totalerrands, "companiescompanies_id"));
        $totalratingsdata =  json_encode($this->assortStats($totalratings, "rate_value"));
        $riderassigneddatas = $riderAssignedandTransactions;

        return view('dashboard.maindashboard', compact('totalsalesdata', 'totalerrandsdata','totalratingsdata','riderassigneddatas'));
    }


    function assortStats($assoarrays, $keyname){
        $compare_array = array("01" => 0.0,"02" => 0.0,"03" => 0.0, "04" => 0.0,"05" => 0.0, "06" => 0.0,
        "07" => 0.0,"08" => 0.0,"09" => 0.0,"10" => 0.0,"11" => 0.0,"12" => 0.0);
         foreach ($assoarrays as $totalsalekey => $totalsale) {
            $totalamount = 0.0;
            $sizeofarray = count($totalsale);
             for($i = 0; $i < $sizeofarray; $i++){
                        if($totalsale[$i]->$keyname != null){
                        $totalamount = $totalamount + $totalsale[$i]->$keyname;
                  }
            }
            if($keyname == "rate_value"){
                $totalamount = ($totalamount / ($sizeofarray * 5)) * 5;
            }
        $compare_array["$totalsalekey"] = round($totalamount, 0);
         }
        return $compare_array;
    }


    public function transactionquery(){
       $transactions =  Transaction::join('payments', 'transactions.transaction_id', 'payments.transactionstransaction_id')
        ->join('customers','transactions.customerscustomer_id', 'customers.customer_id')
        ->join('company_riders', 'transactions.company_riderscompany_rider_id','company_riders.company_rider_id')
        ->join('motor_bikes','transactions.motor_bikesbike_id','motor_bikes.bike_id')
        ->join('ratings', 'transactions.transaction_id', 'ratings.transactions_id')
        ->select('transaction_number','rate_value','brand_name','registered_number','destination','source','delivery_status','payments.created_at as paidon', 'delivery_charge', 'commission_charge', 'payment_type', 'total_charge', 'customers.first_name as customerFirstName',
                 'customers.last_name as customerLastName', 'customers.phone_number as customerPhoneNumber', 'company_riders.first_name as ridersFirstName', 'company_riders.company_rider_id as rider_id', 'company_riders.last_name as ridersLastName', 'work_phone', 'personal_phone')
        ->where('transactions.companiescompanies_id', Auth::user()->companiescompanies_id)
        ->orderBy('transactions.created_at')
        ->get();

        $trans = [];
        if($transactions != null){
            foreach($transactions as $transaction){
                $inittrans = [];
                $encodeData = json_encode($transaction);
                array_push($inittrans,
                    $transaction->transaction_number, //change this
                    $transaction->customerFirstName . " " . $transaction->customerLastName,
                    $transaction->customerPhoneNumber,
                    $transaction->source,
                    $transaction->destination,
                    $transaction->paidon,
                    $transaction->ridersFirstName . " " . $transaction->ridersLastName,
                    "<button class='btn btn-primary quickviewButton' data-transactions='$encodeData'> Quick view</button>"
                 );
                 array_push($trans, $inittrans);
            }
        } else {
            $empty_array = array(" ", " ", "", "", " ", "  ", " ", " ");
            array_push($trans,$empty_array);
        }
        return response()->json(['data' => $trans]);
    }

   public function singletransactionquery($rider_id){
       $transactions =  Transaction::join('payments', 'transactions.transaction_id', 'payments.transactionstransaction_id')
        ->join('customers','transactions.customerscustomer_id', 'customers.customer_id')
        ->join('company_riders', 'transactions.company_riderscompany_rider_id','company_riders.company_rider_id')
        ->join('motor_bikes','transactions.motor_bikesbike_id','motor_bikes.bike_id')
        ->join('ratings', 'transactions.transaction_id', 'ratings.transactions_id')
        ->select('transaction_id','rate_value','brand_name','registered_number','destination','source','delivery_status','payments.created_at as paidon', 'delivery_charge', 'commission_charge', 'payment_type', 'total_charge', 'customers.first_name as customerFirstName',
                 'customers.last_name as customerLastName', 'customers.phone_number as customerPhoneNumber', 'company_riders.first_name as ridersFirstName', 'company_riders.company_rider_id as rider_id', 'company_riders.last_name as ridersLastName', 'work_phone', 'personal_phone')
        ->where('transactions.company_riderscompany_rider_id', $rider_id)
        ->orderBy('transactions.created_at')
        ->get();
        $trans = [];
        $em_array  =["1", "2", "3", "4", "5", "6", "7", "8"];
        if(sizeof($transactions) != 0){
            foreach($transactions as $transaction){
                $inittrans = [];
                $encodeData = json_encode($transaction);
                array_push($inittrans,
                    $transaction->transaction_id, //change this
                    $transaction->customerFirstName . " " . $transaction->customerLastName,
                    $transaction->customerPhoneNumber,
                    $transaction->source,
                    $transaction->destination,
                    $transaction->transaction_id,
                    $transaction->ridersFirstName . " " . $transaction->ridersLastName,
                    $transaction->paidon
                 );

                 array_push($trans, $inittrans);
            }
        } else {
            $em_array = ["", "", "", "", "", "", "", ""];
            array_push($trans,$em_array);

        }


       return response()->json(['data' => $trans]);
   }


   public function queryCompanyData(Request $request){
       $transactions =  Transaction::join('payments', 'transactions.transaction_id', 'payments.transactionstransaction_id')
        ->join('customers','transactions.customerscustomer_id', 'customers.customer_id')
        ->join('company_riders', 'transactions.company_riderscompany_rider_id','company_riders.company_rider_id')
        ->join('motor_bikes','transactions.motor_bikesbike_id','motor_bikes.bike_id')
        ->select('transaction_number','delivery_charge','registered_number','destination','source','delivery_status',
                'payments.created_at as paidon', 'commission_charge', 'payment_type', 'total_charge',
                'customers.first_name as customerFirstName','customers.last_name as customerLastName',
                'customers.phone_number as customerPhoneNumber', 'company_riders.first_name as ridersFirstName',
                'company_riders.company_rider_id as rider_id', 'company_riders.last_name as ridersLastName',
                'work_phone', 'personal_phone')
        ->whereBetween('transactions.created_at', [$request->fromdate, $request->todate])
        ->where('transactions.companiescompanies_id', Auth::user()->companiescompanies_id)
        ->orderBy('transactions.created_at')
        ->get();

        $totaltransactioncharges = Transaction::join('payments', 'transactions.transaction_id', 'payments.transactionstransaction_id')
        ->join('customers','transactions.customerscustomer_id', 'customers.customer_id')
        ->whereBetween('transactions.created_at', [$request->fromdate, $request->todate])
        ->where('transactions.companiescompanies_id', Auth::user()->companiescompanies_id)
        ->sum('delivery_charge');

        $totalcommissioncharges = Transaction::join('payments', 'transactions.transaction_id', 'payments.transactionstransaction_id')
        ->join('customers','transactions.customerscustomer_id', 'customers.customer_id')
        ->whereBetween('transactions.created_at', [$request->fromdate, $request->todate])
        ->where('transactions.companiescompanies_id', Auth::user()->companiescompanies_id)
        ->sum('commission_charge');

        $trans = [];
        $em_array  =["1", "2", "3", "4", "5", "6", "7", "8","9"];
        if(sizeof($transactions) != 0){
            foreach($transactions as $transaction){
                $inittrans = [];
                $encodeData = json_encode($transaction);
                array_push($inittrans,
                    $transaction->transaction_number,
                    $transaction->customerFirstName . " " . $transaction->customerLastName,
                    $transaction->source,
                    $transaction->destination,
                    $transaction->ridersFirstName . " " . $transaction->ridersLastName,
                    $transaction->paidon,
                    $transaction->commission_charge,
                    $transaction->delivery_charge
                 );

                 array_push($trans, $inittrans);
            }
        } else {
            $em_array = ["", "", "", "", "", "", "",""];
            array_push($trans,$em_array);

        }


        return response()->json(['data' => $trans, 'total' => $totaltransactioncharges,'commision'=>$totalcommissioncharges]);
   }


   public function getridersalesfortoday($rider_id){

      $totaltransactionstoday = Transaction::join('payments', 'transactions.transaction_id', 'payments.transactionstransaction_id')
        ->where('company_riderscompany_rider_id',$rider_id)
        ->join('customers','transactions.customerscustomer_id', 'customers.customer_id')
        ->whereDay('transactions.created_at', date_format(Carbon::now()->toDate(),'d'))
        ->where('transactions.companiescompanies_id', Auth::user()->companiescompanies_id)
        ->where('transactions.delivery_status','ACTIVE')
        ->count('transactions.transaction_id');

        $totalchargestoday = Transaction::join('payments', 'transactions.transaction_id', 'payments.transactionstransaction_id')
        ->where('company_riderscompany_rider_id',$rider_id)
        ->join('customers','transactions.customerscustomer_id', 'customers.customer_id')
        ->whereDay('transactions.created_at', date_format(Carbon::now()->toDate(),'d'))
        ->where('transactions.companiescompanies_id', Auth::user()->companiescompanies_id)
        ->where('transactions.delivery_status','ACTIVE')
        ->sum('delivery_charge');

         $totalcommissiontoday = Transaction::join('payments', 'transactions.transaction_id', 'payments.transactionstransaction_id')
         ->where('company_riderscompany_rider_id',$rider_id)
        ->join('customers','transactions.customerscustomer_id', 'customers.customer_id')
        ->whereDay('transactions.created_at', date_format(Carbon::now()->toDate(),'d'))
        ->where('transactions.companiescompanies_id', Auth::user()->companiescompanies_id)
        ->where('transactions.delivery_status','ACTIVE')
        ->sum('commission_charge');

        $totaltoday = Transaction::join('payments', 'transactions.transaction_id', 'payments.transactionstransaction_id')
        ->where('company_riderscompany_rider_id',$rider_id)
        ->join('customers','transactions.customerscustomer_id', 'customers.customer_id')
        ->whereDay('transactions.created_at', date_format(Carbon::now()->toDate(),'d'))
        ->where('transactions.companiescompanies_id', Auth::user()->companiescompanies_id)
        ->where('transactions.delivery_status','ACTIVE')
        ->sum('total_charge');

        return response()->json( [$totaltransactionstoday,
                                 $totalchargestoday,
                                 $totalcommissiontoday,
                                 $totaltoday
                                 ]);
   }

   function profilePage(){
    $company = Company::join('company_addresses','companies.companies_id','company_addresses.companiescompanies_id')
    ->join('company_socialmedia_handles','companies.companies_id','company_socialmedia_handles.companiescompanies_id')
    ->where('companies.companies_id',Auth::user()->companiescompanies_id)->first();
    return view('dashboard.dashboardprofile',compact('company'));
    }


    public function updateProfile(Request $info){
        Company::where('companies_id',Auth::user()->companiescompanies_id)
        ->update([
            "company_abbreviation" => $info->company_abbreviation,
            "company_phone_one" => $info->company_phone_one,
            "company_phone_two" => $info->company_phone_two,
        ]);

        Company_address::where('companiescompanies_id',Auth::user()->companiescompanies_id)
        ->update([
            "address" => $info->address,
            "city" => $info->city,
            "area" => $info->area,
            "region" => $info->region,
        ]);

        User::where('companiescompanies_id',Auth::user()->companiescompanies_id)
        ->update([
            "email"=>$info->email
        ]);

        //Session::flush("message","");

        return redirect()->back()->with("message","Your details have been updated successfully");
    }


    public function updatepassword(Request $request){

        User::where('companiescompanies_id',Auth::user()->companiescompanies_id)
        ->update([
            "password" => Hash::make($request->password)
        ]);

        return response()->json("Password updated successfully");
    }

    public function companyridersIdentifications(){
        $ridersids = Companies_rider::where('companiescompanies_id', Auth::user()->companiescompanies_id)
        ->get()->pluck('company_riderscompany_rider_id');

        return response()->json($ridersids);
    }

    public function renderDeliveries(){
      $company_rider_bikes =  Company_rider::join('rider_assigned_motor_bikes','company_riders.company_rider_id','rider_assigned_motor_bikes.company_riderscompany_rider_id')
      ->join('motor_bikes','rider_assigned_motor_bikes.motor_bikesbike_id','motor_bikes.bike_id')
      ->select('first_name', 'last_name', 'brand_name','registered_number', 'company_rider_id', 'bike_id','rider_assigned_motor_bikes.companiescompanies_id')
      ->where('rider_assigned_motor_bikes.companiescompanies_id', Auth::user()->companiescompanies_id)
      ->where('company_riders.delete_status','NOT DELETED')
      ->get();

      $company_clients = Company_client::select('client_first_name', 'client_last_name', 'client_primary_number','company_clients_id')->where('company_id', Auth::user()->companiescompanies_id)->get();

      return view('dashboard.deliveries.deliveries', compact('company_rider_bikes','company_clients'));
      // return response()->json($company_rider_bike);
    }

    //method to upload the manual record
    public function manual_record_upload(Request $request){
      $trans_generate = date('Y',strtotime(Carbon::now())) . date('i',strtotime(Carbon::now()));
      $rider_details = json_decode($request->rider_details);
      $customer = "";
      $name;
      $company_client_identificaton = "";

      if ($request->client_identification != -1){
           $customer = Company_client::where('company_clients_id', $request->client_identification)->first();
           if ($customer != null){
                $company_client_identificaton = $customer->company_clients_id;
           }
      } else {
        $name = explode(" ",$request->customer_name);
        $name_count = count($name);
        $name_parts = [];
        if ($name_count > 1){
            for ($i = 0; $i < $name_count; $i++){
                if ($name[$i] != null){
                    array_push($name_parts, $name[$i]);
                }
            }
        }


        $customer = Company_client::create([
        "client_first_name"=> $name_parts[0],
        "client_last_name"=> count($name_parts) > 1 ? $name_parts[1]: " ",
        "client_primary_number"=>"+233".$request->phone_number,
        "company_id" => $rider_details->companiescompanies_id
        ]);

        if ($customer != null) {
            $customer = Company_client::where('client_primary_number', "+233".$request->phone_number)->first();
            $company_client_identificaton = $customer->company_clients_id;
        }

      }


      $trans = Transaction::create([
        "company_riderscompany_rider_id"=>$rider_details->company_rider_id,
        "company_client_id"=> $company_client_identificaton,
        "companiescompanies_id"=>$rider_details->companiescompanies_id,
        "motor_bikesbike_id"=>$rider_details->bike_id,
        "destination"=>$request->destination,
        "source"=>$request->source,
        "delivery_status"=> $request->schedule_action_type,
        "payment_mode" =>$request->payment_mode
      ]);

      if ($request->schedule_action_type == "Scheduled Delivery") {
            Company_schedule::create([
                "transactionstransaction_id" => $trans->transaction_id,
                "schedule_date" => $request->schedule_date,
                "schedule_time" => $request->schedule_time
            ]);
      }


      Payment::create([
        "transactionstransaction_id"=>$trans->transaction_id,
        "company_client_id"=>$company_client_identificaton,
        "transaction_number"=>$trans_generate. $trans->transaction_id,//generate trans number
        "delivery_charge"=>$request->delivery_charge,
        "total_charge"=>$request->delivery_charge,
        "payment_type"=>$request->payment_type,
      ]);

      Rating::create([
          "rate_value" => 1,
          "transactions_id" => $trans->transaction_id,
          "company_riderscompany_rider_id" => $rider_details->company_rider_id,
          "company_client_id" => $company_client_identificaton,
          "company_id" => Auth::user()->companiescompanies_id
      ]);

      return response()->json(["transaction " => $trans, "customer" => $customer]);
    }


    public function getScheduledTransaction(){
        $company_clients = Company_client::join("transactions","company_clients.company_clients_id","transactions.company_client_id")
            ->join("payments", "transactions.transaction_id","payments.transactionstransaction_id")
            ->join("company_riders","transactions.company_riderscompany_rider_id","company_riders.company_rider_id")
            ->join("company_schedules","transactions.transaction_id", "company_schedules.transactionstransaction_id")
            ->where("transactions.companiescompanies_id", Auth::user()->companiescompanies_id)
            ->get();
            $clientset = [];

            if ($company_clients != null){
                foreach($company_clients as $company_client){
                    $temp_client =[];
                    array_push($temp_client,
                        $company_client->transaction_number,
                        $company_client->client_first_name . " " . $company_client->client_last_name,
                        $company_client->client_primary_number,
                        $company_client->destination,
                        $company_client->source,
                        date("jS F Y", strtotime($company_client->schedule_date)),
                        $company_client->first_name . " " . $company_client->last_name,
                        "<button class='btn btn-info btn-outline updateScheduleDelivery'  data-clients=''> Update Schedule </button>"
                    );
                    array_push($clientset, $temp_client);
                }
            } else {
                $empty_temp = ["","","","","","","",""];
                array_push($clientset, $empty_temp);
            }

            return response()->json(["data" => $clientset]);
        }



    public function inputCompanyClient(Request $request){
          $isCreated =  Company_client::create([
                "client_first_name" => $request->first_name,
                "client_last_name" => $request->last_name,
                "client_primary_number" => $request->contact_number,
                "client_alt_number" => $request->number_two,
                "location" => $request->location,
                "email_address" => $request->email,
                "company_name" => $request->company_name
            ]);

            return response()->json($isCreated);
    }

}
