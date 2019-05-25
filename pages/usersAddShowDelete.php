<?php
$count = 0;

if(!empty($_POST['login']) && !empty($_POST['password']) && $_POST['query'] == 'addUser') { // && query = addUser
    $login = $_POST['login'];
    $password = $_POST['password'];

    $sql_loginSearch = "SELECT login FROM users";

    $res_loginSearch = mysqli_query($link, $sql_loginSearch) or die(mysqli_error($link));

    $sql_addUser = "INSERT INTO users(login, password)
    VALUES ('{$login}', '{$password}')";

    while ($userData = mysqli_fetch_assoc($res_loginSearch)) {
        if ($login == $userData['login']) { //если логин уже занят
            $count++;
        };
    };
    if ($count === 0) {
        mysqli_query($link, $sql_addUser);
    };
};

if(!empty($_GET['id']) && $_GET['query'] == 'deleteUser') {
    $id = (int)$_GET['id'];
    $sql_delete = "DELETE FROM users WHERE id = $id";
    mysqli_query($link, $sql_delete);
};

$sql = "SELECT id, fio, login, password, date FROM users"; 

$res = mysqli_query($link, $sql) or die(mysqli_error($link)); //(адрес, запрос) || получили результат запроса || or die(что делать в случае, если нет ничего по адресу)

$usersList = '';
while ($userData = mysqli_fetch_assoc($res)) {
    $usersList .= <<<php
    <h1>{$userData['login']}</h1>
    <a href="?page=usersAddShowDelete&query=deleteUser&id={$userData['id']}">Delete user</a>
    <hr>
php;
};

?>

    <article style='background: aqua'>
        <h3>Пользователи</h3>
        <p><?php echo $usersList ?></p>

        <form action='?page=usersAddShowDelete' method='POST'> <!-- Добавление -->
            <input type = 'text' name = 'login'>
            <input type = 'password' name = 'password'>
            <input type = 'hidden' name = 'query' value = 'addUser'>
            <input type = 'submit' value = 'Добавить пользователя'>
        </form> <!-- пользователей-->
    </article>