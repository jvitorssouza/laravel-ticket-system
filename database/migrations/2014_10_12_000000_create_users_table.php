<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{

    public function up()
    {
        Schema::create('sys_credencial', function (Blueprint $table) {
            $table->increments('credencial_codigo');
            $table->string('credencial_nome');
            $table->string('credencial_email')->unique()->nullable();
            $table->string('credencial_login');
            $table->string('credencial_senha');
            $table->enum('credencial_ativo', ['S', 'N'])->default('S');
            $table->enum('credencial_exige_nova_senha', ['S', 'N'])->default('S');
            $table->integer('credencial_qtd_acesso')->unsigned()->default(0);
            $table->date('credencial_ult_acesso')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('sys_credencial');
    }
}
