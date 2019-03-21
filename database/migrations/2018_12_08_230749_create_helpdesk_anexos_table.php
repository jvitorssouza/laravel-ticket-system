<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHelpdeskAnexosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pro_helpdesk_anexos', function (Blueprint $table) {
            $table->increments('anexos_codigo');
            $table->string('anexos_caminho');
            $table->integer('helpdesk_codigo')->unsigned();
            $table->foreign('helpdesk_codigo')->references('helpdesk_codigo')->on('pro_helpdesk')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('pro_helpdesk_anexos');
    }
}
