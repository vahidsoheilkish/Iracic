<?php

namespace App\Http\Middleware;

use Closure;

class ConferenceArticeActiveNotAllowToEdit
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
        if($request->article->active == 1 ){
            return redirect()->to(route('conference.notice.dashboard'));
        }
        return $next($request);
    }
}
