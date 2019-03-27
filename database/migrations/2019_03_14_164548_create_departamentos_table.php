<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pro_departamentos', function (Blueprint $table) {
            $table->increments('departamento_codigo');
            $table->string('departamento_descricao')->nullable();

            $table->integer('empresa_codigo')->nullable()->unsigned();
            $table->foreign('empresa_codigo')->references('empresa_codigo')->on('pro_empresas');

            $table->string('departamento_cor')->nullable();

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
        Schema::dropIfExists('pro_departamentos');
    }
}
