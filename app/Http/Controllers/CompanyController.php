<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use App\Payment;
use App\Rating;
use App\Company_rider;
use App\Company;
use DB;
use Auth;
use Carbon\Carbon;

class CompanyController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function totalSales(Request $request){
        $annual_total = [];
        $totalsales = Transaction::join('payments', 'transactions.transaction_id', 'payments.transactionstransaction_id')
        ->where('transactions.companiescompanies_id', Auth::user()->id)
        ->where('transactions.delivery_status', 'ACTIVE')
        ->select(DB::raw("DATE_FORMAT(transactions.created_at, '%m') as month"),DB::raw('delivery_charge'))->get()
        ->groupBy('month');

        $totalerrands = Transaction::where('companiescompanies_id', Auth::user()->id)
        ->select(DB::raw("DATE_FORMAT(transactions.created_at, '%m') as month"),DB::raw('companiescompanies_id'))
        ->get()
        ->groupBy('month');

        $totalratings = Rating::where('company_id', Auth::user()->id)
       ->select(DB::raw("DATE_FORMAT(ratings.created_at, '%m') as month"),DB::raw('rate_value'))
        ->get()
        ->groupBy('month');

        $riderAssignedandTransactions = Company_rider::join('rider_assigned_motor_bikes', 'company_riders.company_rider_id', 'rider_assigned_motor_bikes.company_riderscompany_rider_id')
         ->join('motor_bikes', 'rider_assigned_motor_bikes.motor_bikesbike_id','motor_bikes.bike_id')
         ->select('company_rider_id','first_name','last_name','work_phone', 'brand_name','registered_number')
         ->where('rider_assigned_motor_bikes.companiescompanies_id', Auth::user()->id)
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
        ->select('transaction_id','rate_value','brand_name','registered_number','destination','source','delivery_status','payments.created_at as paidon', 'delivery_charge', 'commission_charge', 'payment_type', 'total_charge', 'customers.first_name as customerFirstName',
                 'customers.last_name as customerLastName', 'customers.phone_number as customerPhoneNumber', 'company_riders.first_name as ridersFirstName', 'company_riders.company_rider_id as rider_id', 'company_riders.last_name as ridersLastName', 'work_phone', 'personal_phone')
        ->where('transactions.companiescompanies_id', Auth::user()->id)
        ->orderBy('transactions.created_at')
        ->get();
        
        $trans = [];
        if($transactions != null){
            foreach($transactions as $transaction){
                $inittrans = [];
                $encodeData = json_encode($transaction);
                array_push($inittrans,
                    $transaction->rate_value, //change this
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
        ->select('transaction_id','delivery_charge','registered_number','destination','source','delivery_status',
                'payments.created_at as paidon', 'commission_charge', 'payment_type', 'total_charge',
                'customers.first_name as customerFirstName','customers.last_name as customerLastName', 
                'customers.phone_number as customerPhoneNumber', 'company_riders.first_name as ridersFirstName',
                'company_riders.company_rider_id as rider_id', 'company_riders.last_name as ridersLastName', 
                'work_phone', 'personal_phone')
        ->whereBetween('transactions.created_at', [$request->fromdate, $request->todate])
        ->where('transactions.companiescompanies_id', 1)
        ->orderBy('transactions.created_at')
        ->get();

        $totaltransactioncharges = Transaction::join('payments', 'transactions.transaction_id', 'payments.transactionstransaction_id')
        ->join('customers','transactions.customerscustomer_id', 'customers.customer_id')
        ->whereBetween('transactions.created_at', [$request->fromdate, $request->todate])
        ->where('transactions.companiescompanies_id', 1)
        ->sum('delivery_charge');

        $trans = [];
        $em_array  =["1", "2", "3", "4", "5", "6", "7", "8"];
        if(sizeof($transactions) != 0){
            foreach($transactions as $transaction){
                $inittrans = [];
                $encodeData = json_encode($transaction);
                array_push($inittrans,
                    $transaction->transaction_id, //change this
                    $transaction->customerFirstName . " " . $transaction->customerLastName,
                    $transaction->source,
                    $transaction->destination,
                    $transaction->ridersFirstName . " " . $transaction->ridersLastName,
                    $transaction->paidon,
                    $transaction->delivery_charge
                 );

                 array_push($trans, $inittrans);
            }
        } else {
            $em_array = ["", "", "", "", "", "", ""];
            array_push($trans,$em_array);

        } 


        return response()->json(['data' => $trans, 'total' => $totaltransactioncharges]);
   }


   public function getridersalesfortoday(){

      $totaltransactionstoday = Transaction::join('payments', 'transactions.transaction_id', 'payments.transactionstransaction_id')
        ->join('customers','transactions.customerscustomer_id', 'customers.customer_id')
        ->whereDay('transactions.created_at', date_format(Carbon::now()->toDate(),'d'))
        ->where('transactions.companiescompanies_id', Auth::user()->id)
        ->count('transactions.transaction_id');

        $totalchargestoday = Transaction::join('payments', 'transactions.transaction_id', 'payments.transactionstransaction_id')
        ->join('customers','transactions.customerscustomer_id', 'customers.customer_id')
        ->whereDay('transactions.created_at', date_format(Carbon::now()->toDate(),'d'))
        ->where('transactions.companiescompanies_id', Auth::user()->id)
        ->sum('delivery_charge');

         $totalcommissiontoday = Transaction::join('payments', 'transactions.transaction_id', 'payments.transactionstransaction_id')
        ->join('customers','transactions.customerscustomer_id', 'customers.customer_id')
        ->whereDay('transactions.created_at', date_format(Carbon::now()->toDate(),'d'))
        ->where('transactions.companiescompanies_id', Auth::user()->id)
        ->sum('commission_charge');

        return response()->json( [$totaltransactionstoday,
                                 $totalchargestoday,
                                 $totalcommissiontoday]);
   }

   function profilePage(){
    $company = Company::join('company_addresses','companies.companies_id','company_addresses.companiescompanies_id')
    ->where('companies.companies_id',Auth::user()->companiescompanies_id)->first();
    return view('dashboard.dashboardprofile',compact('company'));
    }


    public function updateProfile(Request $info){

        return back();
    }

}
