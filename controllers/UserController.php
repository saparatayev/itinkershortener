<?php

/**
 * Контроллер UserController
 */
class UserController {
    /**
     * Action для страницы "Регистрация"
     */
    public function actionRegister()
    {
        // Переменные для формы
        $email = false;
        $password = false;
        $result = false;

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена 
            // Получаем данные из формы
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Флаг ошибок
            $errors = false;

            // Валидация полей
            if (!User::checkEmail($email)) {
                $errors[] = 'Неправильный email';
            }
            if (!User::checkPasswordLength($password)) {
                $errors[] = 'Пароль не должен быть короче 6-ти символов';
            }
            if (User::checkEmailExists($email)) {
                $errors[] = 'Такой email уже используется';
            }

            if ($errors == false) {
                // Если ошибок нет pегистрируем пользователя
                $result = User::register($email, $password);
                if($result) {
                    $_SESSION['success'] = 'Пользователь зарегистрирован';
                    header("Location: /user/login");
                } else {
                    $_SESSION['error_message'] = 'Ошибка';
                }
            }
        }
        
        require_once(ROOT . '/views/site/register.php');
        return true;
    }
    /**
     * Action для страницы авторизации
     */
    public function actionLogin()
    {
        $email = false;
        $password = false;
        
        // Обработка формы
        if (isset($_POST['submit'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Флаг ошибок
            $errors = false;

            // Валидация полей
            // Проверяем существует ли пользователь
            $userId = User::checkUserData($email, $password);

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