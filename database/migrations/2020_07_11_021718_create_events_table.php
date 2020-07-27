<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
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
            $table->string('title');
            $table->string('startDate');
            $table->string('endDate');
            $table->string('startTime');
            $table->string('endTime');
            $table->string('picture')->nullable();
            $table->string('description');
            $table->string('city');
            $table->unsignedBigInteger('owner_id')->nullable();
            $table->foreign('owner_id')
                    ->references('id')
                    ->on('users');
            $table->unsignedBigInteger('cate_id');
            $table->foreign('cate_id')
                    ->references('id')
                    ->on('categories')
                    ->onDelete('cascade');
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
