<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $categories = [
            'Állatok',
            'Egészség',
            'Otthon',
            'Sport',
            'Divat',
            'Utazás',
            'Ételek és Italok',
            'Tech',
            'Szórakozás',
            'Egyéb'
        ];
        foreach ($categories as $name) {
            Category::firstOrCreate(['name' => $name]);
        }
    }
}
