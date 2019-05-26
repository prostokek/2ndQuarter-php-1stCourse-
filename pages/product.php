<?php
$productId = (int)$_GET['id'];
$sql_singleProduct = "SELECT id, name, price, picPath, detailedInfo FROM products where id = " . $productId;

$res_singleProduct = mysqli_query(connectToSQL(), $sql_singleProduct) or die(mysqli_error(connectToSQL()));

$productData = mysqli_fetch_assoc($res_singleProduct);
$title = $productData['name'];
$singleproductHTML = <<<php
<title>{$productData['name']}</title>
<img src="{$productData['picPath']}">
<p>{$productData['detailedInfo']}</p>
<a href='?page=catalogue'>Назад к каталогу</a>
php;

//

$sql_productFeedback = "SELECT nameOfSender, commentary, date, product_id FROM productsFeedback where product_id = " . $productId . " ORDER BY productsFeedback.date DESC";
$res_productFeedback = mysqli_query(connectToSQL(), $sql_productFeedback) or die(mysqli_error(connectToSQL()));

$productFeedbackHTML = '';
while ($productFeedbackData = mysqli_fetch_assoc($res_productFeedback)) {
    $productFeedbackDate = date('d M Y H ч. i м.', strtotime($productFeedbackData['date']));
    $productFeedbackHTML .= <<<php
    <h2>Имя отправителя: {$productFeedbackData['nameOfSender']}</h2>
    <p>Отзыв: {$productFeedbackData['commentary']}</p>
    <p>Дата: {$productFeedbackDate}</p>
    <hr>
php;
};
//

if(!empty($_POST['nameOfSender']) && !empty($_POST['commentary']) && $_POST['query'] == 'addCommentaryToAProduct') {
    $nameOfSender = clearStr($_POST['nameOfSender']);
    $commentary = clearStr($_POST['commentary']);

    $sql_addCommentary = "INSERT INTO productsFeedback(nameOfSender, commentary, product_id)
    VALUES ('{$nameOfSender}', '{$commentary}', '{$productId}')";

    mysqli_query(connectToSQL(), $sql_addCommentary);
    // var_dump($_POST); echo '<br>';
    header("Location: /?page=product&id={$productId}");
};

$productFeedbackFullHTML = <<<php
    <div>
        <h1>Оставить отзыв о продукте</h1>
        <form method='POST'>
        <input type = 'text' name = 'nameOfSender' placeholder = 'Имя отправителя'>
        <textarea name = 'commentary' placeholder = 'Отзыв'></textarea>
        <input type = 'hidden' name = 'query' value = 'addCommentaryToAProduct'>
        <input type = 'submit' value = 'Оставить отзыв'>
        </form>
        <h1>Отзывы о продукте</h1>
        {$productFeedbackHTML}
    </div>
php;


$content = $singleproductHTML . $productFeedbackFullHTML;
?>