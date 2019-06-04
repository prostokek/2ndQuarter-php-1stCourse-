<?php
session_start();

include('config.php');
if (empty($_SESSION['authMsg'])) {
    $authMsg = 'Вы не авторизованы';
} else {
    $authMsg = $_SESSION['authMsg'];
};
$title = 'Седьмой урок';

// $page = ! empty($_GET['page']) ? $_GET['page'] : 'index';
// $func = ! empty($_GET['func']) ? $_GET['func'] : 'index';


function countCart() {
    $sql_countCart = "select count(*) from cart where user_id = {$_SESSION['currentUserId']}";
    $res_countCart = mysqli_query(connectToSQL(), $sql_countCart);
    $cartCount = mysqli_fetch_assoc($res_countCart);
    return $cartCount['count(*)'];
};
if (!empty($_SESSION)) {
    $cartCount = countCart();
};



if (isset($_GET['page']) && $_GET['page'] != 'logOut') {
    include("../main/pages/{$_GET['page']}.php");
} else if ($_GET['page'] == 'logOut') {
    $_SESSION['isLogged'] = 'NO';
    $_SESSION['isAdmin'] = 'NO';
    session_destroy();
    header('Location:' . $_SERVER['HTTP_REFERER']);
} else {
    header('Location:/?page=welcomePage');
};



$func = !empty($_GET['func']) ? $_GET['func'] : 'html';

if (! function_exists($func)) { // вместо моего query
    $func = 'html';
}

$html = (array) $func();
// varDump($html);




// РАБОТА НАД HTML

if($_SESSION['isAdmin'] == 'YES') {
    $headerMenu = <<<php
    <ul>
        <li><a href="/">Главная страница</a></li>
        <li><a href="?page=usersAddShowDelete">Пользователи</a></li>
        <li><a href="?page=catalogue">Каталог</a></li>
        <li><a href="?page=feedback">Отзывы</a></li>
        <li><a href="?page=addProductToCatalogue">Добавить продукт</a></li>
        <li><a href="?page=authPage">Авторизация</a></li>
        <li><a href="?page=cart">Корзина<i id='cartCount'>({$cartCount})</i></a></li> 
        <li><a href="?page=personalArea">Личный кабинет</a></li> 
        <li><a href="?page=registrationPage">Зарегистрироваться</a></li>
        <li><a href="?page=orders">Заказы</a></li>
    </ul>
php;
} else {
    $headerMenu = <<<php
    <ul>
        <li><a href="/">Главная страница</a></li>
        <li><a href="?page=catalogue">Каталог</a></li>
        <li><a href="?page=feedback">Отзывы</a></li>
        <li><a href="?page=authPage">Авторизация</a></li>
        <li><a href="?page=cart">Корзина<i id='cartCount'>({$cartCount})</i></a></li> 
        <li><a href="?page=personalArea">Личный кабинет</a></li> 
        <li><a href="?page=registrationPage">Зарегистрироваться</a></li>
    </ul>
php;
}





$date = date('Y');
$footer = <<<php
    <footer>
        Год: {$date}
    </footer>
php;

// $cartCount = countCart();

$pageFile = file_get_contents('../main/pages/pageTemplate.php');
// $headerMenu = str_replace('{CART_COUNT}', "({$cartCount['count(*)']})", $headerMenu);
$pageFile = str_replace(['{AUTH_MSG}', '{DEBUGMSG}', '{TITLE}', '{HEADER_MENU}', '{CONTENT}', '{FOOTER}'], 
                        [$authMsg, $_SESSION['msg'], $html['title'], $headerMenu, $html['content'], $footer], $pageFile);
echo $pageFile;
// var_dump($func);


// session_destroy();
// $_SESSION['isLogged'] = 'YES';
// $_SESSION['authMsg'] = "Вы авторизованы как Administrator";
// $_SESSION['currentUserId'] = 82;
// $_SESSION['isAdmin'] = 'YES';

// varDump($_SESSION); echo ' -- SESSION <br>';
// varDump($_POST); echo ' -- POST <br>';