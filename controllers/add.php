<?php
    // Подключение к сессии
    session_start();

    // Проверка на авторизацию
    if (!$_SESSION['user']) {

        header('Location: ../index.php');
    }

    // Подключение к БД 
    require_once '../includes/connect.php';

    $user_id = $_SESSION['user']['id'];
    $description = htmlspecialchars($_POST['input']);

    // Добавление задачи в табл. tasks
    $stmt = $connect->prepare("INSERT INTO `tasks` (`user_id`, `description`) VALUES (?, ?)");
    $stmt->bind_param("is", $user_id, $description);
    $stmt->execute();

    header('Location: ../profile.php');

?>