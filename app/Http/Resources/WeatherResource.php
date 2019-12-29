<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WeatherResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        
        return [

            'id' => $this->id,
            'city_id' => $this->city_id,
            'city_name' => $this->city->name,
            'temp_celsius' => $this->temp_celsius,
            'status' => $this->status,
            'measurement_time' => $this->last_update,
            'provider' => $this->provider,
            'created_at' => $this->created_at,
        ];
    }
}
