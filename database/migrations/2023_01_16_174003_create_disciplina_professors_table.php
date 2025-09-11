<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisciplinaProfessorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disciplina_professors', function (Blueprint $table) {
            $table->id();
            $table->string('disciplinaId');
            $table->string('professorId');
            $table->string('turmaId');
            $table->string('classeId');
            $table->string('seccaoId');
            $table->string('status');
            $table->timestamps();

            $table->foreign('disciplinaId')->references('nome')->on('disciplinas')->onDelete('cascade');
            $table->foreign('professorId')->references('nomeCompleto')->on('professores')->onDelete('cascade');
            $table->foreign('turmaId')->references('nome_turma')->on('turmas')->onDelete('cascade');
            $table->foreign('classeId')->references('nome')->on('classes')->onDelete('cascade');
            $table->foreign('seccaoId')->references('nome')->on('seccoes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('disciplina_professors');
    }
}
