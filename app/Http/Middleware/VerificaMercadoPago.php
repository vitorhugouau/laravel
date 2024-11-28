<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerificaMercadoPago
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Illuminate\Http\Response
     */
    public function handle(Request $request, Closure $next)
    {
        $signature = $request->header('x-mercadopago-signature'); 

        if (!$signature || $signature !== 'aacc08de693c8381265be1b4b29a830d717305fa07e2e0c5b20010d2b84d34f0') { 
            return response()->json(['error' => 'Não autorizado'], 401);
        }

        return $next($request);
    }
}