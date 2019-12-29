<?php

use Illuminate\Database\Seeder;

use Illuminate\Database\Eloquent\Model;
use App\Models\City;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard(); // mass assign ignore korar jonno
        
        City::truncate();

        $cities = [
            'London',
            'Paris',
            'Washington'
        ];

        foreach ($cities as $city) {
            City::firstOrCreate([
               'name' => $city,
            ]);
        }

        Model::reguard();
    }
}
