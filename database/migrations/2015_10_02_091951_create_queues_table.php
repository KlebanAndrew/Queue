<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQueuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('queues', function (Blueprint $table) {
            $table->increments('id');
            $table->time('start_time');
            $table->time('end_time');
            $table->date('date');
            $table->bigInteger('register_key')->unique();
            $table->string('user_name', 60)->nullable();
            $table->integer('user_personal_key')->nullable();
            $table->boolean('is_present')->default(false);
            $table->boolean('is_real_queue')->default(false);
            $table->boolean('is_admin_record')->default(false);
            $table->boolean('is_present')->default(false);
            $table->boolean('is_free')->default(false);
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
        Schema::drop('queues');
    }
}
