<?php
function html() {
    $title = 'Личный кабинет';
    $sql_userData = "SELECT fio, login FROM users where id = {$_SESSION['currentUserId']}";
    $res_userData = mysqli_query(connectToSQL(), $sql_userData);
    $userData = mysqli_fetch_assoc($res_userData);
    varDump($userData);

    if ($_SESSION['isLogged'] == 'YES') {
        $content = <<<php
        <h1>$title</h1>
        <p>Ваш логин: {$userData['login']}</p>
        <p>Добро пожаловать, {$userData['fio']}</p>
php;
    } else {
        $content = <<<php
        <h2>К сожалению, вы ещё не зарегистрированы/залогинены</h2>
        <p>Зарегистрироваться можно <a href=/?page=registrationPage>здесь</a></p>
php;
    };
    $html = [
        'content' => $content,
        'title' => $title
    ];
    return $html;
};
