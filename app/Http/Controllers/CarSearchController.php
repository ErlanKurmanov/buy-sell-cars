<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarType;
use App\Models\City;
use App\Models\FuelType;
use App\Models\Maker;
use App\Models\Model;
use App\Models\Region;
use App\Services\CarSearchService;
use Illuminate\Http\Request;

class CarSearchController extends Controller
{

    public function showForm()
    {
        // Fetch data needed to populate the dropdowns initially
        $makers = Maker::orderBy('name')->get();
        $fuelTypes = FuelType::orderBy('name')->get();
        $regions = Region::orderBy('name')->get();
        $carTypes = CarType::orderBy('name')->get();
//        dd($makers);

        // Get default list of cars (most recent)
        $cars = Car::where('published_at', '<', now())
            ->with(['primaryImage', 'city', 'carType', 'fuelType', 'maker', 'model'])
            ->orderBy('published_at', 'desc')
            ->paginate(15);

        return view('car.search', compact('cars', 'makers', 'carTypes', 'fuelTypes', 'regions'));
    }

    public function getCarModel(string $makerId)
    {
        $model = Model::where('maker_id', $makerId)
            ->orderBy('name')
            ->get();
//        dd($model);
        return response()->json([
            'models' => $model,
        ]);

    }

    public function getCitiesByRegionId($regionId)
    {
        $cities = City::where('region_id', $regionId)
            ->orderBy('name')
            ->get();

        return response()->json([
                'cities' => $cities
        ]);
    }

    public function getCity()
    {

    }

    public function search(Request $request)
    {
        // Start with a base query for published cars
        $query = Car::where('published_at', '<', now())
            ->with(['primaryImage', 'city', 'carType', 'fuelType', 'maker', 'model']);

        // Apply filters based on request parameters

        // Filter by maker
        if ($request->filled('maker_id')) {
            $query->where('maker_id', $request->maker_id);
        }

        // Filter by model
        if ($request->filled('model_id')) {
            $query->where('model_id', $request->model_id);
        }

        // Filter by car type
        if ($request->filled('car_type_id')) {
            $query->where('car_type_id', $request->car_type_id);
        }

        // Filter by year range
        if ($request->filled('year_from')) {
            $query->where('year', '>=', $request->year_from);
        }

        if ($request->filled('year_to')) {
            $query->where('year', '<=', $request->year_to);
        }

        // Filter by price range
        if ($request->filled('price_from')) {
            $query->where('price', '>=', $request->price_from);
        }

        if ($request->filled('price_to')) {
            $query->where('price', '<=', $request->price_to);
        }

        // Filter by mileage
        if ($request->filled('mileage')) {
            $query->where('mileage', '<=', $request->mileage);
        }

        // Filter by fuel type
        if ($request->filled('fuel_type_id')) {
            $query->where('fuel_type_id', $request->fuel_type_id);
        }

        // Filter by city
        if ($request->filled('city_id')) {
            $query->where('city_id', $request->city_id);
        }
        // Filter by state/region (through city relationship)
        elseif ($request->filled('state_id')) {
            $query->whereHas('city', function($q) use ($request) {
                $q->where('region_id', $request->state_id);
            });
        }

        // Apply sorting if specified
        if ($request->filled('sort')) {
            $sortField = 'published_at'; // default sort field
            $sortDirection = 'desc';     // default direction

            // Handle sort parameter (format can be "field" or "-field" for descending)
            $sort = $request->sort;
            if (str_starts_with($sort, '-')) {
                $sortField = substr($sort, 1);
                $sortDirection = 'desc';
            } else {
                $sortField = $sort;
                $sortDirection = 'asc';
            }

            $query->orderBy($sortField, $sortDirection);
        } else {
            // Default sorting by newest first
            $query->orderBy('published_at', 'desc');
        }

        // Get the filtered cars with pagination
        $cars = $query->paginate(15)->withQueryString();

        // Get data needed for search form dropdown options
        $makers = Maker::orderBy('name')->get();
        $carTypes = CarType::all();
        $fuelTypes = FuelType::all();
        $regions = Region::with('cities')->get();

        return view('car.search', compact('cars', 'makers', 'carTypes', 'fuelTypes', 'regions'));
    }
}
