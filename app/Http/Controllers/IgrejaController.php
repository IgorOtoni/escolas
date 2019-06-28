<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\TblIgreja;
use App\TblConfiguracoes;
use App\TblIgrejasModulos;
use App\TblContatos;
use App\TblInscricoes;
use App\TblMembros;
use App\TblFuncoes;
use Symfony\Component\HttpFoundation\Response;
class IgrejaController extends Controller
{
    public function index($url)
    {
        $igreja = obter_dados_igreja($url);
        $modulos = obter_modulos_apresentativos_igreja($igreja);
        $banners = \DB::table('tbl_banners')
            ->where('id_igreja', '=', $igreja->id)
            ->orderBy('ordem', 'ASC')
            ->get();
        /*$eventos_fixos = \DB::table('tbl_eventos_fixos')
            ->where('id_igreja', '=', $igreja->id)
            ->get();*/
        $eventos = \DB::table('tbl_eventos')
            ->where('id_igreja', '=', $igreja->id)
            ->orderBy('dados_horario_inicio','DESC')
            ->limit(4)
            ->get();
        $noticias = \DB::table('tbl_noticias')
            ->where('id_igreja', '=', $igreja->id)
            ->orderBy('created_at','DESC')
            ->limit(3)
            ->get();
        $igreja = obter_dados_igreja($url);
        $modulos = obter_modulos_apresentativos_igreja($igreja);
        $galerias = \DB::table('tbl_galerias')
            ->where('id_igreja', '=', $igreja->id)
            ->orderBy('data', 'DESC')
            ->orderBy('created_at', 'DESC')
            ->limit(4)
            ->get();
        $fotos = array();
        foreach($galerias as $galeria){
            $fotos_ = \DB::table('tbl_fotos')
                ->where('id_galeria', '=', $galeria->id)
                ->orderBy('created_at', 'DESC')
                ->get();
            $fotos[$galeria->id] = $fotos_;
        }
        $retorno = obter_menus_configuracao($igreja->id_configuracao);
        $menus = $retorno[0];
        $submenus = $retorno[1];
        $subsubmenus = $retorno[2];
        return view('layouts.template' . $igreja->id_template . '.index', compact('igreja', 'modulos', 'banners', 'eventos', 'noticias', 'galerias', 'fotos', 'menus', 'submenus', 'subsubmenus'));
    }
    public function ministros($url)
    {
        $igreja = obter_dados_igreja($url);
        $modulos = obter_modulos_apresentativos_igreja($igreja);
        $retorno = obter_menus_configuracao($igreja->id_configuracao);
        $menus = $retorno[0];
        $submenus = $retorno[1];
        $subsubmenus = $retorno[2];
        return view('layouts.template' . $igreja->id_template . '.ministros', compact('igreja', 'modulos', 'menus', 'submenus', 'subsubmenus'));
    }
    public function noticias($url)
    {
        $igreja = obter_dados_igreja($url);
        $modulos = obter_modulos_apresentativos_igreja($igreja);
        $noticias = \DB::table('tbl_noticias')
            ->where('id_igreja', '=', $igreja->id)
            ->orderBy('created_at', 'DESC')
            ->paginate(3);
        $retorno = obter_menus_configuracao($igreja->id_configuracao);
        $menus = $retorno[0];
        $submenus = $retorno[1];
        $subsubmenus = $retorno[2];
        return view('layouts.template' . $igreja->id_template . '.noticias', compact('igreja', 'modulos', 'noticias', 'menus', 'submenus', 'subsubmenus'));
    }
    public function noticia($url,$id)
    {
        $igreja = obter_dados_igreja($url);
        $modulos = obter_modulos_apresentativos_igreja($igreja);
        $retorno = obter_menus_configuracao($igreja->id_configuracao);
        $menus = $retorno[0];
        $submenus = $retorno[1];
        $subsubmenus = $retorno[2];
        $noticia = \DB::table('tbl_noticias')
        ->where('id', '=', $id)
            ->where('id_igreja', '=', $igreja->id)
            ->orderBy('created_at', 'DESC')
            ->paginate(3);
        $noticia = $noticia[0];
        return view('layouts.template' . $igreja->id_template . '.noticiadetalhada', compact('igreja', 'modulos', 'noticia', 'menus', 'submenus', 'subsubmenus'));
    }
    public function sermoes($url)
    {
        $igreja = obter_dados_igreja($url);
        $modulos = obter_modulos_apresentativos_igreja($igreja);
        $retorno = obter_menus_configuracao($igreja->id_configuracao);
        $menus = $retorno[0];
        $submenus = $retorno[1];
        $subsubmenus = $retorno[2];
        $sermoes = \DB::table('tbl_sermoes')
            ->where('id_igreja', '=', $igreja->id)
            ->orderBy('created_at', 'DESC')
            ->paginate(4);
        return view('layouts.template' . $igreja->id_template . '.sermoes', compact('igreja', 'modulos', 'sermoes', 'menus', 'submenus', 'subsubmenus'));
    }
    public function sermao($url,$id)
    {
        $igreja = obter_dados_igreja($url);
        $modulos = obter_modulos_apresentativos_igreja($igreja);
        $retorno = obter_menus_configuracao($igreja->id_configuracao);
        $menus = $retorno[0];
        $submenus = $retorno[1];
        $subsubmenus = $retorno[2];
        $sermao = \DB::table('tbl_sermoes')
            ->where('id', '=', $id)
            ->where('id_igreja', '=', $igreja->id)
            ->get();
        $sermao = $sermao[0];
        return view('layouts.template' . $igreja->id_template . '.sermaodetalhado', compact('igreja', 'modulos', 'sermao', 'menus', 'submenus', 'subsubmenus'));
    }
    public function contato($url)
    {
        $igreja = obter_dados_igreja($url);
        $modulos = obter_modulos_apresentativos_igreja($igreja);
        $retorno = obter_menus_configuracao($igreja->id_configuracao);
        $menus = $retorno[0];
        $submenus = $retorno[1];
        $subsubmenus = $retorno[2];
        return view('layouts.template' . $igreja->id_template . '.contato', compact('igreja', 'modulos', 'menus', 'submenus', 'subsubmenus'));
    }
    public function apresentacao($url)
    {
        $igreja = obter_dados_igreja($url);
        $modulos = obter_modulos_apresentativos_igreja($igreja);
        $retorno = obter_menus_configuracao($igreja->id_configuracao);
        $funcoes = TblFuncoes::where('id_igreja','=',$igreja->id)->where('apresentar','=',true)->get();
        $membros = null;
        foreach($funcoes as $funcao){
            $membros[$funcao->id] = TblMembros::where('id_funcao','=',$funcao->id)->where('id_igreja','=',$funcao->id_igreja)->get();
        }
        $menus = $retorno[0];
        $submenus = $retorno[1];
        $subsubmenus = $retorno[2];
        return view('layouts.template' . $igreja->id_template . '.apresentacao', compact('igreja', 'funcoes', 'membros', 'modulos', 'menus', 'submenus', 'subsubmenus'));
    }
    public function eventosfixos($url)
    {
        $igreja = obter_dados_igreja($url);
        $modulos = obter_modulos_apresentativos_igreja($igreja);
        $retorno = obter_menus_configuracao($igreja->id_configuracao);
        $menus = $retorno[0];
        $submenus = $retorno[1];
        $subsubmenus = $retorno[2];
        if($igreja->id_template == 2){
            $eventos_fixos = \DB::table('tbl_eventos_fixos')
                ->where('id_igreja', '=', $igreja->id)
                ->get();
        }else if($igreja->id_template == 1){
            $eventos_fixos = \DB::table('tbl_eventos_fixos')
                ->where('id_igreja', '=', $igreja->id)
                ->paginate(3);
        }else{
            $eventos_fixos = \DB::table('tbl_eventos_fixos')
                ->where('id_igreja', '=', $igreja->id)
                ->paginate(4);
        }
        return view('layouts.template' . $igreja->id_template . '.eventosfixos', compact('igreja', 'modulos', 'eventos_fixos', 'menus', 'submenus', 'subsubmenus'));
    }
    public function eventofixo($url,$id)
    {
        $igreja = obter_dados_igreja($url);
        $modulos = obter_modulos_apresentativos_igreja($igreja);
        $retorno = obter_menus_configuracao($igreja->id_configuracao);
        $menus = $retorno[0];
        $submenus = $retorno[1];
        $subsubmenus = $retorno[2];
        $eventofixo = \DB::table('tbl_eventos_fixos')
            ->where('id', '=', $id)
            ->where('id_igreja', '=', $igreja->id)
            ->get();
        $eventofixo = $eventofixo[0];
        return view('layouts.template' . $igreja->id_template . '.eventofixodetalhado', compact('igreja', 'modulos', 'eventofixo', 'menus', 'submenus', 'subsubmenus'));
    }
    public function eventos($url)
    {
        $igreja = obter_dados_igreja($url);
        $modulos = obter_modulos_apresentativos_igreja($igreja);
        $retorno = obter_menus_configuracao($igreja->id_configuracao);
        $menus = $retorno[0];
        $submenus = $retorno[1];
        $subsubmenus = $retorno[2];
        if($igreja->id_template != 2){
            $eventos = \DB::table('tbl_eventos')
                ->where('id_igreja', '=', $igreja->id)
                ->where(function ($query) {
                    $query->where('dados_horario_inicio', '>=', date('Y-m-d h:i:s', time()))
                        ->orWhere('dados_horario_fim', '>=', date('Y-m-d h:i:s', time()));
                })
                ->orderBy('dados_horario_inicio', 'DESC')
                ->paginate(4);
        }else{
            $eventos = \DB::table('tbl_eventos')
                ->where('id_igreja', '=', $igreja->id)
                ->where(function ($query) {
                    $query->where('dados_horario_inicio', '>=', date('Y-m-d h:i:s', time()))
                        ->orWhere('dados_horario_fim', '>=', date('Y-m-d h:i:s', time()));
                })
                ->orderBy('dados_horario_inicio', 'DESC')
                ->get();
        }
        return view('layouts.template' . $igreja->id_template . '.eventos', compact('igreja', 'modulos', 'eventos', 'menus', 'submenus', 'subsubmenus'));
    }
    public function evento($url,$id)
    {
        $igreja = obter_dados_igreja($url);
        $modulos = obter_modulos_apresentativos_igreja($igreja);
        $retorno = obter_menus_configuracao($igreja->id_configuracao);
        $menus = $retorno[0];
        $submenus = $retorno[1];
        $subsubmenus = $retorno[2];
        $evento = \DB::table('tbl_eventos')
            ->where('id', '=', $id)
            ->where('id_igreja', '=', $igreja->id)
            ->get();
        $evento = $evento[0];
        return view('layouts.template' . $igreja->id_template . '.eventodetalhado', compact('igreja', 'modulos', 'evento', 'menus', 'submenus', 'subsubmenus'));
    }
    public function login($url)
    {
        $igreja = obter_dados_igreja($url);
        return view('auth.login',compact('igreja'));
    }
    public function galeria($url)
    {
        $igreja = obter_dados_igreja($url);
        $modulos = obter_modulos_apresentativos_igreja($igreja);
        $retorno = obter_menus_configuracao($igreja->id_configuracao);
        $menus = $retorno[0];
        $submenus = $retorno[1];
        $subsubmenus = $retorno[2];
        $galerias = \DB::table('tbl_galerias')
            ->where('id_igreja', '=', $igreja->id)
            ->orderBy('data', 'DESC')
            ->orderBy('created_at', 'DESC')
            ->paginate(4);
        $fotos = array();
        foreach($galerias as $galeria){
            $fotos_ = \DB::table('tbl_fotos')
                ->where('id_galeria', '=', $galeria->id)
                ->orderBy('created_at', 'DESC')
                ->get();
            $fotos[$galeria->id] = $fotos_;
        }
        return view('layouts.template' . $igreja->id_template . '.galeria', compact('igreja', 'modulos', 'galerias', 'fotos', 'menus', 'submenus', 'subsubmenus'));
    }
    public function publicacao($url,$id){
        $igreja = obter_dados_igreja($url);
        $modulos = obter_modulos_apresentativos_igreja($igreja);
        $retorno = obter_menus_configuracao($igreja->id_configuracao);
        $menus = $retorno[0];
        $submenus = $retorno[1];
        $subsubmenus = $retorno[2];
        $publicacao = \DB::table('tbl_publicacoes')
            ->where('id_igreja', '=', $igreja->id)
            ->where('id', '=', $id)
            ->orderBy('created_at', 'DESC')
            ->get();
        $publicacao = $publicacao[0];
        $galeria_publicacao = \DB::table('tbl_publicacao_fotos')
            ->where('id_publicacao', '=', $publicacao->id)
            ->orderBy('created_at', 'DESC')
            ->get();
        $publicacao->html = str_replace("\\r","",$publicacao->html);
        $publicacao->html = str_replace("\\t","",$publicacao->html);
        $publicacao->html = str_replace("\\n","",$publicacao->html);
        return view('layouts.template' . $igreja->id_template . '.publicacao', compact('igreja', 'modulos', 'publicacao', 'galeria_publicacao', 'menus', 'submenus', 'subsubmenus'));
    }
    public function carrega_imagem($largura,$altura,$pasta,$arquivo){
        return view('exemplo2', compact('largura', 'altura', 'pasta', 'arquivo'));
    }
    public function carrega_imagem_($largura,$pasta,$arquivo){
        return view('exemplo2', compact('largura', 'pasta', 'arquivo'));
    }
    public function inscreveEnvento($url, Request $request){
        $igreja = obter_dados_igreja($url);
        $modulos = obter_modulos_apresentativos_igreja($igreja);
        $retorno = obter_menus_configuracao($igreja->id_configuracao);
        $menus = $retorno[0];
        $submenus = $retorno[1];
        $subsubmenus = $retorno[2];

        $inscricao = new TblInscricoes();
        $inscricao->email = $request->email;
        $inscricao->telefone = $request->telefone;
        $inscricao->id_evento = $request->id_evento;
        $inscricao->save();

        return view('layouts.template' . $igreja->id_template . '.confirmacaoDados', compact('igreja', 'modulos', 'menus', 'submenus', 'subsubmenus'));
    }
    public function enviaContato($url, Request $request){
        $igreja = obter_dados_igreja($url);
        $modulos = obter_modulos_apresentativos_igreja($igreja);
        $retorno = obter_menus_configuracao($igreja->id_configuracao);
        $menus = $retorno[0];
        $submenus = $retorno[1];
        $subsubmenus = $retorno[2];

        $contato = new TblContatos();
        $contato->nome = $request->nome;
        $contato->email = $request->email;
        $contato->telefone = $request->telefone;
        $contato->mensagem = $request->mensagem;
        $contato->id_igreja = $igreja->id;
        $contato->save();

        return view('layouts.template' . $igreja->id_template . '.confirmacaoDados', compact('igreja', 'modulos', 'menus', 'submenus', 'subsubmenus'));
    }
}
