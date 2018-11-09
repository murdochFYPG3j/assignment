<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentsTable extends Migration
{
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('attendee_id')->unsigned()->nullable();
            // $table->integer('location_id')->unsigned();
            $table->datetime('starts_at');
            $table->datetime('ends_at');
            $table->boolean('confirmed')->default(false);
            $table->timestamps();

            $table->foreign('attendee_id')->references('id')->on('users');
            // $table->foreign('location_id')->references('id')->on('locations');
        });
    }

    public function down()
    {
        Schema::dropIfExists('appointments');
    }
}
