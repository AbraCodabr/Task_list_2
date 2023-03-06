<?php
    // Подключение к сессии
    session_start();
    // Подключение к БД 
    require_once 'connect.php';


    $data = $_POST;
    $err = [];


    // Проверка маркера
    if ( $data['submit'] != $_SESSION['token'] ) {
        $err[] = "ошибка";
    } 

    // Функция проверки на рег. выражение
    function passreg($new) {
        return preg_match("/^[a-zA-Z0-9]+$/", $new);
    }

    // Функция проверки колл. символов 
    function num_char($new) {
        return strlen($new) > 3 and strlen($new) < 30;
    }

    if ( isset($data['submit']) ) {

        // Логин и пароль не соответствует рег. выражению
        if ( !passreg($data['login']) or !passreg($data['password']) ) {
            $err[] = "Логин и пароль может состоять только из букв английского алфавита и цифр";
        } 

        // Коллиство символов вне диапазона 3 - 30
        if ( !num_char($data['login']) or !num_char($data['password']) ) {
            $err[] = "Логин и пароль должен быть не меньше 3-х символов и не больше 30";
        } 


        if (count($err) == 0) {

            $login = htmlspecialchars($data['login']);
            $password = md5($data['password']);

            // Проверка на сущетвования пользователя
            $check_user = $connect->prepare("SELECT * FROM `users` WHERE `login` = ? AND `password` = ?");
            $check_user->bind_param("ss", $login, $password);
            $check_user->execute();
            $check_user = $check_user->get_result();

            if ( $check_user->num_rows == 0 ) {

                // Проверка на сущеcтвование логина 
                $check_login = $connect->prepare("SELECT * FROM `users` WHERE `login` = ?");
                $check_login->bind_param("s", $login);
                $check_login->execute();
                $check_login = $check_login->get_result();

                if ( $check_login->num_rows == 0 ) {

                    // Добавление пользователя
                    $stmt = $connect->prepare("INSERT INTO `users` (`id`, `login`, `password`, `created_at`) VALUES (NULL, ?, ?, NULL)");
                    $stmt->bind_param("ss", $login, $password);
                    $stmt->execute();

                    header('Location: ../index.php');

                } else {

                    $_SESSION['massage'] = "Пользователь с таким логином уже существует!";
                    header('Location: ../index.php');

                }
                

            } else {

                // Авторизация пользователя
                $user = $check_user->fetch_assoc();

                $_SESSION['user'] = [
                'id' => $user['id'],
                'login' => $user['login']
                ];
        
                header('Location: ../profile.php');

            }


        } else {
            $_SESSION['massage'] = array_shift($err);
            header('Location: ../index.php');
        }
             
        
    }
    

?>
