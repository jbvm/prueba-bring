<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Helpers\ApiService;

class ApiServiceTest extends TestCase
{
    /**
     *
     * @return void
     */
    public function testGetUrlApi()
    {
        $urlsOk = ['http://www.example.com', 'https://example.com/12345', 'https://www.google.es/'];
        
        $apiService = new ApiService();
        
        foreach ($urlsOk as $url){
            $urlApi = $apiService->getUrlApi($url);

            $this->assertNotEquals('Error', $urlApi);
        }
        
        $urlsFailed = ['', 'https://'];
        
        foreach ($urlsFailed as $url){
            $urlApi = $apiService->getUrlApi($url);

            $this->assertEquals('Error', $urlApi);
        }
    }
}
