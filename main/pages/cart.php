<?php
function html() {
    $title = 'Корзина';
    
    $summaryCost = 0;
    // $currentUserId = $_SESSION['currentUserId'];
    $sql_cart = "SELECT id, productCatalogueId, user_id, product_name, count, price, picPath
                FROM cart"; //pic  || user_id = $currentUserId

    $res_cart = mysqli_query(connectToSQL(), $sql_cart) or die(mysqli_error(connectToSQL())); 

    $cart = '';
    while ($cartProductData = mysqli_fetch_assoc($res_cart)) {
        if ($cartProductData['user_id'] == $_SESSION['currentUserId']) {
        $cost = $cartProductData['count'] * $cartProductData['price'];
        $summaryCost += $cost;
        $cart .= <<<php
        <h2>{$cartProductData['product_name']}</h2>
        <h3>Цена: \${$cartProductData['price']}</h3>
        <img src="{$cartProductData['picPath']}" width=200px">
        <p>{$cartProductData['info']}</p>
        <p>Количество: {$cartProductData['count']}</p>
        <p>Стоимость: $cost</p>
        <a href="?page=product&id={$cartProductData['productCatalogueId']}">Подробнее</a>

        <!-- <i onclick="appendProductCount({$cartProductData['productCatalogueId']})" style='cursor: pointer'>Добавить ещё 1</i> -->

        <a href="?page=cart&productId={$cartProductData['productCatalogueId']}&func=appendProductCount">Добавить ещё 1</a> 
        <a href="?page=cart&productId={$cartProductData['productCatalogueId']}&func=diminishProductCount">Удалить 1</a> 
        <a href="?page=cart&productId={$cartProductData['productCatalogueId']}&func=clearOneProduct">Удалить данную позицию</a>

        <hr>
php;
        } else continue;
    };

        $content = <<<php
        <div>
            <h1>Каталог</h1>
            {$cart}
            Общая стоимость товаров в корзине: \$$summaryCost
        </div>
        <a href="?page=cart&func=clearCart">Очистить корзину</a>
        <script src="./js/cart.js"></script>
php;

    $html = [
        'content' => $content,
        'title' => $title
    ];
    // varDump($html);
    return $html;
};


function appendProductCount() {
    $productId = $_GET['productId'];
    if (!empty($productId)) {
        $sql_productInCart = "SELECT id, productCatalogueId, user_id, product_name, count, price 
        FROM cart"; 
        $res_productInCart = mysqli_query(connectToSQL(), $sql_productInCart);
    
        while ($productInCartData = mysqli_fetch_assoc($res_productInCart)) {
            if ($productInCartData['productCatalogueId'] == $productId && $productInCartData['user_id'] == $_SESSION['currentUserId']) {
                $increasedProductCount = $productInCartData['count'] + 1;
                $sql_appendProductInCartCount = "UPDATE cart 
                    SET count = $increasedProductCount where id = {$productInCartData['id']}";
                mysqli_query(connectToSQL(), $sql_appendProductInCartCount);
                header('Location:/?page=cart');
                exit;
                // if ($_SERVER['REQUEST_METHOD'] == 'POST') {  //заменяем на проверку запроса страницы методом POST из-за ajax
                //     echo 'success';
                //     exit;
                // }
                // break;
            };
        };
    };
};

function diminishProductCount() {
    $productId = $_GET['productId'];
    if (!empty($productId)) {
        $sql_productInCart = "SELECT id, productCatalogueId, user_id, product_name, count, price
        FROM cart"; 
        $res_productInCart = mysqli_query(connectToSQL(), $sql_productInCart);
    
        while ($productInCartData = mysqli_fetch_assoc($res_productInCart)) {
            if ($productInCartData['productCatalogueId'] == $productId && $productInCartData['user_id'] == $_SESSION['currentUserId']) {
                $decreasedProductCount = $productInCartData['count'] - 1;
                if ($decreasedProductCount == 0) {
                    $sql_deleteFromCart = "DELETE FROM cart 
                    WHERE id = {$productInCartData['id']}";
                    mysqli_query(connectToSQL(), $sql_deleteFromCart);
                    header('Location:/?page=cart');
                    exit;
                } else {
                    $sql_appendProductInCartCount = "UPDATE cart 
                    SET count = $decreasedProductCount where id = {$productInCartData['id']}";
                    mysqli_query(connectToSQL(), $sql_appendProductInCartCount);
                    header('Location:/?page=cart');
                    exit;
                    break;
                };
            };
        };
    };
};

function clearOneProduct() {
    $productId = $_GET['productId'];
    if (!empty($productId)) {
        $sql_productInCart = "SELECT id, productCatalogueId, user_id, product_name, count, price 
        FROM cart";
        $res_productInCart = mysqli_query(connectToSQL(), $sql_productInCart);
    
        while ($productInCartData = mysqli_fetch_assoc($res_productInCart)) {
            if ($productInCartData['productCatalogueId'] == $productId && $productInCartData['user_id'] == $_SESSION['currentUserId']) {
                    $sql_deleteFromCart = "DELETE FROM cart 
                    WHERE id = {$productInCartData['id']}";
                    mysqli_query(connectToSQL(), $sql_deleteFromCart);
                    header('Location:/?page=cart');
                    exit;
            };
        };
    };
};

function clearCart() {
    // надо бы спрашивать, уверен ли пользователь (да и не только здесь), но без js я это не реализую сейчас
    $sql_deleteUsersCart = "DELETE FROM cart WHERE user_id = {$_SESSION['currentUserId']}";
    mysqli_query(connectToSQL(), $sql_deleteUsersCart);
    header('Location:/?page=cart');
    exit;
};
