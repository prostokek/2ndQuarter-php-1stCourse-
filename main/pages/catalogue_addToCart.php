<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $productCatalogueId = $_POST['productId'];
    $sql_findProductInCatalogue = "SELECT id, name, price, picPath, info 
                                   FROM products WHERE id = $productCatalogueId";
    $res_findProductInCatalogue = mysqli_query(connectToSQL(), $sql_findProductInCatalogue);
    $catalogueProductData = mysqli_fetch_assoc($res_findProductInCatalogue);
    
    $sql_findProductInCart = "SELECT id, productCatalogueId, user_id, product_name, count
                              FROM cart"; //pic || count
    $res_findProductInCart = mysqli_query(connectToSQL(), $sql_findProductInCart);
    while ($cartProductData = mysqli_fetch_assoc($res_findProductInCart)) {
        if ($cartProductData['productCatalogueId'] == $catalogueProductData['id'] && $cartProductData['user_id'] == $_SESSION['currentUserId']) {
            //Товар уже есть в корзине данного пользователя
            // break;
            $productAlrdyAdded = 'YES';
            echo 'Товар уже есть в корзине данного пользователя';
        };
    };
    if ($productAlrdyAdded != 'YES') {
        $sql_insertToCart = "INSERT into cart (productCatalogueId, user_id, product_name, price) 
        VALUES ({$catalogueProductData['id']},  {$_SESSION['currentUserId']}, '{$catalogueProductData['name']}', {$catalogueProductData['price']})";
        mysqli_query(connectToSQL(), $sql_insertToCart);
        header('Location: /?page=catalogue');
    };
};

    ///////
//     $sql_findRepeatingProduct = "SELECT id, product_name, user_id, count
//                                  FROM cart";
//     $res_findRepeatingProduct = mysqli_query(connectToSQL(), $sql_findRepeatingProduct);
//     while ($repeatingProductData = mysqli_fetch_assoc($res_findRepeatingProduct)) {
//         if ($repeatingProductData['product_name'] == $productData['name'] && $repeatingProductData['user_id'] == $_SESSION['currentUserId']) {
//             $productUpdatedCount = $repeatingProductData['count'] + 1;
//             $sql_addToCart = "UPDATE cart 
//                               SET count = $productUpdatedCount
//                               WHERE product_name = '{$productData['name']}'";
//             break;
//         } else {
//             $sql_addToCart = "INSERT INTO cart(product_name, price, user_id)
//             VALUES ('{$productData['name']}', {$productData['price']}, {$_SESSION['currentUserId']})";
//         };
//     };
//     mysqli_query(connectToSQL(), $sql_addToCart);
//     // header('Location: /?page=catalogue');
// };