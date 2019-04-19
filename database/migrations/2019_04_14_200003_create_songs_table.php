<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSongsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('songs', function (Blueprint $table) {
            $table->bigIncrements('id');    
            $table->unsignedBigInteger('album_id');
            $table->tinyInteger("number_of");
            $table->unsignedBigInteger('plays')->default(0);
            $table->string('title');
            $table->unsignedSmallInteger("length");
            $table->timestamps();

            $table->foreign('album_id')->references('id')->on('albums');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('songs');
    }
}
