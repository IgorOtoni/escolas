<?php

use App\TblPerfil;
use App\TblIgreja;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

/*
Route::get('admin', function () {
    return view('admin_site.index');
});*/

//Auth::routes();

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\HomeController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::get('/formulario', 'PlataformaController@formulario')->name('plataforma.formulario');
Route::post('/cadastro', 'PlataformaController@cadastro')->name('plataforma.incluirIgreja');

Route::get('/congregacoes', 'PlataformaController@eglise')->name('plataforma.congregacoes');
Route::get('/filtrarIgreja', 'PlataformaController@filtrarIgreja')->name('plataforma.filtrarIgreja');

Route::get('/', 'PlataformaController@index')->name('plataforma.home');
//Route::get('/eglise', 'PlataformaController@eglise')->name('eglise');

// VALIDAÇÃO DE AUTENTICAÇÃO FEITA AQUI: PRIMEIRA A SER EXECUTADA
Route::get('/autenticar', function () {
    if(Auth::user()->status == true){
        // VERIFICAÇÃO BÁSICA 1: PARA AUTENTICAR O USUÁRIO PRECISA ESTAR ATIVO
        if (Auth::user()->id_perfil == null || Auth::user()->id_perfil == 1){
            // SE O USUÁRIO NÃO TÊM UM PERFIL OU ESSE É IGUAL A 1 ELE É UM ADMINISTRADOR
            return redirect()->route('admin.home');
        }else if(Auth::user()->id_perfil != null && Auth::user()->id_perfil != 1){
            // SE O USUÁRIO TÊM UM PERFIL E ESSE É DIFERENTE DE 1 ELE NÃO É UM AMINISTRADOR
            $perfil = TblPerfil::find(Auth::user()->id_perfil);
            if($perfil->status == true){
                // VERIFICAÇÃO BÁSICA 2: PARA AUTENTICAR O PERFIL PRECISA ESTAR ATIVO
                $igreja = TblIgreja::find($perfil->id_igreja);
                if($igreja->status == true){
                    // VERIFICAÇÃO BÁSICA 3: PARA AUTENTICAR A CONGREGAÇÃO PRECISA ESTAR ATIVO
                    return redirect()->route('usuario.home');
                }else{
                    auth()->logout();
                    return redirect('login')->with('message', 'O serviço de sua congregação está inativo.');
                }
            }else{
                auth()->logout();
                return redirect('login')->with('message', 'Seu perfil está desativado.');
            }
        }
        auth()->logout();
        return redirect('login')->with('message', 'Seu perfil não foi encontrado.');
    }else{
        auth()->logout();
        return redirect('login')->with('message', 'Seu usuário está desativado.');
    }
});
Route::get('error', function () {
    return view('error');
});

Route::get('/logout', function () {
    //Session::flush();
    auth()->logout();
    return redirect('login');
});

