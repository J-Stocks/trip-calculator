<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('caps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('rate_id');
//            $table->foreign('rate_id')->references('id')->on('rates');
            $table->string('type', 8);
            $table->time('start')->nullable();
            $table->time('end')->nullable();
            $table->unsignedBigInteger('duration')->nullable();
            $table->unsignedBigInteger('value');
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
//        Schema::table('caps', function (Blueprint $table) {
//            $table->dropForeign('rate_id');
//        });
        Schema::dropIfExists('caps');
    }
}
