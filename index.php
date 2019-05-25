<?php

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
    
    if(sizeof(file (__DIR__ . '/Logs/log.txt')) > 499) { //количество строк в файле превышает 499 (равняется 500)
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

    switch($_GET['page']) { //контроллер выбора страниц
        case 'singlePic': include('pages/singlePic.php'); break;
        case 'addPic': include('pages/addPic.php'); break;
        case 'usersAddShowDelete': include('pages/usersAddShowDelete.php'); break;
        case 'gallery': include('pages/gallery.php'); $title = 'huy'; break;
        default: include('pages/mainPage.php'); break;
    };

    // РАБОТА НАД HTML
    
    $title = 'Шестой урок';

    $headerMenu = <<<php
    <ul>
        <li><a href="/">Главная страница</a></li>
        <li><a href="?page=gallery">Галерея</a></li>
        <li><a href="?page=usersAddShowDelete">Пользователи</a></li>
        <li><a href="?page=addPic">Добавить картинку</a></li>
    </ul>
php;

    $date = date(Y);
    $footer = <<<php
    <footer>
        Год: {$date}
    </footer>
php;

    $pageFile = file_get_contents('pages/mainPage.php');
    $pageWithTitle = str_replace('{TITLE}', $title, $pageFile);
    $pageWithHeaderMenu = str_replace('{HEADER_MENU}', $headerMenu, $pageWithTitle);
    $pageWithFooter = str_replace ('{FOOTER}', $footer, $pageWithHeaderMenu);
    $pageWithContent = str_replace('{CONTENT}', $content, $pageWithFooter);
    echo $pageWithContent;

    // /РАБОТА НАД HTML
?>