Route::group(['middleware' => 'auth'], function () {
    /*Route::get('/autenticar', function () {
        if (Auth::user()->id_perfil == 1)
            return redirect()->route('home');
        else if (Auth::user()->id_perfil != 1)
            return redirect()->route('home');
    });*/
    /*Route::get('error', function () {
        return "Sorry, you are unauthorized to access this page.";
    });*/
    //     ROTAS DE ADMINISTRAÇÃO DO SISTEMA
    Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
        Route::get('igrejas', 'TblIgrejaController@index')->name('igrejas');
        Route::get('igrejas/tbl_igrejas', 'TblIgrejaController@tbl_igrejas')->name('igrejas.tbl_igrejas');
        Route::get('igrejas/switchStatus/{id}', 'TblIgrejaController@switchStatus')->name('igrejas.switchStatus');
        Route::get('igrejas/editarIgreja/{id}', 'TblIgrejaController@edit')->name('igrejas.editar');
        Route::post('igrejas/incluir', 'TblIgrejaController@store')->name('igrejas.incluir');
        Route::post('igrejas/atualizar', 'TblIgrejaController@update')->name('igrejas.atualizar');
        Route::post('igrejas/excluirLogo', 'TblIgrejaController@excluirLogo')->name('igrejas.excluirLogo');
        Route::post('igrejas/salvarConfiguracoes', 'TblIgrejaController@salvarConfiguracoes')->name('igrejas.salvarConfiguracoes');
        Route::get('igrejas/carregarModulos/{id}', 'TblIgrejaController@modulos_igreja')->name('igrejas.carregarModulos');
        Route::get('igrejas/configuracoes/{id}', 'TblIgrejaController@configuracoes')->name('igrejas.configuracoes');
        Route::post('igrejas/adicionarMenu', 'TblIgrejaController@adicionarMenu')->name('igrejas.adicionarMenu');
        Route::post('igrejas/editarMenu', 'TblIgrejaController@editarMenu')->name('igrejas.editarMenu');
        Route::get('igrejas/excluirMenu/{id}', 'TblIgrejaController@excluirMenu')->name('igrejas.excluirMenu');
        Route::post('igrejas/adicionarSubMenu', 'TblIgrejaController@adicionarSubMenu')->name('igrejas.adicionarSubMenu');
        Route::post('igrejas/editarSubMenu', 'TblIgrejaController@editarSubMenu')->name('igrejas.editarSubMenu');
        Route::get('igrejas/excluirSubMenu/{id}', 'TblIgrejaController@excluirSubMenu')->name('igrejas.excluirSubMenu');
        Route::post('igrejas/adicionarSubSubMenu', 'TblIgrejaController@adicionarSubSubMenu')->name('igrejas.adicionarSubSubMenu');
        Route::post('igrejas/editarSubSubMenu', 'TblIgrejaController@editarSubSubMenu')->name('igrejas.editarSubSubMenu');
        Route::get('igrejas/excluirSubSubMenu/{id}', 'TblIgrejaController@excluirSubSubMenu')->name('igrejas.excluirSubSubMenu');

        Route::get('perfis', 'TblPerfilController@index')->name('perfis');
        Route::post('perfis/incluir', 'TblPerfilController@store')->name('perfis.incluir');
        Route::get('perfis/editarPerfil/{id}', 'TblPerfilController@edit')->name('perfis.editar');
        Route::post('perfis/atualizar', 'TblPerfilController@update')->name('perfis.atualizar');
        Route::get('perfis/tbl_perfis', 'TblPerfilController@tbl_perfis')->name('perfis.tbl_perfis');
		Route::get('perfis/switchStatus/{id}', 'TblPerfilController@switchStatus')->name('perfis.switchStatus');
        Route::get('perfis/carregarPermissoes/{id}', 'TblPerfilController@carregarPermissoes')->name('perfis.carregarPermissoes');
        Route::post('perfis/carregarPermissoes', 'TblPerfilController@carregarPermissoes')->name('perfis.carregarPermissoes');
        Route::post('perfis/atualizarPermissoes/', 'TblPerfilController@atualizarPermissoes')->name('perfis.atualizarPermissoes');

        Route::get('publicacoes', 'TblPublicacoesController@index')->name('publicacoes');
        Route::post('publicacoes/incluir', 'TblPublicacoesController@store')->name('publicacoes.incluir');

        Route::get('permissoes/json_permissoes', 'TblPermissaoController@json_permissoes')->name('permissoes.json_permissoes');       

        Route::get('usuarios', 'TblUsuariosController@index')->name('usuarios');
        Route::post('usuarios/incluir', 'TblUsuariosController@store')->name('usuarios.incluir');
        Route::get('usuarios/tbl_usuarios', 'TblUsuariosController@tbl_usuarios')->name('usuarios.tbl_usuarios');
        Route::get('usuarios/switchStatus/{id}', 'TblUsuariosController@switchStatus')->name('usuarios.switchStatus');
        Route::get('usuarios/editarUsuario/{id}', 'TblUsuariosController@edit')->name('usuarios.editar');
        Route::post('usuarios/atualizar', 'TblUsuariosController@update')->name('usuarios.atualizar');

        Route::get('usuarios/conta', 'TblUsuariosController@autoEdit')->name('account');
        Route::post('usuarios/atualizarConta', 'TblUsuariosController@autoUpdate')->name('account.atualizar');

        //Route::get('/', 'HomeController@index')->name('admin.index');
        Route::get('/home', 'HomeController@index')->name('admin.home');
    });
    Route::group(['prefix' => 'usuario', 'middleware' => 'usuario'], function () {
        //Route::get('/', 'HomeController@index')->name('usuario.index');
        Route::get('/home', 'HomeController@index')->name('usuario.home');

        // FUNÇÕES ===============================================================================
        Route::get('/carregarModulosIgreja/{id}', 'HomeController@modulos_igreja')->name('usuario.carregarModulosIgreja');
        //////////////////////////////////////////////////////////////////////////////////////////

        Route::get('/doacoes', 'HomeController@index')->name('usuario.doacoes');

        // CRUD BANNERS ==========================================================================
        Route::get('/banners', 'HomeController@banners')->name('usuario.banners');
        Route::get('/tbl_banners', 'HomeController@tbl_banners')->name('usuario.tbl_banners');
        Route::post('/incluirBanner', 'HomeController@incluirBanner')->name('usuario.incluirBanner');
        Route::get('/editarBanner/{id}', 'HomeController@editarBanner')->name('usuario.editarBanner');
        Route::post('/atualizarBanner', 'HomeController@atualizarBanner')->name('usuario.atualizarBanner');
        Route::post('/excluirFotoBanner', 'HomeController@excluirFotoBanner')->name('usuario.excluirFotoBanner');
        Route::get('/excluirBanner/{id}', 'HomeController@excluirBanner')->name('usuario.excluirBanner');
        //////////////////////////////////////////////////////////////////////////////////////////

        // CRUD GALERIAS ==========================================================================
        Route::get('/galerias', 'HomeController@galerias')->name('usuario.galerias');
        Route::get('/tbl_galerias', 'HomeController@tbl_galerias')->name('usuario.tbl_galerias');
        Route::post('/incluirGaleria', 'HomeController@incluirGaleria')->name('usuario.incluirGaleria');
        Route::get('/editarGaleria/{id}', 'HomeController@editarGaleria')->name('usuario.editarGaleria');
        Route::post('/atualizarGaleria', 'HomeController@atualizarGaleria')->name('usuario.atualizarGaleria');
        Route::post('/excluirFotoGaleria', 'HomeController@excluirFotoGaleria')->name('usuario.excluirFotoGaleria');
        Route::get('/excluirGaleria/{id}', 'HomeController@excluirGaleria')->name('usuario.excluirGaleria');
        //////////////////////////////////////////////////////////////////////////////////////////

        // CRUD EVENTOS FIXOS ==========================================================================
        Route::get('/eventosfixos', 'HomeController@eventosfixos')->name('usuario.eventosfixos');
        Route::get('/tbl_eventosfixos', 'HomeController@tbl_eventosfixos')->name('usuario.tbl_eventosfixos');
        Route::post('/incluirEventoFixo', 'HomeController@incluirEventoFixo')->name('usuario.incluirEventoFixo');
        Route::get('/editarEventoFixo/{id}', 'HomeController@editarEventoFixo')->name('usuario.editarEventoFixo');
        Route::post('/atualizarEventoFixo', 'HomeController@atualizarEventoFixo')->name('usuario.atualizarEventoFixo');
        Route::post('/excluirFotoEventoFixo', 'HomeController@excluirFotoEventoFixo')->name('usuario.excluirFotoEventoFixo');
        Route::get('/excluirEventoFixo/{id}', 'HomeController@excluirEventoFixo')->name('usuario.excluirEventoFixo');
        //////////////////////////////////////////////////////////////////////////////////////////

        // CRUD NOTICIAS ==========================================================================
        Route::get('/noticias', 'HomeController@noticias')->name('usuario.noticias');
        Route::get('/tbl_noticias', 'HomeController@tbl_noticias')->name('usuario.tbl_noticias');
        Route::post('/incluirNoticia', 'HomeController@incluirNoticia')->name('usuario.incluirNoticia');
        Route::get('/editarNoticia/{id}', 'HomeController@editarNoticia')->name('usuario.editarNoticia');
        Route::post('/atualizarNoticia', 'HomeController@atualizarNoticia')->name('usuario.atualizarNoticia');
        Route::post('/excluirFotoNoticia', 'HomeController@excluirFotoNoticia')->name('usuario.excluirFotoNoticia');
        Route::get('/excluirNoticia/{id}', 'HomeController@excluirNoticia')->name('usuario.excluirNoticia');
        //////////////////////////////////////////////////////////////////////////////////////////

        // CONFIGURACOES SITE ==========================================================================
        Route::get('/configuracoes', 'HomeController@configuracoes')->name('usuario.configuracoes');
        Route::post('/salvarConfiguracoes', 'HomeController@salvarConfiguracoes')->name('usuario.salvarConfiguracoes');        
        Route::post('/excluirLogo', 'HomeController@excluirLogo')->name('usuario.excluirLogo');
        Route::post('/adicionarMenu', 'HomeController@adicionarMenu')->name('usuario.adicionarMenu');
        Route::post('/editarMenu', 'HomeController@editarMenu')->name('usuario.editarMenu');
        Route::get('/excluirMenu/{id}', 'HomeController@excluirMenu')->name('usuario.excluirMenu');
        Route::post('/adicionarSubMenu', 'HomeController@adicionarSubMenu')->name('usuario.adicionarSubMenu');
        Route::post('/editarSubMenu', 'HomeController@editarSubMenu')->name('usuario.editarSubMenu');
        Route::get('/excluirSubMenu/{id}', 'HomeController@excluirSubMenu')->name('usuario.excluirSubMenu');
        Route::post('/adicionarSubSubMenu', 'HomeController@adicionarSubSubMenu')->name('usuario.adicionarSubSubMenu');
        Route::post('/editarSubSubMenu', 'HomeController@editarSubSubMenu')->name('usuario.editarSubSubMenu');
        Route::get('/excluirSubSubMenu/{id}', 'HomeController@excluirSubSubMenu')->name('usuario.excluirSubSubMenu');
        //////////////////////////////////////////////////////////////////////////////////////////

        // CRUD SERMOES ==========================================================================
        Route::get('/sermoes', 'HomeController@sermoes')->name('usuario.sermoes');
        Route::get('/tbl_sermoes', 'HomeController@tbl_sermoes')->name('usuario.tbl_sermoes');
        Route::post('/incluirSermao', 'HomeController@incluirSermao')->name('usuario.incluirSermao');
        Route::get('/editarSermao/{id}', 'HomeController@editarSermao')->name('usuario.editarSermao');
        Route::post('/atualizarSermao', 'HomeController@atualizarSermao')->name('usuario.atualizarSermao');
        Route::get('/excluirSermao/{id}', 'HomeController@excluirSermao')->name('usuario.excluirSermao');
        //////////////////////////////////////////////////////////////////////////////////////////

        // CRUD EVENTOS ==========================================================================
        Route::get('/eventos', 'HomeController@eventos')->name('usuario.eventos');
        Route::get('/tbl_eventos', 'HomeController@tbl_eventos')->name('usuario.tbl_eventos');
        Route::post('/incluirEvento', 'HomeController@incluirEvento')->name('usuario.incluirEvento');
        Route::get('/editarEvento/{id}', 'HomeController@editarEvento')->name('usuario.editarEvento');
        Route::post('/atualizarEvento', 'HomeController@atualizarEvento')->name('usuario.atualizarEvento');
        Route::post('/excluirFotoEvento', 'HomeController@excluirFotoEvento')->name('usuario.excluirFotoEvento');
        Route::get('/excluirEvento/{id}', 'HomeController@excluirEvento')->name('usuario.excluirEvento');
        Route::post('/atualizarInscricoes', 'HomeController@atualizarInscricoes')->name('usuario.atualizarInscricoes');
        //////////////////////////////////////////////////////////////////////////////////////////

        // CRUD PUBLICAÇÕES ======================================================================
        Route::get('/publicacoes', 'HomeController@publicacoes')->name('usuario.publicacoes');
        Route::get('/tbl_publicacoes', 'HomeController@tbl_publicacoes')->name('usuario.tbl_publicacoes');
        Route::post('/incluirPublicacao', 'HomeController@incluirPublicacao')->name('usuario.incluirPublicacao');
        Route::get('/editarPublicacao/{id}', 'HomeController@editarPublicacao')->name('usuario.editarPublicacao');
        Route::post('/atualizarPublicacao', 'HomeController@atualizarPublicacao')->name('usuario.atualizarPublicacao');
        Route::post('/excluirFotoPublicacao', 'HomeController@excluirFotoPublicacao')->name('usuario.excluirFotoPublicacao');
        Route::get('/excluirPublicacao/{id}', 'HomeController@excluirPublicacao')->name('usuario.excluirPublicacao');
        //////////////////////////////////////////////////////////////////////////////////////////
    
        // ALTERAR CONTA =========================================================================
        Route::get('usuarios/conta', 'HomeController@conta')->name('account');
        Route::post('usuarios/atualizarConta', 'HomeController@atualizarConta')->name('account.atualizar');
        //////////////////////////////////////////////////////////////////////////////////////////

        // CRUD USUARIOS ==========================================================================
        Route::get('/usuarios', 'HomeController@usuarios')->name('usuario.usuarios');
        Route::get('/tbl_usuarios', 'HomeController@tbl_usuarios')->name('usuario.tbl_usuarios');
        Route::post('/incluirUsuario', 'HomeController@incluirUsuario')->name('usuario.incluirUsuario');
        Route::get('/editarUsuario/{id}', 'HomeController@editarUsuario')->name('usuario.editarUsuario');
        Route::post('/atualizarUsuario', 'HomeController@atualizarUsuario')->name('usuario.atualizarUsuario');
        //Route::get('/excluirUsuario/{id}', 'HomeController@excluirUsuario')->name('usuario.excluirUsuario');
        Route::get('/switchStatusUsuario/{id}', 'HomeController@switchStatusUsuario')->name('usuario.switchStatusUsuario');
        //////////////////////////////////////////////////////////////////////////////////////////

        // CRUD PERFIS ==========================================================================
        Route::get('/perfis', 'HomeController@perfis')->name('usuario.perfis');
        Route::get('/tbl_perfis', 'HomeController@tbl_perfis')->name('usuario.tbl_perfis');
        Route::post('/incluirPerfil', 'HomeController@incluirPerfil')->name('usuario.incluirPerfil');
        Route::get('/editarPerfil/{id}', 'HomeController@editarPerfil')->name('usuario.editarPerfil');
        Route::post('/atualizarPerfil', 'HomeController@atualizarPerfil')->name('usuario.atualizarPerfil');
        //Route::get('/excluirPerfil/{id}', 'HomeController@excluirPerfil')->name('usuario.excluirPerfil');
        Route::get('/switchStatusPerfil/{id}', 'HomeController@switchStatusPerfil')->name('usuario.switchStatusPerfil');
        Route::get('/carregarPermissoesPerfil/{id}', 'HomeController@carregarPermissoesPerfil')->name('perfis.carregarPermissoesPerfil');
        Route::post('/atualizarPermissoesPerfil', 'HomeController@atualizarPermissoesPerfil')->name('usuario.atualizarPermissoesPerfil');
        //////////////////////////////////////////////////////////////////////////////////////////

        // CRUD FUNCOES ==========================================================================
        Route::get('/funcoes', 'HomeController@funcoes')->name('usuario.funcoes');
        Route::get('/tbl_funcoes', 'HomeController@tbl_funcoes')->name('usuario.tbl_funcoes');
        Route::post('/incluirFuncao', 'HomeController@incluirFuncao')->name('usuario.incluirFuncao');
        Route::get('/editarFuncao/{id}', 'HomeController@editarFuncao')->name('usuario.editarFuncao');
        Route::post('/atualizarFuncao', 'HomeController@atualizarFuncao')->name('usuario.atualizarFuncao');
        Route::get('/excluirFuncao/{id}', 'HomeController@excluirFuncao')->name('usuario.excluirFuncao');
        //////////////////////////////////////////////////////////////////////////////////////////

        // CRUD MEMBROS ==========================================================================
        Route::get('/membros', 'HomeController@membros')->name('usuario.membros');
        Route::get('/tbl_membros', 'HomeController@tbl_membros')->name('usuario.tbl_membros');
        Route::post('/incluirMembro', 'HomeController@incluirMembro')->name('usuario.incluirMembro');
        Route::get('/editarMembro/{id}', 'HomeController@editarMembro')->name('usuario.editarMembro');
        Route::post('/atualizarMembro', 'HomeController@atualizarMembro')->name('usuario.atualizarMembro');
        Route::post('/excluirFotoMembro', 'HomeController@excluirFotoMembro')->name('usuario.excluirFotoMembro');
        Route::get('/excluirMembro/{id}', 'HomeController@excluirMembro')->name('usuario.excluirMembro');
        Route::get('/switchStatusMembro/{id}', 'HomeController@switchStatusMembro')->name('usuario.switchStatusMembro');
        //////////////////////////////////////////////////////////////////////////////////////////
    });
});

