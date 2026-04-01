<?php
require_once "BaseGearsTwigController.php";

class Controller404 extends BaseGearsTwigController {
    public $template = "404.twig"; 
    public $title = "Страница не найдена";
    public function get()
    {
        http_response_code(404);
        parent::get();
    }
}