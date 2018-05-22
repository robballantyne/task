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

            $table->string('tagline');

            // Stringy data from the API but we can convert this to real datetimes for sorting and filtering
            $table->date('first_brewed');

            // We will use a text column as descriptions can get lengthy
            $table->text('description');
            $table->string('image_url');

            // Index abv because this is useful info for sorting
            $table->float('abv')->index();

            $table->integer('ibu');
            $table->integer('target_fg');
            $table->integer('target_og');
            $table->integer('ebc');
            $table->integer('srm');
            $table->float('ph');
            $table->integer('attenuation_level');

            // JSON columns. Our data is JSON. We might find this data useful but we have no plans to search or filter on it so keep it as JSON.
            // If this changes we will move some data into a standard column.
            $table->json('volume');
            $table->json('boil_volume');
            $table->json('method');
            $table->json('ingredients');
            $table->json('food_pairing');

            $table->string('brewers_tips');
            $table->string('contributed_by');
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
