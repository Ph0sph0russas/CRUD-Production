<?php
class ExtremeGearUpdateController extends BaseGearsTwigController
{
    public $template="extreme_gear_update.twig";
    public function get(array $context)
    {
        $id=$this->params['id'];
        $sql= <<<EOL
SELECT * FROM extreme_gears join object_types on type_id=object_types.id WHERE extreme_gears.id= :id 
EOL;
        $query=$this->pdo->prepare($sql);
        $query->bindValue("id", $id);
        $query->execute();
        $data=$query->fetch();
        $context['object']=$data;
        parent::get($context);

    }
    public function post(array $context){

        $title = $_POST['title'];
        $description = $_POST['description'];
        $id = $this->params['id'];
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
UPDATE extreme_gears
SET title= :title, description= :description, type_id= :type, info= :info, gear_image= :image_url
WHERE id= :id
EOL;
        
        $query = $this->pdo->prepare($sql);
        $query->bindValue("title", $title);
        $query->bindValue("description", $description);
        $query->bindValue("type", $type);
        $query->bindValue("info", $info);
        $query->bindValue("image_url", $image_url);
        $query->bindValue("id", $id);
        $query->execute();

        $context['message'] = 'Вы успешно изменили объект!';
        $context['id']=$id;
        $this->get($context);
    }
}