<?php
$title = 'Каталог';
$sql_catalogueHTML = "SELECT id, name, price, picPath, info FROM products"; 

$res_catalogue = mysqli_query(connectToSQL(), $sql_catalogueHTML) or die(mysqli_error(connectToSQL())); //(адрес, запрос) || получили результат запроса || or die(что делать в случае, если нет ничего по адресу)

$catalogue = '';
while ($productData = mysqli_fetch_assoc($res_catalogue)) {
    $catalogue .= <<<php
    <h2>{$productData['name']}</h2>
    <h3>Цена: \${$productData['price']}</h3>
    <img src="{$productData['picPath']}" width=200px">
    <p>{$productData['info']}</p>
    <a href="?page=product&id={$productData['id']}">Подробнее</a>
    <form method='POST'>
        <input type='hidden' name = 'productId' value = {$productData['id']}>
        <input type = 'submit' value = 'Добавить в корзину'>
    </form>
    <hr>
php;
};

$content = <<<php
    <div>
        <h1>Каталог</h1>
        {$catalogue}
    </div>
php;
include ('addToCart.php');
?>
