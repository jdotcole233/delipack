<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Customer;
use App\customer_login;
use Auth;

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

        return response()->json([
            'data' => 'successful'
        ]);
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

                if (Auth::guard('customer_login')->user()->get()[0]->account_status == "ACTIVE"){
                        $customer_data = Customer::where('customer_id', Auth::guard('customer_login')->user()->get()[0]->customerscustomer_id)->get();
                        return response()->json([
                        'success_cue' => 'Success',
                        'customer_id' => Auth::guard('customer_login')->user()->get()[0]->customerscustomer_id,
                        'first_name' => $customer_data[0]->first_name,
                        'last_name' => $customer_data[0]->last_name,
                        'phone_number' => $customer_data[0]->phone_number
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
