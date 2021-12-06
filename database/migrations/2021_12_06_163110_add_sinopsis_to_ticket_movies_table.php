<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSinopsisToTicketMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ticket_movies', function (Blueprint $table) {
            $table->string('sinopsis')->after('waktuMovie');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ticket_movies', function (Blueprint $table) {
            $table->dropColumn('sinopsis');
        });
    }
}
