<?php

class LogoutController extends BaseController {
    public function post(array $context)
    {
        $_SESSION['is_logged']=false;
        session_unset();
        header("Location: /login");
        exit;
    }
}