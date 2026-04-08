<?php
require_once "BaseGearsTwigController.php";

class SearchController extends BaseGearsTwigController{
    public $template="search.twig";

    public function getContext(): array
    {
        $context = parent::getContext();
        $type=isset($_GET['type']) ? $_GET['type'] : '';
        $title=isset($_GET['title']) ? $_GET['title'] : '';
        $full_description=isset($_GET['full_description']) ? $_GET['full_description'] : '';
        $sql = <<<EOL
SELECT extreme_gears.id, title
FROM extreme_gears
join object_types on type_id=object_types.id
WHERE (:title = '' OR title like CONCAT('%', :title, '%'))
    and ((name = :type) OR :type='все')
    and (:full_description='' OR info like CONCAT('%', :full_description, '%'))
EOL;
        $query=$this->pdo->prepare($sql);
        $query->bindValue("title", $title);
        $query->bindValue("type", $type);
        $query->bindValue("full_description",$full_description);
        $query->execute();
        
        $context['objects']=$query->fetchAll();
        return $context;
    }
}