<?php

require_once "BaseGearsTwigController.php";
class LoginController extends BaseGearsTwigController {
    public $template = "loginPage.twig";
    public $title = "Авторизация";
    public function get(array $context)
    {
        parent::get($context);
    }
    public function post(array $context)
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $query=$this->pdo->prepare("SELECT username, password from users");
        $query->execute();
        $context['users'] = $query->fetchAll();
        
        foreach($context['users'] as $valid_user)
        {
            if ($valid_user['username']==$username && $valid_user['password'] == $password)
            {
                $_SESSION['is_logged']=true;
            }  
        }
        header("Location: /");
    }
}