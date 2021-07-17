<?php

/**
 * Контроллер SiteController
 */
class SiteController {
    /**
     * Action для главной страницы
     */
    public function actionIndex() {
        $successMessage = false;
        $errorMessage= false;
        if(isset($_SESSION['success'])) $successMessage = $_SESSION['success'];
        if(isset($_SESSION['error_message'])) $errorMessage = $_SESSION['error_message'];
        // Unset the useless session variables
        unset($_SESSION['success']);
        unset($_SESSION['error_message']);
        
        if(isset($_POST['submit'])) {
            // Получаем идентификатор пользователя из сессии
            $userId = User::checkLogged();

            $long_url = $_POST['long_url'];

            // Флаг ошибок в форме
            $errors = false;

            if (!$this->validateUrlFormat($long_url)) {
                $errors[] = 'неправильный формат URL';
            }

            if($errors == false) {
                // if long url already exists in db
                // $shortCode = Shortcode::urlExistsInDb($long_url);

                // if(!$shortCode) {
                $shortCode = Shortcode::createShortCode($long_url, $userId);
                // }
                
                if($shortCode) {
                    $_SESSION['success'] = 'http://' . $_SERVER['HTTP_HOST']. '/'. $shortCode;
                } else {
                    $_SESSION['error_message'] = 'Ошибка сохранения';
                }
                
                header("Location: /");
            }
        }

        require_once(ROOT . '/views/site/index.php');
        return true;
    }

    protected function validateUrlFormat($url) {
        // if(filter_var($url, FILTER_VALIDATE_URL)) echo 'correct';
        // else echo 'wrong';
        // die('');
        
        return filter_var($url, FILTER_VALIDATE_URL);
    }
     
    public function actionRedirect($key) {
        $key = htmlspecialchars($key);

        $url = Shortcode::getUrlByKey($key);

        if($url) {
            // увеличить счетчик количества преходов по ссылке
            Shortcode::incrementCount($key);

            header("Location: " . $url);
        } else {
            // $_SESSION['error_message'] = 'Not found';
            header("Location: /");
        }
    }
}