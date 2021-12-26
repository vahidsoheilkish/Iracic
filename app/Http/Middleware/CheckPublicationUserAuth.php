<?php

namespace App\Http\Middleware;

use Closure;

class CheckPublicationUserAuth
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
        if( $request->session()->exists('publication_user') ){
            return $next($request);
        }
        return redirect()->to( route('publication.index') );
    }
}
