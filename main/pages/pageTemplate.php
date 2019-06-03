<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="./js/catalogue_AddingToCart.js"></script> <!-- Логично подключать это на странице каталога -->
    <title>{TITLE}</title>
</head>
<body>
    <h1>{TITLE}</h1>
    <h1>НЕКОТОРЫЕ СТРАНИЦЫ ДОСТУПНЫ ТОЛЬКО АДМИНИСТРАЦИИ</h1>
    <p>{AUTH_MSG}</p>
    <p>{DEBUGMSG}</p>

    <aside style='float: left; width:20%'>
    {HEADER_MENU}
    </aside>

    <main style='float: right; width: 80%'>{CONTENT}</main>
    <br>
    <div style='float: right'></div>
    {FOOTER}
</body>
</html>