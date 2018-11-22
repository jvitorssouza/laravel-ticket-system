<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerfisTable extends Migration
{

    public function up()
    {
        Schema::create('sys_perfil_acesso', function(Blueprint $table) {
            $table->increments('perfil_codigo');
            $table->string('perfil_descricao', 80);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sys_perfil_acesso');
    }
}
