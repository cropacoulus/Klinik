<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRekammediksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rekammediks', function (Blueprint $table) {
            $table->id();
            $table->string('idrekammedik', 9)->unique();
            $table->bigInteger('pasien_id')->unsigned();
            $table->bigInteger('dokter_id')->unsigned();
            $table->date('tanggalberobat');
            $table->text('diagnosadokter');
            $table->timestamps();
        });

        Schema::table('rekammediks', function (Blueprint $table) {
            $table->foreign('pasien_id')
                ->references('id')->on('pasiens')
                ->onDelete('cascade');
            $table->foreign('dokter_id')
                ->references('id')->on('dokters')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rekammediks');
    }
}
