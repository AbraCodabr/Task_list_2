<?php
    // Подключение к сессии
    session_start();

    // Проверка на авторизацию
    if (!$_SESSION['user']) {
        header('Location: ../index.php');
    }

    // Подключение к БД 
    require_once '../includes/connect.php';
 
    $stmt = $connect->prepare("DELETE FROM `tasks` WHERE `id` = ? AND `user_id` = ?");
    $stmt->bind_param('ii', key($_POST), $_SESSION['user']['id']);
    $stmt->execute();
    
    header('Location: ../profile.php');
    
    
    
?>