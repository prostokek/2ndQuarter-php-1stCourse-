<?php

$sql_gallery = "SELECT pic_id, path, viewCount FROM gallery ORDER BY gallery.viewCount DESC";

$res_gallery = mysqli_query($link, $sql_gallery) or die(mysqli_error($link)); //(адрес, запрос) || получили результат запроса || or die(что делать в случае, если нет ничего по адресу)

$galleryHTML = <<<php
<h1>Галерея</h1>
php;

while ($picData = mysqli_fetch_assoc($res_gallery)) {
    $galleryHTML .= <<<php
    <a href="/?page=singlePic&pic_id={$picData['pic_id']}">
    <img src="{$picData['path']}" alt="" width = 400px></a>
    <p>Количество просмотров: {$picData['viewCount']}</p>
php;
};

echo $galleryHTML;
?>