<?php

namespace Database\Seeders;

use App\Models\Departement;
use App\Models\Region;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class DepartementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return Departement::factory()
            ->count(60)
            ->state(new Sequence(
                fn($sequence) => ['region_id' => Region::all()->random()]
            ))
            ->create();
    }
}
