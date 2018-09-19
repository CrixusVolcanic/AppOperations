<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDbsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_dbs', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->unsignedInteger('id_country');
            $table->foreign('id_country')->references('id')->on('tbl_countries');
            $table->unsignedInteger('id_provider');
            $table->foreign('id_provider')->references('id')->on('tbl_persons');
            $table->unsignedInteger('id_analyst');
            $table->foreign('id_analyst')->references('id')->on('tbl_persons');
            $table->string('name');
            $table->text('description');
            $table->boolean('statistical');
            $table->enum('exchange', ['IMPORT', 'EXPORT']);
            $table->enum('type', ['NUEVA', 'ACTUALIZACION']);
            $table->string('initial_period', 6);
            $table->string('final_period', 6);
            $table->unsignedInteger('num_records')->nullable();
            $table->dateTime('arrived_date');
            $table->dateTime('proccesed_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_dbs');
    }
}
