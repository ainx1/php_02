<?php
// подключаем пакеты которые установили через composer
require_once '../vendor/autoload.php';
require_once '../framework/autoload.php';

require_once "../controllers/MainController.php"; // добавим в самом верху ссылку на наш контроллер
require_once "../controllers/ObjectController.php"; // добавил 5.3
require_once "../controllers/SearchController.php"; // добавил 5.4

require_once "../controllers/VideocardsObjectCreateController.php"; // добавил 5.5
require_once "../controllers/TypeCreateController.php";
require_once "../controllers/VideocardsObjectDeleteController.php"; // добавил 5.6
require_once "../controllers/VideocardsObjectUpdateController.php"; // добавил 5.7
require_once "../controllers/Controller404.php";


// создаем загрузчик шаблонов, и указываем папку с шаблонами
// \Twig\Loader\FilesystemLoader -- это типа как в C# писать Twig.Loader.FilesystemLoader, 
// только слеш вместо точек

$loader = new \Twig\Loader\FilesystemLoader('../views');
$twig = new \Twig\Environment($loader, [
    "debug" => true // добавляем тут debug режим
]);
$twig->addExtension(new \Twig\Extension\DebugExtension()); // и активируем расширение

// $title = "";
// $template = "";
// $context = [];

// создаем экземпляр класса и передаем в него параметры подключения
// создание класса автоматом открывает соединение
$pdo = new PDO("mysql:host=localhost;dbname=videocards_db;charset=utf8", "root", "");

$router = new Router($twig, $pdo);
$router->add("/search", SearchController::class);
$router->add("/create", VideocardsObjectCreateController::class);
$router->add("/type/create", TypeCreateController::class);
$router->add("/", MainController::class);
$router->add("/videocards_object/(?P<id>\d+)", ObjectController::class);
$router->add("/videocards_object/delete", VideocardsObjectDeleteController::class);
$router->add("/videocards_object/(?P<id>\d+)/edit", VideocardsObjectUpdateController::class);

$router->get_or_default(Controller404::class);
