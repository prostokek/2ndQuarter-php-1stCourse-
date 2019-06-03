<?php
function html() {
    if ($_SESSION['isLogged'] != 'YES') {
        $content = <<<php
        <form  method='POST' action='?page=registrationPage&func=addUser'>
            <input type = 'text' name = 'login' required>
            <input type = 'password' name = 'password' required>
            <textarea name = 'fio' placeholder = 'Как к Вам обращаться?'></textarea>
            <input type = 'submit' value = 'Зарегистрироваться'>
        </form>
    </article>
php;
    } else {
        $content = "<p>Вы уже зарегистрированы!</p>";
    };
    $html = [
        'content' => $content,
        'title' => $title
    ];
    return $html;
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
            echo $sql_addUser;
        } else {
            $sql_addUser = "INSERT INTO users(login, password)
            VALUES ('{$login}', '{$password}')";
            echo $sql_addUser;
        };
        
        while ($userData = mysqli_fetch_assoc($res_loginSearch)) {
            if ($login == $userData['login']) { //если логин уже занят
                $count = 1;
            };
        };
        if ($count != 1) {
            // mysqli_query(connectToSQL(), $sql_addUser);
        };
    };
};
// if(!empty($_POST['login']) && !empty($_POST['password'])) {
//     $login = clearStr($_POST['login']);
//     $password = md5($_POST['password'] . SALT); //получаем хэш (шифруем) для последующего сохранения его в БД
//     $fio = clearStr($_POST['fio']);

//     $sql_loginSearch = "SELECT login FROM users";

//     $res_loginSearch = mysqli_query(connectToSQL(), $sql_loginSearch) or die(mysqli_error(connectToSQL()));
//     if (!empty($fio)) {
//         $sql_addUser = "INSERT INTO users(login, password, fio)
//         VALUES ('{$login}', '{$password}', '{$fio}')";
//         echo $sql_addUser;
//     } else {
//         $sql_addUser = "INSERT INTO users(login, password)
//         VALUES ('{$login}', '{$password}')";
//         echo $sql_addUser;
//     };
    
//     while ($userData = mysqli_fetch_assoc($res_loginSearch)) {
//         if ($login == $userData['login']) { //если логин уже занят
//             $count = 1;
//         };
//     };
//     if ($count != 1) {
//         mysqli_query(connectToSQL(), $sql_addUser);
//     };
// };

// if ($_SESSION['isLogged'] != 'YES') {
//     $content = <<<php
//     <form  method='POST'> <!-- Добавление action='?page=authPage'--> 
//         <input type = 'text' name = 'login' required>
//         <input type = 'password' name = 'password' required>
//         <textarea name = 'fio' placeholder = 'Как к Вам обращаться?'></textarea>
//         <input type = 'hidden' name = 'query' value = 'addUser'>
//         <input type = 'submit' value = 'Зарегистрироваться'>
//     </form> <!-- пользователей-->
// </article>
// php;
// } else {
//     $content = "<p>Вы уже зарегистрированы!</p>";
// };