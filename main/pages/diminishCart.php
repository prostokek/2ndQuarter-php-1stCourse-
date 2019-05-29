<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['query'][1] === 'diminishCart') {
    $productId = $_POST['productId'];
    $sql_findProduct = "SELECT count, product_id
                        FROM cart WHERE id = $productId";
    $res_findProduct = mysqli_query(connectToSQL(), $sql_findProduct);
    $productData = mysqli_fetch_assoc($res_findProduct);

    $productUpdatedCount = $productData['count'] - 1;
    $sql_diminishCart = "UPDATE cart 
                         SET count = $productUpdatedCount
                         where id = $productId";

    mysqli_query(connectToSQL(), $sql_diminishCart);
    echo $sql_diminishCart;
    // header('Location:' . $_SERVER['HTTP_REFERER']);
};