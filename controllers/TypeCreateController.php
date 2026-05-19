<?php
require_once "BaseVideocardsTwigController.php";

class TypeCreateController extends BaseVideocardsTwigController
{
    public $template = "type_create.twig";

    public function get(array $context) // добавили параметр
    {
        // echo $_SERVER['REQUEST_METHOD'];

        parent::get($context); // пробросили параметр
    }

    public function post(array $context)
    {
        $title = $_POST['title'];

        // вытащил значения из $_FILES
        $tmp_name = $_FILES['image']['tmp_name'];
        $name =  $_FILES['image']['name'];

        move_uploaded_file($tmp_name, "../public/media/$name");
        $image_url = "/media/$name"; // формируем ссылку без адреса сервера

        $sql = <<<EOL
INSERT INTO videocards_types(title, image)
VALUES(:title, :image_url)
EOL;

        // подготавливаем запрос к БД
        $query = $this->pdo->prepare($sql);
        // привязываем параметры
        $query->bindValue("title", $title);
        $query->bindValue("image_url", $image_url);

        // выполняем запрос
        $query->execute();

        $context['message'] = 'Вы успешно создали новый тип';
        $context['id'] = $this->pdo->lastInsertId(); // получаем id нового добавленного типа

        $this->get($context);
    }
}
