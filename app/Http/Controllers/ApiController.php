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
use App\TblPerfil;
use App\TblMenusAndroid;
use App\User;
use App\TblMembrosComunidades;
use App\TblComunidades;
use Intervention\Image\ImageManagerStatic as Image;

/**
 * @SWG\Swagger(
 *     schemes={"http","https"},
 *     host="localhost/Gratunos/public",
 *     basePath="/",
 *     @SWG\Info(
 *         version="1.0.0",
 *         title="API - Gratunos",
 *         description="Api para comunicação com softwares externos",
 *         @SWG\License(
 *             name="Projeto privado",
 *         )
 *     )
 * )
 */

class ApiController extends Controller{

	/**
	 * @SWG\Get(
	 *      path="/api/sites",
	 *      operationId="sites",
	 *      tags={"Sites"},
	 *      summary="Obtêm os sites da plataforma.",
	 *      @SWG\Response(
	 *          response=200,
	 *          description="Sites do Gratunos."
	 *       ),
	 *      @SWG\Response(response=400, description="Bad request"),
	 *      @SWG\Response(response=404, description="Resource Not Found"),
	 *      @SWG\Response(response=500, description="Internal error."),
	 * )
	 *
	 */
    public function sites(){
    	$sites = TblSites::all();
    	$configuracoes = [];
    	$menus = [];
    	foreach($sites as $site){
    		$site->logo = base64_encode(Image::make($site->logo)->resize(null,100,
    			function ($constraint) {
				    $constraint->aspectRatio();
				    $constraint->upsize();
				}
			)->encode()->encoded);

    		$configuracao = TblConfiguracoes::where('id_site','=',$site->id)->get();
    		if($configuracao != null && sizeof($configuracao) == 1){
    			$configuracoes[$site->id] = $configuracao[0];

	    		$menus_ = TblMenusAndroid::where('id_configuracao','=',$configuracao[0]->id)
	    			->orderBy('ordem', 'ASC')
	    			->get();
	    		$menus[$site->id] = $menus_;
    		}else{
    			$configuracoes[$site->id] = null;
	    		$menus[$site->id] = null;
    		}
    	}
    	return response()->json(
        	['sites' => $sites,'configuracoes' => $configuracoes,'menus' => $menus]
        , 200);
    }

    /**
	 * @SWG\Get(
	 *      path="/api/site/{url}",
	 *      operationId="site",
	 *      tags={"Sites"},
	 *      summary="Obtêm o site da plataforma.",
	 *      @SWG\Parameter(
	 *          name="url",
	 *          description="Url do site.",
	 *          required=true,
	 *          type="string",
	 *          in="path"
	 *      ),
	 *      @SWG\Response(
	 *          response=200,
	 *          description="Site do Gratunos."
	 *       ),
	 *      @SWG\Response(response=400, description="Bad request"),
	 *      @SWG\Response(response=404, description="Resource Not Found"),
	 *      @SWG\Response(response=500, description="Internal error."),
	 * )
	 *
	 */
    public function site($url){
    	$configuracao = TblConfiguracoes::where('url','=',$url)->get();
    	if($configuracao == null || sizeof($configuracao) != 1){
    		return response()->json(
	        	['msg'=>'Dados inválidos.']
	        , 400);
    	}
    	$configuracao = $configuracao[0];
    	$site = TblSites::find($configuracao->id_site);
    	$site->logo = base64_encode(Image::make($site->logo)->resize(350,null,
			function ($constraint) {
			    $constraint->aspectRatio();
			    $constraint->upsize();
			}
		)->encode()->encoded);

		$menus = TblMenusAndroid::where('id_configuracao','=',$configuracao->id)
			->orderBy('ordem', 'ASC')
			->get();

    	return response()->json(
        	['site' => $site,'configuracao' => $configuracao,'menus' => $menus]
        , 200);
    }

    /**
	 * @SWG\Get(
	 *      path="/api/banners/{url}",
	 *      operationId="banners",
	 *      tags={"Banners"},
	 *      summary="Obtêm os banners do site.",
	 *      @SWG\Parameter(
	 *          name="url",
	 *          description="Url do site.",
	 *          required=true,
	 *          type="string",
	 *          in="path"
	 *      ),
	 *      @SWG\Response(
	 *          response=200,
	 *          description="Banners do site."
	 *       ),
	 *      @SWG\Response(response=400, description="Bad request"),
	 *      @SWG\Response(response=404, description="Resource Not Found"),
	 *      @SWG\Response(response=500, description="Internal error."),
	 * )
	 *
	 */
    public function banners($url){
    	$site = obter_dados_site($url);
        $banners = \DB::table('tbl_banners')
            ->where('id_site', '=', $site->id)
            ->orderBy('created_at', 'DESC')
            ->get();
        foreach($banners as $banner){
        	$banner->foto = base64_encode(Image::make($banner->foto)->resize(250,null,
    			function ($constraint) {
				    $constraint->aspectRatio();
				    $constraint->upsize();
				}
			)->encode()->encoded);
        }
        return response()->json(
        	['banners' => $banners]
        , 200);
    }

