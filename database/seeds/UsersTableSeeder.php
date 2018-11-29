<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'credencial_nome' => 'Administrador',
            'credencial_email' => 'sysadmin@helpti.com.br',
            'credencial_login' => 'sysadmin',
            'credencial_senha' => bcrypt('admin'),
            'credencial_ativo' => 'S',
            'credencial_exige_nova_senha' => 'N',
            'perfil_codigo' => 1
        ]);
    }
}