Route::get('/{url}', 'IgrejaController@index')->name('igreja.index');
Route::get('/{url}/home/', 'IgrejaController@index')->name('igreja.index');
Route::get('/{url}/contato', 'IgrejaController@contato')->name('igreja.contato');
Route::get('/{url}/enviaContato', 'IgrejaController@enviaContato')->name('igreja.enviaContato');
Route::get('/{url}/eventos', 'IgrejaController@eventos')->name('igreja.eventos');
Route::get('/{url}/evento/{id}', 'IgrejaController@evento')->name('igreja.evento');
Route::get('/{url}/inscreveEnvento', 'IgrejaController@inscreveEnvento')->name('igreja.inscreveEnvento');
Route::get('/{url}/eventosfixos', 'IgrejaController@eventosfixos')->name('igreja.eventosfixos');
Route::get('/{url}/eventofixo/{id}', 'IgrejaController@eventofixo')->name('igreja.eventofixo');
Route::get('/{url}/noticias', 'IgrejaController@noticias')->name('igreja.noticias');
Route::get('/{url}/noticia/{id}', 'IgrejaController@noticia')->name('igreja.noticia');
Route::get('/{url}/apresentacao', 'IgrejaController@apresentacao')->name('igreja.apresentacao');
Route::get('/{url}/sermoes', 'IgrejaController@sermoes')->name('igreja.sermoes');
Route::get('/{url}/sermao/{id}', 'IgrejaController@sermao')->name('igreja.sermao');
Route::get('/{url}/galeria','IgrejaController@galeria')->name('igreja.galeria');
Route::get('/{url}/publicacao/{id}','IgrejaController@publicacao')->name('igreja.publicacao');
Route::get('/{url}/login','IgrejaController@login')->name('igreja.login');
Route::get('/carrega_imagem/{largura},{altura},{pasta},{arquivo}','IgrejaController@carrega_imagem')->name('igreja.carrega_imagem');
Route::get('/gerar_termo_compromisso/{id}','IgrejaController@gerar_termo_compromisso')->name('igreja.gerar_termo_compromisso');