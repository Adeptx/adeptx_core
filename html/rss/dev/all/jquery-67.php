<h1>Как сделать ваш скрипт jQuery на 67% эффективнее</h1>

<div class="new">
<p>13.01.2012 | Автор: <span class="red">Scott Kosman</span>
							 <a xmlns:common="http://www.klarnet.ru/XSLT/functions" class="not-for-print to_print_link" title="" href="javaScript:;"><img src="http://st.cmsmagazine.ru/img/print.gif"></a></p>
<p><img src="http://www.cmsmagazine.ru/img_out/articles_elements/uploadmo7hvqfyw7.jpg" class="user_img_style_left_top fl" style="max-width: 200px"></p><p><i>Интересный факт: </i><a title="http://appendto.com/jquery-overtakes-flash" target="_blank" href="http://appendto.com/jquery-overtakes-flash"><i>jQuery в настоящий момент используется на сайтах гораздо чаще, чем Flash</i></a><i>.</i></p>
<p>jQuery — это удивительный инструмент, позволяющий разработчикам и дизайнерам работать с JavaScript без особых навыков . Однако, как учил нас Спайдермен, «с большой силой приходит большая ответственность». Главный недостаток jQuery в том, что несмотря на то, что он упрощает работу с JavaScript, все равно можно написать самый настоящий го#%!код. Скрипт, который будет тормозить загрузку страницы и увеличивать время отклика интерфейса, и будет запутан такими узлами спагетти, что следующему невезучему разработчику будет не обойтись без бутылки виски.</p>
<p class="cb">Задача становится еще сложнее для тех из нас, кто еще не переехал в волшебную сказочную страну чудес, где ни один из наших клиентов не использует для просмотра страниц Internet Explorer — скорость JavaScript движка IE сравнима со скоростью движения ледника, и не идет в сравнение с другими современными браузерами. Поэтому оптимизация производительности нашего кода становится делом еще более важным.</p>
<p>К счастью, существует несколько очень простых вещей, которые каждый может добавить в собственный рабочий процесс jQuery и решить множество базовых проблем. Анализируя различные образцы кода, я выделил три основных области, в которых мне постоянно встречаются самые серьезные проблемы: неэффективные селекторы, слабое делегирование событий и неуклюжая DOM манипуляция. Мы разберем каждую из них, и вы, я надеюсь, тоже извлечете пользу и сможете применить эти решения в своем следующем проекте.</p>
<h3><strong>Оптимизация селектора</strong></h3>
<p><strong>Скорость селектора: высокая или низкая?</strong></p>
<p>Сказать, что сила jQuery кроется в его способности выбирать DOM элементы и управлять ими — это то же самое, что утверждать, будто Photoshop — великолепный инструмент для выделения пикселей на экране и изменении из цвета. И то и другое — чудовищное упрощение, но факт остается фактом. jQuery дает нам множество способов выбора с каким элементом или элементами страницы мы хотим работать. Однако, удивительно большое число веб-разработчиков не знают, что селекторы не созданы идентичными; на самом деле, просто невероятно, насколько существенно может различаться производительность двух селекторов, которые на первый взгляд кажутся почти одинаковыми. К примеру, взглянем на эти два способа выбора всех тегов параграфов внутри <b>&lt;div&gt;</b> с помощью ID.</p>
<pre style="margin-left: 40px">$("#id p");<br>$("#id").find("p");</pre>
<p>Удивит ли вас то, что второй способ более чем в два раза быстрее первого? Знание того, какие селекторы (и почему) превосходят остальные в производительности, является идеальным строительным блоком уверенности в том, что код работает без проблем и не изматывает ваших пользователей необходимостью ожидать выполнения каждой команды.</p>
<p>Существует множество различных способов выборки элементов с использованием jQuery, но, среди наиболее распространенных, можно выделить пять методов. Выстроив их, строго говоря, в порядке от самого быстрого к самому медленному мы получим следующее:</p>
<pre style="margin-left: 40px">$("#id");</pre>
<p>Это, вне всяких сомнений, быстрейший селектор jQuery, он работает напрямую с исходным <b>document.getElementbyld()</b> методом JavaScript. По возможности, селекторы, следующие за выбранным, должны предваряться <nobr>ID-селектором</nobr> в сочетании с методом jQuery <strong>.find()</strong>, дабы ограничить объем страницы, на которой должен вестись поиск (как и в случае <b>$("#id").find("p")</b> продемонстрированным выше).</p>
<pre style="margin-left: 40px">$("p"); , $("input"); , $("form"); и тому подобные</pre>
<p>Также быстро выбирают элементы по тегу имени, так как метод ссылается на оригинальный <b>document.getElementsByTagname()</b>.</p>
<pre style="margin-left: 40px">$(".class");</pre>
<p>Выбор по имени класса немного более сложен. Хотя он до сих пор достаточно хорошо выполняется в современных браузерах, метод может вызвать значительное замедление работы IE8 и ниже. Почему? IE9 был первой версией IE поддерживавшей родной JavaScript метод <b>document.getElementsByClassName()</b>. Старым браузерам приходится прибегать к гораздо более медленному методу DOM-поиска, способному значительно ухудшить производительность.</p>
<pre style="margin-left: 40px">$("[attribute=value]");</pre>
<p>Для этого селектора не существует родного метода JavaScript, поэтому единственный способ, которым jQuery может его выполнить — проползти через весь DOM в поисках совпадений. Современные браузеры, которые поддерживают метод <b>querySelectorAll()</b>, в ряде случаев сделают это чуть лучше (Opera, по сравнению с другими, выполняет этот вид поиска в особенности быстро), но, говоря начистоту, этот селектор просто Медлен Медленовский.</p>
<pre style="margin-left: 40px">$(":hidden");</pre>
<p>Как селектору атрибутов, ему не соответствует ни один из родных методов JavaScript. Псевдоселекторы могут быть мучительно медленными, так как селектор должен обследовать каждый элемент в выделенном пространстве поиска. Опять же, современные браузеры с <b>querySelectorAll()</b> могут делать это чуть лучше, но постарайтесь все же избегать его по возможности. Если же вам без него не обойтись, попробуйте хотя бы ограничить зону поиска до определенного участка страницы с помощью: <b>$("#list").find(":hidden");</b></p>
<p>Но — эй! — все доказывается тестами производительности, ведь так? И доказательство находится <a title="http://jsperf.com/id-vs-class-vs-tag-selectors/2" target="_blank" href="http://jsperf.com/id-vs-class-vs-tag-selectors/2">прямо здесь</a>. Сравните селекторы классов в IE7 или 8 с остальными браузерами, а потом удивляйтесь, как люди из Microsoft, работающие над IE, могут спокойно спать по ночам...</p>
<p><strong>Цепочки</strong></p>
<p>Практически все методы jQuery возвращают jQuery объекты. Это означает, что во время выполнения метода его результаты возвращаются, и вы можете продолжить проводить над ними большее число операций. Вместо написания одного и того же селектора несколько раз, просто выберите несколько действий, которые необходимо произвести с ним.</p>
<p><strong>Без</strong> <strong>цепочек</strong></p>
<pre style="margin-left: 40px">$("#object").addClass("active");
$("#object").css("color","#f0f");
$("#object").height(300);</pre>
<p><strong>С</strong> <strong>цепочками</strong></p>
<pre style="margin-left: 40px">$("#object").addClass("active").css("color", "#f0f«).height(300);</pre>
<p>Получаем двойной эффект — ваш код становится одновременно короче и быстрее. Объединенные в цепочки методы будут чуть быстрее, чем множественные, проводимые с кэшированным селектором, и оба будут много более быстрыми, нежели множественные методы, проводимые с некэшированными селекторами. Подождите... «Кэшированные селекторы»? Что это за дьявольщина?</p>
<p><strong>Кэширование</strong></p>
<p>Другой простой способ (который, по всей видимости, тоже является тайной для разработчиков) ускорить работу вашего кода — это идея кэширования селекторов. Подумайте о том, как часто вам порой приходилось писать один и тот же селектор снова и снова в своем проекте. Каждый селектор <b>$(".element")</b> должен обыскивать весь DOM каждый раз снова, не зависимо от того, сколько раз он был запущен до этого. Проведение выборки один раз и сохранение полученного результата в переменной означает, что поиск в DOM должен проводиться лишь один раз. Как только результат селектора будет кэширован, вы сможете делать с ним что угодно.</p>
<p>Во-первых, начните свой поиск (здесь мы выбираем все элементы <b>&lt;li&gt;</b> внутри <b>&lt;ul id="blocks"&gt;</b>):</p>
<pre style="margin-left: 40px">var blocks = $("#blocks").find("li");</pre>
<p>Теперь вы можете использовать переменную <b>blocks</b> где угодно без необходимости обыскивать DOM каждый раз.</p>
<pre style="margin-left: 40px">$("#hideBlocks").click(function() {
    blocks.fadeOut();
});</pre>
<pre style="margin-left: 40px">$("#showBlocks").click(function() {
    blocks.fadeIn();
});</pre>
<p>Мой совет? Любой селектор, выполняемый более одного раза, должен быть кэширован. Этот <a title="http://jsperf.com/ns-jq-cached/3" target="_blank" href="http://jsperf.com/ns-jq-cached/3">jsperf тест</a> демонстрирует, насколько быстро работает кэшированный селектор по сравнению с некэшированным (и вдобавок демонстрирует работу цепочек).</p>
<h3><strong>Делегирование событий</strong></h3>
<p>Даже обработчики событий занимают память. В сложных веб-сайтах и приложениях довольно часто можно видеть множество обработчиков и, к счастью, jQuery предоставляет ряд по-настоящему простых методов для эффективной обработки их путем делегирования.</p>
<p>Немного экзотичный пример — представьте себе ситуацию, когда таблица 10×10 ячеек должна иметь обработчик событий в каждой из них. Предположим, что щелчок по ячейке прибавляет или отнимает класс, определяющий цвет ее фона. Типичный метод, которым это может быть осуществлено (и с которым мне часто приходилось встречаться в образцах) выглядит следующим образом:</p>
<pre style="margin-left: 40px">$(’table’).find(’td’).click(function() {<br>    $(this).toggleClass(’active’);<br>});</pre>
<p>jQuery 1.7 предоставляет нам новый метод — обработчик событий <a title="http://api.jquery.com/on" target="_blank" href="http://api.jquery.com/on/"><b>.on()</b></a>. Он действует как утилита, которая объединяет все предыдущие обработчики событий в один удобный метод, и то, как вы его вписываете, определяет, как он должен себя вести. Чтобы переписать <b>.click()</b> в примере выше с использованием <b>.on()</b>, мы просто должны сделать следующее:</p>
<pre style="margin-left: 40px">$(’table’).find(’td’).on(’click’,function() {<br>    $(this).toggleClass(’active’);<br>});</pre>
<p>Довольно просто, правда? Конечно, но проблема здесь в том, что мы по-прежнему привязываем сто обработчиков к одной странице, по одному для каждой из ячеек таблицы. Гораздо лучшим способом было бы создание единственного обработчика событий в таблице, который следил бы за всеми событиями внутри нее. Так как большая часть событий охватывает дерево DOM, мы можем привязать один обработчик к одному элементу (в данном случае <b>&lt;table&gt;</b>) и ждать событий в дочерних элементах. Чтобы сделать это с помощью метода .on(), достаточно внести лишь одно изменение в пример выше:</p>
<pre style="margin-left: 40px">$(’table’).on(’click’,’td’,function() {<br>    $(this).toggleClass(’active’);<br>});</pre>
<p>Все, что мы сделали, это передвинули <b>td</b>-селектор в аргумент внутри метода <b>.on()</b>. Присоединив селектор к <b>.on()</b> мы перевели его в режим делегирования и теперь событие действует лишь на дочерние элементы нашего (<b>table</b>), которые соответствуют селектору (<b>td</b>). Благодаря этому простому изменению мы можем использовать всего один обработчик событий вместо сотни. Вы, наверное думаете, как здорово, что теперь браузеру придется выполнять в сто раз меньшую работу — и будете абсолютно правы. <a title="http://jsperf.com/jquery-event-delegation" target="_blank" href="http://jsperf.com/jquery-event-delegation">Разница между двумя примерами выше</a> ошеломляюща.</p>
<p>(Заметьте, что если ваш сайт использует jQuery более ранней, нежели 1.7, версии, вы можете выполнить те же действия, используя метод <a title="http://api.jquery.com/delegate/" target="_blank" href="http://api.jquery.com/delegate/">.delegate()</a>. Синтаксис вашего кода будет несколько отличаться от нашего; если вы никогда прежде не делали ничего подобного, вам стоит ознакомиться с API документацией, дабы разобраться, как это работает.)</p>
<h3><strong>Манипуляции с DOM</strong></h3>
<p>jQuery позволяет легко манипулировать DOM. Очень просто создавать новые узлы, вставлять одни, удалять другие, перемещать их и так далее. Хотя сам код пишется легко, во время каждой манипуляции с DOM браузер должен перерисовывать и перегруппировывать контент, что может быть весьма ресурсоемким процессом. В особенности это касается длинных циклов, будь то стандартный цикл <b>for()</b>, цикл <b>while()</b> или jQuery цикл <b>$.each()</b>.</p>
<p>Предположим, что мы только что получили массив, переполненный URL ссылками на изображения из базы данных или Ajax-вызов, или что угодно — и мы хотим поместить все эти изображения в неупорядоченный список. Обычно вы видите код вроде этого:</p>
<pre style="margin-left: 40px">var arr = [reallyLongArrayOfImageURLs];<br>$.each(arr, function(count, item) {<br>    var newImg = ’&lt;li&gt;&lt;img src="’+item+’"&gt;&lt;/li&gt;’;<br>    $(’#imgList’).append(newImg);<br>});</pre>
<p>Но здесь есть несколько проблем. Для начала (и вы, вероятно, уже заметили это — если внимательно читали статью) мы делаем выборку через <b>$("#imgList")</b> на каждом этапе нашего цикла. Другой проблемой здесь является то, что при каждом повторении цикла он добавляет новый <b>&lt;li&gt;</b> к DOM. Каждая из этих итераций дорого нам обойдется и, если наш массив достаточно велик, это может привести к серьезному замедлению работы или даже зловещему предупреждению «A script is causing this page to run slowly» («Скрипт замедляет работу страницы»).</p>
<pre style="margin-left: 40px">var arr = [reallyLongArrayOfImageURLs],<br>tmp = ’’;<br>$.each(arr, function(count, item) {<br>    tmp += ’&lt;li&gt;&lt;img src="’+item+’"&gt;&lt;/li&gt;’;<br>    });<br>$(’#imgList’).append(tmp);</pre>
<p>Все, что мы сделали здесь — создали переменную tmp к которой добавляется каждый новый из вновь создаваемых <b>&lt;li&gt;</b>. Когда наш цикл завершит работу, переменная tmp будет содержать в памяти весь список элементов и сможет быть приложена к нашему <b>&lt;ul&gt;</b> за один раз. С объектами в памяти браузеры работают намного быстрее, чем с теми, что на экране, поэтому данный метод построения списка много более быстрый и дружественный центральному процессору.</p>
<h3><strong>Заключение</strong></h3>
<p>Это далеко не все способы улучшения вашего jQuery кода, но, определенно, одни из наиболее простых в применении. Хотя выигрыш от каждого индивидуального изменения составляет всего несколько миллисекунд, вместе они очень неплохо суммируются. Исследования показали, что человеческий глаз способен различать паузы длительностью от 100 мс, а значит, всего несколько изменений в коде могут легко изменить общее впечатление от скорости работы вашего сайта или приложения. У вас есть советы по работе с jQuery, которыми вы готовы поделиться? Оставьте их в комментариях и помогите нам всем стать лучше.</p>
<p>Теперь вперед, сделайте все на высшем уровне!</p>
<p><i>Оригинал статьи: </i><a href="http://24ways.org/2011/your-jquery-now-with-less-suck"><i>http://24ways.org/2011/your-jquery-now-with-less-suck</i></a></p><p></p>
</div><br><br>Дата: 13.01.2012<br><br>Источник: http://24ways.org/2011/your-jquery-now-with-less-suck