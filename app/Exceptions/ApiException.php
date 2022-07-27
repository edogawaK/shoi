<?php

namespace App\Exceptions;

use Exception;

class ApiException extends Exception
{
    public function render(){
        return response([
            "status"=>$this->code,
            "message"=>$this->message,
        ],401);
    }
}
