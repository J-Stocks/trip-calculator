<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeriodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('periods', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('rate_id');
//            $table->foreign('rate_id')->references('id')->on('rates');
            $table->json('months_in_year');
            $table->json('days_in_month');
            $table->json('days_in_week');
            $table->time('start');
            $table->time('end');
            $table->double('price_per_minute');
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
//        Schema::table('periods', function (Blueprint $table) {
//            $table->dropForeign('rate_id');
//        });
        Schema::dropIfExists('periods');
    }
}
