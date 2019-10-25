<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TblSites;
use App\TblSitesModulos;
use App\TblModulo;
use App\TblConfiguracoes;
use App\TblMenu;
use App\TblSubMenu;
use App\TblSubSubMenu;
use App\TblPerfil;
use App\TblPerfisSitesModulos;
use App\User;
use App\Mail\SendMailuser;

class PlataformaController extends Controller
{
    public function index(){
        return view('gratunos.index');
    }

    public function gratunos()
    {
        $sites_e_configuracoes = \DB::table('tbl_sites')->leftJoin('tbl_configuracoes','tbl_sites.id','=','tbl_configuracoes.id_site')->paginate(6);
        return view('gratunos.sites', compact('sites_e_configuracoes'));
    }

    public function filtrarSite(Request $request)
    {
        $sites_e_configuracoes = \DB::table('tbl_sites')->where('tbl_sites.nome','like', '%'.$request->nome.'%')->leftJoin('tbl_configuracoes','tbl_sites.id','=','tbl_configuracoes.id_site')->paginate(6);
        return view('gratunos.sites', compact('sites_e_configuracoes'));
    }

    public function formulario(){
        return view('gratunos.formulario');
    }

    public function cadastro(Request $request){
        $site = new TblSites();
        $site->nome = fistCharFromWord_toUpper($request->nome);
        $site->cnpj = $request->cnpj;
        $site->cep = $request->cep;
        $site->num = $request->num;
        $site->rua = $request->rua;
        $site->cidade = $request->cidade;
        $site->complemento = $request->complemento;
        $site->bairro = $request->bairro;
        $site->estado = $request->estado;
        $site->telefone = $request->telefone;
        $site->logo = file_get_contents($request->file('logo'));
        $site->email = $request->email;
        $site->status = true;
        
        $count = TblSites::where("nome", "=", $site->nome)->count();
        $count_ = TblConfiguracoes::where("url", "=", $request->url)->count();
        if($count == 0){
            if($count_ == 0){
                $site->save();

                $site_modulos = null;
                $site_modulos_g = null;

                $modulos = TblModulo::all();

                $x = 0;
                foreach ($modulos as $modulo) {
                    $site_modulo = new TblSitesModulos();
                    $site_modulo->id_site = $site->id;
                    $site_modulo->id_modulo = $modulo->id;
                    if($modulo->gerencial){
                        switch($modulo->id){
                            case 13:
                                $site_modulo->icone = "fa fa-user-plus";
                                break;
                            case 14:
                                $site_modulo->icone = "fa fa-user";
                                break;
                            case 15:
                                $site_modulo->icone = "fa fa-file-image-o";
                                break;
                            case 16:
                                $site_modulo->icone = "fa fa-calendar";
                                break;
                            case 17:
                                $site_modulo->icone = "fa fa-clock-o";
                                break;
                            case 18:
                                $site_modulo->icone = "fa fa-newspaper-o";
                                break;
                                case 19:
                                $site_modulo->icone = "fa fa-play";
                                break;
                            case 20:
                                $site_modulo->icone = "fa fa-microphone";
                                break;
                            case 21:
                                $site_modulo->icone = "fa fa-thumbs-o-up";
                                break;
                            case 22:
                                $site_modulo->icone = "fa fa-cogs";
                                break;
                            case 24:
                                $site_modulo->icone = "fa fa-tags";
                                break;
                            case 25:
                                $site_modulo->icone = "fa fa-child";
                            case 26:
                                $site_modulo->icone = "fa fa-users";
                                break;
                            case 27:
                                $site_modulo->icone = "fa fa-cart-plus";
                                break;
                        }
                    }
                    $site_modulo->save();
                    $site_modulos[$x] = $site_modulo;
                    if($modulo->gerencial) $site_modulos_g[$x] = $site_modulo;
                    $x++;
                }

                $configuracao = new TblConfiguracoes();
                $configuracao->id_site = $site->id;
                $configuracao->url = $request->url;
                $configuracao->cor = 'black';
                $configuracao->id_template = $request->template;
                $configuracao->save();

                // Configuração dos menus ====================================================
                /*$menu = new TblMenu();
                $menu->id_configuracao = $configuracao->id;
                $menu->nome = "Eduno";
                $menu->link = "http://www.eduno.com.br/";
                $menu->ordem = 1;
                $menu->save();*/

                $menu = new TblMenu();
                $menu->id_configuracao = $configuracao->id;
                $menu->nome = "Administrativo";
                $menu->link = "login";
                $menu->ordem = 2;
                $menu->save();

                $menu = new TblMenu();
                $menu->id_configuracao = $configuracao->id;
                $menu->nome = "Sobre nós";
                $menu->ordem = 3;
                $menu->save();

                $submenu = new TblSubMenu();
                $submenu->id_menu = $menu->id;
                $submenu->nome = "Visões e Valores";
                $submenu->ordem = 1;
                $submenu->link = "apresentacao";
                $submenu->save();

                $submenu = new TblSubMenu();
                $submenu->id_menu = $menu->id;
                $submenu->nome = "Contatos";
                $submenu->ordem = 2;
                $submenu->link = "contato";
                $submenu->save();

                $menu = new TblMenu();
                $menu->id_configuracao = $configuracao->id;
                $menu->nome = "Mídia";
                $menu->ordem = 4;
                $menu->save();

                $submenu = new TblSubMenu();
                $submenu->id_menu = $menu->id;
                $submenu->nome = "Vídeos";
                $submenu->ordem = 1;
                $submenu->link = "midias";
                $submenu->save();

                $submenu = new TblSubMenu();
                $submenu->id_menu = $menu->id;
                $submenu->nome = "Galerias";
                $submenu->ordem = 2;
                $submenu->link = "galeria";
                $submenu->save();

                $submenu = new TblSubMenu();
                $submenu->id_menu = $menu->id;
                $submenu->nome = "Notícias";
                $submenu->ordem = 3;
                $submenu->link = "noticias";
                $submenu->save();

                $menu = new TblMenu();
                $menu->id_configuracao = $configuracao->id;
                $menu->nome = "Eventos";
                $menu->ordem = 5;
                $menu->save();

                $submenu = new TblSubMenu();
                $submenu->id_menu = $menu->id;
                $submenu->nome = "Eventos fixos";
                $submenu->ordem = 1;
                $submenu->link = "eventosfixos";
                $submenu->save();

                $submenu = new TblSubMenu();
                $submenu->id_menu = $menu->id;
                $submenu->nome = "Linha do tempo";
                $submenu->ordem = 2;
                $submenu->link = "eventos";
                $submenu->save();

                $menu = new TblMenu();
                $menu->id_configuracao = $configuracao->id;
                $menu->nome = "Produtos";
                $menu->link = "produtos";
                $menu->ordem = 6;
                $menu->save();

                $perfil = new TblPerfil();
                $perfil->nome = "Administrador";
                $perfil->descricao = "Perfil dos administradores da site.";
                $perfil->id_site = $site->id;
                $perfil->status = true;
                $perfil->save();

                $PerfisSitesModulos_ = null;
                $x = 0;
                foreach($site_modulos_g as $site_modulo){
                    $PerfisSitesModulos = new TblPerfisSitesModulos();
                    $PerfisSitesModulos->id_perfil = $perfil->id;
                    $PerfisSitesModulos->id_modulo_site = $site_modulo->id;
                    $PerfisSitesModulos->save();
                    $PerfisSitesModulos_[$x] = $PerfisSitesModulos;
                    $x++;
                }

                $genererated_id = mt_rand(1, 9999);

                $usuario = new User();
                $usuario->nome = "Administrador_" . $genererated_id;
                $usuario->password = bcrypt("administrador");
                $usuario->email = "administrador_" . $genererated_id . "@teste.com";
                $usuario->id_perfil = $perfil->id;
                $usuario->status = true;
                $usuario->save();
                // ===========================================================================

                /*\Mail::to($site->email)
                    ->send(new SendMailUser($usuario->nome, "administrador"));*/

                $notification = array(
                    'message' => 'Bem vindo(a)! Seu site e usuário já estão configurados.', 
                    'alert-type' => 'success'
                );

                return redirect(route('site.index',['url'=>$configuracao->url]))->with($notification);
            }else{
                $notification = array(
                    'message' => 'Já existe uma site com essa URL, por favor escolha outra URL.', 
                    'alert-type' => 'error'
                );
    
                return back()->with($notification);
            }
        }else{

            $notification = array(
                'message' => 'Já existe uma site com esse nome, por favor escolha outro nome.', 
                'alert-type' => 'error'
            );

            return back()->with($notification);

        }
    }

