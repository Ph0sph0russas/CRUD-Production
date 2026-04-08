<?php
require_once "BaseGearsTwigController.php";
class ObjectController extends BaseGearsTwigController {
    public $template = "object.twig"; 

    public function getContext(): array
    {
        $context = parent::getContext();
        $query = $this->pdo->prepare("SELECT description, id, gear_image, info FROM extreme_gears WHERE id = :id");
        $query->bindValue("id",$this->params['id']);
        $query->execute();
        $data = $query->fetch();
        if (isset($_GET['show']))
        {
            if ($_GET['show']==='image')
            {
                $context['image']=$data['gear_image'];
                $context['is_image']=1;
            }
            else if ($_GET['show']==='info')
            {
                $context['info']=$data['info'];
                $context['is_info']=1;
            }
        }
        $context['description'] = $data['description'];
        $context['id']=$data['id'];
        return $context;
    }
}