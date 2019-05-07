<?php 
    $title = 'Третий урок';
    $h1 = 'Третий урок';

    /* ПЕРВОЕ ЗАДАНИЕ */

    $i = 0;
    $res_1 = "";
    while ($i < 100) {
        $i++;
        if($i % 3 == 0) {
            $res_1 .= ($i . " ");
        }
    }

    /* /ПЕРВОЕ ЗАДАНИЕ */

    /* ВТОРОЕ ЗАДАНИЕ */

    $z = 0;
    $res_2 = "0 -- ноль; <br>";
    do {
        $z++;
        if($z % 2 == 0) {
            $res_2 .= $z . " -- чётное число;<br>";
        } else {
            $res_2 .= $z . " -- нечётное число;<br>";
        }
    } while ($z < 10);

    /* /ВТОРОЕ ЗАДАНИЕ */

    /* ТРЕТЬЕ ЗАДАНИЕ */
    $res_3 = '';
    $regions = [
        'Московская область:' => [
            'Москва', 'Зеленоград', 'Клин'
        ],
        'Ленинградская область:' => [
            'Санкт-Петербург', 'Всеволожск', 'Павловск', 'Кронштадт'
        ],
        'Рязанская область:' => [
            'Рязань', 'Касимов', 'Сасово'
        ]
        ];
        foreach ($regions as $region => $cities) {
            $res_3 .= "$region<br>";
            for($y = 0; $y < count($cities); $y++) {
                if($y == (count($cities) - 1)) {
                    $res_3 .=  "$cities[$y];<br>";
                } else {
                    $res_3 .=  "$cities[$y], ";
                }
            }
        };

    /* ТРЕТЬЕ ЗАДАНИЕ */

    /* ЧЕТВЁРТОЕ ЗАДАНИЕ */

    $letters = [
        'a' => 'а', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'ж' => 'zh', 'з' => 'z', 'и' => 'e', 'й' => 'y',
        'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'о', 'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', ' ' => ' ',
        'х' => 'h', 'ц' => 'c', 'ч' => 'ch', 'ш' => 'sh', 'щ' => "sh'", 'ь' => "'", 'э' => 'a', 'ю' => 'yu', 'я' => 'ya', 'ы' => 'y', 'ъ' => '',
    ];

    $str_4 = 'Нет фантазии';
    $res_4 = '';
    // foreach($letters as $key => $value) {
    //     var_dump($key);
    //     var_dump($value);
    //     $res_4 = str_replace($key, $value, $str_4);
    // };
    foreach($letters as $key => $value) {
        $ruLetters .= $key;
        $enLetters .= $value;
    };
    var_dump($ruLetters);
    var_dump($enLetters);

    
    for($g = 0; $g < count($letters); $g++) {
        $res_4 = str_replace($ruLetters[$g], $enLetters[$g], $str_4);
    };
    

    echo $res_4;
    /* /ЧЕТВЁРТОЕ ЗАДАНИЕ */
?>

<!DOCTYPE html>
<html lang="ru">
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
        <p><?php echo($res_1); ?></p>
    </article>

    <article>
        <h3>Второе задание</h3>
        <p><?php echo($res_2); ?></p>
    </article>

    <article>
        <h3>Третье задание</h3>
        <p><?php echo($res_3); ?></p>
    </article>
    
    <footer>
        <?php echo('Год: ' . date(Y)) ?>
    </footer>
</body>
</html>