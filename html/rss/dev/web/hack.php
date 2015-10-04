<h1>jQuery scrollBottom</h1>

<p>В jQuery есть $(window).scrollTop() но нет $(window).scrollBottom()

<p>Решается просто:
var scrollBottom = $(window).scrollTop() + $(window).height();

<p>Дата: 28.08.2014

<p>Источник: http://itman.in/jquery-scrollbottom/