<?php
    // Подключение к сессии
    session_start();

    // Проверка на авторизацию
    if (!$_SESSION['user']) {
        header('Location: /index.php');
    }

    // Подключение к БД 
    require_once '../includes/connect.php';

    $id_note = (int)key($_POST);
    $id_user = $_SESSION['user']['id'];

    // Меняем статус задачи в табл. tasks
    $stmt = $connect->prepare("UPDATE `tasks` SET `status` = '1' WHERE `id` = ? AND `user_id` = ?");
    $stmt->bind_param("ii", $id_note, $id_user);
    $stmt->execute();

    header('Location: ../profile.php');
?>