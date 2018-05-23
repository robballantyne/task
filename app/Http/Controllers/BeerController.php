<?php

namespace App\Http\Controllers;

use App\Beer;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;

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

	private $persistQueryString = [];

	// inject the beer model and the request
	public function __construct(Beer $beerModel, Request $request)
	{
	    $this->request = $request;
	    $this->beerModel = $beerModel;
	    // Paginator will drop the query string unless we specifically opt to keep params
	    $this->persistQueryString = Input::only(['view', 'query']);
	}

    /**
     * Index returns all the beers
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function index()
	{
        // Paginate 12 by default. Nicely divides into even numbers per row
	    $this->beers = $this->beerModel->paginate(12)
            ->appends($this->persistQueryString);

	    // grid view
		return view('beer.index', [
			'beers' => $this->beers,
            'list'  => $this->isListView()
		]);

		// list view
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
        $this->search = $this->request->post("query");

        // If there is a search query passed, search.
        if ($this->search) {
            $this->beers = $this->beerModel->search($this->search)->paginate(12);
        } else {
            // No query passed so return everything.
            $this->beers = $this->beerModel->paginate(12);
        }

        return view('beer.search', [
            'query' => $this->search,
            'beers' => $this->beers,
            'list'  => $this->isListView()
        ]);
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

    /**
     * Determine whether our url contains query param 'view' value 'list'.
     *
     * @return bool
     */
    private function isListView()
    {
        // TODO we will store preferred view in session rather than relying on querystring
        if (strtolower($this->request->get('view')) == 'list') {
            return true;
        }
        return false;
    }
}
