<?php
session_start();

$connect = mysqli_connect('localhost', 'root', '', 'tutor');
if(!$connect){
    die('Ошибка подключения к БД');
}
$title = $_POST['title'];
$description = $_POST['description'];
$user_id = $_POST['id'];


if($title === '' || $description === '') {
    $_SESSION['message'] = 'Заполните все поля!';
    header('Location: ../support.php?id=' . $_SESSION['user']['id']);
}else{
    mysqli_query($connect, "INSERT INTO `supports` (
                        `id`,
                        `title`,
                        `description`,
                        `user_id`)
                        VALUES(NULL, '$title', '$description', '$user_id')");
    $_SESSION['reg_message'] = 'Ваше обращение отправлено. Ответ придет вам на почту';
    header('Location: ../support.php?id=' . $_SESSION['user']['id']);
}