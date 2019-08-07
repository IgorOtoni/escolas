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
use App\TblProdutos;
use App\TblOfertasProdutos;
use App\TblCategoriasProdutos;
use App\TblTurnosEntregas;
use App\TblVendas;
use App\TblVendasProdutos;
use App\User;
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
        return view('template' . $igreja->id_template . '.index', compact('igreja', 'modulos', 'banners', 'eventos', 'noticias', 'galerias', 'fotos', 'menus', 'submenus', 'subsubmenus'));
    }
    public function ministros($url)
    {
        $igreja = obter_dados_igreja($url);
        $modulos = obter_modulos_apresentativos_igreja($igreja);
        $retorno = obter_menus_configuracao($igreja->id_configuracao);
        $menus = $retorno[0];
        $submenus = $retorno[1];
        $subsubmenus = $retorno[2];
        return view('template' . $igreja->id_template . '.ministros', compact('igreja', 'modulos', 'menus', 'submenus', 'subsubmenus'));
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
        return view('template' . $igreja->id_template . '.noticias', compact('igreja', 'modulos', 'noticias', 'menus', 'submenus', 'subsubmenus'));
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
        return view('template' . $igreja->id_template . '.noticiadetalhada', compact('igreja', 'modulos', 'noticia', 'menus', 'submenus', 'subsubmenus'));
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
        return view('template' . $igreja->id_template . '.sermoes', compact('igreja', 'modulos', 'sermoes', 'menus', 'submenus', 'subsubmenus'));
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
        return view('template' . $igreja->id_template . '.sermaodetalhado', compact('igreja', 'modulos', 'sermao', 'menus', 'submenus', 'subsubmenus'));
    }
    public function contato($url)
    {
        $igreja = obter_dados_igreja($url);
        $modulos = obter_modulos_apresentativos_igreja($igreja);
        $retorno = obter_menus_configuracao($igreja->id_configuracao);
        $menus = $retorno[0];
        $submenus = $retorno[1];
        $subsubmenus = $retorno[2];
        return view('template' . $igreja->id_template . '.contato', compact('igreja', 'modulos', 'menus', 'submenus', 'subsubmenus'));
    }
    public function apresentacao($url)
    {
        $igreja = obter_dados_igreja($url);
        $modulos = obter_modulos_apresentativos_igreja($igreja);
        $retorno = obter_menus_configuracao($igreja->id_configuracao);
        $funcoes = TblFuncoes::where('id_igreja','=',$igreja->id)->where('apresentar','=',true)->get();
        $membros = null;
        foreach($funcoes as $funcao){
            $membros[$funcao->id] = TblMembros::where('id_funcao','=',$funcao->id)->where('ativo','=',true)->where('id_igreja','=',$funcao->id_igreja)->get();
        }
        $menus = $retorno[0];
        $submenus = $retorno[1];
        $subsubmenus = $retorno[2];
        return view('template' . $igreja->id_template . '.apresentacao', compact('igreja', 'funcoes', 'membros', 'modulos', 'menus', 'submenus', 'subsubmenus'));
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
        }else if($igreja->id_template == 1 || $igreja->id_template == 6){
            $eventos_fixos = \DB::table('tbl_eventos_fixos')
                ->where('id_igreja', '=', $igreja->id)
                ->paginate(3);
        }else{
            $eventos_fixos = \DB::table('tbl_eventos_fixos')
                ->where('id_igreja', '=', $igreja->id)
                ->paginate(4);
        }
        return view('template' . $igreja->id_template . '.eventosfixos', compact('igreja', 'modulos', 'eventos_fixos', 'menus', 'submenus', 'subsubmenus'));
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
        return view('template' . $igreja->id_template . '.eventofixodetalhado', compact('igreja', 'modulos', 'eventofixo', 'menus', 'submenus', 'subsubmenus'));
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
        return view('template' . $igreja->id_template . '.eventos', compact('igreja', 'modulos', 'eventos', 'menus', 'submenus', 'subsubmenus'));
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
        return view('template' . $igreja->id_template . '.eventodetalhado', compact('igreja', 'modulos', 'evento', 'menus', 'submenus', 'subsubmenus'));
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
        $galerias = null;
        if($igreja->id_template == 6){
            $galerias = \DB::table('tbl_galerias')
                ->where('id_igreja', '=', $igreja->id)
                ->orderBy('data', 'DESC')
                ->orderBy('created_at', 'DESC')
                ->paginate(2);
        }else{
            $galerias = \DB::table('tbl_galerias')
                ->where('id_igreja', '=', $igreja->id)
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
        return view('template' . $igreja->id_template . '.galeria', compact('igreja', 'modulos', 'galerias', 'fotos', 'menus', 'submenus', 'subsubmenus'));
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
        return view('template' . $igreja->id_template . '.publicacao', compact('igreja', 'modulos', 'publicacao', 'galeria_publicacao', 'menus', 'submenus', 'subsubmenus'));
    }
    public function gerar_termo_compromisso($id){
        $igreja = TblIgreja::find($id);
        $nome = $igreja->nome;
        $cnpj = $igreja->cnpj;
        $cep = $igreja->cep;
        $rua = $igreja->rua;
        $num = $igreja->num;
        return view('termoCompromisso', compact('nome', 'cnpj', 'cep', 'rua', 'num'));
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

        return view('template' . $igreja->id_template . '.confirmacaoDados', compact('igreja', 'modulos', 'menus', 'submenus', 'subsubmenus'));
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

        return view('template' . $igreja->id_template . '.confirmacaoDados', compact('igreja', 'modulos', 'menus', 'submenus', 'subsubmenus'));
    }
    /////////////////////////////////////////////////////////////////////////////////////
    public function produtos($url){
        $igreja = obter_dados_igreja($url);
        $categorias = TblCategoriasProdutos::where('id_igreja','=',$igreja->id)
            ->orderBy('nome', 'ASC')
            ->get();
        $produtos = TblProdutos::where('id_igreja','=',$igreja->id)
            ->where('situacao','=',true)
            ->orderBy('nome', 'ASC')
            ->paginate(8);
        $ofertas = null;
        foreach($produtos as $produto){
            $ofertas_ = TblOfertasProdutos::where('id_produto','=',$produto->id)
                ->where('id_igreja','=',$igreja->id)
                ->where('data_inicio','<=', \Carbon\Carbon::parse(time())->format('Y-m-d'))
                ->where('data_fim','>=', \Carbon\Carbon::parse(time())->format('Y-m-d'))
                ->get();
            if($ofertas_ != null && sizeof($ofertas_) > 0){
                $ofertas[$produto->id] = $ofertas_[0];
            }
        }
        return view('carrinho.produtos', compact('igreja','produtos','ofertas','categorias'));
    }
    public function carrinho($url){
        $igreja = obter_dados_igreja($url);
        $produtos = null;
        if(null !== \Session()->get('carrinho') && is_array(\Session()->get('carrinho'))) for($x = 0; $x < sizeof(\Session()->get('carrinho')) ; $x++){
            $produtos[$x] = TblProdutos::find(\Session()->get('carrinho')[$x]);
        }
        $ofertas = null;
        if($produtos != null) foreach($produtos as $produto){
            $ofertas_ = TblOfertasProdutos::where('id_produto','=',$produto->id)
                ->where('id_igreja','=',$igreja->id)
                ->where('data_inicio','<=', \Carbon\Carbon::parse(time())->format('Y-m-d'))
                ->where('data_fim','>=', \Carbon\Carbon::parse(time())->format('Y-m-d'))
                ->get();
            if($ofertas_ != null && sizeof($ofertas_) > 0){
                $ofertas[$produto->id] = $ofertas_[0];
            }
        }
        return view('carrinho.carrinho', compact('igreja','produtos','ofertas'));
    }
    public function adicionarProduto($url, Request $request){
        $igreja = obter_dados_igreja($url);
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
        $igreja = obter_dados_igreja($url);

        \Session()->put('carrinho', null);
        \Session()->put('carrinho_qtd', null);

        $notification = array(
            'message' => 'Produtos removidos!', 
            'alert-type' => 'error'
        );

        return redirect()->back()->with($notification);
    }
    public function removerProduto($url, Request $request){
        $igreja = obter_dados_igreja($url);

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
        $igreja = obter_dados_igreja($url);

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
        $igreja = obter_dados_igreja($url);

        if(isset($request->nome)){
            $nome = trim($request->nome);
            if(strlen($nome) > 0){
                $produtos = TblProdutos::where('id_igreja','=',$igreja->id)
                    ->where('situacao','=',true)
                    ->where('nome', 'like', '%'.$nome.'%')
                    ->orderBy('nome', 'ASC')
                    ->paginate(8);
            }else{
                $produtos = TblProdutos::where('id_igreja','=',$igreja->id)
                    ->where('situacao','=',true)
                    ->orderBy('nome', 'ASC')
                    ->paginate(8);
            }
        }else if(isset($request->categoria)){
            $produtos = TblProdutos::where('id_igreja','=',$igreja->id)
                ->where('situacao','=',true)
                ->where('id_categoria', '=', $request->categoria)
                ->orderBy('nome', 'ASC')
                ->paginate(8);
        }else{
            $produtos = TblProdutos::where('id_igreja','=',$igreja->id)
                ->where('situacao','=',true)
                ->orderBy('nome', 'ASC')
                ->paginate(8);
        }

        $categorias = TblCategoriasProdutos::where('id_igreja','=',$igreja->id)
            ->orderBy('nome', 'ASC')
            ->get();
        
        $ofertas = null;
        foreach($produtos as $produto){
            $ofertas_ = TblOfertasProdutos::where('id_produto','=',$produto->id)
                ->where('id_igreja','=',$igreja->id)
                ->where('data_inicio','<=', \Carbon\Carbon::parse(time())->format('Y-m-d'))
                ->where('data_fim','>=', \Carbon\Carbon::parse(time())->format('Y-m-d'))
                ->get();
            if($ofertas_ != null && sizeof($ofertas_) > 0){
                $ofertas[$produto->id] = $ofertas_[0];
            }
        }
        return view('carrinho.produtos', compact('igreja','produtos','ofertas','categorias'));
    }
    public function finalizarCompra($url, Request $request){
        $igreja = obter_dados_igreja($url);
        if(isset(\Auth::user()->id) && \Auth::user()->id_perfil == 100){
            $turnos = TblTurnosEntregas::all();
            return view('carrinho.finalizar', compact('igreja','turnos'));
        }else{
            return redirect()->route('igreja.produtos', $igreja->url);
        }
    }
    public function salvarCompra($url, Request $request){
        $igreja = obter_dados_igreja($url);

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
                    ->where('id_igreja','=',$igreja->id)
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
            $venda->id_igreja = $igreja->id;
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

            return view('carrinho.compraFinalizada', compact('igreja','venda'));
        }else{
            return redirect()->route('igreja.produtos', $igreja->url);
        }
    }
    public function nota_encomenda($id){
        $venda = TblVendas::find($id);
        $comprador = User::find($venda->id_usuario);
        $vendedor = TblIgreja::find($venda->id_igreja);
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

    }
    public function desativar_conta($url){

    }
    public function compras($url){
        $igreja = obter_dados_igreja($url);

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

            return view('carrinho.compras', compact('igreja', 'compras'));
        }else{
            return redirect()->route('igreja.produtos', $igreja->url);
        }
    }
}