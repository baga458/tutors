<?php

session_start();

$connect = mysqli_connect('localhost', 'root','','tutor');
if(!$connect){
    die('Ошибка подключения к БД');
}

$post_id = $_GET['id'];

$post = mysqli_query($connect, "SELECT * FROM `posts` WHERE `id` = '$post_id'");

$post = mysqli_fetch_assoc($post);

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
        <form class="form_container" action="vendor/send-review.php" method="post">
            <h1 class="form_title">Оставить отзыв</h1>
            <input type="hidden" name="user_id" value="<?=$_SESSION['user']['id']?>">
            <input type="hidden" name="post_id" value="<?=$post['id']?>">
            <label class="form_label">Ваше имя:</label>
            <p class="form_p" name="fullname"><?= $_SESSION['user']['fullname']?></p>
            <label class="form_label">Текст отзыва:</label>
            <textarea class="form_input support" type="text" name="description" placeholder="Напишите ваш отзыв"></textarea>
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
    <pre>
        <?php
        var_dump($post['id']);
        ?>
    </pre>
</main>
</body>
</html>

