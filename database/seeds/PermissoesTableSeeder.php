<?php

use App\Models\Permissoes;
use Illuminate\Database\Seeder;

class PermissoesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* ----- EMPRESAS ----- */

        Permissoes::create([
            'permissao_descricao' => 'Listar Empresas',
            'permissao_rota' => 'empresas.index'
        ]);

        Permissoes::create([
            'permissao_descricao' => 'Criar Empresas',
            'permissao_rota' => 'empresas.create'
        ]);

        Permissoes::create([
            'permissao_descricao' => 'Editar Empresas',
            'permissao_rota' => 'empresas.edit'
        ]);

        Permissoes::create([
            'permissao_descricao' => 'Deletar Empresas',
            'permissao_rota' => 'empresas.destroy'
        ]);

        /* ----- DEPARTAMENTOS ----- */

        Permissoes::create([
            'permissao_descricao' => 'Listar Departamentos',
            'permissao_rota' => 'departamentos.index'
        ]);

        Permissoes::create([
            'permissao_descricao' => 'Criar Departamentos',
            'permissao_rota' => 'departamentos.create'
        ]);

        Permissoes::create([
            'permissao_descricao' => 'Editar Departamentos',
            'permissao_rota' => 'departamentos.edit'
        ]);

        Permissoes::create([
            'permissao_descricao' => 'Deletar Departamentos',
            'permissao_rota' => 'departamentos.destroy'
        ]);


        /* ----- CATEGORIAS ----- */

        Permissoes::create([
            'permissao_descricao' => 'Listar Categorias',
            'permissao_rota' => 'categorias.index'
        ]);

        Permissoes::create([
            'permissao_descricao' => 'Criar Categorias',
            'permissao_rota' => 'categorias.create'
        ]);

        Permissoes::create([
            'permissao_descricao' => 'Editar Categorias',
            'permissao_rota' => 'categorias.edit'
        ]);

        Permissoes::create([
            'permissao_descricao' => 'Deletar Categorias',
            'permissao_rota' => 'categorias.destroy'
        ]);

        /* ----- HELPDESK ----- */

        Permissoes::create([
            'permissao_descricao' => 'Listar Chamados',
            'permissao_rota' => 'helpdesk.index'
        ]);

        Permissoes::create([
            'permissao_descricao' => 'Criar Chamados',
            'permissao_rota' => 'helpdesk.create'
        ]);

        Permissoes::create([
            'permissao_descricao' => 'Editar Chamados',
            'permissao_rota' => 'helpdesk.edit'
        ]);

        Permissoes::create([
            'permissao_descricao' => 'Deletar Chamados',
            'permissao_rota' => 'helpdesk.destroy'
        ]);

        Permissoes::create([
            'permissao_descricao' => 'Atender Chamados',
            'permissao_rota' => 'helpdesk.atender_chamado'
        ]);

        Permissoes::create([
            'permissao_descricao' => 'Reabrir Chamados',
            'permissao_rota' => 'helpdesk.reabrir_chamado'
        ]);

    }
}
