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
            'account' => true,
            'rider_id' => $rider_id,
            'company_id' => 1,
            'first_time_sign_in' => true
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
        $riders = DB::table('company_riders')->join('riders_addresses','company_riders.company_rider_id','riders_addresses.company_riderscompany_rider_id')->get();    
        $ridersarray = array();
        if ($riders != null){
            foreach ($riders as $rider){
                        $recordarray = array();
                        array_push($recordarray,
                            $rider->first_name. " ". $rider->last_name,
                            $rider->city,
                            $rider->area,
                            $rider->personal_phone,
                            '<a  href="/aboutriders/'.$rider->company_rider_id.'" class="btn btn-primary"> View </a>',
                            '<button class="btn btn-success assignride" id="'.$rider->company_rider_id.'"> Assign </button>',
                            '<button class="btn btn-danger"> Deactivate </button>'
                        );
                        array_push($ridersarray, $recordarray);
                    }
        } else {
            $emptyarray = array("", "", "", "", "", "", "");
            array_push($ridersarray, $emptyarray);
        }
        
        return response()->json(['data' => $ridersarray]);
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
}
