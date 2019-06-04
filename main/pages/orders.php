<?php
function html() {
    if ($_SESSION['isAdmin'] == 'YES') {
        $title = 'История заказов';
        $sql_orders = "SELECT id, user_id, order_items, commentary, date, orderStatus
                       FROM orders 
                       ORDER BY date DESC";
        $res_orders = mysqli_query(connectToSQL(), $sql_orders);
        $content = "<h1>{$title}</h1>";
        while ($orderData = mysqli_fetch_assoc($res_orders)) {
            $orderDate = date('d M Y H ч. i м.', strtotime($orderData['date']));
            $order_items = json_decode($orderData['order_items'], true); // весь массив же ещё перебрать как-то надо
            $cartTotalCost = 0;
            $content .= <<<php
            <h2>Номер заказа -- {$orderData['id']}</h2>
            <h3>Дата создания заказа: {$orderDate}</h3>
            <h3>Комментарий к заказу</h3>
            <p>{$orderData['commentary']}</p>
            <div>
                <h3>Статус заказа: {$orderData['orderStatus']}</h3>
                <h4>Изменить статус заказа</h4>
                <a href=?page=orders&func=changeOrderStatus&updatedOrderStatus=orderPaid&orderId={$orderData['id']}>Заказ оплачен</a>
                <a href=?page=orders&func=changeOrderStatus&updatedOrderStatus=orderSent&orderId={$orderData['id']}>Заказ отправлен</a>
                <a href=?page=orders&func=changeOrderStatus&updatedOrderStatus=orderCancelled&orderId={$orderData['id']}>Заказ отменён</a>
            </div>
            <h4>Товары</h4>
php;
            foreach($order_items as $item_id => $item) {
                $itemTotalCost = $item['count'] * $item['price'];
                $cartTotalCost += $itemTotalCost;
                $content .= <<<php
            <p>
                Название: {$item['product_name']}<br>
                Количество: {$item['count']}<br>
                Цена: {$item['price']}<br>
                Стоимость позиции: {$itemTotalCost}
            </p>
php;
            }; 
            $content .= "Стоимость заказа: {$cartTotalCost}<hr>";    
        };
        $html = [
            'content' => $content,
            'title' => $title
        ];
        return $html;
    } else {
        header('Location: /' . $_SERVER['HTTP_REFERER']);
        exit;
    };
};

function addOrder() {
    $_SESSION['msg'] = 'Что-то пошло не так';
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $sql_cart = "SELECT user_id, product_name, count, price
        FROM cart";
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

function changeOrderStatus() {
    $orderStatus = $_GET['updatedOrderStatus'];
    $orderId = $_GET['orderId'];
    $sql_updateOrderStatus = "UPDATE orders 
                              SET orderStatus = '{$orderStatus}'
                              WHERE id = $orderId";
    mysqli_query(connectToSQL(), $sql_updateOrderStatus);
    $_SESSION['msg'] = 'Статус заказа номер ' . $orderId . ' изменён на: ';
    switch($orderStatus) {
        case 'orderPaid': $_SESSION['msg'] .= '"Заказ оплачен"'; break;
        case 'orderSent': $_SESSION['msg'] .= '"Заказ отправлен"'; break;
        case 'orderCancelled': $_SESSION['msg'] .= '"Заказ отменён"'; break;
    }
    header('Location:?page=orders');
};
