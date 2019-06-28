<?php

namespace App\Http\Controllers;

use DataTables;
use App\TblPerfil;
use App\TblIgreja;
use App\TblPerfisPermissoes;
use App\TblIgrejasModulos;
use App\TblPerfisIgrejasModulos;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TblPerfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('perfis.index');
    }

    public function tbl_perfis()
    {
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
        return view('perfis.permissoes', compact('perfil','modulos', 'permissoes'));
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

    public function switchStatus(Request $request){
        $perfil = TblPerfil::find($request->id);
        ($perfil->status == 1) ? $perfil->status = 0 : $perfil->status = 1 ;
        $perfil->save();
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function show(Perfil $perfil)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $perfil = TblPerfil::find($id);
        $modulos = obter_modulos_perfil($perfil);
        return view('perfis.edit', compact('perfil','modulos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function destroy(Perfil $perfil)
    {
        //
    }
}
