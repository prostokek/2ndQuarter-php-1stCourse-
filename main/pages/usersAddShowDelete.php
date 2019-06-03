<?php
function html() {
    if($_SESSION['isAdmin'] == 'YES') {
        $title = 'Пользователи';

        $sql_users = "SELECT id, fio, login, password, date FROM users"; 
        $res_users = mysqli_query(connectToSQL(), $sql_users) or die(mysqli_error(connectToSQL())); //(адрес, запрос) || получили результат запроса || or die(что делать в случае, если нет ничего по адресу)
    
        $usersList = '';
        while ($userData = mysqli_fetch_assoc($res_users)) {
            $usersList .= <<<php
            <h1>{$userData['login']}</h1>
            <a href="?page=usersAddShowDelete&func=deleteUser&id={$userData['id']}">Delete user</a>
            <hr>
php;
        };
    
        $content = <<<php
            <article style='background: aqua'>
                <h3>Пользователи</h3>
                {$usersList}
    
                <form action='?page=usersAddShowDelete&func=addUser' method='POST'>
                    <input type = 'text' name = 'login'>
                    <input type = 'password' name = 'password'>
                    <textarea name = 'fio' placeholder = 'ФИО'></textarea>
                    <input type = 'submit' value = 'Добавить пользователя'>
                </form>
            </article>
php;
    $html = [
        'content' => $content,
        'title' => $title
    ];
    return $html;
    } else {
        header('Location: /' . $_SERVER['HTTP_REFERER']);
        exit;
    };
};

function addUser() {
    if(!empty($_POST['login']) && !empty($_POST['password'])) {
        $login = clearStr($_POST['login']);
        $password = md5($_POST['password'] . SALT); //получаем хэш (шифруем) для последующего сохранения его в БД
        $fio = clearStr($_POST['fio']);
    
        $sql_loginSearch = "SELECT login FROM users";
    
        $res_loginSearch = mysqli_query(connectToSQL(), $sql_loginSearch) or die(mysqli_error(connectToSQL()));
        if (!empty($fio)) {
            $sql_addUser = "INSERT INTO users(login, password, fio)
            VALUES ('{$login}', '{$password}', '{$fio}')";
        } else {
            $sql_addUser = "INSERT INTO users(login, password)
            VALUES ('{$login}', '{$password}')";
        };
        
        while ($userData = mysqli_fetch_assoc($res_loginSearch)) {
            if ($login == $userData['login']) { //если логин уже занят
                $count = 1;
                // exit; // ?
            };
        };
        if ($count != 1) {
            mysqli_query(connectToSQL(), $sql_addUser);
            $_SESSION['msg'] = 'Пользователь добавлен';
            header('Location:/?page=usersAddShowDelete');
        } else {
            $_SESSION['msg'] = 'Логин уже занят';
            header('Location:/?page=usersAddShowDelete');
        };
    };
};

function deleteUser() {
    if(!empty($_GET['id']) && $_SESSION['isAdmin'] == 'YES') {
        $id = clearStr((int)$_GET['id']);
        $sql_delete = "DELETE FROM users WHERE id = $id";
        mysqli_query(connectToSQL(), $sql_delete);
        $_SESSION['msg'] = 'Пользователь удалён';
        header('Location:/?page=usersAddShowDelete');
    };
};
