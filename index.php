<?php 
    $title = '2ndLesson';
    $h1 = 'Второй урок';

    /* ПЕРВОЕ ЗАДАНИЕ */

    $a = 10;
    $b = 20;
    if ($a >0 && $b > 0) {
        $c = $a - $b;
        $result_1 = "Разность a и b = $c"  ;
    } elseif ($a < 0 && $b < 0) {
        $c = $a * $b;
        $result_1 = "Произведение a и b = $c";
    } else {
        $c = $a + $b;
        $result_1 = "Сумма a и b = $c";
    };

    /* /ПЕРВОЕ ЗАДАНИЕ */

    /* ВТОРОЕ ЗАДАНИЕ */
    $z = 7;
    $result_2 = "";
    switch ($z) {
        case 1:
            $result_2 .= "1 ";
        case 2:
            $result_2 .= "2 ";
        case 3:
            $result_2 .= "3 ";
        case 4:
            $result_2 .= "4 ";
        case 5:
            $result_2 .= "5 ";
        case 6:
            $result_2 .= "6 ";
        case 7:
            $result_2 .= "7 ";
        case 8:
            $result_2 .= "8 ";
        case 9:
            $result_2 .= "9 ";
        case 10:
            $result_2 .= "10 ";
        case 11:
            $result_2 .= "11 ";
        case 12:
            $result_2 .= "12 ";
        case 13:
            $result_2 .= "13 ";
        case 14:
            $result_2 .= "14 ";
        case 15:
            $result_2 .= "15 ";
    };

    /* /ВТОРОЕ ЗАДАНИЕ */

    /* ТРЕТЬЕ ЗАДАНИЕ */

    function add($q = 10, $w = 20) {
        return $q + $w;
    };
    function subtract($q = 10, $w = 20) {
        return $q - $w;
    };
    function multiply($q = 10, $w = 20) {
        return $q * $w;
    };
    function divide($q = 10, $w = 20) {
        return $q / $w;
    };

    /* /ТРЕТЬЕ ЗАДАНИЕ */

    /* ЧЕТВЁРТОЕ ЗАДАНИЕ */

    function mathOperation($arg1, $arg2, $operation) {
        switch($operation) {
            case 'add':
                return add($arg1, $arg2);
            case 'subtract':
                return subtract($arg1, $arg2);
            case 'multiply':
                return multiply($arg1, $arg2);
            case 'divide':
                return divide($arg1, $arg2);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> <?php echo($title) ?> </title>
</head>
<body>
    <h1> <?php echo($h1) ?> </h1>
    <article>
        <h3>Первое задание</h3>
        <p><?php echo($result_1); ?></p>
    </article>

    <article>
        <h3>Второе задание</h3>
        <p><?php echo($result_2); ?></p>
    </article>

    <article>
        <h3>Третье задание</h3>
        <p>Используется в четвёртом</p>
    </article>

    <article>
        <h3>Четвёртое задание</h3>
        <p><?php echo(mathOperation(15, 10, 'divide')); ?></p>
    </article>

    <article>
        <h3>Шестое задание</h3>
        <p>

        </p>
    </article>
    <footer>
        <?php echo('Год: ' . date(Y)) ?>
    </footer>
</body>
</html>