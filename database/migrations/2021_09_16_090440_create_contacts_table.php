<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //setup our migrations for contacts table
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('name')->length(50);
            $table->string('email')->length(50);
            $table->unsignedBigInteger('gender_id');
            $table->foreign('gender_id')->references('id')->on('gender_types');
            $table->longText('content');
            $table->timestamps();
            $table->softdeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}
