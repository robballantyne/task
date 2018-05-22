<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBeersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beers', function (Blueprint $table) {
            $table->increments('id');

            // Index name as spec asks for search by name. Could do a fulltext search instead but we're not complicating this until it works.
            // TODO fulltextsearch including name, tagline, description
            $table->string('name');

            $table->string('tagline')
                ->nullable()
                ->default(null);

            // Stringy data from the API but we can convert this to real datetimes for sorting and filtering
            $table->date('first_brewed')
                ->nullable()
                ->default(null);

            // We will use a text column as descriptions can get lengthy
            $table->text('description')
                ->nullable()
                ->default(null);

            $table->string('image_url')
                ->nullable()
                ->default(null);

            // Index abv because this is useful info for sorting.
            $table->float('abv')->index()
                ->nullable()
                ->default(null);

            $table->integer('ibu')
                ->nullable()
                ->default(null);

            $table->integer('target_fg')
                ->nullable()
                ->default(null);

            $table->integer('target_og')
                ->nullable()
                ->default(null);

            $table->integer('ebc')
                ->nullable()
                ->default(null);

            $table->integer('srm')
                ->nullable()
                ->default(null);

            $table->float('ph')
                ->nullable()
                ->default(null);

            $table->integer('attenuation_level')
                ->nullable()
                ->default(null);

            // JSON columns. Our data is JSON. We might find this data useful but we have no plans to search or filter on it so keep it as JSON.
            // If this changes we will move some data into a standard column.
            $table->json('volume')
                ->nullable()
                ->default(null);

            $table->json('boil_volume')
                ->nullable()
                ->default(null);

            $table->json('method')
                ->nullable()
                ->default(null);

            $table->json('ingredients')
                ->nullable()
                ->default(null);

            $table->json('food_pairing')
                ->nullable()
                ->default(null);

            $table->string('brewers_tips')
                ->nullable()
                ->default(null);

            $table->string('contributed_by')
                ->nullable()
                ->default(null);

            $table->timestamps();
        });

        // Beer / User pivot table.  Needed for favourites
        Schema::create('beer_user', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('beer_id');
            $table->integer('user_id');
        });
    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('beers');
    }
}
