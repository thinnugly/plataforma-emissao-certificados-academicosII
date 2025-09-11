<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('estudantes', function (Blueprint $table) {
            $table->string('naturalidade');
            $table->string('morada');

            $table->foreign('paidId')->references('nome')->on('pais')->onDelete('cascade');
            $table->foreign('userId')->references('email')->on('users')->onDelete('cascade');
            $table->foreign('naturalidade')->references('nome')->on('naturalidades')->onDelete('cascade');
            $table->foreign('morada')->references('nome')->on('moradas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('estudantes', function (Blueprint $table) {
            //
        });
    }
}
