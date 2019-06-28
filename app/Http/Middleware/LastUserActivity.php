<?php

namespace App\Http\Middleware;
use Auth;
use Cache;
use Closure;
use App\User;
use Carbon\Carbon;
class LastUserActivity
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
        if(Auth::check()){
            //Registra ultima iteração do usuário via cache
            $expiresAt = Carbon::now()->addMinutes(1);
            Cache::put('user-is-online-'.Auth::user()->id,true,$expiresAt);
            //Registra ultima iteração do usuário via DB
            $usuario = User::find(Auth::user()->id);
            $usuario->ultimo_acesso = Carbon::now();
            //Registra ultima requisição do usuário via DB
            if($request->path()!="logout")
            $usuario->ultima_url = $request->path();
            //salva informações via DB
            $usuario->save();
        }
        return $next($request);
    }
}
