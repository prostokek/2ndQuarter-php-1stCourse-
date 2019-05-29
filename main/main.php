<?php
include('config.php');

$title = 'Седьмой урок';

    if (isset($_GET['page']) && $_GET['page'] != 'logOut') {
        include("/pages/{$_GET['page']}.php");
    } else if ($_GET['page'] == 'logOut') {
        $_SESSION['isLogged'] = 'NO';
        $_SESSION['isAdmin'] = 'NO';
        session_destroy();
        header('Location:' . $_SERVER['HTTP_REFERER']);
    };
    
    var_dump($_SESSION);

    // РАБОТА НАД HTML

    $headerMenu = <<<php
    <ul>
        <li><a href="/">Главная страница</a></li>
        <li><a href="?page=gallery">Галерея</a></li>
        <li><a href="?page=usersAddShowDelete">Пользователи</a></li>
        <li><a href="?page=calc1">Калькулятор 1</a></li>
        <li><a href="?page=calc2">Калькулятор 2</a></li>
        <li><a href="?page=catalogue">Каталог</a></li>
        <li><a href="?page=feedback">Отзывы</a></li>
        <li><a href="?page=addProduct">Добавить продукт</a></li>
        <li><a href="?page=authPage">Авторизация</a></li>
    </ul>
php;

    $date = date(Y);
    $footer = <<<php
    <footer>
        Год: {$date}
    </footer>
php;


$pageFile = file_get_contents('../main/pages/pageTemplate.php');
$pageFile = str_replace(['{TITLE}', '{HEADER_MENU}', '{CONTENT}', '{FOOTER}'], [$title, $headerMenu, $content, $footer], $pageFile);
echo $pageFile;
?>