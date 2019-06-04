<?php
function html() {
    $title = 'Личный кабинет';
    $sql_userData = "SELECT fio, login FROM users where id = {$_SESSION['currentUserId']}";
    $res_userData = mysqli_query(connectToSQL(), $sql_userData);
    $userData = mysqli_fetch_assoc($res_userData);
    // varDump($userData);

    if ($_SESSION['isLogged'] == 'YES') {
        $sql_orders = "SELECT id, user_id, order_items, commentary, date 
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
                Стоимость позиции: {$itemTotalCost}
            </p>
php;
            }; 
            $purchaseHistory .= "Стоимость заказа: {$cartTotalCost}<hr>";    
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
