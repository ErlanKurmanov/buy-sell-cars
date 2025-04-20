<?php

namespace App\Http\Controllers;

use App\Http\Requests\Car\StoreRequest;
use App\Models\Car;
use App\Models\CarFeatures;
use App\Models\CarType;
use App\Models\FuelType;
use App\Models\Maker;
use App\Models\Region;
use App\Models\User;
use App\Services\CarService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Throwable;

class CarController extends Controller
{

    protected $service;

    public function __construct(CarService $service)
    {
        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//        $cars = Auth::user()->cars()
//        ->with(['primaryImage', 'maker', 'model'])
//            ->orderBy('id', 'desc')
//            ->get();

        $cars = User::find(5)
            ->cars()
            ->with(['primaryImage', 'maker', 'model'])
            ->orderBy('id', 'desc')
            ->get();

        return view('car.index', ['cars' => $cars]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $makers = Maker::orderBy('name')->get();
        $fuelTypes = FuelType::orderBy('name')->get();
        $regions = Region::orderBy('name')->get();
        $carTypes = CarType::orderBy('name')->get();
        $carFeatures = CarFeatures::all();

        return view('car.create', compact('makers', 'carTypes', 'fuelTypes', 'regions'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {

        $inputData =$request->validated();
        dd($inputData);
        $this->service->store($inputData);

        return redirect()->route('home.index')->with('success', 'Car created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        return view('car.show', ['car' => $car]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        return view('car.edit');

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car)
    {


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {


    }

    public function search(Request $request)
    {

//        $query = Car::where('published_at', '<', now())
//            ->with(['primaryImage', 'city', 'carType', 'fuelType', 'maker', 'model'])
//            ->orderBy('published_at', 'desc');
//
//        $cars = $query->paginate(5);
//        return view('car.search', ['cars' => $cars]);
    }

    //My favorite car page
    public function watchlist()
    {
        $cars = Auth::user()->favouriteCars() // Assuming the relationship exists
        ->with(['primaryImage', 'city', 'carType', 'fuelType', 'maker', 'model'])
            ->paginate(15);
//        dd($cars);
        return view('car.watchlist', ['cars' => $cars]);
    }
}
