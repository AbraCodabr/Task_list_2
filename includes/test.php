<?php
    // Подключение к сессии
    session_start();
    // Подключение к БД 
    require_once 'connect.php';

    //$login = $_POST['login'];
    //$password = $_POST['password'];

    
    //$check_user = $connect->prepare("SELECT * FROM `users` WHERE `login` = ? AND `password` = ?");

    //$check_user->bind_param("ss", $login, $password);

    //$check_user->execute();

    //$check_user = $check_user->get_result();

    //$user = $result->fetch_assoc();

    
    //echo ($check_user->num_rows);

?>
