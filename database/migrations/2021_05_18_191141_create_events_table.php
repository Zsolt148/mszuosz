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
            $table->date('start_at');
            $table->date('end_at');
            $table->string('name');
            $table->string('slug');
            $table->longText('body')->nullable();
            $table->string('site')->nullable();
            $table->string('email')->nullable();
            $table->text('files')->nullable();
            $table->enum('category', ['OB', 'VB', 'EB', 'RV', 'HV', 'FV', 'SZV']);
            $table->foreignId('location_id')->nullable();
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
