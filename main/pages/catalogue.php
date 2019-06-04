<?php
function html() {
    $title = 'Каталог';
    $sql_catalogue = "SELECT id, name, price, picPath, info FROM products"; 

    $res_catalogue = mysqli_query(connectToSQL(), $sql_catalogue) or die(mysqli_error(connectToSQL())); //(адрес, запрос) || получили результат запроса || or die(что делать в случае, если нет ничего по адресу)

    $catalogue = '';
    while ($productData = mysqli_fetch_assoc($res_catalogue)) {
        $catalogue .= <<<php
        <h2>{$productData['name']}</h2>
        <h3>Цена: \${$productData['price']}</h3>
        <img src="{$productData['picPath']}" width=200px">
        <p>{$productData['info']}</p>
        <a href="?page=product&id={$productData['id']}">Подробнее</a>
        <a onclick='addToCart({$productData['id']})' style='cursor: pointer'>Добавить в корзину</a>
        <hr>
php;
    };

    $content = <<<php
        <div>
            <h1>Каталог</h1>
            {$catalogue}
        </div>
        <script src="./js/catalogue_AddingToCart.js"></script>
php;

$html = [
    'content' => $content,
    'title' => $title
];

return $html;
};


function addToCart() {
    $productCatalogueId = $_GET['productId'];
    $sql_findProductInCatalogue = "SELECT id, name, price, picPath, info 
                                   FROM products WHERE id = $productCatalogueId";
    $res_findProductInCatalogue = mysqli_query(connectToSQL(), $sql_findProductInCatalogue);
    $catalogueProductData = mysqli_fetch_assoc($res_findProductInCatalogue);
    
    $sql_findProductInCart = "SELECT id, productCatalogueId, user_id, product_name, count, picPath
                              FROM cart"; //pic || count
    $res_findProductInCart = mysqli_query(connectToSQL(), $sql_findProductInCart);
    while ($cartProductData = mysqli_fetch_assoc($res_findProductInCart)) {
        if ($cartProductData['productCatalogueId'] == $catalogueProductData['id'] && $cartProductData['user_id'] == $_SESSION['currentUserId']) {
            $productAlrdyAdded = 'YES';
            $increasedProductCount = $cartProductData['count'] + 1;
            $sql_appendProductInCartCount = "UPDATE cart 
                SET count = $increasedProductCount where id = {$cartProductData['id']}";
            mysqli_query(connectToSQL(), $sql_appendProductInCartCount);
            // header('Location:/?page=catalogue'); заменяем на проверку запроса страницы методом POST из-за ajax
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // echo 'sss';
                // $cartCount = countCart();
                global $cartCount;
                echo $cartCount;
                exit;
            };
            // break;
        };
    };
    if ($productAlrdyAdded != 'YES') {
        $sql_insertToCart = "INSERT into cart (productCatalogueId, user_id, product_name, price, picPath) 
        VALUES ({$catalogueProductData['id']},  {$_SESSION['currentUserId']}, '{$catalogueProductData['name']}', {$catalogueProductData['price']}, '{$catalogueProductData['picPath']}')";
        // echo $sql_insertToCart;
        mysqli_query(connectToSQL(), $sql_insertToCart);
        // header('Location: /?page=catalogue');
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // echo 'sss';
            // $cartCount = countCart();
            global $cartCount;
            echo $cartCount;
            exit;
        };
        // exit;
    };
};