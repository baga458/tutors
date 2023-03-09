<?php
session_start();

$connect = mysqli_connect('localhost', 'root', '', 'tutor');
if(!$connect){
    die('Ошибка подключения к БД');
}

$id = $_POST['id'];
$title = $_POST['title'];
$age = $_POST['age'];
$education = $_POST['education'];
$country = $_POST['country'];
$city = $_POST['city'];
$teaching  = $_POST['teaching'];
$edu_meth = $_POST['edu_meth'];
$description = $_POST['description'];
$contact = $_POST['contact'];
$price = $_POST['price'];

if($title !== '' & $description !== '' & $contact !== '' & $price !== '' & $age !== '' & $country !== '' & $city !=='' & $teaching !== '' & $edu_meth !== '' & $education !== ''){

    $path = 'uploads/' . time() . $_FILES['avatar']['name'];
    move_uploaded_file($_FILES['avatar']['tmp_name'], '../' . $path);

    mysqli_query($connect, "INSERT INTO `posts` (`id`, `title`,`age`,`image`,`education`,`country`,`city`,`teaching`,`edu_meth`,`description`,`contact`,`price`,`user_id`)
    VALUES(NULL, '$title','$age', '$path','$education','$country','$city','$teaching','$edu_meth','$description','$contact', '$price', '$id')");
    header('Location: ../main-page-tutor.php');
}
else{
    $_SESSION['message'] = 'Заполните все поля';
    header('Location: ../post-add.php');
}


?>

<!--<pre>-->
<!--    --><?php
    //    var_dump($teaching, $edu_meth, $id,
//$title,
//$age,
//$education,
//$country,
//$city,
//$teaching,
//$edu_meth,
//$description,
//$contact,
//$price);
//    ?>
<!--</pre>-->
