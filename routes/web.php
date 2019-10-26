<?php

use App\TblPerfil;
use App\TblSite;

// Authentication Routes...
Route::get('/login', 'PlataformaController@login')->name('login');
Route::post('/autenticar', 'PlataformaController@autenticar')->name('autenticar');
Route::post('/{url}/autenticar', 'PlataformaController@autenticar')->name('autenticar_');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
Route::post('/{url}/logout', 'Auth\LoginController@logout')->name('logout_');

Route::get('/formulario', 'PlataformaController@formulario')->name('plataforma.formulario');
Route::post('/cadastro', 'PlataformaController@cadastro')->name('plataforma.incluirSite');

Route::get('/congregacoes', 'PlataformaController@gratunos')->name('plataforma.congregacoes');
Route::get('/filtrarSite', 'PlataformaController@filtrarSite')->name('plataforma.filtrarSite');

Route::get('/', 'PlataformaController@index')->name('plataforma.home');

Route::get('error', function () {
    return view('error');
});

Route::get('/logout', function () {
    if(\Auth::user()->id_perfil != 100){
        auth()->logout();

        $notification = array(
            'message' => 'Até mais!', 
            'alert-type' => 'warning'
        );

        return redirect('login')->with($notification);
    }else{
        auth()->logout();

        \Session()->put('carrinho', null);
        \Session()->put('carrinho_qtd', null);

        $notification = array(
            'message' => 'Até mais!', 
            'alert-type' => 'warning'
        );

        return redirect()->back()->with($notification);
    }
});

