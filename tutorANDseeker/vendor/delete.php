<?php
session_start();

$connect = mysqli_connect('localhost', 'root', '', 'tutor');
if(!$connect){
    die('Ошибка подключения к БД');
}

$id = $_POST['id'];

mysqli_query($connect, "DELETE FROM `posts` WHERE `id` = '$id'");

header('Location: ../main-page-tutor.php');

?>

