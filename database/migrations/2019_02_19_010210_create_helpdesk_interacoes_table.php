<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHelpdeskInteracoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pro_helpdesk_interacoes', function (Blueprint $table) {
            $table->increments('interacoes_codigo');
            $table->text('interacoes_descricao')->nullable();

            $table->integer('helpdesk_codigo')->nullable()->unsigned();
            $table->foreign('helpdesk_codigo')->references('helpdesk_codigo')->on('pro_helpdesk')->onUpdate('cascade')->onDelete('cascade');

            $table->integer('credencial_codigo')->nullable()->unsigned();
            $table->foreign('credencial_codigo')->references('credencial_codigo')->on('sys_credencial')->onUpdate('cascade')->onDelete('cascade');

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
        Schema::dropIfExists('helpdesk_interacoes');
    }
}
