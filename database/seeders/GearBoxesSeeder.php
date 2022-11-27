<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Shared\Domain\ValueObjects\Uuid;
use Illuminate\Support\Facades\DB;

class GearBoxesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $gearBoxes = [
            ['id' => Uuid::random()->value(), 'value' => 'automatic', 'name' => 'Automatic'],
            ['id' => Uuid::random()->value(), 'value' => 'manual', 'name' => 'Manual']
        ];

        DB::table('gear_box')->insert($gearBoxes);
    }
}
