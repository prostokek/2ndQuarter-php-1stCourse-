<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $productCatalogueId = $_POST['productId'];
    $sql_findProductInCatalogue = "SELECT id, name, price, picPath, info 
                                   FROM products WHERE id = $productCatalogueId";
    $res_findProductInCatalogue = mysqli_query(connectToSQL(), $sql_findProductInCatalogue);
    $catalogueProductData = mysqli_fetch_assoc($res_findProductInCatalogue);
    
    $sql_findProductInCart = "SELECT id, productCatalogueId, user_id, product_name, count, picPath
                              FROM cart"; //pic || count
    $res_findProductInCart = mysqli_query(connectToSQL(), $sql_findProductInCart);
    while ($cartProductData = mysqli_fetch_assoc($res_findProductInCart)) {
        if ($cartProductData['productCatalogueId'] == $catalogueProductData['id'] && $cartProductData['user_id'] == $_SESSION['currentUserId']) {
            //Товар уже есть в корзине данного пользователя
            // break;
            $productAlrdyAdded = 'YES';
            // echo 'Товар уже есть в корзине данного пользователя';
            $increasedProductCount = $cartProductData['count'] + 1;
            $sql_appendProductInCartCount = "UPDATE cart 
                SET count = $increasedProductCount where id = {$cartProductData['id']}";
            // echo $sql_appendProductInCartCount;
            mysqli_query(connectToSQL(), $sql_appendProductInCartCount);
            header('Location:/?page=catalogue');
            // break;
        };
    };
    if ($productAlrdyAdded != 'YES') {
        $sql_insertToCart = "INSERT into cart (productCatalogueId, user_id, product_name, price, picPath) 
        VALUES ({$catalogueProductData['id']},  {$_SESSION['currentUserId']}, '{$catalogueProductData['name']}', {$catalogueProductData['price']}, '{$catalogueProductData['picPath']}')";
        // echo $catalogueProductData['picPath'];
        mysqli_query(connectToSQL(), $sql_insertToCart);
        header('Location: /?page=catalogue');
    };
};