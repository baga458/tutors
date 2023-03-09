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
        <form class="form_container" action="vendor/sing-in.php" method="post">
            <h1 class="form_title">Вход</h1>
            <label class="form_label">Логин</label>
            <input class="form_input" type="text" name="login" placeholder="Введите логин">
            <label class="form_label">Пароль</label>
            <input class="form_input"  type="password" name="password" placeholder="Введите ваш пароль">
            <button class="form_btn" type="submit">Войти</button>
            <?php
            if (isset($_SESSION['reg_message'])) {
                echo '<p class="success_message">' . $_SESSION['reg_message'] . '</p>';
            } unset($_SESSION['reg_message']);

            if (isset($_SESSION['message'])) {
                echo'<p class="err_message">' . $_SESSION['message'] . '</p>';
            }
            unset($_SESSION['message']);
            ?>
            <p class="form_p">
                Забыли пароль?  - <a class="form_link" href="forgot-pass.php">Восстановите его!</a>
            </p>
            <p class="form_p">
                Впервые здесь?  - <a class="form_link" href="registration.php">Зарегистрируйтесь!</a>
            </p>

        </form>
    </div>
</main>
</body>
</html>