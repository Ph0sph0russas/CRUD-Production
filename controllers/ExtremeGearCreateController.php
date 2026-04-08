<?php
require_once "BaseGearsTwigController.php";

class ExtremeGearCreateController extends BaseGearsTwigController {
    public $template = "extreme_gear_create.twig";
    public function get(array $context)
    {
        parent::get($context);
    }
    
    public function post(array $context)
    {
        
        $title = $_POST['title'];
        $description = $_POST['description'];
        
        $type_name = $_POST['type'];
        $sql_type_number= <<<EOL
SELECT id from object_types 
where name=:type
EOL;
        $query_type_number=$this->pdo->prepare($sql_type_number);
        $query_type_number->bindValue("type", $type_name);
        $query_type_number->execute();
        $type=$query_type_number->fetchColumn();

        $info = $_POST['info'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $name =  $_FILES['image']['name'];
        move_uploaded_file($tmp_name, "../public/media/$name");
        $image_url = "/media/$name";
        $sql = <<<EOL
INSERT INTO extreme_gears(title, description, type_id, info, gear_image)
VALUES(:title, :description, :type, :info, :image_url)
EOL;

        
        $query = $this->pdo->prepare($sql);
        $query->bindValue("title", $title);
        $query->bindValue("description", $description);
        $query->bindValue("type", $type);
        $query->bindValue("info", $info);
        $query->bindValue("image_url", $image_url);
        $query->execute();

        $context['message'] = 'Вы успешно создали объект';
        $context['id'] = $this->pdo->lastInsertId();
        $this->get($context);
    }
}