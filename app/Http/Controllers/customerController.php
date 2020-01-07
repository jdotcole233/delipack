<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Customer;
use App\Customer_login;
use Auth;
use App\company_rider;
use App\Company;
use App\Companies_rider;
use App\Transaction;
use App\Payment;
use App\Rating;
use App\Android_report;
use Carbon\Carbon;
use App\Datacleaner;

class customerController extends Controller
{
    function registerCustomer(Request $request){
        $request = Datacleaner::cleaner($request->all());
        $isRegistered = Customer::where('phone_number',$request["phone_number"])->first();
        if($isRegistered == null){
            $customer_id = Customer::create([
                'first_name' => $request["first_name"],
                'last_name' => $request["last_name"],
                'email' => $request["email"],
                'phone_number' => $request["phone_number"]
            ])->latest()->value("customer_id");

            // $encryptCustomerPassword = bcrypt($request->password);
            Customer_login::create([
                'phone_number' => $request["phone_number"],
                'password' => bcrypt($request["password"]),
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
            ], 200);
        }else{
            return response()->json([
                'success_cue' => 'Failed',
                'customer_id' => "",
                'first_name' => "",
                'last_name' => "",
                'phone_number' => ""
            ], 500);
        }


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
            $trans_generate = date('Y',strtotime(Carbon::now())) . date('i',strtotime(Carbon::now()));
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
                $payment->transaction_number = $trans_generate. $transaction->transaction_id;
                $payment->delivery_charge = $request->delivery_charge;
                $payment->commission_charge = $request->commission_charge;
                $payment->payment_type = $request->payment_type;
                $payment->total_charge = ($request->delivery_charge + $request->commission_charge);

                if($payment->save()){
                    $transactionResponse = [
                            "success" => "Done",
                            "transaction_id" => $transaction->transaction_id
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
            Rating::create([
                'rate_value' => $request->rate_value,
                'company_riderscompany_rider_id' => $request->company_riderscompany_rider_id,
                'customerscustomer_id' => $request->customerscustomer_id,
                'company_id' => $request->company_id,
                'transactions_id' => $request->transactions_id
            ]);

            return response()->json(['success' => "successful"]);
    }



      function getcustomertransactions(Request $request){
        $transactions = Transaction::join('payments', 'transactions.transaction_id', 'payments.transactionstransaction_id')
        ->join('companies', 'transactions.companiescompanies_id', 'companies.companies_id')
        ->join('company_riders', 'transactions.company_riderscompany_rider_id', 'company_riders.company_rider_id')
        ->join('motor_bikes', 'transactions.motor_bikesbike_id', 'motor_bikes.bike_id')
        ->select('companies_id','company_name','source','destination','delivery_status','payment_type','total_charge','first_name','last_name','registered_number','transactions.created_at','transaction_number','company_logo_path')
        ->where('transactions.customerscustomer_id', $request->customer_id)
        ->get();
        // ->orderBy('transactions.created_at');

        return (count($transactions) > 0 ) ? response()->json($transactions, 200) : response()->json([ "error" => "Empty history"],500);

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
                        ], 200);
                } else {
                        return response()->json([
                        'success_cue' => 'Deactivated'
                        ], 500);
                }

        } else {
            return response()->json([
                    'success_cue' => "Failed"
            ], 500);
        }

    }



    //Cancel errand in session

    public function customererrandsessioncancel(Request $request){
        $trans_cancelled = Transaction::where('transaction_id',$request->transactions_id)->update([
            "delivery_status" => "CANCELLED"
        ]);

        return ($trans_cancelled == 1 ) ? response()->json(["success" => "Cancelled"], 200) : response()->json(["error" => "Cancelling failed.. Try again"], 500);

    }

}
