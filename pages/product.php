<?php
$productId = (int)$_GET['id'];
$sql_singleProduct = "SELECT id, name, price, pic, detailedInfo FROM products where id = " . $productId;
echo $sql_singleProduct;

$res_singleProduct = mysqli_query(connectToSQL(), $sql_singleProduct) or die(mysqli_error(connectToSQL()));

$productData = mysqli_fetch_assoc($res_singleProduct);

$singleproductHTML = <<<php
<title>{$productData['name']}</title>
<img src="{$productData['pic']}">
<p>{$productData['detailedInfo']}</p>
<a href='?page=catalogue'>Назад к каталогу</a>
php;

$content = $singleproductHTML;
?>