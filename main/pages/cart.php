<?php
$title = 'Корзина';
// $currentUserId = $_SESSION['currentUserId'];
$sql_cart = "SELECT id, productCatalogueId, user_id, product_name, count, price
             FROM cart"; //pic  || user_id = $currentUserId

$res_cart = mysqli_query(connectToSQL(), $sql_cart) or die(mysqli_error(connectToSQL())); 

$cart = '';
while ($cartProductData = mysqli_fetch_assoc($res_cart)) {
    if ($cartProductData['user_id'] === $_SESSION['currentUserId']) {
    $cost = $cartProductData['count'] * $cartProductData['price'];
    $cart .= <<<php
    <h2>{$cartProductData['product_name']}</h2>
    <h3>Цена: \${$cartProductData['price']}</h3>
    <img src="{$cartProductData['picPath']}" width=200px">
    <p>{$cartProductData['info']}</p>
    <p>{$cartProductData['count']}</p>
    <p>$cost</p>
    <a href="?page=product&id={$cartProductData['productCatalogueId']}">Подробнее</a>
    <form method='POST'>
        <input type='hidden' name = 'productId' value = {$cartProductData['productCatalogueId']}>
        <input type='hidden' name = 'query[0]' value = 'addToCart'>
        <input type = 'submit' value = 'Добавить ещё 1'>
    </form>

    <form method='POST'>
        <input type='hidden' name = 'productId' value = {$cartProductData['productCatalogueId']}>
        <input type='hidden' name = 'query[1]' value = 'diminishCart'>
        <input type = 'submit' value = 'Удалить 1'> <!-- дописать скрипт -->
    </form>
    <form method='POST'>
        <input type='hidden' name = 'productId' value = {$cartProductData['productCatalogueId']}>
        <input type='hidden' name = 'query[2]' value = 'clearOneProduct'>
        <input type = 'submit' value = 'Удалить данную позицию'> <!-- дописать скрипт -->
    </form>
    <hr>
php;
    } else continue;
};

$content = <<<php
    <div>
        <h1>Каталог</h1>
        {$cart}
    </div>
    <p> очистить корзину </p>
php;
include ('changeCountInCart.php');
// include ('diminishCart.php');