<?php

namespace Database\Seeders;

use App\Models\Pays;
use App\Models\Region;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return Region::factory()
            ->count(30)
            ->state(new Sequence(
                fn($sequence) => ['pays_id' => Pays::all()->random()],
            ))
            ->create();
    }
}
