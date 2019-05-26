<?php

include('config.php');

$title = 'Шестой урок';

    switch($_GET['page']) { //контроллер выбора страниц
        case 'singlePic': include('pages/singlePic.php'); break;
        case 'addPic': include('pages/addPic.php'); break;
        case 'usersAddShowDelete': include('pages/usersAddShowDelete.php'); break;
        case 'gallery': include('pages/gallery.php'); break;
        case 'calc1': include('pages/calc1.php'); break;
        case 'calc2': include('pages/calc2.php'); break;
        case 'catalogue': include('pages/catalogue.php'); break;
        case 'product': include('pages/product.php'); break;
        case 'feedback': include('/pages/feedback.php'); break;
        case 'addProduct': include('/pages/addProduct.php'); break;
        // default: echo $pageFile; break;
    };

    // РАБОТА НАД HTML

    $headerMenu = <<<php
    <ul>
        <li><a href="/">Главная страница</a></li>
        <li><a href="?page=gallery">Галерея</a></li>
        <li><a href="?page=usersAddShowDelete">Пользователи</a></li>
        <li><a href="?page=addPic">Добавить картинку</a></li>
        <li><a href="?page=calc1">Калькулятор 1</a></li>
        <li><a href="?page=calc2">Калькулятор 2</a></li>
        <li><a href="?page=catalogue">Каталог</a></li>
        <li><a href="?page=feedback">Отзывы</a></li>
        <li><a href="?page=addProduct">Добавить продукт</a></li>
    </ul>
php;

    $date = date(Y);
    $footer = <<<php
    <footer>
        Год: {$date}
    </footer>
php;


$pageFile = file_get_contents('pages/pageTemplate.php');
$pageFile = str_replace(['{TITLE}', '{HEADER_MENU}', '{CONTENT}', '{FOOTER}'], [$title, $headerMenu, $content, $footer], $pageFile);
echo $pageFile;


    // $pageFile = file_get_contents('pages/pageTemplate.php');
    // $pageWithTitle = str_replace('{TITLE}', $title, $pageFile);
    // $pageWithHeaderMenu = str_replace('{HEADER_MENU}', $headerMenu, $pageWithTitle);
    // $pageWithFooter = str_replace ('{FOOTER}', $footer, $pageWithHeaderMenu);
    // $pageWithContent = str_replace('{CONTENT}', $content, $pageWithFooter);
    // echo $pageWithContent;

    // /РАБОТА НАД HTML
?>