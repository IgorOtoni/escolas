<?php

namespace App\Http\Controllers;

use DataTables;
use App\TblIgreja;
use App\TblConfiguracoes;
use App\TblPerfisPermissoes;
use App\TblPerfisIgrejasModulos;
use App\TblIgrejasModulos;
use App\TblModulo;
use App\TblMenu;
use App\TblSubMenu;
use App\TblSubSubMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;
use App\TblPerfil;
use App\User;

class AdminController extends Controller{

	// IGREJAS CRUD ===================================================================================================
	public function igrejas(){ return view('admin.igrejas.index'); }

    public function modulos_igreja($id){
        $modulos['data'] = \DB::table('tbl_modulos')
            ->select('tbl_modulos.*')
            ->leftJoin('tbl_igrejas_modulos', 'tbl_igrejas_modulos.id_modulo', '=', 'tbl_modulos.id')
            ->where('tbl_igrejas_modulos.id_igreja','=',$id)
            ->get();
        return json_encode($modulos);
    }

    public function tbl_igrejas(){
        $igrejas = \DB::table('tbl_igrejas')
            ->select('tbl_igrejas.*', 'tbl_configuracoes.id as id_configuracao', 'tbl_configuracoes.url','tbl_configuracoes.id_template')
            ->leftJoin('tbl_configuracoes', 'tbl_igrejas.id', '=', 'tbl_configuracoes.id_igreja')
            ->orderBy('nome', 'ASC')
            ->get();
        return DataTables::of($igrejas)->addColumn('action',function($igrejas){
            return '<a href="igrejas/editarIgreja/'.$igrejas->id.'" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>'.'&nbsp'.
            '<a href="igrejas/configuracoes/'.$igrejas->id.'" class="btn btn-xs btn-warning"><i class="fa fa-cog"></i></a>'.'&nbsp'.
            '<label title="Status da Igreja" class="switch"><input onClick="switch_status(this)" name="'.$igrejas->nome.'" class="status" id="'.$igrejas->id.'" type="checkbox" '.(($igrejas->status == 1) ? "checked" : "").'><span class="slider"></span></label>';
        })->editColumn('created_at', function($igrejas) {
            if($igrejas->created_at != null)
                return Carbon::parse($igrejas->created_at)->format('d/m/Y');
            else
                return null;
        })->editColumn('updated_at', function($igrejas) {
            if($igrejas->updated_at != null){
                $upd = Carbon::parse($igrejas->updated_at)->diffForHumans();
                return $upd;
            }else
                return null;
        })->make(true);
    }

    public function switchStatus(Request $request){
        $igreja = TblIgreja::find($request->id);
        ($igreja->status == 1) ? $igreja->status = 0 : $igreja->status = 1 ;
        $igreja->save();
    }

    public function salvarIgreja(Request $request)
    {
        $igreja = new TblIgreja();
        $igreja->nome = fistCharFromWord_toUpper($request->nome);        
        $igreja->cep = $request->cep;
        $igreja->num = $request->num;
        $igreja->rua = $request->rua;
        $igreja->cidade = $request->cidade;
        $igreja->complemento = $request->complemento;
        $igreja->bairro = $request->bairro;
        $igreja->estado = $request->estado;
        $igreja->telefone = $request->telefone;
        $igreja->email = $request->email;
        $igreja->logo = file_get_contents($request->file($logo));

        $count = TblIgreja::where("nome", "=", $igreja->nome)->count();
        if($count == 0){
            $igreja->save();

            $modulo = new TblIgrejasModulos();

            foreach ($request->modulos as $key => $value) {
                $data = [
                    'id_igreja' => $igreja->id,
                    'id_modulo' => $value
                ];
                $modulo->create($data);
            }

            $configuracao = new TblConfiguracoes();
            $configuracao->id_igreja = $igreja->id;
            $configuracao->cor = 'white';
            $configuracao->id_template = 1;
            $configuracao->save();

            $notification = array(
                'message' => $igreja->nome . ' foi incluído(a) com sucesso!', 
                'alert-type' => 'success'
            );

            //return view('igrejas.index')->with($notification);
            return redirect()->route('igrejas')->with($notification);

        }else{

            $notification = array(
                'message' => 'O nome informado já está na base de dados!', 
                'alert-type' => 'error'
            );

            return back()->with($notification);

        }
    }

