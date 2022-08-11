<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;

class WeatherController extends Controller
{
    public function index($name, $country){
        $json = File::get("data/city.list.json");
        $cities = json_decode($json);
        $con = array();
        foreach ($cities as $c => $value) {
            if($value->name == $name){
                array_push($con, $value->country);
                foreach($con as $n){
                    if($n == $country){
                        if($n == $value->country){
                            $lat = $value->coord->lat;
                            $lon = $value->coord->lon;
                        }
                    }
                }
            }
        }
        $apiKey = "c7098dcf68f5bf44b6e59625d6442c4b";
        
        $response = file_get_contents('https://api.openweathermap.org/data/2.5/weather?lat='.$lat.'&lon='.$lon.'&exclude=daily&appid='.$apiKey);
        $obj = json_decode($response);
        $weather = $obj->weather[0]->description;
        $main = $obj->weather[0]->main;
        $temp = $obj->main->temp;
        $t = round($temp-273.15, 1);
        $hum = $obj->main->humidity;
        $wind = $obj->wind->speed;
        $arr = [];
        $contr = $obj->sys->country;
        $arr = array("weather" => $main, "temperature" => $t, "humidity" => $hum, "wind" => $wind, "country" => $contr, "description" => $weather);
        $a = array("arr" => $arr, "con" => $con);
        return $a;
    }
}
