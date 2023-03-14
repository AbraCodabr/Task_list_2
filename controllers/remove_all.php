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
    
    $stmt = $connect->prepare("DELETE FROM `tasks` ");
    $stmt->bind_param();
    $stmt->execute();

    header('Location: ../profile.php');
?>