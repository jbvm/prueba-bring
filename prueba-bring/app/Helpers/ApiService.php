<?php

namespace App\Helpers;
//use Http;

class ApiService {

    /**
     *
     * @param  string  $url
     * 
     * @return string
     */
    public function getUrlApi($url) {
        /*
          $response = Http::get('');
          var_dump($response);
          die();
         */
        $curl = curl_init();
        $options = array(CURLOPT_URL => 'https://tinyurl.com/api-create.php?url='.$url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => false
        );
        curl_setopt_array($curl, $options);

        $response = curl_exec($curl); // respuesta generada
        
        $err = curl_error($curl); // muestra errores en caso de existir

        curl_close($curl); // termina la sesión 

        if (empty($err) && !empty($response)) {
            return $response;
        } else {
            return 'Error';
        }
    }
}
