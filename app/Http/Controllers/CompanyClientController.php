<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company_client;
use DB;
use Auth;
class CompanyClientController extends Controller
{
    public function fetchCompanyClient(){
        $company_clients = DB::table('company_clients')->where('company_id', Auth::user()->companiescompanies_id)->get();
        $comp_client = [];
        if ($company_clients != null){
            foreach($company_clients as $company_client) {
                $encodeCompanyclients = json_encode($company_client);
                $temp_clients = [];
                $number = ($company_client->client_alt_number == null) ? $company_client->client_primary_number: $company_client->client_primary_number . "/".$company_client->client_alt_number;
                array_push($temp_clients,
                $company_client->client_first_name . " " .$company_client->client_last_name,
                $number,
                ($company_client->location == null) ? "N/A" : $company_client->location,
                $company_client->email_address,
                $company_client->company_name,
                date("jS F Y", strtotime($company_client->created_at)),
                "<button class='btn btn-info btn-outline clientMoreBtn'  data-clients='$encodeCompanyclients'> More </button>"
                );
                array_push($comp_client, $temp_clients);
            }
        } else {
            $empty = ["","","","","",""];
            array_push($comp_client, $empty);
        }


        return response()->json(['data' => $comp_client]);
    }
}
