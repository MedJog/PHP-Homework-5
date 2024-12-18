<?php

date_default_timezone_set('Europe/Moscow');

require_once('./vendor/autoload.php');

use Geekbrains\Application1\Application;

$app = new Application();
echo $app->run();




// docker-compose up -d
// docker-compose down

// http://mysite.local:8080   - главная страница
// http://mysite.local:8080/page/index - главная страница
// http://mysite.local:8080/user/index - вызов списка пользователей
// http://mysite.local:8080/user/save/?name=Иван&birthday=05-05-1991 - добавление пользователя