    /**
	 * @SWG\Get(
	 *      path="/api/banner/{url}/{id}",
	 *      operationId="banner",
	 *      tags={"Banners"},
	 *      summary="Obtêm o banner do site.",
	 *      @SWG\Parameter(
	 *          name="url",
	 *          description="Url do site.",
	 *          required=true,
	 *          type="string",
	 *          in="path"
	 *      ),
	 *      @SWG\Parameter(
	 *          name="id",
	 *          description="ID do banner.",
	 *          required=true,
	 *          type="number",
	 *          in="path"
	 *      ),
	 *      @SWG\Response(
	 *          response=200,
	 *          description="Banner do site."
	 *       ),
	 *      @SWG\Response(response=400, description="Bad request"),
	 *      @SWG\Response(response=404, description="Resource Not Found"),
	 *      @SWG\Response(response=500, description="Internal error."),
	 * )
	 *
	 */
    public function banner($url, $id){
    	$site = obter_dados_site($url);
        $banner = \DB::table('tbl_banners')
            ->where('id_site', '=', $site->id)
            ->where('id', '=', $id)
            ->get();
        if($banner != null && sizeof($banner) > 0){
        	$banner = $banner[0];
        }else{
        	return response()->json(
	        	['msg'=>'Dados inválidos.']
	        , 400);
        }
    	$banner->foto = base64_encode(Image::make($banner->foto)->resize(250,null,
			function ($constraint) {
			    $constraint->aspectRatio();
			    $constraint->upsize();
			}
		)->encode()->encoded);
        return response()->json(
        	['banner' => $banner]
        , 200);
    }

	/**
	 * @SWG\Get(
	 *      path="/api/noticias/{url}",
	 *      operationId="noticias",
	 *      tags={"Notícias"},
	 *      summary="Obtêm as notícias do site.",
	 *      @SWG\Parameter(
	 *          name="url",
	 *          description="Url do site.",
	 *          required=true,
	 *          type="string",
	 *          in="path"
	 *      ),
	 *      @SWG\Response(
	 *          response=200,
	 *          description="Notícias do site."
	 *       ),
	 *      @SWG\Response(response=400, description="Bad request"),
	 *      @SWG\Response(response=404, description="Resource Not Found"),
	 *      @SWG\Response(response=500, description="Internal error."),
	 * )
	 *
	 */
    public function noticias($url){
    	$site = obter_dados_site($url);
        $noticias = \DB::table('tbl_noticias')
            ->where('id_site', '=', $site->id)
            ->orderBy('created_at', 'DESC')
            ->get();
        foreach($noticias as $noticia){
        	if($noticia->foto == null) $noticia->foto = file_get_contents(getcwd()."\\storage\\no-news.jpg");
        	$noticia->foto = base64_encode(Image::make($noticia->foto)->resize(250,null,
				function ($constraint) {
				    $constraint->aspectRatio();
				    $constraint->upsize();
				}
			)->encode()->encoded);

        	if($noticia->created_at != null) $noticia->created_at = \Carbon\Carbon::parse($noticia->created_at)->format('d/m/Y H:m');
        	if($noticia->updated_at != null) $noticia->updated_at = \Carbon\Carbon::parse($noticia->updated_at)->format('d/m/Y H:m');
        }
        return response()->json(
        	['noticias' => $noticias]
        , 200);
    }

    /**
	 * @SWG\Get(
	 *      path="/api/noticia/{url}/{id}",
	 *      operationId="noticia",
	 *      tags={"Notícias"},
	 *      summary="Obtêm a notícia do site.",
	 *      @SWG\Parameter(
	 *          name="url",
	 *          description="Url do site.",
	 *          required=true,
	 *          type="string",
	 *          in="path"
	 *      ),
	 *      @SWG\Parameter(
	 *          name="id",
	 *          description="ID da notícia.",
	 *          required=true,
	 *          type="number",
	 *          in="path"
	 *      ),
	 *      @SWG\Response(
	 *          response=200,
	 *          description="Notícia do site."
	 *       ),
	 *      @SWG\Response(response=400, description="Bad request"),
	 *      @SWG\Response(response=404, description="Resource Not Found"),
	 *      @SWG\Response(response=500, description="Internal error."),
	 * )
	 *
	 */
    public function noticia($url, $id){
    	$site = obter_dados_site($url);
        $noticia = \DB::table('tbl_noticias')
            ->where('id_site', '=', $site->id)
            ->where('id','=',$id)
            ->get();
        if($noticia != null && sizeof($noticia) > 0){
        	$noticia = $noticia[0];
        }else{
        	return response()->json(
	        	['msg'=>'Dados inválidos.']
	        , 400);
        }
    	if($noticia->foto == null) $noticia->foto = file_get_contents(getcwd()."\\storage\\no-news.jpg");
    	$noticia->foto = base64_encode(Image::make($noticia->foto)->resize(250,null,
			function ($constraint) {
			    $constraint->aspectRatio();
			    $constraint->upsize();
			}
		)->encode()->encoded);

    	if($noticia->created_at != null) $noticia->created_at = \Carbon\Carbon::parse($noticia->created_at)->format('d/m/Y H:m');
    	if($noticia->updated_at != null) $noticia->updated_at = \Carbon\Carbon::parse($noticia->updated_at)->format('d/m/Y H:m');

        return response()->json(
        	['noticia' => $noticia]
        , 200);
    }

