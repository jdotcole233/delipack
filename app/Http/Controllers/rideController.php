<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Motor_bike;
use Auth;

class rideController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    function regRide(Request $request){
        Motor_bike::create($request->all());
        return response()->json("Ride registered successfully");
    }

    function getregRides(){
        $registeredbikes = Motor_bike::where('companiescompanies_id',Auth::user()->companiescompanies_id)
        ->where("delete_status","NOT DELETED")
        ->get();

        $regarray = array();
        if ($registeredbikes != null){
            foreach ($registeredbikes as $registeredbike) {
                $recbike = array();
                array_push($recbike, 
                $registeredbike->brand_name,
                $registeredbike->registered_number,
                $registeredbike->date_of_expiry,
                '<button class="btn btn-primary editmotor" id="'.$registeredbike->bike_id.'">View</button>',
                '<button data-id="'.$registeredbike->bike_id.'" class="btn btn-primary motorBikeDeleteBtn">Delete</button>'
                );
                array_push($regarray, $recbike);
            }
        } else {
            $emptyarray = array("","","","","");
            array_push($regarray, $emptyarray);

        }
        return response()->json(['data' => $regarray]);
    }

    function motorinformation($motor_id){
        $motor_data = Motor_bike::where('bike_id', $motor_id)->first();
        return response()->json($motor_data);
    }

    function editmotorinformation(Request $request){
        Motor_bike::where('bike_id', $request->bike_id)
        ->update($request->all());
        return response()->json("Updated successfully");
    }


    public function deleteBike($id){
        Motor_bike::where('bike_id',$id)->update([
            "delete_status" => "DELETED"
        ]);
        return response()->json("Motor Bike  removed successfully");
    }
}
