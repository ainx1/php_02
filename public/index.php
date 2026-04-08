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

if ($url == "/") {
    $title = "Главная";
    $template = "main.twig";

} elseif (preg_match("#/RTX4000#", $url)) {
    $title = "RTX4000";
    $template = "base_image.twig";

    $context['image'] = "/images/RTX4000image.jpg";
} elseif (preg_match("#/RTX5000#", $url)) {
    $title = "RTX5000";
    $template = "base_image.twig";

    $context['image'] = "/images/RTX5000image.jpg";
}

$context['title'] = $title;
// ну и рендерю
echo $twig->render($template, $context);

// ..