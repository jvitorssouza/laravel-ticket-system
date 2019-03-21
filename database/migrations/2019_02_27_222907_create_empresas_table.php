<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pro_empresas', function (Blueprint $table) {
            $table->increments('empresa_codigo');
            $table->string('empresa_rzsocial')->nullable();
            $table->string('empresa_fantasia')->nullable();
            $table->string('empresa_cnpj', 14)->nullable();
            $table->string('empresa_logradouro')->nullable();
            $table->string('empresa_numero')->nullable();
            $table->string('empresa_bairro')->nullable();
            $table->string('empresa_cidade')->nullable();
            $table->string('empresa_uf', 2)->nullable();
            $table->string('empresa_cep', 8)->nullable();
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
        Schema::dropIfExists('pro_empresas');
    }
}
