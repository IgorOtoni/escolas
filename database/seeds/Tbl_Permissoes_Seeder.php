<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Tbl_Permissoes_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Permisões referentes a um CRUD
        DB::table('tbl_permissoes')->insert([
            'id'=>1,
            'nome'=>'Incluír um novo registro.',
            'descricao'=>''
        ]);
        DB::table('tbl_permissoes')->insert([
            'id'=>2,
            'nome'=>'Alterar um registro.',
            'descricao'=>''
        ]);
        DB::table('tbl_permissoes')->insert([
            'id'=>3,
            'nome'=>'Desativar um registro.',
            'descricao'=>''
        ]);
        ///////////////////////////////////////
    }
}
