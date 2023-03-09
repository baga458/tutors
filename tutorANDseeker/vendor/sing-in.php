<?php
session_start();
$connect = mysqli_connect('localhost', 'root','','tutor');
if(!$connect){
    die('Ошибка подключения к БД');
}

$login = $_POST['login'];
$password = md5($_POST['password']);



$check_user = mysqli_query($connect,"SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password' AND  `role_id` = '1'");

$check_user1 = mysqli_query($connect,"SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password' AND  `role_id` = '2'");

if(mysqli_num_rows($check_user)>0){
    $user = mysqli_fetch_assoc($check_user);
    $_SESSION ['user'] = [
        "id" => $user['id'],
        "fullname" => $user['fullname'],
        "login" => $user['login'],
        "email" => $user['email'],
        "age" => $user['age'],
        "role_id" =>$user['role_id']
    ];
    header('Location: ../main-page-tutor.php');

}elseif(mysqli_num_rows($check_user1)>0){
    $user = mysqli_fetch_assoc($check_user1);
    $_SESSION ['user'] = [
        "id" => $user['id'],
        "fullname" => $user['fullname'],
        "login" => $user['login'],
        "email" => $user['email'],
        "age" => $user['age'],
        "role_id" =>$user['role_id']
    ];
    header('Location: ../main-page.php');
}else{
    $_SESSION['message'] = 'Введены неверные данные. <br> Попробуйте еще раз!';
    header('Location: ../index.php');
}
