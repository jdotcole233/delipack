<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;

class PartnerAPIController extends Controller
{
    public function companyNamesList(){
        $company_names = Company::all()->value('company_logo_path');
        return response()->json([
            'company_names' => $company_names
        ]);
    }
}
