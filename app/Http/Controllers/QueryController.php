<?php

namespace App\Http\Controllers;

use App\Http\Resources\WeatherCollection;
use App\Http\Resources\WeatherResource;
use App\Models\City;
use Carbon\Carbon;
use Illuminate\Http\Request;
use InvalidArgumentException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class QueryController extends Controller
{
    

	public function index() {
        if(!($city = City::all()))
            throw new NotFoundHttpException('Unknown city!');

        return $this->sendResponse("Data retrieved successfully", WeatherCollection::collection($city));
    }


    public function current($cityName) {
        if(!($city = City::where('name', $cityName)->first()))
            throw new NotFoundHttpException('Unknown city!');

        $cityWeather = $city->weatherStats()->first();

        // return $cityWeather;

        return $this->sendResponse("Weather status retrieved for {$cityName}", new WeatherResource($cityWeather));
    }

    public function date($city, $date) {
        if(!($city = City::where('name', $city)->first()))
            throw new NotFoundHttpException('Unknown city!');

    
        try {
            // $date = Carbon::createFromFormat('YYYY-MM-DD', $date);
         	$date = Carbon::parse($date, 'Asia/Dhaka');
        } catch (InvalidArgumentException $exception) {
            throw new BadRequestHttpException($exception->getMessage());
        }

        $stats = $city->weatherStats()
            ->whereDate('last_update', $date
            )
            ->first();
        if(!$stats){
        	$date_form = date_format($date,"Y/m/d");

        	return $this->sendResponse("No data found for {$date_form}" );
        }

        return $this->sendResponse("Data retrieved successfully", new WeatherResource($stats));
    }

}
