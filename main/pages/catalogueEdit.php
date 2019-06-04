<?php
function html() {
    if($_SESSION['isAdmin'] == 'YES') {
        $title = 'Редактирование каталога';
        $sql_catalogue = "SELECT id, name, price, picPath, info FROM products"; 

        $res_catalogue = mysqli_query(connectToSQL(), $sql_catalogue) or die(mysqli_error(connectToSQL())); //(адрес, запрос) || получили результат запроса || or die(что делать в случае, если нет ничего по адресу)

        $catalogue = '';
        while ($productData = mysqli_fetch_assoc($res_catalogue)) {
            $catalogue .= <<<php
            <h2>{$productData['name']}</h2>
            <h3>Цена: \${$productData['price']}</h3>
            <img src="{$productData['picPath']}" width=200px">
            <p>{$productData['info']}</p>
            <a href=?page=catalogueEdit&func=archiveProduct&productId={$productData['id']}>Заархивировать продукт</a>
            <a href=?page=catalogueEdit&func=unarchiveProduct&productId={$productData['id']}>Разархивировать продукт</a>
            <hr>
php;
        };

        $content = <<<php
            <div>
                <h1>$title</h1>
                {$catalogue}
            </div>
            <form enctype="multipart/form-data" action='?page=addProductToCatalogue&func=addProductToCatalogue' method='POST'> 
                <input type = 'text' name = 'name' placeholder = 'Название товара'>
                <input type = 'text' name = 'price' placeholder = 'Цена'>
                <input type = 'hidden' name = 'query' value = 'addProductToCatalogue'>
                <br>
                <input id = "userFile" name = "userFile" type = "file" style="display:none" required>
                <label for = "userFile">Выберите фото товара (кликабельная надпись)</label>
                <br>
                <input type = 'submit' value = 'Добавить продукт'>
            </form>
php;

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

function addProductToCatalogue() {
    $count_addProductToCatalogue = 0;
    if ($_SESSION['isAdmin'] == 'YES') {
        if(!empty($_POST['name']) && !empty($_POST['price'])) {
            $name = clearStr($_POST['name']);
            $price = clearStr($_POST['price']);

            $sql_repeatingProductSearch = "SELECT name FROM products";
            $res_repeatingProductSearch = mysqli_query(connectToSQL(), $sql_repeatingProductSearch) or die(mysqli_error(connectToSQL()));

            while ($productData = mysqli_fetch_assoc($res_repeatingProductSearch)) {
                if ($name === $productData['name']) {
                    $count_addProductToCatalogue++;
                };
            };
            if ($count_addProductToCatalogue === 0) {
                $fileNameWithDir = str_replace('\\main\\pages', '/public', (__DIR__ . '/productsPics/')) . $_FILES['userFile']['name'];
                copy($_FILES['userFile']['tmp_name'], $fileNameWithDir);

                $fileNameWithDir = str_replace('\\', '/', $fileNameWithDir);
                $fileNameWithDir = str_replace('E:/OSPanel/domains/2ndQuarter-php-1stCourse-/public/', '', $fileNameWithDir);
                // НА СЕРВЕРЕ НУЖНО БУДЕТ ЗАМЕНЯТЬ ДРУГУЮ СТРОКУ (путь же будет другим)
                $sql_addProductToCatalogue = "INSERT INTO products(name, price, picPath)
                VALUES ('{$name}', '{$price}', '{$fileNameWithDir}')";
                mysqli_query(connectToSQL(), $sql_addProductToCatalogue);
            };
        };
        header('Location: /?page=catalogueEdit');
        exit;
    };
};

function archiveProduct() {
    $productId = $_GET['productId'];
    $sql_archiveProduct = "UPDATE products 
                           SET isArchived = 'YES' 
                           WHERE id = $productId";
    mysqli_query(connectToSQL(), $sql_archiveProduct);
    $_SESSION['msg'] = "Продукт с id = $productId заархивирован";
    header('Location:/?page=catalogueEdit');
};

function unarchiveProduct() {
    $productId = $_GET['productId'];
    $sql_unarchiveProduct = "UPDATE products 
                           SET isArchived = 'NO' 
                           WHERE id = $productId";
    mysqli_query(connectToSQL(), $sql_unarchiveProduct);
    $_SESSION['msg'] = "Продукт с id = $productId разархивирован";
    header('Location:/?page=catalogueEdit');
};