<?php

namespace App\Http\Controllers;

use App\Beer;
use Illuminate\Http\Request;

use App\Http\Requests;

class BeerController extends Controller
{
	private $beers = [];

	public function __construct()
	{
		$this->beers = Beer::all();
		// TODO create paginator and formatting
	}

	public function index(Request $request)
	{
		return view('beer.index', [
			'beers' => $this->beers
		]);
		// TODO formatting
	}

	public function show($id)
	{
		$beer = Beer::find($id);

		dd($beer);
	}
}
