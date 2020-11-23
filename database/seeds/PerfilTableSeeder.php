<?php

use App\Perfil;
use Illuminate\Database\Seeder;
class PerfilTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Perfil::create([
            'perfil' => 'Administrador',
        ]);
        
        Perfil::create([
            'perfil' => 'Atendente',
        ]);
    }
}
