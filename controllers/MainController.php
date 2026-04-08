<?php

require_once "BaseGearsTwigController.php";
class MainController extends BaseGearsTwigController {
    public $template = "main.twig";
    public $title = "Главная";
    public function getContext() : array
    {
        $context = parent::getContext(); 
        
        
        if (isset($_GET['type']))
        {
                $query = $this->pdo->prepare("SELECT * FROM extreme_gears JOIN object_types on type_id=object_types.id WHERE name = :type");
                $query->bindValue("type",$_GET['type']);
                $query->execute();
        }
        else
        {
                $query = $this->pdo->query("SELECT * FROM extreme_gears");
        }
        $context['extreme_gears'] = $query->fetchAll();
        return $context;
    }
}