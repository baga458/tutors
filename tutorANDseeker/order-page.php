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
        <form class="form_container" action="vendor/order.php" method="post">
            <h1 class="form_title">Оформление заказа</h1>
            <input type="hidden" name="user_id" value="<?=$_SESSION['user']['id']?>">
            <input type="hidden" name="post_id" value="<?=$post['id']?>">
            <input type="hidden" name="author_id" value="<?=$post['user_id']?>">
            <label class="form_label">Ваше полное имя:</label>
            <input type="text" class="form_input" name="fullname" value="<?=$_SESSION['user']['fullname']?>">
            <label class="form_label">Ваш номер телефона:</label>
            <input class="form_input" type="text" name="phone" placeholder="Введите ваш номер телефона для связи">
            <button class="form_btn" type="submit">Оформить</button>
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

<pre>
<!--    --><?php
//    var_dump($post);
//    ?>
</pre>
</body>
</html>


