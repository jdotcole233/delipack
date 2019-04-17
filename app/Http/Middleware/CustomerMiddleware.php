<?php

namespace App\Http\Middleware;

use Closure;
use App\Customer;

class CustomerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $customer_phoneNumber = $request('phone_number');
        $customer_password = $request('password');

        if (Auth::attempt($customer_phoneNumber, $customer_password)){
                if (Auth::account_status == "ACTIVE"){
                        $customer_data = Customer::where('customer_id', Auth::customerscustomer_id)->get();
                        return response()->json([
                        'customer_id' => Auth::customerscustomer_id,
                        'first_name' => $customer_data->first_name,
                        'last_name' => $customer_data->last_name,
                        'phone_number' => $customer_data->phone_number
                    ]);
                } else {
                        return response()->json([
                        'failure_message' => 'Your account has been  deactivated'
                    ]);
                }
                
        } else {
            return response()->json([
                    'login_failure' => "Failed"
                ]);
        }

        return $next($request);
    }
}
