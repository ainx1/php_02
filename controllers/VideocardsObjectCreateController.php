<?php
require_once "BaseVideocardsTwigController.php";

class VideocardsObjectCreateController extends BaseVideocardsTwigController
{
    public $template = "videocards_object_create.twig";

    public function get(array $context) // добавили параметр
    {
        // echo $_SERVER['REQUEST_METHOD'];

        parent::get($context); // пробросили параметр
    }
    // добавил
    public function post(array $context)
    {
        // получаем значения полей с формы
        $title = $_POST['title'];
        $description = $_POST['description'];
        $type_id = $_POST['type_id']; // изменил на type_id, тк теперь передаем id типа а не его название
        $info = $_POST['info'];

        // вытащил значения из $_FILES
        $tmp_name = $_FILES['image']['tmp_name'];
        $name =  $_FILES['image']['name'];

        // используем функцию которая проверяет
        // что файл действительно был загружен через POST запрос
        // и если это так, то переносит его в указанное во втором аргументе место
        move_uploaded_file($tmp_name, "../public/media/$name");
        $image_url = "/media/$name"; // формируем ссылку без адреса сервера

        // создаем текст запрос
        $sql = <<<EOL
INSERT INTO videocards_object(title, description, type_id, info, image)
VALUES(:title, :description, :type_id, :info, :image_url) -- передаем переменную в запрос
EOL;

        // подготавливаем запрос к БД
        $query = $this->pdo->prepare($sql);
        // привязываем параметры
        $query->bindValue("title", $title);
        $query->bindValue("description", $description);
        $query->bindValue("type_id", $type_id);
        $query->bindValue("info", $info);
        $query->bindValue("image_url", $image_url); // подвязываем значение ссылки к переменной  image_url
        // выполняем запрос
        $query->execute();

        $context['message'] = 'Вы успешно создали объект';
        $context['id'] = $this->pdo->lastInsertId(); // получаем id нового добавленного объекта

        $this->get($context);
    }
}
