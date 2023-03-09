<?php
session_start();

$connect = mysqli_connect('localhost', 'root', '', 'tutor');
if(!$connect){
    die('Ошибка подключения к БД');
}

$description = $_POST['description'];
$user_id = $_POST['user_id'];
$post_id = $_POST['post_id'];



if($description !==''){
    mysqli_query($connect, "INSERT INTO `reviews`(
                      `id`,
                      `description`,
                      `user_id`,
                      `post_id`)
                      VALUES(NULL, '$description', '$user_id', '$post_id')");
    if($_SESSION['user']['role_id'] === '1'){
        header('Location: ../main-page-tutor.php');
    } else{
        header('Location: ../main-page.php');
    }
}
//var_dump($post_id, $user_id, $description);
