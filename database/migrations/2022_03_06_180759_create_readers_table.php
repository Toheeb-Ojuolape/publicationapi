<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReadersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('readers', function (Blueprint $table) {
            $table->id();
            $table->string('uid');
            $table->string('title');
            $table->string('bookcover');
            $table->string('author');
            $table->string('email');
            $table->string('filetype');
            $table->string('photoURL');
            $table->float('rating');
            $table->string('slug');
            $table->text('description');
            $table->string('category');
            $table->string('currency');
            $table->float('price');
            $table->text('book');
            $table->integer("collection_id");
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
        Schema::dropIfExists('readers');
    }
}
