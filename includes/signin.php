<?php
    // Подключение к сессии
    session_start();
    // Подключение к БД 
    require_once('connect.php');
    // Подключение файла с функциями
    require_once('functions.php');

    $data = $_POST;
    $err = [];


    // Проверка маркера
    if ( $data['submit'] != $_SESSION['token'] ) {
        $err[] = "ошибка";
    } 

    if ( isset($data['submit']) and isset($data['login']) and isset($data['password']) ) {

        // Логин и пароль не соответствует рег. выражению
        if ( !check_regular($data['login']) or !check_regular($data['password']) ) {
            $err[] = "Логин и пароль может состоять только из букв английского алфавита и цифр";
        } 

        // Коллиство символов вне диапазона 3 - 30
        if ( !num_char($data['login']) or !num_char($data['password']) ) {
            $err[] = "Логин и пароль должен быть не меньше 3-х символов и не больше 30";
        } 


        if (count($err) == 0) {

            $login = htmlspecialchars($data['login']);
            $password = md5($data['password']);

            // Проверка на сущеcтвование логина 
            $check_user = $connect->prepare("SELECT * FROM `users` WHERE `login` = ?");
            $check_user->bind_param("s", $login);
            $check_user->execute();
            $check_user = $check_user->get_result();

            if ( $check_user->num_rows == 0 ) {

                // Добавление пользователя
                $stmt = $connect->prepare("INSERT INTO `users` (`id`, `login`, `password`, `created_at`) VALUES (NULL, ?, ?, NULL)");
                $stmt->bind_param("ss", $login, $password);
                $stmt->execute();


            } else {

                $user = $check_user->fetch_assoc();

                foreach ($check_user as $array) {
                    if ($password == $array['password']) {

                        $_SESSION['user'] = [
                            'id' => $user['id'],
                            'login' => $user['login']
                            ];
                    
                        header('Location: ../profile.php');
                    } else {

                        $_SESSION['massage'] = "Не верный логин или пароль";
                        
                    }
                
                } 

            }
                

        } else {
            $_SESSION['massage'] = array_shift($err);
        }
        
        header('Location: ../index.php');
        
    }
    

?>
