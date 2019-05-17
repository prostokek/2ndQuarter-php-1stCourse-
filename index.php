<?php 
    $title = 'Пятый урок';
    $h1 = 'Пятый урок';

    function varDump($var) { //человеческий вывод var_dump() (не в одну строку)
        static $int=0;
        echo '<pre><b style="background: red;padding: 1px 5px;">'.$int.'</b> ';
        print_r($var);
        echo '</pre>';
        $int++;
    }; 

    /* СОЗДАНИЕ ЛОГОВ */
    $date = date(r);
    $log_count = (count(scandir(__DIR__ . '/Logs')) - 2);
    file_put_contents(__DIR__ . '/Logs/log.txt', "$date" . PHP_EOL, FILE_APPEND);
    
    if(sizeof(file (__DIR__ . '/Logs/log.txt')) > 499) { //количество строк в файле превышает 9 (равняется 10)
        copy(__DIR__ . '/Logs/log.txt', __DIR__ . "/Logs/log$log_count.txt"); //создаём копию под определённым номером
        file_put_contents(__DIR__ . '/Logs/log.txt', ''); //опустошаем
    };
    /* /СОЗДАНИЕ ЛОГОВ */

    // КАК СДЕЛАТЬ ТАК, ЧТОБЫ ID УСТАНАВЛИВАЛСЯ АВТОМАТИЧЕСКИ (я это пропустил, видимо)


    // ВЫПОЛНЕНО НА УРОКЕ

    $link = mysqli_connect(  //подключаемся к базе данных
        '127.0.0.1:3306', //'2ndQuarter-php-1stCourse-',
        'root', //имя пользователя
        '', // пароль
        '2ndquarter-php-1stcourse-' //название базы данных
    ); 

    if(!empty($_GET['login']) && !empty($_GET['password'])) {
        $login = $_GET['login'];
        $password = $_GET['login'];

        $sql_add = "INSERT INTO users(login, password)
        VALUES ('{$login}', '{$password}')";
        mysqli_query($link, $sql_add);
        // header('Location: /');
    };

    if(!empty($_GET['id'])) {
        $id = (int)$_GET['id'];
        $sql_delete = "DELETE FROM users WHERE id = $id";
        mysqli_query($link, $sql_delete);
        header('Location: /'); //дабы '?id=значение' не оставалось в адресе (просто перезапрашивает страницу с определённым адресом)
    };
    

    $sql = "SELECT id, fio, login, password, date FROM users";

    $res = mysqli_query($link, $sql) or die(mysqli_error($link)); //(адрес, запрос) || получили результат запроса || or die(что делать в случае, если нет ничего по адресу)
    // $row = mysqli_fetch_assoc($res); //вытащили из него ряд в виде ассоциативного массива (по очереди вытаскиевает (с 0-ого))

    $res_1 = '';
    while ($row = mysqli_fetch_assoc($res)) {
        $res_1 .= <<<php
        <h1>{$row['login']}</h1>
        <a href="?id={$row['id']}">Delete user</a>
        <hr>
php;
};
// /ВЫПОЛНЕНО НА УРОКЕ

// ДОМАШНЕЕ ЗАДАНИЕ

$sql_homeWork = "SELECT pic_id, path, viewCount FROM gallery";

    $res_homeWork = mysqli_query($link, $sql_homeWork) or die(mysqli_error($link)); //(адрес, запрос) || получили результат запроса || or die(что делать в случае, если нет ничего по адресу)

    $sql_homeWork = '';
    while ($picData = mysqli_fetch_assoc($res_homeWork)) {
        $sql_homeWork .= <<<php
        <a href="?pic_id={$picData['pic_id']}">
        <img src="{$picData['path']}" alt="" width = 400px></a>
php;

if($_GET['pic_id'] == $picData['pic_id']) {
    // $sql_picPageHTML = "$picData['picPageHTML']";
    $picPageHTML = "<img src="{$picData['path']}" alt="">"
};
};



?>

<img src="{$row['path']}" alt="">

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo($title);?></title>
</head>
<body>

<h1> <?php echo($h1);?> </h1>
    <article style='background: aqua'>
        <h3>Выполнено на уроке</h3>
        <p><?php echo $res_1 ?></p>

        <form>
            <input type = 'text' name='login'>
            <input type = 'text' name='password'>
            <input type = 'submit'>
        </form>
    </article>

    <article>
        <h3>Домашнее задание</h3>
        <p><?php echo $sql_homeWork ?></p>
    </article>
    
    
    <footer>
        <?php echo('Год: ' . date(Y)) ?>
    </footer>
</body>
</html>