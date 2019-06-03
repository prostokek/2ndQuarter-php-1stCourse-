<?php
function html() {
    $title = 'Добавить продукт';
    $content = <<<php
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
    </article>
php;

    $html = [
        'content' => $content,
        'title' => $title
    ];
    // varDump($html);
    return $html;
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
                // $destinationDirectory = __DIR__;
                // echo __DIR__; echo '<br>' . '<br>';
                // $weNeed = 'E:\OSPanel\domains\2ndQuarter-php-1stCourse-\public\productsPics';

                // $destinationDirectory = str_replace('','',);
                $fileNameWithDir = str_replace('\\main\\pages', '/public', (__DIR__ . '/productsPics/')) . $_FILES['userFile']['name'];
                // echo $fileNameWithDir . '<br>' . '<br>';
                copy($_FILES['userFile']['tmp_name'], $fileNameWithDir);

                $fileNameWithDir = str_replace('\\', '/', $fileNameWithDir);
                $fileNameWithDir = str_replace('E:/OSPanel/domains/2ndQuarter-php-1stCourse-/public/', '', $fileNameWithDir);
                // НА СЕРВЕРЕ НУЖНО БУДЕТ ЗАМЕНЯТЬ ДРУГУЮ СТРОКУ (путь же будет другим)
                $sql_addProductToCatalogue = "INSERT INTO products(name, price, picPath)
                VALUES ('{$name}', '{$price}', '{$fileNameWithDir}')";
                echo $sql_addProductToCatalogue;
                // mysqli_query(connectToSQL(), $sql_addProductToCatalogue);
            };
        };
        // header('Location: /?page=addProductToCatalogue');
        // exit; //?
    };
};
