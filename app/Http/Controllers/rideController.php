<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Motor_bike;
use App\Datacleaner;
use Auth;

class rideController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    function regRide(Request $request){
        $motor = Motor_bike::create(Datacleaner::cleaner($request->all()));
        return ($motor != null ) ? response()->json(["success" => "Ride registered successfully"], 200) : response()->json(["error" => "Ride registered successfully"], 500);
    }

    function getregRides(){
        $registeredbikes = Motor_bike::where('companiescompanies_id',Auth::user()->companiescompanies_id)
        ->where("delete_status","NOT DELETED")
        ->get();

        $regarray = array();
        if ($registeredbikes != null){
            foreach ($registeredbikes as $registeredbike) {
                $recbike = array();
                if($registeredbike->status == 1){
                    array_push($recbike,
                    $registeredbike->brand_name,
                    $registeredbike->registered_number,
                    $registeredbike->date_of_expiry,
                    '<button class="btn btn-primary editmotor" id="'.$registeredbike->bike_id.'">View</button>',
                    '<button data-id="'.$registeredbike->bike_id.'" class="btn btn-primary motorBikeDeleteBtn disabled">Delete</button>'
                    );
                }else{
                    array_push($recbike,
                    $registeredbike->brand_name,
                    $registeredbike->registered_number,
                    $registeredbike->date_of_expiry,
                    '<button class="btn btn-primary editmotor" id="'.$registeredbike->bike_id.'">View</button>',
                    '<button data-id="'.$registeredbike->bike_id.'" class="btn btn-primary motorBikeDeleteBtn">Delete</button>'
                    );
                }
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
        $motor = Motor_bike::where('bike_id', $request->bike_id)
        ->update(Datacleaner::cleaner($request->all()));
        return ($motor == 1) ? response()->json(["success" => "Updated successfully"], 200) : response()->json(["error" => "Try again!"], 500);
    }


    public function deleteBike($id){
        Motor_bike::where('bike_id',$id)->update([
            "delete_status" => "DELETED"
        ]);
        return response()->json("Motor Bike  removed successfully");
    }
}
