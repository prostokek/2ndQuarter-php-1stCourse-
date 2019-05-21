<?php
if(!empty($_GET['pathToPic'])) {
    $pathToPic = "/Gallery/{$_GET['pathToPic']}";
    $name = $_GET['name'];
    $sql_insert = "INSERT INTO gallery (path, name) 
    VALUES ('{$pathToPic}', '{$name}')";
    mysqli_query($link, $sql_insert);
    // header('Location: /addPic.php');
};
?>
    <form>
        <input type = 'text' name='pathToPic' placeholder = 'Путь до картинки'>
        <input type = 'text' name='name' placeholder = 'Название картинки'>
        <input type = 'submit'>
    </form>