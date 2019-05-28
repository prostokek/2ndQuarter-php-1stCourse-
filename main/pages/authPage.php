<?php
$title = 'Аутентификация';
$authCount = 0;

$returnTolocation = $_SERVER['HTTP_REFERER'];

if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['query'] == 'authentication') {
    $login = clearStr($_POST['login']);
    $password = md5($_POST['password'] . SALT); //получаем hash (в БД уже лежит именно хэш)

    $sql_loginPassSearch = "SELECT login, password FROM users";

    $res_loginPassSearch = mysqli_query(connectToSQL(), $sql_loginPassSearch) or die(mysqli_error(connectToSQL()));

    while ($userData = mysqli_fetch_assoc($res_loginPassSearch)) {
        if ($login == 'admin' && $password == $userData['password']) {
            $authCount = 1;
            $_SESSION['isLogged'] = 'YES';
            $_SESSION['isAdmin'] = 'YES';
            // header('Location: ' . $returnTolocation);
            break;
        }
        if ($login == $userData['login'] && $password == $userData['password']) {
            $authCount = 1;
            $_SESSION['isLogged'] = 'YES';
            $_SESSION['isAdmin'] = 'NO';
            header('Location: ' . $returnTolocation); // is needed?
            // break;
        };
    };
    if ($authCount === 0) {
        $_SESSION['isLogged'] = 'NO';
        $_SESSION['isAdmin'] = 'NO';
        // echo 'Ошибка, неправильно указан/ы логин и/или пароль';
    };
};
// echo $_SERVER['HTTP_REFERER'];
// echo '<br>' . $returnTolocation . '<br>';
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
?>