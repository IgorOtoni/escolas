<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class Tbl_Perfis_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_perfis')->insert([
            'id'=>1,
            'nome'=>'ADM Plataforma',
            'descricao'=>'Administrador da plataforma.',
            'status'=> true,
            'id_igreja'=>null,
        ]);

        DB::table('tbl_perfis')->insert([
            'id'=>2,
            'nome'=>'ADM Site',
            'descricao'=>'Administrador do site da escola.',
            'id_igreja'=>1,
        ]);
    }
}