Route::group(['middleware' => 'auth'], function () {
    // ROTAS DE ADMINISTRAÇÃO DO SISTEMA

    Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {

        // CRUD IGREJAS ===============================================================================================
        Route::get('sites', 'AdminController@sites')
            ->name('sites');
        Route::get('sites/tbl_sites', 'AdminController@tbl_sites')
            ->name('sites.tbl_sites');
        Route::get('sites/switchStatus/{id}', 'AdminController@switchStatusSite')
            ->name('sites.switchStatus');
        Route::get('sites/editarSite/{id}', 'AdminController@editarSite')
            ->name('sites.editar');
        Route::post('sites/incluir', 'AdminController@salvarSite')
            ->name('sites.incluir');
        Route::post('sites/atualizar', 'AdminController@atualizarSite')
            ->name('sites.atualizar');
        Route::post('sites/excluirLogo', 'AdminController@excluirLogo')
            ->name('sites.excluirLogo');
        Route::post('sites/salvarConfiguracoes', 'AdminController@salvarConfiguracoes')
            ->name('sites.salvarConfiguracoes');
        Route::get('sites/carregarModulos/{id}', 'AdminController@modulos_site')
            ->name('sites.carregarModulos');
        Route::get('sites/configuracoes/{id}', 'AdminController@configuracoes')
            ->name('sites.configuracoes');
        Route::post('sites/adicionarMenu', 'AdminController@adicionarMenu')
            ->name('sites.adicionarMenu');
        Route::post('sites/editarMenu', 'AdminController@editarMenu')
            ->name('sites.editarMenu');
        Route::get('sites/excluirMenu/{id}', 'AdminController@excluirMenu')
            ->name('sites.excluirMenu');
        Route::post('sites/adicionarSubMenu', 'AdminController@adicionarSubMenu')
            ->name('sites.adicionarSubMenu');
        Route::post('sites/editarSubMenu', 'AdminController@editarSubMenu')
            ->name('sites.editarSubMenu');
        Route::get('sites/excluirSubMenu/{id}', 'AdminController@excluirSubMenu')
            ->name('sites.excluirSubMenu');
        Route::post('sites/adicionarSubSubMenu', 'AdminController@adicionarSubSubMenu')
            ->name('sites.adicionarSubSubMenu');
        Route::post('sites/editarSubSubMenu', 'AdminController@editarSubSubMenu')
            ->name('sites.editarSubSubMenu');
        Route::get('sites/excluirSubSubMenu/{id}', 'AdminController@excluirSubSubMenu')
            ->name('sites.excluirSubSubMenu');
        Route::post('sites/adicionarMenuAplicativo', 'AdminController@adicionarMenuAplicativo')
            ->name('sites.adicionarMenuAplicativo');
        Route::post('sites/editarMenuAplicativo', 'AdminController@editarMenuAplicativo')
            ->name('sites.editarMenuAplicativo');
        Route::get('sites/excluirMenuAplicativo/{id}', 'AdminController@excluirMenuAplicativo')
            ->name('sites.excluirMenuAplicativo');
        // =========================================================================================================== 

        // CRUD PERFIS ===============================================================================================
        Route::get('perfis', 'AdminController@perfis')
            ->name('perfis');
        Route::post('perfis/incluir', 'AdminController@salvarPerfil')
            ->name('perfis.incluir');
        Route::get('perfis/editarPerfil/{id}', 'AdminController@editarPerfil')
            ->name('perfis.editar');
        Route::post('perfis/atualizar', 'AdminController@atualizarPerfil')
            ->name('perfis.atualizar');
        Route::get('perfis/tbl_perfis', 'AdminController@tbl_perfis')
            ->name('perfis.tbl_perfis');
		Route::get('perfis/switchStatus/{id}', 'AdminController@switchStatusPerfil')
            ->name('perfis.switchStatus');
        Route::get('perfis/carregarPermissoes/{id}', 'AdminController@carregarPermissoes')
            ->name('perfis.carregarPermissoes');
        Route::post('perfis/carregarPermissoes', 'AdminController@carregarPermissoes')
            ->name('perfis.carregarPermissoes');
        Route::post('perfis/atualizarPermissoes/', 'AdminController@atualizarPermissoes')
            ->name('perfis.atualizarPermissoes');
        // ============================================================================================================

        // CRUD USUARIOS ==============================================================================================
        Route::get('usuarios', 'AdminController@usuarios')
            ->name('usuarios');
        Route::post('usuarios/incluir', 'AdminController@salvarUsuario')
            ->name('usuarios.incluir');
        Route::get('usuarios/tbl_usuarios', 'AdminController@tbl_usuarios')
            ->name('usuarios.tbl_usuarios');
        Route::get('usuarios/switchStatus/{id}', 'AdminController@switchStatusUsuario')
            ->name('usuarios.switchStatus');
        Route::get('usuarios/editarUsuario/{id}', 'AdminController@editarUsuario')
            ->name('usuarios.editar');
        Route::post('usuarios/atualizar', 'AdminController@autalizarusuario')
            ->name('usuarios.atualizar');
        // ============================================================================================================

        // CONTA ======================================================================================================
        Route::get('usuarios/conta', 'AdminController@conta')
            ->name('admin.account');
        Route::post('usuarios/atualizarConta', 'AdminController@atualizarConta')
            ->name('admin.account.atualizar');
        // ============================================================================================================

        Route::get('/home', 'HomeController@index')
            ->name('admin.home');
    });
    Route::group(['prefix' => 'usuario', 'middleware' => 'usuario'], function () {
        Route::get('/home', 'HomeController@index')
            ->name('usuario.home');

        // FUNÇÕES ==================================================================
        Route::get('/carregarModulosSite/{id}', 'HomeController@modulos_site')
            ->name('usuario.carregarModulosSite');
        /////////////////////////////////////////////////////////////////////////////

        // CRUD BANNERS =============================================================
        Route::get('/banners', 'HomeController@banners')
            ->name('usuario.banners');
        Route::get('/tbl_banners', 'HomeController@tbl_banners')
            ->name('usuario.tbl_banners');
        Route::post('/incluirBanner', 'HomeController@incluirBanner')
            ->name('usuario.incluirBanner');
        Route::get('/editarBanner/{id}', 'HomeController@editarBanner')
            ->name('usuario.editarBanner');
        Route::post('/atualizarBanner', 'HomeController@atualizarBanner')
            ->name('usuario.atualizarBanner');
        Route::post('/excluirFotoBanner', 'HomeController@excluirFotoBanner')
            ->name('usuario.excluirFotoBanner');
        Route::get('/excluirBanner/{id}', 'HomeController@excluirBanner')
            ->name('usuario.excluirBanner');
        /////////////////////////////////////////////////////////////////////////////

        // CRUD GALERIAS ============================================================
        Route::get('/galerias', 'HomeController@galerias')
            ->name('usuario.galerias');
        Route::get('/tbl_galerias', 'HomeController@tbl_galerias')
            ->name('usuario.tbl_galerias');
        Route::post('/incluirGaleria', 'HomeController@incluirGaleria')
            ->name('usuario.incluirGaleria');
        Route::get('/editarGaleria/{id}', 'HomeController@editarGaleria')
            ->name('usuario.editarGaleria');
        Route::post('/atualizarGaleria', 'HomeController@atualizarGaleria')
            ->name('usuario.atualizarGaleria');
        Route::post('/excluirFotoGaleria', 'HomeController@excluirFotoGaleria')
            ->name('usuario.excluirFotoGaleria');
        Route::get('/excluirGaleria/{id}', 'HomeController@excluirGaleria')
            ->name('usuario.excluirGaleria');
        /////////////////////////////////////////////////////////////////////////////

        // CRUD EVENTOS FIXOS =======================================================
        Route::get('/eventosfixos', 'HomeController@eventosfixos')
            ->name('usuario.eventosfixos');
        Route::get('/tbl_eventosfixos', 'HomeController@tbl_eventosfixos')
            ->name('usuario.tbl_eventosfixos');
        Route::post('/incluirEventoFixo', 'HomeController@incluirEventoFixo')
            ->name('usuario.incluirEventoFixo');
        Route::get('/editarEventoFixo/{id}', 'HomeController@editarEventoFixo')
            ->name('usuario.editarEventoFixo');
        Route::post('/atualizarEventoFixo', 'HomeController@atualizarEventoFixo')
            ->name('usuario.atualizarEventoFixo');
        Route::post('/excluirFotoEventoFixo', 'HomeController@excluirFotoEventoFixo')
            ->name('usuario.excluirFotoEventoFixo');
        Route::get('/excluirEventoFixo/{id}', 'HomeController@excluirEventoFixo')
            ->name('usuario.excluirEventoFixo');
        /////////////////////////////////////////////////////////////////////////////

        // CRUD NOTICIAS ============================================================
        Route::get('/noticias', 'HomeController@noticias')
            ->name('usuario.noticias');
        Route::get('/tbl_noticias', 'HomeController@tbl_noticias')
            ->name('usuario.tbl_noticias');
        Route::post('/incluirNoticia', 'HomeController@incluirNoticia')
            ->name('usuario.incluirNoticia');
        Route::get('/editarNoticia/{id}', 'HomeController@editarNoticia')
            ->name('usuario.editarNoticia');
        Route::post('/atualizarNoticia', 'HomeController@atualizarNoticia')
            ->name('usuario.atualizarNoticia');
        Route::post('/excluirFotoNoticia', 'HomeController@excluirFotoNoticia')
            ->name('usuario.excluirFotoNoticia');
        Route::get('/excluirNoticia/{id}', 'HomeController@excluirNoticia')
            ->name('usuario.excluirNoticia');
        /////////////////////////////////////////////////////////////////////////////

        // CONFIGURACOES SITE =======================================================
        Route::get('/configuracoes', 'HomeController@configuracoes')
            ->name('usuario.configuracoes');
        Route::post('/salvarConfiguracoes', 'HomeController@salvarConfiguracoes')
            ->name('usuario.salvarConfiguracoes');        
        Route::post('/excluirLogo', 'HomeController@excluirLogo')
            ->name('usuario.excluirLogo');
        Route::post('/adicionarMenu', 'HomeController@adicionarMenu')
            ->name('usuario.adicionarMenu');
        Route::post('/editarMenu', 'HomeController@editarMenu')
            ->name('usuario.editarMenu');
        Route::get('/excluirMenu/{id}', 'HomeController@excluirMenu')
            ->name('usuario.excluirMenu');
        Route::post('/adicionarSubMenu', 'HomeController@adicionarSubMenu')
            ->name('usuario.adicionarSubMenu');
        Route::post('/editarSubMenu', 'HomeController@editarSubMenu')
            ->name('usuario.editarSubMenu');
        Route::get('/excluirSubMenu/{id}', 'HomeController@excluirSubMenu')
            ->name('usuario.excluirSubMenu');
        Route::post('/adicionarSubSubMenu', 'HomeController@adicionarSubSubMenu')
            ->name('usuario.adicionarSubSubMenu');
        Route::post('/editarSubSubMenu', 'HomeController@editarSubSubMenu')
            ->name('usuario.editarSubSubMenu');
        Route::get('/excluirSubSubMenu/{id}', 'HomeController@excluirSubSubMenu')
            ->name('usuario.excluirSubSubMenu');
        Route::post('/adicionarMenuAplicativo', 'HomeController@adicionarMenuAplicativo')
            ->name('usuario.adicionarMenuAplicativo');
        Route::post('/editarMenuAplicativo', 'HomeController@editarMenuAplicativo')
            ->name('usuario.editarMenuAplicativo');
        Route::get('/excluirMenuAplicativo/{id}', 'HomeController@excluirMenuAplicativo')
            ->name('usuario.excluirMenuAplicativo');
        /////////////////////////////////////////////////////////////////////////////

        // CRUD MIDIAS =============================================================
        Route::get('/midias', 'HomeController@midias')
            ->name('usuario.midias');
        Route::get('/tbl_midias', 'HomeController@tbl_midias')
            ->name('usuario.tbl_midias');
        Route::post('/incluirMidia', 'HomeController@incluirMidia')
            ->name('usuario.incluirMidia');
        Route::get('/editarMidia/{id}', 'HomeController@editarMidia')
            ->name('usuario.editarMidia');
        Route::post('/atualizarMidia', 'HomeController@atualizarMidia')
            ->name('usuario.atualizarMidia');
        Route::get('/excluirMidia/{id}', 'HomeController@excluirMidia')
            ->name('usuario.excluirMidia');
        /////////////////////////////////////////////////////////////////////////////

        // CRUD EVENTOS =============================================================
        Route::get('/eventos', 'HomeController@eventos')
            ->name('usuario.eventos');
        Route::get('/tbl_eventos', 'HomeController@tbl_eventos')
            ->name('usuario.tbl_eventos');
        Route::post('/incluirEvento', 'HomeController@incluirEvento')
            ->name('usuario.incluirEvento');
        Route::get('/editarEvento/{id}', 'HomeController@editarEvento')
            ->name('usuario.editarEvento');
        Route::post('/atualizarEvento', 'HomeController@atualizarEvento')
            ->name('usuario.atualizarEvento');
        Route::post('/excluirFotoEvento', 'HomeController@excluirFotoEvento')
            ->name('usuario.excluirFotoEvento');
        Route::get('/excluirEvento/{id}', 'HomeController@excluirEvento')
            ->name('usuario.excluirEvento');
        Route::post('/atualizarInscricoes', 'HomeController@atualizarInscricoes')
            ->name('usuario.atualizarInscricoes');
        /////////////////////////////////////////////////////////////////////////////

        // CRUD PUBLICAÇÕES =========================================================
        Route::get('/publicacoes', 'HomeController@publicacoes')
            ->name('usuario.publicacoes');
        Route::get('/tbl_publicacoes', 'HomeController@tbl_publicacoes')
            ->name('usuario.tbl_publicacoes');
        Route::post('/incluirPublicacao', 'HomeController@incluirPublicacao')
            ->name('usuario.incluirPublicacao');
        Route::get('/editarPublicacao/{id}', 'HomeController@editarPublicacao')
            ->name('usuario.editarPublicacao');
        Route::post('/atualizarPublicacao', 'HomeController@atualizarPublicacao')
            ->name('usuario.atualizarPublicacao');
        Route::post('/excluirFotoPublicacao', 'HomeController@excluirFotoPublicacao')
            ->name('usuario.excluirFotoPublicacao');
        Route::get('/excluirPublicacao/{id}', 'HomeController@excluirPublicacao')
            ->name('usuario.excluirPublicacao');
        /////////////////////////////////////////////////////////////////////////////
    
        // ALTERAR CONTA ============================================================
        Route::get('usuarios/conta', 'HomeController@conta')
            ->name('account');
        Route::post('usuarios/atualizarConta', 'HomeController@atualizarConta')
            ->name('account.atualizar');
        /////////////////////////////////////////////////////////////////////////////

        // CRUD USUARIOS ============================================================
        Route::get('/usuarios', 'HomeController@usuarios')
            ->name('usuario.usuarios');
        Route::get('/tbl_usuarios', 'HomeController@tbl_usuarios')
            ->name('usuario.tbl_usuarios');
        Route::post('/incluirUsuario', 'HomeController@incluirUsuario')
            ->name('usuario.incluirUsuario');
        Route::get('/editarUsuario/{id}', 'HomeController@editarUsuario')
            ->name('usuario.editarUsuario');
        Route::post('/atualizarUsuario', 'HomeController@atualizarUsuario')
            ->name('usuario.atualizarUsuario');
        //Route::get('/excluirUsuario/{id}', 'HomeController@excluirUsuario')->name('usuario.excluirUsuario');
        Route::get('/switchStatusUsuario/{id}', 'HomeController@switchStatusUsuario')
            ->name('usuario.switchStatusUsuario');
        /////////////////////////////////////////////////////////////////////////////

        // CRUD PERFIS ==============================================================
        Route::get('/perfis', 'HomeController@perfis')
            ->name('usuario.perfis');
        Route::get('/tbl_perfis', 'HomeController@tbl_perfis')
            ->name('usuario.tbl_perfis');
        Route::post('/incluirPerfil', 'HomeController@incluirPerfil')
            ->name('usuario.incluirPerfil');
        Route::get('/editarPerfil/{id}', 'HomeController@editarPerfil')
            ->name('usuario.editarPerfil');
        Route::post('/atualizarPerfil', 'HomeController@atualizarPerfil')
            ->name('usuario.atualizarPerfil');
        //Route::get('/excluirPerfil/{id}', 'HomeController@excluirPerfil')->name('usuario.excluirPerfil');
        Route::get('/switchStatusPerfil/{id}', 'HomeController@switchStatusPerfil')
            ->name('usuario.switchStatusPerfil');
        Route::get('/carregarPermissoesPerfil/{id}', 'HomeController@carregarPermissoesPerfil')
            ->name('perfis.carregarPermissoesPerfil');
        Route::post('/atualizarPermissoesPerfil', 'HomeController@atualizarPermissoesPerfil')
            ->name('usuario.atualizarPermissoesPerfil');
        /////////////////////////////////////////////////////////////////////////////

        // CRUD FUNCOES =============================================================
        Route::get('/funcoes', 'HomeController@funcoes')
            ->name('usuario.funcoes');
        Route::get('/tbl_funcoes', 'HomeController@tbl_funcoes')
            ->name('usuario.tbl_funcoes');
        Route::post('/incluirFuncao', 'HomeController@incluirFuncao')
            ->name('usuario.incluirFuncao');
        Route::get('/editarFuncao/{id}', 'HomeController@editarFuncao')
            ->name('usuario.editarFuncao');
        Route::post('/atualizarFuncao', 'HomeController@atualizarFuncao')
            ->name('usuario.atualizarFuncao');
        Route::get('/excluirFuncao/{id}', 'HomeController@excluirFuncao')
            ->name('usuario.excluirFuncao');
        /////////////////////////////////////////////////////////////////////////////

        // CRUD MEMBROS =============================================================
        Route::get('/membros', 'HomeController@membros')
            ->name('usuario.membros');
        Route::get('/tbl_membros', 'HomeController@tbl_membros')
            ->name('usuario.tbl_membros');
        Route::post('/incluirMembro', 'HomeController@incluirMembro')
            ->name('usuario.incluirMembro');
        Route::get('/editarMembro/{id}', 'HomeController@editarMembro')
            ->name('usuario.editarMembro');
        Route::post('/atualizarMembro', 'HomeController@atualizarMembro')
            ->name('usuario.atualizarMembro');
        Route::post('/excluirFotoMembro', 'HomeController@excluirFotoMembro')
            ->name('usuario.excluirFotoMembro');
        Route::get('/excluirMembro/{id}', 'HomeController@excluirMembro')
            ->name('usuario.excluirMembro');
        Route::get('/switchStatusMembro/{id}', 'HomeController@switchStatusMembro')
            ->name('usuario.switchStatusMembro');
        /////////////////////////////////////////////////////////////////////////////

        // CRUD COMUNIDADES ==========================================================================
        Route::get('/comunidades', 'HomeController@comunidades')->name('usuario.comunidades');
        Route::get('/tbl_comunidades', 'HomeController@tbl_comunidades')->name('usuario.tbl_comunidades');
        Route::post('/incluirComunidade', 'HomeController@incluirComunidade')->name('usuario.incluirComunidade');
        Route::get('/editarComunidade/{id}', 'HomeController@editarComunidade')->name('usuario.editarComunidade');
        Route::post('/atualizarComunidade', 'HomeController@atualizarComunidade')->name('usuario.atualizarComunidade');
        Route::get('/excluirComunidade/{id}', 'HomeController@excluirComunidade')->name('usuario.excluirComunidade');
        Route::get('/listarReunioes/{id}', 'HomeController@listarReunioes')->name('usuario.listarReunioes');
        Route::get('/tbl_reunioes/', 'HomeController@tbl_reunioes')->name('usuario.tbl_reunioes');
        Route::get('/listarPresencas/{id}', 'HomeController@listarPresencas')->name('usuario.listarPresencas');
        Route::get('/tbl_presencas/', 'HomeController@tbl_presencas')->name('usuario.tbl_presencas');
        //////////////////////////////////////////////////////////////////////////////////////////

        // CRUD CARRINHO ============================================================
        // CATEGORIAS
        Route::get('/categorias', 'HomeController@categorias')
            ->name('usuario.categorias');
        Route::get('/tbl_categorias', 'HomeController@tbl_categorias')
            ->name('usuario.tbl_categorias');
        Route::post('/incluirCategoria', 'HomeController@incluirCategoria')
            ->name('usuario.incluirCategoria');
        Route::get('/editarCategoria/{id}', 'HomeController@editarCategoria')
            ->name('usuario.editarCategoria');
        Route::post('/atualizarCategoria', 'HomeController@atualizarCategoria')
            ->name('usuario.atualizarCategoria');
        Route::get('/excluirCategoria/{id}', 'HomeController@excluirCategoria')
            ->name('usuario.excluirCategoria');

        // OFERTAS
        Route::get('/ofertas', 'HomeController@ofertas')
            ->name('usuario.ofertas');
        Route::get('/tbl_ofertas', 'HomeController@tbl_ofertas')
            ->name('usuario.tbl_ofertas');
        Route::post('/incluirOferta', 'HomeController@incluirOferta')
            ->name('usuario.incluirOferta');
        Route::get('/editarOferta/{id}', 'HomeController@editarOferta')
            ->name('usuario.editarOferta');
        Route::post('/atualizarOferta', 'HomeController@atualizarOferta')
            ->name('usuario.atualizarOferta');
        Route::get('/excluirOferta/{id}', 'HomeController@excluirOferta')
            ->name('usuario.excluirOferta');

        // PRODUTOS
        Route::get('/produtos', 'HomeController@produtos')
            ->name('usuario.produtos');
        Route::get('/tbl_produtos', 'HomeController@tbl_produtos')
            ->name('usuario.tbl_produtos');
        Route::post('/incluirProduto', 'HomeController@incluirProduto')
            ->name('usuario.incluirProduto');
        Route::get('/editarProduto/{id}', 'HomeController@editarProduto')
            ->name('usuario.editarProduto');
        Route::post('/atualizarProduto', 'HomeController@atualizarProduto')
            ->name('usuario.atualizarProduto');
        Route::post('/excluirIconeProduto', 'HomeController@excluirIconeProduto')
            ->name('usuario.excluirIconeProduto');
        Route::post('/excluirFotoProduto', 'HomeController@excluirFotoProduto')
            ->name('usuario.excluirFotoProduto');
        Route::get('/excluirProduto/{id}', 'HomeController@excluirProduto')
            ->name('usuario.excluirProduto');

        // VENDAS
        Route::get('/vendas', 'HomeController@vendas')
            ->name('usuario.vendas');
        Route::get('/tbl_vendas', 'HomeController@tbl_vendas')
            ->name('usuario.tbl_vendas');
        /*Route::post('/incluirVenda', 'HomeController@incluirVenda')
            ->name('usuario.incluirVenda');*/
        Route::get('/editarVenda/{id}', 'HomeController@editarVenda')
            ->name('usuario.editarVenda');
        Route::post('/atualizarVenda', 'HomeController@atualizarVenda')
            ->name('usuario.atualizarVenda');
        /*Route::get('/excluirVenda/{id}', 'HomeController@excluirVenda')
            ->name('usuario.excluirVenda');*/
        /////////////////////////////////////////////////////////////////////////////
    });
});
// FUNCIONALIDADES BASICAS ========================================================================================
/*Route::get('/{url}', 'SiteController@index')
    ->name('site.index');*/
