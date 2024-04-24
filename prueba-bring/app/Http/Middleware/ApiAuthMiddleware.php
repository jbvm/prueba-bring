<?php

namespace App\Http\Middleware;

use Closure;
use App\Helpers\CheckAuth;

class ApiAuthMiddleware {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        //return $next($request);
        // Comprobar si el usuario está identificado
        $token = $request->header('Authorization');
        $checkAuth = new CheckAuth();
        $checkToken = $checkAuth->checkToken($token);

        //if ($checkToken && !empty($params_array)) {
        if ($checkToken) {
            return $next($request);
        } else {
            $data = array(
                'status' => 'error',
                'code' => 400,
                'message' => 'Error: El token no es válido'
            );

            return response()->json($data, $data['code']);
        }
    }
}
    