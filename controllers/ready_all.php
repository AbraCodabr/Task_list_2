<?php
    // Подключение к сессии
    session_start();

    // Проверка на авторизацию
    if (!$_SESSION['user']) {
        header('Location: ../index.php');
    }
    
    // Подключение к БД 
    require_once '../includes/connect.php';

    // Меняет статус всех заметок с "невыполнено" на "выполнено" в табл.tasks
    $id_user = $_SESSION['user']['id'];

    $status = 1;
    $stmt = $connect->prepare("UPDATE `tasks` SET `status` = ? WHERE `user_id` = ?");
    $stmt->bind_param("ii", $status, $id_user);
    $stmt->execute();

    header('Location: ../profile.php');
?>