    public function editarIgreja($id)
    {
        $igreja = TblIgreja::findOrfail($id);
        $modulos_igreja = TblIgrejasModulos::where('id_igreja', '=', $id)->get();
        return view('admin.igrejas.edit', compact('igreja','modulos_igreja'));
    }

    public function atualizarIgreja(Request $request){
        $igreja = TblIgreja::find($request->id);
        $igreja->nome = fistCharFromWord_toUpper($request->nome);
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
            $igreja->logo = file_get_contents($request->file($logo));
        }

        $count = TblIgreja::where("nome", "=", $igreja->nome)->where("id", "<>", $request->id)->count();
        if($count == 0){
            $igreja->save();

            $imsb = TblIgrejasModulos::where('id_igreja', '=',  $request->id)->get();
            $modulos_ingorados = null;
            $x = 0;

            foreach($imsb as $imb){
                if(in_array($imb->id_modulo, $request->modulos)){
                    $modulos_ingorados[$x] = $imb->id_modulo;
                    $x++;
                }else{
                    $pimsb = TblPerfisIgrejasModulos::where('id_modulo_igreja', '=', $imb->id)->get();
                    foreach($pimsb as $pimb){
                        TblPerfisPermissoes::where('id_perfil_igreja_modulo', '=', $pimb->id)->delete();
                        $pimb->delete();
                    }
                    $imb->delete();
                }
            }

            $modulo = new TblIgrejasModulos();

            foreach ($request->modulos as $key => $value) {
                if($modulos_ingorados == null || !in_array($value, $modulos_ingorados)){
                    $data = [
                        'id_igreja' => $igreja->id,
                        'id_modulo' => $value
                    ];
                    $modulo->create($data);
                }
            }

            $notification = array(
                'message' => $igreja->nome . ' foi atualizado(a) com sucesso!', 
                'alert-type' => 'success'
            );

            return redirect()->route('igrejas')->with($notification);

        }else{

            $notification = array(
                'message' => 'O nome informado já está na base de dados!', 
                'alert-type' => 'error'
            );

            return back()->with($notification);

        }
    }

    public function excluirLogo(Request $request){
        $igreja = TblIgreja::find($request->id);
        $igreja->logo = null;
        $igreja->save();
        return \Response::json(['message' => 'File successfully delete'], 200);
    }

    public function configuracoes($id){
        $igreja = obter_dados_igreja_id($id);
        $modulos_igreja = obter_modulos_apresentativos_igreja($igreja);
        $retorno = obter_menus_configuracao($igreja->id_configuracao);
        $menus = $retorno[0];
        $submenus = $retorno[1];
        $subsubmenus = $retorno[2];
        $menus_aplicativo = obter_menus_aplicativo_configuracao($igreja->id_configuracao);
        $modulos_aplicativo = obter_modulos_igreja_aplicativo($igreja);
        return view('admin.igrejas.configuracoes', compact('igreja','modulos_igreja','modulos_aplicativo','menus','submenus','subsubmenus','menus_aplicativo'));
    }

    public function adicionarMenu(Request $request){
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
    }

    public function editarMenu(Request $request){
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
    }

    public function excluirMenu($id){
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
    }

    public function adicionarSubMenu(Request $request){
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
    }

    public function editarSubMenu(Request $request){
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
    }

    public function excluirSubMenu($id){
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
    }

    public function adicionarSubSubMenu(Request $request){
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
    }

    public function editarSubSubMenu(Request $request){
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
    }

    public function excluirSubSubMenu($id){
        $subsubmenu = TblSubSubMenu::find($id);
        TblSubSubMenu::where('id', $id)->delete();

        $notification = array(
            'message' => 'Sub-Submenu ' . $subsubmenu->nome . ' foi excluído com sucesso!', 
            'alert-type' => 'success'
        );

        return back()->with($notification);
    }

    public function salvarConfiguracoes(Request $request){
        $configuracao = TblConfiguracoes::find($request->id);
        $configuracao->id_template = $request->id_template;
        $configuracao->cor = $request->cor;
        $configuracao->texto_apresentativo = $request->texto_apresentativo;

        $igreja = TblIgreja::find($configuracao->id_igreja);
        $igreja->nome = fistCharFromWord_toUpper($request->nome);
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
            $igreja->logo = file_get_contents($request->file($logo));
        }
        if($request->custom_style){
            $configuracao->custom_style = file_get_contents($request->custom_style);
        }

        $count = TblIgreja::where("nome", "=", $igreja->nome)->where("id", "<>", $igreja->id)->count();
        if($count == 0){
            $count_ = TblConfiguracoes::where("url", "=", $igreja->nome)->where("id_igreja", "<>", $igreja->id)->count();
            if($count_ == 0){

                $igreja->save();

                $configuracao->save();

                $notification = array(
                    'message' => 'Configurações da congregação alteradas com sucesso!', 
                    'alert-type' => 'success'
                );

                return back()->with($notification);
                
            }else{

                $notification = array(
                    'message' => 'A URL informada já está na base de dados!', 
                    'alert-type' => 'error'
                );

                return back()->with($notification);

            }
        }else{

            $notification = array(
                'message' => 'O nome informado já está na base de dados!', 
                'alert-type' => 'error'
            );

            return back()->with($notification);

        }
    }

    public function adicionarMenuAplicativo(Request $request){
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
    }

    public function editarMenuAplicativo(Request $request){
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
    }

    public function excluirMenuAplicativo($id){
        $menu = TblMenusAndroid::find($id);
        TblMenusAndroid::where('id', $id)->delete();

        $notification = array(
            'message' => 'Menu ' . $menu->nome . ' foi excluído do aplicativo com sucesso!', 
            'alert-type' => 'success'
        );

        return back()->with($notification);
    }
    // ================================================================================================================

    // PERFIS CRUD ====================================================================================================
    public function perfis(){ return view('admin.perfis.index'); }

    public function tbl_perfis(){
        $perfis = TblPerfil::orderBy('nome', 'ASC');
        return DataTables::of($perfis)->addColumn('action',function($perfis){
            return '<a href="perfis/editarPerfil/'.$perfis->id.'" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>'.'&nbsp'.
            '<a href="perfis/carregarPermissoes/'.$perfis->id.'" class="btn btn-xs btn-warning"><i class="fa fa-cog"></i></button></a>'.'&nbsp'.
            '<label title="Status do Perfil" class="switch"><input onClick="switch_status(this)" name="'.$perfis->nome.'" class="status" id="'.$perfis->id.'" type="checkbox" '.(($perfis->status == 1) ? "checked" : "").'><span class="slider"></span></label>';
        })->addColumn('igreja',function($perfis){
            if($perfis->id_igreja != null && $perfis->id_igreja != 1)
                return (TblIgreja::find($perfis->id_igreja))->nome;
            else
                return 'Administrador da Plataforma';
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
        })->make(true);
    }

    public function carregarPermissoes($id){
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
            ->where('tbl_perfis.id','=',$perfil->id)
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
        return view('admin.perfis.permissoes', compact('perfil','modulos', 'permissoes'));
    }

    public function atualizarPermissoes(Request $request){
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

        return redirect()->route('perfis')->with($notification);
    }

    public function switchStatusPerfil(Request $request){
        $perfil = TblPerfil::find($request->id);
        ($perfil->status == 1) ? $perfil->status = 0 : $perfil->status = 1 ;
        $perfil->save();
    }

    public function salvarPerfil(Request $request){
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

            return redirect()->route('perfis')->with($notification);
        }else{
            $notification = array(
                'message' => 'O nome informado já está na base de dados!', 
                'alert-type' => 'error'
            );

            return back()->with($notification);
        }
    }

    public function editarPerfil($id){
        $perfil = TblPerfil::find($id);
        $modulos = obter_modulos_perfil($perfil);
        return view('admin.perfis.edit', compact('perfil','modulos'));
    }

    public function atualizarPerfil(Request $request){
        $perfil = TblPerfil::find($request->id);
        $perfil->nome = $request->nome;
        $perfil->descricao = $request->descricao;
        $igreja_backup = $perfil->id_igreja;
        $perfil->id_igreja = $request->igreja;

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

            return redirect()->route('perfis')->with($notification);
        }else{
            $notification = array(
                'message' => 'O nome informado já está na base de dados!', 
                'alert-type' => 'error'
            );

            return back()->with($notification);
        }
    }
    // ==================================================================================================================

    // USUARIOS CRUD =================================================================================================
    public function usuarios()
    {
        return view('admin.usuarios.index');
    }

    public function tbl_usuarios(){
        $usuarios = User::orderBy('nome', 'ASC');
        return DataTables::of($usuarios)->addColumn('action',function($usuarios){
            return '<a href="'.route('usuarios.editar',['id'=>$usuarios->id]).'" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>'.'&nbsp'.
            '<label title="Status do Usuário" class="switch"><input onClick="switch_status(this)" name="'.$usuarios->nome.'" class="status" id="'.$usuarios->id.'" type="checkbox" '.(($usuarios->status == 1) ? "checked" : "").'><span class="slider"></span></label>';
        })->addColumn('perfil',function($usuarios){
            return (TblPerfil::find($usuarios->id_perfil))->nome;
        })->addColumn('igreja',function($usuarios){
            $perfil = TblPerfil::find($usuarios->id_perfil);
            if($perfil->id_igreja != null && $perfil->id_igreja != 1)
                return (TblIgreja::find($perfil->id_igreja))->nome;
            else
                return 'Administrador da Plataforma';
        })->addColumn('status',function($usuarios){
            if($usuarios->isOnline()){
                return "<span class='label bg-green'>Online</span>";
            }else{
                return "<span class='label bg-red'>Offline</span>";
            }
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
        })->rawColumns(['status', 'action'])->make(true);
    }

    public function editarUsuario($id){
        $usuario = User::find($id);
        return view('admin.usuarios.edit', compact('usuario'));
    }

    public function conta(){
        $usuario = User::find(\Auth::user()->id);
        return view('admin.usuarios.autoEdit', compact('usuario'));
    }

    public function switchStatusUsuario(Request $request){
        $usuario = User::find($request->id);
        ($usuario->status == 1) ? $usuario->status = 0 : $usuario->status = 1 ;
        $usuario->save();
    }

    public function slavarUsuario(Request $request){
        $usuario = new User();
        $usuario->nome = $request->nome;
        $usuario->email = $request->email;
        $usuario->id_perfil = $request->perfil;
        
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
                    'message' => 'Usuário ' . $usuario->nome . ' foi incluído(a) com sucesso!', 
                    'alert-type' => 'success'
                );

                return redirect()->route('usuarios')->with($notification);
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

    public function autalizarUsuario(Request $request){
        $usuario = User::find($request->id);
        $usuario->nome = $request->nome;
        $usuario->email = $request->email;
        $usuario->id_perfil = $request->perfil;
        
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

                return redirect()->route('usuarios')->with($notification);
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

    public function autalizarConta(Request $request){
        $usuario = User::find(\Auth::user()->id);
        $usuario->nome = $request->nome;
        $usuario->email = $request->email;
        $usuario->id_perfil = $request->perfil;
        
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
    // ================================================================================================================
}

?>