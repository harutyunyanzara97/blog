<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;


class IsAdmin
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     * @var Guard
     *  @param  Guard  $auth
     * @return void
     */
    protected $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }
    public function handle(Request $request, Closure $next)
    {
        if ($this->auth->user() && !$this->auth->user()->hasRole('admin')) {
            abort(403, 'Unauthorized action.Go back');
        }
        return $next($request);
    }
}
