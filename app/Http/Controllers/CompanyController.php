<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use App\Payment;
use App\Rating;
use App\Company_rider;
use DB;

class CompanyController extends Controller
{
    public function totalSales(Request $request){
        $annual_total = [];
        $totalsales = Transaction::join('payments', 'transactions.transaction_id', 'payments.transactionstransaction_id')
        ->where('transactions.companiescompanies_id', 1)
        ->where('transactions.delivery_status', 'ACTIVE')
        ->select(DB::raw("DATE_FORMAT(transactions.created_at, '%m') as month"),DB::raw('delivery_charge'))->get()
        ->groupBy('month');

        $totalerrands = Transaction::where('companiescompanies_id', 1)
        ->select(DB::raw("DATE_FORMAT(transactions.created_at, '%m') as month"),DB::raw('companiescompanies_id'))
        ->get()
        ->groupBy('month');

        $totalratings = Rating::where('company_id', 1)
       ->select(DB::raw("DATE_FORMAT(ratings.created_at, '%m') as month"),DB::raw('rate_value'))
        ->get()
        ->groupBy('month');

        $riderAssignedandTransactions = Company_rider::join('rider_assigned_motor_bikes', 'company_riders.company_rider_id', 'rider_assigned_motor_bikes.company_riderscompany_rider_id')
         ->join('motor_bikes', 'rider_assigned_motor_bikes.motor_bikesbike_id','motor_bikes.bike_id')
         ->select('company_rider_id','first_name','last_name','work_phone', 'brand_name','registered_number')
         ->where('rider_assigned_motor_bikes.companiescompanies_id', 1)
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
//         ->select('brand_name','registered_number',destination','source','delivery_status','payments.created_at as paidon', 'delivery_charge', 'commission_charge', 'payment_type', 'total_charge', 'customers.first_name as customerFirstName',
// 'customers.last_name as customerLastName', 'customers.phone_number as customerPhoneNumber', 'company_riders.first_name as ridersFirstName', 'company_riders.last_name as ridersLastName', 'work_phone', 'personal_phone')
        ->where('transactions.companiescompanies_id', 1)
        ->orderBy('transactions.created_at')
        ->get();

        return response()->json($transactions);
    }


}
