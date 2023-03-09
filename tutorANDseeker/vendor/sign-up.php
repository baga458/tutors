<?php
session_start();

$connect = mysqli_connect('localhost', 'root', '', 'tutor');
if(!$connect){
    die('Ошибка подключения к БД');
}
$fullname = $_POST['fullname'];
$age = $_POST['age'];
$login = $_POST['login'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
$tutor = $_POST['tutor'];

$check_user = mysqli_query($connect, "SELECT * FROM `users` WHERE `login` = '$login' OR `email` = '$email'");
if(mysqli_num_rows($check_user)>0){
    $_SESSION['message'] = 'Логин или пароль <br> уже используются!';
    header('Location: ../registration.php ');
}elseif($fullname === '' || $password === '' || $email === '' || $login === '' || $age === '' || $confirm_password === '') {
    $_SESSION['message'] = 'Заполните все поля!';
    header('Location: ../registration.php');
}elseif($password === $confirm_password & $tutor === '1'){
    $password = md5($password);

    mysqli_query(
        $connect,
        "INSERT INTO `users` (
                     `id`,
                     `fullname`,
                     `age`,
                     `login`,
                     `email`,
                     `password`,
                     `role_id`)
                     VALUES(NULL, '$fullname','$age','$login','$email','$password', '$tutor')");
    $_SESSION['reg_message'] = 'Регистрация прошла успешно';
    header('Location: ../index.php');
} elseif($password === $confirm_password & $tutor !== '1'){
    $password = md5($password);

    mysqli_query(
        $connect,
        "INSERT INTO `users` (
                     `id`,
                     `fullname`,
                     `age`,
                     `login`,
                     `email`,
                     `password`)
                     VALUES(NULL, '$fullname','$age','$login','$email','$password')");
    $_SESSION['reg_message'] = 'Регистрация прошла успешно';
    header('Location: ../index.php');
}else{
    $_SESSION['message'] = 'Пароли не совпадают';
    header('Location: ../registration.php');
}