Route::get('/{url}/home/', 'SiteController@index')
    ->name('site.index');
Route::get('/{url}/contato', 'SiteController@contato')
    ->name('site.contato');
Route::get('/{url}/enviaContato', 'SiteController@enviaContato')
    ->name('site.enviaContato');
Route::get('/{url}/eventos', 'SiteController@eventos')
    ->name('site.eventos');
Route::get('/{url}/evento/{id}', 'SiteController@evento')
    ->name('site.evento');
Route::get('/{url}/inscreveEnvento', 'SiteController@inscreveEnvento')
    ->name('site.inscreveEnvento');
Route::get('/{url}/eventosfixos', 'SiteController@eventosfixos')
    ->name('site.eventosfixos');
Route::get('/{url}/eventofixo/{id}', 'SiteController@eventofixo')
    ->name('site.eventofixo');
Route::get('/{url}/noticias', 'SiteController@noticias')
    ->name('site.noticias');
Route::get('/{url}/noticia/{id}', 'SiteController@noticia')
    ->name('site.noticia');
Route::get('/{url}/apresentacao', 'SiteController@apresentacao')
    ->name('site.apresentacao');
Route::get('/{url}/midias', 'SiteController@midias')
    ->name('site.midias');
Route::get('/{url}/midia/{id}', 'SiteController@midia')
    ->name('site.midia');
