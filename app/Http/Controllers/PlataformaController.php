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
    public function index(Request $request){
      $app_domain = env("APP_URL");
      if($request->url() != $app_domain){
        return redirect()->route('igreja.index');
      }
        return view('eglise.index');
    }

    public function eglise()
    {
        //$igrejas = TblIgreja::all();
        $igrejas_e_configuracoes = \DB::table('tbl_igrejas')->leftJoin('tbl_configuracoes','tbl_igrejas.id','=','tbl_configuracoes.id_igreja')->paginate(6);
        //dd($igrejas_e_configuracoes);
        return view('eglise.igrejas', compact('igrejas_e_configuracoes'));
    }

    public function filtrarIgreja(Request $request)
    {
        //$igrejas = TblIgreja::all();
        $igrejas_e_configuracoes = \DB::table('tbl_igrejas')->where('tbl_igrejas.nome','like', '%'.$request->nome.'%')->leftJoin('tbl_configuracoes','tbl_igrejas.id','=','tbl_configuracoes.id_igreja')->paginate(6);
        //dd($igrejas_e_configuracoes);
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
        $igreja->email = $request->email;
        $igreja->logo = "vazio";

        $count = TblIgreja::where("nome", "=", $igreja->nome)->count();
        $count_ = TblConfiguracoes::where("url", "=", $request->url)->count();
        if($count == 0){
            if($count_ == 0){
                $igreja->save();

                //convertendo imagem base64
                $img = $request->logo;

                \Image::make($request->logo)->save(public_path('storage/igrejas/').'logo-igreja-'.$igreja->id.'.'.strtolower($request->logo->getClientOriginalExtension()),90);

                $igreja->logo = 'logo-igreja-'.$igreja->id.'.'.strtolower($request->logo->getClientOriginalExtension());

                $igreja->status = true;
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
                $configuracao->cor = 'white';
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

                \Mail::to($igreja->email)
                    ->send(new SendMailUser($usuario->nome, "administrador"));

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
}
