<?php

namespace App\Http\Middleware;

use Closure;

class CheckAuthUserConferenceNotice
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
        if($request->session()->exists('conference_user_notice')){
            return $next($request);
        }else{
            return redirect()->to(route('conference.notice'));
        }
    }
}
