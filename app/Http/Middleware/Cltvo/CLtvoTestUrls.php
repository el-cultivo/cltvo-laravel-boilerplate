<?php

namespace App\Http\Middleware\Cltvo;

use Closure;

class CLtvoTestUrls
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
        if (!env("APP_DEBUG")) {
            return redirect('/');
        }
        return $next($request);
    }
}
