<?php
$title = 'Калькулятор 2';
if (isset($_POST['a']) && isset($_POST['b']) && isset($_POST['operation'])) {
    $calc_result_addition = 'Результат сложения данных чисел: ' . ((int)$_POST['a'] + (int)$_POST['b']) . '<br>';
    $calc_result_substraction = 'Результат вычитания данных чисел: ' . ((int)$_POST['a'] - (int)$_POST['b']) . '<br>';
    $calc_result_multiplication = 'Результат умножения данных чисел: ' . ((int)$_POST['a'] * (int)$_POST['b']) . '<br>';
    $calc_result_division = 'Результат деления данных чисел: ' . @((int)$_POST['a'] / (int)$_POST['b']) . '<br>';
    switch ($_POST['operation']) {
        case 'addition': $calc2_res = $calc_result_addition; break;
        case 'substraction': $calc2_res = $calc_result_substraction; break;
        case 'multiplication': $calc2_res = $calc_result_multiplication; break;
        case 'division':  
        if((int)$_POST['b'] === 0) {
            $calc2_res = 'Ошибка. Вы попытались разделить на ноль';
        } else {
            $calc2_res = $calc_result_division;
        }; break;
    };
};

$content = <<<php
    <form method = 'POST'>
        <input type = 'text' name = 'a' placeholder = 'Первое значение'>
        <input type = 'text' name = 'b' placeholder = 'Второе значение'>
        <p><input type="radio" name = 'operation' value = 'addition'>Сложить</p>
        <p><input type="radio" name = 'operation' value = 'substraction'>Вычесть</p>
        <p><input type="radio" name = 'operation' value = 'multiplication'>Умножить</p>
        <p><input type="radio" name = 'operation' value = 'division'>Разделить</p>
        <input type = 'submit' value = 'Посчитать'>
    </form>
    <p>
    {$calc2_res}
    </p>
php;
?>