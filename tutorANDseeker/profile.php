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
        <form class="form_container" method="post">
            <h1 class="form_title">Личный кабинет</h1>
            <label class="form_label">ФИО:</label>
            <p><?= $_SESSION['user']['fullname']?></p>
            <label class="form_label">Возраст:</label>
            <p><?= $_SESSION['user']['age']?></p>
            <label class="form_label">Логин:</label>
            <p><?= $_SESSION['user']['login']?></p>
            <label class="form_label">Почта:</label>
            <p><?= $_SESSION['user']['email']?></p>
            <p class="form_p border">
                <a href="edit-page.php?id=<?= $_SESSION['user']['id']?>" class="form_link">Редактировать профиль</a>
            </p>
            <?php
            if($_SESSION['user']['role_id'] === '1'){
                ?>
                <p class="form_p border">
                    <a href="main-page-tutor.php" class="form_link">На главную страницу</a>
                </p>
                <?php
            }else{
                ?>
                <p class="form_p border">
                    <a href="main-page.php" class="form_link">На главную страницу</a>
                </p>
                <?php
            }
            ?>
            <p class="form_p border">
                <a href="user_orders.php?id=<?=$_SESSION['user']['id']?>" class="form_link">Ваши заказы</a>
            </p>
            <p class="form_p border">
                <a href="vendor/log-out.php" class="form_link exit">Выйти из аккаунта</a>
            </p>

        </form>
    </div>
</main>
</body>
</html>
