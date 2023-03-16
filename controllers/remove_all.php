<?php
    // Подключение к сессии
    session_start();

    // Проверка на авторизацию
    if (!$_SESSION['user']) {
        header('Location: ../index.php');
    }

    // Подключение к БД 
    require_once '../includes/connect.php';

    // Удаляет все задачи в табл.tasks
    $id_user = $_SESSION['user']['id'];
    
    $stmt = $connect->prepare("DELETE FROM `tasks` WHERE `user_id` = ?");
    $stmt->bind_param('i', $id_user);
    $stmt->execute();

    header('Location: ../profile.php');
?>