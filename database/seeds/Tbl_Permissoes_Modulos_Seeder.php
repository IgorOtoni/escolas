<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Tbl_Permissoes_Modulos_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Permissões do módulo de usuário
        DB::table('tbl_modulos_permissoes')->insert([
            'id'=>1,
            'id_modulo'=>13,
            'id_permissao'=>1,
        ]);
        DB::table('tbl_modulos_permissoes')->insert([
            'id'=>2,
            'id_modulo'=>13,
            'id_permissao'=>2,
        ]);
        DB::table('tbl_modulos_permissoes')->insert([
            'id'=>3,
            'id_modulo'=>13,
            'id_permissao'=>3,
        ]);
        //////////////////////////////////////

        // Permissões do módulo de perfis
        DB::table('tbl_modulos_permissoes')->insert([
            'id'=>4,
            'id_modulo'=>14,
            'id_permissao'=>1,
        ]);
        DB::table('tbl_modulos_permissoes')->insert([
            'id'=>5,
            'id_modulo'=>14,
            'id_permissao'=>2,
        ]);
        DB::table('tbl_modulos_permissoes')->insert([
            'id'=>6,
            'id_modulo'=>14,
            'id_permissao'=>3,
        ]);
        //////////////////////////////////////

        // Permissões do módulo de galerias
        DB::table('tbl_modulos_permissoes')->insert([
            'id'=>7,
            'id_modulo'=>15,
            'id_permissao'=>1,
        ]);
        DB::table('tbl_modulos_permissoes')->insert([
            'id'=>8,
            'id_modulo'=>15,
            'id_permissao'=>2,
        ]);
        DB::table('tbl_modulos_permissoes')->insert([
            'id'=>9,
            'id_modulo'=>15,
            'id_permissao'=>3,
        ]);
        //////////////////////////////////////

        // Permissões do módulo de eventos fixos
        DB::table('tbl_modulos_permissoes')->insert([
            'id'=>10,
            'id_modulo'=>16,
            'id_permissao'=>1,
        ]);
        DB::table('tbl_modulos_permissoes')->insert([
            'id'=>11,
            'id_modulo'=>16,
            'id_permissao'=>2,
        ]);
        DB::table('tbl_modulos_permissoes')->insert([
            'id'=>12,
            'id_modulo'=>16,
            'id_permissao'=>3,
        ]);
        //////////////////////////////////////

        // Permissões do módulo de linha do tempo
        DB::table('tbl_modulos_permissoes')->insert([
            'id'=>13,
            'id_modulo'=>17,
            'id_permissao'=>1,
        ]);
        DB::table('tbl_modulos_permissoes')->insert([
            'id'=>14,
            'id_modulo'=>17,
            'id_permissao'=>2,
        ]);
        DB::table('tbl_modulos_permissoes')->insert([
            'id'=>15,
            'id_modulo'=>17,
            'id_permissao'=>3,
        ]);
        //////////////////////////////////////

        // Permissões do módulo de notícias
        DB::table('tbl_modulos_permissoes')->insert([
            'id'=>16,
            'id_modulo'=>18,
            'id_permissao'=>1,
        ]);
        DB::table('tbl_modulos_permissoes')->insert([
            'id'=>17,
            'id_modulo'=>18,
            'id_permissao'=>2,
        ]);
        DB::table('tbl_modulos_permissoes')->insert([
            'id'=>18,
            'id_modulo'=>18,
            'id_permissao'=>3,
        ]);
        //////////////////////////////////////

        // Permissões do módulo de banners
        DB::table('tbl_modulos_permissoes')->insert([
            'id'=>19,
            'id_modulo'=>19,
            'id_permissao'=>1,
        ]);
        DB::table('tbl_modulos_permissoes')->insert([
            'id'=>20,
            'id_modulo'=>19,
            'id_permissao'=>2,
        ]);
        DB::table('tbl_modulos_permissoes')->insert([
            'id'=>21,
            'id_modulo'=>19,
            'id_permissao'=>3,
        ]);
        //////////////////////////////////////

        // Permissões do módulo de sermões
        DB::table('tbl_modulos_permissoes')->insert([
            'id'=>22,
            'id_modulo'=>20,
            'id_permissao'=>1,
        ]);
        DB::table('tbl_modulos_permissoes')->insert([
            'id'=>23,
            'id_modulo'=>20,
            'id_permissao'=>2,
        ]);
        DB::table('tbl_modulos_permissoes')->insert([
            'id'=>24,
            'id_modulo'=>20,
            'id_permissao'=>3,
        ]);
        //////////////////////////////////////

        // Permissões do módulo de publicações
        DB::table('tbl_modulos_permissoes')->insert([
            'id'=>25,
            'id_modulo'=>21,
            'id_permissao'=>1,
        ]);
        DB::table('tbl_modulos_permissoes')->insert([
            'id'=>26,
            'id_modulo'=>21,
            'id_permissao'=>2,
        ]);
        DB::table('tbl_modulos_permissoes')->insert([
            'id'=>27,
            'id_modulo'=>21,
            'id_permissao'=>3,
        ]);
        //////////////////////////////////////

        // Permissões do módulo de configurações
        DB::table('tbl_modulos_permissoes')->insert([
            'id'=>28,
            'id_modulo'=>22,
            'id_permissao'=>1,
        ]);
        DB::table('tbl_modulos_permissoes')->insert([
            'id'=>29,
            'id_modulo'=>22,
            'id_permissao'=>2,
        ]);
        DB::table('tbl_modulos_permissoes')->insert([
            'id'=>30,
            'id_modulo'=>22,
            'id_permissao'=>3,
        ]);
        //////////////////////////////////////

        // Permissões do módulo de funções
        DB::table('tbl_modulos_permissoes')->insert([
            'id'=>31,
            'id_modulo'=>24,
            'id_permissao'=>1,
        ]);
        DB::table('tbl_modulos_permissoes')->insert([
            'id'=>32,
            'id_modulo'=>24,
            'id_permissao'=>2,
        ]);
        DB::table('tbl_modulos_permissoes')->insert([
            'id'=>33,
            'id_modulo'=>24,
            'id_permissao'=>3,
        ]);
        //////////////////////////////////////

        // Permissões do módulo de membros
        DB::table('tbl_modulos_permissoes')->insert([
            'id'=>34,
            'id_modulo'=>25,
            'id_permissao'=>1,
        ]);
        DB::table('tbl_modulos_permissoes')->insert([
            'id'=>35,
            'id_modulo'=>25,
            'id_permissao'=>2,
        ]);
        DB::table('tbl_modulos_permissoes')->insert([
            'id'=>36,
            'id_modulo'=>25,
            'id_permissao'=>3,
        ]);
        //////////////////////////////////////

        // Permissões do módulo de comunidades
        /*DB::table('tbl_modulos_permissoes')->insert([
            'id'=>37,
            'id_modulo'=>26,
            'id_permissao'=>1,
        ]);
        DB::table('tbl_modulos_permissoes')->insert([
            'id'=>38,
            'id_modulo'=>26,
            'id_permissao'=>2,
        ]);
        DB::table('tbl_modulos_permissoes')->insert([
            'id'=>39,
            'id_modulo'=>26,
            'id_permissao'=>3,
        ]);*/
        //////////////////////////////////////

        // Permissões do módulo de carrinho
        DB::table('tbl_modulos_permissoes')->insert([
            'id'=>40,
            'id_modulo'=>27,
            'id_permissao'=>1,
        ]);
        DB::table('tbl_modulos_permissoes')->insert([
            'id'=>41,
            'id_modulo'=>27,
            'id_permissao'=>2,
        ]);
        DB::table('tbl_modulos_permissoes')->insert([
            'id'=>42,
            'id_modulo'=>27,
            'id_permissao'=>3,
        ]);
        //////////////////////////////////////
    }
}
