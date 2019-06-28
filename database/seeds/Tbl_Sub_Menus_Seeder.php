<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Tbl_Sub_Menus_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ESCOLA CEPSMA ///////////////////////////////////////////////////////////////////////
        DB::table('tbl_sub_menus')->insert([
            'id'=>1,
            'id_menu'=>3,
            'nome'=>'Visões e valores',
            'link'=>'apresentacao',
            'ordem'=>1,
        ]);
        DB::table('tbl_sub_menus')->insert([
            'id'=>2,
            'id_menu'=>3,
            'nome'=>'Contatos',
            'link'=>'contato',
            'ordem'=>2,
        ]);
        DB::table('tbl_sub_menus')->insert([
            'id'=>3,
            'id_menu'=>7,
            'nome'=>'Eventos fixos',
            'link'=>'eventosfixos',
            'ordem'=>1,
        ]);
        DB::table('tbl_sub_menus')->insert([
            'id'=>4,
            'id_menu'=>7,
            'nome'=>'Linha do tempo',
            'link'=>'eventos',
            'ordem'=>2,
        ]);

    }
}
