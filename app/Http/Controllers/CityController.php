<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;

class CityController extends Controller
{
    public function index($name){
        $json = File::get("data/city.list.json");
        $cities = json_decode($json);
        foreach ($cities as $c => $value) {
            if($value->name == $name){
                $city = array("lat" => $value->coord->lat, "lon" => $value->coord->lon);
            }
        }
        return $city;
    }
}
