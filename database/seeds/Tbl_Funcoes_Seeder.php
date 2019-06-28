<?php

use Illuminate\Database\Seeder;

class Tbl_Funcoes_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Funções da escola CEPSMA ==============================================================
        DB::table('tbl_funcoes')->insert([
            'id'=>1,
            'nome'=>"Professor",
            'apresentar'=>true,
            'id_igreja'=>1,
        ]);

        DB::table('tbl_funcoes')->insert([
            'id'=>2,
            'nome'=>"Diretor",
            'apresentar'=>true,
            'id_igreja'=>1,
        ]);

        DB::table('tbl_funcoes')->insert([
            'id'=>3,
            'nome'=>"Secretário",
            'apresentar'=>true,
            'id_igreja'=>1,
        ]);
        
    }
}
