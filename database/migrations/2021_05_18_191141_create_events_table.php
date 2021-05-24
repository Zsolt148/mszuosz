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
            $table->foreignId('location_id');
            $table->date('start_at');
            $table->date('end_at');
            $table->string('name');
            $table->string('slug');
            $table->longText('body')->nullable();
            $table->string('site')->nullable();
            $table->string('email')->nullable();
            $table->enum('category', ['OB', 'VB', 'EB', 'RV', 'HV', 'FV', 'SZV']);
            $table->enum('pool', ['25', '33', '50', 'Nyíltvizi']);
            $table->enum('timing', ['Kézi', 'Gépi']);
            $table->boolean('is_visible')->default(0);
            $table->text('race_info')->nullable();
            $table->text('report')->nullable();
            $table->text('files')->nullable();
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
