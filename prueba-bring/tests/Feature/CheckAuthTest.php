<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Helpers\CheckAuth;

class CheckAuthTest extends TestCase {

    /**
     *
     * @return void
     */
    public function testCheckToken() {
        
        $checkAuth = new CheckAuth();

        $tokens = array('', '{}', '{}[]()', '{([])}', '[[()]{}]');
        foreach ($tokens as $token) {
            $isValidToken = $checkAuth->checkToken($token);
            $this->assertTrue($isValidToken);
        }
        
        $tokens = array('{)', '[{]}', '(((((((()');
        foreach ($tokens as $token) {
            $isNotValidToken = $checkAuth->checkToken($token);
            $this->assertNotTrue($isNotValidToken);
        }
    }
}
