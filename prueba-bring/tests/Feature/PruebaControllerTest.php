<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Helpers\ApiService;

class PruebaControllerTest extends TestCase
{
    /**
     *
     * @return void
     */
    public function testShortUrl()
    {
        
        $url = 'https://example.com/12345';   
        
        $response = $this->post('/api/v1/short-urls', ['url' => $url]);
        $response->assertStatus(200);
        
        $response = $this->postJson('/api/v1/short-urls', ['url' => $url], ['Authorization' => '']);
        $response->assertStatus(200);
        
        $response = $this->postJson('/api/v1/short-urls', ['url' => $url], ['Authorization' => '[]{}']);
        $response->assertStatus(200);
        
        $responseFailed = $this->postJson('/api/v1/short-urls', ['url' => $url], ['Authorization' => '[}']);
        $responseFailed->assertStatus(400);
        
        $responseFailed = $this->postJson('/api/v1/short-urls', ['urll' => $url], ['Authorization' => '[]{}']);
        $responseFailed->assertStatus(400);
        
        $responseFailed = $this->postJson('/api/v1/short-urls', ['url' => 123], ['Authorization' => '[]{}']);
        $responseFailed->assertStatus(400);
        
        $responseFailed = $this->postJson('/api/v1/short-urls', ['url' => 'https://'], ['Authorization' => '[]{}']);
        $responseFailed->assertStatus(400);
    }
}
