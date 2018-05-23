<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Beer extends Model
{
    protected $guarded = [];


    public function updateBeer($beer)
    {
        $beer = $this->updateOrCreate(
            [
                'name'              => $beer->name,
            ],
            [
                'tagline'           => $beer->tagline,
                // API returns string date so convert to proper SQL date format
                'first_brewed'      => Carbon::createFromFormat('m/Y', $beer->first_brewed),
                'description'       => $beer->description,
                'image_url'         => $beer->image_url,
                'abv'               => $beer->abv,
                'ibu'               => $beer->ibu,
                'target_fg'         => $beer->target_fg,
                'target_og'         => $beer->target_og,
                'ebc'               => $beer->ebc,
                'srm'               => $beer->srm,
                'ph'                => $beer->ph,
                'attenuation_level' => $beer->attenuation_level,
                'volume'            => json_encode($beer->volume),
                'boil_volume'       => json_encode($beer->boil_volume),
                'method'            => json_encode($beer->method),
                'ingredients'       => json_encode($beer->ingredients),
                'food_pairing'      => json_encode($beer->food_pairing),
                'brewers_tips'      => $beer->brewers_tips,
                'contributed_by'    => $beer->contributed_by
            ]
        );

        return $beer;
    }

    public function scopeSearch($query ,$search)
    {
        return $query->where('name', 'LIKE', "%$search%");
    }
}
