<?php
session_start();

$connect = mysqli_connect('localhost', 'root', '', 'tutor');
if(!$connect){
    die('Ошибка подключения к БД');
}

$post_id = $_GET['id'];

$post  = mysqli_query($connect, "SELECT * FROM `posts` WHERE `id` = '$post_id'");

$post = mysqli_fetch_assoc($post);


?>
<!doctype html>
<html lang="en">
<head>
    <title>T&S</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
    <form class="form_container" action="vendor/delete.php" method="post">
        <input type="hidden" name="id" value="<?=$post['id']?>">
        <h2 style="margin-top: 15px">Точно хотите удалить свою вакансию?</h2>
        <button class="form_btn" type="submit">Да, удалить</button>
        <p class="form_p">
            <a href="main-page-tutor.php" class="form_link">Нет, вернуться на главную страницу</a>
        </p>
    </form>
</div>
</body>
</html>
