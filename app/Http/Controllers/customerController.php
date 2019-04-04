<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Customer;
use App\customer_login;

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
}