    public function login(){
        return view('auth.login');
    }

    public function autenticar($url = null, Request $request){
        $user = User::where('email','=',$request->email)->get();
        if($user != null && sizeof($user) == 1){
          $user = $user[0];

          if (\Hash::check($request->password, $user->password)){

            \Auth::login($user);

            $notification = array(
                'message' => 'Bem vindo '.$user->nome.'!',
                'alert-type' => 'success'
            );

            if(\Auth::user()->status == true){
                // VERIFICAÇÃO BÁSICA 1: PARA AUTENTICAR O USUÁRIO PRECISA ESTAR ATIVO
                if (\Auth::user()->id_perfil == null || \Auth::user()->id_perfil == 1){
                    // SE O USUÁRIO NÃO TÊM UM PERFIL OU ESSE É IGUAL A 1 ELE É UM ADMINISTRADOR
                    return redirect()->route('admin.home')->with($notification);
                }else if (\Auth::user()->id_perfil == 100){
                    // SE O USUÁRIO TÊM UM PERFIL E ESSE É IGUAL A 100 ELE É UM COMPRADOR
                    return redirect()->back()->with($notification);
                }else if(\Auth::user()->id_perfil != null && \Auth::user()->id_perfil != 1){
                    // SE O USUÁRIO TÊM UM PERFIL E ESSE É DIFERENTE DE 1 ELE NÃO É UM AMINISTRADOR
                    $perfil = TblPerfil::find(\Auth::user()->id_perfil);
                    if($perfil->status == true){
                        // VERIFICAÇÃO BÁSICA 2: PARA AUTENTICAR O PERFIL PRECISA ESTAR ATIVO
                        $site = TblSites::find($perfil->id_site);
                        if($site->status == true){
                            // VERIFICAÇÃO BÁSICA 3: PARA AUTENTICAR A CONGREGAÇÃO PRECISA ESTAR ATIVO
                            return redirect()->route('usuario.home')->with($notification);
                        }else{
                            auth()->logout();

                            $notification = array(
                                'message' => 'O serviço desse site está inativo.',
                                'alert-type' => 'error'
                            );

                            return back()->with($notification);
                        }
                    }else{
                        auth()->logout();

                        $notification = array(
                            'message' => 'Seu perfil está desativado.',
                            'alert-type' => 'error'
                        );

                        return back()->with($notification);
                    }
                }
                auth()->logout();

                $notification = array(
                    'message' => 'Seu perfil não foi encontrado.',
                    'alert-type' => 'error'
                );

                return back()->with($notification);
            }else{
                auth()->logout();

                $notification = array(
                    'message' => 'Dados inválidos.',
                    'alert-type' => 'error'
                );

                return back()->with($notification);
            }

          }else{

            $notification = array(
                'message' => 'Dados inválidos.',
                'alert-type' => 'error'
            );

            return back()->with($notification);
          }
        }else{

          $notification = array(
              'message' => 'Dados inválidos.',
              'alert-type' => 'error'
          );

          return back()->with($notification);
        }
    }
}
