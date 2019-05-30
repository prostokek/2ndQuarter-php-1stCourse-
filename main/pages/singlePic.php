<?php 

$sql_singlePic = "SELECT pic_id, path, name, viewCount FROM gallery"; //запрос = получить информацию о картинках

$res_singlePic = mysqli_query(connectToSQL(), $sql_singlePic) or die(mysqli_error(connectToSQL())); //(адрес, запрос) || получили результат запроса || or die(что делать в случае, если нет ничего по адресу)

while ($picData = mysqli_fetch_assoc($res_singlePic)) {
    $picId = (int)$picData['pic_id'];
    if($_GET['pic_id'] == $picId) {
        $viewCountUpdated = $picData['viewCount'] + 1;
        $sqlUpdateViewCount = "UPDATE gallery SET viewCount = $viewCountUpdated WHERE pic_id = $picId";
        mysqli_query(connectToSQL(), $sqlUpdateViewCount);
        $singlePicHTML = <<<php
        <title>Как динамически менять?</title>
        <img src="{$picData['path']}" alt="" width = 700px>
        <p>Количество просмотров: {$picData['viewCount']}</p>
php;
    };
};
$content = $singlePicHTML;
?>