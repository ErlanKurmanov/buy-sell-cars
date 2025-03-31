<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\CarImage;
use App\Models\CarType;
use App\Models\City;
use App\Models\FuelType;
use App\Models\Maker;
use App\Models\Model;
use App\Models\Region;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        CarType::factory()
            ->sequence(
                ['name' => 'Sedan'],
                ['name' => 'Hatchback'],
                ['name' => 'SUV'],
                ['name' => 'Pickup Truck'],
                ['name' => 'Minivan'],
                ['name' => 'Jeep'],
                ['name' => 'Coupe'],
                ['name' => 'Crossover'],
                ['name' => 'Sports Car'],
            )
            ->count(9)
            ->create();

        FuelType::factory()
            ->sequence(
                ['name' => 'Gasoline'],
                ['name' => 'Diesel'],
                ['name' => 'Electric'],
                ['name' => 'Hybrid'],
            )
            ->count(4)
            ->create();

        $regions = [
            'Bishkek' => ['Bishkek', 'Lebedinovka', 'Sokuluk', 'Kant'], // Added some larger towns near Bishkek
            'Chuy' => [
                'Tokmok',
                'Kara-Balta',
                'Kant',
                'Kayyngdy',
                'Kemin',
                'Shopokov',
                'Orlovka',
                'FakeChuyCity1', // Fake city
                'FakeChuyVillage', // Fake village
            ],
            'Osh' => [
                'Osh',
                'Kara-Suu',
                'Uzgen',
                'Nookat',
                'Aravan',
                'Gulcha',
                'Daroot-Korgon',
                'FakeOshTown', // Fake town
            ],
            'Jalal-Abad' => [
                'Jalal-Abad',
                'Kara-Köl',
                'Kök-Janggak',
                'Mayluu-Suu',
                'Tash-Kömür',
                'Bazar-Korgon',
                'Kerben',
                'Kochkor-Ata',
                'Toktogul',
                'FakeJalalCity', // Fake city
            ],
            'Issyk-Kul' => [
                'Karakol',
                'Balykchy',
                'Cholpon-Ata',
                'Tamchy',
                'Tyup',
                'Barskoon',
                'FakeIssykKulSettlement', // Fake settlement
            ],
            'Naryn' => [
                'Naryn',
                'Kochkor',
                'At-Bashy',
                'Jumgal',
                'FakeNarynVillage', // Fake village
            ],
            'Talas' => [
                'Talas',
                'Manas',
                'Kyzyl-Adyr',
                'Pokrovka',
                'FakeTalasTownship', // Fake township
            ],
            'Batken' => [
                'Batken',
                'Kyzyl-Kiya',
                'Suluktu',
                'Isfana',
                'Kadamjay',
                'Aydarken',
                'FakeBatkenCity', // Fake city
            ],
        ];

        foreach ($regions as $region => $cities) {
            Region::factory()
                ->state(['name' => $region])
                ->has(
                    City::factory()
                        ->count(count($cities))
                        ->sequence(...array_map(fn($city) => ['name' => $city], $cities))
                )
                ->create();
        }

        $makers = [
            'Toyota' => ['Camry', 'Corolla', 'Highlander', 'RAV4', 'Prius'],
            'Ford' => ['F-150', 'Escape', 'Explorer', 'Mustang', 'Fusion'],
            'Honda' => ['Civic', 'Accord', 'CR-V', 'Pilot', 'Odyssey', 'HR-V'],
            'Chevrolet' => ['Silverado', 'Equinox', 'Malibu', 'Impala', 'Corvette'],
            'Nissan' => ['Altima', 'Sentra', 'Rogue', 'Maxima', 'Murano'],
            'Lexus' => ['RX400', 'RX450', 'RX350', 'ES350', 'LS500', 'IS300'],
        ];

        foreach ($makers as $maker => $models) {
            Maker::factory()
                ->state(['name' => $maker])
                ->has(
                    Model::factory()
                        ->count(count($models))
                        ->sequence(...array_map(fn ($model) => ['name' => $model], $models))
                )
                ->create(); // Assuming you want to create the Maker and Model instances
        }

        User::factory()->count(3)->create();

        User::factory()
            ->count(2)
            ->has(
                Car::factory()
                    ->count(50)
                    ->has(
                        CarImage::factory()
                            ->count(5)
                            ->sequence(fn (Sequence $sequence) =>
                            ['position' => $sequence->index % 5 + 1]),
                        'images'
                    )
                ->hasFeatures(),
                'favouriteCars'
            )
            ->create();
    }
}
