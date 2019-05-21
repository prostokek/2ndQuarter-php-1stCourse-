<?php 
    $title = 'Шестой урок';
    $h1 = 'Шестой урок';
    $headerMenuInclusion = "<?php include('pages/headerMenu.php')?>";
    $headerMenu = <<<php
    <ul>
        <li><a href="">Главная страница</a></li>
        <li><a href="">Галерея</a></li>
        <li><a href="">Пользователи</a></li>
        <li><a href="">Добавить картинку</a></li>
    </ul>
php;

    function varDump($var) { //человеческий вывод var_dump() (не в одну строку)
        static $int=0;
        echo '<pre><b style="background: red;padding: 1px 5px;">'.$int.'</b> ';
        print_r($var);
        echo '</pre>';
        $int++;
    }; 

    /* СОЗДАНИЕ ЛОГОВ */
    $date = date(r);
    $log_count = (count(scandir(__DIR__ . '/Logs')) - 2);
    file_put_contents(__DIR__ . '/Logs/log.txt', "$date" . PHP_EOL, FILE_APPEND);
    
    if(sizeof(file (__DIR__ . '/Logs/log.txt')) > 499) { //количество строк в файле превышает 9 (равняется 10)
        copy(__DIR__ . '/Logs/log.txt', __DIR__ . "/Logs/log$log_count.txt"); //создаём копию под определённым номером
        file_put_contents(__DIR__ . '/Logs/log.txt', ''); //опустошаем
    };
    /* /СОЗДАНИЕ ЛОГОВ */

    $link = mysqli_connect(  //подключаемся к базе данных
        '127.0.0.1:3306', //'2ndQuarter-php-1stCourse-',
        'root', //имя пользователя
        '', // пароль
        '2ndquarter-php-1stcourse-' //название базы данных
    ); 

// switch($_GET['page']) {
//     case 'singlePic': include('pages/singlePic.php'); break;
//     case 'addPic': include('pages/addPic.php'); break;
//     case 'usersAddShowDelete': include('pages/usersAddShowDelete.php'); break;
//     case 'gallery': include('pages/gallery.php'); $title = 'huy'; break;
//     default: include('pages/mainPage.php'); break;
// };
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $title ?></title>
</head>
<body>
    <h1><?php echo $title ?></h1>
    <?php include('/pages//menus/headerMenu.php'); ?>

    <?php
        switch($_GET['page']) {
            case 'singlePic': include('pages/singlePic.php'); break;
            case 'addPic': include('pages/addPic.php'); break;
            case 'usersAddShowDelete': include('pages/usersAddShowDelete.php'); break;
            case 'gallery': include('pages/gallery.php'); $title = 'huy'; break;
            default: include('pages/mainPage.php'); break;
        };
    ?>

    <?php include('/pages/menus/footer.php'); ?>
</body>
</html>