Route::get('/{url}/galeria','SiteController@galeria')
    ->name('site.galeria');
Route::get('/{url}/publicacao/{id}','SiteController@publicacao')
    ->name('site.publicacao');
Route::get('/{url}/login','SiteController@login')
    ->name('site.login');
Route::get('/carrega_imagem/{largura},{altura},{pasta},{arquivo}','SiteController@carrega_imagem')
    ->name('site.carrega_imagem');
Route::get('/gerar_termo_compromisso/{id}','SiteController@gerar_termo_compromisso')
    ->name('site.gerar_termo_compromisso');
// ================================================================================================================

// CARRINHO =======================================================================================================
Route::get('/{url}/produtos', 'SiteController@produtos')
    ->name('site.produtos');
Route::get('/{url}/produto/{id}', 'SiteController@produto')
    ->name('site.produto');
Route::get('/{url}/filtrarProdutos', 'SiteController@filtrarProdutos')
    ->name('site.filtrarProdutos');
Route::get('/{url}/adicionarProduto', 'SiteController@adicionarProduto')
    ->name('site.adicionarProduto');
Route::get('/{url}/alterarProduto', 'SiteController@alterarProduto')
    ->name('site.alterarProduto');
Route::get('/{url}/removerProduto', 'SiteController@removerProduto')
    ->name('site.removerProduto');
