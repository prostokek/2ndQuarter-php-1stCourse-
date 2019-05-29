<?php
$title = 'Личный кабинет';
$sql_userData = "SELECT fio, login FROM users where id = {$_SESSION['currentUserId']}";
$res_userData = mysqli_query(connectToSQL(), $sql_userData);
$userData = mysqli_fetch_assoc($res_userData);

$content = <<<php
    <h1>$title</h1>
    <p>Ваш логин: {$userData['login']}</p>
    <p>Добро пожаловать, {$userData['fio']}</p>
php;
