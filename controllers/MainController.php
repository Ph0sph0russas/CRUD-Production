<?php
require_once "TwigBaseController.php"; 

class MainController extends TwigBaseController {
    public $template = "main.twig";
    public $title = "Главная";
    public function getContext() : array
    {
        $context = parent::getContext(); 
        $context['menu_items']=[
            [
                "title" =>"Изумруды Хаоса",
                "url_title" => "chaos_emeralds",
            ],
            [
                "title" =>"Магический Ковёр",
                "url_title" => "magic_carpet",
            ],
        ];
        $query = $this->pdo->query("SELECT * FROM extreme_gears");
        
        $context['extreme_gears'] = $query->fetchAll();

        return $context;
    }
}