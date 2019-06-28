<?php

namespace App\Http\Controllers;

use App\Tbl_Permissao;
use Illuminate\Http\Request;

class TblPermissaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function json_permissoes(){
        $permissoes = TblPermissao::orderBy('nome', 'ASC');
        return DataTables::of($permissoes)->make(true);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tbl_Permissao  $tbl_Permissao
     * @return \Illuminate\Http\Response
     */
    public function show(Tbl_Permissao $tbl_Permissao)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tbl_Permissao  $tbl_Permissao
     * @return \Illuminate\Http\Response
     */
    public function edit(Tbl_Permissao $tbl_Permissao)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tbl_Permissao  $tbl_Permissao
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tbl_Permissao $tbl_Permissao)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tbl_Permissao  $tbl_Permissao
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tbl_Permissao $tbl_Permissao)
    {
        //
    }
}
