<?php
    // Подключение к сессии
    session_start();

    // Проверка на авторизацию
    if (!$_SESSION['user']) {
        header('Location: ../index.php');
    }

    // Подключение к БД 
    require_once '../includes/connect.php';

    /* Меняет статус заметки с "выполнено" на "невыполнено"
    Меняем статус задачи в табл. tasks */
    $stmt = $connect->prepare("UPDATE `tasks` SET `status` = NULL WHERE `id` = ?");
    $stmt->bind_param("i", key($_POST));
    $stmt->execute();

    header('Location: ../profile.php');
?>