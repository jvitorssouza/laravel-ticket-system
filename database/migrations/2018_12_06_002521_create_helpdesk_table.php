<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHelpdeskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pro_helpdesk', function (Blueprint $table) {
            $table->increments('helpdesk_codigo');

            $table->integer('status_codigo')->nullable()->unsigned();
            $table->foreign('status_codigo')->references('status_codigo')->on('pro_helpdesk_status')->onUpdate('cascade')->onDelete('cascade');

            $table->integer('credencial_codigo_cliente')->nullable()->unsigned();
            $table->foreign('credencial_codigo_cliente')->references('credencial_codigo')->on('sys_credencial')->onUpdate('cascade')->onDelete('cascade');

            $table->integer('categoria_codigo')->nullable()->unsigned();
            $table->foreign('categoria_codigo')->references('categoria_codigo')->on('pro_categorias')->onUpdate('cascade')->onDelete('cascade');

            $table->string('helpdesk_titulo');
            $table->text('helpdesk_detalhes');

            $table->integer('credencial_codigo_atendente')->nullable()->unsigned();
            $table->foreign('credencial_codigo_atendente')->references('credencial_codigo')->on('sys_credencial')->onUpdate('cascade')->onDelete('cascade');

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
        Schema::dropIfExists('pro_helpdesk');
    }
}
