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
    <title>T&S</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<main>
    <div class="container">
        <form class="form_container" action="vendor/add.php" method="post" enctype="multipart/form-data">
            <h1 class="form_title">Добавление услуги</h1>
            <div class="add_serv">
                <input type="hidden" name="id" value="<?= $user['id']?>">
                <div class="form_div" style="">
                    <label class="form_label" >Название услуги:</label>
                    <textarea class="form_input resize" name="title" placeholder="Введите название услуги"></textarea>
                    <div style="display: flex; justify-content: center">
                       <label class="form_label">Ваш возраст:</label>
                       <input style="border-radius:15px; border: unset; padding: 5px" name="age" value="<?=$_SESSION['user']['age']?>" >
                    </div>
                    <label class="form_label">Добавьте изображение:</label>
                    <input type="file" name="avatar">
                    <label class="form_label">Информация об вашем образовании:</label>
                    <select class="filters" style="width: 300px" name="education">
                        <option value="Высшее">Высшее</option>
                        <option value="Среднее общее">Среднее общее</option>
                        <option value="Среднее специальное">Среднее специальное</option>
                    </select>
<!--                    <textarea class="form_input resize" type="text" name="education" placeholder="Введите информацию"></textarea>-->
                    <label class="form_label">Страна работы:</label>
                    <input type="text" class="form_input" name="country" placeholder="Введите страну">
                    <label class="form_label">Город работы:</label>
                    <select class="filters" style="width: 300px" name="city" id="">
                        <option value="Москва">Москва</option>
                        <option value="Санкт-Петербург">Санкт-Петербург</option>
                        <option value="Рязань">Рязань</option>
                        <option value="Ижевск">Ижевск</option>
                        <option value="Тверь">Тверь</option>
                        <option value="Нижний Новгород">Нижний Новгород</option>
                        <option value="Подольск">Подольск</option>
                    </select>
                </div>
                <div class="form_div">
                    <label class="form_label">Обучение:</label>
                    <select class="filters" style="width: 300px" name="teaching" id="">
                        <option value="Дошкольное">Дошкольное</option>
                        <option value="Начальное">Начальное</option>
                        <option value="Общее">Общее</option>
                        <option value="Среднее">Среднее</option>
                        <option value="Высшее">Высшее</option>
                    </select>
                    <label class="form_label">Метод обучения:</label>
                    <select class="filters" style="width: 300px" name="edu_meth">
                        <option value="Очное">Очное</option>
                        <option value="Заочное(онлайн)">Заочное(онлайн)</option>
                    </select>
<!--                    <input type="text" class="form_input" name="edu_meth" placeholder="Введите метод">-->
                    <label class="form_label">Описание услуги и ваши знания:</label>
                    <textarea class="form_input support" name="description" placeholder="Опишите вашу услугу..."></textarea>
                    <label class="form_label">Контактные данные:</label>
                    <textarea class="form_input resize" name="contact" placeholder="Введите контактные данные"></textarea>
                </div>
            </div>
            <label class="form_label">Стоимость услуги:</label>
            <input class="form_input price" type="text" name="price" placeholder="Введите стоимость">
            <button class="form_btn" type="submit">Добавить</button>
                <p class="form_p">
                    <a href="main-page-tutor.php" class="form_link">Вернуться на главную страницу</a>
                </p>
            <?php
            if(isset($_SESSION['message'])){

                echo'<p class="err_message">' . $_SESSION['message'] . '</p>';
            }
            unset($_SESSION['message']);
            ?>
        </form>

    </div>
</main>
</body>
</html>
