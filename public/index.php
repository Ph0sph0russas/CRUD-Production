<?php
    require_once '../vendor/autoload.php';
    require_once '../framework/autoload.php';
    require_once "../controllers/MainController.php";
    require_once "../controllers/ObjectController.php";
    require_once "../controllers/SearchController.php";
    require_once "../controllers/Controller404.php";
    require_once "../controllers/ExtremeGearCreateController.php";
    require_once "../controllers/TypeOfGearCreateController.php";
    require_once "../controllers/ExtremeGearDeleteController.php";
    require_once "../controllers/ExtremeGearUpdateController.php";
    require_once "../middlewares/LoginRequiredMiddleware.php";
    require_once "../controllers/SetWelcomeController.php";
    require_once "../controllers/LoginController.php";
    require_once "../controllers/LogoutController.php";
    require_once "../middlewares/LogMiddleware.php";

    $loader = new \Twig\Loader\FilesystemLoader('../views');
    $twig = new \Twig\Environment($loader,[
        "debug"=>true
    ]);
    $twig->addExtension(new \Twig\Extension\DebugExtension());
    $context = [];
    
    $pdo = new PDO("mysql:host=localhost;dbname=omochao_adviser;charset=utf8", "root", "");

    $router = new Router($twig, $pdo);
    $router->add("/", MainController::class)
           ->middleware(new LoginRequiredMiddleware())
           ->middleware(new LogMiddleware());
    $router->add("/extreme_gears/(?P<id>\d+)", ObjectController::class)
           ->middleware(new LoginRequiredMiddleware())
           ->middleware(new LogMiddleware());
    $router->add("/search", SearchController::class)
           ->middleware(new LoginRequiredMiddleware())
           ->middleware(new LogMiddleware());


    $router->add("/extreme_gears/createObject", ExtremeGearCreateController::class)
            ->middleware(new LoginRequiredMiddleware())
            ->middleware(new LogMiddleware());
    $router->add("/extreme_gears/createType", TypeOfGearCreateController::class)
            ->middleware(new LoginRequiredMiddleware())
            ->middleware(new LogMiddleware());
    $router->add("/extreme_gears/delete", ExtremeGearDeleteController::class)
            ->middleware(new LoginRequiredMiddleware())
            ->middleware(new LogMiddleware());
    $router->add("/logout", LogoutController::class)
            ->middleware(new LoginRequiredMiddleware())
            ->middleware(new LogMiddleware());    
    $router->add("/extreme_gears/(?P<id>\d+)/edit", ExtremeGearUpdateController::class)
            ->middleware(new LoginRequiredMiddleware())
            ->middleware(new LogMiddleware());
    $router->add("/set-welcome/", SetWelcomeController::class)
           ->middleware(new LoginRequiredMiddleware())
           ->middleware(new LogMiddleware());
    $router->add("/login", LoginController::class)
           ->middleware(new LogMiddleware());
    $router->get_or_default(Controller404::class);


    
