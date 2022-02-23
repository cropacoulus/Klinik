<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResepsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reseps', function (Blueprint $table) {
            $table->id();
            $table->string('idresep', 9)->unique();
            $table->bigInteger('rekammedik_id')->unsigned();
            $table->bigInteger('obat_id')->unsigned();
            $table->date('tanggalresep');
            $table->integer('dosis')->length(9)->unsigned();
            $table->enum('status', ['unpaid', 'paid'])->default('unpaid');
            $table->timestamps();
        });

        Schema::table('reseps', function (Blueprint $table) {
            $table->foreign('rekammedik_id')
                ->references('id')->on('rekammediks')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('obat_id')
                ->references('id')->on('obats')
                ->onUpdate('cascade')
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
        Schema::dropIfExists('reseps');
    }
}
