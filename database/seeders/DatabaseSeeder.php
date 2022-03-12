<?php

namespace Database\Seeders;

use Faker\Guesser\Name;
use Faker\Provider\Internet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support;
use PhpParser\Node\Expr\Cast\Int_;

class DatabaseSeeder extends Seeder
{

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        \App\Models\Pays::factory(10)->create();
//          DB::table('pays')->insert([
//            'name' => Str::words(10),
//            'indicatif' =>  Str::words(10)
//        ]);
    }
}
