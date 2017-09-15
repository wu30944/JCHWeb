<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFellowshipdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fellowship_d', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',50);
            $table->integer('fellowship_id');
            $table->string('introduction_title');
            $table->string('introduction_content')->nullable();
            $table->string('image_path')->nullable();
            $table->string('page_one_title',20)->nullable();
            $table->string('page_one_content')->nullable();
            $table->string('page_two_title',20)->nullable();
            $table->string('page_two_content')->nullable();
            $table->string('page_three_title',20)->nullable();
            $table->string('page_three_content')->nullable();
            $table->string('page_four_title',20)->nullable();
            $table->string('page_four_content')->nullable();
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
        Schema::dropIfExists('fellowship_d');
    }
}
