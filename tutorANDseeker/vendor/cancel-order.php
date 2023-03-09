<?php
session_start();

$connect = mysqli_connect('localhost', 'root','','tutor');
if(!$connect){
    die('Ошибка подключения к БД');
}

$id = $_GET['id'];

mysqli_query($connect, "DELETE FROM `orders` WHERE `id` = '$id'");

header('Location: ../user_orders.php?id=' . $_SESSION['user']['id'] . '');