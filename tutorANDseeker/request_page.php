<?php
session_start();

$connect = mysqli_connect('localhost', 'root','','tutor');
if(!$connect){
    die('Ошибка подключения к БД');
}

$user_id = $_GET['id'];

$request = mysqli_query($connect, "SELECT * FROM `orders` WHERE `author_id` = '$user_id'");

?>


<!doctype html>
<html lang="en">
<head>
    <title>T&S</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header class="header_container tutor" style="grid-template-columns: 1fr">
    <h2 class="header_title">
        <?php
            if($_SESSION['user']['role_id']==='1'){
        ?>
        <a class="header_link" href="main-page-tutor.php">Tutor & Seeker</a>
    </h2>
    <?php
    }else{
    ?>
        <a class="header_link" style="text-align: center" href="main-page.php">Tutor & Seeker</a>
    <?php
    }
    ?>
</header>
<div style="margin: 0 auto; width: 400px">
    <h1 style="text-align: center; margin: 15px 0" >Отслеживание заказов:</h1>
</div>
<div class="tutor_card_container" style="row-gap: 15px">
<?php
if($rw = mysqli_num_rows($request)>0){
    $orders = mysqli_fetch_all($request);
    foreach($orders as $order){
?>
                <form class="form_container" style="width: 350px;margin: auto; border: #028d02 3px solid">
                    <div class="form_div" style="padding: 10px 0;">
                        <label class="form_label">Имя заказчика: </label>
                        <p class="form_p"><?=$order[1]?></p>
                        <label class="form_label">Номер телефона заказчика: </label>
                        <p class="form_p"><?=$order[2]?></p>
                        <label class="form_label">Номер услуги: </label>
                        <p class="form_p"><?=$order[4]?></p>
                    </div>
                </form>
<?php
        }
    }else{
    ?>
    <div style="margin: 0 auto; width: 400px">
        <h1 style="text-align: center; margin: 15px 0" >Заявок пока нет :(((((</h1>
    </div>
    <?php
}
?>
</div>
<div>
    <p style="margin: 25px 0;" class="form_p">
        <a href="main-page-tutor.php" class="form_link">Вернуться на главную страницу</a>
    </p>
</div>
</body>
</html>

