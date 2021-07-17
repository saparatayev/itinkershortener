<?php

return array(
    'index.php/([a-zA-Z0-9]+)' => 'site/redirect/$1', // actionRedirect в SiteController
    '([a-zA-Z0-9]+)' => 'site/redirect/$1', // actionRedirect в SiteController

    // Главная страница
    'index.php' => 'site/index', // actionIndex в SiteController
    '' => 'site/index', // actionIndex в SiteController
);