    /**
	 * @SWG\Get(
	 *      path="/api/apresentacao/{url}",
	 *      operationId="apresentacao",
	 *      tags={"Apresentação"},
	 *      summary="Obtêm a apresentação do site.",
	 *      @SWG\Parameter(
	 *          name="url",
	 *          description="Url do site.",
	 *          required=true,
	 *          type="string",
	 *          in="path"
	 *      ),
	 *      @SWG\Response(
	 *          response=200,
	 *          description="Apresentação do site."
	 *       ),
	 *      @SWG\Response(response=400, description="Bad request"),
	 *      @SWG\Response(response=404, description="Resource Not Found"),
	 *      @SWG\Response(response=500, description="Internal error."),
	 * )
	 *
	 */
    public function apresentacao($url){
    	$site = obter_dados_site($url);
        $funcoes = TblFuncoes::where('id_site','=',$site->id)->where('apresentar','=',true)->get();
        $membros = null;
        foreach($funcoes as $funcao){
            $membros[$funcao->id] = TblMembros::where('id_funcao','=',$funcao->id)
            	->where('ativo','=',true)
            	->where('id_site','=',$funcao->id_site)
            	->orderBy('nome', 'ASC')
            	->get();
            foreach($membros[$funcao->id] as $membro){
            	if($membro->foto == null) $membro->foto = file_get_contents(getcwd()."\\storage\\no-foto.png");
            	$membro->foto = base64_encode(Image::make($membro->foto)->resize(250,null,
					function ($constraint) {
					    $constraint->aspectRatio();
					    $constraint->upsize();
					}
				)->encode()->encoded);
            }
        }
        return response()->json(
        	['funcoes'=>$funcoes, 'membros'=>$membros]
        , 200);
    }

    /**
	 * @SWG\Get(
	 *      path="/api/galerias/{url}",
	 *      operationId="galerias",
	 *      tags={"Galerias"},
	 *      summary="Obtêm as galerias do site.",
	 *      @SWG\Parameter(
	 *          name="url",
	 *          description="Url do site.",
	 *          required=true,
	 *          type="string",
	 *          in="path"
	 *      ),
	 *      @SWG\Response(
	 *          response=200,
	 *          description="Galerias do site."
	 *       ),
	 *      @SWG\Response(response=400, description="Bad request"),
	 *      @SWG\Response(response=404, description="Resource Not Found"),
	 *      @SWG\Response(response=500, description="Internal error."),
	 * )
	 *
	 */
    public function galerias($url){
    	$site = obter_dados_site($url);
        $galerias = \DB::table('tbl_galerias')
            ->where('id_site', '=', $site->id)
            ->orderBy('data', 'DESC')
            ->orderBy('created_at', 'DESC')
            ->get();
        $fotos = array();
        foreach($galerias as $galeria){
            $fotos_ = \DB::table('tbl_fotos')
                ->where('id_galeria', '=', $galeria->id)
                ->orderBy('created_at', 'DESC')
                ->get();
	        foreach($fotos_ as $foto){
        		$foto->foto = base64_encode(Image::make($foto->foto)->resize(250,null,
					function ($constraint) {
					    $constraint->aspectRatio();
					    $constraint->upsize();
					}
				)->encode()->encoded);
	        }
            $fotos[$galeria->id] = $fotos_;

        	$galeria->data = \Carbon\Carbon::parse($galeria->data)->format('d/m/Y');
        }
        return response()->json(
        	['galerias'=>$galerias, 'fotos'=> $fotos]
        , 200);
    }

