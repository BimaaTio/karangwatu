<?php

namespace Database\Seeders;

use App\Models\News;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        News::create([
            'user_id' => 1,
            'kategori_id' => 1,
            'judul' => 'Berita Random aja',
            'slug' => Str::slug('Berita Random aja'),
            'foto' => 'ss.png',
            'body' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nesciunt, maxime reprehenderit? Odit dolores provident consequuntur voluptas accusantium sequi, dolore perspiciatis autem incidunt eaque nobis, ducimus ipsam non facilis ex quas possimus nesciunt impedit adipisci nam neque. Ipsum, corporis velit repellat voluptas facilis, dolores harum sed, est eligendi consequuntur maiores natus? Doloribus odio cum dolorem voluptatibus neque et, quasi magni atque?',
            'excerpt' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nesciunt, maxime reprehenderit? Odit dolores provident consequuntur voluptas accusantium sequi, dolore perspiciatis autem incidunt eaque nobis, ducimus ipsam non facilis ex quas possimus nesciunt impedit adipisci nam neque.',
            'status' => 'published',
            'published_at' => now(),
        ]);

        News::create([
            'user_id' => 1,
            'kategori_id' => 2,
            'judul' => 'Berita Random ajah',
            'slug' => Str::slug('Berita Random ajah'),
            'foto' => 'ss.png',
            'body' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nesciunt, maxime reprehenderit? Odit dolores provident consequuntur voluptas accusantium sequi, dolore perspiciatis autem incidunt eaque nobis, ducimus ipsam non facilis ex quas possimus nesciunt impedit adipisci nam neque. Ipsum, corporis velit repellat voluptas facilis, dolores harum sed, est eligendi consequuntur maiores natus? Doloribus odio cum dolorem voluptatibus neque et, quasi magni atque?',
            'excerpt' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nesciunt, maxime reprehenderit? Odit dolores provident consequuntur voluptas accusantium sequi, dolore perspiciatis autem incidunt eaque nobis, ducimus ipsam non facilis ex quas possimus nesciunt impedit adipisci nam neque.',
            'status' => 'draft',
        ]);
    }
}
