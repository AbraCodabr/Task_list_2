<?php
    // Подключение к сессии
    session_start();

    // Подключение к БД 
    require_once 'includes/connect.php';

    if (!$_SESSION['user']) {
        header('Location: /index.php');
    }

    // Запрос к табл. tasks
    $user_id = $_SESSION['user']['id'];
    
    $check_tasks = $connect->prepare("SELECT * FROM `tasks` WHERE `user_id` = ?");
    $check_tasks->bind_param("i", $user_id);
    $check_tasks->execute();
    $check_tasks = $check_tasks->get_result();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/profile.css">
    <title>Профиль</title>
</head>
<body>

    <div class="greeting">
        <?echo '<h2>' . $_SESSION['user']['login'] . '</h2>'; ?>
        <form action="includes/logout.php">
            <button class="button_exit">Exit</button>
        </form>
        
    </div>

    <div class="container">
    
        <!-- 1 блок -->
        <h3>Task list</h3>
        <form class="form" action="controllers/add.php" method="post">
            <input class="ad enter_text" name="input" type="text" placeholder="Enter text ...">
            <button class="ad add_task" name="submit" type="submit">ADD TASK</button>
        </form>

        <div class="button_all">
            <form action="controllers/remove_all.php" method="post">
                <button class="button_content">REMOVE ALL</button>
            </form>
            <form action="controllers/ready_all.php" method="post">
                <button class="button_content">READY ALL</button>
            </form>
        </div>

        <!-- 2 блок -->
        <?php
            if ($check_tasks->num_rows == 0):
                echo '<p>' . "У вас нет введеных задач" . '</p>';
            endif;
        ?>
        <!-- Цикл по ответу из БД -->
        <?foreach ($check_tasks as $array):?>

        <div class="content">
            <!-- Вывод круга в зависимости от статуса -->
            <?php
                if ($array['status']) {
                    echo '<div class="circle_green"></div>';
                } else {
                    echo '<div class="circle_red"></div>';
                }
            ?>
            <!-- Текст заметки -->
            <p class="text"><?php echo $array['description'] ?></p>

            <!-- Вывод кнопок. Текст в кнопке меняется в зависимости от статуса -->
            <div class="button">
                <form action="controllers/<? echo ($array['status']) ? 'ready': 'unready';?>.php" method="post">
                    <button class="button_content" name="<? echo $array['id'] ?>" type="">
                        <?php 
                            if ($array['status']) {
                                echo 'UNREADY';
                            } else {
                                echo 'READY';
                            }
                        ?>
                    </button>
                </form>

                <!-- Удаление заметки -->
                <form action="controllers/delete.php" method="post">
                    <button class="button_content" name="<? echo $array['id'] ?>" type="">DELETE</button>
                </form>  

            </div>
        </div>
        <?php endforeach ?>
    </div>
</body>
</html>