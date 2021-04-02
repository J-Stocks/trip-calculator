<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ranges', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('rate_id');
//            $table->foreign('rate_id')->references('id')->on('rates');
            $table->unsignedBigInteger('start');
            $table->unsignedBigInteger('end')->nullable();
            $table->double('price_per_distance');
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
//        Schema::table('ranges', function (Blueprint $table) {
//            $table->dropForeign('rate_id');
//        });
        Schema::dropIfExists('ranges');
    }
}
