<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Авторизация и регистрация</title>
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>
    <!-- Авторизация -->
    <form action="includes/signin.php" method="post">
        <label >Логин</label>
        <input type="login" name="login" placeholder="Введите свой логин">
        <label>Пароль</label>
        <input type="passwors" name="password" placeholder="Введите свой пароль">
        <button type="submit">Войти/зарегистрироваться</button>
        <?php
            if ($_SESSION['massage']) {
                echo '<p class="msg"> ' . $_SESSION['massage'] . '</p>';
            }
            unset($_SESSION['massage']);
        ?>
    </form>
</body>
</html>