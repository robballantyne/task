<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group([ 'middleware' => [ 'web' ] ], function()
{
	Route::get('/', [ 'uses' => 'BeerController@index' ]);
	Route::get('beer/random', [ 'uses' => 'BeerController@random', 'as' => 'beer.random' ]);

	// Changed search this to get for simpler pagination
	Route::get('beer/search', [ 'uses' => 'BeerController@search', 'as' => 'beer.search' ]);
	Route::resource('beer', 'BeerController', [ 'only' => [ 'index', 'show' ] ]);
    Route::get('account/favourites', ['uses' => 'AccountController@favouriteBeers', 'as' => 'auth.userfavourite']);

    // Ajax routes
    Route::post('ajax/viewswitch', ['as' => 'viewSwitch', 'uses' => 'AjaxController@viewSwitch']);
    Route::post('/ajax/togglefavourite', 'AccountController@toggleFavouriteBeer')->name('togglefavourite');

    // Add a logout route not provided by Auth
    Route::get('logout', ['uses' => 'AccountController@logout', 'as' => 'user.logout']);

    Route::get('/account', 'AccountController@index')->name('account');
});

Auth::routes();