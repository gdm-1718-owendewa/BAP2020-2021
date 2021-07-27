<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('author',255);
            $table->integer('author_id');
            $table->string('title',255);
            $table->text('description');
            $table->integer('capacity');
            $table->string('location',255)->nullable()->default(NULL);
            $table->string('start_date',255);
            $table->string('end_date',255);
            $table->string('start_time',255);
            $table->string('start_hour',10);
            $table->string('start_minute',10);
            $table->string('end_time',255);
            $table->string('end_hour',10);
            $table->string('end_minute',10);
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
        Schema::dropIfExists('events');
    }
}