    /**
	 * @SWG\Get(
	 *      path="/api/galeria/{url}/{id}",
	 *      operationId="galeria",
	 *      tags={"Galerias"},
	 *      summary="Obtêm a galeria do site.",
	 *      @SWG\Parameter(
	 *          name="url",
	 *          description="Url do site.",
	 *          required=true,
	 *          type="string",
	 *          in="path"
	 *      ),
	 *      @SWG\Parameter(
	 *          name="id",
	 *          description="ID da galeria.",
	 *          required=true,
	 *          type="number",
	 *          in="path"
	 *      ),
	 *      @SWG\Response(
	 *          response=200,
	 *          description="Galeria do site."
	 *       ),
	 *      @SWG\Response(response=400, description="Bad request"),
	 *      @SWG\Response(response=404, description="Resource Not Found"),
	 *      @SWG\Response(response=500, description="Internal error."),
	 * )
	 *
	 */
    public function galeria($url, $id){
    	$site = obter_dados_site($url);
        $galeria = \DB::table('tbl_galerias')
            ->where('id_site', '=', $site->id)
            ->where('id','=',$id)
            ->get();
        if($galeria != null && sizeof($galeria) > 0){
        	$galeria = $galeria[0];
        }else{
        	return response()->json(
	        	['msg'=>'Dados inválidos.']
	        , 400);
        }
        $fotos = \DB::table('tbl_fotos')
            ->where('id_galeria', '=', $galeria->id)
            ->orderBy('created_at', 'DESC')
            ->get();
        foreach($fotos as $foto){
    		$foto->foto = base64_encode(Image::make($foto->foto)->resize(250,null,
				function ($constraint) {
				    $constraint->aspectRatio();
				    $constraint->upsize();
				}
			)->encode()->encoded);
        }
    	$galeria->data = \Carbon\Carbon::parse($galeria->data)->format('d/m/Y');
        return response()->json(
        	['galeria'=>$galeria, 'fotos'=> $fotos]
        , 200);
    }

    /**
	 * @SWG\Get(
	 *      path="/api/midias/{url}",
	 *      operationId="midias",
	 *      tags={"Mídias"},
	 *      summary="Obtêm as mídias do site.",
	 *      @SWG\Parameter(
	 *          name="url",
	 *          description="Url do site.",
	 *          required=true,
	 *          type="string",
	 *          in="path"
	 *      ),
	 *      @SWG\Response(
	 *          response=200,
	 *          description="Mídias do site."
	 *       ),
	 *      @SWG\Response(response=400, description="Bad request"),
	 *      @SWG\Response(response=404, description="Resource Not Found"),
	 *      @SWG\Response(response=500, description="Internal error."),
	 * )
	 *
	 */
    public function midias($url){
    	$site = obter_dados_site($url);
    	$midias = \DB::table('tbl_midias')
            ->where('id_site', '=', $site->id)
            ->orderBy('created_at', 'DESC')
            ->get();
        foreach($midias as $midia){
        	if($midia->created_at != null) $midia->created_at = \Carbon\Carbon::parse($midia->created_at)->format('d/m/Y H:m');
        	if($midia->updated_at != null) $midia->updated_at = \Carbon\Carbon::parse($midia->updated_at)->format('d/m/Y H:m');
        }
        return response()->json(
        	['midias'=>$midias]
        , 200);
	}

	/**
	 * @SWG\Get(
	 *      path="/api/midia/{url}/{id}",
	 *      operationId="midia",
	 *      tags={"Mídias"},
	 *      summary="Obtêm a mídia do site.",
	 *      @SWG\Parameter(
	 *          name="url",
	 *          description="Url do site.",
	 *          required=true,
	 *          type="string",
	 *          in="path"
	 *      ),
	 *      @SWG\Parameter(
	 *          name="id",
	 *          description="ID da mídia.",
	 *          required=true,
	 *          type="string",
	 *          in="path"
	 *      ),
	 *      @SWG\Response(
	 *          response=200,
	 *          description="Mídia do site."
	 *       ),
	 *      @SWG\Response(response=400, description="Bad request"),
	 *      @SWG\Response(response=404, description="Resource Not Found"),
	 *      @SWG\Response(response=500, description="Internal error."),
	 * )
	 *
	 */
    public function midia($url,$id){
    	$site = obter_dados_site($url);
    	$midia = \DB::table('tbl_midias')
            ->where('id_site', '=', $site->id)
            ->where('id','=',$id)
            ->get();
        if($midia != null && sizeof($midia) > 0){
        	$midia = $midia[0];
        }else{
        	return response()->json(
	        	['msg'=>'Dados inválidos.']
	        , 400);
        }

    	if($midia->created_at != null) $midia->created_at = \Carbon\Carbon::parse($midia->created_at)->format('d/m/Y H:m');
    	if($midia->updated_at != null) $midia->updated_at = \Carbon\Carbon::parse($midia->updated_at)->format('d/m/Y H:m');

        return response()->json(
        	['midia'=>$midia]
        , 200);
	}

