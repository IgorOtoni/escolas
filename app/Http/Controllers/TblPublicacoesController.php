<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TblPublicacoesController extends Controller
{
    public function index()
    {
        return view('publicacoes.index');
    }

    public function upload_editor(Request $request){
        echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction(0, 'storage/banners/banner-1-1.jpg', 'OK');</script>";
    }

    public function store(Request $request)
    {
        dd($request->all());
    }
}
