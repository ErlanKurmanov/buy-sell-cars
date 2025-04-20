<?php

namespace App\Services;

use App\Models\Car;
use App\Models\CarFeatures;
use Illuminate\Support\Facades\Auth;

class CarService
{
    public function store($inputData)
    {
        $inputData['user_id'] = Auth::id();
        $inputData['published_at'] = isset($inputData['published']) && $inputData['published'] ? now() : null;
//        dd($carData);

        $car = Car::create($inputData);


        $featureData = [
            'car_id' => $car->id,
            'air_conditioning' => $inputData['air_conditioning'] ?? false,
            'power_windows' => $inputData['power_windows'] ?? false,
            'power_door_locks' => $inputData['power_door_locks'] ?? false,
            'abs' => $inputData['abs'] ?? false,
            'cruise_control' => $inputData['cruise_control'] ?? false,
            'bluetooth_connectivity' => $inputData['bluetooth_connectivity'] ?? false,
            'remote_start' => $inputData['remote_start'] ?? false,
            'gps_navigation' => $inputData['gps_navigation'] ?? false,
            'heated_seats' => $inputData['heated_seats'] ?? false,
            'climate_control' => $inputData['climate_control'] ?? false,
            'rear_parking_sensors' => $inputData['rear_parking_sensors'] ?? false,
            'leather_seats' => $inputData['leather_seats'] ?? false,
        ];

        CarFeatures::create($featureData);

    }
}
