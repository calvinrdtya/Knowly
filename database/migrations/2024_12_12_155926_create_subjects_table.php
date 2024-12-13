<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('slug', 100);
            $table->unsignedInteger('my_class_id');
            $table->unsignedInteger('teacher_id');
            $table->unsignedTinyInteger('hari');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->timestamps();
            
            $table->foreign('teacher_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::table('subjects', function (Blueprint $table) {
            $table->unique(['my_class_id', 'name']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subjects');
    }
}
