<?php 

namespace App\Http\Helpers\Request;

use Exception;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Throw_;

use function GuzzleHttp\Promise\each;

class RequestHelper {

    /**
     * validate input from request
     * 
     * @param string $input, the input value
     * @param string $rule, the regular expresion string for input validating 
     * 
     * 
     * @throws Exception, if the input is invalid  
     */
    static function validateDataFromRequest(string $input, string $rule) {
        if (!preg_match($rule, $input)) throw new Exception("wrong value: $input");
        return $input; 
         
    }
} 