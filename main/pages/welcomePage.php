<?php
function html() {
    $title = 'Главная страница';
    $content = <<<php
    Не знаю, что здесь писать, это главная страница, на которую пользователь попадает без указания параметра \$_GET['page']
php;



    $html = [
        'content' => $content,
        'title' => $title
    ];
    // varDump($html);
    return $html;
}