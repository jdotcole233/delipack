<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use App\company_rider;
use App\Companies_rider;
use App\Riders_address;
use App\Riders_license;
use App\User;
use App\Rider_login;
use DB;
use App\Motor_bike;
use App\Rider_assigned_motor_bike;
use Auth;


class riderController extends Controller
{
    function func_registerrider(Request $request){
        $rider_id = company_rider::create($request->all())->latest()->value('company_rider_id');
        Riders_address::create([
            'company_riderscompany_rider_id' => $rider_id,
            'address' => $request->address,
            'region' => $request->region,
            'city' => $request->city,
            'area' => $request->area
        ]);
        Riders_license::create([
            'company_riderscompany_rider_id' => $rider_id,
            'company_id' => 1,
            'License_type' => $request->license_type,
            'License_number' => $request->license_number,
            'Expiry_date' => $request->expiry_date,
            'date_of_issue' => $request->date_of_issue

        ]);
        Companies_rider::create([
            'company_riderscompany_rider_id' => $rider_id,
            'companiescompanies_id' => 1
        ]);

        Rider_login::create([
            'phone_number' => $request->personal_phone,
            'password' => bcrypt('123456'),
            'account' => "ACTIVE",
            'rider_id' => $rider_id,
            'company_id' => 1,
            'first_time_sign_in' => 'true'
        ]);


        return response()->json('Account created successfully!!');

    }



    function uploadRiderprofile(Request $request) {
        $profile_image = $request->file('profile_picture');
        // $a = Image::make($profile_image)->resize(300,200)->save('app.png');
        // return response()->json(['a' => $request]);
        // echo ($request);
        return response()->json($request);
    }



    function ridersinformation(){
        $riders = DB::table('company_riders')
        ->join('riders_addresses','company_riders.company_rider_id','riders_addresses.company_riderscompany_rider_id')
        ->latest('company_riders.created_at')
        ->get();    


        $ridersarray = array();
        if ($riders != null){
            foreach ($riders as $rider){
            $recordarray = array();
                 if ($rider->assigned_bike == 0){
                    array_push($recordarray,
                        $rider->first_name. " ". $rider->last_name,
                        $rider->city,
                        $rider->area,
                        $rider->personal_phone,
                        '<a  href="/aboutriders/'.$rider->company_rider_id.'" class="btn btn-primary"> View </a>',
                        '<button class="btn btn-success assignride" id="'.$rider->company_rider_id.'"> Assign </button>',
                        '<button class="btn btn-danger"> Deactivate </button>'
                    );
                 } else {
                     array_push($recordarray,
                        $rider->first_name. " ". $rider->last_name,
                        $rider->city,
                        $rider->area,
                        $rider->personal_phone,
                        '<a  href="/aboutriders/'.$rider->company_rider_id.'" class="btn btn-primary"> View </a>',
                        '<button class="btn btn-warning assignride" id="'.$rider->company_rider_id.'"> Unassign </button>',
                        '<button class="btn btn-danger"> Deactivate </button>'
                    );
                 }
                        
                        array_push($ridersarray, $recordarray);
            }
        } else {
            $emptyarray = array("", "", "", "", "", "", "");
            array_push($ridersarray, $emptyarray);
        }
        
        return response()->json(['data' => $ridersarray ]);
    }


    function riderinformation($riderID){
        //transactions
        $company_rider_name = company_rider::where('company_rider_id', $riderID)->select('first_name', 'last_name', 'company_rider_id')->first();
        return view("dashboard.riders.aboutrider", compact('company_rider_name'));
    }


    function ridereditinformation($riderID){
        $edit_info =  DB::table('company_riders')
                        ->join('riders_addresses','company_riders.company_rider_id','riders_addresses.company_riderscompany_rider_id')
                        ->join('riders_licenses','company_riders.company_rider_id','riders_licenses.company_riderscompany_rider_id')
                        ->where('company_riders.company_rider_id', $riderID)
                        ->first();
        return response()->json($edit_info);
    }


    function getallrides(){
        $rides = Motor_bike::where('status', 0)->get();
        return view('dashboard.riders.riders', compact('rides'));
    }

    function insertRiderAndAssign(Request $request){
        Rider_assigned_motor_bike::create($request->all());
        Motor_bike::where('bike_id', $request->motor_bikesbike_id)->update([
            'status' => 1
        ]);
        company_rider::where('company_rider_id', $request->company_riderscompany_rider_id)
        ->update([
            'assigned_bike' => 1
        ]);
       
        return response()->json('Bike assigned to rider');
    }

    function editriderprofile(Request $request){
        company_rider::where('company_rider_id', $request->rider_id)
        ->update([
            'first_name' => $request->first_name,
            'other_name' => $request->other_name,
            'last_name' => $request->last_name,
            'gender' => $request->gender,
            'work_phone' => $request->personal_phone,
            'personal_phone' => $request->work_phone,
            'about' => $request->about,
        ]);
        Riders_address::where('company_riderscompany_rider_id', $request->rider_id)
        ->update([
            'address' => $request->address,
            'region' => $request->region,
            'city' => $request->city,
            'area' => $request->area
        ]);
        Riders_license::where('company_riderscompany_rider_id', $request->rider_id)
        ->update([
            'License_number' => $request->License_number,
            'License_type' => $request->License_type,
            'Expiry_date' => $request->Expiry_date,
            'date_of_issue' => $request->date_of_issue 
        ]);

        return response()->json("Updated successfully");
    }

    function unassignbiker(Request $request){
        $unassign= Rider_assigned_motor_bike::where('company_riderscompany_rider_id', $request->rider_id)->latest()->first();
        company_rider::where('company_rider_id', $unassign->company_riderscompany_rider_id)
        ->update([
            'assigned_bike' => 0
        ]);
        Motor_bike::where('bike_id', $unassign->motor_bikesbike_id)
        ->update([
            'status' => 0
        ]);
        Rider_assigned_motor_bike::where('company_riderscompany_rider_id', $request->rider_id)->delete();


        // Rider_assigned_motor_bike::where('company_riderscompany_rider_id', $request->company_riderscompany_rider_id)
        // ->update([
        //     'assigned_bike' => 0
        // ]);

        return response()->json("Bike unassigned");

    }

    public function authenticateDriver(Request $request){
        
        $driver_phoneNumber = $request->phone_number;
        $driver_password = $request->password;
     
            if (Auth::guard('driver_login')->attempt(['phone_number' => $driver_phoneNumber, 'password' => $driver_password])){
                    $driver = Rider_login::where('phone_number', $driver_phoneNumber)->first();
                    
                    if ($driver->account_status == "ACTIVE"){
                            $driver_data = company_rider::where('company_rider_id', $driver->rider_id)->get();
                            return response()->json([
                            'success_cue' => 'Success',
                            'rider_id' => $driver->rider_id,
                            'first_name' => $driver_data[0]->first_name,
                            'last_name' => $driver_data[0]->last_name,
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
                'password' => bcrypt($request->password),
                'first_time_sign_in' => 'false'
            ]);
            
            return response()->json([
                'success_cue' => 'Successful',
                'password_response' => $updatepass
            ]);
    }
}
