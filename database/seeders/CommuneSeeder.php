<?php

namespace Database\Seeders;

use App\Models\Commune;
use App\Models\Departement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class CommuneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
           return Commune::factory()
            ->count(60)
            ->state(new Sequence(
                fn($sequence) => ['departement_id' => Departement::all()->random()],
            ))
            ->create();
    }
}
