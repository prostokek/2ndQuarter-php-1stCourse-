<!DOCTYPE html>
<html lang="en">
    <?php 
    $title = '1stLesson';
    $h1 = 'Первый урок'
    ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> <?php echo($title) ?> </title>
</head>
<body>
    <h1> <?php echo($h1) ?> </h1>
    <article>
        <h3>Третье задание.</h3>
        <p> 1) "var_dump($a == $b);" равняется True, так как при таком сравнении (с двумя знаками равенства) происходит приведение типов; <br>
            2) "var_dump((int)'012345');" равняется 12345, так как функция (?) (int) приводит к целочисленному типу данных; <br>
            3) "var_dump((float)123.0 === (int)123.0);" равняется false, так как при таком сравнении (3 знака равенства) не происходит приведения типов ((float)123.0 вернёт переменную дробночисленного типа, (int)123.0 -- целочисленного); <br>
            4) "var_dump((int)0 === (int)'hello, world');", равняется true, так как "(int)'hello, world'" возвращает переменную целочисленного типа с значением 0.
        </p>
    </article>
    <footer>
        <?php echo('Год: ' . date(Y)) ?>
    </footer>
</body>
</html>