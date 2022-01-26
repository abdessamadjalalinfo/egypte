<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('target')->default('nothing');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->date('scanning_date');
            $table->string('number_of_pages');

            $table->unsignedBigInteger('departement_id');

            $table->foreign('departement_id')->references('id')->on('departements');
            $table->unsignedBigInteger('sub_departement_id');

            $table->foreign('sub_departement_id')->references('id')->on('sub_departements');

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
        Schema::dropIfExists('files');
    }
}
