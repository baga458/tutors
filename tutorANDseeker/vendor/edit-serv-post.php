<?php
session_start();

$connect = mysqli_connect('localhost', 'root', '', 'tutor');
if (!$connect) {
    die('Ошибка подключения к БД');
}
$id = $_POST['id'];
$title = $_POST['title'];
$description = $_POST['description'];
$contact = $_POST['contact'];
$price = $_POST['price'];


if($title !== '' & $description !== '' & $contact !== '' & $price !== '') {

    $path = 'uploads/' . time() . $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], '../' . $path);


    mysqli_query($connect,
        "UPDATE `posts` SET
                   `title` = '$title',
                   `image` = '$path',
                   `description` = '$description',
                   `contact`='$contact',
                   `price` = '$price'
                    WHERE `posts`.`id` = '$id'");
    header('Location: ../main-page-tutor.php');
}
?>
<!--<pre>-->
<!--    --><?php
//    var_dump($_FILES);
//    ?>
<!--</pre>-->

