<?php
$productId = $_POST['productId'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($productId)) {
    $sql_productInCart = "SELECT id, productCatalogueId, user_id, product_name, count, price 
    FROM cart"; // where id = $productId
    $res_productInCart = mysqli_query(connectToSQL(), $sql_productInCart);

    while ($productInCartData = mysqli_fetch_assoc($res_productInCart)) {
        if ($productInCartData['productCatalogueId'] == $productId && $productInCartData['user_id'] == $_SESSION['currentUserId']) {
            $increasedProductCount = $productInCartData['count'] + 1;
            $sql_appendProductInCartCount = "UPDATE cart 
                SET count = $increasedProductCount where id = {$productInCartData['id']}";
            // echo $sql_appendProductInCartCount;
            mysqli_query(connectToSQL(), $sql_appendProductInCartCount);
            header('Location:/?page=cart');
            break;
        };
    };
};