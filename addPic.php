<?php

$link = mysqli_connect(  //подключаемся к базе данных
        '127.0.0.1:3306', //'2ndQuarter-php-1stCourse-',
        'root', //имя пользователя
        '', // пароль
        '2ndquarter-php-1stcourse-' //название базы данных
    );

if(!empty($_GET['path'])) {
    $path = "/Gallery/{$_GET['path']}";
    $name = $_GET['name'];
    $sql_insert = "INSERT INTO gallery (path, name) 
    VALUES ('{$path}', '{$name}')";
    mysqli_query($link, $sql_insert);
    header('Location: /addPic.php');
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form>
        <input type = 'text' name='path' placeholder = 'Путь до картинки'>
        <input type = 'text' name='name' placeholder = 'Название картинки'>
        <input type = 'submit'>
    </form>
</body>
</html>