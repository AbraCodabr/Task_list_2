<?php
    // Подключение к сессии
    session_start();
    // Подключение к БД 
    require_once '../includes/connect.php';

    // Меняет статус заметки на с "невыполнено" на "выполнено"
    foreach ($_POST as $key => $value) {
        $key = $key;
    }
    
    // Меняем статус задачи в табл. tasks
    $stmt = $connect->prepare("UPDATE `tasks` SET `status` = '1' WHERE `id` = ?");
    $stmt->bind_param("i", $key);
    $stmt->execute();

    header('Location: ../profile.php');
?>