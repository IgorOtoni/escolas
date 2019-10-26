<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Seeder_Gratunos extends Seeder{

    public function run(){

        // META DADOS AREA !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

    	// PERFIS =================================================================================================
    	// PERFIS EXCLUSIVOS | NAO DEVEM MUDAR
    	DB::table('tbl_perfis')->insert([
            'id'=>1,
            'nome'=>'ADM Plataforma',
            'descricao'=>'Administrador da plataforma.',
            'status'=> true,
            'id_site'=>null,
        ]);

        DB::table('tbl_perfis')->insert([
            'id'=>100,
            'nome'=>'Comprador',
            'descricao'=>'Usuário que pode realizar compras na plataforma.',
            'status'=> true,
            'id_site'=>null,
        ]);
        // ========================================================================================================

        // TURNOS PARA ENTREGAS ===================================================================================
        // NAO DEVE MUDAR
        DB::table('tbl_turnos_entregas')->insert([
            'id'=>1,
            'nome'=>'Manhã',
            'descricao'=>'De 6h as 12h.',
        ]);
        DB::table('tbl_turnos_entregas')->insert([
            'id'=>2,
            'nome'=>'Tarde',
            'descricao'=>'De 13h as 17h.',
        ]);
        DB::table('tbl_turnos_entregas')->insert([
            'id'=>3,
            'nome'=>'Noite',
            'descricao'=>'De 17h as 22h.',
        ]);
        // ========================================================================================================


        // SITUACOES PARA ENTREGAS ================================================================================
        // NAO DEVE MUDAR
        DB::table('tbl_situacoes_entregas')->insert([
            'id'=>1,
            'nome'=>'Pendente',
        ]);
        DB::table('tbl_situacoes_entregas')->insert([
            'id'=>2,
            'nome'=>'Atrasada',
        ]);
        DB::table('tbl_situacoes_entregas')->insert([
            'id'=>3,
            'nome'=>'Realizada',
        ]);
        DB::table('tbl_situacoes_entregas')->insert([
            'id'=>4,
            'nome'=>'Cancelada',
        ]);
        // ============================================================================+==============================

        // TIPOS DE VENDAS ========================================================================================
        DB::table('tbl_tipos_vendas')->insert([
            'id'=>1,
            'nome'=>'Unidade',
        ]);
        // ========================================================================================================

        // ADMIN MODULOS ==========================================================================================
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
            'id'=>26,
            'nome'=>'Comunidade',
            'descricao'=>'Funcionalidade do site gerencial.',
            'rota'=>'comunidades',
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
        // ========================================================================================================

        // TEMPLATES MODULOS ======================================================================================
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
        // ========================================================================================================

        // APP MODULOS ============================================================================================
        DB::table('tbl_modulos')->insert([
            'nome'=>'Comunidades',
            'descricao'=>'Funcionalidade do aplicativo.',
            'rota'=>'modulo-comunidades',
            'gerencial'=>false,
            'sistema'=>'app',
        ]);
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
        // ========================================================================================================

        // PERMISSOES SEEDER ======================================================================================
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
        // ========================================================================================================

        // PERMISSOES MODULOS SEEDER ==============================================================================
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

        // Permissões do módulo de comunidades
        DB::table('tbl_modulos_permissoes')->insert([
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
        ]);

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
        // ========================================================================================================

        // TEMPLATES ==============================================================================================
        DB::table('tbl_templates')->insert([
            'nome'=>'Template padrão 1',
        ]);

        DB::table('tbl_templates')->insert([
            'nome'=>'Template padrão 2',
        ]);

        DB::table('tbl_templates')->insert([
            'nome'=>'Template padrão 3',
        ]);

        DB::table('tbl_templates')->insert([
            'nome'=>'Template padrão 4',
        ]);

        DB::table('tbl_templates')->insert([
            'nome'=>'Template padrão 5',
        ]);

        DB::table('tbl_templates')->insert([
            'nome'=>'Template padrão 6',
        ]);

        DB::table('tbl_templates')->insert([
            'nome'=>'Template padrão 7',
        ]);

        DB::table('tbl_templates')->insert([
            'nome'=>'Template padrão 8',
        ]);
        // ========================================================================================================

        // FOTOS TEMPLATES ========================================================================================
        /*DB::table('tbl_template_fotos')->insert([
            'id'=>1,
            'id_template'=>1,
            'foto'=>file_get_contents(getcwd()."\\public\\storage\\templates\\template-1-1.png"),
            'created_at'=>Carbon::parse(date('Y-m-d h:i:s', time())),
        ]);*/
        // ========================================================================================================

        // !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

        // USUARIOS ===============================================================================================
        DB::table('users')->insert([
            'nome'=>'Admin',
            'email'=>'admin@teste.com',
            'id_perfil'=>1,
            'password'=>bcrypt('123456'),
            'status'=> true,
        ]);
        // ========================================================================================================
	}

}