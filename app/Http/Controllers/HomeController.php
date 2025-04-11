<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarImage;
use App\Models\CarType;
use App\Models\FuelType;
use App\Models\Maker;
use App\Models\Model;
use App\Models\Region;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){

// Fetch data needed to populate the dropdowns initially
        $makers = Maker::orderBy('name')->get();
        $fuelTypes = FuelType::orderBy('name')->get();
        $regions = Region::orderBy('name')->get();
        $carTypes = CarType::orderBy('name')->get();

        // Get default list of cars (most recent)
        $cars = Car::where('published_at', '<', now())
            ->with(['primaryImage', 'city', 'carType', 'fuelType', 'maker', 'model'])
            ->orderBy('published_at', 'desc')
            ->paginate(30);

        return view('home.index', compact('cars', 'makers', 'carTypes', 'fuelTypes', 'regions'));

    }

}
