<?php
require_once "BaseVideocardsTwigController.php";

class SearchController extends BaseVideocardsTwigController
{
    public $template = "search.twig";
    public function getContext(): array
    {
        $context = parent::getContext();
        // вытаскиваем значения из $_GET, т.к. может и не быть
        // то проверяем через isset()
        $type = isset($_GET['type']) ? $_GET['type'] : '';
        $title = isset($_GET['title']) ? $_GET['title'] : '';

        $sql = <<<EOL
SELECT id, title
FROM videocards_object
WHERE (:title = '' OR title LIKE CONCAT('%', :title, '%'))
AND (type = :type)
EOL;
        // WHERE (:title = '' OR title LIKE CONCAT('%', :title, '%')) тут проверка либо что название 
        // указали пустым либо если не пустое то сверяем с названиями в бд на частичное совпадение, 
        // для этого переданное название оборачиваем в проценты

        $query = $this->pdo->prepare($sql);

        $query->bindValue("title", $title);
        $query->bindValue("type", $type);
        $query->execute();

        $context['objects'] = $query->fetchAll();

        return $context;
    }
}
