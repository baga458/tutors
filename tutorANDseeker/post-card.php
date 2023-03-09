<?php

session_start();

$connect = mysqli_connect('localhost', 'root','','tutor');
if(!$connect){
    die('Ошибка подключения к БД');
}

$post_id = $_GET['id'];

$post  = mysqli_query($connect, "SELECT * FROM `posts` WHERE `id` = '$post_id'");


$post = mysqli_fetch_assoc($post);

$user = $post['user_id'];

$user_author = mysqli_query($connect, "SELECT * FROM `users` WHERE `id` = '$user'");

$user_author = mysqli_fetch_assoc($user_author);





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
        <form class="form_container height" method="post">
            <div class="form_head">
                <h1><?=$post['title']?></h1>
                <h2 class="form_p tutor-price">Цена: от <?=$post['price']?>₽</h2>
            </div>
            <div class="tutor_info">
                <div class="tutor_img">
                    <img src="<?=$post['image']?>" style="border-radius: 20px; height: 150px;
            width: 200px; align-self: center" alt="tutor-image">
                </div>
                <input type="hidden" name="id" value="<?= $post['id']?>">
                <input type="hidden" name="user_id" value="<?= $post['user_id']?>">
                <div class="form_div">
                    <p><span style="font-weight: bold">ФИО: </span><br><?=$user_author['fullname']?></p>
                    <p><span style="font-weight: bold">Возраст:</span> <br> <?=$post['age']?></p>
                    <p><span style="font-weight: bold">Образование:</span> <br> <?=$post['education']?></p>
                    <p><span style="font-weight: bold">Страна:</span> <br> <?=$post['country']?></p>
                    <p><span style="font-weight: bold">Город:</span> <br> <?=$post['city']?></p>
                    <p><span style="font-weight: bold">Для связи:</span> <br> <?=$post['contact']?></p>
                </div>
                <div class="form_div">
                    <label class="form_label">Описание вакансии:</label>
                    <p class="form_p" style="width: 400px; margin: 0px auto;
                            word-wrap: break-word;"> <?=$post['description']?></p>
                    <p><span style="font-weight: bold">Метод обучения:</span> <br> <?=$post['edu_meth']?></p>
                    <p><span style="font-weight: bold">Обучение:</span> <br> <?=$post['teaching']?></p>
                </div>
            </div>
            <div>
                <?php
                    if($_SESSION['user']['id'] === $post['user_id']){

                    }else{
                 ?>
                    <p class="form_p">
                        <a class="form_link" href="order-page.php?id=<?=$post['id']?>">Оформить заказ</a>
                    </p>

                <?php
                    }
                ?>

                <?php
                if($_SESSION['user']['id'] === $post['user_id']){
                    ?>
                        <div class="change_div">
                            <p style="justify-self: end">
                                <a href="edit-service.php?id=<?=$post['id']?>" class="form_link">Изменить</a>
                            </p>
                            <p style="justify-self: start">
                                <a  href="delete-service.php?id=<?=$post['id']?>" class="form_link exit">Удалить</a>
                            </p>
                        </div>
                    <?php
                }
                ?>
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
            </div>
        </form>
    </div>


<!--        <form class="tutor_info" action="" method="post">-->
<!--
        </form>
    </div>
</main>
</body>
</html>
