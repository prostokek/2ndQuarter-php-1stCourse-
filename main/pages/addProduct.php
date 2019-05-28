<?php
$count_addProduct = 0;
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_SESSION['isAdmin'] == 'YES') {
    if(!empty($_POST['name']) && !empty($_POST['price']) && $_POST['query'] == 'addProduct') {
        $name = clearStr($_POST['name']);
        $price = clearStr($_POST['price']);

        $sql_repeatingProductSearch = "SELECT name FROM products";
        $res_repeatingProductSearch = mysqli_query(connectToSQL(), $sql_repeatingProductSearch) or die(mysqli_error(connectToSQL()));

        while ($productData = mysqli_fetch_assoc($res_repeatingProductSearch)) {
            if ($name === $productData['name']) {
                $count_addProduct++;
            };
        };
        if ($count_addProduct === 0) {
            $fileNameWithDir = PUBLIC_DIR . '/productsPics/' . $_FILES['userFile']['name'];
            copy($_FILES['userFile']['tmp_name'], $fileNameWithDir);
            $fileNameWithDir = str_replace('\\', '/', $fileNameWithDir);
            $fileNameWithDir = str_replace('E:/OSPanel/domains/2ndQuarter-php-1stCourse-', '', $fileNameWithDir);
            $sql_addProduct = "INSERT INTO products(name, price, picPath)
            VALUES ('{$name}', '{$price}', '{$fileNameWithDir}')";
            mysqli_query(connectToSQL(), $sql_addProduct);
        };
    };
    header('Location: /?page=addProduct');
};

$content = <<<php
        <form enctype="multipart/form-data" method='POST'> 
            <input type = 'text' name = 'name' placeholder = 'Название товара'>
            <input type = 'text' name = 'price' placeholder = 'Цена'>
            <input type = 'hidden' name = 'query' value = 'addProduct'>
            <br>
            <input id = "userFile" name = "userFile" type = "file" style="display:none" required>
            <label for = "userFile">Выберите фото товара (кликабельная надпись)</label>
            <br>
            <input type = 'submit' value = 'Добавить продукт'>
        </form>
    </article>
php;
?>