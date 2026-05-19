<?php

class ObjectController extends TwigBaseController
{
    public $template = "__object.twig"; // указываем шаблон

    public function getContext(): array
    {
        $context = parent::getContext();

        // добавил вывод params
        // echo "<pre>";
        // print_r($this->params);
        // echo "</pre>";
        // готовим запрос к БД, допустим вытащим запись по id=3
        // тут уже указываю конкретные поля, там более грамотно
        // создам запрос, под параметр создаем переменную my_id в запросе
        $query = $this->pdo->prepare("SELECT description, id FROM videocards_object WHERE id= :my_id");
        // подвязываем значение в my_id 
        $query->bindValue("my_id", $this->params['id']);
        $query->execute(); // выполняем запрос

        // тянем данные
        $data = $query->fetch();

        // передаем описание из БД в контекст
        $context['description'] = $data['description'];

        return $context;
    }
}
