<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class driverController extends Controller
{
    public function authenticateDriver(Request $request){
        
        $driver_phoneNumber = $request->phone_number;
        $driver_password = $request->password;
        $driver_validNumber;

        if (strlen($driver_phoneNumber) == 10){
                $substring_phoneNumber = substr($driver_phoneNumber, 1);
                $driver_validNumber = "+233" . $substring_phoneNumber;
        } 

            if (Auth::guard('driver_login')->attempt(['phone_number' => $driver_validNumber, 'password' => $driver_password])){

                    if (Auth::guard('driver_login')->user()->account_status == "ACTIVE"){
                            $driver_data = company_rider::where('company_rider_id', Auth::guard('driver_login')->user()->companycompany_riders_id)->first();
                            return response()->json([
                            'success_cue' => 'Success',
                            'customer_id' => Auth::guard('driver_login')->user()->companycompany_riders_id,
                            'first_name' => $driver_data->first_name,
                            'last_name' => $driver_data->last_name,
                            'phone_number' => $driver_data->phone_number,
                            'company_id' => $driver_data->company_id
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
