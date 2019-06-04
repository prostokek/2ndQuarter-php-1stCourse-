<?php
function html() {

};

function addOrder() {
    $_SESSION['msg'] = 'Что-то пошло не так';
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $sql_cart = "SELECT user_id, product_name, count, price
        FROM cart"; // picPath и id вряд ли нужны здесь
        $order_items = array();
        $res_cart = mysqli_query(connectToSQL(), $sql_cart) or die(mysqli_error(connectToSQL()));
        while ($cartProductData = mysqli_fetch_assoc($res_cart)) {
            if ($cartProductData['user_id'] == $_SESSION['currentUserId']) {
                array_push($order_items, $cartProductData);
                // $order_items = $cartProductData; //то же самое, но менее наглядно
            };
        }; // создал массив с корзиной, как у преподователя в сессии
    
        $commentary = clearStr($_POST['commentary']);
        if(!empty($order_items)) {
            $order_items = json_encode($order_items, JSON_UNESCAPED_UNICODE);
            $sql_addOrder = "INSERT INTO orders(user_id, order_items, commentary) 
                            VALUES ({$_SESSION['currentUserId']}, '{$order_items}', '{$commentary}')";
            mysqli_query(connectToSQL(), $sql_addOrder);
            
            $_SESSION['msg'] = 'Ваш заказ принят, его номер -- ' . mysqli_insert_id(connectToSQL());
            header('Location:/?page=orders&func=clearCart');
        } else {
            $_SESSION['msg'] = 'Ваша корзина пуста, заказ не может быть создан';
            header('Location:/?page=cart');
        };
    };
};

function clearCart() {
    $sql_deleteUsersCart = "DELETE FROM cart WHERE user_id = {$_SESSION['currentUserId']}";
    mysqli_query(connectToSQL(), $sql_deleteUsersCart);
    global $returnToLocation;
    header('Location:?page=cart');
    exit;
};
