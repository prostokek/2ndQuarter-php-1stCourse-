<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $productId = $_POST['productId'];
    $sql_findProduct = "SELECT name, price, picPath, info 
                        FROM products WHERE id = $productId";
    $res_findProduct = mysqli_query(connectToSQL(), $sql_findProduct);
    $productData = mysqli_fetch_assoc($res_findProduct);
    
    // $cost = $productData['price'] * 
    $sql_findRepeatingProduct = "SELECT product_name, user_id, count 
                                 FROM cart";
    $res_findRepeatingProduct = mysqli_query(connectToSQL(), $sql_findRepeatingProduct);
    while ($repeatingProductData = mysqli_fetch_assoc($res_findRepeatingProduct)) {
        if ($repeatingProductData['product_name'] == $productData['name'] && $repeatingProductData['user_id'] == $_SESSION['currentUserId']) {
            $productUpdatedCount = $repeatingProductData['count'] + 1;
            $sql_addToCart = "UPDATE cart 
                              SET count = $productUpdatedCount
                              WHERE product_name = '{$productData['name']}'";
            break;
        } else {
            $sql_addToCart = "INSERT INTO cart(product_name, price, user_id)
            VALUES ('{$productData['name']}', {$productData['price']}, {$_SESSION['currentUserId']})";
        };
    };
    mysqli_query(connectToSQL(), $sql_addToCart);
    header('Location: /?page=catalogue');
};