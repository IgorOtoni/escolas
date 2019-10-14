<?php

namespace App\Http\Controllers;

use Image;
use DataTables;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\TblPerfil;
use App\TblFuncoes;
use App\TblMembros;
use App\TblBanner;
use App\TblModulo;
use App\TblGalerias;
use App\TblFotos;
use App\TblEventosFixos;
use App\TblEventos;
use App\TblInscricoes;
use App\TblNoticias;
use App\TblMenu;
use App\TblSubMenu;
use App\TblSubSubMenu;
use App\TblConfiguracoes;
use App\TblSermoes;
use App\TblPublicacaoFotos;
use App\TblPublicacoes;
use App\TblComunidades;
use App\TblMembrosComunidades;
use App\TblReunioes;
use App\User;
use App\TblPerfisIgrejasModulos;
use App\TblIgreja;
use App\TblIgrejasModulos;
use App\TblPerfisPermissoes;
use App\TblFrequencias;
use App\TblCategoriasProdutos;
use App\TblOfertasProdutos;
use App\TblProdutos;
use App\TblProdutosFotos;
use App\TblVendas;
use App\TblTiposVendas;
use App\TblVendasProdutos;
use App\TblTurnosEntregas;
use App\TblSituacoesEntregas;
use App\TblMenusAndroid;
use Carbon\Carbon;
use Calendar;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(\Auth::user()->id_perfil == null || \Auth::user()->id_perfil == 1){
            $x = 0;

            $qtd_congregacoes = TblIgreja::all()->count();

            $usuarios_ativos = User::where('status','=',1)->get();

            $qtd_usuarios = sizeof($usuarios_ativos);

            $qtd_usuarios_on = 0;

            foreach($usuarios_ativos as $usuario){
                if($usuario->isOnline()) $qtd_usuarios_on++;
            }

            $quadros[$x]['info'] = $qtd_usuarios_on;
            $quadros[$x]['title'] = 'Total de usuários online';
            $quadros[$x]['icon'] = 'fa-users';
            $quadros[$x]['color'] = 'green';
            $quadros[$x]['link'] = 'usuarios';
            $x++;

            $quadros[$x]['info'] = $qtd_congregacoes;
            $quadros[$x]['title'] = 'Total de sites';
            $quadros[$x]['icon'] = 'fa-university';
            $quadros[$x]['color'] = 'green';
            $quadros[$x]['link'] = 'igrejas';
            $x++;

            $quadros[$x]['info'] = $qtd_usuarios;
            $quadros[$x]['title'] = 'Total de usuários ativos';
            $quadros[$x]['icon'] = 'fa-child';
            $quadros[$x]['color'] = 'green';
            $quadros[$x]['link'] = 'usuarios';
            $x++;

            return view('home', compact('quadros'));
        }else{
            $perfil = TblPerfil::find(\Auth::user()->id_perfil);
            $igreja = obter_dados_igreja_id($perfil->id_igreja);

            $compras = TblVendas::where('id_igreja','=',$igreja->id)
                ->orderBy('data','ASC')
                ->paginate(10);

            foreach($compras as $compra){
                if(\Carbon\Carbon::parse($compra->data)->diffInDays(\Carbon\Carbon::parse(time())) > 0 && $compra->id_situacao == 1){
                    $compra->id_situacao = 2;
                    $compra->save();
                }
            }

            $x = 0;

            $vendas_atrasadas = TblVendas::where('id_situacao','=',2)
                ->where('id_igreja','=',$igreja->id)
                ->count();

            $vendas_pendentes = TblVendas::where('id_situacao','=',1)
                ->where('id_igreja','=',$igreja->id)
                ->count();

            $eventos = TblEventos::where('dados_horario_inicio','>', Carbon::parse(date('Y-m-d h:i:s', time())))
                ->where('id_igreja','=',$igreja->id)
                ->get();
            $qtd_inscricoes = 0;
            $qtd_feventos = 0;
            foreach($eventos as $evento){
                $qtd_inscricoes += TblInscricoes::where('id_evento','=',$evento->id)->count();
                $qtd_feventos++;
            }

            $color_inscricoes = 'green';
            if($color_inscricoes == 0){
                $color_inscricoes = 'red';
            }else if($qtd_inscricoes < 100){
                $color_inscricoes = 'yellow';
            }

            $quadros[$x]['info'] = $vendas_atrasadas;
            $quadros[$x]['title'] = 'Vendas atrasadas';
            $quadros[$x]['icon'] = 'fa-cart-plus';
            $quadros[$x]['color'] = 'red';
            $quadros[$x]['link'] = 'vendas';
            $x++;

            $quadros[$x]['info'] = $vendas_pendentes;
            $quadros[$x]['title'] = 'Vendas pendentes';
            $quadros[$x]['icon'] = 'fa-cart-plus';
            $quadros[$x]['color'] = 'yellow';
            $quadros[$x]['link'] = 'vendas';
            $x++;

            $quadros[$x]['info'] = $qtd_inscricoes;
            $quadros[$x]['title'] = 'Incrições para os próximos eventos';
            $quadros[$x]['icon'] = 'fa-clock-o';
            $quadros[$x]['color'] = $color_inscricoes;
            $quadros[$x]['link'] = 'eventos';
            $x++;

            $quadros[$x]['info'] = $qtd_feventos;
            $quadros[$x]['title'] = 'Eventos que ainda irão acontecer';
            $quadros[$x]['icon'] = 'fa-clock-o';
            $quadros[$x]['color'] = 'yellow';
            $quadros[$x]['link'] = 'banners';
            $x++;

            $usuarios_ativos = \DB::table('users')->leftJoin('tbl_perfis','users.id_perfil','=','tbl_perfis.id')
                ->where('users.status','=',true)
                ->where('tbl_perfis.status','=',true)
                ->where('id_igreja','=',$igreja->id)->get();

            $qtd_usuarios_on = 0;

            foreach($usuarios_ativos as $usuario){
                if(\Cache::has('user-is-online-'.$usuario->id)) $qtd_usuarios_on++;
            }

            $quadros[$x]['info'] = $qtd_usuarios_on;
            $quadros[$x]['title'] = 'Usuários online';
            $quadros[$x]['icon'] = 'fa-users';
            $quadros[$x]['color'] = 'green';
            $quadros[$x]['link'] = 'usuarios';
            $x++;

            $quadros[$x]['info'] = sizeof($usuarios_ativos);
            $quadros[$x]['title'] = 'Usuários ativos';
            $quadros[$x]['icon'] = 'fa-child';
            $quadros[$x]['color'] = 'green';
            $quadros[$x]['link'] = 'usuarios';
            $x++;

            $quadros[$x]['info'] = TblBanner::where('id_igreja','=',$igreja->id)->count();
            $quadros[$x]['title'] = 'Banners';
            $quadros[$x]['icon'] = 'fa-image';
            $quadros[$x]['color'] = 'green';
            $quadros[$x]['link'] = 'banners';
            $x++;

            $quadros[$x]['info'] = TblEventos::where('id_igreja','=',$igreja->id)->count();
            $quadros[$x]['title'] = 'Linha do tempo';
            $quadros[$x]['icon'] = 'fa-clock-o';
            $quadros[$x]['color'] = 'green';
            $quadros[$x]['link'] = 'eventos';
            $x++;

            $quadros[$x]['info'] = TblEventosFixos::where('id_igreja','=',$igreja->id)->count();
            $quadros[$x]['title'] = 'Eventos fixos';
            $quadros[$x]['icon'] = 'fa-calendar';
            $quadros[$x]['color'] = 'green';
            $quadros[$x]['link'] = 'eventosfixos';
            $x++;

            $quadros[$x]['info'] = TblGalerias::where('id_igreja','=',$igreja->id)->count();
            $quadros[$x]['title'] = 'Galerias';
            $quadros[$x]['icon'] = 'fa-file-image-o';
            $quadros[$x]['color'] = 'green';
            $quadros[$x]['link'] = 'galerias';
            $x++;

            $quadros[$x]['info'] = TblNoticias::where('id_igreja','=',$igreja->id)->count();
            $quadros[$x]['title'] = 'Notícias';
            $quadros[$x]['icon'] = 'fa-newspaper-o';
            $quadros[$x]['color'] = 'green';
            $quadros[$x]['link'] = 'noticias';
            $x++;

            $quadros[$x]['info'] = TblPerfil::where('id_igreja','=',$igreja->id)->count();
            $quadros[$x]['title'] = 'Perfis';
            $quadros[$x]['icon'] = 'fa-user';
            $quadros[$x]['color'] = 'green';
            $quadros[$x]['link'] = 'perfis';
            $x++;

            $quadros[$x]['info'] = TblPublicacoes::where('id_igreja','=',$igreja->id)->count();
            $quadros[$x]['title'] = 'Publicações';
            $quadros[$x]['icon'] = 'fa-thumbs-o-up';
            $quadros[$x]['color'] = 'green';
            $quadros[$x]['link'] = 'publicacoes';
            $x++;

            $quadros[$x]['info'] = TblSermoes::where('id_igreja','=',$igreja->id)->count();
            $quadros[$x]['title'] = 'Vídeos';
            $quadros[$x]['icon'] = 'fa-play';
            $quadros[$x]['color'] = 'green';
            $quadros[$x]['link'] = 'sermoes';
            $x++;

            return view('usuario.home', compact('quadros'));
        }
    }

    // FUNCOES ÚTEIS !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    public function modulos_igreja($id){
        $modulos['data'] = \DB::table('tbl_modulos')
            ->select('tbl_modulos.*')
            ->leftJoin('tbl_igrejas_modulos', 'tbl_igrejas_modulos.id_modulo', '=', 'tbl_modulos.id')
            ->where('tbl_igrejas_modulos.id_igreja','=',$id)
            ->get();
        return json_encode($modulos);
    }
    ////////////////////////////////////////////////////////////////////////////////
    
    // BANNERS AREA !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    public function banners()
    {
        if( valida_modulo(\Auth::user()->id_perfil, \Config::get('constants.modulos.bannersg')) == false){
            return view('error');
        }else{
            $perfil = TblPerfil::find(\Auth::user()->id_perfil);
            $igreja = obter_dados_igreja_id($perfil->id_igreja);
            $modulos_igreja = obter_modulos_gerenciais_igreja($igreja);
            return view('usuario.banners', compact('igreja','modulos_igreja'));
        }
    }

    public function tbl_banners(){
        if( valida_modulo(\Auth::user()->id_perfil, \Config::get('constants.modulos.bannersg')) == false){
            return view('error');
        }else{
            $perfil = TblPerfil::find(\Auth::user()->id_perfil);
            $banners = TblBanner::where('id_igreja','=',$perfil->id_igreja)->get();
            return DataTables::of($banners)->addColumn('action',function($banners){
                $btn_editar = '';
                if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.bannersg'), \Config::get('constants.permissoes.alterar'))[2] == true){
                    $btn_editar = '<a href="'.route('usuario.editarBanner',['id'=>$banners->id]).'" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>';
                }
                $btn_excluir = '';
                if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.bannersg'), \Config::get('constants.permissoes.desativar'))[2] == true){
                    $btn_excluir = '<a href="'.route('usuario.excluirFotoBanner',['id'=>$banners->id]).'" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>';
                }
                return $btn_editar.'&nbsp'.$btn_excluir;
            })->editColumn('created_at', function($banners) {
                if($banners->created_at != null)
                    return Carbon::parse($banners->created_at)->format('d/m/Y');
                else
                    return null;
            })->editColumn('updated_at', function($banners) {
                if($banners->updated_at != null){
                    $upd = Carbon::parse($banners->updated_at)->diffForHumans();
                    return $upd;
                }else
                    return null;
            })
            ->make(true);
        }
    }

    public function editarBanner($id){
        if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.bannersg'), \Config::get('constants.permissoes.alterar'))[2] == true){
            $banner = TblBanner::find($id);
            $perfil = TblPerfil::find(\Auth::user()->id_perfil);
            $igreja = obter_dados_igreja_id($perfil->id_igreja);
            $modulos_igreja = obter_modulos_gerenciais_igreja($igreja);
            return view('usuario.editarbanner', compact('banner','igreja','modulos_igreja'));
        }else{ return view('error'); }
    }

    public function atualizarBanner(Request $request){
        if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.bannersg'), \Config::get('constants.permissoes.alterar'))[2] == true){
            $banner = TblBanner::find($request->id);
            $banner->nome = $request->nome;
            $banner->ordem = $request->ordem;
            $banner->descricao = $request->descricao;
            if($request->link == 1){
                $modulo = TblModulo::find($request->modulo);
                $banner->link = $modulo->rota;
            }else if($request->link == 2){
                $banner->link = 'publicacao/'.$request->publicacao;
            }else if($request->link == 3){
                $banner->link = 'evento/'.$request->evento;
            }else if($request->link == 4){
                $banner->link = 'eventofixo/'.$request->eventofixo;
            }else if($request->link == 5){
                $banner->link = 'noticia/'.$request->noticia;
            }else if($request->link == 6){
                $banner->link = 'sermao/'.$request->sermao;
            }else if($request->link == 7){
                $banner->link = 'galeria/'.$request->galeria;
            }else if($request->link == 8){
                $banner->link = $request->url;
            }
            if($request->foto){
                $banner->foto = file_get_contents($request->foto);
            }
            $banner->save();

            $notification = array(
                'message' => 'Banner ' . $banner->nome . ' foi alterado com sucesso!', 
                'alert-type' => 'success'
            );

            return redirect()->route('usuario.banners')->with($notification);
        }else{ return view('error'); }
    }

    public function incluirBanner(Request $request){
        if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.bannersg'), \Config::get('constants.permissoes.incluir'))[2] == true){
            $banner = new TblBanner();
            $banner->id_igreja = $request->igreja;
            $banner->nome = $request->nome;
            $banner->ordem = $request->ordem;
            $banner->descricao = $request->descricao;
            if($request->link == 1){
                $modulo = TblModulo::find($request->modulo);
                $menu->link = $modulo->rota;
            }else if($request->link == 2){
                $menu->link = 'publicacao/'.$request->publicacao;
            }else if($request->link == 3){
                $menu->link = 'evento/'.$request->evento;
            }else if($request->link == 4){
                $menu->link = 'eventofixo/'.$request->eventofixo;
            }else if($request->link == 5){
                $menu->link = 'noticia/'.$request->noticia;
            }else if($request->link == 6){
                $menu->link = 'sermao/'.$request->sermao;
            }else if($request->link == 7){
                $menu->link = 'galeria/'.$request->galeria;
            }else if($request->link == 8){
                $menu->link = $request->url;
            }
            $banner->foto = file_get_contents($request->foto);
            $banner->save();

            $notification = array(
                'message' => 'Banner ' . $banner->nome . ' foi adicionado com sucesso!', 
                'alert-type' => 'success'
            );

            return redirect()->route('usuario.banners')->with($notification);
        }else{ return view('error'); }
    }

    public function excluirFotoBanner(Request $request){
        if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.bannersg'), \Config::get('constants.permissoes.desativar'))[2] == true){
            $banner = TblBanner::find($request->id);
            $banner->foto = null;
            $banner->save();
            return \Response::json(['message' => 'File successfully delete'], 200);
        }else{ return view('error'); }
    }

    public function excluirBanner($id){
        if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.bannersg'), \Config::get('constants.permissoes.desativar'))[2] == true){
            $banner = TblBanner::find($id);
            File::delete(public_path().'/storage/banners/'.$banner->foto);
            $banner->delete();

            $notification = array(
                'message' => 'Banner ' . $banner->nome . ' foi excluído com sucesso!', 
                'alert-type' => 'success'
            );

            return redirect()->route('usuario.banners')->with($notification);
        }else{ return view('error'); }
    }
    ////////////////////////////////////////////////////////////////////////////////////////

    // GALERIA AREA !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    public function galerias()
    {
        if( valida_modulo(\Auth::user()->id_perfil, \Config::get('constants.modulos.galeriasg')) == false){
            return view('error');
        }else{
            $perfil = TblPerfil::find(\Auth::user()->id_perfil);
            $igreja = obter_dados_igreja_id($perfil->id_igreja);
            $modulos_igreja = obter_modulos_gerenciais_igreja($igreja);
            return view('usuario.galerias', compact('igreja','modulos_igreja'));
        }
    }

    public function tbl_galerias(){
        if( valida_modulo(\Auth::user()->id_perfil, \Config::get('constants.modulos.galeriasg')) == false){
            return view('error');
        }else{
            $perfil = TblPerfil::find(\Auth::user()->id_perfil);
            $galeria = TblGalerias::where('id_igreja','=',$perfil->id_igreja)->get();
            return DataTables::of($galeria)->addColumn('action',function($galeria){
                $btn_editar = '';
                if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.galeriasg'), \Config::get('constants.permissoes.alterar'))[2] == true){
                    $btn_editar = '<a href="'.route('usuario.editarGaleria',['id'=>$galeria->id]).'" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>';
                }
                $btn_excluir = '';
                if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.galeriasg'), \Config::get('constants.permissoes.desativar'))[2] == true){
                    $btn_excluir = '<a href="'.route('usuario.excluirGaleria',['id'=>$galeria->id]).'" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>';
                }
                return $btn_editar.'&nbsp'.$btn_excluir;
            })->editColumn('data', function($galeria) {
                if($galeria->data != null)
                    return Carbon::parse($galeria->data)->format('d/m/Y');
                else
                    return null;
            })->editColumn('created_at', function($galeria) {
                if($galeria->created_at != null)
                    return Carbon::parse($galeria->created_at)->format('d/m/Y');
                else
                    return null;
            })->editColumn('updated_at', function($galeria) {
                if($galeria->updated_at != null){
                    $upd = Carbon::parse($galeria->updated_at)->diffForHumans();
                    return $upd;
                }else
                    return null;
            })
            ->make(true);
        }
    }

    public function incluirGaleria(Request $request){
        if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.galeriasg'), \Config::get('constants.permissoes.incluir'))[2] == true){
            $galeria = new TblGalerias();
            $galeria->id_igreja = $request->igreja;
            $galeria->nome = $request->nome;
            $galeria->descricao = $request->descricao;
            $galeria->data = muda_data($request->data);
            $galeria->save();

            foreach($request->fotos as $f_){
                $foto = new TblFotos();
                $foto->id_galeria = $galeria->id;
                $foto->foto = file_get_contents($f_);
                $foto->save();
            }
                
            $notification = array(
                'message' => 'Álbum ' . $galeria->nome . ' foi adicionado com sucesso!', 
                'alert-type' => 'success'
            );

            return redirect()->route('usuario.galerias')->with($notification);
        }else{ return view('error'); }
    }

    public function excluirGaleria($id){
        if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.galeriasg'), \Config::get('constants.permissoes.desativar'))[2] == true){
            $galeria = TblGalerias::find($id);
            $fotos = TblFotos::where("id_galeria","=",$galeria->id)->get();
            foreach($fotos as $foto){
                File::delete(public_path().'/storage/galerias/'.$foto->foto);
                $foto->delete();
            }
            $galeria->delete();

            $notification = array(
                'message' => 'Álbum ' . $galeria->nome . ' foi excluído com sucesso!', 
                'alert-type' => 'success'
            );

            return redirect()->route('usuario.galerias')->with($notification);
        }else{ return view('error'); }
    }

    public function editarGaleria($id){
        if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.galeriasg'), \Config::get('constants.permissoes.alterar'))[2] == true){
            $galeria = TblGalerias::find($id);
            $fotos = TblFotos::where('id_galeria','=',$galeria->id)->get();
            $perfil = TblPerfil::find(\Auth::user()->id_perfil);
            $igreja = obter_dados_igreja_id($perfil->id_igreja);
            $modulos_igreja = obter_modulos_gerenciais_igreja($igreja);
            return view('usuario.editargaleria', compact('galeria','fotos','igreja','modulos_igreja'));
        }else{ return view('error'); }
    }

    public function atualizarGaleria(Request $request){
        if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.galeriasg'), \Config::get('constants.permissoes.alterar'))[2] == true){
            $galeria = TblGalerias::find($request->id);
            $galeria->nome = $request->nome;
            $galeria->descricao = $request->descricao;
            $galeria->data = muda_data($request->data);
            $galeria->save();

            if($request->fotos) foreach($request->fotos as $f_){
                $foto = new TblFotos();
                $foto->id_galeria = $galeria->id;
                $foto->foto = file_get_contents($f_);
                $foto->save();
            }
                
            $notification = array(
                'message' => 'Álbum ' . $galeria->nome . ' foi alterado com sucesso!', 
                'alert-type' => 'success'
            );

            return redirect()->route('usuario.galerias')->with($notification);
        }else{ return view('error'); }
    }

    public function excluirFotoGaleria(Request $request){
        if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.galeriasg'), \Config::get('constants.permissoes.desativar'))[2] == true){
            $foto = TblFotos::find($request->id);
            $foto->delete();
            File::delete(public_path().'/storage/galerias/'.$request['foto']);
            return \Response::json(['message' => 'File successfully delete'], 200);
        }else{ return view('error'); }
    }
    ////////////////////////////////////////////////////////////////////////////////////////

    // EVENTOS FIXOS AREA !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    public function eventosfixos()
    {
        if( valida_modulo(\Auth::user()->id_perfil, \Config::get('constants.modulos.eventosfixosg')) == false){
            return view('error');
        }else{
            $perfil = TblPerfil::find(\Auth::user()->id_perfil);
            $igreja = obter_dados_igreja_id($perfil->id_igreja);
            $modulos_igreja = obter_modulos_apresentativos_igreja($igreja);
            return view('usuario.eventosfixos', compact('igreja','modulos_igreja'));
        }
    }

    public function tbl_eventosfixos(){
        if( valida_modulo(\Auth::user()->id_perfil, \Config::get('constants.modulos.eventosfixosg')) == false){
            return view('error');
        }else{
            $perfil = TblPerfil::find(\Auth::user()->id_perfil);
            $eventofixo = TblEventosFixos::where('id_igreja','=',$perfil->id_igreja)->get();
            return DataTables::of($eventofixo)->addColumn('action',function($eventofixo){
                $btn_editar = '';
                if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.eventosfixosg'), \Config::get('constants.permissoes.alterar'))[2] == true){
                    $btn_editar = '<a href="'.route('usuario.editarEventoFixo',['id'=>$eventofixo->id]).'" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>';
                }
                $btn_excluir = '';
                if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.eventosfixosg'), \Config::get('constants.permissoes.desativar'))[2] == true){
                    $btn_excluir = '<a href="'.route('usuario.excluirEventoFixo',['id'=>$eventofixo->id]).'" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>';
                }
                return $btn_editar.'&nbsp'.$btn_excluir;
            })->editColumn('created_at', function($eventofixo) {
                if($eventofixo->created_at != null)
                    return Carbon::parse($eventofixo->created_at)->format('d/m/Y');
                else
                    return null;
            })->editColumn('updated_at', function($eventofixo) {
                if($eventofixo->updated_at != null){
                    $upd = Carbon::parse($eventofixo->updated_at)->diffForHumans();
                    return $upd;
                }else
                    return null;
            })
            ->make(true);
        }
    }

    public function incluirEventoFixo(Request $request){
        if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.eventosfixosg'), \Config::get('constants.permissoes.incluir'))[2] == true){
            $eventofixo = new TblEventosFixos();
            $eventofixo->id_igreja = $request->igreja;
            $eventofixo->nome = $request->nome;
            $eventofixo->dados_horario_local = $request->dados_horario_local;
            $eventofixo->descricao = $request->descricao;
            $eventofixo->save();

            if($request->foto){
                $eventofixo->foto = file_get_contents($request->foto);
                $eventofixo->save();
            }

            $notification = array(
                'message' => 'Evento fixo "' . $eventofixo->nome . '" foi adicionado com sucesso!', 
                'alert-type' => 'success'
            );

            return redirect()->route('usuario.eventosfixos')->with($notification);
        }else{ return view('error'); }
    }

    public function editarEventoFixo($id){
        if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.eventosfixosg'), \Config::get('constants.permissoes.alterar'))[2] == true){
            $eventofixo = TblEventosFixos::find($id);
            $perfil = TblPerfil::find(\Auth::user()->id_perfil);
            $igreja = obter_dados_igreja_id($perfil->id_igreja);
            $modulos_igreja = obter_modulos_gerenciais_igreja($igreja);
            return view('usuario.editareventofixo', compact('eventofixo','igreja','modulos_igreja'));
        }else{ return view('error'); }
    }

    public function atualizarEventoFixo(Request $request){
        if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.eventosfixosg'), \Config::get('constants.permissoes.alterar'))[2] == true){
            $eventofixo = TblEventosFixos::find($request->id);
            $eventofixo->nome = $request->nome;
            $eventofixo->dados_horario_local = $request->dados_horario_local;
            $eventofixo->descricao = $request->descricao;
            $eventofixo->save();

            if($request->foto){
                $eventofixo->foto = file_get_contents($request->foto);
                $eventofixo->save();
            }

            $notification = array(
                'message' => 'Evento fixo "' . $eventofixo->nome . '" foi alterado com sucesso!', 
                'alert-type' => 'success'
            );

            return redirect()->route('usuario.eventosfixos')->with($notification);
        }else{ return view('error'); }
    }

    public function excluirFotoEventoFixo(Request $request){
        if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.eventosfixosg'), \Config::get('constants.permissoes.desativar'))[2] == true){
            $foto = $request['foto'];
            $eventofixo = TblEventosFixos::find($request->id);
            $eventofixo->foto = null;
            $eventofixo->save();
            File::delete(public_path().'/storage/eventos/'.$foto);
            return \Response::json(['message' => 'File successfully delete'], 200);
        }else{ return view('error'); }
    }

    public function excluirEventoFixo($id){
        if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.eventosfixosg'), \Config::get('constants.permissoes.desativar'))[2] == true){
            $eventofixo = TblEventosFixos::find($id);
            if($eventofixo->foto != null) File::delete(public_path().'/storage/eventos/'.$eventofixo->foto);
            $eventofixo->delete();

            $notification = array(
                'message' => 'Evento fixo "' . $eventofixo->nome . '" foi excluído com sucesso!', 
                'alert-type' => 'success'
            );

            return redirect()->route('usuario.eventosfixos')->with($notification);
        }else{ return view('error'); }
    }
    ////////////////////////////////////////////////////////////////////////////////////////

    // NOTÍCIA AREA !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    public function noticias()
    {
        if( valida_modulo(\Auth::user()->id_perfil, \Config::get('constants.modulos.noticiasg')) == false){
            return view('error');
        }else{
            $perfil = TblPerfil::find(\Auth::user()->id_perfil);
            $igreja = obter_dados_igreja_id($perfil->id_igreja);
            $modulos_igreja = obter_modulos_gerenciais_igreja($igreja);
            return view('usuario.noticias', compact('igreja','modulos_igreja'));
        }
    }

    public function tbl_noticias(){
        if( valida_modulo(\Auth::user()->id_perfil, \Config::get('constants.modulos.noticiasg')) == false){
            return view('error');
        }else{
            $perfil = TblPerfil::find(\Auth::user()->id_perfil);
            $noticia = TblNoticias::where('id_igreja','=',$perfil->id_igreja)->get();
            return DataTables::of($noticia)->addColumn('action',function($noticia){
                $btn_editar = '';
                if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.noticiasg'), \Config::get('constants.permissoes.alterar'))[2] == true){
                    $btn_editar = '<a href="'.route('usuario.editarNoticia',['id'=>$noticia->id]).'" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>';
                }
                $btn_excluir = '';
                if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.noticiasg'), \Config::get('constants.permissoes.desativar'))[2] == true){
                    $btn_excluir = '<a href="'.route('usuario.excluirNoticia',['id'=>$noticia->id]).'" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>';
                }
                return $btn_editar.'&nbsp'.$btn_excluir;
            })->editColumn('created_at', function($noticia) {
                if($noticia->created_at != null)
                    return Carbon::parse($noticia->created_at)->format('d/m/Y');
                else
                    return null;
            })->editColumn('updated_at', function($noticia) {
                if($noticia->updated_at != null){
                    $upd = Carbon::parse($noticia->updated_at)->diffForHumans();
                    return $upd;
                }else
                    return null;
            })
            ->make(true);
        }
    }

    public function incluirNoticia(Request $request){
        if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.noticiasg'), \Config::get('constants.permissoes.incluir'))[2] == true){
            $noticia = new TblNoticias();
            $noticia->id_igreja = $request->igreja;
            $noticia->nome = $request->nome;
            $noticia->descricao = $request->descricao;
            $noticia->save();

            if($request->foto){
                $noticia->foto = file_get_contents($request->foto);
                $noticia->save();
            }

            $notification = array(
                'message' => 'Notícia "' . $noticia->nome . '" foi publicada com sucesso!', 
                'alert-type' => 'success'
            );

            return redirect()->route('usuario.noticias')->with($notification);
        }else{ return view('error'); }
    }

    public function editarNoticia($id){
        if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.noticiasg'), \Config::get('constants.permissoes.alterar'))[2] == true){
            $noticia = TblNoticias::find($id);
            $perfil = TblPerfil::find(\Auth::user()->id_perfil);
            $igreja = obter_dados_igreja_id($perfil->id_igreja);
            $modulos_igreja = obter_modulos_gerenciais_igreja($igreja);
            return view('usuario.editarnoticia', compact('noticia','igreja','modulos_igreja'));
        }else{ return view('error'); }
    }

    public function atualizarNoticia(Request $request){
        if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.noticiasg'), \Config::get('constants.permissoes.alterar'))[2] == true){
            $noticia = TblNoticias::find($request->id);
            $noticia->nome = $request->nome;
            $noticia->descricao = $request->descricao;
            $noticia->save();

            if($request->foto){
                $noticia->foto = file_get_contents($request->foto);
                $noticia->save();
            }

            $notification = array(
                'message' => 'Notícia "' . $noticia->nome . '" foi atualizada com sucesso!', 
                'alert-type' => 'success'
            );

            return redirect()->route('usuario.noticias')->with($notification);
        }else{ return view('error'); }
    }

    public function excluirFotoNoticia(Request $request){
        if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.noticiasg'), \Config::get('constants.permissoes.desativar'))[2] == true){
            $foto = $request['foto'];
            $noticia = TblNoticias::find($request->id);
            $noticia->foto = null;
            $noticia->save();
            File::delete(public_path().'/storage/noticias/'.$foto);
            return \Response::json(['message' => 'File successfully delete'], 200);
        }else{ return view('error'); }
    }

    public function excluirNoticia($id){
        if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.noticiasg'), \Config::get('constants.permissoes.desativar'))[2] == true){
            $noticia = TblNoticias::find($id);
            if($noticia->foto != null) File::delete(public_path().'/storage/noticias/'.$noticia->foto);
            $noticia->delete();

            $notification = array(
                'message' => 'Notícia "' . $noticia->nome . '" foi excluída com sucesso!', 
                'alert-type' => 'success'
            );

            return redirect()->route('usuario.noticias')->with($notification);
        }else{ return view('error'); }
    }
    ////////////////////////////////////////////////////////////////////////////////////////
    
    // SERMÕES AREA !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    public function sermoes(){
        if( valida_modulo(\Auth::user()->id_perfil, \Config::get('constants.modulos.sermoesg')) == false){
            return view('error');
        }else{
            $perfil = TblPerfil::find(\Auth::user()->id_perfil);
            $igreja = obter_dados_igreja_id($perfil->id_igreja);
            $modulos_igreja = obter_modulos_gerenciais_igreja($igreja);
            return view('usuario.sermoes', compact('igreja','modulos_igreja'));
        }
    }

    public function tbl_sermoes(){
        if( valida_modulo(\Auth::user()->id_perfil, \Config::get('constants.modulos.sermoesg')) == false){
            return view('error');
        }else{
            $perfil = TblPerfil::find(\Auth::user()->id_perfil);
            $sermao = TblSermoes::where('id_igreja','=',$perfil->id_igreja)->get();
            return DataTables::of($sermao)->addColumn('action',function($sermao){
                $btn_editar = '';
                if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.sermoesg'), \Config::get('constants.permissoes.alterar'))[2] == true){
                    $btn_editar = '<a href="'.route('usuario.editarSermao',['id'=>$sermao->id]).'" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>';
                }
                $btn_excluir = '';
                if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.sermoesg'), \Config::get('constants.permissoes.desativar'))[2] == true){
                    $btn_excluir = '<a href="'.route('usuario.excluirSermao',['id'=>$sermao->id]).'" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>';
                }
                return $btn_editar.'&nbsp'.$btn_excluir;
            })->editColumn('created_at', function($sermao) {
                if($sermao->created_at != null)
                    return Carbon::parse($sermao->created_at)->format('d/m/Y');
                else
                    return null;
            })->editColumn('updated_at', function($sermao) {
                if($sermao->updated_at != null){
                    $upd = Carbon::parse($sermao->updated_at)->diffForHumans();
                    return $upd;
                }else
                    return null;
            })
            ->make(true);
        }
    }

    public function incluirSermao(Request $request){
        if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.sermoesg'), \Config::get('constants.permissoes.incluir'))[2] == true){
            $sermao = new TblSermoes();
            $sermao->id_igreja = $request->igreja;
            $sermao->nome = $request->nome;
            $sermao->link = $request->link;
            $sermao->descricao = $request->descricao;
            $sermao->save();

            $notification = array(
                'message' => 'Sermão "' . $sermao->nome . '" foi adicionado com sucesso!', 
                'alert-type' => 'success'
            );

            return redirect()->route('usuario.sermoes')->with($notification);
        }else{ return view('error'); }
    }

    public function editarSermao($id){
        if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.sermoesg'), \Config::get('constants.permissoes.alterar'))[2] == true){
            $sermao = TblSermoes::find($id);
            $perfil = TblPerfil::find(\Auth::user()->id_perfil);
            $igreja = obter_dados_igreja_id($perfil->id_igreja);
            $modulos_igreja = obter_modulos_gerenciais_igreja($igreja);
            return view('usuario.editarsermao', compact('sermao','igreja','modulos_igreja'));
        }else{ return view('error'); }
    }

    public function atualizarSermao(Request $request){
        if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.sermoesg'), \Config::get('constants.permissoes.alterar'))[2] == true){
            $sermao = TblSermoes::find($request->id);
            $sermao->nome = $request->nome;
            $sermao->link = $request->link;
            $sermao->descricao = $request->descricao;
            $sermao->save();

            $notification = array(
                'message' => 'Sermão "' . $sermao->nome . '" foi alterado com sucesso!', 
                'alert-type' => 'success'
            );

            return redirect()->route('usuario.sermoes')->with($notification);
        }else{ return view('error'); }
    }

    public function excluirSermao($id){
        if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.sermoesg'), \Config::get('constants.permissoes.desativar'))[2] == true){
            $sermao = TblSermoes::find($id);
            $sermao->delete();

            $notification = array(
                'message' => 'Sermão "' . $sermao->nome . '" foi excluído com sucesso!', 
                'alert-type' => 'success'
            );

            return redirect()->route('usuario.sermoes')->with($notification);
        }else{ return view('error'); }
    }
    ////////////////////////////////////////////////////////////////////////////////////////

    // CONFIGURACOES AREA !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    public function configuracoes(){
        if( valida_modulo(\Auth::user()->id_perfil, \Config::get('constants.modulos.configuracoesg')) == false){
            return view('error');
        }else{
            $perfil = TblPerfil::find(\Auth::user()->id_perfil);
            $igreja = obter_dados_igreja_id($perfil->id_igreja);
            $modulos_igreja = obter_modulos_igreja($igreja);
            $retorno = obter_menus_configuracao($igreja->id_configuracao);
            $menus = $retorno[0];
            $submenus = $retorno[1];
            $subsubmenus = $retorno[2];
            $menus_aplicativo = obter_menus_aplicativo_configuracao($igreja->id_configuracao);
            $modulos_aplicativo = obter_modulos_igreja_aplicativo($igreja);
            return view('usuario.configuracoes', compact('igreja','modulos_igreja','modulos_aplicativo','menus','submenus','subsubmenus','menus_aplicativo'));
        }
    }

    public function adicionarMenu(Request $request){
        if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.configuracoesg'), \Config::get('constants.permissoes.incluir'))[2] == true){
            $menu = new TblMenu();
            $menu->id_configuracao = $request->id_configuracao;
            $menu->nome = $request->nome;
            $menu->ordem = $request->ordem;
            if($request->link == 1){
                $modulo = TblModulo::find($request->modulo);
                $menu->link = $modulo->rota;
            }else if($request->link == 2){
                $menu->link = 'publicacao/'.$request->publicacao;
            }else if($request->link == 3){
                $menu->link = 'evento/'.$request->evento;
            }else if($request->link == 4){
                $menu->link = 'eventofixo/'.$request->eventofixo;
            }else if($request->link == 5){
                $menu->link = 'noticia/'.$request->noticia;
            }else if($request->link == 6){
                $menu->link = 'sermao/'.$request->sermao;
            }else if($request->link == 7){
                $menu->link = 'galeria/'.$request->galeria;
            }else if($request->link == 8){
                $menu->link = $request->url;
            }
            $menu->save();

            $notification = array(
                'message' => 'Menu ' . $menu->nome . ' foi adicionado com sucesso!', 
                'alert-type' => 'success'
            );

            return back()->with($notification);
        }else{ return view('error'); }
    }

    public function editarMenu(Request $request){
        if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.configuracoesg'), \Config::get('constants.permissoes.alterar'))[2] == true){
            $menu = TblMenu::find($request->id);
            $menu->nome = $request->nome;
            $menu->ordem = $request->ordem;
            if($request->link == 1){
                $modulo = TblModulo::find($request->modulo);
                $menu->link = $modulo->rota;
            }else if($request->link == 2){
                $menu->link = 'publicacao/'.$request->publicacao;
            }else if($request->link == 3){
                $menu->link = 'evento/'.$request->evento;
            }else if($request->link == 4){
                $menu->link = 'eventofixo/'.$request->eventofixo;
            }else if($request->link == 5){
                $menu->link = 'noticia/'.$request->noticia;
            }else if($request->link == 6){
                $menu->link = 'sermao/'.$request->sermao;
            }else if($request->link == 7){
                $menu->link = 'galeria/'.$request->galeria;
            }else if($request->link == 8){
                $menu->link = $request->url;
            }
            $menu->save();

            $notification = array(
                'message' => 'Menu ' . $menu->nome . ' foi alterado com sucesso!', 
                'alert-type' => 'success'
            );

            return back()->with($notification);
        }else{ return view('error'); }
    }

    public function excluirMenu($id){
        if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.configuracoesg'), \Config::get('constants.permissoes.desativar'))[2] == true){
            $sub_menus = \DB::table('tbl_sub_menus')
                ->select('tbl_sub_menus.id')
                ->where('tbl_sub_menus.id_menu','=',$id)
                ->get();

            foreach($sub_menus as $sub_menu){
                $sub_sub_menus = \DB::table('tbl_sub_sub_menus')
                    ->select('tbl_sub_sub_menus.id')
                    ->where('tbl_sub_sub_menus.id_submenu','=',$id)
                    ->get();

                foreach($sub_sub_menus as $sub_sub_menu){
                    TblSubSubMenu::where('id', $sub_sub_menu->id)->delete();
                }

                TblSubMenu::where('id', $sub_menu->id)->delete();
            }

            $menu = TblMenu::find($id);
            TblMenu::where('id', $id)->delete();

            $notification = array(
                'message' => 'Menu ' . $menu->nome . ' foi excluído com sucesso!', 
                'alert-type' => 'success'
            );

            return back()->with($notification);
        }else{ return view('error'); }
    }

    public function adicionarSubMenu(Request $request){
        if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.configuracoesg'), \Config::get('constants.permissoes.incluir'))[2] == true){
            $submenu = new TblSubMenu();
            $submenu->id_menu = $request->id_menu;
            $submenu->nome = $request->nome;
            $submenu->ordem = $request->ordem;
            if($request->link == 1){
                $modulo = TblModulo::find($request->modulo);
                $submenu->link = $modulo->rota;
            }else if($request->link == 2){
                $submenu->link = 'publicacao/'.$request->publicacao;
            }else if($request->link == 3){
                $submenu->link = 'evento/'.$request->evento;
            }else if($request->link == 4){
                $submenu->link = 'eventofixo/'.$request->eventofixo;
            }else if($request->link == 5){
                $submenu->link = 'noticia/'.$request->noticia;
            }else if($request->link == 6){
                $submenu->link = 'sermao/'.$request->sermao;
            }else if($request->link == 7){
                $submenu->link = 'galeria/'.$request->galeria;
            }else if($request->link == 8){
                $submenu->link = $request->url;
            }
            $submenu->save();

            $notification = array(
                'message' => 'Submenu ' . $submenu->nome . ' foi adicionado com sucesso!', 
                'alert-type' => 'success'
            );

            return back()->with($notification);
        }else{ return view('error'); }
    }

    public function editarSubMenu(Request $request){
        if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.configuracoesg'), \Config::get('constants.permissoes.alterar'))[2] == true){
            $submenu = TblSubMenu::find($request->id);
            $submenu->id_menu = $request->id_menu;
            $submenu->nome = $request->nome;
            $submenu->ordem = $request->ordem;
            if($request->link == 1){
                $modulo = TblModulo::find($request->modulo);
                $submenu->link = $modulo->rota;
            }else if($request->link == 2){
                $submenu->link = 'publicacao/'.$request->publicacao;
            }else if($request->link == 3){
                $submenu->link = 'evento/'.$request->evento;
            }else if($request->link == 4){
                $submenu->link = 'eventofixo/'.$request->eventofixo;
            }else if($request->link == 5){
                $submenu->link = 'noticia/'.$request->noticia;
            }else if($request->link == 6){
                $submenu->link = 'sermao/'.$request->sermao;
            }else if($request->link == 7){
                $submenu->link = 'galeria/'.$request->galeria;
            }else if($request->link == 8){
                $submenu->link = $request->url;
            }
            $submenu->save();

            $notification = array(
                'message' => 'Submenu ' . $submenu->nome . ' foi alterado com sucesso!', 
                'alert-type' => 'success'
            );

            return back()->with($notification);
        }else{ return view('error'); }
    }

    public function excluirSubMenu($id){
        if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.configuracoesg'), \Config::get('constants.permissoes.desativar'))[2] == true){
            $sub_sub_menus = \DB::table('tbl_sub_sub_menus')
                ->select('tbl_sub_sub_menus.id')
                ->where('tbl_sub_sub_menus.id_submenu','=',$id)
                ->get();

            foreach($sub_sub_menus as $sub_sub_menu){
                TblSubSubMenu::where('id', $sub_sub_menu->id)->delete();
            }

            $submenu = TblSubMenu::find($id);
            TblSubMenu::where('id', $id)->delete();

            $notification = array(
                'message' => 'Submenu ' . $submenu->nome . ' foi excluído com sucesso!', 
                'alert-type' => 'success'
            );

            return back()->with($notification);
        }else{ return view('error'); }
    }

    public function adicionarSubSubMenu(Request $request){
        if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.configuracoesg'), \Config::get('constants.permissoes.incluir'))[2] == true){
            $subsubmenu = new TblSubSubMenu();
            $subsubmenu->id_submenu = $request->id_submenu;
            $subsubmenu->nome = $request->nome;
            $subsubmenu->ordem = $request->ordem;
            if($request->link == 1){
                $modulo = TblModulo::find($request->modulo);
                $subsubmenu->link = $modulo->rota;
            }else if($request->link == 2){
                $subsubmenu->link = 'publicacao/'.$request->publicacao;
            }else if($request->link == 3){
                $subsubmenu->link = 'evento/'.$request->evento;
            }else if($request->link == 4){
                $subsubmenu->link = 'eventofixo/'.$request->eventofixo;
            }else if($request->link == 5){
                $subsubmenu->link = 'noticia/'.$request->noticia;
            }else if($request->link == 6){
                $subsubmenu->link = 'sermao/'.$request->sermao;
            }else if($request->link == 7){
                $subsubmenu->link = 'galeria/'.$request->galeria;
            }else if($request->link == 8){
                $subsubmenu->link = $request->url;
            }
            $subsubmenu->save();

            $notification = array(
                'message' => 'Sub-Submenu ' . $subsubmenu->nome . ' foi adicionado com sucesso!', 
                'alert-type' => 'success'
            );

            return back()->with($notification);
        }else{ return view('error'); }
    }

    public function editarSubSubMenu(Request $request){
        if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.configuracoesg'), \Config::get('constants.permissoes.alterar'))[2] == true){
            $subsubmenu = TblSubSubMenu::find($request->id);
            $subsubmenu->id_submenu = $request->id_submenu;
            $subsubmenu->nome = $request->nome;
            $subsubmenu->ordem = $request->ordem;
            if($request->link == 1){
                $modulo = TblModulo::find($request->modulo);
                $subsubmenu->link = $modulo->rota;
            }else if($request->link == 2){
                $subsubmenu->link = 'publicacao/'.$request->publicacao;
            }else if($request->link == 3){
                $subsubmenu->link = 'evento/'.$request->evento;
            }else if($request->link == 4){
                $subsubmenu->link = 'eventofixo/'.$request->eventofixo;
            }else if($request->link == 5){
                $subsubmenu->link = 'noticia/'.$request->noticia;
            }else if($request->link == 6){
                $subsubmenu->link = 'sermao/'.$request->sermao;
            }else if($request->link == 7){
                $subsubmenu->link = 'galeria/'.$request->galeria;
            }else if($request->link == 8){
                $subsubmenu->link = $request->url;
            }
            $subsubmenu->save();

            $notification = array(
                'message' => 'Sub-Submenu ' . $subsubmenu->nome . ' foi alterado com sucesso!', 
                'alert-type' => 'success'
            );

            return back()->with($notification);
        }else{ return view('error'); }
    }

    public function excluirSubSubMenu($id){
        if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.configuracoesg'), \Config::get('constants.permissoes.desativar'))[2] == true){
            $subsubmenu = TblSubSubMenu::find($id);
            TblSubSubMenu::where('id', $id)->delete();

            $notification = array(
                'message' => 'Sub-Submenu ' . $subsubmenu->nome . ' foi excluído com sucesso!', 
                'alert-type' => 'success'
            );

            return back()->with($notification);
        }else{ return view('error'); }
    }

    public function excluirLogo(Request $request){
        if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.configuracoesg'), \Config::get('constants.permissoes.alterar'))[2] == true){
            $igreja = TblIgreja::find($request->id);
            $igreja->logo = null;
            $igreja->save();
            return \Response::json(['message' => 'File successfully delete'], 200);
        }
    }

    public function salvarConfiguracoes(Request $request){
        if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.configuracoesg'), \Config::get('constants.permissoes.alterar'))[2] == true){
            $configuracao = TblConfiguracoes::find($request->id);
            $configuracao->id_template = $request->id_template;
            $configuracao->cor = $request->cor;
            $configuracao->texto_apresentativo = $request->texto_apresentativo;
            if($request->custom_style){
                $configuracao->custom_style = file_get_contents($request->custom_style);
            }

            $igreja = TblIgreja::find($configuracao->id_igreja);
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
            if($request->logo){
                $igreja->logo =file_get_contents($request->logo);
            }
            
            $count = TblIgreja::where("nome", "=", $igreja->nome)->where("id", "<>", $request->id)->count();
            if($count == 0){
                
                $igreja->save();
                $configuracao->save();

                $notification = array(
                    'message' => 'Configurações da congregação alteradas com sucesso!', 
                    'alert-type' => 'success'
                );

                return back()->with($notification);

            }else{

                $notification = array(
                    'message' => 'O nome informado já está na base de dados!', 
                    'alert-type' => 'error'
                );
    
                return back()->with($notification);
    
            }
        }else{ return view('error'); }
    }

    public function adicionarMenuAplicativo(Request $request){
        if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.configuracoesg'), \Config::get('constants.permissoes.incluir'))[2] == true){

            $menu = new TblMenusAndroid();
            $menu->id_configuracao = $request->id_configuracao;
            $menu->nome = $request->nome;
            $menu->ordem = $request->ordem;
            if($request->link == 1){ // modulo
                $modulo = TblModulo::find($request->modulo);
                $menu->link = /*'modulo-' .*/ $modulo->rota;
            }else if($request->link == 2){ // publicação
                $menu->link = 'publicacao-'.$request->publicacao;
            }else if($request->link == 3){ // evento
                $menu->link = 'evento-'.$request->evento;
            }else if($request->link == 4){ // eventofixo
                $menu->link = 'eventofixo-'.$request->eventofixo;
            }else if($request->link == 5){ // notica
                $menu->link = 'noticia-'.$request->noticia;
            }else if($request->link == 6){ // sermao
                $menu->link = 'sermao-'.$request->sermao;
            }else if($request->link == 7){ // galeria
                $menu->link = 'galeria-'.$request->sermao;
            }else if($request->link == 8){ // link
                $menu->link = $request->url;
            }
            $menu->save();

            $notification = array(
                'message' => 'Menu ' . $menu->nome . ' foi adicionado ao aplicativo com sucesso!', 
                'alert-type' => 'success'
            );

            return back()->with($notification);
        }else{ return view('error'); }
    }

    public function editarMenuAplicativo(Request $request){
        if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.configuracoesg'), \Config::get('constants.permissoes.alterar'))[2] == true){

            $menu = TblMenusAndroid::find($request->id);
            $menu->nome = $request->nome;
            $menu->ordem = $request->ordem;
            if($request->link == 1){ // modulo
                $modulo = TblModulo::find($request->modulo);
                $menu->link = /*'modulo-' .*/ $modulo->rota;
            }else if($request->link == 2){ // publicação
                $menu->link = 'publicacao-'.$request->publicacao;
            }else if($request->link == 3){ // evento
                $menu->link = 'evento-'.$request->evento;
            }else if($request->link == 4){ // eventofixo
                $menu->link = 'eventofixo-'.$request->eventofixo;
            }else if($request->link == 5){ // notica
                $menu->link = 'noticia-'.$request->noticia;
            }else if($request->link == 6){ // sermao
                $menu->link = 'sermao-'.$request->sermao;
            }else if($request->link == 7){ // galeria
                $menu->link = 'galeria-'.$request->sermao;
            }else if($request->link == 8){ // link
                $menu->link = $request->url;
            }
            $menu->save();

            $notification = array(
                'message' => 'Menu ' . $menu->nome . ' do aplicativo foi alterado com sucesso!', 
                'alert-type' => 'success'
            );

            return back()->with($notification);
        }else{ return view('error'); }
    }

    public function excluirMenuAplicativo($id){
        if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.configuracoesg'), \Config::get('constants.permissoes.alterar'))[2] == true){

            $menu = TblMenusAndroid::find($id);
            TblMenusAndroid::where('id', $id)->delete();

            $notification = array(
                'message' => 'Menu ' . $menu->nome . ' foi excluído do aplicativo com sucesso!', 
                'alert-type' => 'success'
            );

            return back()->with($notification);
        }else{ return view('error'); }
    }
    ////////////////////////////////////////////////////////////////////////////////////////

    // EVENTOS AREA !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    public function eventos(){
        if( valida_modulo(\Auth::user()->id_perfil, \Config::get('constants.modulos.eventosg')) == false){
            return view('error');
        }else{
            $perfil = TblPerfil::find(\Auth::user()->id_perfil);
            $igreja = obter_dados_igreja_id($perfil->id_igreja);
            $modulos_igreja = obter_modulos_gerenciais_igreja($igreja);

            $eventos = [];
            $data = TblEventos::where('id_igreja','=',$igreja->id)->get();
            if($data->count()) {
                foreach ($data as $key => $value) {
                    $eventos[] = Calendar::event(
                        $value->nome,
                        false,
                        $value->dados_horario_inicio,
                        $value->dados_horario_fim,
                        null,
                        // Add color and link on event
                        [
                            'color' => cor_aleatoria(),
                            'url' => route('usuario.editarEvento',['id'=>$value->id]),
                        ]
                    );
                }
            }
            $calendar = Calendar::addEvents($eventos);

            return view('usuario.eventos', compact('igreja','modulos_igreja','calendar'));
        }
    }

    public function incluirEvento(Request $request){
        if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.eventosg'), \Config::get('constants.permissoes.incluir'))[2] == true){
            $evento = new TblEventos();
            $evento->id_igreja = $request->igreja;
            $evento->nome = $request->nome;
            $evento->descricao = $request->descricao;
            $evento->descricao = $request->descricao;
            $evento->dados_local = $request->local;
            // FORMATAÇÃO DAS DATAS
            $datas = $request->data;
            $datas = explode(" - ", $datas);
            $data_inicio = \Carbon\Carbon::parse(muda_data_tempo($datas[0]))->format('Y-m-d H:i:s');
            $data_fim = \Carbon\Carbon::parse(muda_data_tempo($datas[1]))->format('Y-m-d H:i:s');
            $evento->dados_horario_inicio = $data_inicio;
            $evento->dados_horario_fim = $data_fim;
            $evento->save();

            if($request->foto){
                $evento->foto = file_get_contents($request->foto);
                $evento->save();
            }

            $notification = array(
                'message' => 'Evento "' . $evento->nome . '" foi adicionado com sucesso!', 
                'alert-type' => 'success'
            );

            return redirect()->route('usuario.eventos')->with($notification);
        }else{ return view('error'); }
    }

    public function editarEvento($id){
        if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.eventosg'), \Config::get('constants.permissoes.alterar'))[2] == true){
            $evento = TblEventos::find($id);
            $inscricoes = TblInscricoes::where('id_evento','=',$evento->id)->get();
            $perfil = TblPerfil::find(\Auth::user()->id_perfil);
            $igreja = obter_dados_igreja_id($perfil->id_igreja);
            $modulos_igreja = obter_modulos_gerenciais_igreja($igreja);
            return view('usuario.editarevento', compact('evento','igreja','modulos_igreja','inscricoes'));
        }else{ return view('error'); }
    }

    public function atualizarinscricoes(Request $request){
        if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.eventosg'), \Config::get('constants.permissoes.alterar'))[2] == true){
            $evento = TblEventos::find($id);

            $incricoes_ = TblInscricoes::where('id_evento','=',$id);

            foreach($incricoes_ as $incricao_){
                $incricao_->cancelada = false;
                $incricao_->save();
            }
            
            foreach($request->inscricoes as $id_inscricao){
                $incricao = TblInscricoes::find($id_inscricao);
                $incricao->cancelada = true;
                $incricao->save();
            }

            $notification = array(
                'message' => 'A inscrições do "' . $evento->nome . '" foram atualizadas com sucesso!', 
                'alert-type' => 'success'
            );

            return redirect()->route('usuario.eventos')->with($notification);
        }else{ return view('error'); }
    }

    public function atualizarEvento(Request $request){
        if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.eventosg'), \Config::get('constants.permissoes.alterar'))[2] == true){
            $evento = TblEventos::find($request->id);

            $evento->nome = $request->nome;
            $evento->descricao = $request->descricao;
            $evento->descricao = $request->descricao;
            $evento->dados_local = $request->local;
            // FORMATAÇÃO DAS DATAS
            $datas = $request->data;
            $datas = explode(" - ", $datas);
            $data_inicio = \Carbon\Carbon::parse(muda_data_tempo($datas[0]))->format('Y-m-d H:i:s');
            $data_fim = \Carbon\Carbon::parse(muda_data_tempo($datas[1]))->format('Y-m-d H:i:s');
            $evento->dados_horario_inicio = $data_inicio;
            $evento->dados_horario_fim = $data_fim;
            $evento->save();

            if($request->foto){
                $evento->foto = file_get_contents($request->foto);
                $evento->save();
            }

            $notification = array(
                'message' => 'Evento "' . $evento->nome . '" foi atualizado com sucesso!', 
                'alert-type' => 'success'
            );

            return redirect()->route('usuario.eventos')->with($notification);
        }else{ return view('error'); }
    }

    public function excluirFotoEvento(Request $request){
        if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.eventosg'), \Config::get('constants.permissoes.desativar'))[2] == true){
            $foto = $request['foto'];
            $eventofixo = TblEventos::find($request->id);
            $eventofixo->foto = null;
            $eventofixo->save();
            File::delete(public_path().'/storage/timeline/'.$foto);
            return \Response::json(['message' => 'File successfully delete'], 200);
        }else{ return view('error'); }
    }

    public function excluirEvento($id){
        if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.eventosg'), \Config::get('constants.permissoes.desativar'))[2] == true){
            $evento = TblEventos::find($id);

            $incricoes = TblInscricoes::where('id_evento', $id)->get();

            if($incricoes != null && sizeof($incricoes) > 0) foreach($incricoes as $incricao){
                if(Carbon::now()->gt($evento->dados_horario_inicio)){
                    // disparar emails cancelando evento por email
                }

                $incricao->delete();
            }

            if($evento->foto != null) File::delete(public_path().'/storage/timeline/'.$evento->foto);
            $evento->delete();

            $notification = array(
                'message' => 'Evento "' . $evento->nome . '" foi excluído com sucesso!', 
                'alert-type' => 'success'
            );

            return redirect()->route('usuario.eventos')->with($notification);
        }else{ return view('error'); }
    }
    ////////////////////////////////////////////////////////////////////////////////////////
    
    // PUBLICAÇÕES AREA !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    public function publicacoes(){
        if( valida_modulo(\Auth::user()->id_perfil, \Config::get('constants.modulos.publicacoesg')) == false){
            return view('error');
        }else{
            $perfil = TblPerfil::find(\Auth::user()->id_perfil);
            $igreja = obter_dados_igreja_id($perfil->id_igreja);
            $modulos_igreja = obter_modulos_apresentativos_igreja($igreja);
            return view('usuario.publicacoes', compact('igreja','modulos_igreja'));
        }
    }

    public function tbl_publicacoes(){
        if( valida_modulo(\Auth::user()->id_perfil, \Config::get('constants.modulos.publicacoesg')) == false){
            return view('error');
        }else{
            $perfil = TblPerfil::find(\Auth::user()->id_perfil);
            $publicacoes = TblPublicacoes::where('id_igreja','=',$perfil->id_igreja)->get();
            return DataTables::of($publicacoes)->addColumn('action',function($publicacoes){
                $btn_editar = '';
                if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.publicacoesg'), \Config::get('constants.permissoes.alterar'))[2] == true){
                    $btn_editar = '<a href="'.route('usuario.editarPublicacao',['id'=>$publicacoes->id]).'" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>';
                }
                $btn_excluir = '';
                if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.publicacoesg'), \Config::get('constants.permissoes.desativar'))[2] == true){
                    $btn_excluir = '<a href="'.route('usuario.excluirPublicacao',['id'=>$publicacoes->id]).'" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>';
                }
                return $btn_editar.'&nbsp'.$btn_excluir;
            })
            ->make(true);
        }
    }

    public function incluirPublicacao(Request $request){
        if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.publicacoesg'), \Config::get('constants.permissoes.incluir'))[2] == true){
            if($request->html != null){
                $publicacao = new TblPublicacoes();
                $publicacao->id_igreja = $request->igreja;
                $publicacao->nome = $request->nome;
                $publicacao->html = $request->html;
                $publicacao->save();

                if($request->galeria) foreach($request->galeria as $f_){
                    $foto = new TblPublicacaoFotos();
                    $foto->id_publicacao = $publicacao->id;
                    $foto->foto = file_get_contents($request->foto);
                    $foto->save();
                }
                    
                $notification = array(
                    'message' => 'Publicação "' . $publicacao->nome . '" foi adicionada com sucesso!', 
                    'alert-type' => 'success'
                );

                return redirect()->route('usuario.publicacoes')->with($notification);
            }else{
                $notification = array(
                    'message' => 'O texto da publicação não pode ficar em branco!', 
                    'alert-type' => 'error'
                );

                return redirect()->back()->with($notification);
            }
        }else{ return view('error'); }
    }

    public function editarPublicacao($id){
        if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.publicacoesg'), \Config::get('constants.permissoes.alterar'))[2] == true){
            $publicacao = TblPublicacoes::find($id);
            $fotos = TblPublicacaoFotos::where('id_publicacao','=',$publicacao->id)->get();
            $perfil = TblPerfil::find(\Auth::user()->id_perfil);
            $igreja = obter_dados_igreja_id($perfil->id_igreja);
            $modulos_igreja = obter_modulos_gerenciais_igreja($igreja);
            return view('usuario.editarpublicacao', compact('publicacao','fotos','igreja','modulos_igreja'));
        }else{ return view('error'); }
    }

    public function atualizarPublicacao(Request $request){
        if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.publicacoesg'), \Config::get('constants.permissoes.alterar'))[2] == true){
            $publicacao = TblPublicacoes::find($request->id);
            $publicacao->nome = $request->nome;
            $publicacao->html = $request->html;
            $publicacao->save();

            if($request->galeria) foreach($request->galeria as $f_){
                $foto = new TblPublicacaoFotos();
                $foto->id_publicacao = $publicacao->id;
                $foto->foto = file_get_contents($f_);
                $foto->save();
            }
                
            $notification = array(
                'message' => 'Publicação "' . $publicacao->nome . '" foi adicionada com sucesso!', 
                'alert-type' => 'success'
            );

            return redirect()->route('usuario.publicacoes')->with($notification);
        }else{ return view('error'); }
    }

    public function excluirPublicacao($id){
        if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.publicacoesg'), \Config::get('constants.permissoes.desativar'))[2] == true){
            $publicacao = TblPublicacoes::find($id);
            $fotos = TblPublicacaoFotos::where("id_publicacao","=",$publicacao->id)->get();
            foreach($fotos as $foto){
                File::delete(public_path().'/storage/galerias-publicacoes/'.$foto->foto);
                $foto->delete();
            }
            $publicacao->delete();

            $notification = array(
                'message' => 'Publicação "' . $publicacao->nome . '" foi excluída com sucesso!', 
                'alert-type' => 'success'
            );

            return redirect()->route('usuario.publicacoes')->with($notification);
        }else{ return view('error'); }
    }

    public function excluirFotoPublicacao(Request $request){
        $foto = TblPublicacaoFotos::find($request->id);
        $foto->delete();
        File::delete(public_path().'/storage/galerias-publicacoes/'.$request['foto']);
        return \Response::json(['message' => 'File successfully delete'], 200);
    }
    ////////////////////////////////////////////////////////////////////////////////
    
    // CONTA AREA !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    public function conta(){
        $usuario = User::find(\Auth::user()->id);
        return view('usuario.conta', compact('usuario'));
    }

    public function atualizarConta(Request $request){
        $usuario = User::find(\Auth::user()->id);
        $usuario->nome = $request->nome;
        $usuario->email = $request->email;
        
        $count = \DB::table('users')
            ->select('users.email')
            ->where('users.id','<>',$usuario->id)
            ->where('users.email','=',$usuario->email)
            ->count();
        if($count == 0){
            if(empty($request->senha) || $request->senha == $request->senhac){
                if(!empty($request->senha)) $usuario->password = bcrypt($request->senha);

                $usuario->save();

                $notification = array(
                    'message' => 'Sua conta foi alterada com sucesso!', 
                    'alert-type' => 'success'
                );

                return redirect()->back()->with($notification);
            }else{
                $notification = array(
                    'message' => 'Falha na confirmação das senhas.', 
                    'alert-type' => 'error'
                );

                return redirect()->back()->with($notification);
            }
        }else{
            $notification = array(
                'message' => 'Esse email já está sendo utilizado.', 
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }
    }
    ////////////////////////////////////////////////////////////////////////////////

    // USUÁRIOS AREA !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    public function usuarios(){
        if( valida_modulo(\Auth::user()->id_perfil, \Config::get('constants.modulos.usuariosg')) == false){
            return view('error');
        }else{
            $perfil = TblPerfil::find(\Auth::user()->id_perfil);
            $igreja = obter_dados_igreja_id($perfil->id_igreja);
            $modulos_igreja = obter_modulos_apresentativos_igreja($igreja);
            return view('usuario.usuarios', compact('igreja','modulos_igreja'));
        }
    }

    public function tbl_usuarios(){
        if( valida_modulo(\Auth::user()->id_perfil, \Config::get('constants.modulos.usuariosg')) == false){
            return view('error');
        }else{
            $perfil = TblPerfil::find(\Auth::user()->id_perfil);
            $usuarios = \DB::table('users')
                ->select('users.*')
                ->leftJoin('tbl_perfis','users.id_perfil','=','tbl_perfis.id')
                ->where('tbl_perfis.id_igreja','=',$perfil->id_igreja)
                ->get();
            return DataTables::of($usuarios)->addColumn('action',function($usuarios){
                $btn_editar = '';
                if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.usuariosg'), \Config::get('constants.permissoes.alterar'))[2] == true){
                    $btn_editar = '<a href="'.route('usuario.editarUsuario',['id'=>$usuarios->id]).'" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>';
                }
                $btn_excluir = '';
                if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.usuariosg'), \Config::get('constants.permissoes.desativar'))[2] == true){
                    $btn_excluir = '<label title="Status do Usuário" class="switch"><input onClick="switch_status(this)" name="'.$usuarios->nome.'" class="status" id="'.$usuarios->id.'" type="checkbox" '.(($usuarios->status == 1) ? "checked" : "").'><span class="slider"></span></label>';
                }
                return $btn_editar.'&nbsp'.$btn_excluir;
            })->editColumn('created_at', function($usuarios) {
                if($usuarios->created_at != null)
                    return Carbon::parse($usuarios->created_at)->format('d/m/Y');
                else
                    return null;
            })->editColumn('updated_at', function($usuarios) {
                if($usuarios->updated_at != null){
                    $upd = Carbon::parse($usuarios->updated_at)->diffForHumans();
                    return $upd;
                }else
                    return null;
            })->addColumn('perfil',function($usuarios){
                return (TblPerfil::find($usuarios->id_perfil))->nome;
            })->addColumn('situacao',function($usuarios){
                if(\Cache::has('user-is-online-'.$usuarios->id)){
                    return "<span class='label bg-green'>Online</span>";
                }else{
                    return "<span class='label bg-red'>Offline</span>";
                }
            })
            ->rawColumns(['perfil', 'situacao', 'action'])->make(true);
        }
    }

    public function switchStatusUsuario(Request $request){
        if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.usuariosg'), \Config::get('constants.permissoes.desativar'))[2] == true){
            $usuario = User::find($request->id);
            ($usuario->status == 1) ? $usuario->status = 0 : $usuario->status = 1 ;
            $usuario->save();
        }else{ return view('error'); }
    }

    public function incluirUsuario(Request $request){
        if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.usuariosg'), \Config::get('constants.permissoes.incluir'))[2] == true){
            $usuario = new User();
            $usuario->nome = $request->nome;
            $usuario->email = $request->email;
            $usuario->id_perfil = $request->perfil;
            if($request->membro > 0){
                $usuario->id_membro = $request->membro;
                $membro = TblMembros::find($request->membro);
                $usuario->nome = $membro->nome;
            }else if($request->membro == 0){
                $usuario->id_membro = null;
            }
            
            $count = \DB::table('users')
                ->select('users.email')
                ->where('users.id','<>',$usuario->id)
                ->where('users.email','=',$usuario->email)
                ->count();
            if($count == 0){
                if(!empty($request->senha) && $request->senha == $request->senhac){
                    $usuario->password = bcrypt($request->senha);

                    $usuario->save();

                    $notification = array(
                        'message' => 'Usuário ' . $usuario->nome . ' foi incluído(a) com sucesso!', 
                        'alert-type' => 'success'
                    );

                    return redirect()->route('usuario.usuarios')->with($notification);
                }else{
                    $notification = array(
                        'message' => 'Falha na confirmação das senhas.', 
                        'alert-type' => 'error'
                    );

                    return redirect()->back()->with($notification);
                }
            }else{
                $notification = array(
                    'message' => 'Esse email já está sendo utilizado.', 
                    'alert-type' => 'error'
                );

                return redirect()->back()->with($notification);
            }
        }else{ return view('error'); }
    }

    public function editarUsuario($id){
        if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.usuariosg'), \Config::get('constants.permissoes.alterar'))[2] == true){
            $usuario = User::find($id);
            $perfil = TblPerfil::find(\Auth::user()->id_perfil);
            $igreja = obter_dados_igreja_id($perfil->id_igreja);
            $modulos_igreja = obter_modulos_gerenciais_igreja($igreja);
            return view('usuario.editarusuario', compact('usuario','igreja','modulos_igreja'));
        }else{ return view('error'); }
    }

    public function atualizarUsuario(Request $request){
        if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.usuariosg'), \Config::get('constants.permissoes.alterar'))[2] == true){
            $usuario = User::find($request->id);
            $usuario->nome = $request->nome;
            $usuario->email = $request->email;
            $usuario->id_perfil = $request->perfil;
            if($request->membro > 0){
                $usuario->id_membro = $request->membro;
                $membro = TblMembros::find($request->membro);
                $usuario->nome = $membro->nome;
            }else if($request->membro == 0){
                $usuario->id_membro = null;
            }
            
            $count = \DB::table('users')
                ->select('users.email')
                ->where('users.id','<>',$usuario->id)
                ->where('users.email','=',$usuario->email)
                ->count();
            if($count == 0){
                if(empty($request->senha) || $request->senha == $request->senhac){
                    if(!empty($request->senha)) $usuario->password = bcrypt($request->senha);

                    $usuario->save();

                    $notification = array(
                        'message' => 'Usuário ' . $usuario->nome . ' foi aletrado(a) com sucesso!', 
                        'alert-type' => 'success'
                    );

                    return redirect()->route('usuario.usuarios')->with($notification);
                }else{
                    $notification = array(
                        'message' => 'Falha na confirmação das senhas.', 
                        'alert-type' => 'error'
                    );

                    return redirect()->back()->with($notification);
                }
            }else{
                $notification = array(
                    'message' => 'Esse email já está sendo utilizado.', 
                    'alert-type' => 'error'
                );

                return redirect()->back()->with($notification);
            }
        }else{ return view('error'); }
    }

    /*public function excluirUsuario(){
        if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.usuariosg'), \Config::get('constants.permissoes.desativar'))[2] == true){

        }else{ return view('error'); }
    }*/
    ////////////////////////////////////////////////////////////////////////////////

    // PERFIS AREA !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    public function perfis(){
        if( valida_modulo(\Auth::user()->id_perfil, \Config::get('constants.modulos.perfisg')) == false){
            return view('error');
        }else{
            $perfil = TblPerfil::find(\Auth::user()->id_perfil);
            $igreja = obter_dados_igreja_id($perfil->id_igreja);
            $modulos_igreja = obter_modulos_apresentativos_igreja($igreja);
            return view('usuario.perfis', compact('igreja','modulos_igreja'));
        }
    }

    public function tbl_perfis(){
        if( valida_modulo(\Auth::user()->id_perfil, \Config::get('constants.modulos.perfisg')) == false){
            return view('error');
        }else{
            $perfil = TblPerfil::find(\Auth::user()->id_perfil);
            $perfis = TblPerfil::where('id_igreja','=',$perfil->id_igreja)->get();
            return DataTables::of($perfis)->addColumn('action',function($perfis){
                $btn_editar = '';
                if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.perfisg'), \Config::get('constants.permissoes.alterar'))[2] == true){
                    $btn_editar = '<a href="'.route('usuario.editarPerfil',['id'=>$perfis->id]).'" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>'.'&nbsp'.
                    '<a href="'.route('perfis.carregarPermissoesPerfil',['id'=>$perfis->id]).'" class="btn btn-xs btn-warning"><i class="fa fa-cog"></i></button></a>';
                }
                $btn_excluir = '';
                if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.perfisg'), \Config::get('constants.permissoes.desativar'))[2] == true){
                    $btn_excluir = '<label title="Status do Perfil" class="switch"><input onClick="switch_status(this)" name="'.$perfis->nome.'" class="status" id="'.$perfis->id.'" type="checkbox" '.(($perfis->status == 1) ? "checked" : "").'><span class="slider"></span></label>';
                }
                return $btn_editar.'&nbsp'.$btn_excluir;
            })->editColumn('created_at', function($perfis) {
                if($perfis->created_at != null)
                    return Carbon::parse($perfis->created_at)->format('d/m/Y');
                else
                    return null;
            })->editColumn('updated_at', function($perfis) {
                if($perfis->updated_at != null){
                    $upd = Carbon::parse($perfis->updated_at)->diffForHumans();
                    return $upd;
                }else
                    return null;
            })
            ->make(true);
        }
    }

    public function switchStatusPerfil(Request $request){
        if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.perfisg'), \Config::get('constants.permissoes.desativar'))[2] == true){
            $perfil = TblPerfil::find($request->id);
            ($perfil->status == 1) ? $perfil->status = 0 : $perfil->status = 1 ;
            $perfil->save();
        }else{ return view('error'); }
    }

    public function incluirPerfil(Request $request){
        if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.perfisg'), \Config::get('constants.permissoes.incluir'))[2] == true){
            $perfil = new TblPerfil();
            $perfil->nome = $request->nome;
            $perfil->descricao = $request->descricao;
            $perfil->id_igreja = $request->igreja;

            $count = TblPerfil::where("nome", "=", $perfil->nome)->where("id_igreja", "=", $perfil->id_igreja)->count();
            if($count == 0){
                $perfil->save();
                $perfil_modulo = new TblPerfisIgrejasModulos();

                foreach ($request->modulos as $key => $value) {
                    $modulo_igreja = TblIgrejasModulos::where('id_modulo', '=', $value)->where('id_igreja', '=', $perfil->id_igreja)->get();
                    $modulo_igreja = $modulo_igreja[0];

                    $data = [
                        'id_perfil' => $perfil->id,
                        'id_modulo_igreja' => $modulo_igreja->id,
                    ];
                    $perfil_modulo->create($data);
                }

                $notification = array(
                    'message' => $perfil->nome . ' foi incluído(a) com sucesso!', 
                    'alert-type' => 'success'
                );

                return redirect()->route('usuario.perfis')->with($notification);
            }else{
                $notification = array(
                    'message' => 'O nome informado já está na base de dados!', 
                    'alert-type' => 'error'
                );

                return back()->with($notification);
            }
        }else{ return view('error'); }
    }

    public function editarPerfil($id){
        if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.perfisg'), \Config::get('constants.permissoes.alterar'))[2] == true){
            $usuario = User::find($id);
            $perfil = TblPerfil::find(\Auth::user()->id_perfil);
            $igreja = obter_dados_igreja_id($perfil->id_igreja);
            $modulos_igreja = obter_modulos_gerenciais_igreja($igreja);
            $perfil = TblPerfil::find($id);
            $modulos = obter_modulos_perfil($perfil);
            return view('usuario.editarperfil', compact('usuario','igreja','modulos_igreja','perfil','modulos'));
        }else{ return view('error'); }
    }

    public function atualizarPerfil(Request $request){
        if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.perfisg'), \Config::get('constants.permissoes.alterar'))[2] == true){
            $perfil = TblPerfil::find($request->id);
            $perfil->nome = $request->nome;
            $perfil->descricao = $request->descricao;

            $count = TblPerfil::where("nome", "=", $perfil->nome)->where("id_igreja", "=", $perfil->id_igreja)->where("id","<>",$perfil->id)->count();
            if($count == 0){
                $perfil->save();

                $permissoes_backup = null;
                $cp = 0;

                $modulos_do_perfil = TblPerfisIgrejasModulos::where("id_perfil","=",$perfil->id)->get();
                if(count($modulos_do_perfil) > 0) foreach($modulos_do_perfil as $modulo_perfil){
                    $permissoes_perfil = TblPerfisPermissoes::where("id_perfil_igreja_modulo","=",$modulo_perfil->id)->get();
                    foreach($permissoes_perfil as $permisssao_perfil){
                        $permissoes_backup[$modulo_perfil->id_modulo_igreja][$cp] = $permisssao_perfil->id_permissao;
                        $cp++;
                    }
                    $cp = 0;

                    TblPerfisPermissoes::where("id_perfil_igreja_modulo","=",$modulo_perfil->id)->delete();
                }
                TblPerfisIgrejasModulos::where("id_perfil","=",$perfil->id)->delete();

                foreach ($request->modulos as $key => $value) {
                    $perfil_modulo = new TblPerfisIgrejasModulos();

                    $modulo_igreja = TblIgrejasModulos::where('id_modulo', '=', $value)->where('id_igreja', '=', $perfil->id_igreja)->get();
                    $modulo_igreja = $modulo_igreja[0];

                    $perfil_modulo->id_perfil = $perfil->id;
                    $perfil_modulo->id_modulo_igreja = $modulo_igreja->id;
                    $perfil_modulo->save();

                    if(isset($permissoes_backup[$modulo_igreja->id])) foreach($permissoes_backup[$modulo_igreja->id] as $permissao_preservada_id){
                        $permissao_nova = new TblPerfisPermissoes();
                        $permissao_nova->id_perfil_igreja_modulo = $perfil_modulo->id;
                        $permissao_nova->id_permissao = $permissao_preservada_id;
                        $permissao_nova->save();
                    }
                }

                $notification = array(
                    'message' => $perfil->nome . ' foi incluído(a) com sucesso!', 
                    'alert-type' => 'success'
                );

                return redirect()->route('usuario.perfis')->with($notification);
            }else{
                $notification = array(
                    'message' => 'O nome informado já está na base de dados!', 
                    'alert-type' => 'error'
                );

                return back()->with($notification);
            }
        }else{ return view('error'); }
    }

    public function carregarPermissoesPerfil($id){
        if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.perfisg'), \Config::get('constants.permissoes.alterar'))[2] == true){
            $perfil = TblPerfil::find(\Auth::user()->id_perfil);
            $igreja = obter_dados_igreja_id($perfil->id_igreja);
            $modulos_igreja = obter_modulos_apresentativos_igreja($igreja);
            $perfil = \DB::table('tbl_perfis')
                ->select('tbl_perfis.*')
                ->where('tbl_perfis.id','=',$id)
                ->get();
            $perfil = $perfil[0];
            $modulos = \DB::table('tbl_modulos')
                ->select('tbl_modulos.*', 'tbl_perfis_igrejas_modulos.id as id_perfis_igrejas_modulos')
                ->leftJoin('tbl_igrejas_modulos', 'tbl_modulos.id', '=', 'tbl_igrejas_modulos.id_modulo')
                ->leftJoin('tbl_perfis_igrejas_modulos', 'tbl_igrejas_modulos.id', '=', 'tbl_perfis_igrejas_modulos.id_modulo_igreja')
                ->leftJoin('tbl_perfis', 'tbl_perfis_igrejas_modulos.id_perfil', '=', 'tbl_perfis.id')
                ->where('tbl_perfis.id','=',$id)
                //->groupBy('tbl_modulos.id')
                ->orderBy('nome', 'ASC')
                ->get();
            $permissoes = array();
            foreach($modulos as $modulo){
                $permissoes_ativas = \DB::table('tbl_permissoes')
                    ->select('tbl_permissoes.*')
                    ->leftJoin('tbl_perfis_permissoes', 'tbl_permissoes.id', '=', 'tbl_perfis_permissoes.id_permissao')
                    ->leftJoin('tbl_perfis_igrejas_modulos', 'tbl_perfis_permissoes.id_perfil_igreja_modulo', '=', 'tbl_perfis_igrejas_modulos.id')
                    ->leftJoin('tbl_igrejas_modulos', 'tbl_perfis_igrejas_modulos.id_modulo_igreja', '=', 'tbl_igrejas_modulos.id')
                    ->where('tbl_igrejas_modulos.id_modulo','=',$modulo->id)
                    ->where('tbl_perfis_igrejas_modulos.id_perfil','=',$id)
                    ->get();
                $permissoes[$modulo->id]['ativas'] = $permissoes_ativas;
                $permissoes_todas = \DB::table('tbl_permissoes')
                    ->select('tbl_permissoes.*')
                    ->leftJoin('tbl_modulos_permissoes', 'tbl_modulos_permissoes.id_permissao', '=', 'tbl_permissoes.id')
                    ->leftJoin('tbl_modulos', 'tbl_modulos.id', '=', 'tbl_modulos_permissoes.id_modulo')
                    ->where('tbl_modulos.id','=',$modulo->id)
                    ->orderBy('nome', 'ASC')
                    ->get();
                $permissoes[$modulo->id]['todas'] = $permissoes_todas;
            }
            return view('usuario.permissoesperfil', compact('igreja','modulos_igreja','perfil','modulos','permissoes'));
        }else{ return view('error'); }
    }

    public function atualizarPermissoesPerfil(Request $request){
        if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.perfisg'), \Config::get('constants.permissoes.alterar'))[2] == true){
            unset($request["_token"]);
            $id_perfil = $request["id_perfil"];
            unset($request["id_perfil"]);
            foreach ($request->all() as $id_perfil_modulo_igreja => $permissao) {
                TblPerfisPermissoes::where('id_perfil_igreja_modulo', '=', $id_perfil_modulo_igreja)->delete();
                foreach($permissao as $posicao => $id_permissao){
                    $perfil_permissao = new TblPerfisPermissoes();

                    $data = [
                        'id_perfil_igreja_modulo' => $id_perfil_modulo_igreja,
                        'id_permissao' => $id_permissao,
                    ];

                    $perfil_permissao->create($data);
                }
            }

            $perfil = \DB::table('tbl_perfis')
                ->select('tbl_perfis.*')
                ->where('tbl_perfis.id','=',$id_perfil)
                ->get();
            $perfil = $perfil[0];

            $notification = array(
                'message' => $perfil->nome . ' teve suas permissões alteradas!', 
                'alert-type' => 'success'
            );

            return redirect()->route('usuario.perfis')->with($notification);
        }else{ return view('error'); }
    }

    /*public function excluirPerfil(){
        if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.perfisg'), \Config::get('constants.permissoes.desativar'))[2] == true){
            
        }else{ return view('error'); }
    }*/
    ////////////////////////////////////////////////////////////////////////////////

    // FUNÇÕES AREA !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    public function funcoes()
    {
        if( valida_modulo(\Auth::user()->id_perfil, \Config::get('constants.modulos.funcoesg')) == false){
            return view('error');
        }else{
            $perfil = TblPerfil::find(\Auth::user()->id_perfil);
            $igreja = obter_dados_igreja_id($perfil->id_igreja);
            $modulos_igreja = obter_modulos_gerenciais_igreja($igreja);
            return view('usuario.funcoes', compact('igreja','modulos_igreja'));
        }
    }

    public function tbl_funcoes(){
        if( valida_modulo(\Auth::user()->id_perfil, \Config::get('constants.modulos.funcoesg')) == false){
            return view('error');
        }else{
            $perfil = TblPerfil::find(\Auth::user()->id_perfil);
            $funcoes = TblFuncoes::where('id_igreja','=',$perfil->id_igreja)->get();
            return DataTables::of($funcoes)->addColumn('action',function($funcoes){
                $btn_editar = '';
                if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.funcoesg'), \Config::get('constants.permissoes.alterar'))[2] == true){
                    $btn_editar = '<a href="'.route('usuario.editarFuncao',['id'=>$funcoes->id]).'" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>';
                }
                $btn_excluir = '';
                if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.funcoesg'), \Config::get('constants.permissoes.desativar'))[2] == true){
                    $btn_excluir = '<a href="'.route('usuario.excluirFuncao',['id'=>$funcoes->id]).'" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>';
                }
                return $btn_editar.'&nbsp'.$btn_excluir;
            })->editColumn('created_at', function($funcoes) {
                if($funcoes->created_at != null)
                    return Carbon::parse($funcoes->created_at)->format('d/m/Y');
                else
                    return null;
            })->editColumn('updated_at', function($funcoes) {
                if($funcoes->updated_at != null){
                    $upd = Carbon::parse($funcoes->updated_at)->diffForHumans();
                    return $upd;
                }else
                    return null;
            })->editColumn('apresentar', function($funcoes) {
                if($funcoes->apresentar){
                    return "<span class='label bg-green'>Sim</span>";
                }else
                    return "<span class='label bg-red'>Não</span>";
            })
            ->rawColumns(['apresentar', 'action'])->make(true);
        }
    }

    public function incluirFuncao(Request $request){
        if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.funcoesg'), \Config::get('constants.permissoes.incluir'))[2] == true){
            $funcao = new TblFuncoes();
            $funcao->id_igreja = $request->igreja;
            $funcao->nome = $request->nome;
            $funcao->descricao = $request->descricao;
            if($request->apresentar) $funcao->apresentar = true;
            $funcao->save();

            $notification = array(
                'message' => 'Função "' . $funcao->nome . '" foi adicionada com sucesso!', 
                'alert-type' => 'success'
            );

            return redirect()->route('usuario.funcoes')->with($notification);
        }else{ return view('error'); }
    }

    public function editarFuncao($id){
        if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.funcoesg'), \Config::get('constants.permissoes.alterar'))[2] == true){
            $funcao = TblFuncoes::find($id);
            $perfil = TblPerfil::find(\Auth::user()->id_perfil);
            $igreja = obter_dados_igreja_id($perfil->id_igreja);
            $modulos_igreja = obter_modulos_gerenciais_igreja($igreja);
            return view('usuario.editarfuncao', compact('funcao','igreja','modulos_igreja'));
        }else{ return view('error'); }
    }

    public function atualizarFuncao(Request $request){
        if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.funcoesg'), \Config::get('constants.permissoes.alterar'))[2] == true){
            $funcao = TblFuncoes::find($request->id);
            $funcao->nome = $request->nome;
            $funcao->descricao = $request->descricao;
            if($request->apresentar) $funcao->apresentar = true;
            else $funcao->apresentar = false;
            $funcao->save();
            
            $notification = array(
                'message' => 'Função "' . $funcao->nome . '" foi alterada com sucesso!', 
                'alert-type' => 'success'
            );

            return redirect()->route('usuario.funcoes')->with($notification);
        }else{ return view('error'); }
    }

    public function excluirFuncao($id){
        if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.funcoesg'), \Config::get('constants.permissoes.desativar'))[2] == true){
            
            TblMembros::where('id_funcao', $id)->update(['id_funcao' => null]);

            $funcao = TblFuncoes::find($id);
            $funcao->delete();
            $notification = array(
                'message' => 'Função "' . $funcao->nome . '" foi excluída com sucesso!', 
                'alert-type' => 'success'
            );

            return redirect()->route('usuario.funcoes')->with($notification);
        }else{ return view('error'); }
    }
    ////////////////////////////////////////////////////////////////////////////////

    // MEMBROS AREA !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    public function membros()
    {
        if( valida_modulo(\Auth::user()->id_perfil, \Config::get('constants.modulos.membrosg')) == false){
            return view('error');
        }else{
            $perfil = TblPerfil::find(\Auth::user()->id_perfil);
            $igreja = obter_dados_igreja_id($perfil->id_igreja);
            $modulos_igreja = obter_modulos_gerenciais_igreja($igreja);
            return view('usuario.membros', compact('igreja','modulos_igreja'));
        }
    }

    public function tbl_membros(){
        if( valida_modulo(\Auth::user()->id_perfil, \Config::get('constants.modulos.membrosg')) == false){
            return view('error');
        }else{
            $perfil = TblPerfil::find(\Auth::user()->id_perfil);
            $membros = TblMembros::where('id_igreja','=',$perfil->id_igreja)->get();
            return DataTables::of($membros)->addColumn('action',function($membros){
                $btn_editar = '';
                if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.membrosg'), \Config::get('constants.permissoes.alterar'))[2] == true){
                    $btn_editar = '<a href="'.route('usuario.editarMembro',['id'=>$membros->id]).'" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>';
                }
                $btn_excluir = '';
                if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.membrosg'), \Config::get('constants.permissoes.desativar'))[2] == true){
                    $btn_excluir = '<a href="'.route('usuario.excluirMembro',['id'=>$membros->id]).'" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>';
                }
                $btn_destivar = '';
                if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.membrosg'), \Config::get('constants.permissoes.desativar'))[2] == true){
                    $btn_destivar = '<label title="Status do Membro" class="switch"><input onClick="switch_status(this)" name="'.$membros->nome.'" class="status" id="'.$membros->id.'" type="checkbox" '.(($membros->ativo == 1) ? "checked" : "").'><span class="slider"></span></label>';
                }
                return $btn_editar.'&nbsp'.$btn_excluir.'&nbsp'.$btn_destivar;
            })->editColumn('created_at', function($membros) {
                if($membros->created_at != null)
                    return Carbon::parse($membros->created_at)->format('d/m/Y');
                else
                    return null;
            })->editColumn('updated_at', function($membros) {
                if($membros->updated_at != null){
                    $upd = Carbon::parse($membros->updated_at)->diffForHumans();
                    return $upd;
                }else
                    return null;
            })->addColumn('funcao',function($membros){
                $funcao = ($membros->id_funcao != null) ? TblFuncoes::find($membros->id_funcao) : null;
                if($funcao != null){
                    return "<span class='label bg-green'>".$funcao->nome."</span>";
                }else{
                    return "<span class='label bg-red'>Não possuí.</span>";
                }
            })
            ->rawColumns(['funcao', 'action'])->make(true);
        }
    }

    public function switchStatusMembro(Request $request){
        if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.membrosg'), \Config::get('constants.permissoes.desativar'))[2] == true){
            $membro = TblMembros::find($request->id);
            TblMembrosComunidades::where('id_membro','=', $membro->id)->update(['ativo' => false]);
            ($membro->ativo == 1) ? $membro->ativo = 0 : $membro->ativo = 1 ;
            $membro->save();
        }else{ return view('error'); }
    }

    public function incluirMembro(Request $request){
        if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.membrosg'), \Config::get('constants.permissoes.incluir'))[2] == true){
            $membro = new TblMembros();
            $membro->id_igreja = $request->igreja;
            $membro->nome = $request->nome;
            if($request->funcao > 0) $membro->id_funcao = $request->funcao;
            else $membro->id_funcao = null;
            $membro->cep = $request->cep;
            $membro->num = $request->num;
            $membro->bairro = $request->bairro;
            $membro->cidade = $request->cidade;
            $membro->estado = $request->estado;
            $membro->complemento = $request->complemento;
            $membro->facebook = $request->facebook;
            $membro->twitter = $request->twitter;
            $membro->youtube = $request->youtube;
            $membro->descricao = $request->descricao;
            $membro->save();

            if($request->foto){
                $f_ = $request->foto;
                $membro->foto = file_get_contents($request->foto);
                $membro->save();
            }

            $notification = array(
                'message' => 'Membro "' . $membro->nome . '" foi adicionado com sucesso!', 
                'alert-type' => 'success'
            );

            return redirect()->route('usuario.membros')->with($notification);
        }else{ return view('error'); }
    }

    public function editarMembro($id){
        if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.membrosg'), \Config::get('constants.permissoes.alterar'))[2] == true){
            $membro = TblMembros::find($id);
            $perfil = TblPerfil::find(\Auth::user()->id_perfil);
            $igreja = obter_dados_igreja_id($perfil->id_igreja);
            $modulos_igreja = obter_modulos_gerenciais_igreja($igreja);
            return view('usuario.editarmembro', compact('membro','igreja','modulos_igreja'));
        }else{ return view('error'); }
    }

    public function atualizarMembro(Request $request){
        if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.membrosg'), \Config::get('constants.permissoes.alterar'))[2] == true){
            $membro = TblMembros::find($request->id);
            $membro->nome = $request->nome;
            if($request->funcao > 0) $membro->id_funcao = $request->funcao;
            else $membro->id_funcao = null;
            $membro->cep = $request->cep;
            $membro->num = $request->num;
            $membro->bairro = $request->bairro;
            $membro->cidade = $request->cidade;
            $membro->estado = $request->estado;
            $membro->complemento = $request->complemento;
            $membro->facebook = $request->facebook;
            $membro->twitter = $request->twitter;
            $membro->youtube = $request->youtube;
            $membro->descricao = $request->descricao;
            $membro->save();

            if($request->foto){
                $membro->foto = $membro->foto = file_get_contents($request->foto);
                $membro->save();
            }
            
            $notification = array(
                'message' => 'Membro "' . $membro->nome . '" foi alterado com sucesso!', 
                'alert-type' => 'success'
            );

            return redirect()->route('usuario.membros')->with($notification);
        }else{ return view('error'); }
    }

    public function excluirMembro($id){
        if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.membrosg'), \Config::get('constants.permissoes.desativar'))[2] == true){
            
            User::where('id_membro', $id)->update(['id_membro' => null]);

            $membro = TblMembros::find($id);
            $foto = $membro->foto;
            $membro->delete();
            if($foto != null) File::delete(public_path().'/storage/membros/'.$foto);
            
            $notification = array(
                'message' => 'Membro ' . $membro->nome . ' foi excluído com sucesso!', 
                'alert-type' => 'success'
            );

            return redirect()->route('usuario.membros')->with($notification);
        }else{ return view('error'); }
    }

    public function excluirFotoMembro(Request $request){
        if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.membrosg'), \Config::get('constants.permissoes.desativar'))[2] == true){
            $banner = TblMembros::find($request->id);
            $banner->foto = null;
            $banner->save();
            return \Response::json(['message' => 'File successfully delete'], 200);
        }else{ return view('error'); }
    }
    ////////////////////////////////////////////////////////////////////////////////

    // PRODUTOS AREA !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    public function produtos()
    {
        if( valida_modulo(\Auth::user()->id_perfil, \Config::get('constants.modulos.carrinhog')) == false){
            return view('error');
        }else{
            $perfil = TblPerfil::find(\Auth::user()->id_perfil);
            $igreja = obter_dados_igreja_id($perfil->id_igreja);
            $modulos_igreja = obter_modulos_gerenciais_igreja($igreja);
            return view('usuario.produtos', compact('igreja','modulos_igreja'));
        }
    }

    public function tbl_produtos(){
        if( valida_modulo(\Auth::user()->id_perfil, \Config::get('constants.modulos.carrinhog')) == false){
            return view('error');
        }else{
            $perfil = TblPerfil::find(\Auth::user()->id_perfil);
            $produto = TblProdutos::where('id_igreja','=',$perfil->id_igreja)->get();
            return DataTables::of($produto)->addColumn('action',function($produto){
                $btn_editar = '';
                if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.carrinhog'), \Config::get('constants.permissoes.alterar'))[2] == true){
                    $btn_editar = '<a href="'.route('usuario.editarProduto',['id'=>$produto->id]).'" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>';
                }
                $btn_excluir = '';
                if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.carrinhog'), \Config::get('constants.permissoes.desativar'))[2] == true){
                    $btn_excluir = '<a href="'.route('usuario.excluirProduto',['id'=>$produto->id]).'" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>';
                }
                return $btn_editar.'&nbsp'.$btn_excluir;
            })->addColumn('categoria',function($produto){
                $categoria = TblCategoriasProdutos::find($produto->id_categoria);
                return $categoria->nome;
            })->addColumn('tipo',function($produto){
                $tipo = TblTiposVendas::find($produto->id_tipo_venda);
                return $tipo->nome;
            })->addColumn('situacao',function($produto){
                if($produto->situacao == true) return "<span class='label bg-green'>Em venda</span>";
                else return "<span class='label bg-red'>Bloqueado</span>";
            })->editColumn('created_at', function($produto) {
                if($produto->created_at != null)
                    return Carbon::parse($produto->created_at)->format('d/m/Y');
                else
                    return null;
            })->editColumn('updated_at', function($produto) {
                if($produto->updated_at != null){
                    $upd = Carbon::parse($produto->updated_at)->diffForHumans();
                    return $upd;
                }else
                    return null;
            })
            ->rawColumns(['categoria', 'tipo', 'situacao', 'action'])->make(true);
        }
    }

    public function incluirProduto(Request $request){
        if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.carrinhog'), \Config::get('constants.permissoes.incluir'))[2] == true){
            $produto = new TblProdutos();
            $produto->id_igreja = $request->igreja;
            $produto->nome = $request->nome;
            $produto->valor = $request->valor;
            $produto->descricao = $request->descricao;
            $produto->id_categoria = $request->categoria;
            $produto->id_tipo_venda = $request->tipo;
            $produto->situacao = false;
            if(isset($request->situacao)){
                $produto->situacao = true;
            }
            $produto->save();

            if($request->icone){
                $produto->icone = file_get_contents($request->icone);
                $produto->save();
            }

            if($request->fotos) foreach($request->fotos as $f_){
                $foto = new TblProdutosFotos();
                $foto->id_produto = $produto->id;
                $foto->foto = file_get_contents($f_);
                $foto->save();
            }

            $notification = array(
                'message' => 'Produto "' . $produto->nome . '" foi adicionada com sucesso!', 
                'alert-type' => 'success'
            );

            return redirect()->route('usuario.produtos')->with($notification);
        }else{ return view('error'); }
    }

    public function editarProduto($id){
        if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.carrinhog'), \Config::get('constants.permissoes.alterar'))[2] == true){
            $produto = TblProdutos::find($id);
            $fotos = TblProdutosFotos::where('id_produto','=',$id)->get();
            $perfil = TblPerfil::find(\Auth::user()->id_perfil);
            $igreja = obter_dados_igreja_id($perfil->id_igreja);
            $modulos_igreja = obter_modulos_gerenciais_igreja($igreja);
            return view('usuario.editarProduto', compact('produto','fotos','igreja','modulos_igreja'));
        }else{ return view('error'); }
    }

    public function atualizarProduto(Request $request){
        if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.carrinhog'), \Config::get('constants.permissoes.alterar'))[2] == true){
            $produto = TblProdutos::find($request->id);
            $produto->nome = $request->nome;
            $produto->valor = $request->valor;
            $produto->descricao = $request->descricao;
            $produto->id_categoria = $request->categoria;
            $produto->id_tipo_venda = $request->tipo;
            $produto->situacao = false;
            if(isset($request->situacao)){
                $produto->situacao = true;
            }
            $produto->save();

            if($request->icone){
                $produto->icone = file_get_contents($request->icone);
                $produto->save();
            }

            if($request->fotos) foreach($request->fotos as $f_){
                $foto = new TblProdutosFotos();
                $foto->id_produto = $produto->id;
                $foto->foto = file_get_contents($f_);
                $foto->save();
            }

            $notification = array(
                'message' => 'Produto "' . $produto->nome . '" foi atualizada com sucesso!', 
                'alert-type' => 'success'
            );

            return redirect()->route('usuario.produtos')->with($notification);
        }else{ return view('error'); }
    }

    public function excluirProduto($id){
        if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.carrinhog'), \Config::get('constants.permissoes.desativar'))[2] == true){
            $produto = TblProdutos::find($id);
            $produto->delete();

            $notification = array(
                'message' => 'Produto "' . $produto->nome . '" foi excluída com sucesso!', 
                'alert-type' => 'success'
            );

            return redirect()->route('usuario.produtos')->with($notification);
        }else{ return view('error'); }
    }
    ////////////////////////////////////////////////////////////////////////////////

    // CATEGORIAS AREA !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    public function categorias()
    {
        if( valida_modulo(\Auth::user()->id_perfil, \Config::get('constants.modulos.carrinhog')) == false){
            return view('error');
        }else{
            $perfil = TblPerfil::find(\Auth::user()->id_perfil);
            $igreja = obter_dados_igreja_id($perfil->id_igreja);
            $modulos_igreja = obter_modulos_gerenciais_igreja($igreja);
            return view('usuario.categorias', compact('igreja','modulos_igreja'));
        }
    }

    public function tbl_categorias(){
        if( valida_modulo(\Auth::user()->id_perfil, \Config::get('constants.modulos.carrinhog')) == false){
            return view('error');
        }else{
            $perfil = TblPerfil::find(\Auth::user()->id_perfil);
            $categoria = TblCategoriasProdutos::where('id_igreja','=',$perfil->id_igreja)->get();
            return DataTables::of($categoria)->addColumn('action',function($categoria){
                $btn_editar = '';
                if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.carrinhog'), \Config::get('constants.permissoes.alterar'))[2] == true){
                    $btn_editar = '<a href="'.route('usuario.editarCategoria',['id'=>$categoria->id]).'" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>';
                }
                $btn_excluir = '';
                if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.carrinhog'), \Config::get('constants.permissoes.desativar'))[2] == true){
                    $btn_excluir = '<a href="'.route('usuario.excluirCategoria',['id'=>$categoria->id]).'" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>';
                }
                return $btn_editar.'&nbsp'.$btn_excluir;
            })->editColumn('created_at', function($categoria) {
                if($categoria->created_at != null)
                    return Carbon::parse($categoria->created_at)->format('d/m/Y');
                else
                    return null;
            })->editColumn('updated_at', function($categoria) {
                if($categoria->updated_at != null){
                    $upd = Carbon::parse($categoria->updated_at)->diffForHumans();
                    return $upd;
                }else
                    return null;
            })
            ->make(true);
        }
    }

    public function incluirCategoria(Request $request){
        if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.carrinhog'), \Config::get('constants.permissoes.incluir'))[2] == true){
            $categoria = new TblCategoriasProdutos();
            $categoria->id_igreja = $request->igreja;
            $categoria->nome = $request->nome;
            $categoria->descricao = $request->descricao;
            $categoria->save();

            $notification = array(
                'message' => 'Categoria "' . $categoria->nome . '" foi adicionada com sucesso!', 
                'alert-type' => 'success'
            );

            return redirect()->route('usuario.categorias')->with($notification);
        }else{ return view('error'); }
    }

    public function editarCategoria($id){
        if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.carrinhog'), \Config::get('constants.permissoes.alterar'))[2] == true){
            $categoria = TblCategoriasProdutos::find($id);
            $perfil = TblPerfil::find(\Auth::user()->id_perfil);
            $igreja = obter_dados_igreja_id($perfil->id_igreja);
            $modulos_igreja = obter_modulos_gerenciais_igreja($igreja);
            return view('usuario.editarcategoria', compact('categoria','igreja','modulos_igreja'));
        }else{ return view('error'); }
    }

    public function atualizarCategoria(Request $request){
        if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.carrinhog'), \Config::get('constants.permissoes.alterar'))[2] == true){
            $categoria = TblCategoriasProdutos::find($request->id);
            $categoria->nome = $request->nome;
            $categoria->descricao = $request->descricao;
            $categoria->save();

            $notification = array(
                'message' => 'Categoria "' . $categoria->nome . '" foi atualizada com sucesso!', 
                'alert-type' => 'success'
            );

            return redirect()->route('usuario.categorias')->with($notification);
        }else{ return view('error'); }
    }

    public function excluirCategoria($id){
        if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.carrinhog'), \Config::get('constants.permissoes.desativar'))[2] == true){
            $categoria = TblCategoriasProdutos::find($id);
            $categoria->delete();

            $notification = array(
                'message' => 'Categoria "' . $categoria->nome . '" foi excluída com sucesso!', 
                'alert-type' => 'success'
            );

            return redirect()->route('usuario.categorias')->with($notification);
        }else{ return view('error'); }
    }
    ////////////////////////////////////////////////////////////////////////////////

    // OFERTAS AREA !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    public function ofertas()
    {
        if( valida_modulo(\Auth::user()->id_perfil, \Config::get('constants.modulos.carrinhog')) == false){
            return view('error');
        }else{
            $perfil = TblPerfil::find(\Auth::user()->id_perfil);
            $igreja = obter_dados_igreja_id($perfil->id_igreja);
            $modulos_igreja = obter_modulos_gerenciais_igreja($igreja);
            return view('usuario.ofertas', compact('igreja','modulos_igreja'));
        }
    }

    public function tbl_ofertas(){
        if( valida_modulo(\Auth::user()->id_perfil, \Config::get('constants.modulos.carrinhog')) == false){
            return view('error');
        }else{
            $perfil = TblPerfil::find(\Auth::user()->id_perfil);
            $oferta = TblOfertasProdutos::where('id_igreja','=',$perfil->id_igreja)->get();
            return DataTables::of($oferta)->addColumn('action',function($oferta){
                $btn_editar = '';
                if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.carrinhog'), \Config::get('constants.permissoes.alterar'))[2] == true){
                    $btn_editar = '<a href="'.route('usuario.editarOferta',['id'=>$oferta->id]).'" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>';
                }
                $btn_excluir = '';
                if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.carrinhog'), \Config::get('constants.permissoes.desativar'))[2] == true){
                    $btn_excluir = '<a href="'.route('usuario.excluirOferta',['id'=>$oferta->id]).'" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>';
                }
                return $btn_editar.'&nbsp'.$btn_excluir;
            })->addColumn('produto', function($oferta) {
                $produto = TblProdutos::find($oferta->id_produto);
                return $produto->nome;
            })->editColumn('data_inicio', function($oferta) {
                if($oferta->data_inicio != null)
                    return Carbon::parse($oferta->data_inicio)->format('d/m/Y');
                else
                    return null;
            })->editColumn('data_fim', function($oferta) {
                if($oferta->data_fim != null){
                    $upd = Carbon::parse($oferta->data_fim)->format('d/m/Y');
                    return $upd;
                }else
                    return null;
            })
            ->make(true);
        }
    }

    public function incluirOferta(Request $request){
        if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.carrinhog'), \Config::get('constants.permissoes.incluir'))[2] == true){
            $oferta = new TblOfertasProdutos();
            $oferta->id_igreja = $request->igreja;
            $oferta->desconto = $request->desconto;
            $oferta->id_produto = $request->produto;
            $oferta->data_inicio = muda_data($request->data_inicio);
            $oferta->data_fim = muda_data($request->data_fim);
            $oferta->save();

            $notification = array(
                'message' => 'Oferta foi adicionada com sucesso!', 
                'alert-type' => 'success'
            );

            return redirect()->route('usuario.ofertas')->with($notification);
        }else{ return view('error'); }
    }

    public function editarOferta($id){
        if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.carrinhog'), \Config::get('constants.permissoes.alterar'))[2] == true){
            $oferta = TblOfertasProdutos::find($id);
            $perfil = TblPerfil::find(\Auth::user()->id_perfil);
            $igreja = obter_dados_igreja_id($perfil->id_igreja);
            $modulos_igreja = obter_modulos_gerenciais_igreja($igreja);
            return view('usuario.editaroferta', compact('oferta','igreja','modulos_igreja'));
        }else{ return view('error'); }
    }

    public function atualizarOferta(Request $request){
        if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.carrinhog'), \Config::get('constants.permissoes.alterar'))[2] == true){
            $oferta = TblOfertasProdutos::find($request->id);
            $oferta->desconto = $request->desconto;
            $oferta->id_produto = $request->produto;
            $oferta->data_incio = muda_data($request->data_incio);
            $oferta->data_fim = muda_data($request->data_fim);
            $oferta->save();

            $notification = array(
                'message' => 'Oferta foi atualizada com sucesso!', 
                'alert-type' => 'success'
            );

            return redirect()->route('usuario.ofertas')->with($notification);
        }else{ return view('error'); }
    }

    public function excluirOferta($id){
        if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.carrinhog'), \Config::get('constants.permissoes.desativar'))[2] == true){
            $oferta = TblOfertasProdutos::find($id);
            $oferta->delete();

            $notification = array(
                'message' => 'Oferta foi excluída com sucesso!', 
                'alert-type' => 'success'
            );

            return redirect()->route('usuario.ofertas')->with($notification);
        }else{ return view('error'); }
    }
    ////////////////////////////////////////////////////////////////////////////////

    // VENDAS AREA !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    public function vendas()
    {
        if( valida_modulo(\Auth::user()->id_perfil, \Config::get('constants.modulos.carrinhog')) == false){
            return view('error');
        }else{
            $perfil = TblPerfil::find(\Auth::user()->id_perfil);
            $igreja = obter_dados_igreja_id($perfil->id_igreja);
            $modulos_igreja = obter_modulos_gerenciais_igreja($igreja);
            return view('usuario.vendas', compact('igreja','modulos_igreja'));
        }
    }

    public function tbl_vendas(){
        if( valida_modulo(\Auth::user()->id_perfil, \Config::get('constants.modulos.carrinhog')) == false){
            return view('error');
        }else{
            $perfil = TblPerfil::find(\Auth::user()->id_perfil);
            $venda = TblVendas::where('id_igreja','=',$perfil->id_igreja)->get();
            return DataTables::of($venda)->addColumn('action',function($venda){
                $btn_editar = '';
                if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.carrinhog'), \Config::get('constants.permissoes.alterar'))[2] == true){
                    $btn_editar = '<a href="'.route('usuario.editarVenda',['id'=>$venda->id]).'" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>';
                }
                /*$btn_excluir = '';
                if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.carrinhog'), \Config::get('constants.permissoes.desativar'))[2] == true){
                    $btn_excluir = '<a href="'.route('usuario.excluirVenda',['id'=>$venda->id]).'" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>';
                }*/
                return $btn_editar.'&nbsp'/*.$btn_excluir*/;
            })->addColumn('qtd_produtos',function($venda){
                $qtd_produtos = TblVendasProdutos::where('id_venda','=',$venda->id)->count();
                return $qtd_produtos;
            })->addColumn('turno',function($venda){
                $turno = TblTurnosEntregas::find($venda->id_turno);
                return $turno->nome;
            })->addColumn('situacao',function($venda){
                $situacao = TblSituacoesEntregas::find($venda->id_situacao);
                if($venda->id_situacao == 1){
                    return "<span class='label bg-yellow'>".$situacao->nome."</span>";
                }else if($venda->id_situacao == 2){
                    return "<span class='label bg-red'>".$situacao->nome."</span>";
                }else if($venda->id_situacao == 3){
                    return "<span class='label bg-green'>".$situacao->nome."</span>";
                }else if($venda->id_situacao == 4){
                    return "<span class='label bg-blue'>".$situacao->nome."</span>";
                }
            })->addColumn('comprador',function($venda){
                $comprador = User::find($venda->id_usuario);
                return $comprador->nome;
            })->editColumn('data', function($venda) {
                if($venda->data != null)
                    return Carbon::parse($venda->data)->format('d/m/Y');
                else
                    return null;
            })->editColumn('created_at', function($venda) {
                if($venda->created_at != null)
                    return Carbon::parse($venda->created_at)->format('d/m/Y');
                else
                    return null;
            })->editColumn('updated_at', function($venda) {
                if($venda->updated_at != null){
                    $upd = Carbon::parse($venda->updated_at)->diffForHumans();
                    return $upd;
                }else
                    return null;
            })
            ->rawColumns(['qtd_produtos', 'comprador', 'turno', 'situacao', 'action'])->make(true);
        }
    }

    /*public function incluirVenda(Request $request){
        if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.carrinhog'), \Config::get('constants.permissoes.incluir'))[2] == true){
            $venda = new TblVendas();
            $venda->id_igreja = $request->igreja;
            $venda->nome = $request->nome;
            $venda->descricao = $request->descricao;
            $venda->save();

            $notification = array(
                'message' => 'Venda "' . $venda->nome . '" foi adicionada com sucesso!', 
                'alert-type' => 'success'
            );

            return redirect()->route('usuario.vendas')->with($notification);
        }else{ return view('error'); }
    }*/

    public function editarVenda($id){
        if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.carrinhog'), \Config::get('constants.permissoes.alterar'))[2] == true){
            $venda = TblVendas::find($id);
            $produtos = \DB::table('tbl_vendas_produtos')
                ->select('tbl_vendas_produtos.*','tbl_produtos.nome','tbl_tipos_vendas.nome as tipo')
                ->leftJoin('tbl_produtos','tbl_vendas_produtos.id_produto','=','tbl_produtos.id')
                ->leftJoin('tbl_tipos_vendas','tbl_vendas_produtos.id_tipo_venda','=','tbl_tipos_vendas.id')
                ->where('tbl_vendas_produtos.id','=',$venda->id)
                ->orderBy('tbl_produtos.nome','ASC')->get();
            $perfil = TblPerfil::find(\Auth::user()->id_perfil);
            $igreja = obter_dados_igreja_id($perfil->id_igreja);
            $modulos_igreja = obter_modulos_gerenciais_igreja($igreja);
            return view('usuario.editarvenda', compact('venda','produtos','igreja','modulos_igreja'));
        }else{ return view('error'); }
    }

    public function atualizarVenda(Request $request){
        if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.carrinhog'), \Config::get('constants.permissoes.alterar'))[2] == true){
            $venda = TblVendas::find($request->id);
            $venda->id_situacao = $request->situacao;
            $venda->oferta = $request->oferta;
            $venda->save();

            $notification = array(
                'message' => 'Venda "' . $venda->nome . '" foi atualizada com sucesso!', 
                'alert-type' => 'success'
            );

            return redirect()->route('usuario.vendas')->with($notification);
        }else{ return view('error'); }
    }

    /*public function excluirVenda($id){
        if( valida_permissao(\Auth::user()->id_perfil, \Config::get('constants.modulos.carrinhog'), \Config::get('constants.permissoes.desativar'))[2] == true){
            $venda = TblVendas::find($id);
            $venda->delete();

            $notification = array(
                'message' => 'Venda "' . $venda->nome . '" foi excluída com sucesso!', 
                'alert-type' => 'success'
            );

            return redirect()->route('usuario.vendas')->with($notification);
        }else{ return view('error'); }
    }*/
    ////////////////////////////////////////////////////////////////////////////////
}
