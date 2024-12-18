<?php

namespace Geekbrains\Application1\Controllers;

use Geekbrains\Application1\Render;
use Geekbrains\Application1\Models\User;

class UserController {

    public function actionIndex() {
        $users = User::getAllUsersFromStorage();
        
        $render = new Render();

        if(!$users){
            return $render->renderPage(
                'user-empty.tpl', 
                [
                    'title' => 'Список пользователей в хранилище',
                    'message' => "Список пуст или не найден"
                ]);
        }
        else{
            return $render->renderPage(
                'user-index.tpl', 
                [
                    'title' => 'Список пользователей в хранилище',
                    'users' => $users
                ]);
        }
    }

    // обработка запроса для добавления и сохранения пользователя
    public function actionSave() {
        $name = $_GET['name'] ?? null;
        $birthday = $_GET['birthday'] ?? null;
    
        if ($name && !empty($birthday)) {
            $user = new User($name);
            $user->setBirthdayFromString($birthday);
    
            if ($user->saveUserToStorage()) {
                $message = 'Пользователь сохранен!';
            } else {
                $message = 'Ошибка при сохранении.';
            }
        } else {
            $message = 'Пожалуйста, укажите имя и дату рождения.';
        }
        $render = new Render();
    return $render->renderPage('user-save.tpl', ['message' => $message]);
}
}