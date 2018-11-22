<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_menu', function(Blueprint $table)
        {
            $table->integer('menu_codigo', true);
            $table->integer('menu_pai')->nullable()->index('fk_sistema_menu_sistema_menu1_idx');
            $table->integer('menu_ordem');
            $table->string('menu_titulo', 45);
            $table->string('menu_rota')->nullable();
            $table->string('menu_icone')->nullable();
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
        Schema::dropIfExists('sys_menu');
    }
}
