<?php

use App\Models\Prioridades;
use Illuminate\Database\Seeder;

class PrioridadesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Prioridades::create([
            'prioridade_descricao' => 'Baixa',
            'prioridade_grau' => 0
        ]);

        Prioridades::create([
            'prioridade_descricao' => 'Média',
            'prioridade_grau' => 1
        ]);

        Prioridades::create([
            'prioridade_descricao' => 'Alta',
            'prioridade_grau' => 2
        ]);

        Prioridades::create([
            'prioridade_descricao' => 'Altíssima',
            'prioridade_grau' => 3
        ]);

    }
}
