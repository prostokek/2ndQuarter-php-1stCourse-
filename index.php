<?php 
    $title = 'Четвёртый урок';
    $h1 = 'Четвёртый урок';

    /* ПЕРВОЕ ЗАДАНИЕ */

    $gallery1 = [
        "/Gallery/image0019.jpg",
        "/Gallery/ru-city-780.jpg",
        "/Gallery/Tokyo_Tower_and_Tokyo_Sky_Tree_2011_January.jpg"
    ];

    function BuildGallery1($gallery1) {
        $gallery1HTML = '<div class = "gallery">';
        foreach($gallery1 as $picPath) {
            $gallery1HTML .= "<a href='$picPath' target='_blank'><img src='$picPath' alt=''></a>";
        };
        $gallery1HTML .= '</div>';
        return $gallery1HTML;
    }

    /* /ПЕРВОЕ ЗАДАНИЕ */

    /* ВТОРОЕ ЗАДАНИЕ */

    function BuildGallery2() {
        $gallery2 = scandir(__DIR__ . '/Gallery');
        unset($gallery2[0], $gallery2[1]);
    
        $gallery2HTML = '<div class = "gallery">';
        foreach($gallery2 as $picPath) {
            $gallery2HTML .= "<a href='/Gallery/$picPath' target='_blank'><img src='/Gallery/$picPath' alt=''></a>";
        }
        $gallery2HTML .= '</div>';
        return $gallery2HTML;
    }
    
    /* /ВТОРОЕ ЗАДАНИЕ */

    /* ЧЕТВЁРТОЕ ЗАДАНИЕ*/

    $date = date(r);
    file_put_contents('4thTask_log.txt', "$date" . PHP_EOL, FILE_APPEND);

    /* /ЧЕТВЁРТОЕ ЗАДАНИЕ */

    /* ПЯТОЕ ЗАДАНИЕ */
    $log_count = (count(scandir(__DIR__ . '/Logs')) - 2);

    file_put_contents(__DIR__ . '/Logs/log.txt', "$date" . PHP_EOL, FILE_APPEND);
    
    if(sizeof(file (__DIR__ . '/Logs/log.txt')) > 9) { //количество строк в файле превышает 9 (равняется 10)
        copy(__DIR__ . '/Logs/log.txt', __DIR__ . "/Logs/log$log_count.txt"); //создаём копию под определённым номером
        file_put_contents(__DIR__ . '/Logs/log.txt', ''); //опустошаем
    };

    /* /ПЯТОЕ ЗАДАНИЕ */
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
        <p><?php echo(BuildGallery1($gallery1)); ?></p>
    </article>
    
    <article>
        <h3>Второе задание</h3>
        <p><?php echo(BuildGallery2()); ?></p>
    </article>
    
    <footer>
        <?php echo('Год: ' . date(Y)) ?>
    </footer>
</body>
</html>