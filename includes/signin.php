<?php
    // Подключение к сессии
    session_start();
    // Подключение к БД 
    require_once 'connect.php';


    $login = htmlspecialchars($_POST['login']);
    $password = md5($_POST['password']);

    $add = true;
    $count = 0;

    foreach ($_POST as $key => $value) {
        if (!empty(trim($value))) {
            $count += 1;
        }
    }

    // Проверка на количество заполненых полей
    if ($count == 2) {
        
        $check_user = $connect->prepare("SELECT * FROM `users` WHERE `login` = ? AND `password` = ?");
        $check_user->bind_param("ss", $login, $password);
        $check_user->execute();
        $check_user = $check_user->get_result();

            
        if ($check_user->num_rows == 0) {
            
            $stmt = $connect->prepare("INSERT INTO `users` (`id`, `login`, `password`, `created_at`) VALUES (NULL, ?, ?, NULL)");
            $stmt->bind_param("ss", $login, $password);
            $stmt->execute();
            
        }
        
        $check_user = $connect->prepare("SELECT * FROM `users` WHERE `login` = ? AND `password` = ?");
        $check_user->bind_param("ss", $login, $password);
        $check_user->execute();
        $check_user = $check_user->get_result();

        $user = $check_user->fetch_assoc();

        $_SESSION['user'] = [
            'id' => $user['id'],
            'login' => $user['login']
        ];
        
        header('Location: ../profile.php');
        
    } else {
        $_SESSION['massage'] = 'Заполните все поля';
        header('Location: ../index.php');
    }
?>