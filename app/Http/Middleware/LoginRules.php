<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\TblPerfil;
use App\TblIgreja;

class LoginRules
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // VALIDAÇÃO DE AUTENTICAÇÃO FEITA AQUI: SEGUNDA A SER EXECUTADA (DEPOIS DO WEB.PHP)
        return $next($request);
        /*if(Auth::user()->status == true){
            // VERIFICAÇÃO BÁSICA 1: PARA AUTENTICAR O USUÁRIO PRECISA ESTAR ATIVO
            if (Auth::user()->id_perfil == null || Auth::user()->id_perfil == 1){
                // SE O USUÁRIO NÃO TÊM UM PERFIL OU ESSE É IGUAL A 1 ELE É UM ADMINISTRADOR
                return redirect()->route('admin.home');
            }else if(Auth::user()->id_perfil != null && Auth::user()->id_perfil != 1){
                // SE O USUÁRIO TÊM UM PERFIL E ESSE É DIFERENTE DE 1 ELE NÃO É UM AMINISTRADOR
                $perfil = TblPerfil::find(Auth::user()->id_perfil);
                if($perfil->status == true){
                    // VERIFICAÇÃO BÁSICA 2: PARA AUTENTICAR O PERFIL PRECISA ESTAR ATIVO
                    $igreja = TblIgrejas::find($perfil->id_igreja);
                    if($igreja->status == true){
                        // VERIFICAÇÃO BÁSICA 3: PARA AUTENTICAR A CONGREGAÇÃO PRECISA ESTAR ATIVO
                        return redirect()->route('usuario.home');
                    }else{
                        auth()->logout();
                        return redirect('login')->with('message', 'O serviço de sua congregação está inativo.');
                    }
                }else{
                    auth()->logout();
                    return redirect('login')->with('message', 'Seu perfil está desativado.');
                }
            }
            auth()->logout();
            return redirect('login')->with('message', 'Seu perfil não foi encontrado.');
        }else{
            auth()->logout();
            return redirect('login')->with('message', 'Seu usuário está desativado.');
        }*/
    }
}
