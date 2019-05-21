<?php

if(!empty($_GET['login']) && !empty($_GET['password']) && $_GET['query'] == 'addUser') { // && query = addUser
    $login = $_GET['login'];
    $password = $_GET['login'];

    $sql_add = "INSERT INTO users(login, password)
    VALUES ('{$login}', '{$password}')";
    mysqli_query($link, $sql_add);
    // header('Location: /?page=usersAddShowDelete');
};

if(!empty($_GET['id']) && $_GET['query'] == 'deleteUser') {
    $id = (int)$_GET['id'];
    varDump($_GET);
    $sql_delete = "DELETE FROM users WHERE id = $id";
    mysqli_query($link, $sql_delete);
    // header('Location: /'); //дабы '?id=значение' не оставалось в адресе (просто перезапрашивает страницу с определённым адресом)
};

$sql = "SELECT id, fio, login, password, date FROM users"; 

$res = mysqli_query($link, $sql) or die(mysqli_error($link)); //(адрес, запрос) || получили результат запроса || or die(что делать в случае, если нет ничего по адресу)
// $row = mysqli_fetch_assoc($res); //вытащили из него ряд в виде ассоциативного массива (по очереди вытаскиевает (с 0-ого))

$usersList = '';
while ($row = mysqli_fetch_assoc($res)) {
    $usersList .= <<<php
    <h1>{$row['login']}</h1>
    <a href="?page=usersAddShowDelete&query=deleteUser&id={$row['id']}">Delete user</a>
    <hr>
php;
};

?>

    <article style='background: aqua'>
        <h3>Пользователи</h3>
        <p><?php echo $usersList ?></p>

        <form> <!-- Добавление -->
            <input type = 'text' name='login'>
            <input type = 'text' name='password'>
            <input type = 'hidden' name='page' value='usersAddShowDelete'>
            <input type = 'hidden' name='query' value='addUser'>
            <input type = 'submit'>
        </form> <!-- пользователей-->
    </article>