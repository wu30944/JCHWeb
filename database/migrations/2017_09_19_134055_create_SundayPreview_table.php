<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSundayPreviewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sunday_preview', function (Blueprint $table) {
            $table->increments('id');
            $table->string('subject',30)->comment('講道主題');
            $table->string('speaker',15)->comment('講道者');
            $table->date('date')->comment('主日日期');
            $table->string('language_type',5)->comment('語言類型');
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
        Schema::dropIfExists('sunday_preview');
    }
}
