<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Beer extends Model
{
    protected $guarded = [];

    protected $userModel;


    /**
     * Define the users relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('App\User', 'beer_user', 'beer_id', 'user_id');
    }
    /**
     * Add a beer to the database if there is not already a beer with the same name, otherwise update.
     *
     * @param $beer
     * @return mixed
     */
    public function updateBeer($beer)
    {
        $beer = $this->updateOrCreate(
            [
                'name' => $beer->name,
            ],
            [
                'tagline' => $beer->tagline,
                // API returns string date so convert to proper SQL date format
                'first_brewed' => Carbon::createFromFormat('m/Y', $beer->first_brewed),
                'description' => $beer->description,
                'image_url' => $beer->image_url,
                'abv' => $beer->abv,
                'ibu' => $beer->ibu,
                'target_fg' => $beer->target_fg,
                'target_og' => $beer->target_og,
                'ebc' => $beer->ebc,
                'srm' => $beer->srm,
                'ph' => $beer->ph,
                'attenuation_level' => $beer->attenuation_level,
                'volume' => json_encode($beer->volume),
                'boil_volume' => json_encode($beer->boil_volume),
                'method' => json_encode($beer->method),
                'ingredients' => json_encode($beer->ingredients),
                'food_pairing' => json_encode($beer->food_pairing),
                'brewers_tips' => $beer->brewers_tips,
                'contributed_by' => $beer->contributed_by
            ]
        );

        return $beer;
    }

    /**
     * Eloquent query scope for simple search on name column
     *
     * @param $query
     * @param $search
     * @return mixed
     */
    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'LIKE', "%$search%");
    }

    /**
     * Eloquent query scope to retrieve our beer list with the user if attached (for detecting favourites in normal lists)
     *
     * @param $query
     * @return mixed
     */
    public function scopeWithUser($query)
    {
        if (Auth::id()) {
            return $query->with(['users' => function ($q) {
                $q->where('user_id', Auth::id());
            }]);
        }
        else {
            return $query;
        }
    }


    /**
     * Get the hops used in the beer
     *
     * @return array
     */
    public function getHops()
    {
        return $this->getUniqueIngredients('hops', 'name');
    }

    /**
     * Get the malts used in the beer
     *
     * @return array
     */
    public function getMalt()
    {
        return $this->getUniqueIngredients('malt', 'name');
    }

    /**
     * Get the yeast used in the beer
     *
     * @return string
     */

    public function getYeast()
    {
        return json_decode($this->ingredients)
            ->yeast;
    }

    public function getFoodPairings()
    {
        return json_decode($this->food_pairing);
    }

    /**
     *
     * Reduce the ingredients down to unique values.
     *
     * @param $type
     * @param $key
     * @return array
     */
    public function getUniqueIngredients($type, $key)
    {
        $ingredients = json_decode($this->ingredients, true)[$type];
        $temp_array = [];
        foreach ($ingredients as &$v) {
            if (!isset($temp_array[$v[$key]]))
                $temp_array[$v[$key]] =& $v;
        }
        $array = array_values($temp_array);
        return $array;

    }
}
