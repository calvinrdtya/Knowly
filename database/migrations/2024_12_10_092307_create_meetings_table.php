<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meetings', function (Blueprint $table) {
            $table->id();
            $table->string('host');
            $table->string('subject');
            $table->string('link');
            $table->text('meeting_notes')->nullable();
            $table->text('summary')->nullable();
            $table->unsignedBigInteger('meeting_id')->nullable();
            $table->foreign('meeting_id')->references('id')->on('meetings')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
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
        Schema::dropIfExists('meetings');
    }
}
