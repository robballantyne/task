<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class BeerController extends Controller
{
	private $beers = [];

	public function __construct()
	{
		$this->beers = collect(json_decode(file_get_contents(storage_path('data.json'))));
	}

	public function index(Request $request)
	{
		return view('beer.index', [
			'beers' => $this->beers
		]);
	}

	public function show($id)
	{
		$beer = $this->beers->get($id);

		dd($beer);
	}
}
