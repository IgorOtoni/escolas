<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TblIgreja;
use App\TblIgrejasModulos;
use App\TblModulo;
use App\TblConfiguracoes;
use App\TblMenu;
use App\TblSubMenu;
use App\TblSubSubMenu;
use App\TblPerfil;
use App\TblPerfisIgrejasModulos;
use App\User;
use App\Mail\SendMailuser;

class PlataformaController extends Controller
{
    public function index(){
        return view('eglise.index');
    }

    public function eglise()
    {
        $igrejas_e_configuracoes = \DB::table('tbl_igrejas')->leftJoin('tbl_configuracoes','tbl_igrejas.id','=','tbl_configuracoes.id_igreja')->paginate(6);
        return view('eglise.igrejas', compact('igrejas_e_configuracoes'));
    }

    public function filtrarIgreja(Request $request)
    {
        $igrejas_e_configuracoes = \DB::table('tbl_igrejas')->where('tbl_igrejas.nome','like', '%'.$request->nome.'%')->leftJoin('tbl_configuracoes','tbl_igrejas.id','=','tbl_configuracoes.id_igreja')->paginate(6);
        return view('eglise.igrejas', compact('igrejas_e_configuracoes'));
    }

    public function formulario(){
        return view('eglise.formulario');
    }

    public function cadastro(Request $request){
        $igreja = new TblIgreja();
        $igreja->nome = fistCharFromWord_toUpper($request->nome);
        $igreja->cnpj = $request->cnpj;
        $igreja->cep = $request->cep;
        $igreja->num = $request->num;
        $igreja->rua = $request->rua;
        $igreja->cidade = $request->cidade;
        $igreja->complemento = $request->complemento;
        $igreja->bairro = $request->bairro;
        $igreja->estado = $request->estado;
        $igreja->telefone = $request->telefone;
        $igreja->logo = file_get_contents($request->file($logo));
        $igreja->email = $request->email;
        $igreja->status = true;
        
        $count = TblIgreja::where("nome", "=", $igreja->nome)->count();
        $count_ = TblConfiguracoes::where("url", "=", $request->url)->count();
        if($count == 0){
            if($count_ == 0){
                $igreja->save();

                $igreja_modulos = null;
                $igreja_modulos_g = null;

                $modulos = TblModulo::all();

                $x = 0;
                foreach ($modulos as $modulo) {
                    $igreja_modulo = new TblIgrejasModulos();
                    $igreja_modulo->id_igreja = $igreja->id;
                    $igreja_modulo->id_modulo = $modulo->id;
                    if($modulo->gerencial){
                        switch($modulo->id){
                            case 13:
                                $igreja_modulo->icone = "fa fa-child";
                                break;
                            case 14:
                                $igreja_modulo->icone = "fa fa-users";
                                break;
                            case 15:
                                $igreja_modulo->icone = "fa fa-file-image-o";
                                break;
                            case 16:
                                $igreja_modulo->icone = "fa fa-calendar";
                                break;
                            case 17:
                                $igreja_modulo->icone = "fa fa-clock-o";
                                break;
                            case 18:
                                $igreja_modulo->icone = "fa fa-newspaper-o";
                                break;
                                case 19:
                                $igreja_modulo->icone = "fa fa-play";
                                break;
                            case 20:
                                $igreja_modulo->icone = "fa fa-microphone";
                                break;
                            case 21:
                                $igreja_modulo->icone = "fa fa-thumbs-o-up";
                                break;
                            case 22:
                                $igreja_modulo->icone = "fa fa-cogs";
                                break;
                            case 24:
                                $igreja_modulo->icone = "fa fa-tags";
                                break;
                            case 25:
                                $igreja_modulo->icone = "fa fa-user-plus";
                                break;
                            case 27:
                                $igreja_modulo->icone = "fa fa-cart-plus";
                                break;
                        }
                    }
                    $igreja_modulo->save();
                    $igreja_modulos[$x] = $igreja_modulo;
                    if($modulo->gerencial) $igreja_modulos_g[$x] = $igreja_modulo;
                    $x++;
                }

                $configuracao = new TblConfiguracoes();
                $configuracao->id_igreja = $igreja->id;
                $configuracao->url = $request->url;
                $configuracao->cor = 'black';
                $configuracao->id_template = $request->template;
                $configuracao->save();

                // Configuração dos menus ====================================================
                $menu = new TblMenu();
                $menu->id_configuracao = $configuracao->id;
                $menu->nome = "Eduno";
                $menu->link = "http://www.eduno.com.br/";
                $menu->ordem = 1;
                $menu->save();

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
                $submenu->link = "sermoes";
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
                $perfil->descricao = "Perfil dos administradores da escola.";
                $perfil->id_igreja = $igreja->id;
                $perfil->status = true;
                $perfil->save();

                $PerfisIgrejaModulos_ = null;
                $x = 0;
                foreach($igreja_modulos_g as $igreja_modulo){
                    $PerfisIgrejaModulos = new TblPerfisIgrejasModulos();
                    $PerfisIgrejaModulos->id_perfil = $perfil->id;
                    $PerfisIgrejaModulos->id_modulo_igreja = $igreja_modulo->id;
                    $PerfisIgrejaModulos->save();
                    $PerfisIgrejaModulos_[$x] = $PerfisIgrejaModulos;
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

                /*\Mail::to($igreja->email)
                    ->send(new SendMailUser($usuario->nome, "administrador"));*/

                $notification = array(
                    'message' => 'Bem vindo(a)! Seu site e usuário já estão configurados.', 
                    'alert-type' => 'success'
                );

                return redirect($configuracao->url)->with($notification);
            }else{
                $notification = array(
                    'message' => 'Já existe uma escola com essa URL, por favor escolha outra URL.', 
                    'alert-type' => 'error'
                );
    
                return back()->with($notification);
            }
        }else{

            $notification = array(
                'message' => 'Já existe uma escola com esse nome, por favor escolha outro nome.', 
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
                        $igreja = TblIgreja::find($perfil->id_igreja);
                        if($igreja->status == true){
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
