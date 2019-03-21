<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pro_categorias', function (Blueprint $table) {
            $table->increments('categoria_codigo');
            $table->string('categoria_descricao')->nullable();

            $table->integer('prioridade_codigo')->nullable()->unsigned();
            $table->foreign('prioridade_codigo')->references('prioridade_codigo')->on('pro_prioridades');

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
        Schema::dropIfExists('pro_categorias');
    }
}
