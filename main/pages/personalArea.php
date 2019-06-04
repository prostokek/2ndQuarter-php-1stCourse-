<?php
function html() {
    $title = 'Личный кабинет';

    if ($_SESSION['isLogged'] == 'YES') {
        $sql_userData = "SELECT fio, login FROM users where id = {$_SESSION['currentUserId']}";
        $res_userData = mysqli_query(connectToSQL(), $sql_userData);
        $userData = mysqli_fetch_assoc($res_userData);
        
        $sql_orders = "SELECT id, user_id, order_items, commentary, date, orderStatus
                       FROM orders 
                       WHERE user_id = " . $_SESSION['currentUserId'] .
                       " ORDER BY date DESC ";
        $res_orders = mysqli_query(connectToSQL(), $sql_orders);
        $purchaseHistory = "<h1>Ваша история заказов</h1>";
        while ($orderData = mysqli_fetch_assoc($res_orders)) {
            $orderDate = date('d M Y H ч. i м.', strtotime($orderData['date']));
            $order_items = json_decode($orderData['order_items'], true); // весь массив же ещё перебрать как-то надо
            $cartTotalCost = 0;
            $purchaseHistory .= <<<php
            <h2>Номер заказа -- {$orderData['id']}</h2>
            <h3>Дата создания заказа: {$orderDate}</h3>
            <h4>Товары</h4>
php;
            foreach($order_items as $item_id => $item) {
                $itemTotalCost = $item['count'] * $item['price'];
                $cartTotalCost += $itemTotalCost;
                $purchaseHistory .= <<<php
            <p>
                Название: {$item['product_name']}<br>
                Количество: {$item['count']}<br>
                Цена: {$item['price']}<br>
                Стоимость позиции: {$itemTotalCost} <br>
            </p>
php;
            }; 
            $purchaseHistory .= <<<php
            Комментарий к заказу: {$orderData['commentary']}<br>
            Стоимость заказа: {$cartTotalCost}<br>
            Статус заказа: {$orderData['orderStatus']}<br>
            <a href=?page=personalArea&func=cancelOrder&orderId={$orderData['id']}>Отменить заказ</a><hr>
php;
        };

        $content = <<<php
        <h1>$title</h1>
        <p>Ваш логин: {$userData['login']}</p>
        <p>Добро пожаловать, {$userData['fio']}</p>
        <hr>
        {$purchaseHistory}
php;
    } else {
        $content = <<<php
        <h2>К сожалению, вы ещё не зарегистрированы/залогинены</h2>
        <p>Зарегистрироваться можно <a href=/?page=registrationPage>здесь</a></p>
php;
    };
    $html = [
        'content' => $content,
        'title' => $title
    ];
    return $html;
};

function cancelOrder() {
    $orderId = $_GET['orderId'];
    $sql_orders = "SELECT orderStatus
                   FROM orders 
                   WHERE id = $orderId";
                   $_SESSION['msg'] = $sql_orders;
    $res_orders = mysqli_query(connectToSQL(), $sql_orders);
    $orderStatus = mysqli_fetch_assoc($res_orders);


    if ($orderStatus['orderStatus'] == 'orderAccepted') {
        $sql_cancelOrder = "UPDATE orders 
                            SET orderStatus = 'orderCancelled'
                            WHERE id = $orderId";
        mysqli_query(connectToSQL(), $sql_cancelOrder);
        $_SESSION['msg'] = 'Заказ номер ' . $orderId . ' отменён';
        header('Location:?page=personalArea');
    } else if ($orderStatus['orderStatus'] == 'orderSent') {
        $_SESSION['msg'] = 'Заказ уже отправлен, его нельзя отменить';
        header('Location:?page=personalArea');
    } else if ($orderStatus['orderStatus'] == 'orderPaid') {
        $_SESSION['msg'] = 'Заказ оплачен, для его отмены Вам нужно связаться с администрацией (это пример/заглушка)';
        header('Location:?page=personalArea');
    } else if ($orderStatus['orderStatus'] == 'orderCancelled') {
        $_SESSION['msg'] = "Заказ номер $orderId уже был отменён";
        header('Location:?page=personalArea');
    }; //switch, наверное, был бы к месту, но так мне больше нравится (пока, во всяком случае)
};