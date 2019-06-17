<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Customer;
use App\customer_login;
use Auth;
use App\company_rider;
use App\Company;
use App\Companies_rider;
use App\Transaction;
use App\Payment;
use App\Rating;
use App\Android_report;

class customerController extends Controller
{
    function registerCustomer(Request $request){
        $customer_id = Customer::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number
        ])->latest()->value("customer_id");

        // $encryptCustomerPassword = bcrypt($request->password);
        customer_login::create([
            'phone_number' => $request->phone_number,
            'password' => bcrypt($request->password),
            'customerscustomer_id' => $customer_id,
            'account_status' => 'ACTIVE'
        ]);

        $customer_data = Customer::where('customer_id', $customer_id)->first();

        return response()->json([
                        'success_cue' => 'Success',
                        'customer_id' => $customer_id,
                        'first_name' => $customer_data->first_name,
                        'last_name' => $customer_data->last_name,
                        'phone_number' => $customer_data->phone_number
             ]);
    }


    function companyInformation(Request $request){
        $data = company_rider::join('companies_riders', 'company_riders.company_rider_id','companies_riders.company_riderscompany_rider_id')
         ->join('companies','companies.companies_id','companies_riders.companiescompanies_id')
         ->join('rider_assigned_motor_bikes', 'rider_assigned_motor_bikes.company_riderscompany_rider_id', 'company_riders.company_rider_id')
         ->join('motor_bikes','motor_bikes.bike_id', 'rider_assigned_motor_bikes.motor_bikesbike_id')
         ->latest('rider_assigned_motor_bikes.created_at')
         ->where('company_riders.company_rider_id', $request->rider_id)->first();

        return response()->json($data);
    }

    function updateCustomerTransaction(Request $request){
            $transactionResponse = "";
            $transaction = new Transaction();
            $transaction->company_riderscompany_rider_id = $request->company_riderscompany_rider_id;
            $transaction->customerscustomer_id = $request->customerscustomer_id;
            $transaction->companiescompanies_id = $request->companiescompanies_id;
            $transaction->motor_bikesbike_id = $request->motor_bikesbike_id;
            $transaction->destination = $request->destination;
            $transaction->source = $request->source;
            $transaction->delivery_status = $request->delivery_status;

            if($transaction->save()){
                $payment = new Payment();
                $payment->transactionstransaction_id = $transaction->transaction_id;
                $payment->customerscustomer_id = $request->customerscustomer_id;
                $payment->transaction_number = "";
                $payment->delivery_charge = $request->delivery_charge;
                $payment->commission_charge = $request->commission_charge;
                $payment->payment_type = $request->payment_type;
                $payment->total_charge = ($request->delivery_charge + $request->commission_charge);
                
                if($payment->save()){
                    $transactionResponse = [
                            "success" => "Done"
                        ];
                }
            } else {
                $transactionResponse = [
                    "success" => "Failed"
                ];
            }
            return response()->json($transactionResponse);
    }




    function customerAndroidReport(Request $request){
         Android_report::create($request->all());
         return response(["Done" => "Successful"]);
    }



    function ratedeliverycompany(Request $request){
            Rating::create($request->all());

            return response()->json(['success' => 'successful']);
    }



      function getcustomertransactions(Request $request){
        $transactions = Transaction::join('payments', 'transactions.transaction_id', 'payments.transactionstransaction_id')
        ->join('companies', 'transactions.companiescompanies_id', 'companies.companies_id')
        ->join('company_riders', 'transactions.company_riderscompany_rider_id', 'company_riders.company_rider_id')
        ->join('motor_bikes', 'transactions.motor_bikesbike_id', 'motor_bikes.bike_id')
        ->where('transactions.customerscustomer_id', $request->customer_id)
        ->get();

        return response()->json($transactions);

    }


    function authenticateUser(Request $request){

       $customer_phoneNumber = $request->phone_number;
       $customer_password = $request->password;
       $customer_validNumber;

       if (strlen($customer_phoneNumber) == 10){
            $substring_phoneNumber = substr($customer_phoneNumber, 1);
            $customer_validNumber = "+233" . $substring_phoneNumber;
       } 

        if (Auth::guard('customer_login')->attempt(['phone_number' => $customer_validNumber, 'password' => $customer_password])){

                if (Auth::guard('customer_login')->user()->account_status == "ACTIVE"){
                        $customer_data = Customer::where('customer_id', Auth::guard('customer_login')->user()->customerscustomer_id)->first();
                        return response()->json([
                        'success_cue' => 'Success',
                        'customer_id' => $customer_data->customer_id,
                        'first_name' => $customer_data->first_name,
                        'last_name' => $customer_data->last_name,
                        'phone_number' => $customer_data->phone_number
                    ]);
                } else {
                        return response()->json([
                        'success_cue' => 'Deactivated'
                    ]);
                }
                
        } else {
            return response()->json([
                    'success_cue' => "Failed"
                ]);
        }

    }
}
