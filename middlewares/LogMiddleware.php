<?php

class LogMiddleware extends BaseMiddleware {
    public function apply(BaseController $controller, array $context) {
        $url_from_server=urldecode($_SERVER["REQUEST_URI"]);
        $method=$_SERVER['REQUEST_METHOD'];

        if (!isset($_SESSION['urls'])){
            $_SESSION['urls']=[];
        }
        
        if ($method=='GET'){
            if(count($_SESSION['urls'])==10)
            {
                array_shift($_SESSION['urls']);
                array_push($_SESSION['urls'], $url_from_server);
                
            }
            else
            {
                array_push($_SESSION['urls'], $url_from_server);
            }
        }
    }
}