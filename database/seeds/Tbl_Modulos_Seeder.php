<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class Tbl_Modulos_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ADMIN MODULOS ==============================================================================================
        DB::table('tbl_modulos')->insert([
            'id'=>13,
            'nome'=>'Usuários',
            'descricao'=>'Funcionalidade do site gerencial.',
            'rota'=>'usuarios',
            'gerencial'=>true,
            'sistema'=>'web',
        ]);
        DB::table('tbl_modulos')->insert([
            'id'=>14,
            'nome'=>'Perfis',
            'descricao'=>'Funcionalidade do site gerencial.',
            'rota'=>'perfis',
            'gerencial'=>true,
            'sistema'=>'web',
        ]);
        DB::table('tbl_modulos')->insert([
            'id'=>15,
            'nome'=>'Galerias',
            'descricao'=>'Funcionalidade do site gerencial.',
            'rota'=>'galerias',
            'gerencial'=>true,
            'sistema'=>'web',
        ]);
        DB::table('tbl_modulos')->insert([
            'id'=>16,
            'nome'=>'Eventos fixos',
            'descricao'=>'Funcionalidade do site gerencial.',
            'rota'=>'eventosfixos',
            'gerencial'=>true,
            'sistema'=>'web',
        ]);
        DB::table('tbl_modulos')->insert([
            'id'=>17,
            'nome'=>'Linha do tempo',
            'descricao'=>'Funcionalidade do site gerencial.',
            'rota'=>'eventos',
            'gerencial'=>true,
            'sistema'=>'web',
        ]);
        DB::table('tbl_modulos')->insert([
            'id'=>18,
            'nome'=>'Notícias',
            'descricao'=>'Funcionalidade do site gerencial.',
            'rota'=>'noticias',
            'gerencial'=>true,
            'sistema'=>'web',
        ]);
        DB::table('tbl_modulos')->insert([
            'id'=>19,
            'nome'=>'Banners',
            'descricao'=>'Funcionalidade do site gerencial.',
            'rota'=>'banners',
            'gerencial'=>true,
            'sistema'=>'web',
        ]);
        DB::table('tbl_modulos')->insert([
            'id'=>20,
            'nome'=>'Vídeos',
            'descricao'=>'Funcionalidade do site gerencial.',
            'rota'=>'midias',
            'gerencial'=>true,
            'sistema'=>'web',
        ]);
        DB::table('tbl_modulos')->insert([
            'id'=>21,
            'nome'=>'Publicações',
            'descricao'=>'Funcionalidade do site gerencial.',
            'rota'=>'publicacoes',
            'gerencial'=>true,
            'sistema'=>'web',
        ]);
        DB::table('tbl_modulos')->insert([
            'id'=>22,
            'nome'=>'Configurações',
            'descricao'=>'Funcionalidade do site gerencial.',
            'rota'=>'configuracoes',
            'gerencial'=>true,
            'sistema'=>'web',
        ]);
        DB::table('tbl_modulos')->insert([
            'id'=>23,
            'nome'=>'Login',
            'descricao'=>'Funcionalidade do site apresentativo.',
            'rota'=>'login',
        ]);
        DB::table('tbl_modulos')->insert([
            'id'=>24,
            'nome'=>'Funções',
            'descricao'=>'Funcionalidade do site gerencial.',
            'rota'=>'funcoes',
            'gerencial'=>true,
            'sistema'=>'web',
        ]);
        DB::table('tbl_modulos')->insert([
            'id'=>25,
            'nome'=>'Membros',
            'descricao'=>'Funcionalidade do site gerencial.',
            'rota'=>'membros',
            'gerencial'=>true,
            'sistema'=>'web',
        ]);
        DB::table('tbl_modulos')->insert([
            'id'=>27,
            'nome'=>'Carrinho',
            'descricao'=>'Funcionalidade do site gerencial.',
            'rota'=>'carrinho',
            'gerencial'=>true,
            'sistema'=>'web',
        ]);
        // ============================================================================================================

        // TEMPLATES MODULOS ==========================================================================================
        DB::table('tbl_modulos')->insert([
            'id'=>5,
            'nome'=>'Eventos Fixos',
            'descricao'=>'Funcionalidade do site apresentativo.',
            'rota'=>'eventosfixos',
        ]);
        DB::table('tbl_modulos')->insert([
            'id'=>6,
            'nome'=>'Linha do tempo',
            'descricao'=>'Funcionalidade do site apresentativo.',
            'rota'=>'eventos',
        ]);
        DB::table('tbl_modulos')->insert([
            'id'=>9,
            'nome'=>'Notícias',
            'descricao'=>'Funcionalidade do site apresentativo.',
            'rota'=>'noticias',
        ]);
        DB::table('tbl_modulos')->insert([
            'id'=>10,
            'nome'=>'Galeria',
            'descricao'=>'Funcionalidade do site apresentativo.',
            'rota'=>'galeria',
        ]);
        DB::table('tbl_modulos')->insert([
            'id'=>12,
            'nome'=>'Vídeos',
            'descricao'=>'Funcionalidade do site apresentativo.',
            'rota'=>'midias',
        ]);
        DB::table('tbl_modulos')->insert([
            'id'=>28,
            'nome'=>'Carrinho',
            'descricao'=>'Funcionalidade do site apresentativo.',
            'rota'=>'carrinho',
        ]);
        // ============================================================================================================

        // APP MODULOS ================================================================================================
        DB::table('tbl_modulos')->insert([
            'nome'=>'Produtos',
            'descricao'=>'Funcionalidade do aplicativo.',
            'rota'=>'modulo-produtos',
            'gerencial'=>false,
            'sistema'=>'app',
        ]);
        DB::table('tbl_modulos')->insert([
            'nome'=>'Mídias',
            'descricao'=>'Funcionalidade do aplicativo.',
            'rota'=>'modulo-midias',
            'gerencial'=>false,
            'sistema'=>'app',
        ]);
        DB::table('tbl_modulos')->insert([
            'nome'=>'Eventos',
            'descricao'=>'Funcionalidade do aplicativo.',
            'rota'=>'modulo-eventos',
            'gerencial'=>false,
            'sistema'=>'app',
        ]);
        DB::table('tbl_modulos')->insert([
            'nome'=>'Eventos fixos',
            'descricao'=>'Funcionalidade do aplicativo.',
            'rota'=>'modulo-eventosfixos',
            'gerencial'=>false,
            'sistema'=>'app',
        ]);
        DB::table('tbl_modulos')->insert([
            'nome'=>'Notícias',
            'descricao'=>'Funcionalidade do aplicativo.',
            'rota'=>'modulo-noticias',
            'gerencial'=>false,
            'sistema'=>'app',
        ]);
        DB::table('tbl_modulos')->insert([
            'nome'=>'Galerias',
            'descricao'=>'Funcionalidade do aplicativo.',
            'rota'=>'modulo-galerias',
            'gerencial'=>false,
            'sistema'=>'app',
        ]);
        DB::table('tbl_modulos')->insert([
            'nome'=>'Publicações',
            'descricao'=>'Funcionalidade do aplicativo.',
            'rota'=>'modulo-publicacoes',
            'gerencial'=>false,
            'sistema'=>'app',
        ]);
        DB::table('tbl_modulos')->insert([
            'nome'=>'Apresentação',
            'descricao'=>'Funcionalidade do aplicativo.',
            'rota'=>'modulo-apresentacao',
            'gerencial'=>false,
            'sistema'=>'app',
        ]);
        DB::table('tbl_modulos')->insert([
            'nome'=>'Login',
            'descricao'=>'Funcionalidade do aplicativo.',
            'rota'=>'modulo-login',
            'gerencial'=>false,
            'sistema'=>'app',
        ]);
        // ============================================================================================================
    }
}
