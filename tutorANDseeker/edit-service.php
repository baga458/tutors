<?php
session_start();

$connect = mysqli_connect('localhost', 'root','','tutor');
if(!$connect){
    die('Ошибка подключения к БД');
}

$post_id = $_GET['id'];

$post = mysqli_query($connect, "SELECT * FROM `posts` WHERE `id` = '$post_id'");

$post = mysqli_fetch_assoc($post);


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
            text-align: center;" action="vendor/edit-serv-post.php" method="post" enctype="multipart/form-data">
            <h1 style="margin: 15px auto;">Редактирование услуги</h1>
            <input type="hidden" name="id" value="<?=$post['id']?>">
            <label style="font-weight: bold;">Измените название:</label>
            <input style=" margin: 5px auto;padding: 10px;border: 2px solid #e3e3e3;outline: none;
                border-radius: 15px; width: 350px" type="text" name="title" value="<?= $post['title']?>">
            <label style="font-weight: bold;">Добавьте картинку:</label>
            <input type="file" name="image">
            <label style="font-weight: bold;">Измените описание:</label>
            <textarea style=" margin: 5px auto;padding: 10px;border: 2px solid #e3e3e3;outline: none;
                border-radius: 15px; width: 350px; resize: none;" type="text" name="description"><?=$post['description']?></textarea>
            <label style="font-weight: bold;">Измените контактные данные:</label>
            <input style="margin: 5px auto;padding: 10px;border: 2px solid #e3e3e3;outline: none;
                border-radius: 15px; width: 350px" type="text" name="contact" value="<?=$post['contact']?>">
            <label style="font-weight: bold;">Измените цену:</label>
            <input style=" margin: 5px auto;padding: 10px;border: 2px solid #e3e3e3;outline: none;
                border-radius: 15px; width: 350px" type="text" name="price" value="<?= $post['price'] ?>">
            <button style="padding: 10px; background: #80cf6f; margin: 10px auto;
                width: 300px; border: unset;border-radius: 15px;box-shadow: 0px 2px 10px 2px rgba(0,0,0,0.3);
                font-size: 17px;" onmouseover="this.style.backgroundColor='#65ab50';"
                    onmouseout="this.style.backgroundColor='#80cf6f';" type="submit">Сохранить изменения</button>
            <p class="form_p border">
                <a href="main-page-tutor.php" style="color: black;font-weight: bold;text-decoration: none;"
                   onmouseover="this.style.color= '#028d02';"
                   onmouseout="this.style.color='black';">Вернуться на главную</a>
            </p>
        </form>
    </div>
</main>
</body>
</html>

