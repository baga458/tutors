<?php

session_start();

$connect = mysqli_connect('localhost', 'root','','tutor');
if(!$connect){
    die('Ошибка подключения к БД');
}

$user_id = $_GET['id'];

$user = mysqli_query($connect, "SELECT * FROM `users` WHERE `id` = '$user_id'");

$user = mysqli_fetch_assoc($user);


?>
<!doctype html>
<html lang="en">
<head>
    <title>T&S</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<main>
    <div class="container">
        <form class="form_container" action="vendor/send-mess.php" method="post">
            <h1 class="form_title">Обращение в службу поддержки</h1>
            <input type="hidden" name="id" value="<?=$user['id']?>">
            <label class="form_label">Ваше имя:</label>
            <p class="form_p" name="fullname"><?= $user['fullname']?></p>
            <label class="form_label">Ваша почта:</label>
            <p class="form_p" name="email"><?=$user['email']?></p>
            <label class="form_label">Тема обращения:</label>
            <input class="form_input" type="text" name="title" placeholder="Введите тему обращения">
            <label class="form_label">Текст обращения:</label>
            <textarea class="form_input support" type="text" name="description" placeholder="Опишите проблему"></textarea>
            <?php
            if (isset($_SESSION['reg_message'])) {
                echo '<p class="success_message">' . $_SESSION['reg_message'] . '</p>';
            } unset($_SESSION['reg_message']);

            if (isset($_SESSION['message'])) {
                echo'<p class="err_message">' . $_SESSION['message'] . '</p>';
            }
            unset($_SESSION['message']);
            ?>
            <button class="form_btn" type="submit">Отправить</button>
            <?php
            if($_SESSION['user']['role_id'] === '1'){
                ?>
                <p class="form_p">
                    <a href="main-page-tutor.php" class="form_link">Вернуться на главную страницу</a>
                </p>
                <?php
            }else{
                ?>
                <p class="form_p">
                    <a href="main-page.php" class="form_link">Вернуться на главную страницу</a>
                </p>
                <?php
            }
            ?>
        </form>
    </div>
</main>
</body>
</html>
