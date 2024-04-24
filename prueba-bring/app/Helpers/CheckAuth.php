<?php

namespace App\Helpers;

class CheckAuth {

    /**
     *
     * @param  string  $token
     * 
     * @return boolean
     */
    public function checkToken($token) {
        $check = true;
        
        if(!empty($token)){
            $check = $this->validateStr($token);
        }
        return $check;
    }
    
    /**
     *
     * @param  string  $cadena
     * 
     * @return boolean
     */
    private function validateStr($cadena){
        $check = false;
        $strLenght = strlen($cadena);
        $openings = array('{', '[', '(');
        $closures = array('}', ']', ')');
        
        $closeOpen = ['}' => '{', ']' => '[', ')' => '('];
        
        $vCharacters = array();
        for($i=0; $i < $strLenght;$i++){
            $character = substr($cadena, $i, 1);
            
            if (in_array($character, $openings)) {
                $vCharacters[] = $character;
            } elseif(in_array($character, $closures)) {                
                $openingChar = $closeOpen[$character];
                
                if($openingChar == array_pop($vCharacters)){
                    $check = true;
                } else {
                   $check = false;
                   break;
                }
            } else {
                $check = false;
                break;
            }
        }
        
        return ($check && empty($vCharacters));
    }
}
