<?php

/**
 * Контроллер AccountController
 * Кабинет пользователя
 */

class AccountController 
{
    /**
     * Action для страницы "My links"
     */
    public function actionMylinks() {
        // Получаем идентификатор пользователя из сессии
        $userId = User::checkLogged();
        
        $links = Shortcode::getLinksByUserId($userId);

        $prefix = 'http://' . $_SERVER['HTTP_HOST']. '/';

        require_once(ROOT . '/views/site/my_links.php');
        return true;
    }
}