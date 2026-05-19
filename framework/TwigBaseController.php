<?php
require_once "BaseController.php"; // обязательно импортим BaseController

class TwigBaseController extends BaseController
{
    public $title = ""; // название страницы
    public $template = ""; // шаблон страницы
    protected \Twig\Environment $twig; // ссылка на экземпляр twig, для рендернига

    // теперь пишем конструктор, 
    // передаем в него один параметр
    // собственно ссылка на экземпляр twig
    // это кстати Dependency Injection называется
    // это лучше чем создавать глобальный объект $twig 
    // и быстрее чем создавать персональный $twig обработчик для каждого класс 
     
    // убираем
    // public function __construct($twig)
    // {
    //     $this->twig = $twig;
    // }
    // добавляем
    public function setTwig($twig) {
        $this->twig = $twig;
    }

    // переопределяем функцию контекста
    public function getContext(): array
    {
        $context = parent::getContext(); // вызываем родительский метод
        $context['title'] = $this->title; // добавляем title в контекст

        $context['current_url'] = $_SERVER['REQUEST_URI'];

        // $context['menu'] = [
        //     ["title" => "Главная", "url" => "/"],
        //     ["title" => "RTX4000", "url" => "/RTX4000", "image" => "/images/RTX4000image.jpg"],
        //     ["title" => "RTX5000", "url" => "/RTX5000", "image" => "/images/RTX5000image.jpg"],
        // ];

        return $context;
    }

    // функция гет, рендерит результат используя $template в качестве шаблона
    // и вызывает функцию getContext для формирования словаря контекста
    public function get()
    {
        echo $this->twig->render($this->template, $this->getContext());
    }
}
