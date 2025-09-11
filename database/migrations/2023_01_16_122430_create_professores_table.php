<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfessoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('professores', function (Blueprint $table) {
            $table->id();
            $table->string('nomeCompleto')->unique();
            $table->string('Sexo');
            $table->string('dataNascimento');
            $table->string('paidId');
            $table->string('naturalidade');
            $table->string('morada');
            $table->string('bi')->unique();
            $table->string('contacto')->unique();
            $table->string('userId');
            $table->string('discId');
            $table->timestamps();

            $table->foreign('paidId')->references('nome')->on('pais')->onDelete('cascade');
            $table->foreign('userId')->references('email')->on('users')->onDelete('cascade');
            $table->foreign('naturalidade')->references('nome')->on('naturalidades')->onDelete('cascade');
            $table->foreign('morada')->references('nome')->on('moradas')->onDelete('cascade');
            $table->foreign('discId')->references('nome')->on('disciplinas')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('professores');
    }
}