	/**
	 * @SWG\Get(
	 *      path="/api/publicacoes/{url}",
	 *      operationId="publicacoes",
	 *      tags={"Publicações"},
	 *      summary="Obtêm as publicações do site.",
	 *      @SWG\Parameter(
	 *          name="url",
	 *          description="Url do site.",
	 *          required=true,
	 *          type="string",
	 *          in="path"
	 *      ),
	 *      @SWG\Response(
	 *          response=200,
	 *          description="Publicações do site."
	 *       ),
	 *      @SWG\Response(response=400, description="Bad request"),
	 *      @SWG\Response(response=404, description="Resource Not Found"),
	 *      @SWG\Response(response=500, description="Internal error."),
	 * )
	 *
	 */
    public function publicacoes($url){
    	$site = obter_dados_site($url);
    	$publicacoes = \DB::table('tbl_publicacoes')
            ->where('id_site', '=', $site->id)
            ->orderBy('created_at', 'DESC')
            ->get();
        foreach($publicacoes as $publicacao){
        	if($publicacao->created_at != null) $publicacao->created_at = \Carbon\Carbon::parse($publicacao->created_at)->format('d/m/Y H:m');
        	if($publicacao->updated_at != null) $publicacao->updated_at = \Carbon\Carbon::parse($publicacao->updated_at)->format('d/m/Y H:m');
        }
        return response()->json(
        	['publicacoes'=>$publicacoes]
        , 200);
	}

	/**
	 * @SWG\Get(
	 *      path="/api/publicacao/{url}/{id}",
	 *      operationId="publicacao",
	 *      tags={"Publicações"},
	 *      summary="Obtêm a publicação do site.",
	 *      @SWG\Parameter(
	 *          name="url",
	 *          description="Url do site.",
	 *          required=true,
	 *          type="string",
	 *          in="path"
	 *      ),
	 *      @SWG\Parameter(
	 *          name="id",
	 *          description="ID da publicação.",
	 *          required=true,
	 *          type="string",
	 *          in="path"
	 *      ),
	 *      @SWG\Response(
	 *          response=200,
	 *          description="Publicação do site."
	 *       ),
	 *      @SWG\Response(response=400, description="Bad request"),
	 *      @SWG\Response(response=404, description="Resource Not Found"),
	 *      @SWG\Response(response=500, description="Internal error."),
	 * )
	 *
	 */
    public function publicacao($url,$id){
    	$site = obter_dados_site($url);
    	$publicacao = \DB::table('tbl_publicacoes')
            ->where('id_site', '=', $site->id)
            ->where('id', '=', $id)
            ->get();
        if($publicacao != null && sizeof($publicacao) > 0){
        	$publicacao = $publicacao[0];
        }else{
        	return response()->json(
	        	['msg'=>'Dados inválidos.']
	        , 400);
        }

    	if($publicacao->created_at != null) $publicacao->created_at = \Carbon\Carbon::parse($publicacao->created_at)->format('d/m/Y H:m');
    	if($publicacao->updated_at != null) $publicacao->updated_at = \Carbon\Carbon::parse($publicacao->updated_at)->format('d/m/Y H:m');

        return response()->json(
        	['publicacao'=>$publicacao]
        , 200);
	}

	/**
	 * @SWG\Get(
	 *      path="/api/eventos/{url}",
	 *      operationId="eventos",
	 *      tags={"Eventos"},
	 *      summary="Obtêm os eventos do site.",
	 *      @SWG\Parameter(
	 *          name="url",
	 *          description="Url do site.",
	 *          required=true,
	 *          type="string",
	 *          in="path"
	 *      ),
	 *      @SWG\Response(
	 *          response=200,
	 *          description="Eventos do site."
	 *       ),
	 *      @SWG\Response(response=400, description="Bad request"),
	 *      @SWG\Response(response=404, description="Resource Not Found"),
	 *      @SWG\Response(response=500, description="Internal error."),
	 * )
	 *
	 */
    public function eventos($url){
    	$site = obter_dados_site($url);
    	$eventos = \DB::table('tbl_eventos')
            ->where('id_site', '=', $site->id)
            ->where(function ($query) {
                $query->where('dados_horario_inicio', '>=', date('Y-m-d h:i:s', time()))
                    ->orWhere('dados_horario_fim', '>=', date('Y-m-d h:i:s', time()));
            })
            ->orderBy('dados_horario_inicio', 'DESC')
            ->get();
        foreach($eventos as $evento){
        	if($evento->foto == null) $evento->foto = base64_encode(file_get_contents(getcwd()."\\storage\\no-event.jpg"));
        	$evento->foto = base64_encode(Image::make($evento->foto)->resize(250,null,
				function ($constraint) {
				    $constraint->aspectRatio();
				    $constraint->upsize();
				}
			)->encode()->encoded);
        	$evento->dados_horario_inicio = \Carbon\Carbon::parse($evento->dados_horario_inicio)->format('d/m/Y H:m');
        	$evento->dados_horario_fim = \Carbon\Carbon::parse($evento->dados_horario_fim)->format('d/m/Y H:m');
        }
        return response()->json(
        	['eventos'=>$eventos]
        , 200);
	}

