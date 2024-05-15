<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocmateriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('docmaterias', function (Blueprint $table) {
            $table->id();
            $table->integer("inscritos");
            $table->string("gestion");
            $table->string("estado");


            $table->unsignedBigInteger('grupo');
            $table->unsignedBigInteger('materia');
            $table->unsignedBigInteger('docente');
            $table->foreign('grupo')->references('id')->on('grupos')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('materia')->references('id')->on('materias')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('docente')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('docmaterias');
    }
}
