<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_events', function (Blueprint $table) {
            $table->id('kodeTiket');
            $table->string('namaEvent');
            $table->string('namaPemesan');
            $table->string('section', 10);
            $table->string('seatNumber', 10);
            $table->string('tanggalEvent');
            $table->string('waktuEvent');
            $table->string('venueEvent');
            $table->string('alamatEvent');
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
        Schema::dropIfExists('ticket_events');
    }
}