	/**
	 * @SWG\Get(
	 *      path="/api/evento/{url}/{id}",
	 *      operationId="evento",
	 *      tags={"Eventos"},
	 *      summary="Obtêm o evento do site.",
	 *      @SWG\Parameter(
	 *          name="url",
	 *          description="Url do site.",
	 *          required=true,
	 *          type="string",
	 *          in="path"
	 *      ),
	 *      @SWG\Parameter(
	 *          name="id",
	 *          description="ID do evento.",
	 *          required=true,
	 *          type="number",
	 *          in="path"
	 *      ),
	 *      @SWG\Response(
	 *          response=200,
	 *          description="Evento do site."
	 *       ),
	 *      @SWG\Response(response=400, description="Bad request"),
	 *      @SWG\Response(response=404, description="Resource Not Found"),
	 *      @SWG\Response(response=500, description="Internal error."),
	 * )
	 *
	 */
    public function evento($url, $id){
    	$site = obter_dados_site($url);
    	$evento = \DB::table('tbl_eventos')
            ->where('id_site', '=', $site->id)
            ->where('id', '=', $id)
            ->where(function ($query) {
                $query->where('dados_horario_inicio', '>=', date('Y-m-d h:i:s', time()))
                    ->orWhere('dados_horario_fim', '>=', date('Y-m-d h:i:s', time()));
            })
            ->orderBy('dados_horario_inicio', 'DESC')
            ->get();
        if($evento != null && sizeof($evento) > 0){
        	$evento = $evento[0];
        }else{
        	return response()->json(
	        	['msg'=>'Dados inválidos.']
	        , 400);
        }

    	if($evento->foto == null) $evento->foto = base64_encode(file_get_contents(getcwd()."\\storage\\no-event.jpg"));
    	$evento->foto = base64_encode(Image::make($evento->foto)->resize(250,null,
			function ($constraint) {
			    $constraint->aspectRatio();
			    $constraint->upsize();
			}
		)->encode()->encoded);
    	$evento->dados_horario_inicio = \Carbon\Carbon::parse($evento->dados_horario_inicio)->format('d/m/Y H:m');
    	$evento->dados_horario_fim = \Carbon\Carbon::parse($evento->dados_horario_fim)->format('d/m/Y H:m');

        return response()->json(
        	['evento'=>$evento]
        , 200);
	}

	/**
	 * @SWG\Get(
	 *      path="/api/eventosfixos/{url}",
	 *      operationId="eventosfixos",
	 *      tags={"Eventos fixos"},
	 *      summary="Obtêm os eventos fixos do site.",
	 *      @SWG\Parameter(
	 *          name="url",
	 *          description="Url do site.",
	 *          required=true,
	 *          type="string",
	 *          in="path"
	 *      ),
	 *      @SWG\Response(
	 *          response=200,
	 *          description="Eventos fixos do site."
	 *       ),
	 *      @SWG\Response(response=400, description="Bad request"),
	 *      @SWG\Response(response=404, description="Resource Not Found"),
	 *      @SWG\Response(response=500, description="Internal error."),
	 * )
	 *
	 */
    public function eventosfixos($url){
    	$site = obter_dados_site($url);
    	$eventos_fixos = \DB::table('tbl_eventos_fixos')
            ->where('id_site', '=', $site->id)
            ->get();
        foreach($eventos_fixos as $evento_fixo){
        	if($evento_fixo->foto == null) $evento_fixo->foto = base64_encode(file_get_contents(getcwd()."\\storage\\no-event.jpg"));
        	$evento_fixo->foto = base64_encode(Image::make($evento_fixo->foto)->resize(250,null,
				function ($constraint) {
				    $constraint->aspectRatio();
				    $constraint->upsize();
				}
			)->encode()->encoded);
        }
        return response()->json(
        	['eventosfixos'=>$eventos_fixos]
        , 200);
	}

