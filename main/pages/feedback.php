<?php
$title = 'Отзывы';
if(!empty($_POST['nameOfSender']) && !empty($_POST['commentary']) && $_POST['query'] == 'addCommentary') {
    $nameOfSender = clearStr($_POST['nameOfSender']);
    $commentary = clearStr($_POST['commentary']);

    $sql_addCommentary = "INSERT INTO feedback(nameOfSender, commentary)
    VALUES ('{$nameOfSender}', '{$commentary}')";

    mysqli_query(connectToSQL(), $sql_addCommentary);
    header('Location: /?page=feedback');
};

$sql_feedback = "SELECT nameOfSender, commentary, date FROM feedback ORDER BY feedback.date DESC";
$res_feedback = mysqli_query(connectToSQL(), $sql_feedback) or die(mysqli_error(connectToSQL())); //(адрес, запрос) || получили результат запроса || or die(что делать в случае, если нет ничего по адресу)

$feedbackHTML = '';
while ($feedbackData = mysqli_fetch_assoc($res_feedback)) {
    $feedbackDate = date('d M Y H ч. i м.', strtotime($feedbackData['date']));
    $feedbackHTML .= <<<php
    <h2>Имя отправителя: {$feedbackData['nameOfSender']}</h2>
    <p>Отзыв: {$feedbackData['commentary']}</p>
    <p>Дата: {$feedbackDate}</p>
    <hr>
php;
};

$content = <<<php
    <div>
        <h1>Оставить отзыв</h1>
        <form method='POST'>
        <input type = 'text' name = 'nameOfSender' placeholder = 'Имя отправителя'>
        <textarea name = 'commentary' placeholder = 'Отзыв'></textarea>
        <input type = 'hidden' name = 'query' value = 'addCommentary'>
        <input type = 'submit' value = 'Оставить отзыв'>
        </form>
        <h1>Отзывы</h1>
        {$feedbackHTML}
    </div>
php;
?>