<?php

class LoginRequiredMiddleware extends BaseMiddleware {
    public function apply(BaseController $controller, array $context)
    {
        
        
        $query=$controller->pdo->prepare("SELECT username, password from users");
        $query->execute();
        $context['users'] = $query->fetchAll();

        $username = isset($_SERVER['PHP_AUTH_USER']) ? $_SERVER['PHP_AUTH_USER'] : '';
        $password = isset($_SERVER['PHP_AUTH_PW']) ? $_SERVER['PHP_AUTH_PW'] : '';

        $is_correct_user=0;
        foreach($context['users'] as $valid_user)
        {
            if ($valid_user['username']==$username && $valid_user['password'] == $password)
            {
                $is_correct_user=1;
            }  
        }  
        if ($is_correct_user==0)
        {
            header('WWW-Authenticate: Basic realm="Space objects"');
            http_response_code(401);
            exit;
        }
              
    }
}