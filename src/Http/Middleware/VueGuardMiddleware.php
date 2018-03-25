<?php namespace Bantenprov\VueGuard\Http\Middleware;

use Closure;

/**
 * The VueGuardMiddleware class.
 *
 * @package Bantenprov\VueGuard
 * @author  bantenprov <developer.bantenprov@gmail.com>
 */
class VueGuardMiddleware
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
        return $next($request);
    }
}
