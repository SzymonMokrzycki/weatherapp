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
        $city = new City;
        $city->name = $name;
        $city->country = $country;
        $city->save();
    }
}
