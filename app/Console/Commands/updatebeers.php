<?php

namespace App\Console\Commands;

use App\Beer;
use Illuminate\Console\Command;

class updatebeers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'beers:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update beers from Punk API';

    protected $beerModel;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Beer $beerModel)
    {
        $this->beerModel = $beerModel;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
       $this->updateAllBeers();
    }

    /**
     * fetch all the beers from the Punk API and insert into the database
     *
     * @throws \Exception
     */
    public function updateAllBeers()
    {
        // Simple API, simple get.  I want to use Guzzle but task spec specifies no extra external dependencies.

        $resultsPerRequest = env('API_RESULTS_PER_REQUEST') ? env('API_RESULTS_PER_REQUEST') : 25;
        $page = 1;
        $moreBeers = true;

        $this->info("Updating beers from Punk API");

        while ($moreBeers === true) {
            try {
                // Explicitly declare results per page. Default is 25 but if that changes this logic breaks.
                $apiBeers = json_decode(file_get_contents("https://api.punkapi.com/v2/beers?page=$page&per_page=$resultsPerRequest"));
            } catch (\Exception $e) {
                throw new \Exception("Unable to retrieve beers from API");
            }

            foreach ($apiBeers as $beer) {
                $this->beerModel->updateBeer($beer);
            }
            // API does not report how many pages will be returned so we will assume the last page is the one with fewer results than $resultsPerRequest
            if (count($apiBeers) < $resultsPerRequest) {
                $moreBeers = false;
            } else {
                $page++;
            }
        }
        $count = Beer::count();
        $this->info("there are $count beers in the database");
    }
}
