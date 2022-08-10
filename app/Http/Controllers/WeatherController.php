<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;

class WeatherController extends Controller
{
    public function index($name){
        $json = File::get("data/city.list.json");
        $cities = json_decode($json);
        foreach ($cities as $c => $value) {
            if($value->name == $name){
                $lat = $value->coord->lat; 
                $lon = $value->coord->lon;
            }
        }
        
        $apiKey = "c7098dcf68f5bf44b6e59625d6442c4b";
        
        $response = file_get_contents('https://api.openweathermap.org/data/2.5/weather?lat='.$lat.'&lon='.$lon.'&exclude=daily&appid='.$apiKey);
        $obj = json_decode($response);
        $weather = $obj->weather[0]->main;
        $temp = $obj->main->temp;
        $t = round($temp-273.15, 2);
        $hum = $obj->main->humidity;
        $wind = $obj->wind->speed;
        $arr = array("weather" => $weather, "temperature" => $t, "humidity" => $hum, "wind" => $wind);
        return $arr;
    }
}
