<?php 

$link = mysqli_connect(  //подключаемся к базе данных
    '127.0.0.1:3306', //'2ndQuarter-php-1stCourse-',
    'root', //имя пользователя
    '', // пароль
    '2ndquarter-php-1stcourse-' //название базы данных
); 

$sql = "SELECT pic_id, path, name, viewCount FROM gallery"; //запрос = получить информацию о картинках

$res = mysqli_query($link, $sql) or die(mysqli_error($link)); //(адрес, запрос) || получили результат запроса || or die(что делать в случае, если нет ничего по адресу)

while ($picData = mysqli_fetch_assoc($res)) {
    $picId = (int)$picData['pic_id'];
    if($_GET['pic_id'] == $picId) {
        $viewCountUpdated = $picData['viewCount'] + 1;
        $sqlUpdateViewCount = "UPDATE gallery SET viewCount = $viewCountUpdated WHERE pic_id = $picId";
        mysqli_query($link, $sqlUpdateViewCount);
        $html = <<<php
    <!DOCTYPE html>
    <html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>{$picData['name']}</title>
    </head>
    <body>
        <img src="{$picData['path']}" alt="" width = 700px>
        <p>Количество просмотров: {$picData['viewCount']}</p>
    </body>
    </html>
php;
    };
};

    echo $html;
?>