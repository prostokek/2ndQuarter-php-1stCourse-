<?php 
    $title = 'Пятый урок';
    $h1 = 'Пятый урок';

    function varDump($var) { //человеческий вывод var_dump() (не в одну строку)
        static $int=0;
        echo '<pre><b style="background: red;padding: 1px 5px;">'.$int.'</b> ';
        print_r($var);
        echo '</pre>';
        $int++;
    }; 

    /* ПЕРВОЕ ЗАДАНИЕ */

    // КАК СДЕЛАТЬ ТАК, ЧТОБЫ ID УСТАНАВЛИВАЛСЯ АВТОМАТИЧЕСКИ (я это пропустил, видимо)

    $link = mysqli_connect( 
        '127.0.0.1:3306', //'2ndQuarter-php-1stCourse-',
        'root', //имя пользователя
        '', // пароль
        '2ndquarter-php-1stcourse-' //название базы данных
    ); 

    $sql = "SELECT id, fio, login, password, date FROM users";

    $res = mysqli_query($link, $sql); //(адрес, запрос) || получили результат запроса
    // $row = mysqli_fetch_assoc($res); //вытащили из него ряд в виде ассоциативного массива (по очереди вытаскиевает (с 0-ого))

    $html = '';
    while ($row = mysqli_fetch_assoc($res)) {
        $html .= <<<php
        <h1>{$row['fio']}</h1>;
        php;
    };
    

    /* /ПЕРВОЕ ЗАДАНИЕ */

    
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo($title);?></title>
</head>
<body>

<h1> <?php echo($h1);?> </h1>

    <article>
        <h3>Первое задание</h3>
        <p><?php ?></p>
    </article>
    
    <footer>
        <?php echo('Год: ' . date(Y)) ?>
    </footer>
</body>
</html>