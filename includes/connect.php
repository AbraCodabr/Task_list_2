<?php
    // Подключение к БД
    $connect = new mysqli('localhost', 'root', '', 'tasklist');

    // Проверка подключения
    if ($connect->connect_error) {
        die('Error connect to DataBase' . $connect->connect_error);
    }
?>