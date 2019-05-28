<?php
function varDump($var) { //человеческий вывод var_dump() (не в одну строку)
        static $int=0;
        echo '<pre><b style="background: red;padding: 1px 5px;">'.$int.'</b> ';
        print_r($var);
        echo '</pre>';
        $int++;
    }; 

    /* СОЗДАНИЕ ЛОГОВ */
$date = date(r);
$log_count = (count(scandir(__DIR__ . '/Logs')) - 2);
file_put_contents(__DIR__ . '/Logs/log.txt', "$date" . PHP_EOL, FILE_APPEND);

if(sizeof(file (__DIR__ . '/Logs/log.txt')) > 499) { //количество строк в файле превышает 499 (равняется 500)
    copy(__DIR__ . '/Logs/log.txt', __DIR__ . "/Logs/log$log_count.txt"); //создаём копию под определённым номером
    file_put_contents(__DIR__ . '/Logs/log.txt', ''); //опустошаем
};
    /* /СОЗДАНИЕ ЛОГОВ */


session_start();

const PUBLIC_DIR = __DIR__;
const SALT = 'randomSalt'; // сейчас всё равно значения сложность не имеет //

function connectToSQL() {
    static $link;
    if(empty($link)) {
        $link = mysqli_connect(  //подключаемся к базе данных
            '127.0.0.1:3306', //'2ndQuarter-php-1stCourse-',
            'root', //имя пользователя
            '', // пароль
            '2ndquarter-php-1stcourse-' //название базы данных
        );
    };
    return $link;
};

function clearStr($str) {
    return mysqli_real_escape_string(connectToSQL(), strip_tags(trim($str)));
};
?>