<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\NewsAggregatorService;

class FetchNewsArticles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-news-articles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'news:fetch';
    private $newsService;

    /**
     * Create a command instance.
     * @return void
     */
    public function __construct(NewsAggregatorService $newsService)
    {
        parent::__construct();
        $this->newsService = $newsService;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->newsService->fetchAndStoreAll();
        $this->info('News articles fetched successfully.');
    }
}
