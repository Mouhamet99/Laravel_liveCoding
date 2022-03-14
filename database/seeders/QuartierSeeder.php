<?php

namespace Database\Seeders;

use App\Models\Commune;
use App\Models\Quartier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class QuartierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            return Quartier::factory()
            ->count(120)
            ->state(new Sequence(
                fn($sequence) => ['commune_id' => Commune::all()->random()],
            ))
            ->create();
    }
}
