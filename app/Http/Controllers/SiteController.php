<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\TblSites;
use App\TblConfiguracoes;
use App\TblSitesModulos;
use App\TblContatos;
use App\TblInscricoes;
use App\TblMembros;
use App\TblFuncoes;
use App\TblProdutos;
use App\TblProdutosFotos;
use App\TblOfertasProdutos;
use App\TblCategoriasProdutos;
use App\TblTurnosEntregas;
use App\TblVendas;
use App\TblVendasProdutos;
use App\User;
use Symfony\Component\HttpFoundation\Response;
class SiteController extends Controller
{
    public function index($url)
    {
        $site = obter_dados_site($url);
        $modulos = obter_modulos_apresentativos_site($site);
        $banners = \DB::table('tbl_banners')
            ->where('id_site', '=', $site->id)
            ->orderBy('ordem', 'ASC')
            ->get();
        /*$eventos_fixos = \DB::table('tbl_eventos_fixos')
            ->where('id_site', '=', $site->id)
            ->get();*/
        $eventos = \DB::table('tbl_eventos')
            ->where('id_site', '=', $site->id)
            ->orderBy('dados_horario_inicio','DESC')
            ->limit(4)
            ->get();
        $noticias = \DB::table('tbl_noticias')
            ->where('id_site', '=', $site->id)
            ->orderBy('created_at','DESC')
            ->limit(3)
            ->get();
        $site = obter_dados_site($url);
        $modulos = obter_modulos_apresentativos_site($site);
        $galerias = \DB::table('tbl_galerias')
            ->where('id_site', '=', $site->id)
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
        $retorno = obter_menus_configuracao($site->id_configuracao);
        $menus = $retorno[0];
        $submenus = $retorno[1];
        $subsubmenus = $retorno[2];
        return view('template' . $site->id_template . '.index', compact('site', 'modulos', 'banners', 'eventos', 'noticias', 'galerias', 'fotos', 'menus', 'submenus', 'subsubmenus'));
    }
    public function ministros($url)
    {
        $site = obter_dados_site($url);
        $modulos = obter_modulos_apresentativos_site($site);
        $retorno = obter_menus_configuracao($site->id_configuracao);
        $menus = $retorno[0];
        $submenus = $retorno[1];
        $subsubmenus = $retorno[2];
        return view('template' . $site->id_template . '.ministros', compact('site', 'modulos', 'menus', 'submenus', 'subsubmenus'));
    }
    public function noticias($url)
    {
        $site = obter_dados_site($url);
        $modulos = obter_modulos_apresentativos_site($site);
        $noticias = \DB::table('tbl_noticias')
            ->where('id_site', '=', $site->id)
            ->orderBy('created_at', 'DESC')
            ->paginate(3);
        $retorno = obter_menus_configuracao($site->id_configuracao);
        $menus = $retorno[0];
        $submenus = $retorno[1];
        $subsubmenus = $retorno[2];
        return view('template' . $site->id_template . '.noticias', compact('site', 'modulos', 'noticias', 'menus', 'submenus', 'subsubmenus'));
    }
    public function noticia($url,$id)
    {
        $site = obter_dados_site($url);
        $modulos = obter_modulos_apresentativos_site($site);
        $retorno = obter_menus_configuracao($site->id_configuracao);
        $menus = $retorno[0];
        $submenus = $retorno[1];
        $subsubmenus = $retorno[2];
        $noticia = \DB::table('tbl_noticias')
        ->where('id', '=', $id)
            ->where('id_site', '=', $site->id)
            ->orderBy('created_at', 'DESC')
            ->paginate(3);
        $noticia = $noticia[0];
        return view('template' . $site->id_template . '.noticiadetalhada', compact('site', 'modulos', 'noticia', 'menus', 'submenus', 'subsubmenus'));
    }
    public function midias($url)
    {
        $site = obter_dados_site($url);
        $modulos = obter_modulos_apresentativos_site($site);
        $retorno = obter_menus_configuracao($site->id_configuracao);
        $menus = $retorno[0];
        $submenus = $retorno[1];
        $subsubmenus = $retorno[2];
        $midias = \DB::table('tbl_midias')
            ->where('id_site', '=', $site->id)
            ->orderBy('created_at', 'DESC')
            ->paginate(4);
        return view('template' . $site->id_template . '.midias', compact('site', 'modulos', 'midias', 'menus', 'submenus', 'subsubmenus'));
    }
    public function midia($url,$id)
    {
        $site = obter_dados_site($url);
        $modulos = obter_modulos_apresentativos_site($site);
        $retorno = obter_menus_configuracao($site->id_configuracao);
        $menus = $retorno[0];
        $submenus = $retorno[1];
        $subsubmenus = $retorno[2];
        $midia = \DB::table('tbl_midias')
            ->where('id', '=', $id)
            ->where('id_site', '=', $site->id)
            ->get();
        $midia = $midia[0];
        return view('template' . $site->id_template . '.midiadetalhado', compact('site', 'modulos', 'midia', 'menus', 'submenus', 'subsubmenus'));
    }
    public function contato($url)
    {
        $site = obter_dados_site($url);
        $modulos = obter_modulos_apresentativos_site($site);
        $retorno = obter_menus_configuracao($site->id_configuracao);
        $menus = $retorno[0];
        $submenus = $retorno[1];
        $subsubmenus = $retorno[2];
        return view('template' . $site->id_template . '.contato', compact('site', 'modulos', 'menus', 'submenus', 'subsubmenus'));
    }
    public function apresentacao($url)
    {
        $site = obter_dados_site($url);
        $modulos = obter_modulos_apresentativos_site($site);
        $retorno = obter_menus_configuracao($site->id_configuracao);
        $funcoes = TblFuncoes::where('id_site','=',$site->id)->where('apresentar','=',true)->get();
        $membros = null;
        foreach($funcoes as $funcao){
            $membros[$funcao->id] = TblMembros::where('id_funcao','=',$funcao->id)->where('ativo','=',true)->where('id_site','=',$funcao->id_site)->get();
        }
        $menus = $retorno[0];
        $submenus = $retorno[1];
        $subsubmenus = $retorno[2];
        return view('template' . $site->id_template . '.apresentacao', compact('site', 'funcoes', 'membros', 'modulos', 'menus', 'submenus', 'subsubmenus'));
    }
    public function eventosfixos($url)
    {
        $site = obter_dados_site($url);
        $modulos = obter_modulos_apresentativos_site($site);
        $retorno = obter_menus_configuracao($site->id_configuracao);
        $menus = $retorno[0];
        $submenus = $retorno[1];
        $subsubmenus = $retorno[2];
        if($site->id_template == 2){
            $eventos_fixos = \DB::table('tbl_eventos_fixos')
                ->where('id_site', '=', $site->id)
                ->get();
        }else if($site->id_template == 1 || $site->id_template == 6){
            $eventos_fixos = \DB::table('tbl_eventos_fixos')
                ->where('id_site', '=', $site->id)
                ->paginate(3);
        }else{
            $eventos_fixos = \DB::table('tbl_eventos_fixos')
                ->where('id_site', '=', $site->id)
                ->paginate(4);
        }
        return view('template' . $site->id_template . '.eventosfixos', compact('site', 'modulos', 'eventos_fixos', 'menus', 'submenus', 'subsubmenus'));
    }
    public function eventofixo($url,$id)
    {
        $site = obter_dados_site($url);
        $modulos = obter_modulos_apresentativos_site($site);
        $retorno = obter_menus_configuracao($site->id_configuracao);
        $menus = $retorno[0];
        $submenus = $retorno[1];
        $subsubmenus = $retorno[2];
        $eventofixo = \DB::table('tbl_eventos_fixos')
            ->where('id', '=', $id)
            ->where('id_site', '=', $site->id)
            ->get();
        $eventofixo = $eventofixo[0];
        return view('template' . $site->id_template . '.eventofixodetalhado', compact('site', 'modulos', 'eventofixo', 'menus', 'submenus', 'subsubmenus'));
    }
    public function eventos($url)
    {
        $site = obter_dados_site($url);
        $modulos = obter_modulos_apresentativos_site($site);
        $retorno = obter_menus_configuracao($site->id_configuracao);
        $menus = $retorno[0];
        $submenus = $retorno[1];
        $subsubmenus = $retorno[2];
        if($site->id_template != 2){
            $eventos = \DB::table('tbl_eventos')
                ->where('id_site', '=', $site->id)
                ->where(function ($query) {
                    $query->where('dados_horario_inicio', '>=', date('Y-m-d h:i:s', time()))
                        ->orWhere('dados_horario_fim', '>=', date('Y-m-d h:i:s', time()));
                })
                ->orderBy('dados_horario_inicio', 'DESC')
                ->paginate(4);
        }else{
            $eventos = \DB::table('tbl_eventos')
                ->where('id_site', '=', $site->id)
                ->where(function ($query) {
                    $query->where('dados_horario_inicio', '>=', date('Y-m-d h:i:s', time()))
                        ->orWhere('dados_horario_fim', '>=', date('Y-m-d h:i:s', time()));
                })
                ->orderBy('dados_horario_inicio', 'DESC')
                ->get();
        }
        return view('template' . $site->id_template . '.eventos', compact('site', 'modulos', 'eventos', 'menus', 'submenus', 'subsubmenus'));
    }
    public function evento($url,$id)
    {
        $site = obter_dados_site($url);
        $modulos = obter_modulos_apresentativos_site($site);
        $retorno = obter_menus_configuracao($site->id_configuracao);
        $menus = $retorno[0];
        $submenus = $retorno[1];
        $subsubmenus = $retorno[2];
        $evento = \DB::table('tbl_eventos')
            ->where('id', '=', $id)
            ->where('id_site', '=', $site->id)
            ->get();
        $evento = $evento[0];
        return view('template' . $site->id_template . '.eventodetalhado', compact('site', 'modulos', 'evento', 'menus', 'submenus', 'subsubmenus'));
    }
    public function login($url)
    {
        $site = obter_dados_site($url);
        return view('auth.login',compact('site'));
    }
    public function galeria($url)
    {
        $site = obter_dados_site($url);
        $modulos = obter_modulos_apresentativos_site($site);
        $retorno = obter_menus_configuracao($site->id_configuracao);
        $menus = $retorno[0];
        $submenus = $retorno[1];
        $subsubmenus = $retorno[2];
        $galerias = null;
        if($site->id_template == 6){
            $galerias = \DB::table('tbl_galerias')
                ->where('id_site', '=', $site->id)
                ->orderBy('data', 'DESC')
                ->orderBy('created_at', 'DESC')
                ->paginate(2);
        }else{
            $galerias = \DB::table('tbl_galerias')
                ->where('id_site', '=', $site->id)
                ->orderBy('data', 'DESC')
                ->orderBy('created_at', 'DESC')
                ->paginate(4);
        }
        $fotos = array();
        foreach($galerias as $galeria){
            $fotos_ = \DB::table('tbl_fotos')
                ->where('id_galeria', '=', $galeria->id)
                ->orderBy('created_at', 'DESC')
                ->get();
            $fotos[$galeria->id] = $fotos_;
        }
        return view('template' . $site->id_template . '.galeria', compact('site', 'modulos', 'galerias', 'fotos', 'menus', 'submenus', 'subsubmenus'));
    }
    public function publicacao($url,$id){
        $site = obter_dados_site($url);
        $modulos = obter_modulos_apresentativos_site($site);
        $retorno = obter_menus_configuracao($site->id_configuracao);
        $menus = $retorno[0];
        $submenus = $retorno[1];
        $subsubmenus = $retorno[2];
        $publicacao = \DB::table('tbl_publicacoes')
            ->where('id_site', '=', $site->id)
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
        return view('template' . $site->id_template . '.publicacao', compact('site', 'modulos', 'publicacao', 'galeria_publicacao', 'menus', 'submenus', 'subsubmenus'));
    }
    public function gerar_termo_compromisso($id){
        $site = TblSites::find($id);
        $nome = $site->nome;
        $cnpj = $site->cnpj;
        $cep = $site->cep;
        $rua = $site->rua;
        $num = $site->num;
        return view('termoCompromisso', compact('nome', 'cnpj', 'cep', 'rua', 'num'));
    }
    public function carrega_imagem($largura,$altura,$pasta,$arquivo){
        return view('exemplo2', compact('largura', 'altura', 'pasta', 'arquivo'));
    }
    public function carrega_imagem_($largura,$pasta,$arquivo){
        return view('exemplo2', compact('largura', 'pasta', 'arquivo'));
    }
    public function inscreveEnvento($url, Request $request){
        $site = obter_dados_site($url);
        $modulos = obter_modulos_apresentativos_site($site);
        $retorno = obter_menus_configuracao($site->id_configuracao);
        $menus = $retorno[0];
        $submenus = $retorno[1];
        $subsubmenus = $retorno[2];

        $inscricao = new TblInscricoes();
        $inscricao->email = $request->email;
        $inscricao->telefone = $request->telefone;
        $inscricao->id_evento = $request->id_evento;
        $inscricao->save();

        return view('template' . $site->id_template . '.confirmacaoDados', compact('site', 'modulos', 'menus', 'submenus', 'subsubmenus'));
    }
    public function enviaContato($url, Request $request){
        $site = obter_dados_site($url);
        $modulos = obter_modulos_apresentativos_site($site);
        $retorno = obter_menus_configuracao($site->id_configuracao);
        $menus = $retorno[0];
        $submenus = $retorno[1];
        $subsubmenus = $retorno[2];

        $contato = new TblContatos();
        $contato->nome = $request->nome;
        $contato->email = $request->email;
        $contato->telefone = $request->telefone;
        $contato->mensagem = $request->mensagem;
        $contato->id_site = $site->id;
        $contato->save();

        return view('template' . $site->id_template . '.confirmacaoDados', compact('site', 'modulos', 'menus', 'submenus', 'subsubmenus'));
    }
    /////////////////////////////////////////////////////////////////////////////////////
    public function produtos($url){
        $site = obter_dados_site($url);
        $categorias = TblCategoriasProdutos::where('id_site','=',$site->id)
            ->orderBy('nome', 'ASC')
            ->get();
        $produtos = TblProdutos::where('id_site','=',$site->id)
            ->where('situacao','=',true)
            ->orderBy('nome', 'ASC')
            ->paginate(8);
        $ofertas = null;
        foreach($produtos as $produto){
            $ofertas_ = TblOfertasProdutos::where('id_produto','=',$produto->id)
                ->where('id_site','=',$site->id)
                ->where('data_inicio','<=', \Carbon\Carbon::parse(time())->format('Y-m-d'))
                ->where('data_fim','>=', \Carbon\Carbon::parse(time())->format('Y-m-d'))
                ->get();
            if($ofertas_ != null && sizeof($ofertas_) > 0){
                $ofertas[$produto->id] = $ofertas_[0];
            }
        }
        return view('carrinho.produtos', compact('site','produtos','ofertas','categorias'));
    }
    public function produto($url, $id){
        $site = obter_dados_site($url);
        $produto = TblProdutos::find($id);
        $categoria = TblCategoriasProdutos::find($produto->id_categoria);
        $oferta = TblOfertasProdutos::where('id_produto','=',$produto->id)
            ->where('id_site','=',$site->id)
            ->where('data_inicio','<=', \Carbon\Carbon::parse(time())->format('Y-m-d'))
            ->where('data_fim','>=', \Carbon\Carbon::parse(time())->format('Y-m-d'))
            ->get();
        $oferta = ($oferta != null && sizeof($oferta) == 1) ? $oferta[0] : null;
        $fotos = TblProdutosFotos::where('id_produto','=',$produto->id)->get();
        return view('carrinho.produto', compact('site','produto','oferta','categoria','fotos'));
    }
    public function carrinho($url){
        $site = obter_dados_site($url);
        $produtos = null;
        if(null !== \Session()->get('carrinho') && is_array(\Session()->get('carrinho'))) for($x = 0; $x < sizeof(\Session()->get('carrinho')) ; $x++){
            $produtos[$x] = TblProdutos::find(\Session()->get('carrinho')[$x]);
        }
        $ofertas = null;
        if($produtos != null) foreach($produtos as $produto){
            $ofertas_ = TblOfertasProdutos::where('id_produto','=',$produto->id)
                ->where('id_site','=',$site->id)
                ->where('data_inicio','<=', \Carbon\Carbon::parse(time())->format('Y-m-d'))
                ->where('data_fim','>=', \Carbon\Carbon::parse(time())->format('Y-m-d'))
                ->get();
            if($ofertas_ != null && sizeof($ofertas_) > 0){
                $ofertas[$produto->id] = $ofertas_[0];
            }
        }
        return view('carrinho.carrinho', compact('site','produtos','ofertas'));
    }
    public function adicionarProduto($url, Request $request){
        $site = obter_dados_site($url);
        $produto = TblProdutos::find($request->id);
        if(null !== \Session()->get('carrinho')){
            $pos = sizeof(\Session()->get('carrinho'));
            $produtos = \Session()->get('carrinho');
            $produtos_qtd = \Session()->get('carrinho_qtd');

            $produtos[$pos] = $produto->id;
            $produtos_qtd[$pos] = 1;

            \Session()->put('carrinho', $produtos);
            \Session()->put('carrinho_qtd', $produtos_qtd);
        }else{
            \Session()->put('carrinho', array($produto->id));
            \Session()->put('carrinho_qtd', array(1));
        }

        $notification = array(
            'message' => 'Produto adicionado!', 
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
    public function limparCarrinho($url, Request $request){
        $site = obter_dados_site($url);

        \Session()->put('carrinho', null);
        \Session()->put('carrinho_qtd', null);

        $notification = array(
            'message' => 'Produtos removidos!', 
            'alert-type' => 'error'
        );

        return redirect()->back()->with($notification);
    }
    public function removerProduto($url, Request $request){
        $site = obter_dados_site($url);

        $produtos_ = null;
        $produtos_qtd_ = null;
        
        $produtos = \Session()->get('carrinho');
        $produtos_qtd = \Session()->get('carrinho_qtd');

        $x = 0;
        $tam = sizeof(\Session()->get('carrinho'));
        for($pos = 0; $pos < $tam; $pos++){
            if(\Session()->get('carrinho')[$pos] != $request->id){
                $produtos_[$x] = $produtos[$pos];
                $produtos_qtd_[$x] = $produtos_qtd[$pos];
                $x++;
            }
        }

        \Session()->put('carrinho', $produtos_);
        \Session()->put('carrinho_qtd', $produtos_qtd_);

        $notification = array(
            'message' => 'Produto removido!', 
            'alert-type' => 'error'
        );

        return redirect()->back()->with($notification);
    }
    public function alterarProduto($url, Request $request){
        $site = obter_dados_site($url);

        $produtos = \Session()->get('carrinho');
        $produtos_qtd = \Session()->get('carrinho_qtd');

        $x = 0;
        $tam = sizeof(\Session()->get('carrinho'));
        for($pos = 0; $pos < $tam; $pos++){
            if(\Session()->get('carrinho')[$pos] == $request->id){
                $produtos_qtd[$pos] = $request->qtd;
                \Session()->put('carrinho_qtd', $produtos_qtd);
                break;
            }
        }

        $notification = array(
            'message' => 'Produto alterado!', 
            'alert-type' => 'warning'
        );

        return redirect()->back()->with($notification);
    }
    public function filtrarProdutos($url, Request $request){
        $site = obter_dados_site($url);

        if(isset($request->nome)){
            $nome = trim($request->nome);
            if(strlen($nome) > 0){
                $produtos = TblProdutos::where('id_site','=',$site->id)
                    ->where('situacao','=',true)
                    ->where('nome', 'like', '%'.$nome.'%')
                    ->orderBy('nome', 'ASC')
                    ->paginate(8);
            }else{
                $produtos = TblProdutos::where('id_site','=',$site->id)
                    ->where('situacao','=',true)
                    ->orderBy('nome', 'ASC')
                    ->paginate(8);
            }
        }else if(isset($request->categoria)){
            $produtos = TblProdutos::where('id_site','=',$site->id)
                ->where('situacao','=',true)
                ->where('id_categoria', '=', $request->categoria)
                ->orderBy('nome', 'ASC')
                ->paginate(8);
        }else{
            $produtos = TblProdutos::where('id_site','=',$site->id)
                ->where('situacao','=',true)
                ->orderBy('nome', 'ASC')
                ->paginate(8);
        }

        $categorias = TblCategoriasProdutos::where('id_site','=',$site->id)
            ->orderBy('nome', 'ASC')
            ->get();
        
        $ofertas = null;
        foreach($produtos as $produto){
            $ofertas_ = TblOfertasProdutos::where('id_produto','=',$produto->id)
                ->where('id_site','=',$site->id)
                ->where('data_inicio','<=', \Carbon\Carbon::parse(time())->format('Y-m-d'))
                ->where('data_fim','>=', \Carbon\Carbon::parse(time())->format('Y-m-d'))
                ->get();
            if($ofertas_ != null && sizeof($ofertas_) > 0){
                $ofertas[$produto->id] = $ofertas_[0];
            }
        }
        return view('carrinho.produtos', compact('site','produtos','ofertas','categorias'));
    }
    public function finalizarCompra($url, Request $request){
        $site = obter_dados_site($url);
        if(isset(\Auth::user()->id) && \Auth::user()->id_perfil == 100){
            $turnos = TblTurnosEntregas::all();
            return view('carrinho.finalizar', compact('site','turnos'));
        }else{
            return redirect()->route('site.produtos', $site->url);
        }
    }
    public function salvarCompra($url, Request $request){
        $site = obter_dados_site($url);

        if(isset(\Auth::user()->id) && \Auth::user()->id_perfil == 100){
            $produtos_vendas = null;
            $valor_total = 0;
            $produtos = null;
            $produtos_qtd = null;
            if(null !== \Session()->get('carrinho') && is_array(\Session()->get('carrinho'))) for($x = 0; $x < sizeof(\Session()->get('carrinho')) ; $x++){
                $produtos[$x] = TblProdutos::find(\Session()->get('carrinho')[$x]);
                $produtos_qtd[$x] = \Session()->get('carrinho_qtd')[$x];
            }
            $ofertas = null;
            if($produtos != null) foreach($produtos as $produto){
                $ofertas_ = TblOfertasProdutos::where('id_produto','=',$produto->id)
                    ->where('id_site','=',$site->id)
                    ->where('data_inicio','<=', \Carbon\Carbon::parse(time())->format('Y-m-d'))
                    ->where('data_fim','>=', \Carbon\Carbon::parse(time())->format('Y-m-d'))
                    ->get();
                if($ofertas_ != null && sizeof($ofertas_) > 0){
                    $ofertas[$produto->id] = $ofertas_[0];
                }
            }

            $x = 0;
            foreach($produtos as $produto){
                $produto_venda = new TblVendasProdutos();
                $produto_venda->qtd = $produtos_qtd[$x];
                $produto_venda->id_produto = $produto->id;
                $produto_venda->valor = $produto->valor;
                $produto_venda->id_tipo_venda = $produto->id_tipo_venda;

                $oferta = ($ofertas != null && array_key_exists($produto->id, $ofertas)) ? $ofertas[$produto->id] : null;
                if($oferta != null){
                    $produto_venda->oferta = $oferta->valor;
                    $valor_total += $produtos_qtd[$x] * ($produto->valor - $produto->valor*$oferta->desconto/100);
                }else{
                    $produto_venda->oferta = 0;
                    $valor_total += $produtos_qtd[$x] * $produto->valor;
                }
                $produtos_vendas[$x] = $produto_venda;
                $x++;
            }

            $venda = new TblVendas();
            $venda->id_usuario = \Auth::user()->id;
            $venda->id_site = $site->id;
            $venda->data = $request->dtentrega;
            $venda->cep = $request->cep;
            $venda->cidade = $request->cidade;
            $venda->bairro = $request->bairro;
            $venda->rua = $request->rua;
            $venda->complemento = $request->complemento;
            $venda->num = $request->num;
            $venda->id_turno = $request->turno;
            $venda->id_situacao = 1; // 1 == PENDENTE
            $venda->valor_total = $valor_total;
            $venda->save();

            foreach($produtos_vendas as $produto_venda){
                $produto_venda->id_venda = $venda->id;
                $produto_venda->save();
            }

            \Session()->put('carrinho', null);
            \Session()->put('carrinho_qtd', null);

            $notification = array(
                'message' => 'Compra realizada!', 
                'alert-type' => 'success'
            );
            \Session()->put($notification);

            return view('carrinho.compraFinalizada', compact('site','venda'));
        }else{
            return redirect()->route('site.produtos', $site->url);
        }
    }
    public function nota_encomenda($id){
        $venda = TblVendas::find($id);
        $comprador = User::find($venda->id_usuario);
        $vendedor = TblSites::find($venda->id_site);
        $turno = TblTurnosEntregas::find($venda->id_turno);
        $produtos_vendas = \DB::table('tbl_vendas_produtos')
            ->select('tbl_vendas_produtos.*','tbl_produtos.nome','tbl_tipos_vendas.nome as tipo')
            ->leftJoin('tbl_produtos','tbl_vendas_produtos.id_produto','=','tbl_produtos.id')
            ->leftJoin('tbl_tipos_vendas','tbl_vendas_produtos.id_tipo_venda','=','tbl_tipos_vendas.id')
            ->where('tbl_vendas_produtos.id_venda','=', $venda->id)
            ->orderBy('tbl_produtos.nome','ASC')
            ->get();
        return view('notaEncomenda', compact('venda', 'turno', 'vendedor', 'comprador', 'produtos_vendas'));
    }
    public function conta($url){
        $site = obter_dados_site($url);

        if(isset(\Auth::user()->id) && \Auth::user()->id_perfil == 100){
            return view('carrinho.conta', compact('site'));
        }else{
            return redirect()->route('site.produtos', $site->url);
        }
    }
    public function alterar_conta($url){
        $site = obter_dados_site($url);

        if(isset(\Auth::user()->id) && \Auth::user()->id_perfil == 100){
            if($request->password_confirmation == $request->password && strlen($request->password) > 0){
                $teste = User::where('email','=',$request->email)->count();
                if($teste == 0){
                    \Auth::user()->nome = $request->nome;
                    \Auth::user()->email = $request->email;
                    \Auth::user()->password = bcrypt($request->password);
                    $user->save();

                    $notification = array(
                        'message' => 'Conta alterada!',
                        'alert-type' => 'success'
                    );

                    return back()->with($notification);
                }else{

                    $notification = array(
                        'message' => 'Esse email não está disponível.',
                        'alert-type' => 'error'
                    );

                    return back()->with($notification);

                }
            }else{

                $notification = array(
                    'message' => 'A senha não confere.',
                    'alert-type' => 'error'
                );

                return back()->with($notification);

            }
        }else{
            return redirect()->route('site.produtos', $site->url);
        }
    }
    public function desativar_conta($url){
        $site = obter_dados_site($url);

        \Auth::user()->status = false;
        \Auth::user()->save();

        return redirect()->route('logout', $site->url);
    }
    public function compras($url){
        $site = obter_dados_site($url);

        if(isset(\Auth::user()->id) && \Auth::user()->id_perfil == 100){
            /*$compras = \DB::table('tbl_vendas')
                ->where('id_usuario','=',\Auth::user()->id)
                ->orderBy('data','ASC')
                ->paginate(10);*/
            $compras = TblVendas::where('id_usuario','=',\Auth::user()->id)
                ->orderBy('data','ASC')
                ->paginate(10);

            foreach($compras as $compra){
                if(\Carbon\Carbon::parse($compra->data)->diffInDays(\Carbon\Carbon::parse(time())) > 0 && $compra->id_situacao == 1){
                    $compra->id_situacao = 2;
                    $compra->save();
                }
            }

            return view('carrinho.compras', compact('site', 'compras'));
        }else{
            return redirect()->route('site.produtos', $site->url);
        }
    }
    public function cadastro($url){
        $site = obter_dados_site($url);

        return view('carrinho.cadastro', compact('site'));
    }
    public function cadastrar($url, Request $request){
        $site = obter_dados_site($url);

        if($request->password_confirmation == $request->password && strlen($request->password) > 0){
            $teste = User::where('email','=',$request->email)->count();
            if($teste == 0){
                $user = new User();
                $user->nome = $request->nome;
                $user->email = $request->email;
                $user->password = bcrypt($request->password);
                $user->id_perfil = 100;
                $user->status = true;
                $user->save();

                \Auth::login($user);

                $notification = array(
                    'message' => 'Cadastro realizado com sucesso!',
                    'alert-type' => 'success'
                );

                return redirect()->route('site.produtos', $site->url)->with($notification);
            }else{

                $notification = array(
                    'message' => 'Esse email não está disponível.',
                    'alert-type' => 'error'
                );

                return back()->with($notification);

            }
        }else{

            $notification = array(
                'message' => 'A senha não confere.',
                'alert-type' => 'error'
            );

            return back()->with($notification);

        }
    }
}