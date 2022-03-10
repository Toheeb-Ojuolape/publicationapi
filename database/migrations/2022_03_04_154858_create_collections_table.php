<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collections', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('author');
            $table->string('email');
            $table->string('filetype');
            $table->string('photoURL');
            $table->float('rating');
            $table->json('readers');
            $table->string('slug');
            $table->text('description');
            $table->string('category');
            $table->string('coauthor');
            $table->string('currency');
            $table->float('price');
            $table->float('percentage');
            $table->string('status');
            $table->string('date');
            $table->string('bookcover');
            $table->string('downloadable');
            $table->json('earnings');
            $table->text('book');
            $table->text('timestamp');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('collections');
    }
}
