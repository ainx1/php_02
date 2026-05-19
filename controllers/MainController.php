<?php
require_once "BaseVideocardsTwigController.php";

class MainController extends BaseVideocardsTwigController
{
    public $template = "main.twig";
    public $title = "Главная";

    public function getContext(): array
    {
        $context = parent::getContext();

        if (isset($_GET['type'])) {

            $query = $this->pdo->prepare("SELECT * FROM videocards_object WHERE type = :type");
            $query->bindValue("type", $_GET['type']);
            $query->execute();
        } else {
            // подготавливаем запрос SELECT * FROM videocards
            // вообще звездочку не рекомендуется использовать, но на первый раз пойдет
            $query = $this->pdo->query("SELECT * FROM videocards_object");
        }
        // стягиваем данные через fetchAll() и сохраняем результат в контекст
        $context['videocards_object'] = $query->fetchAll();

        return $context;
    }
}
