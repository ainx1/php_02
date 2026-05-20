   <?php
    require_once "BaseVideocardsTwigController.php";

    class VideocardsObjectUpdateController extends BaseVideocardsTwigController
    {
        public $template = "videocards_object_create.twig";

        public function get(array $context) // добавили параметр (5.7 редактирование)
        {
            // echo $_SERVER['REQUEST_METHOD'];
            $id = $this->params['id']; // получили id из параметров

            $sql = <<<EOL
SELECT * FROM videocards_object WHERE id = :id
EOL;
            $query = $this->pdo->prepare($sql);
            $query->bindValue("id", $id);
            $query->execute();

            $data = $query->fetch();
            $context['object'] = $data; // передаем данные в контекст

            parent::get($context); // пробросили параметр

        }
        // добавил
        public function post(array $context)
        {
            $id = $this->params['id']; // получили id из параметров
            // получаем значения полей с формы
            $title = $_POST['title'];
            $description = $_POST['description'];
            $type_id = $_POST['type_id']; // изменил на type_id, тк теперь передаем id типа а не его название
            $info = $_POST['info'];

            $image_url = $_POST['old_image']; // получили старое значение картинки из скрытого поля

            // если пользователь выбрал новый файл
            if (!empty($_FILES['image']['name'])) {
                $tmp_name = $_FILES['image']['tmp_name'];
                $name = $_FILES['image']['name'];

                // используем функцию которая проверяет
                // что файл действительно был загружен через POST запрос
                // и если это так, то переносит его в указанное во втором аргументе место
                move_uploaded_file($tmp_name, "../public/media/$name");

                // Перезаписываем переменную image_url путем
                $image_url = "/media/$name";
            }

            // создаем текст запрос
            $sql = <<<EOL
UPDATE videocards_object 
SET title = :title, description = :description, type_id = :type_id, info = :info, image = :image_url 
WHERE id = :id
EOL;

            // подготавливаем запрос к БД
            $query = $this->pdo->prepare($sql);
            // привязываем параметры
            $query->bindValue("title", $title);
            $query->bindValue("description", $description);
            $query->bindValue("type_id", $type_id);
            $query->bindValue("info", $info);
            $query->bindValue("image_url", $image_url); // подвязываем значение ссылки к переменной  image_url
            $query->bindValue("id", $id); // подвязываем значение id к переменной  id

            // выполняем запрос
            $query->execute();

            $context['message'] = 'Вы успешно обновили объект';
            $context['object'] = $_POST; // Чтобы данные в форме остались после нажатия кнопки

            $this->get($context);
        }
    }
