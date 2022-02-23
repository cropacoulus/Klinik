<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoktersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dokters', function (Blueprint $table) {
            $table->id();
            $table->string('iddokter', 9)->unique();
            $table->string('namadokter', 30);
            $table->enum('jk', ['laki-laki', 'perempuan']);
            $table->date('tanggallahir');
            $table->string('nohp',15);
            $table->string('email',20);
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
        Schema::dropIfExists('dokters');
    }
}
