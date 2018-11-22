<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissoesTable extends Migration
{

    public function up()
    {
        Schema::create('sys_permissoes', function(Blueprint $table) {
            $table->increments('permissao_codigo');
            $table->string('permissao_descricao', 80);
            $table->string('permissao_rota', 50);
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('sys_permissoes');
    }
}
