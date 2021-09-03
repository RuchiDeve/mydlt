<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DomainValidityCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        /** @var User $user */
        /** @var User $auth_user */

        /** @var Response $response */
        $response = $next($request);

        if ($auth_user = $request->user()){
            if ($auth_user->isDeveloper()) return $response;
        }

        $username = $request->route('member');

        $user = User::query()->where('username', $username)->first();


        if(!$user || !$user->hasActiveSubscription()){
            return redirect()->to(env('MAIN_SITE_URL'));
        }


        return $response;
    }
}
