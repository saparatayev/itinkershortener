<?php

/**
 * Контроллер UserController
 */
class UserController {
    /**
     * Action для страницы авторизации
     */
    public function actionLogin()
    {
        $login = false;
        $password = false;
        
        // Обработка формы
        if (isset($_POST['submit'])) {
            $login = $_POST['login'];
            $password = $_POST['password'];

            // Флаг ошибок
            $errors = false;

            // Валидация полей
            if (!User::checkLoginLength($login)) {
                $errors[] = 'Логин не должен быть короче 2-х символов';
            }
            if (!User::checkPasswordLength($password)) {
                $errors[] = 'Пароль не должен быть короче 3-х символов';
            }

            // Проверяем существует ли пользователь
            $userId = User::checkUserData($login, $password);

            if ($userId == false) {
                $errors[] = 'Неправильные данные для входа на сайт';
            } else {
                // Если данные правильные, запоминаем пользователя (сессия)
                User::auth($userId);

                header("Location: /");
            }
        }

        // Подключаем вид
        require_once(ROOT . '/views/site/login.php');
        return true;
    }

    /**
     * Удаляем данные о пользователе из сессии
     */
    public function actionLogout()
    {
        // Удаляем информацию о пользователе из сессии
        unset($_SESSION["user"]);
        
        header("Location: /");
    }
}