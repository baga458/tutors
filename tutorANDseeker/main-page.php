<?php

session_start();

$connect = mysqli_connect('localhost', 'root', '', 'tutor');

if(!$connect){
    die('Ошибка подключения к БД');
}

$posts = mysqli_query($connect, "SELECT * FROM `posts`");

$posts = mysqli_fetch_all($posts);

?>

<!doctype html>
<html lang="en">
<head>
    <title>T&S</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header class="header_container tutor">
    <a class="profile_link" href="profile.php"><?= $_SESSION['user']['fullname']?></a>
    <h2 class="header_title">
        <a class="header_link" href="main-page.php">Tutor & Seeker</a>
    </h2>
    <a class="support_link" href="support.php?id=<?=$_SESSION['user']['id']?>">Служба поддержки</a>
</header>
<main>
    <form action="main-page.php" class="form_container" method="post" style="width: 750px; margin: 30px auto 0 auto">
        <h2 class="" style=" padding: 10px; ">Поиск репетитора</h2>
        <input class="search_input" type="text" name="searchbar" placeholder="Найти...">
        <div class="filter_container">
               <select class="filters" name="country">
                   <option value="">Страна...</option>
                   <option value="Россия">Россия</option>
               </select>
               <select class="filters" name="city">
                   <option value="">Город...</option>
                   <option value="Москва">Москва</option>
                   <option value="Санкт-Петербург">Санкт-Петербург</option>
                   <option value="Рязань">Рязань</option>
                   <option value="Ижевск">Ижевск</option>
                   <option value="Тверь">Тверь</option>
                   <option value="Нижний Новгород">Нижний Новгород</option>
                   <option value="Нижний Новгород">Подольск</option>
               </select>
               <select class="filters" name="education">
                   <option value="">Образование...</option>
                   <option value="Высшее">Высшее</option>
                   <option value="Среднее общее">Среднее общее</option>
                   <option value="Среднее специальное">Среднее специальное</option>
               </select>
               <select class="filters" name="teaching" >
                   <option value="">Обучение...</option>
                   <option value="Дошкольное">Дошкольное</option>
                   <option value="Начальное">Начальное</option>
                   <option value="Общее">Общее</option>
                   <option value="Среднее">Среднее</option>
                   <option value="Высшее">Высшее</option>
               </select>
               <select class="filters" name="edu_meth">
                   <option value="">Метод обучения...</option>
                   <option value="Очное">Очное</option>
                   <option value="Заочное(онлайн)">Заочное(онлайн)</option>
               </select>
               <button class="search_btn" name="submit" type="submit">Найти</button>
           </div>
    </form>
