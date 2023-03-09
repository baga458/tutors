<?php
session_start();

$connect = mysqli_connect('localhost', 'root', '', 'tutor');
if(!$connect){
    die('Ошибка подключения к БД');
}
$user_id = $_POST['user_id'];
$post_id = $_POST['post_id'];
$author_id = $_POST['author_id'];
$fullname = $_POST['fullname'];
$phone = $_POST['phone'];

if($fullname !== '' & $phone !== ''){
    mysqli_query($connect, "INSERT INTO `orders`(
                     `id`,
                     `fullname`,
                     `phone`,
                     `user_id`,
                     `post_id`,
                     `author_id`)
                     VALUES(NULL, '$fullname', '$phone', '$user_id','$post_id', '$author_id')");
    if($_SESSION['user']['role_id'] === '1'){
        header('Location: ../main-page-tutor.php');
    }else{
        header('Location: ../main-page.php');
    }
}