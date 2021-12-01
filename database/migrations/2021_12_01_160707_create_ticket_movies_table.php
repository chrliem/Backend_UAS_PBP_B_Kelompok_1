<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_movies', function (Blueprint $table) {
            $table->id('kodeTiket');
            $table->string('namaMovie');
            $table->string('namaPemesan');
            $table->string('seatNumber', 10);
            $table->string('tanggalMovie');
            $table->string('waktuMovie');
            $table->double('harga');
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
        Schema::dropIfExists('ticket_movies');
    }
}
