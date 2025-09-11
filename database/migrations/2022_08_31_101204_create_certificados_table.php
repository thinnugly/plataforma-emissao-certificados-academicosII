<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertificadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificados', function (Blueprint $table) {
            $table->id();
            $table->double('portugues', 3,3)->nullable();
            $table->double('ingles', 3,3)->nullable();
            $table->double('frances', 3,3)->nullable();
            $table->double('filosolia', 3,3)->nullable();
            $table->double('fisica', 3,3)->nullable();
            $table->double('biologia', 3,3)->nullable();
            $table->double('quimica', 3,3)->nullable();
            $table->double('matematica', 3,3)->nullable();
            $table->double('desenho', 3,3)->nullable();
            $table->double('geografia', 3,3)->nullable();
            $table->double('edfisica', 3,3)->nullable();
            $table->double('historia', 3,3)->nullable();
            $table->double('mediaFinal');
            $table->string('estudanteId');
            $table->timestamps();

            $table->foreign('estudanteId')->references('nomeCompleto')->on('estudantes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('certificados');
    }
}
