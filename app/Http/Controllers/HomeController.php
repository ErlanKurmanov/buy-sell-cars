<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarImage;
use App\Models\CarType;
use App\Models\FuelType;
use App\Models\Maker;
use App\Models\Model;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){

//        $makers = Maker::all();
//        dd($makers);

        $cars = Car::where('published_at', '<', now())
            ->with(['primaryImage', 'city', 'carType', 'fuelType', 'maker', 'model'])
            ->orderBy('published_at', 'desc')
            ->limit(30)
            ->get();

        return view('home.index', ['cars' => $cars]);
    }

}
