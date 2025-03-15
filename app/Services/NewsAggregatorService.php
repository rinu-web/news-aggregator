<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Models\Article;
use Carbon\Carbon;

class NewsAggregatorService
{
    public function fetchFromNewsAPI()
    {
        $response = Http::get('https://newsapi.org/v2/top-headlines', [
            'api-key' => config('services.newsapi.key')
        ]);

        if ($response->successful()) {
            return $response->json()['articles'];
        }

        return [];
    }

    public function fetchFromGuardian()
    {
        $response = Http::get('https://content.guardianapis.com/search', [
            'api-key' => config('services.guardian.key')
        ]);

        if ($response->successful()) {
            return $response->json()['response']['results'];
        }

        return [];
    }

    public function fetchFromNYT()
    {
        $response = Http::get('https://api.nytimes.com/svc/topstories/v2/home.json', [
            'api-key' => config('services.nytimes.key')
        ]);

        if ($response->successful()) {
            return $response->json()['results'];
        }

        return [];
    }

    public function storeArticles(array $articles, string $source)
    {
        foreach ($articles as $article) {
            Article::updateOrCreate([
                'title' => $article['title'] ?? $article['webTitle'] ?? 'No Title',
            ], [
                'source' => $source,
                'url' => $article['url'] ?? $article['webUrl'] ?? '',
                'author' => $article['author'] ?? 'Unknown',
                'category' => $article['category'] ?? 'General',
                'published_at' => isset($article['publishedAt']) ? Carbon::parse($article['publishedAt']) : now(),
            ]);
        }
    }

    public function fetchAndStoreAll()
    {
        $this->storeArticles($this->fetchFromNewsAPI(), 'NewsAPI');
        $this->storeArticles($this->fetchFromGuardian(), 'The Guardian');
        $this->storeArticles($this->fetchFromNYT(), 'New York Times');
    }
}
