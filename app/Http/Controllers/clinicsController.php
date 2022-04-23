<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\clinic;
use App\Models\district;
use App\Models\disease;
use App\Models\point;
use Illuminate\Support\Facades\DB;

class clinicsController extends Controller
{
    public function showMap()
    {
        $districts = district::all();
        $diseases = disease::all();
        $pharmacies = point::all();

        $clinics = clinic::first();
        $latitude = $clinics['latitude'];
        $longitude = $clinics['longitude'];

        return view('map',['latitude'=>$latitude,'longitude'=>$longitude,'districts'=>$districts,'diseases'=>$diseases,'pharmacies'=>$pharmacies]);
    }

    public function clinicPosition(Request $request)
    {
        $district = $request->district;
        $disease = $request->disease;

         $clinics = DB::table('districts')
                    ->join('clinics','clinics.districtId','=','districts.id')
                    ->join('diseases','diseases.clinicId','=','clinics.id')
                    ->where('districts.id',$district)
                    ->where('diseases.id',$disease)
                    ->select('clinics.*')
                    ->get();

                    // return $clinics;

                    foreach ($clinics as $clinic) 
                    {
                        global $latitude;
                        global $longitude;
                        $latitude = $clinic->latitude;
                        $longitude = $clinic->longitude;
                    }

        

        $districts = district::all();
        $diseases = disease::all();
        $pharmacies = clinic::all();

        return view('map',['latitude'=>$latitude,'longitude'=>$longitude,'districts'=>$districts,'diseases'=>$diseases,'pharmacies'=>$pharmacies]);
    }
}
