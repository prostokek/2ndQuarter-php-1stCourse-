<?php

include('config.php');

    switch($_GET['page']) { //контроллер выбора страниц
        case 'singlePic': include('pages/singlePic.php'); break;
        case 'addPic': include('pages/addPic.php'); break;
        case 'usersAddShowDelete': include('pages/usersAddShowDelete.php'); break;
        case 'gallery': include('pages/gallery.php'); break;
        default: include('pages/pageTemplate.php'); break;
    };

    // РАБОТА НАД HTML
    
    

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

    $pageFile = file_get_contents('pages/pageTemplate.php');
    echo $title;
    $pageWithTitle = str_replace('{TITLE}', $title, $pageFile);
    $pageWithHeaderMenu = str_replace('{HEADER_MENU}', $headerMenu, $pageWithTitle);
    $pageWithFooter = str_replace ('{FOOTER}', $footer, $pageWithHeaderMenu);
    $pageWithContent = str_replace('{CONTENT}', $content, $pageWithFooter);
    echo $pageWithContent;

    // /РАБОТА НАД HTML
?>