Route::get('/{url}/limparCarrinho', 'SiteController@limparCarrinho')
    ->name('site.limparCarrinho');
Route::get('/{url}/carrinho', 'SiteController@carrinho')
    ->name('site.carrinho');
Route::get('/{url}/finalizarCompra', 'SiteController@finalizarCompra')
    ->name('site.finalizarCompra');
Route::post('/{url}/salvarCompra', 'SiteController@salvarCompra')
    ->name('site.salvarCompra');
Route::get('/{url}/salvarCompra', 'SiteController@salvarCompra')
    ->name('site.salvarCompra');
Route::get('/nota_encomenda/{id}','SiteController@nota_encomenda')
    ->name('site.nota_encomenda');
Route::get('/{url}/cadastro', 'SiteController@cadastro')
    ->name('site.cadastro');
Route::post('/{url}/cadastrar', 'SiteController@cadastrar')
    ->name('site.cadastrar');
// COMPRADOR
Route::get('/{url}/conta', 'SiteController@conta')
    ->name('comprador.conta');
Route::get('/{url}/desativar_conta', 'SiteController@desativar_conta')
    ->name('comprador.desativar_conta');
Route::get('/{url}/alterar_conta', 'SiteController@alterar_conta')
    ->name('comprador.alterar_conta');
