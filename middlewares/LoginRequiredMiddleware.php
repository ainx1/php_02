<?php
class LoginRequiredMiddleware extends BaseMiddleware
{
    public function apply(BaseController $controller, array $context)
    {
        // значения которые введет пользователь
        $user = isset($_SERVER['PHP_AUTH_USER']) ? $_SERVER['PHP_AUTH_USER'] : '';
        $password = isset($_SERVER['PHP_AUTH_PW']) ? $_SERVER['PHP_AUTH_PW'] : '';

        $sql = <<<EOL
SELECT * FROM users WHERE username = :user AND password = :pass
EOL;

        $query = $controller->pdo->prepare($sql);
        $query->bindValue("user", $user);
        $query->bindValue("pass", $password);
        $query->execute();

        $row = $query->fetch();
        //если юзера нет в базе - блок
        if (!$row) {
            header('WWW-Authenticate: Basic realm="Videocards Area"');
            http_response_code(401);
            exit;
        }
    }
}
