<?php

use App\Models\Departamentos;
use Illuminate\Database\Seeder;

class DepartamentosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Departamentos::create([
            'departamento_descricao' => 'Geral'
        ]);
    }
}
