<?php

namespace Cendekia\FaspayTools\Http\Middleware;

use Cendekia\FaspayTools\FaspayTools;

class Authorize
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Illuminate\Http\Response
     */
    public function handle($request, $next)
    {
        return resolve(FaspayTools::class)->authorize($request) ? $next($request) : abort(403);
    }
}
