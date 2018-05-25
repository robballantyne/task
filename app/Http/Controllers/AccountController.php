<?php

namespace App\Http\Controllers;

use App\Beer;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class AccountController extends Controller
{

    public $request;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->middleware('auth');
        $this->request = $request;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('account');
    }

    /*
     * User's favourite beers
     *
     */
    public function favouriteBeers(User $user)
    {
        $beers = $user->getAuthUser()->beers()->paginate(12);

        return view('auth.userfavourite', [
            'beers' => $beers,
            'list'  => $this->isListView()
        ]);
    }

    public function toggleFavouriteBeer(User $user)
    {
        $beerId = Input::get('beer_id');

        // If the user has marked this beer id as favourite, we will match it
        $userBeer = $user->getAuthUser()->beers()
            ->where('beer_id', $beerId)
            ->first();

        // Act on matched beer
        if ($userBeer) {
            $userBeer->users()->detach($user->getAuthUser()->id);
            return response()->json(['favourite' => "0"]);
        // No match, so attach the beer to the user
        } else {
            $user->getAuthUser()->beers()->attach($beerId);
            return response()->json(['favourite' => "1"]);
        }
    }

    /**
     * Logout of the application
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    /**
     * Determine whether our session key 'viewtype' is list // NOT DRY. FIXME - Duplicates BeerController
     *
     * @return bool
     */
    private function isListView()
    {
        $viewType = $this->request->session()->get('viewtype');
        if ($viewType && $viewType == 'list') {
            return true;
        }
        return false;
    }
}
