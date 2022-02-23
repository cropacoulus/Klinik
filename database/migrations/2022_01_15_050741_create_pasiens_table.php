<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePasiensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pasiens', function (Blueprint $table) {
            $table->id();
            $table->string('idpasien', 9)->unique();
            $table->string('namapasien', 30);
            $table->enum('jk', ['laki-laki', 'perempuan']);
            $table->date('tanggallahir');
            $table->string('nohp',15);
            $table->string('email',50);
            $table->string('alamat',100);
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
        Schema::dropIfExists('pasiens');
    }
}
