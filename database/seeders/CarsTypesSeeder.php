<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Shared\Domain\ValueObjects\Uuid;

class CarsTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $typesCars = [
            ['id' => Uuid::random()->value(), 'value' => 'convertible', 'name' => 'Convertible'],
            ['id' => Uuid::random()->value(), 'value' => 'coupe', 'name' => 'Coupe'],
            ['id' => Uuid::random()->value(), 'value' => 'hatchback', 'name' => 'Hatchback'],
            ['id' => Uuid::random()->value(), 'value' => 'passenger', 'name' => 'Passenger'],
            ['id' => Uuid::random()->value(), 'value' => 'pick-up', 'name' => 'PickUp'],
            ['id' => Uuid::random()->value(), 'value' => 'sedan', 'name' => 'Sedan'],
            ['id' => Uuid::random()->value(), 'value' => 'suv', 'name' => 'Suv'],
        ];

        DB::table('cars_types')->insert($typesCars);
    }
}
