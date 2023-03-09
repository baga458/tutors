<?php
session_start();

$connect = mysqli_connect('localhost', 'root', '', 'tutor');
if(!$connect){
    die('Ошибка подключения к БД');
}

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
        <form class="form_container" action="forgot-pass.php" method="post">
            <h1 class="form_title">Восстановление пароля</h1>

            <?php
            if(isset($_POST['submit'])){
                $user_login = $_POST['login'];
                $user = mysqli_query($connect, "SELECT * FROM `users` WHERE `login` = '$user_login'");
                if(mysqli_num_rows($user)>0){
                    $user = mysqli_fetch_assoc($user);
                    $_SESSION['reg_message'] = 'Такой пользователь существует. <br> Смените пароль.';
            ?>
                    <input type="hidden" name="user_login" value="<?=$user['login']?>">
                    <label class="form_label">Введите ваш новый пароль</label>
                    <input class="form_input" type="password" name="new_password" placeholder="Введите свой новый пароль">
                    <button class="form_btn" type="submit" name="change">Изменить пароль</button>
            <?php
            }else{
                $_SESSION['message'] = 'Пользователя с таким логином не существует';
                ?>
                    <label class="form_label">Введите ваш логин</label>
                    <input class="form_input" type="text" name="login" placeholder="Введите логин">
                    <button class="form_btn" type="submit" name="submit">Проверить логин</button>
                <?php
            }
            }else{
            ?>
                <label class="form_label">Введите ваш логин</label>
                <input class="form_input" type="text" name="login" placeholder="Введите логин">
                <button class="form_btn" type="submit" name="submit">Проверить логин</button>
            <?php
                if(isset($_POST['change'])){
                    $pass = $_POST['new_password'];
                    if($pass !== ''){
                        $user_login= $_POST['user_login'];
                        $pass = md5($_POST['new_password']);
                        mysqli_query($connect, "UPDATE `users` SET `password` = '$pass' WHERE `login` = '$user_login'");
                        $_SESSION['reg_message'] = 'Вы изменили пароль';
                        header('Location: ../index.php');
                    }else{
                        $_SESSION['message'] = 'Поле не должно быть пустым. <br> Попробуйте снова!';
                    }
                }
            }
            if (isset($_SESSION['reg_message'])) {
                echo '<p class="success_message">' . $_SESSION['reg_message'] . '</p>';
            } unset($_SESSION['reg_message']);

            if (isset($_SESSION['message'])) {
                echo'<p class="err_message">' . $_SESSION['message'] . '</p>';
            }
            unset($_SESSION['message']);
            ?>
            <p class="form_p">
                <a class="form_link" href="index.php">Вернуться на страницу входа</a>
            </p>
        </form>
    </div>
</main>
</body>
</html>