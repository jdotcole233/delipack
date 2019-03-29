<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Motor_bike;

class rideController extends Controller
{
    function regRide(Request $request){
        Motor_bike::create($request->all());
        return response()->json("Ride registered successfully");
    }

    function getregRides(){
        $registeredbikes = Motor_bike::all();
        $regarray = array();
        if ($registeredbikes != null){
            foreach ($registeredbikes as $registeredbike) {
                $recbike = array();
                array_push($recbike, 
                $registeredbike->brand_name,
                $registeredbike->registered_number,
                $registeredbike->date_of_expiry,
                '<button class="btn btn-primary" data-toggle="modal" data-target=".bd-rideeditform-modal-lg">View</button>',
                '<button class="btn btn-primary">Delete</button>'
                );
                array_push($regarray, $recbike);
            }
        } else {
            $emptyarray = array("","","","","");
            array_push($regarray, $emptyarray);

        }
        return response()->json(['data' => $regarray]);
    }
}
