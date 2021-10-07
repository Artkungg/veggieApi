<?php

namespace Database\Seeders;

use App\Models\Vegetable;
use Illuminate\Database\Seeder;

class VegetableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Vegetable::factory(10)->create();
    }
}
