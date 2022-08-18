<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
use App\Models\City;
use Auth;

class CityController extends Controller
{
    public function dispCities(){
        $allCities = City::all();
        return $allCities;
    }

    public function delete($name, $country){
        $allCities = City::all();
        foreach($allCities as $city){
            if($city->name == $name && $city->country == $country){
                $city->delete();
            }
        }
    }

    public function list(){
        $json = File::get("data/city.list.json");
        $cities = json_decode($json);
        return $cities;
    }

    public function add($name, $country){
        $lat = 0;
        $lon = 0;
        $state = "";
        $json = File::get("data/city.list.json");
        $cities = json_decode($json);
        foreach($cities as $c => $value){
            if($value->name == $name && $value->country == $country){
                $lat = $value->coord->lat;
                $lon = $value->coord->lon;
                $state = $value->state;
            }
        }
        $city = new City;
        $city->name = $name;
        $city->country = $country;
        $city->lat = $lat;
        $city->lon = $lon;
        $city->state = $state;
        $city->user_id = Auth::id();
        $city->save();
    }
}