<?php

namespace App\Http\Middleware;

use App\Models\Client;
use App\Models\Restaurant;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class Sanctum
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
        $bearer = $request->bearerToken();
        if ($token = DB::table('personal_access_tokens')->where('token',hash('sha256',$bearer))->first())
        {
            if ($user = Client::find($token->tokenable_id))
            {
                Auth::login($user);
                return $next($request);
            }elseif($user = Restaurant::find($token->tokenable_id)){

                Auth::login($user);
                return $next($request);
            }
        }

        return responseJson(0,'Unauthenticated !!',null);
    }
}