	/**
	 * @SWG\Get(
	 *      path="/api/eventofixo/{url}/{id}",
	 *      operationId="eventofixo",
	 *      tags={"Eventos fixos"},
	 *      summary="Obtêm o evento fixo do site.",
	 *      @SWG\Parameter(
	 *          name="url",
	 *          description="Url do site.",
	 *          required=true,
	 *          type="string",
	 *          in="path"
	 *      ),
	 *      @SWG\Parameter(
	 *          name="id",
	 *          description="ID do evento fixo.",
	 *          required=true,
	 *          type="number",
	 *          in="path"
	 *      ),
	 *      @SWG\Response(
	 *          response=200,
	 *          description="Evento fixo do site."
	 *       ),
	 *      @SWG\Response(response=400, description="Bad request"),
	 *      @SWG\Response(response=404, description="Resource Not Found"),
	 *      @SWG\Response(response=500, description="Internal error."),
	 * )
	 *
	 */
    public function eventofixo($url, $id){
    	$site = obter_dados_site($url);
    	$evento_fixo = \DB::table('tbl_eventos_fixos')
            ->where('id_site', '=', $site->id)
            ->where('id', '=', $id)
            ->get();
        if($evento_fixo != null && sizeof($evento_fixo) > 0){
        	$evento_fixo = $evento_fixo[0];
        }else{
        	return response()->json(
	        	['msg'=>'Dados inválidos.']
	        , 400);
        }
        
    	if($evento_fixo->foto == null) $evento_fixo->foto = base64_encode(file_get_contents(getcwd()."\\storage\\no-event.jpg"));
    	$evento_fixo->foto = base64_encode(Image::make($evento_fixo->foto)->resize(250,null,
			function ($constraint) {
			    $constraint->aspectRatio();
			    $constraint->upsize();
			}
		)->encode()->encoded);
        
        return response()->json(
        	['eventofixo'=>$evento_fixo]
        , 200);
	}

	/**
	 * @SWG\Get(
	 *      path="/api/produtos/{url}",
	 *      operationId="produtos",
	 *      tags={"Carrinho"},
	 *      summary="Obtêm os produtos do site.",
	 *      @SWG\Parameter(
	 *          name="url",
	 *          description="Url do site.",
	 *          required=true,
	 *          type="string",
	 *          in="path"
	 *      ),
	 *      @SWG\Response(
	 *          response=200,
	 *          description="Produtos do site."
	 *       ),
	 *      @SWG\Response(response=400, description="Bad request"),
	 *      @SWG\Response(response=404, description="Resource Not Found"),
	 *      @SWG\Response(response=500, description="Internal error."),
	 * )
	 *
	 */
	public function produtos($url){
		$site = obter_dados_site($url);
		$categorias_ = TblCategoriasProdutos::where('id_site','=',$site->id)
            ->orderBy('nome', 'ASC')
            ->get();
        $categorias = [];
        foreach($categorias_ as $categoria){
        	$categorias[$categoria->id] = $categoria;
        }
        $produtos = TblProdutos::where('id_site','=',$site->id)
            ->where('situacao','=',true)
            ->orderBy('nome', 'ASC')
            ->get();
        $ofertas = [];
        foreach($produtos as $produto){
        	$produto->icone = base64_encode(Image::make($produto->icone)->resize(250,null,
				function ($constraint) {
				    $constraint->aspectRatio();
				    $constraint->upsize();
				}
			)->encode()->encoded);

            $ofertas_ = TblOfertasProdutos::where('id_produto','=',$produto->id)
                ->where('id_site','=',$site->id)
                ->where('data_inicio','<=', \Carbon\Carbon::parse(time())->format('Y-m-d'))
                ->where('data_fim','>=', \Carbon\Carbon::parse(time())->format('Y-m-d'))
                ->get();
            if($ofertas_ != null && sizeof($ofertas_) == 1){
                $ofertas[$produto->id] = $ofertas_[0];
            }
        }
        return response()->json(
        	['categorias'=>$categorias,'produtos'=>$produtos,'ofertas'=>$ofertas]
        , 200);
	}

