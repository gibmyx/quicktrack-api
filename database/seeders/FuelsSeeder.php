<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Shared\Domain\ValueObjects\Uuid;

class FuelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fuels = [
            ['id' => Uuid::random()->value(), 'value' => 'diesel', 'name' => 'Diesel'],
            ['id' => Uuid::random()->value(), 'value' => 'gasoline', 'name' => 'Gasoline'],
            ['id' => Uuid::random()->value(), 'value' => 'hybrids', 'name' => 'Hybrids'],
            ['id' => Uuid::random()->value(), 'value' => 'electric', 'name' => 'Electric'],
        ];

        DB::table('fuels')->insert($fuels);
    }
}
