<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Genre;

class GenreSeeder extends Seeder
{
    public function run()
    {
        $genres = ['Horror', 'Thriller', 'Sci-Fi', 'Murder Mystery'];
        foreach ($genres as $name) {
            Genre::create(['name' => $name]);
        }
    }
}

