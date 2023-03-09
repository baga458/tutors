<?php
session_start();

$connect = mysqli_connect('localhost', 'root','','tutor');
if(!$connect){
    die('Ошибка подключения к БД');
}
$id = $_POST['id'];
$age = $_POST['age'];
$fullname = $_POST['fullname'];
$login = $_POST['login'];
$email = $_POST['email'];
$password = $_POST['password'];

if($age !== '' || $fullname !== '' || $login !== '' || $email !== '' || $password !== ''){
    $password = md5($password);
    mysqli_query($connect,
        "UPDATE `users` SET `fullname` = '$fullname',
                   `age` = '$age',
                   `login` = '$login',
                   `email` = '$email',
                   `password` = '$password'
                    WHERE `users`.`id` = '$id'");
    $_SESSION['reg_message'] = 'Данные были изменены. Войдите снова';
    header('Location: ../index.php');

    header('Location: /vendor/log-out.php');
}else{
    $_SESSION['message'] = 'Заполните все поля';
    header('Location: ../edit-page.php');
}

