<?php
session_start();

$connect = mysqli_connect('localhost', 'root','','tutor');
if(!$connect){
    die('Ошибка подключения к БД');
}

$user_id = $_GET['id'];

$user = mysqli_query($connect, "SELECT * FROM `users` WHERE `id` = '$user_id'");

$user = mysqli_fetch_assoc($user);


?>
<!doctype html>
<html lang="en">
<head>
    <title>Document</title>
    <!--        <link rel="stylesheet" href="css/style.css">-->
</head>
<body style="background: #ccffc1; font-family: cursive">
<main>
    <div style="display: flex;
                align-items: center;
                justify-content: center;
                height: 100vh;">
        <form style="display: flex;
            flex-direction: column;
            width: 400px;
            border: 2px solid #a3e394;
            border-radius: 50px;
            background: #a3e394;
            padding: 0 65px;
            box-shadow: 3px 0px 20px 2px rgba(0,0,0,0.4);
            text-align: center;" action="vendor/edit.php" method="post">
            <h1 style="margin: 15px auto;">Редактирование данных</h1>
            <input type="hidden" name="id" value="<?=$user['id']?>">
            <label style="font-weight: bold;">Измените ФИО:</label>
            <input style=" margin: 5px auto;padding: 10px;border: 2px solid #e3e3e3;outline: none;
                border-radius: 15px; width: 350px" type="text" name="fullname" value="<?= $user['fullname'] ?>">
            <label style="font-weight: bold;">Измените возраст:</label>
            <input style=" margin: 5px auto;padding: 10px;border: 2px solid #e3e3e3;outline: none;
                border-radius: 15px; width: 350px" type="text" name="age" value="<?= $user['age'] ?>">
            <label style="font-weight: bold;">Измените логин:</label>
            <input style=" margin: 5px auto;padding: 10px;border: 2px solid #e3e3e3;outline: none;
                border-radius: 15px; width: 350px" type="text" name="login" value="<?= $user['login'] ?>">
            <label style="font-weight: bold;">Измените почту:</label>
            <input style=" margin: 5px auto;padding: 10px;border: 2px solid #e3e3e3;outline: none;
                border-radius: 15px; width: 350px" type="email" name="email" value="<?= $user['email'] ?>">
            <label style="font-weight: bold;">Измените пароль:</label>
            <input style=" margin: 5px auto;padding: 10px;border: 2px solid #e3e3e3;outline: none;
                border-radius: 15px; width: 350px" type="text" name="password" value="<?= $user['password'] ?>">
            <button style="padding: 10px; background: #80cf6f; margin: 10px auto;
                width: 300px; border: unset;border-radius: 15px;box-shadow: 0px 2px 10px 2px rgba(0,0,0,0.3);
                font-size: 17px;" onmouseover="this.style.backgroundColor='#65ab50';"
                    onmouseout="this.style.backgroundColor='#80cf6f';" type="submit">Сохранить изменения</button>
            <p class="form_p border">
                <a href="profile.php" style="color: black;font-weight: bold;text-decoration: none;"
                   onmouseover="this.style.color= '#028d02';"
                   onmouseout="this.style.color='black';">Вернуться в личный кабинет</a>
            </p>
        </form>
    </div>
</main>
</body>
</html>

