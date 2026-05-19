<?php
require_once "BaseVideocardsTwigController.php"; 
class ObjectController extends BaseVideocardsTwigController
{
    public $template = "__object.twig"; // указываем шаблон

    public function getContext(): array
    {
        $context = parent::getContext();
        // добавил вывод params
        // echo "<pre>";
        // print_r($this->params);
        // echo "</pre>";

        // создам запрос, под параметр создаем переменную my_id в запросе
        $query = $this->pdo->prepare("SELECT * FROM videocards_object WHERE id= :my_id");
        // подвязываем значение в my_id 
        $query->bindValue("my_id", $this->params['id']);
        $query->execute(); // выполняем запрос

        // тянем данные
        $data = $query->fetch();

        $context['id'] = $data['id'];
        $context['title'] = $data['title'];
        $context['image'] = $data['image'];
        $context['info'] = $data['info'];

        // передаем описание из БД в контекст
        $context['description'] = $data['description'];

        return $context;
    }
}
