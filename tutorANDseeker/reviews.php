<?php

session_start();

$connect = mysqli_connect('localhost', 'root','','tutor');
if(!$connect) {
    die('Ошибка подключения к БД');

}

$post_id = $_GET['id'];


$review = mysqli_query($connect, "SELECT * FROM `reviews` WHERE `post_id` = '$post_id'");


$reviews = mysqli_fetch_all($review);

?>

<!doctype html>
<html lang="en">
<head>
    <title>T&S</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header class="header_container tutor" style="grid-template-columns: 1fr">
    <h2 class="header_title">
        <?php
            if($_SESSION['user']['role_id']==='1'){
        ?>
        <a class="header_link" href="main-page-tutor.php">Tutor & Seeker</a>
    </h2>
    <?php
    }else{
    ?>
        <a class="header_link" style="text-align: center" href="main-page.php">Tutor & Seeker</a>
    <?php

    }
    ?>
</header>
    <div style="margin: 0 auto; width: 400px">
        <h1 style="text-align: center; margin: 15px 0" >Отзывы:</h1>
    </div>
<div class="tutor_card_container" style="row-gap: 15px">
    <?php

     foreach ($reviews as $review){
         $user = mysqli_query($connect, "SELECT * FROM `users` WHERE `id` = '$review[2]'");
         $users = mysqli_fetch_assoc($user)
    ?>
        <form class="form_container" style="width: 350px;margin: auto; border: #028d02 3px solid">
            <div class="form_div" style="padding: 10px 0;">
                <label class="form_label">Имя пользователя: </label>
                <p class="form_p"><?=$users['fullname']?></p>
                <label class="form_label">Отзыв: </label>
                <p class="form_p"><?=$review[1]?></p>
            </div>
        </form>
        <?php
        }
         if(!$reviews){
            ?>
            <div style="margin: 0 auto; width: 400px">
                <h1 style="text-align: center; margin: 15px 0" >Отзывов пока нет :(((((</h1>
            </div>
    <?php
    }
         ?>
</div>
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

</body>
</html>
