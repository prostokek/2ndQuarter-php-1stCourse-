<?php
$count = 0;

if(!empty($_POST['login']) && !empty($_POST['password']) && $_POST['query'] == 'addUser') { // && query = addUser
    $login = clearStr($_POST['login']);
    $password = md5($_POST['password'] . SALT); //получаем хэш (шифруем) для последующего сохранения его в БД

    $sql_loginSearch = "SELECT login FROM users";

    $res_loginSearch = mysqli_query(connectToSQL(), $sql_loginSearch) or die(mysqli_error(connectToSQL()));

    $sql_addUser = "INSERT INTO users(login, password)
    VALUES ('{$login}', '{$password}')";

    while ($userData = mysqli_fetch_assoc($res_loginSearch)) {
        if ($login == $userData['login']) { //если логин уже занят
            $count++;
        };
    };
    if ($count === 0) {
        mysqli_query(connectToSQL(), $sql_addUser);
    };
};

if(!empty($_GET['id']) && $_GET['query'] == 'deleteUser') {
    $id = clearStr((int)$_GET['id']);
    $sql_delete = "DELETE FROM users WHERE id = $id";
    mysqli_query(connectToSQL(), $sql_delete);
};

$sql = "SELECT id, fio, login, password, date FROM users"; 

$res = mysqli_query(connectToSQL(), $sql) or die(mysqli_error(connectToSQL())); //(адрес, запрос) || получили результат запроса || or die(что делать в случае, если нет ничего по адресу)

$usersList = '';
while ($userData = mysqli_fetch_assoc($res)) {
    $usersList .= <<<php
    <h1>{$userData['login']}</h1>
    <a href="?page=usersAddShowDelete&query=deleteUser&id={$userData['id']}">Delete user</a>
    <hr>
php;
};


$content = <<<php
    <article style='background: aqua'>
        <h3>Пользователи</h3>
        {$usersList}

        <form action='?page=usersAddShowDelete' method='POST'> <!-- Добавление -->
            <input type = 'text' name = 'login'>
            <input type = 'password' name = 'password'>
            <input type = 'hidden' name = 'query' value = 'addUser'>
            <input type = 'submit' value = 'Добавить пользователя'>
        </form> <!-- пользователей-->
    </article>
php;
?>