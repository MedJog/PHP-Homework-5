<?php

namespace Geekbrains\Application1\Models;

class User {

    private ?string $userName;
    private ?int $userBirthday;

    private static string $storageAddress = '/storage/birthdays.txt';

    public function __construct(string $name = null, int $birthday = null){
        $this->userName = $name;
        $this->userBirthday = $birthday;
    }

    public function setName(string $userName) : void {
        $this->userName = $userName;
    }

    public function getUserName(): string {
        return $this->userName;
    }

    public function getUserBirthday(): ?int {
        return $this->userBirthday;
    }

    // public function setBirthdayFromString(string $birthdayString) : void {
    //     $this->userBirthday = strtotime($birthdayString);
    // }
    public function setBirthdayFromString(?string $birthdayString) : void {
        if ($birthdayString) {
            $this->userBirthday = strtotime($birthdayString);
        } else {
            $this->userBirthday = null; // устанавливаем null, если дата не указана
        }
    }
// получение даных из хранилища
    public static function getAllUsersFromStorage(): array|false {
        $address = $_SERVER['DOCUMENT_ROOT'] . User::$storageAddress;
        
        if (file_exists($address) && is_readable($address)) {
            $file = fopen($address, "r");
            
            $users = [];
        
            while (!feof($file)) {
                $userString = fgets($file);

                if (!$userString) continue;

                $userArray = explode(",", $userString);

                $user = new User(
                    $userArray[0]
                );
                $user->setBirthdayFromString($userArray[1]);

                $users[] = $user;
            }
            
            fclose($file);

            return $users;
        }
        else {
            return false;
        }
    }

     // Метод для сохранения пользователя в файл
    public function saveUserToStorage(): bool {
        $address = $_SERVER['DOCUMENT_ROOT'] . self::$storageAddress;
        $data = $this->userName . ',' . date('Y-m-d', $this->userBirthday) . PHP_EOL;

        // Добавляем данные в конец файла
        return file_put_contents($address, $data, FILE_APPEND | LOCK_EX) !== false;
    }
}