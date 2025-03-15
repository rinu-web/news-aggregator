<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;


class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        DB::table('articles')->insert([

            // The Guardian
            [
                'title' => 'Life and Style',
                'description' => 'How much do you spend on health and wellness a month?......',
                'author' => 'Kirsten Lie-Nielsen',
                'source' => 'The Guardian',
                'category' => 'Environment',
                'url' => 'https://www.theguardian.com/lifeandstyle/2025/mar/14/homestead-farmer-tradwives',
                'published_at' => Carbon::now()->subDays(3),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // NewsAPI
            [
                'title' => 'Tech Giants Announce New AI Innovations',
                'description' => 'Google, Microsoft, and OpenAI have revealed their latest AI projects...',
                'author' => 'Michael Johnson',
                'source' => 'NewsAPI',
                'category' => 'Technology',
                'url' => 'https://newsapi.org/articles/ai-innovations',
                'published_at' => Carbon::now()->subDays(4),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            //Newyork times
            [
                
                'title' => 'F.D.A. Issues Warning About Galaxy Gas and Other Nitrous Products',
                'description' => 'The agency is advising people to avoid misusing or inhaling the products that are...',
                'author' => 'Alex Vadukul',
                'source' => 'New York Times',
                'category' => 'Health & Safety',
                'url' => 'https://www.nytimes.com/2025/03/14/style/galaxy-gas-fda-warning.html',
                'published_at' => Carbon::now()->subDays(1),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
    
}
