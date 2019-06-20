<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Rider_login;
use App\company_rider;
use Hash;

class MobileRiderController extends Controller
{
        public function authenticateDriver(Request $request){
        
        $driver_phoneNumber = $request->phone_number;
        $driver_password = $request->password;
     
            if (Auth::guard('driver_login')->attempt(['phone_number' => $driver_phoneNumber, 'password' => $driver_password])){
                    $driver = Rider_login::where('phone_number', $driver_phoneNumber)->first();
                    
                    if ($driver->account_status == "ACTIVE"){
                            $driver_data = company_rider::where('company_rider_id', $driver->rider_id)->first();
                            return response()->json([
                            'success_cue' => 'Success',
                            'rider_id' => $driver->rider_id,
                            'first_name' => $driver_data->first_name,
                            'last_name' => $driver_data->last_name,
                            'phone_number' => $driver->phone_number,
                            'company_id' => $driver->company_id,
                            'first_time_sign_in' => $driver->first_time_sign_in,
                            'account_status' => $driver->account_status
                        ]);
                    } else {
                            return response()->json([
                            'success_cue' => 'Deactivated',
                            'account_status' => "",
                            'first_time_sign_in' => ""
                        ]);
                    }
                    
            } else {
                return response()->json([
                        'success_cue' => "Failed",
                        'account_status' => $request->phone_number,
                        'first_time_sign_in' => $request->password
                    ]);
            }
    }


    public function changePassword(Request $request){
            $updatepass = Rider_login::where('rider_id', $request->rider_id)->update([
                'password' => Hash::make($request->password),
                'first_time_sign_in' => 'false'
            ]);
            
            return response()->json([
                'success_cue' => 'Successful',
                'password_response' => $updatepass
            ]);
    }

}