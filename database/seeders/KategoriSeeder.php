<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kategori::create([
            'nama' => 'Slider',
            'slug' => Str::slug('Slider'),
        ]);

        Kategori::create([
            'nama' => 'Olahraga',
            'slug' => Str::slug('olahraga'),
        ]);

        Kategori::create([
            'nama' => 'Kesehatan',
            'slug' => Str::slug('kesehatan'),
        ]);

        Kategori::create([
            'nama' => 'Teknologi',
            'slug' => Str::slug('Teknologi'),
        ]);

        Kategori::create([
            'nama' => 'Pendidikan',
            'slug' => Str::slug('Pendidikan'),
        ]);

        Kategori::create([
            'nama' => 'Bisnis',
            'slug' => Str::slug('Bisnis'),
        ]);
    }
}
