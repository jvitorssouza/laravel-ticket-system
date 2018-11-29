<?php

use App\Models\Perfis;
use Illuminate\Database\Seeder;

class PerfisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Perfis::create([
            'perfil_descricao' => 'SysAdmin'
        ]);
    }
}
