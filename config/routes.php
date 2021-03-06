<?php

return array(
    // Пользователь:
    'user/register' => 'user/register', // actionRegister в UserController
    'user/login' => 'user/login', // actionLogin в UserController
    'user/logout' => 'user/logout', // actionLogout в UserController

    // Stat
    'account/mylinks' => 'account/mylinks', // actionMylinks в AccountController

    // Redirect
    'index.php/([a-zA-Z0-9]+)' => 'site/redirect/$1', // actionRedirect в SiteController
    '([a-zA-Z0-9]+)' => 'site/redirect/$1', // actionRedirect в SiteController

    // Главная страница
    'index.php' => 'site/index', // actionIndex в SiteController
    '' => 'site/index', // actionIndex в SiteController
);