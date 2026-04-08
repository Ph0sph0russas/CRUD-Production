<?php
require_once "BaseGearsTwigController.php";

class typeOfGearCreateController extends BaseGearsTwigController {
    public $template = "type_of_gear_create.twig";
    
    public function get(array $context)
    {
        parent::get($context);
    }

    public function post(array $context)
    {
        $name = $_POST['typeName'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $image_name =  $_FILES['image']['name'];
        move_uploaded_file($tmp_name, "../public/media/$image_name");
        $image_url = "/media/$image_name";
        $sql = <<<EOL
INSERT INTO object_types(name, type_image)
VALUES(:name, :image_url)
EOL;

        
        $query = $this->pdo->prepare($sql);
        $query->bindValue("name", $name);
        $query->bindValue("image_url", $image_url);
        $query->execute();

        $context['message'] = 'Вы успешно создали тип объекта';
        $context['id'] = $this->pdo->lastInsertId();
        $this->get($context);
    }
}