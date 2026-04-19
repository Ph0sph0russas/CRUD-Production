<?php
class BaseGearsTwigController extends TwigBaseController
{
    public function getContext(): array
    {
        $context = parent::getContext();
        $query = $this->pdo->query("Select DISTINCT name from object_types order by 1");
        $types = $query->fetchAll();
        $context['types']=$types;
        $context["urls"] = array_reverse($_SESSION['urls']);
        return $context;
    }
} 