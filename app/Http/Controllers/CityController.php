<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
use App\Models\City;

class CityController extends Controller
{
    public function dispCities(){
        $allCities = City::all();
        return $allCities;
    }
}
