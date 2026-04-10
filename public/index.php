<?php


// подключаем пакеты которые установили через composer
require_once '../vendor/autoload.php';
require_once "../controllers/MainController.php"; // добавим в самом верху ссылку на наш контроллер
require_once "../controllers/RTX4000Controller.php";
require_once "../controllers/RTX5000Controller.php";
require_once "../controllers/RTX5000ImageController.php";
require_once "../controllers/RTX4000ImageController.php";
require_once "../controllers/RTX4000InfoController.php";
require_once "../controllers/RTX5000InfoController.php";
// создаем загрузчик шаблонов, и указываем папку с шаблонами
// \Twig\Loader\FilesystemLoader -- это типа как в C# писать Twig.Loader.FilesystemLoader, 
// только слеш вместо точек
$loader = new \Twig\Loader\FilesystemLoader('../views');

// создаем собственно экземпляр Twig с помощью которого будет рендерить
$twig = new \Twig\Environment($loader);

$url = $_SERVER["REQUEST_URI"];

$title = "";
$template = "";
$context = [];

$controller = null; // создаем переменную для контроллера, по умолчанию null

$menu = [
    [
        "title" => "Главная",
        "url" => "/",
    ],
    [
        "title" => "RTX4000",
        "url" => "/RTX4000",
    ],
    [
        "title" => "RTX5000",
        "url" => "/RTX5000",
    ]
];


if ($url == "/") {
    $controller = new MainController($twig);
} elseif (preg_match("#^/RTX4000/image#", $url)) {
    $controller = new RTX4000ImageController($twig);
} elseif (preg_match("#^/RTX4000/info#", $url)) {
    $controller = new RTX4000InfoController($twig);
} elseif (preg_match("#^/RTX4000#", $url)) {
    $controller = new RTX4000Controller($twig);
} elseif (preg_match("#^/RTX5000/image#", $url)) {
    $controller = new RTX5000ImageController($twig);
} elseif (preg_match("#^/RTX5000/info#", $url)) {
    $controller = new RTX5000InfoController($twig);
} elseif (preg_match("#^/RTX5000#", $url)) {
    $controller = new RTX5000Controller($twig);
}
if ($controller) {
    $controller->get();
}

// $context['title'] = $title;
// $context['menu'] = $menu; // передаем меню в контекст
// ну и рендерю
// echo $twig->render($template, $context);

// ..