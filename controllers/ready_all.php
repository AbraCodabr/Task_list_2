<?php
    // Подключение к сессии
    session_start();
    // Подключение к БД 
    require_once '../includes/connect.php';

    // Меняет статус всех заметок с "невыполнено" на "выполнено" в табл.tasks
    
    $status = 1;
    $stmt = $connect->prepare("UPDATE `tasks` SET `status` = ? ");
    $stmt->bind_param("i", $status);
    $stmt->execute();

    header('Location: ../profile.php');
?>