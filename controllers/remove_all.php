<?php
    // Подключение к сессии
    session_start();
    // Подключение к БД 
    require_once '../includes/connect.php';

    // Удаляет все задачи в табл.tasks
    
    $stmt = $connect->prepare("DELETE FROM `tasks` ");
    $stmt->bind_param();
    $stmt->execute();

    header('Location: ../profile.php');
?>