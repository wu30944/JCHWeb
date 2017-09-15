<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScfunctionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sc_function', function (Blueprint $table) {
            $table->increments('id');
            $table->string('function_id');
            $table->string('function_cname');
            $table->string('function_ename')->nullable();
            $table->string('parent_function')->nullable();
            $table->string('visible',1);
            $table->string('route');
            $table->date('modify_date');
            $table->date('create_date');
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
        Schema::dropIfExists('sc_function');
    }
}
