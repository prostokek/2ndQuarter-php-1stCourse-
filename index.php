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
        'а,' => 'a,', 'б,' => 'b,', 'в,' => 'v,', 'г,' => 'g,', 'д,' => 'd,', 'е,' => 'e,', 'ё,' => 'yo,', 'ж,' => 'zh,', 'з,' => 'z,', 'и,' => 'e,',
        'й,' => 'y,', 'к,' => 'k,', 'л,' => 'l,', 'м,' => 'm,', 'н,' => 'n,', 'о,' => 'о,', 'п,' => 'p,', 'р,' => 'r,', 'с,' => 's,', 'т,' => 't,', 
        'у,' => 'u,', 'ф,' => 'f,', 'х,' => 'h,', 'ц,' => 'c,', 'ч,' => 'ch,', 'ш,' => 'sh,', 'щ,' => "sh',", 'ь,' => "',", 'э,' => 'a,', 'ю,' => 'yu,',
        'я,' => 'ya,', 'ы,' => 'y,'
    ];

    $str_4 = 'Нет фантазии, проверка';
    $res_4 = '';
    foreach($letters as $key => $value) {
        $ruLetters .= $key;
        $enLetters .= $value;
    };

    $ruLetters = explode(",", $ruLetters);
    $enLetters = explode(",", $enLetters);
    
    $res_4 = str_replace($ruLetters, $enLetters, $str_4);

    /* /ЧЕТВЁРТОЕ ЗАДАНИЕ */

    /* ПЯТОЕ ЗАДАНИЕ */

    $str_5 = 'Нет фантазии, проверка';
    $res_5 = str_replace([' '], ['_'], $str_5);

    /* /ПЯТОЕ ЗАДАНИЕ */

    /* ШЕСТОЕ ЗАДАНИЕ */

    $headerNavLinks = [
        'ГЛАВНАЯ', 'НОВОСТИ', 'КОНТАКТЫ', 'СПРАВКА'
    ];
    $headerNavInsideLinks = [
        'НОВОСТИ О СПОРТЕ', 'НОВОСТИ О ПОЛИТИКЕ', 'НОВОСТИ О МИРЕ'
    ];

    $res_6 = '';
    for($s = 0; $s < count($headerNavLinks); $s++) {
        if($headerNavLinks[$s] == 'НОВОСТИ') {
            $res_6 .= "
                <div>
                    <a><span>$headerNavLinks[$s]</span></a>
                    <div>";
            for($h = 0; $h < count($headerNavInsideLinks); $h++) {
                $res_6 .= "<a>$headerNavInsideLinks[$h]</a>";
            }
            $res_6 .= "
                </div>
            </div>";
            
        } else {
            $res_6 .= "
            <div>
                <a><span>$headerNavLinks[$s]</span></a>
            </div>";
        }
    }

    /* /ШЕСТОЕ ЗАДАНИЕ */

    /* СЕДЬМОЕ ЗАДАНИЕ */

    $res_7 = '';
    $regions = [
        'Московская область:' => [
            'Москва', 'Зеленоград', 'Клин'
        ],
        'Ленинградская область:' => [
            'Санкт-Петербург', 'Всеволожск', 'Павловск', 'Kронштадт'
        ],
        'Рязанская область:' => [
            'Рязань', 'Kасимов', 'Сасово'
        ]
        ];
        foreach ($regions as $region => $cities) {
            $res_7 .= "$region<br>";
            for($y = 0; $y < count($cities); $y++) {
                if ($cities[$y][0] == 'K') {
                    if($y == (count($cities) - 1)) {
                        $res_7 .=  "$cities[$y];<br>";
                    } else {
                        $res_7 .=  "$cities[$y], ";
                    }
                }
            }
        };

    /* /СЕДЬМОЕ ЗАДАНИЕ */
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
	@import url(https://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic);
* {
		margin: 0;
		padding: 0;
		box-sizing: border-box;
}

body {
		font-family: 'Roboto', Arial, sans-serif;
		background-color: #ebebeb;
		overflow-x: hidden;
		text-align: center;
}

header {
		width: 100%;
		height: 50px;
		background-color: #f44355;
		box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
}

header > nav > div {
		float: left;
		width: 16.6666%;
		height: 100%;
		position: relative;
}

header > nav > div > a {
		text-align: center;
		width: 100%;
		height: 100%;
		display: block;
		line-height: 50px;
		color: #fbfbfb;
		transition: background-color 0.2s ease;
		text-transform: uppercase;
}

header > nav > div:hover > a {
		background-color: rgba(0, 0, 0, 0.1);
		cursor: pointer;
}

header > nav > div > div {
		display: none;
		overflow: hidden;
		background-color: white;
		min-width: 200%;
		position: absolute;
		box-shadow: 0 10px 20px rgba(0, 0, 0, 0.19), 0 6px 6px rgba(0, 0, 0, 0.23);
		padding: 10px;
}

header > nav > div:not(:first-of-type):not(:last-of-type) > div {
		left: -50%;
		border-radius: 0 0 3px 3px;
}

header > nav > div:first-of-type > div {
		left: 0;
		border-radius: 0 0 3px 0;
}

header > nav > div:last-of-type > div {
		right: 0;
		border-radius: 0 0 0 3px;
}

header > nav > div:hover > div {
		display: block;
}

header > nav > div > div > a {
		display: block;
		float: left;
		padding: 8px 10px;
		width: 46%;
		margin: 2%;
		text-align: center;
		background-color: #f44355;
		color: #fbfbfb;
		border-radius: 2px;
		transition: background-color 0.2s ease;
}

header > nav > div > div > a:hover {
		background-color: #212121;
		cursor: pointer;
}

h1 {
		margin-top: 100px;
		font-weight: 100;
}

p {
		color: #aaa;
		font-weight: 300;
}

@media (max-width:600px) {
		header > nav > div > div > a {
				margin: 5px 0;
				width: 100%;
		}
		header > nav > div > a > span {
				display: none;
		}
}
	</style>
    <title><?php echo($title);?></title>
</head>
<body>
    
<header><nav><?php echo($res_6);?></nav></header>

<h1> <?php echo($h1);?> </h1>

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

    <article>
        <h3>Четвёртое задание</h3>
        <p><?php echo($res_4); ?></p>
    </article>

    <article>
        <h3>Пятое задание</h3>
        <p><?php echo($res_5); ?></p>
    </article>

    <article>
        <h3>Седьмое задание</h3>
        <p><?php echo($res_7); ?></p>
    </article>
    
    <footer>
        <?php echo('Год: ' . date(Y)) ?>
    </footer>
</body>
</html>