Route::get('/{url}/compras', 'SiteController@compras')
    ->name('comprador.compras');
// ================================================================================================================

// API ============================================================================================================
Route::get('/api/noticias/{url}', 'ApiController@noticias')
    ->name('api.noticias');
Route::get('/api/noticia/{url}/{id}', 'ApiController@noticia')
    ->name('api.noticia');
Route::get('/api/banners/{url}', 'ApiController@banners')
    ->name('api.banners');
Route::get('/api/banner/{url}/{id}', 'ApiController@banner')
    ->name('api.banner');
Route::get('/api/apresentacao/{url}', 'ApiController@apresentacao')
    ->name('api.apresentacao');
Route::get('/api/galeria/{url}/{id}', 'ApiController@galeria')
    ->name('api.galeria');
Route::get('/api/galerias/{url}', 'ApiController@galerias')
    ->name('api.galerias');
Route::get('/api/midias/{url}', 'ApiController@midias')
    ->name('api.midias');
Route::get('/api/midia/{url}/{id}', 'ApiController@midia')
    ->name('api.midia');
Route::get('/api/eventos/{url}', 'ApiController@eventos')
    ->name('api.eventos');
Route::get('/api/evento/{url}/{id}', 'ApiController@evento')
    ->name('api.evento');
Route::get('/api/eventosfixos/{url}', 'ApiController@eventosfixos')
    ->name('api.eventosfixos');
Route::get('/api/eventofixo/{url}/{id}', 'ApiController@eventofixo')
    ->name('api.eventofixo');
Route::get('/api/publicacoes/{url}', 'ApiController@publicacoes')
    ->name('api.publicacoes');
Route::get('/api/publicacao/{url}/{id}', 'ApiController@publicacao')
    ->name('api.publicacao');
Route::get('/api/produtos/{url}', 'ApiController@produtos')
    ->name('api.produtos');
Route::post('/api/login/{url}', 'ApiController@login')
    ->name('api.login');
Route::get('/api/sites/', 'ApiController@sites')
    ->name('api.sites');
Route::get('/api/site/{url}', 'ApiController@site')
    ->name('api.site');
// ================================================================================================================