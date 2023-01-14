<!DOCTYPE html>
<html lang="en">
<head>
<!-- основные мета-теги -->
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!-- Css Sass для сайта подключаем через public -->
<!-- Подключаем название страницы-->
    <title>@yield('title')</title>
<!-- Иконка сайта ??? -->
    <link rel="icon" href="img/core-img/ksyusha.ico">
<!-- CSS основной стиль со всеми подключенными -->
    <link rel="stylesheet" href="css/core-style.css">
<!-- Куда мы пишем остальные стили -->
    <link rel="stylesheet" href="css/style.css">
    <!-- log-in -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
</head> 
<body>
<!-- подключаем шапку -->
@include('shop.layouts.header')

<!-- подключаем отдельно карзину -->
<!-- @include('shop.layouts.right') -->

<!-- выводим контент страниц -->
@yield('content')
<!-- подключаем футер -->
@include('shop.layouts.footer')
<!-- Js для сайта подключаем через public -->
    <!-- jQuery (Necessary for All JavaScript Plugins) -->
    <script src="js/jquery/jquery-2.2.4.min.js"></script>
    <!-- Popper js -->
    <script src="js/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Plugins js -->
    <script src="js/plugins.js"></script>
    <!-- Classy Nav js -->
    <script src="js/classy-nav.min.js"></script>
    <!-- Active js -->
    <script src="js/active.js"></script>
    <script src="js/app.js"></script>
    <!-- log-in -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>

</html>