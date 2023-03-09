<?php
session_start();

$connect = mysqli_connect('localhost', 'root','','tutor');
if(!$connect){
    die('Ошибка подключения к БД');
}

$user_id = $_GET['id'];

$request = mysqli_query($connect, "SELECT * FROM `orders` WHERE `user_id` = '$user_id'");

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
    <h1 style="text-align: center; margin: 15px 0" >Ваши заказы:</h1>
</div>
<div class="tutor_card_container" style="row-gap: 15px">
    <?php
    if($rw = mysqli_num_rows($request)>0){
        $orders = mysqli_fetch_all($request);
        foreach($orders as $order){
            $post_id = $order[4];
            $posts = mysqli_query($connect, "SELECT * FROM `posts` WHERE `id` = '$post_id'");
            $posts = mysqli_fetch_all($posts);
            foreach ($posts as $post){
            ?>
            <form class="form_container" style="width: 350px;margin: auto; border: #028d02 3px solid">
                <div class="form_div" style="padding: 10px 0;">
                    <label class="form_label">Название услуги:</label>
                    <p class="form_p"><?=$post[1]?></p>
                    <label class="form_label">Описание услуги: </label>
                    <p class="form_p"><?=$post[12]?></p>
                    <label class="form_label">Цена услуги: </label>
                    <p class="form_p">от <?=$post[10]?>₽</p>
                </div>
                <p class="form_p">
                    <a class="form_link exit" href="vendor/cancel-order.php?id=<?=$order[0]?>">Отменить</a>
                </p>
            </form>
            <?php
        }
        }
    }else{
        ?>
        <div style="margin: 0 auto; width: 400px">
            <h1 style="text-align: center; margin: 15px 0" >Пока у вас нет заказов..</h1>
        </div>
        <?php
    }
    ?>
</div>
<div>
    <p style="margin: 25px 0;" class="form_p">
        <a href="profile.php?id=<?=$_SESSION['user']['id']?>" class="form_link">Вернуться на страницу профиля</a>
    </p>
</div>
</body>
</html>