<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\CheckAuth;
use App\Helpers\ApiService;

class PruebaController extends Controller {

    public function __construct() {
        $this->middleware('api.auth');
    }

    public function shortUrl(Request $request) {
        // Recoger datos por post
        $url = $request->input('url');

        // Validar la url
        $validate = \Validator::make($request->all(), [
                    'url' => 'required|string'
        ]);

        if (empty($url) || $validate->fails()) {
            $data = array(
                'status' => 'error',
                'code' => 400,
                'message' => "Error: El valor del parámetro 'url' enviado no es válido "
            );
        } else {
            $apiService = new ApiService();
            $urlApi = $apiService->getUrlApi($url);
            //var_dump($urlApi);die();
            if ($urlApi == 'Error') {
                $data = array(
                    'status' => 'error',
                    'code' => 400,
                    'message' => "Error: El valor del parámetro 'url' enviado no es válido "
                );
            } else {
                $data = array(
                    'url' => $urlApi,
                    'code' => 200
                );
            }
        }


        // Devolver el resultado   
        return response()->json($data, $data['code']);
    }
}
