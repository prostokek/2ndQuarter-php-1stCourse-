<?php
$productId = $_POST['productId'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($productId)) {
    if ($_POST['query'][0] == 'appendProductCount') {
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
    } else if ($_POST['query'][1] == 'diminishProductCount') {
        $sql_productInCart = "SELECT id, productCatalogueId, user_id, product_name, count, price,
        FROM cart"; // where id = $productId
        $res_productInCart = mysqli_query(connectToSQL(), $sql_productInCart);
    
        while ($productInCartData = mysqli_fetch_assoc($res_productInCart)) {
            if ($productInCartData['productCatalogueId'] == $productId && $productInCartData['user_id'] == $_SESSION['currentUserId']) {
                $decreasedProductCount = $productInCartData['count'] - 1;
                if ($decreasedProductCount == 0) {
                    $sql_deleteFromCart = "DELETE FROM cart 
                    WHERE id = {$productInCartData['id']}";
                    mysqli_query(connectToSQL(), $sql_deleteFromCart);
                    header('Location:/?page=cart');
                } else {
                    $sql_appendProductInCartCount = "UPDATE cart 
                    SET count = $decreasedProductCount where id = {$productInCartData['id']}";
                    // echo $sql_appendProductInCartCount;
                    mysqli_query(connectToSQL(), $sql_appendProductInCartCount);
                    header('Location:/?page=cart');
                    break;
                };
            };
        };
    } else if ($_POST['query'][2] == 'clearOneProduct') {
        $sql_productInCart = "SELECT id, productCatalogueId, user_id, product_name, count, price 
        FROM cart"; // where id = $productId
        $res_productInCart = mysqli_query(connectToSQL(), $sql_productInCart);
    
        while ($productInCartData = mysqli_fetch_assoc($res_productInCart)) {
            if ($productInCartData['productCatalogueId'] == $productId && $productInCartData['user_id'] == $_SESSION['currentUserId']) {
                    $sql_deleteFromCart = "DELETE FROM cart 
                    WHERE id = {$productInCartData['id']}";
                    mysqli_query(connectToSQL(), $sql_deleteFromCart);
                    header('Location:/?page=cart');
            };
        };
    };
};
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['query'][3] == 'clearCart') {
    // надо бы спрашивать, уверен ли пользователь (да и не только здесь), но без js я это не реализую сейчас
    $sql_deleteUsersCart = "DELETE FROM cart WHERE user_id = {$_SESSION['currentUserId']}";
    // echo $sql_deleteUsersCart;
    mysqli_query(connectToSQL(), $sql_deleteUsersCart);
    header('Location:/?page=cart');
};