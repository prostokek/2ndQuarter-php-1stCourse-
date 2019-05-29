<?php
$productId = $_POST['productId'];
echo $productId . '<br> PRODUCT_ID <br>';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['query'][0] === 'addToCart') {
    // $productId = $_POST['productId'];
    $sql_findProduct = "SELECT name, price, picPath, info 
                        FROM products WHERE id = $productId";
    $res_findProduct = mysqli_query(connectToSQL(), $sql_findProduct);
    $productData = mysqli_fetch_assoc($res_findProduct);

    $sql_findRepeatingProduct = "SELECT product_name, user_id, count, id
                                 FROM cart";
    $res_findRepeatingProduct = mysqli_query(connectToSQL(), $sql_findRepeatingProduct);
    while ($repeatingProductData = mysqli_fetch_assoc($res_findRepeatingProduct)) {
        if (
            $repeatingProductData['id'] == $productId && $repeatingProductData['user_id'] == $_SESSION['currentUserId']
            && $repeatingProductData['product_name'] == $productData['name']
        ) {
            $productUpdatedCount = $repeatingProductData['count'] + 1;
            echo $productData['name'];
            // ЧТО НАПИСАТЬ, ЧТОБЫ И ИЗ КАТАЛОГА, И ИЗ КОРЗИНЫ МОЖНО БЫЛО ДОБАВЛЯТЬ  (универсально, а не двумя разными скриптами)
            $sql_addToCart = "UPDATE cart 
                              SET count = $productUpdatedCount
                              WHERE id = $productId";
            break;
        } else {
            $sql_addToCart = "INSERT INTO cart(product_name, price, user_id)
            VALUES ('{$productData['name']}', {$productData['price']}, {$_SESSION['currentUserId']})";
        };
    };
    mysqli_query(connectToSQL(), $sql_addToCart);
    echo $sql_addToCart . 'ADD';
    // header('Location:' . $_SERVER['HTTP_REFERER']);
} else if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['query'][1] === 'diminishCart') {
    // $productId = $_POST['productId'];
    $sql_findProduct = "SELECT name, price, picPath, info 
    FROM products WHERE id = $productId";
    $res_findProduct = mysqli_query(connectToSQL(), $sql_findProduct);
    $productData = mysqli_fetch_assoc($res_findProduct);

    $sql_findRepeatingProduct = "SELECT product_name, user_id, count, id
                                 FROM cart";
    $res_findRepeatingProduct = mysqli_query(connectToSQL(), $sql_findRepeatingProduct);
    while ($repeatingProductData = mysqli_fetch_assoc($res_findRepeatingProduct)) {
        if (
            $repeatingProductData['id'] == $productId && $repeatingProductData['user_id'] == $_SESSION['currentUserId']
            && $repeatingProductData['product_name'] == $productData['name']
        ) {
            $productUpdatedCount = $repeatingProductData['count'] - 1;
            echo $productData['name'];
            // ЧТО НАПИСАТЬ, ЧТОБЫ И ИЗ КАТАЛОГА, И ИЗ КОРЗИНЫ МОЖНО БЫЛО ДОБАВЛЯТЬ  (универсально, а не двумя разными скриптами)
            $sql_diminishCart = "UPDATE cart 
          SET count = $productUpdatedCount
          WHERE id = $productId";
            break;
        } else {
            $sql_diminishCart = "INSERT INTO cart(product_name, price, user_id)
VALUES ('{$productData['name']}', {$productData['price']}, {$_SESSION['currentUserId']})";
        };
    };
    mysqli_query(connectToSQL(), $sql_diminishCart);
    // header('Location:' . $_SERVER['HTTP_REFERER']);
    echo $sql_diminishCart . 'DIMINISH';
    // header('Location:' . $_SERVER['HTTP_REFERER']);
};
