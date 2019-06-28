<?php

namespace App\Http\Controllers;
use Image;
use DataTables;
use App\TblIgreja;
use App\TblConfiguracoes;
use App\TblIgrejasModulos;
use App\TblModulo;
use App\TblMenu;
use App\TblSubMenu;
use App\TblSubSubMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;
class TblIgrejaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('igrejas.index');
    }

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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
        $igreja->logo = "vazio";

        $count = TblIgreja::where("nome", "=", $igreja->nome)->count();
        if($count == 0){
            $igreja->save();

            //convertendo imagem base64
            $img = $request->logo;

            \Image::make($request->logo)->save(public_path('storage/igrejas/').'logo-igreja-'.$igreja->id.'.'.strtolower($request->logo->getClientOriginalExtension()),90);

            $igreja->logo = 'logo-igreja-'.$igreja->id.'.'.strtolower($request->logo->getClientOriginalExtension());

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

    /**
     * Display the specified resource.
     *
     * @param  \App\Tbl_Igreja  $tbl_Igreja
     * @return \Illuminate\Http\Response
     */
    public function show(Tbl_Igreja $tbl_Igreja)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tbl_Igreja  $tbl_Igreja
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $igreja = TblIgreja::findOrfail($id);
        $modulos_igreja = TblIgrejasModulos::where('id_igreja', '=', $id)->get();
        return view('igrejas.edit', compact('igreja','modulos_igreja'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tbl_Igreja  $tbl_Igreja
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request){
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

        $count = TblIgreja::where("nome", "=", $igreja->nome)->where("id", "<>", $request->id)->count();
        if($count == 0){
            if($request->logo){
                //convertendo imagem base64
                $img = $request->logo;
                \Image::make($request->logo)->save(public_path('storage/igrejas/').'logo-igreja-'.$igreja->id.'.'.strtolower($request->logo->getClientOriginalExtension()),90);
                $igreja->logo = 'logo-igreja-'.$igreja->id.'.'.strtolower($request->logo->getClientOriginalExtension());
            }

            $igreja->save();

            TblIgrejasModulos::where('id_igreja', '=',  $request->id)->delete();

            $modulo = new TblIgrejasModulos();

            foreach ($request->modulos as $key => $value) {
                $data = [
                    'id_igreja' => $igreja->id,
                    'id_modulo' => $value
                ];
                $modulo->create($data);
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
        $logo = $request['logo'];
        $igreja = TblIgreja::find($request->id);
        $igreja->logo = null;
        $igreja->save();
        File::delete(public_path().'/storage/igrejas/'.$logo);
        return \Response::json(['message' => 'File successfully delete'], 200);
    }

    public function configuracoes($id){
        $igreja = obter_dados_igreja_id($id);
        $modulos_igreja = obter_modulos_apresentativos_igreja($igreja);
        $retorno = obter_menus_configuracao($igreja->id_configuracao);
        $menus = $retorno[0];
        $submenus = $retorno[1];
        $subsubmenus = $retorno[2];
        return view('igrejas.configuracoes', compact('igreja','modulos_igreja','menus','submenus','subsubmenus'));
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

        $count = TblIgreja::where("nome", "=", $igreja->nome)->where("id", "<>", $request->id)->count();
        if($count == 0){
            if($request->logo){
                //convertendo imagem base64
                $img = $request->logo;
                \Image::make($request->logo)->save(public_path('storage/igrejas/').'logo-igreja-'.$igreja->id.'.'.strtolower($request->logo->getClientOriginalExtension()),90);
                $igreja->logo = 'logo-igreja-'.$igreja->id.'.'.strtolower($request->logo->getClientOriginalExtension());
            }

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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tbl_Igreja  $tbl_Igreja
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tbl_Igreja $tbl_Igreja)
    {
        
    }
}
