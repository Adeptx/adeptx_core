<h1>jQuery scrollBottom</h1>

<p>В jQuery есть $(window).scrollTop() но нет $(window).scrollBottom()

<p>Решается просто:

<p><pre>var scrollBottom = $(window).scrollTop() + $(window).height();</pre>

<p>Дата: 28.08.2014

<p>Источник: http://itman.in/jquery-scrollbottom/