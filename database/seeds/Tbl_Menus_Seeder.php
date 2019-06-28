<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class Tbl_Menus_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ESCOLA CEPSMA //////////////////////////////////////////////////////////////////
        DB::table('tbl_menus')->insert([
            'id'=>1,
            'id_configuracao'=>1,
            'nome'=>'Eduno',
            'link'=>'http://www.eduno.com.br/',
            'ordem'=>1,
        ]);
        DB::table('tbl_menus')->insert([
            'id'=>2,
            'id_configuracao'=>1,
            'nome'=>'Administrativo',
            'link'=>'login',
            'ordem'=>2,
        ]);
        DB::table('tbl_menus')->insert([
            'id'=>3,
            'id_configuracao'=>1,
            'nome'=>'Sobre nós',
            'ordem'=>3,
        ]);
        DB::table('tbl_menus')->insert([
            'id'=>4,
            'id_configuracao'=>1,
            'nome'=>'Vídeos',
            'link'=>'sermoes',
            'ordem'=>4,
        ]);
        DB::table('tbl_menus')->insert([
            'id'=>5,
            'id_configuracao'=>1,
            'nome'=>'Galeria',
            'link'=>'galeria',
            'ordem'=>5,
        ]);
        DB::table('tbl_menus')->insert([
            'id'=>6,
            'id_configuracao'=>1,
            'nome'=>'Notícias',
            'link'=>'noticias',
            'ordem'=>6,
        ]);
        DB::table('tbl_menus')->insert([
            'id'=>7,
            'id_configuracao'=>1,
            'nome'=>'Eventos',
            'ordem'=>7,
        ]);
        
    }
}
