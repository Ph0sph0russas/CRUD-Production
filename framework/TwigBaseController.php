<?php
require_once "BaseController.php"; 

class TwigBaseController extends BaseController {
    public $title = ""; 
    public $template = "";
    protected \Twig\Environment $twig; 

    public function setTwig($twig) {
        $this->twig = $twig;
    }
    
    public function getContext() : array
    {
        $context = parent::getContext(); 
        $context['title'] = $this->title;


        $url_from_server=$_SERVER["REQUEST_URI"];
        if (!isset($_SESSION['urls'])){
            $_SESSION['urls']=[];
        }

        if(count($_SESSION['urls'])==10)
        {
            array_shift($_SESSION['urls']);
            array_push($_SESSION['urls'], $url_from_server);
            
        }
        else
        {
            array_push($_SESSION['urls'], $url_from_server);

        }
        

        
        return $context;
    }
    
    public function get(array $context) { 
        echo $this->twig->render($this->template, $context); 
    }
}