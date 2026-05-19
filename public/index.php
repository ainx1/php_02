<?php
// подключаем пакеты которые установили через composer
require_once '../vendor/autoload.php';
require_once '../framework/autoload.php';

require_once "../controllers/MainController.php"; // добавим в самом верху ссылку на наш контроллер
require_once "../controllers/ObjectController.php"; // добавил 

require_once "../controllers/RTX4000Controller.php";
require_once "../controllers/RTX5000Controller.php";
require_once "../controllers/RTX5000ImageController.php";
require_once "../controllers/RTX4000ImageController.php";
require_once "../controllers/RTX4000InfoController.php";
require_once "../controllers/RTX5000InfoController.php";

require_once "../controllers/Controller404.php";

// создаем загрузчик шаблонов, и указываем папку с шаблонами
// \Twig\Loader\FilesystemLoader -- это типа как в C# писать Twig.Loader.FilesystemLoader, 
// только слеш вместо точек

$loader = new \Twig\Loader\FilesystemLoader('../views');
$twig = new \Twig\Environment($loader, [
    "debug" => true // добавляем тут debug режим
]);
$twig->addExtension(new \Twig\Extension\DebugExtension()); // и активируем расширение

$title = "";
$template = "";
$context = [];

// создаем экземпляр класса и передаем в него параметры подключения
// создание класса автоматом открывает соединение
$pdo = new PDO("mysql:host=localhost;dbname=videocards_db;charset=utf8", "root", "");

$router = new Router($twig, $pdo);
$router->add("/", MainController::class);
$router->add("/RTX4000", RTX4000Controller::class);
// $router->add("/RTX5000", RTX5000Controller::class);
$router->add("/videocards_object/(?P<id>\d+)", ObjectController::class);

$router->get_or_default(Controller404::class);
