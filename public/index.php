<?php
    require_once '../vendor/autoload.php';
    require_once "../controllers/MainController.php";
    require_once "../controllers/ChaosEmeraldsController.php";
    require_once "../controllers/ChaosEmeraldsImageController.php";
    require_once "../controllers/ChaosEmeraldsInfoController.php";
    require_once "../controllers/MagicCarpetController.php";
    require_once "../controllers/MagicCarpetImageController.php";
    require_once "../controllers/MagicCarpetInfoController.php";
    require_once "../controllers/Controller404.php";
    $loader = new \Twig\Loader\FilesystemLoader('../views');
    $twig = new \Twig\Environment($loader,[
        "debug"=>true
    ]);
    $twig->addExtension(new \Twig\Extension\DebugExtension());
    $context = [];
    $controller = new Controller404($twig);
        $pdo = new PDO("mysql:host=localhost;dbname=omochao_adviser;charset=utf8", "root", "");
    $url = $_SERVER["REQUEST_URI"];
    if ($url == "/") {
        $controller = new MainController($twig);
    } elseif (preg_match("#^/chaos_emeralds/image#", $url)) {
        $controller = new ChaosEmeraldsImageController($twig);
    } elseif (preg_match("#^/chaos_emeralds/info#", $url)) {
        $controller = new ChaosEmeraldsInfoController($twig);
    } elseif (preg_match("#^/chaos_emeralds#", $url)) {
        $controller = new ChaosEmeraldsController($twig);
    } elseif (preg_match("#^/magic_carpet/image#", $url)) {
        $controller = new MagicCarpetImageController($twig);
    } elseif (preg_match("#^/magic_carpet/info#", $url)) {
        $controller = new MagicCarpetInfoController($twig);
    } elseif (preg_match("#^/magic_carpet#", $url)) {
        $controller = new MagicCarpetController($twig);
    }

    if ($controller) {
        $controller->setPDO($pdo);
        $controller->get();
    }