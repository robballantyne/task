<?php

namespace App\Http\Controllers;

use App\Beer;
use Illuminate\Http\Request;

use App\Http\Requests;

class BeerController extends Controller
{
    // Injecting the beer model. We will use scopes and possibly adopt the repository pattern.
    protected $beerModel;

    // a collection of beers
	private $beers = [];

	// a single beer
	private $beer = null;

	// a search query
	private $search = false;

	// inject the beer model and the request
	public function __construct(Beer $beerModel, Request $request)
	{
	    $this->request = $request;
	    $this->beerModel = $beerModel;
	}

    /**
     * Index returns all the beers
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function index()
	{
        // TODO create paginator and formatting
	    $this->beers = $this->beerModel->all();

		return view('beer.index', [
			'beers' => $this->beers
		]);
		// TODO formatting
	}

    /**
     * Return a specific beer by id
     *
     * @param $id
     */
	public function show($id)
	{
		$beer = $this->beerModel->find($id);

		dd($beer);
	}

    /**
     * Search for beers by name
     */
	public function search()
    {
        $this->search = $this->request->post("search");

        // If there is a search query passed, search.
        if ($this->search) {
            $this->beers = $this->beerModel->search($this->search)->get();
        } else {
            // No query passed so return everything.
            $this->beers = $this->beerModel->all();
        }

        dd($this->beers);
    }

    /**
     * Return a random beer from the database
     */
    public function random()
    {
        $this->beer = $this->beerModel->inRandomOrder()->first();

        dd($this->beer);
    }

    /**
     * Return only the beers which have been marked as favourites
     */
    public function favourites()
    {
        // Implement this
    }
}
