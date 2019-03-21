<?php

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status::create([
            'status_descricao' => 'Aguardando Atendimento',
            'status_classe' => '',
        ]);

        Status::create([
            'status_descricao' => 'Em Atendimento',
            'status_classe' => '',
        ]);

        Status::create([
            'status_descricao' => 'Aguardando retorno',
            'status_classe' => '',
        ]);

        Status::create([
            'status_descricao' => 'Finalizado',
            'status_classe' => '',
        ]);
    }
}
