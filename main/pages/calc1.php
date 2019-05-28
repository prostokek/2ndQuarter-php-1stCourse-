<?php
$title = 'Калькулятор 1';
if (!empty($_POST)) {
    $calc_result_addition = 'Результат сложения данных чисел: ' . ((int)$_POST['a'] + (int)$_POST['b']) . '<br>';
    $calc_result_substraction = 'Результат вычитания данных чисел: ' . ((int)$_POST['a'] - (int)$_POST['b']) . '<br>';
    $calc_result_multiplication = 'Результат умножения данных чисел: ' . ((int)$_POST['a'] * (int)$_POST['b']) . '<br>';
    $calc_result_division = 'Результат деления данных чисел: ' . ((int)$_POST['a'] / (int)$_POST['b']) . '<br>';
}


$content = <<<php
    <form method = 'POST'>
        <input type = 'text' name = 'a' placeholder = 'Первое значение'>
        <input type = 'text' name = 'b' placeholder = 'Второе значение'>
        <input type = 'submit' value = 'Посчитать'>
    </form>
    <p>
    {$calc_result_addition}
    {$calc_result_substraction}
    {$calc_result_multiplication}
    {$calc_result_division}
    </p>
php;





?>