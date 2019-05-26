<?php
$count_pics = 0;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fileNameWithDir = PUBLIC_DIR . '/Gallery/' . $_FILES['userFile']['name']; // $fileName = PUBLIC_DIR . '/' . $_POST['fileName'] . '.jpg';
    copy($_FILES['userFile']['tmp_name'], $fileNameWithDir);
    $picName = clearStr($_POST['picName']);
    $fileNameWithDir = str_replace('\\', '/', $fileNameWithDir); // для SQL
    $fileNameWithDir = str_replace('E:/OSPanel/domains/2ndQuarter-php-1stCourse-', '', $fileNameWithDir); // при указании абсолютного пути картинка не отображается в галерее
    
    $sql_picSearch = "SELECT path FROM gallery";
    $res_picSearch = mysqli_query(connectToSQL(), $sql_picSearch) or die(mysqli_error(connectToSQL()));

    // echo $fileNameWithDir;
    while ($picData = mysqli_fetch_assoc($res_picSearch)) {
        // varDump($picData);
        if ($fileNameWithDir == $picData['path']) { //если картинка с таким именем уже существует
            $count_pics++;
        };
    };
    if ($count_pics === 0) {
        $sql_addPic = "INSERT INTO gallery(path, name) 
        VALUES ('{$fileNameWithDir}', '{$picName}')";
        mysqli_query(connectToSQL(), $sql_addPic);
    };
    header('Location: /?page=addPic');
};

$content = <<<php
<form enctype="multipart/form-data" method = "POST">
    <input name = "picName" type = "text" placeholder = "Введите название картинки">
    <input name = "userFile" type = "file">
    <input type = "submit" value = "Отправить файл">
</form>
php;
?>