<!--    --><?php
//    if (isset($_SESSION['message'])) {
//        echo'<p class="err_message">' . $_SESSION['message'] . '</p>';
//    }
//    unset($_SESSION['message']);
//    ?>
    <h1 class="form_title all_post">Вакансии:</h1>
    <div class="tutor_card_container">
        <?php
        if(!isset($_POST['submit'])){
            foreach ($posts as $post){
                ?>
                <div class="form_container card">
                    <p class="form_p"><?=$post[1]?></p>
                    <img class="img" src="<?=$post[3]?>" alt="tutor-1">
                    <p class="form_p"><?=$post[12]?></p>
                    <p><span style="font-weight: bold">Образование: </span><?=$post[4]?></p>
                    <p><span style="font-weight: bold">Страна: </span><?=$post[5]?></p>
                    <p><span style="font-weight: bold">Город: </span><?=$post[6]?></p>
                    <p class="form_p" style="margin-bottom: 0">
                        <a class="form_link" href="post-card.php?id=<?=$post[0]?>">Посмотреть вакансию</a>
                    </p>
                    <?php
                    if($_SESSION['user']['id']===$post[11]){

                    }else{
                        ?>
                        <p class="form_p">
                            <a href="review-card.php?id=<?=$post[0]?>" class="form_link">Оставить отзыв</a>
                        </p>
                        <?php
                    }
                    ?>
                    <p class="form_p">
                        <a href="reviews.php?id=<?=$post[0]?>" class="form_link">Отзывы</a>
                    </p>
                </div>
                <?php
            }
        }elseif(isset($_POST['submit'])){

            $title = $_POST['searchbar'];
            $education = $_POST['education'];
            $country = $_POST['country'];
            $city = $_POST['city'];
            $edu_meth = $_POST['edu_meth'];
            $teaching  = $_POST['teaching'];

            $posts0 = mysqli_query($connect,  "SELECT * FROM `posts` WHERE `title` = '$title'");

            $posts01 = mysqli_query($connect, "SELECT * FROM `posts` WHERE `education` = '$education'");

            $posts02 = mysqli_query($connect, "SELECT * FROM `posts` WHERE `city` = '$city'");

            $posts03 = mysqli_query($connect, "SELECT * FROM `posts` WHERE `country` = '$country'");

            $posts04 = mysqli_query($connect, "SELECT * FROM `posts` WHERE `edu_meth`='$edu_meth'");

            $posts05 = mysqli_query($connect, "SELECT * FROM `posts` WHERE `teaching` = '$teaching'");

            $posts4 = mysqli_query($connect,  "SELECT * FROM `posts` WHERE `title` = '$title' AND `education` = '$education'");

            $posts2 = mysqli_query($connect,  "SELECT * FROM `posts` WHERE `title` = '$title' AND `education` = '$education' AND `city` = '$city'");

            $posts3 = mysqli_query($connect,  "SELECT * FROM `posts` WHERE `title` = '$title' AND `education` = '$education' AND `city` = '$city' AND `edu_meth` = '$edu_meth'");

            $posts5 = mysqli_query($connect,  "SELECT * FROM `posts` WHERE `title` = '$title' AND `education` = '$education' AND `city` = '$city' AND `edu_meth` = '$edu_meth' AND `teaching` = '$teaching'");

            $posts1 = mysqli_query($connect,  "SELECT * FROM `posts` WHERE `education` = '$education' AND `city` = '$city'");

// ПОИСК ПО ОБРАЗОВАНИЮ И ГОРОДУ ВМЕСТЕ
            if($title === '' & $edu_meth==='' & $education !== '' & $city !== '' & $teaching === '' & $country === '' & mysqli_num_rows($posts1)>0){

                $posts1 = mysqli_fetch_all($posts1);
                foreach ($posts1 as $post){
                    ?>
                    <div class="form_container card">
                        <p class="form_p"><?=$post[1]?></p>
                        <img class="img" src="<?=$post[3]?>" alt="tutor-1">
                        <p class="form_p"><?=$post[12]?></p>
                        <p><span style="font-weight: bold">Образование: </span><?=$post[4]?></p>
                        <p><span style="font-weight: bold">Страна: </span><?=$post[5]?></p>
                        <p><span style="font-weight: bold">Город: </span><?=$post[6]?></p>
                        <p class="form_p" style="margin-bottom: 0">
                            <a class="form_link" href="post-card.php?id=<?=$post[0]?>">Посмотреть вакансию</a>
                        </p>
                        <?php
                        if($_SESSION['user']['id']===$post[11]){

                        }else{
                            ?>
                            <p class="form_p">
                                <a href="review-card.php?id=<?=$post[0]?>" class="form_link">Оставить отзыв</a>
                            </p>
                            <?php
                        }
                        ?>
                        <p class="form_p">
                            <a href="reviews.php?id=<?=$post[0]?>" class="form_link">Отзывы</a>
                        </p>
                    </div>
                    <?php
                }
            }
// ПОИСК ПО НАЗВАНИЮ И ОБРАЗОВАНИЮ ВМЕСТЕ
            if($title !== '' & $edu_meth === '' & $education !== '' & $city === '' & $teaching === '' & $country === '' & mysqli_num_rows($posts4)>0){

                $posts4 = mysqli_fetch_all($posts4);
                foreach ($posts4 as $post){
                    ?>
                    <div class="form_container card">
                        <p class="form_p"><?=$post[1]?></p>
                        <img class="img" src="<?=$post[3]?>" alt="tutor-1">
                        <p class="form_p"><?=$post[12]?></p>
                        <p><span style="font-weight: bold">Образование: </span><?=$post[4]?></p>
                        <p><span style="font-weight: bold">Страна: </span><?=$post[5]?></p>
                        <p><span style="font-weight: bold">Город: </span><?=$post[6]?></p>
                        <p class="form_p" style="margin-bottom: 0">
                            <a class="form_link" href="post-card.php?id=<?=$post[0]?>">Посмотреть вакансию</a>
                        </p>
                        <?php
                        if($_SESSION['user']['id']===$post[11]){

                        }else{
                            ?>
                            <p class="form_p">
                                <a href="review-card.php?id=<?=$post[0]?>" class="form_link">Оставить отзыв</a>
                            </p>
                            <?php
                        }
                        ?>
                        <p class="form_p">
                            <a href="reviews.php?id=<?=$post[0]?>" class="form_link">Отзывы</a>
                        </p>
                    </div>
                    <?php
                }
            }
// ПОИСК ПО НАЗВАНИЮ, ОБРАЗОВАНИЮ И ГОРОДУ ВМЕСТЕ
            if($title !== '' & $edu_meth === '' & $education !== '' & $city !== '' & $teaching === '' & $country === '' & mysqli_num_rows($posts2)>0){

                $posts2 = mysqli_fetch_all($posts2);
                foreach ($posts2 as $post){
                    ?>
                    <div class="form_container card">
                        <p class="form_p"><?=$post[1]?></p>
                        <img class="img" src="<?=$post[3]?>" alt="tutor-1">
                        <p class="form_p"><?=$post[12]?></p>
                        <p><span style="font-weight: bold">Образование: </span><?=$post[4]?></p>
                        <p><span style="font-weight: bold">Страна: </span><?=$post[5]?></p>
                        <p><span style="font-weight: bold">Город: </span><?=$post[6]?></p>
                        <p class="form_p" style="margin-bottom: 0">
                            <a class="form_link" href="post-card.php?id=<?=$post[0]?>">Посмотреть вакансию</a>
                        </p>
                        <?php
                        if($_SESSION['user']['id']===$post[11]){

                        }else{
                            ?>
                            <p class="form_p">
                                <a href="review-card.php?id=<?=$post[0]?>" class="form_link">Оставить отзыв</a>
                            </p>
                            <?php
                        }
                        ?>
                        <p class="form_p">
                            <a href="reviews.php?id=<?=$post[0]?>" class="form_link">Отзывы</a>
                        </p>
                    </div>
                    <?php
                }
            }
// ПОИСК ПО НАЗВАНИЮ
            if($title !== '' & $edu_meth==='' & $education === '' & $city === '' & $teaching === '' & $country === '' & mysqli_num_rows($posts0)>0){

                $posts0 = mysqli_fetch_all($posts0);
                foreach ($posts0 as $post){
                    ?>
                    <div class="form_container card">
                        <p class="form_p"><?=$post[1]?></p>
                        <img class="img" src="<?=$post[3]?>" alt="tutor-1">
                        <p class="form_p"><?=$post[12]?></p>
                        <p><span style="font-weight: bold">Образование: </span><?=$post[4]?></p>
                        <p><span style="font-weight: bold">Страна: </span><?=$post[5]?></p>
                        <p><span style="font-weight: bold">Город: </span><?=$post[6]?></p>
                        <p class="form_p" style="margin-bottom: 0">
                            <a class="form_link" href="post-card.php?id=<?=$post[0]?>">Посмотреть вакансию</a>
                        </p>
                        <?php
                        if($_SESSION['user']['id']===$post[11]){

                        }else{
                            ?>
                            <p class="form_p">
                                <a href="review-card.php?id=<?=$post[0]?>" class="form_link">Оставить отзыв</a>
                            </p>
                            <?php
                        }
                        ?>
                        <p class="form_p">
                            <a href="reviews.php?id=<?=$post[0]?>" class="form_link">Отзывы</a>
                        </p>
                    </div>
                    <?php
                }
            }
// ПОИСК ПО ОБРАЗОВАНИЮ
            if($title === '' & $edu_meth === '' & $education !== '' & $city === '' & $teaching === '' & $country === '' & mysqli_num_rows($posts01)>0){

                $posts01 = mysqli_fetch_all($posts01);
                foreach ($posts01 as $post){
                    ?>
                    <div class="form_container card">
                        <p class="form_p"><?=$post[1]?></p>
                        <img class="img" src="<?=$post[3]?>" alt="tutor-1">
                        <p class="form_p"><?=$post[12]?></p>
                        <p><span style="font-weight: bold">Образование: </span><?=$post[4]?></p>
                        <p><span style="font-weight: bold">Страна: </span><?=$post[5]?></p>
                        <p><span style="font-weight: bold">Город: </span><?=$post[6]?></p>
                        <p class="form_p" style="margin-bottom: 0">
                            <a class="form_link" href="post-card.php?id=<?=$post[0]?>">Посмотреть вакансию</a>
                        </p>
                        <?php
                        if($_SESSION['user']['id']===$post[11]){

                        }else{
                            ?>
                            <p class="form_p">
                                <a href="review-card.php?id=<?=$post[0]?>" class="form_link">Оставить отзыв</a>
                            </p>
                            <?php
                        }
                        ?>
                        <p class="form_p">
                            <a href="reviews.php?id=<?=$post[0]?>" class="form_link">Отзывы</a>
                        </p>
                    </div>
                    <?php
                }
            }
// ПОИСК ГОРОДУ
            if($title === '' & $edu_meth === '' & $education === '' & $city !== '' & $teaching === '' & $country === '' & mysqli_num_rows($posts02)>0){

                $posts02 = mysqli_fetch_all($posts02);
                foreach ($posts02 as $post){
                    ?>
                    <div class="form_container card">
                        <p class="form_p"><?=$post[1]?></p>
                        <img class="img" src="<?=$post[3]?>" alt="tutor-1">
                        <p class="form_p"><?=$post[12]?></p>
                        <p><span style="font-weight: bold">Образование: </span><?=$post[4]?></p>
                        <p><span style="font-weight: bold">Страна: </span><?=$post[5]?></p>
                        <p><span style="font-weight: bold">Город: </span><?=$post[6]?></p>
                        <p class="form_p" style="margin-bottom: 0">
                            <a class="form_link" href="post-card.php?id=<?=$post[0]?>">Посмотреть вакансию</a>
                        </p>
                        <?php
                        if($_SESSION['user']['id']===$post[11]){

                        }else{
                            ?>
                            <p class="form_p">
                                <a href="review-card.php?id=<?=$post[0]?>" class="form_link">Оставить отзыв</a>
                            </p>
                            <?php
                        }
                        ?>
                        <p class="form_p">
                            <a href="reviews.php?id=<?=$post[0]?>" class="form_link">Отзывы</a>
                        </p>
                    </div>
                    <?php
                }
            }
// ПОИСК ПО СТРАНЕ
            if($title === '' & $edu_meth === '' & $education === '' & $city === '' & $teaching === '' & $country !== '' & mysqli_num_rows($posts03)>0){

                $posts03 = mysqli_fetch_all($posts03);
                foreach ($posts03 as $post){
                    ?>
                    <div class="form_container card">
                        <p class="form_p"><?=$post[1]?></p>
                        <img class="img" src="<?=$post[3]?>" alt="tutor-1">
                        <p class="form_p"><?=$post[12]?></p>
                        <p><span style="font-weight: bold">Образование: </span><?=$post[4]?></p>
                        <p><span style="font-weight: bold">Страна: </span><?=$post[5]?></p>
                        <p><span style="font-weight: bold">Город: </span><?=$post[6]?></p>
                        <p class="form_p" style="margin-bottom: 0">
                            <a class="form_link" href="post-card.php?id=<?=$post[0]?>">Посмотреть вакансию</a>
                        </p>
                        <?php
                        if($_SESSION['user']['id']===$post[11]){

                        }else{
                            ?>
                            <p class="form_p">
                                <a href="review-card.php?id=<?=$post[0]?>" class="form_link">Оставить отзыв</a>
                            </p>
                            <?php
                        }
                        ?>
                        <p class="form_p">
                            <a href="reviews.php?id=<?=$post[0]?>" class="form_link">Отзывы</a>
                        </p>
                    </div>
                    <?php
                }
            }
// ПОИСК ПО МЕТОДУ ОБУЧЕНИЯ (ОЧНО/ЗАОЧНО)
            if($title === '' & $edu_meth !== '' & $education === '' & $city === '' & $teaching === '' & $country === '' & mysqli_num_rows($posts04)>0){

                $posts04 = mysqli_fetch_all($posts04);
                foreach ($posts04 as $post){
                    ?>
                    <div class="form_container card">
                        <p class="form_p"><?=$post[1]?></p>
                        <img class="img" src="<?=$post[3]?>" alt="tutor-1">
                        <p class="form_p"><?=$post[12]?></p>
                        <p><span style="font-weight: bold">Образование: </span><?=$post[4]?></p>
                        <p><span style="font-weight: bold">Страна: </span><?=$post[5]?></p>
                        <p><span style="font-weight: bold">Город: </span><?=$post[6]?></p>
                        <p class="form_p" style="margin-bottom: 0">
                            <a class="form_link" href="post-card.php?id=<?=$post[0]?>">Посмотреть вакансию</a>
                        </p>
                        <?php
                        if($_SESSION['user']['id']===$post[11]){

                        }else{
                            ?>
                            <p class="form_p">
                                <a href="review-card.php?id=<?=$post[0]?>" class="form_link">Оставить отзыв</a>
                            </p>
                            <?php
                        }
                        ?>
                        <p class="form_p">
                            <a href="reviews.php?id=<?=$post[0]?>" class="form_link">Отзывы</a>
                        </p>
                    </div>
                    <?php
                }
            }
// ПОИСК ПО ПРОГРАММЕ ОБУЧЕНИЯ
            if($title === '' & $edu_meth === '' & $education === '' & $city === '' & $teaching !== '' & $country === '' & mysqli_num_rows($posts05)>0){

                $posts05 = mysqli_fetch_all($posts05);
                foreach ($posts05 as $post){
                    ?>
                    <div class="form_container card">
                        <p class="form_p"><?=$post[1]?></p>
                        <img class="img" src="<?=$post[3]?>" alt="tutor-1">
                        <p class="form_p"><?=$post[12]?></p>
                        <p><span style="font-weight: bold">Образование: </span><?=$post[4]?></p>
                        <p><span style="font-weight: bold">Страна: </span><?=$post[5]?></p>
                        <p><span style="font-weight: bold">Город: </span><?=$post[6]?></p>
                        <p class="form_p" style="margin-bottom: 0">
                            <a class="form_link" href="post-card.php?id=<?=$post[0]?>">Посмотреть вакансию</a>
                        </p>
                        <?php
                        if($_SESSION['user']['id']===$post[11]){

                        }else{
                            ?>
                            <p class="form_p">
                                <a href="review-card.php?id=<?=$post[0]?>" class="form_link">Оставить отзыв</a>
                            </p>
                            <?php
                        }
                        ?>
                        <p class="form_p">
                            <a href="reviews.php?id=<?=$post[0]?>" class="form_link">Отзывы</a>
                        </p>
                    </div>
                    <?php
                }
            }
//ПОИСК ПО НАЗВАНИЮ, ОБРАЗОВАНИЮ, МЕТОДУ ОБУЧЕНИЯ И ГОРОДУ ВМЕСТЕ
            if($title !== '' & $edu_meth !== '' & $education !== '' & $city !== '' & $teaching === '' & $country === '' & mysqli_num_rows($posts3)>0){

                $posts3 = mysqli_fetch_all($posts3);
                foreach ($posts3 as $post){
                    ?>
                    <div class="form_container card">
                        <p class="form_p"><?=$post[1]?></p>
                        <img class="img" src="<?=$post[3]?>" alt="tutor-1">
                        <p class="form_p"><?=$post[12]?></p>
                        <p><span style="font-weight: bold">Образование: </span><?=$post[4]?></p>
                        <p><span style="font-weight: bold">Страна: </span><?=$post[5]?></p>
                        <p><span style="font-weight: bold">Город: </span><?=$post[6]?></p>
                        <p class="form_p" style="margin-bottom: 0">
                            <a class="form_link" href="post-card.php?id=<?=$post[0]?>">Посмотреть вакансию</a>
                        </p>
                        <?php
                        if($_SESSION['user']['id']===$post[11]){

                        }else{
                            ?>
                            <p class="form_p">
                                <a href="review-card.php?id=<?=$post[0]?>" class="form_link">Оставить отзыв</a>
                            </p>
                            <?php
                        }
                        ?>
                        <p class="form_p">
                            <a href="reviews.php?id=<?=$post[0]?>" class="form_link">Отзывы</a>
                        </p>
                    </div>
                    <?php
                }
            }
//ПОИСК ПО НАЗВАНИЮ, ОБРАЗОВАНИЮ, МЕТОДУ ОБУЧЕНИЯ, ПРОГРАММЕ ОБУЧЕНИЯ И ГОРОДУ ВМЕСТЕ
            if($title !== '' & $edu_meth !== '' & $education !== '' & $city !== '' & $teaching !== '' & $country === '' & mysqli_num_rows($posts5)>0){

                $posts5 = mysqli_fetch_all($posts5);
                foreach ($posts5 as $post){
                    ?>
                    <div class="form_container card">
                        <p class="form_p"><?=$post[1]?></p>
                        <img class="img" src="<?=$post[3]?>" alt="tutor-1">
                        <p class="form_p"><?=$post[12]?></p>
                        <p><span style="font-weight: bold">Образование: </span><?=$post[4]?></p>
                        <p><span style="font-weight: bold">Страна: </span><?=$post[5]?></p>
                        <p><span style="font-weight: bold">Город: </span><?=$post[6]?></p>
                        <p class="form_p" style="margin-bottom: 0">
                            <a class="form_link" href="post-card.php?id=<?=$post[0]?>">Посмотреть вакансию</a>
                        </p>
                        <?php
                        if($_SESSION['user']['id']===$post[11]){

                        }else{
                            ?>
                            <p class="form_p">
                                <a href="review-card.php?id=<?=$post[0]?>" class="form_link">Оставить отзыв</a>
                            </p>
                            <?php
                        }
                        ?>
                        <p class="form_p">
                            <a href="reviews.php?id=<?=$post[0]?>" class="form_link">Отзывы</a>
                        </p>
                    </div>
                    <?php
                }
            }
        }
        ?>
    </div>
</main>
</body>
</html>