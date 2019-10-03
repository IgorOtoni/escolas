<?php
/**
* change first char from word to upper
*
* @param $string
*/

use App\TblPerfil;
use App\TblIgrejas;
use App\TblModulos;
use App\TblPermissoes;

function fistCharFromWord_toUpper($string)
{
    $st = '';
    $splitString = explode(' ', $string);
    foreach($splitString as $str){
        $first_letter = mb_strtoupper(mb_substr($str, 0, 1, "UTF-8"), "UTF-8");
        $str =  mb_substr($str, 1, mb_strlen($str, "UTF-8"), "UTF-8");
        $st = $st.' '.$first_letter.$str;
    }
    return $st;   
}
function obter_dados_igreja_id($id){
    $igreja = \DB::table('tbl_igrejas')
        ->select('tbl_igrejas.*', 'tbl_configuracoes.id as id_configuracao', 'tbl_configuracoes.url','tbl_configuracoes.id_template','tbl_configuracoes.texto_apresentativo','tbl_configuracoes.facebook','tbl_configuracoes.youtube','tbl_configuracoes.twitter','tbl_configuracoes.cor')
        ->leftJoin('tbl_configuracoes', 'tbl_igrejas.id', '=', 'tbl_configuracoes.id_igreja')
        ->where('tbl_igrejas.id','=',$id)
        ->get();
    return $igreja[0];
}
function obter_dados_igreja($url){
    $igreja = \DB::table('tbl_igrejas')
        ->select('tbl_igrejas.*', 'tbl_configuracoes.id as id_configuracao', 'tbl_configuracoes.url','tbl_configuracoes.id_template','tbl_configuracoes.texto_apresentativo','tbl_configuracoes.facebook','tbl_configuracoes.youtube','tbl_configuracoes.twitter','tbl_configuracoes.cor')
        ->leftJoin('tbl_configuracoes', 'tbl_igrejas.id', '=', 'tbl_configuracoes.id_igreja')
        ->where('url','=',$url)
        ->get();
    return $igreja[0];
}
function obter_modulos_igreja($igreja){
    $modulos = \DB::table('tbl_igrejas_modulos')
        ->leftJoin('tbl_modulos', 'tbl_igrejas_modulos.id_modulo', '=', 'tbl_modulos.id')
        ->select('tbl_igrejas_modulos.id_modulo', 'tbl_modulos.*')
        ->where('id_igreja','=',$igreja->id)
        ->where('tbl_modulos.sistema','like','%web%')
        ->orderBy('tbl_modulos.nome', 'ASC')
        ->get();
    return $modulos;
}
function obter_modulos_apresentativos_igreja($igreja){
    $modulos = \DB::table('tbl_igrejas_modulos')
        ->leftJoin('tbl_modulos', 'tbl_igrejas_modulos.id_modulo', '=', 'tbl_modulos.id')
        ->select('tbl_igrejas_modulos.id_modulo', 'tbl_modulos.*')
        ->where('id_igreja','=',$igreja->id)
        ->where('tbl_modulos.sistema','like','%web%')
        ->where('tbl_modulos.gerencial','=',false)
        ->orderBy('tbl_modulos.nome', 'ASC')
        ->get();
    return $modulos;
}
function obter_modulos_gerenciais_igreja($igreja){
    $modulos = \DB::table('tbl_igrejas_modulos')
        ->leftJoin('tbl_modulos', 'tbl_igrejas_modulos.id_modulo', '=', 'tbl_modulos.id')
        ->select('tbl_igrejas_modulos.id_modulo', 'tbl_modulos.*')
        ->where('id_igreja','=',$igreja->id)
        ->where('tbl_modulos.sistema','like','%web%')
        ->where('tbl_modulos.gerencial','=',true)
        ->orderBy('tbl_modulos.nome', 'ASC')
        ->get();
    return $modulos;
}
function obter_menus_configuracao($id){
    $menus = \DB::table('tbl_menus')
        ->where('id_configuracao', '=', $id)
        ->orderBy('ordem', 'ASC')
        ->get();
    $submenus = array();
    foreach($menus as $menu){
        $submenus_ = \DB::table('tbl_sub_menus')
            ->where('id_menu', '=', $menu->id)
            ->orderBy('ordem', 'ASC')
            ->get();
        if($submenus_ != null && count($submenus_) > 0) $submenus[$menu->id] = $submenus_;
    }
    $subsubmenus = array();
    foreach($submenus as $submenu__){
        foreach($submenu__ as $submenu){
            $subsubmenus_ = \DB::table('tbl_sub_sub_menus')
                ->where('id_submenu', '=', $submenu->id)
                ->orderBy('ordem', 'ASC')
                ->get();
            if($subsubmenus_ != null && count($subsubmenus_) > 0) $subsubmenus[$submenu->id] = $subsubmenus_;
        }
    }
    return array($menus, $submenus, $subsubmenus);
}
function obter_menus_aplicativo_configuracao($id){
    $menus = \DB::table('tbl_menus_android')
        ->where('id_configuracao', '=', $id)
        ->orderBy('ordem', 'ASC')
        ->get();
    return $menus;
}
function muda_cep($cep){
    return str_replace(".", "", str_replace("-", "", $cep));
}
function muda_data_tempo($data){
    $retorno = str_replace("/", "-", $data);
    $split_ = explode(' ', $retorno);
    $split = explode('-', $split_[0]);
    return $split[2] . '-' . $split[1] . '-' . $split[0] . ' ' . $split_[1];
}
function muda_data_tempo_($data){
    $retorno = str_replace("/", "-", $data);
    $split_ = explode(' ', $retorno);
    $split = explode('-', $split_[0]);
    return $split[2] . '/' . $split[1] . '/' . $split[0] . ' ' . $split_[1];
}
function muda_data($data){
    $retorno = str_replace("/", "-", $data);
    $split = explode('-', $retorno);
    return $split[2] . '-' . $split[1] . '-' . $split[0];
}
function muda_data_($data){
    $retorno = str_replace("-", "/", $data);
    $split = explode('/', $retorno);
    return $split[2] . '/' . $split[1] . '/' . $split[0];
}
function cor_aleatoria() {
    $letters = '0123456789ABCDEF';
    $color = '#';
    for($i = 0; $i < 6; $i++) {
        $index = rand(0,15);
        $color .= $letters[$index];
    }
    return $color;
}
function limpa_html($html){
    $html = str_replace("\n", "", $html);
    $html = str_replace("\\n", "", $html);
    $html = str_replace("\r", "", $html);
    $html = str_replace("\\r", "", $html);
    $html = str_replace("\t", "", $html);
    $html = str_replace("\\t", "", $html);
    $html = trim($html);
    return $html;
}
function verifica_link($link, $igreja){
    if($link == null || empty($link) || trim($link) == ""){
        return "/".$igreja->url;
    }else if(substr($link, 0, 4) == "http"){
        return $link;
    }else{
        return "/".$igreja->url."/".$link;
    }
}
// ÁREA DE AUTENTICAÇÃO E VALIDAÇÃO DE MÓDULOS E PERMISSÕES !!!!!!!!!!!!!!!!!!!!!!!!!!!!
function obter_modulos_perfil($perfil){
    $modulos = \DB::table('tbl_perfis_igrejas_modulos')
        ->leftJoin('tbl_igrejas_modulos', 'tbl_perfis_igrejas_modulos.id_modulo_igreja', '=', 'tbl_igrejas_modulos.id')
        ->leftJoin('tbl_modulos', 'tbl_igrejas_modulos.id_modulo', '=', 'tbl_modulos.id')
        ->select('tbl_igrejas_modulos.id_modulo', 'tbl_modulos.*')
        ->where('tbl_perfis_igrejas_modulos.id_perfil','=',$perfil->id)
        ->where('tbl_modulos.sistema','like','%web%')
        ->orderBy('tbl_modulos.nome', 'ASC')
        ->get();
    return $modulos;
}
function valida_modulo($id_perfil, $id_modulo){
    $retorno = null;
    $perfil = TblPerfil::find($id_perfil);
    $modulos = \DB::table('tbl_igrejas_modulos')
        ->select('tbl_igrejas_modulos.*', 'tbl_perfis_igrejas_modulos.id as id_perfis_igrejas_modulos')
        ->leftJoin('tbl_perfis_igrejas_modulos', 'tbl_igrejas_modulos.id', '=', 'tbl_perfis_igrejas_modulos.id_modulo_igreja')
        ->where('tbl_perfis_igrejas_modulos.id_perfil','=',$id_perfil)
        ->where('tbl_igrejas_modulos.id_modulo','=',$id_modulo)
        ->where('tbl_igrejas_modulos.id_igreja','=',$perfil->id_igreja)
        ->get();
    // PRIMEIRO IF: VERIFIFICA SE O PERFIL TEM ACESSOS AO MÓDULO
    if($modulos == null || count($modulos) == 0){
        $retorno = false;
    }else{
        $modulo_do_perfil = $modulos[0];
        $retorno = true;
    }
    return $retorno;
}
function valida_permissao($id_perfil, $id_modulo, $id_permissao){
    $retorno = null;
    $modulos = \DB::table('tbl_igrejas_modulos')
        ->select('tbl_igrejas_modulos.*', 'tbl_perfis_igrejas_modulos.id as id_perfis_igrejas_modulos')
        ->leftJoin('tbl_perfis_igrejas_modulos', 'tbl_igrejas_modulos.id', '=', 'tbl_perfis_igrejas_modulos.id_modulo_igreja')
        ->where('tbl_perfis_igrejas_modulos.id_perfil','=',$id_perfil)
        ->where('tbl_igrejas_modulos.id_modulo','=',$id_modulo)
        ->get();
    // PRIMEIRO IF: VERIFIFICA SE O PERFIL TEM ACESSOS AO MÓDULO
    if($modulos == null || count($modulos) == 0){
        $retorno[0] = false;
        $retorno[1] = false;
        $retorno[2] = false;
    }else{
        $modulo_do_perfil = $modulos[0];
        $permissoes = \DB::table('tbl_permissoes')
            ->select('tbl_permissoes.*')
            ->leftJoin('tbl_modulos_permissoes', 'tbl_permissoes.id', '=', 'tbl_modulos_permissoes.id_permissao')
            ->where('tbl_permissoes.id','=',$id_permissao)
            ->where('tbl_modulos_permissoes.id_modulo','=',$modulo_do_perfil->id_modulo)
            ->get();
        // SEGUNDO IF: VERIFICA SE O MÓDULO TÊM A PERMISSÃO SOLICITADA
        if($permissoes == null || count($permissoes) == 0){
            $retorno[0] = true;
            $retorno[1] = false;
            $retorno[2] = false;
        }else{
            $permissao_do_modulo = $permissoes[0];
            $permissoes_ = \DB::table('tbl_perfis_permissoes')
                ->select('tbl_perfis_permissoes.*')
                ->where('id_permissao','=',$id_permissao)
                ->where('id_perfil_igreja_modulo','=',$modulo_do_perfil->id_perfis_igrejas_modulos)
                ->get();
            // TERCEIRO IF: VERIFICA SE O PERFIL TÊM A PERMISSÃO NO MÓDULO SOLICITADO
            if($permissoes_ == null || count($permissoes_) == 0){
                $retorno[0] = true;
                $retorno[1] = true;
                $retorno[2] = false;
            }else{
                $retorno[0] = true;
                $retorno[1] = true;
                $retorno[2] = true;
            }
        }
    }
    return $retorno;
}
////////////////////////////////////////////////////////////////////////////////////////