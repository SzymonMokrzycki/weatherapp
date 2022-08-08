<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\City;
use File;

class CitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        City::truncate();
        $json = File::get("E:/studia3rok/Praktyki/city.list.json");
        $cities = json_decode($json);
  
        foreach ($cities as $key => $value) {
            City::create([
                //"user_id" => $value->user_id,
                "id" => $value->id,
                "name" => $value->name,
                "state" => $value->state,
                "country" => $value->country,
                /*"coords" => $value->coords*/
            ]);
        }
    }
}
