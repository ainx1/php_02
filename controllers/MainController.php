<?php
// require_once "TwigBaseController.php"; // импортим TwigBaseController

class MainController extends TwigBaseController
{
    public $template = "main.twig";
    public $title = "Главная";

    // добавим метод getContext()
    public function getContext(): array
    {
        $context = parent::getContext();

        // подготавливаем запрос SELECT * FROM videocards
        // вообще звездочку не рекомендуется использовать, но на первый раз пойдет
        $query = $this->pdo->query("SELECT * FROM videocards_object");

        // стягиваем данные через fetchAll() и сохраняем результат в контекст
        $context['videocards_object'] = $query->fetchAll();

        return $context;
    }
}
