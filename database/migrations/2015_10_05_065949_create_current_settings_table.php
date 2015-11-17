<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurrentSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('current_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->date('day_date');
            $table->time('period_start_time');
            $table->time('period_end_time');
            $table->integer('workers_number');
            $table->integer('period_time');
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
        Schema::drop('current_settings');
    }
}