	/**
	 * @SWG\Post(
	 *      path="/api/login/{url}",
	 *      operationId="login",
	 *      tags={"Autenticacação"},
	 *      summary="Autenticação.",
	 *      @SWG\Parameter(
	 *          name="url",
	 *          description="Url do site.",
	 *          required=true,
	 *          type="string",
	 *          in="path"
	 *      ),
 	 *      @SWG\Parameter(
	 *          name="email",
	 *          description="Email do usuário",
	 *          required=true,
	 *          type="string",
	 *          in="query"
	 *      ),
	 *      @SWG\Parameter(
	 *          name="password",
	 *          description="Login do usuário",
	 *          required=true,
	 *          type="string",
	 *          in="query"
	 *      ),
	 *      @SWG\Response(
	 *          response=200,
	 *          description="Dados do usuário."
	 *       ),
	 *      @SWG\Response(response=400, description="Bad request"),
	 *      @SWG\Response(response=404, description="Resource Not Found"),
	 *      @SWG\Response(response=500, description="Internal error."),
	 * )
	 *
	 */
	public function login($url, Request $request){
		$site = obter_dados_site($url);
		$user = User::where('email','=',$request->email)->get();
        if($user != null && sizeof($user) == 1){
          $user = $user[0];

          if (\Hash::check($request->password, $user->password)){

            $notification = array(
                'message' => 'Bem vindo '.$user->nome.'!',
                'alert-type' => 'success'
            );

            if($user->status == true){
                // VERIFICAÇÃO BÁSICA 1: PARA AUTENTICAR O USUÁRIO PRECISA ESTAR ATIVO
                if ($user->id_perfil == null || $user->id_perfil == 1){

                    // SE O USUÁRIO NÃO TÊM UM PERFIL OU ESSE É IGUAL A 1 ELE É UM ADMINISTRADOR
                    return response()->json(
			        	['msg'=>'Dados inválidos!']
			        , 400);

                }else if ($user->id_perfil == 100){

                    // SE O USUÁRIO TÊM UM PERFIL E ESSE É IGUAL A 100 ELE É UM COMPRADOR
                    return response()->json(
			        	['msg'=>'Dados inválidos!']
			        , 400);

                }else if($user->id_perfil != null && $user->id_perfil != 1 && $user->id_perfil != 100){
                    // SE O USUÁRIO TÊM UM PERFIL E ESSE É DIFERENTE DE 1 ELE NÃO É UM AMINISTRADOR NEM UM COMPRADOR
                    $perfil = TblPerfil::find($user->id_perfil);
                    if($perfil->status == true){
                        // VERIFICAÇÃO BÁSICA 2: PARA AUTENTICAR O PERFIL PRECISA ESTAR ATIVO
                        $site = TblSites::find($perfil->id_site);
                        if($site->status == true){
                            // VERIFICAÇÃO BÁSICA 3: PARA AUTENTICAR O SITE PRECISA ESTAR ATIVA
                            if($user->id_membro != null){
                            	// VERIFICAÇÃO BÁSICA 4: PARA AUTENTICAR PRECISA SER UM MEMBRO
                            	$perfil = TblPerfil::find($user->id_perfil);
                            	$membro = TblMembros::find($user->id_membro);
                            	$funcao = null;
                            	if($membro->id_funcao != null){
                            		$funcao = TblFuncoes::find($membro->id_funcao);
                            	}
                            	if($membro->foto == null) $membro->foto = base64_encode(file_get_contents(getcwd()."\\storage\\no-foto.jpg"));
                            	else $membro->foto = base64_encode(Image::make($membro->foto)->resize(250,null,
									function ($constraint) {
									    $constraint->aspectRatio();
									    $constraint->upsize();
									}
								)->encode()->encoded);
                        		$modulo_comunidade_site = TblSitesModulos::where('id_site','=',$site->id)
                        			->where('id_modulo','=',26)
                        			->get();
                    			if($modulo_comunidade_site != null && sizeof($modulo_comunidade_site) == 1){
	                        		$comunidades_lider_ = TblMembrosComunidades::where('ativo','=',true)
	                        			->where('lider','=',true)
	                        			->where('id_membro','=',$membro->id)
	                        			->get();
                        			$comunidades_lider = [];
                        			if($comunidades_lider_ != null) foreach($comunidades_lider_ as $comunidade_lider_){
                        				$comunidades_lider[] = TblComunidades::find($comunidade_lider_->id_comunidade);
                        			}
	                    			$comunidades_membro_ = TblMembrosComunidades::where('ativo','=',true)
	                        			->where('lider','=',false)
	                        			->where('id_membro','=',$membro->id)
	                        			->get();
                        			$comunidades_membro = [];
                        			if($comunidades_membro_ != null) foreach($comunidades_membro_ as $comunidade_membro_){
                        				$comunidades_membro = TblComunidades::find($comunidade_membro_->id_comunidade);
                        			}
                    				return response()->json(
							        	[
							        		'usuario'=>$user,
							        		'perfil'=>$perfil,
							        		'membro'=>$membro,
							        		'funcao'=>$funcao,
							        		'modulo_comunidades'=>true,
							        		'comunidades_lider'=>$comunidades_lider,
							        		'comunidades_membro'=>$comunidades_membro
							        	]
							        , 200);
                    			}else{
                    				return response()->json(
							        	['msg'=>'Dados inválidos!']
							        , 400);
                    			}
	                            
                            }else{
								return response()->json(
						        	['msg'=>'Dados inválidos!']
						        , 400);
                            }

                        }else{

                            return response()->json(
					        	['msg'=>'Site desativado.']
					        , 400);

                        }
                    }else{

                        return response()->json(
				        	['msg'=>'Perfil desativado.']
				        , 400);

                    }
                }

                return response()->json(
		        	['msg'=>'Perfil inválido.']
		        , 400);

            }else{

                return response()->json(
		        	['msg'=>'Usuário desativado.']
		        , 400);

            }

          }else{

            return response()->json(
	        	['msg'=>'Dados inválidos.']
	        , 400);

          }

        }else{

          	return response()->json(
	        	['msg'=>'Dados inválidos.']
	        , 400);

        }
	}
}
