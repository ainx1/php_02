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
        $type_id = isset($_GET['type_id']) ? $_GET['type_id'] : 'all';
        $title = isset($_GET['title']) ? $_GET['title'] : '';
        $info = isset($_GET['info']) ? $_GET['info'] : '';

        // значения обратно в контекст (чтобы фильтры сохранялись в полях)
        $context['type_id'] = $type_id;
        $context['title'] = $title;
        $context['info'] = $info;

        $sql = <<<EOL
SELECT id, title
FROM videocards_object
WHERE (:title = '' OR title LIKE CONCAT('%', :title, '%'))
AND (:info = '' OR info LIKE CONCAT('%', :info, '%'))
AND (:type_id = 'all' OR type_id = :type_id)
EOL;
        // WHERE (:title = '' OR title LIKE CONCAT('%', :title, '%')) тут проверка либо что название 
        // указали пустым либо если не пустое то сверяем с названиями в бд на частичное совпадение, 
        // для этого переданное название оборачиваем в проценты

        $query = $this->pdo->prepare($sql);

        $query->bindValue("title", $title);
        $query->bindValue("type_id", $type_id);
        $query->bindValue("info", $info);
        $query->execute();

        $context['objects'] = $query->fetchAll();

        return $context;
    }
}
