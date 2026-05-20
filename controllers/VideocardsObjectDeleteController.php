<?php

// в кой то веки наследуемся не от TwigBaseController а от BaseController
class VideocardsObjectDeleteController extends BaseController
{
    public function post(array $context)
    {
        $id = $_POST['id']; // взяли id

        $sql = <<<EOL
DELETE FROM videocards_object WHERE id = :id
EOL; // сформировали запрос

        // выполнили
        $query = $this->pdo->prepare($sql);
        $query->bindValue(":id", $id);
        $query->execute();

        // устанавливаем заголовок Location на новый путь я хочу перейти на главную страницу поэтому пишу /
        header("Location: /");
        exit; // после  header("Location: ...") надо писать exit

    }
}
