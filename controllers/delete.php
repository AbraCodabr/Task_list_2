<?php
    // Подключение к сессии
    session_start();

    // Подключение к БД 
    require_once '../includes/connect.php';

    foreach ($_POST as $key => $value) {
        $key = $key;
    }

    $stmt = $connect->prepare("DELETE FROM `tasks` WHERE `id` = ?");
    $stmt->bind_param("i", $key);
    $stmt->execute();

    header('Location: ../profile.php');

?>