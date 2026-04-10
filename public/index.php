<?php


// подключаем пакеты которые установили через composer
require_once '../vendor/autoload.php';

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
    $title = "Главная";
    $template = "main.twig";
} elseif (preg_match("#^/RTX4000#", $url)) {
    $title = "RTX4000";
    $template = "__object.twig";

    if (preg_match("#^/RTX4000/image#", $url)) {

        $template = "base_image.twig";
        $context['image'] = "/images/RTX4000image.jpg";
    } elseif (preg_match("#^/RTX4000/info#", $url)) {
        $template = "RTX4000_info.twig";
    }
} elseif (preg_match("#^/RTX5000#", $url)) {

    $title = "RTX5000";
    $template = "__object.twig";

    if (preg_match("#^/RTX5000/image#", $url)) {
        $template = "base_image.twig";
        $context['image'] = "/images/RTX5000image.jpg";
    } elseif (preg_match("#^/RTX5000/info#", $url)) {
        $template = "RTX5000_info.twig";
    }
}

$context['title'] = $title;
$context['menu'] = $menu; // передаем меню в контекст
// ну и рендерю
echo $twig->render($template, $context);

// ..