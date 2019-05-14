<?php 
    $title = 'Четвёртый урок';
    $h1 = 'Четвёртый урок';

    /* ПЕРВОЕ ЗАДАНИЕ */

    $gallery = [
        "/Gallery/image0019.jpg",
        "/Gallery/ru-city-780.jpg",
        "/Gallery/Tokyo_Tower_and_Tokyo_Sky_Tree_2011_January.jpg"
    ];

    $res_1 = '<div class = "gallery">';
    foreach($gallery as $pic) {
        $res_1 .= "<a href='$pic' target='_blank'><img src='$pic' alt=''></a>";
    };
    $res_1 .= '</div>';

    /* /ПЕРВОЕ ЗАДАНИЕ */

    /* ВТОРОЕ ЗАДАНИЕ */

    $res_2 = "";

    /* /ВТОРОЕ ЗАДАНИЕ */
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo($title);?></title>
</head>
<style>
.gallery img {
    width: 30%;
    margin: 1.5%;
}
</style>
<body>

<h1> <?php echo($h1);?> </h1>

    <article>
        <h3>Первое задание</h3>
        <p><?php echo($res_1); ?></p>
    </article>
    

    
    <footer>
        <?php echo('Год: ' . date(Y)) ?>
    </footer>
</body>
</html>