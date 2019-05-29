<?php
$title = 'Аутентификация';

$returnTolocation = $_SERVER['HTTP_REFERER'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['query'] == 'authentication') {
    $login = clearStr($_POST['login']);
    $password = md5($_POST['password'] . SALT); //получаем hash (в БД уже лежит именно хэш)

    $sql_loginPassSearch = "SELECT id, password, fio, isAdmin
                            FROM users 
                            where login = '$login'";
    $res_loginPassSearch = mysqli_query(connectToSQL(), $sql_loginPassSearch) or die(mysqli_error(connectToSQL()));

    $userData = mysqli_fetch_assoc($res_loginPassSearch);
    if ($password == $userData['password']) { //$login == 'admin' && 
        $_SESSION['isLogged'] = 'YES';
        $_SESSION['authMsg'] = "Вы авторизованы как {$userData['fio']}";
        $_SESSION['currentUserId'] = $userData['id'];  
        if ($userData['isAdmin'] === 'YES') {
            $_SESSION['isAdmin'] = 'YES';
        } else {
            $_SESSION['isAdmin'] = 'NO';
        }
    } else {
        $_SESSION['isLogged'] = 'NO';
        $_SESSION['isAdmin'] = 'NO';
        $_SESSION['authMsg'] = "Вы указали неверный логин и/или пароль";
    };
    header('Location: ' . $returnTolocation);
};

if ($_SESSION['isLogged'] != 'YES') {
    $content = <<<php
    <form method = 'POST'>
        <input type="text" name = 'login' placeholder = 'Введите логин'>
        <input type="password" name = 'password' placeholder = 'Введите пароль'>
        <input type="hidden" name = 'query' value = 'authentication'>
        <input type="submit" value = 'Авторизоваться'>
    </form>
php;
} else {
    $content = <<<php
    <a href='?page=logOut'>Выход (из учётной записи)</a>
php;
};
