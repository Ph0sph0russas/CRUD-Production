<?php

class LoginRequiredMiddleware extends BaseMiddleware {
    public function apply(BaseController $controller, array $context)
    {
        
        $valid_user = "user";
        $valid_password = "12345";
        
        
        $user = isset($_SERVER['PHP_AUTH_USER']) ? $_SERVER['PHP_AUTH_USER'] : '';
        $password = isset($_SERVER['PHP_AUTH_PW']) ? $_SERVER['PHP_AUTH_PW'] : '';
        
        
        if ($valid_user != $user || $valid_password != $password) {
            
            header('WWW-Authenticate: Basic realm="Space objects"');
            http_response_code(401);
            exit;
        }
    }
}