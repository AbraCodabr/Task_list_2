<?php
    // Подключение к сессии
    session_start();
    // Подключение к БД 
    require_once '../includes/connect.php';

    $user_id = $_SESSION['user']['id'];
    $description = htmlspecialchars($_POST['input']);

    // Добавление задачи в табл. tasks
    $stmt = $connect->prepare("INSERT INTO `tasks` (`id`, `user_id`, `description`, `created_at`, `status`) VALUES (NULL, ?, ?, NULL, NULL)");
    $stmt->bind_param("is", $user_id, $description);
    $stmt->execute();

    header('Location: ../profile.php');

?>