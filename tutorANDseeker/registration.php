<?php
session_start();
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
        <form class="form_container" action="vendor/sign-up.php" method="post">
            <h1 class="form_title">Регистрация</h1>
            <label class="form_label">ФИО</label>
            <input class="form_input" type="text" name="fullname" placeholder="Введите ваше ФИО">
            <label class="form_label">Возраст</label>
            <input class="form_input" type="text" name="age" placeholder="Введите ваш возраст">
            <label class="form_label">Логин</label>
            <input class="form_input" type="text" name="login" placeholder="Введите логин">
            <label class="form_label">Почта</label>
            <input class="form_input" type="email" name="email" placeholder="Введите вашу почту">
            <label class="form_label">Пароль</label>
            <input class="form_input" type="password" name="password" placeholder="Придумайте пароль">
            <label class="form_label">Подтвердите пароль</label>
            <input class="form_input" type="password" name="confirm_password" placeholder="Повторите пароль">
            <label class="form_label">Репетитор</label>
            <input class="form_check" type="checkbox" name="tutor" value="1">
            <?php
                if(isset($_SESSION['message'])){
                    echo'<p class="err_message">' . $_SESSION['message'] . '</p>';
                }
                unset($_SESSION['message']);
            ?>
            <button class="form_btn" type="submit">Зарегистрироваться</button>
            <p class="form_p">
                Уже есть аккаунт? - <a class="form_link" href="/index.php">Войти</a>
            </p>
        </form>
    </div>

</main>
</body>
</html>