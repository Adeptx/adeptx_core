<style>
	.caniuse, .caniuse li { display: inline-block; }
	.caniuse li {
		background-image: none;
		border: 1px dashed #000;
		padding: 5px;
		margin-left: 10px;
	}
</style>

<div>
            <p>В данной статье речь пойдет про CSS-селекторы. Будут рассмотрены как старые CSS-селекторы, которые поддерживает даже IE6, так и совсем новые CSS3-селекторы, которые поддерживают только последние версии браузеров. Итак, начнем.</p>
<h2>1. Звездочка <b style="color:red">*</b></h2>
<div><div><table border="0" cellpadding="0" cellspacing="0"><tbody><tr><td><div><div><code>* { </code><code>margin</code><code>: </code><code>0</code><code>; </code><code>padding</code><code>: </code><code>0</code><code>; }</code></div></div></td></tr></tbody></table></div></div>
<p>Начнем с самого простого, а потом
уже перейдем к более продвинутым вещам.</p>
<p>Этот CSS-селектор выделяет каждый
элемент на странице. Многие разработчики используют его для того, чтобы скинуть
у всех элементов значения margin и padding. На первый взгляд это удобно, но
все-таки в рабочем коде так лучше не делать. Этот CSS-селектор слишком сильно
грузит броузер.</p>
<p>* лучше использовать для выделения дочерних элементов:</p>
<div><div><table border="0" cellpadding="0" cellspacing="0"><tbody><tr><td><div><div><code>#container > * { </code><code>border</code><code>: </code><code>1px</code> <code>solid</code> <code>black</code><code>; }</code></div></div></td></tr></tbody></table></div></div>
<p>В данном случае выделяться дочерние элементы #container (про дочерние элементы читайте ниже). Но лучше вообще не злоупотреблять им.</p>
<p><a target="_blank" href="http://d2o0t5hpnwv4c1.cloudfront.net/840_cssSelectors/selectors/star.html">Демо</a></p>
Совместимость:
<ul class="caniuse">
<li>IE6 +</li>
<li>Firefox</li>
<li>Chrome</li>
<li>Safari</li>
<li>Opera</li>
</ul>
<div>

<hr size="1">
</div>
<h2>2. <b style="color:red">#</b>some_id</h2>
<div><div><table border="0" cellpadding="0" cellspacing="0"><tbody><tr><td><div><div><code>#container&nbsp;{ </code><code>width</code><code>: </code><code>960px</code><code>; </code><code>margin</code><code>: </code><code>auto</code><code>; }</code></div></div></td></tr></tbody></table></div></div>
<p>Знак решетки перед id элемента позволит нам указать стили для элемента с id = some_id. Это очень просто, но будьте аккуратны при использовании id.</p>
<p><em>Спросите себя: мне абсолютно необходимо выделение по id?</em></p>
<p>Дело в том, что idжестко привязывают стиль к элементу и не дает возможности повторного использования. Более предпочтительным будет использование классов, названий тэгов или даже псевдо-классов.</p>
<p><a target="_blank" href="http://d2o0t5hpnwv4c1.cloudfront.net/840_cssSelectors/selectors/id.html">Демо</a></p>
Совместимость:
<ul class="caniuse">
<li>IE6 +</li>
<li>Firefox</li>
<li>Chrome</li>
<li>Safari</li>
<li>Opera</li>
</ul>
<div>

<hr size="1">
</div>
<h2>3 <b style="color:red">.</b>some_class</h2>
<div><div><table border="0" cellpadding="0" cellspacing="0"><tbody><tr><td><div><div><code>.error&nbsp;{ </code><code>color</code><code>: </code><code>red</code><code>; }</code></div></div></td></tr></tbody></table></div></div>
<p>Это CSS-селектор класса some_class. Разница между id и классом заключается в том, что одному классу может принадлежать несколько элементов на странице.
Используйте классы, когда вы хотите применить определенный стиль к нескольким элементам сразу. При использовании id вам придется писать стиль для каждого отдельного элемента.</p>
<p><a target="_blank" href="[[~64]]">Демо</a></p>
Совместимость:
<ul class="caniuse">
<li>IE6 +</li>
<li>Firefox</li>
<li>Chrome</li>
<li>Safari</li>
<li>Chrome</li>
</ul>
<div>

<hr size="1">
</div>
<h2>4. Пробел между любыми селекторами, например: body header</h2>
<div><div><table border="0" cellpadding="0" cellspacing="0"><tbody><tr><td><div><div><code>li a { </code><code>text-decoration</code><code>: </code><code>none</code><code>; }</code></div></div></td></tr></tbody></table></div></div>
<p>CSS-селектор дочерних элементов встречается чаще всего. Если вам надо выделить элементы определенного типа из множества дочерних элементов, используете этот селектор. В примере выделяются все ссылки, которые находятся в элементе li, для того, чтобы убрать у ссылок из меню в теге li подчеркивание. В таких случаях этот тег очень практичен и незаменим.</p>
<blockquote>
<p><em>Однако не следует пытаться сконструировать CSS-селекторы вида </em><em>body section article nav a .error #e404</em><em>. Спросите себя, необходимо ли для выделения данного элемента писать такой громоздкий CSS-селектор. Поскольку при каждом изменении потребуется изменять и стили.</em></p>
</blockquote>
<p><a target="_blank" href="[[~65]]">Демо</a></p>
Совместимость:
<ul class="caniuse">
<li>IE6 +</li>
<li>Firefox</li>
<li>Chrome</li>
<li>Safari</li>
<li>Chrome</li>
</ul>
<div>

<hr size="1">
</div>
<h2>5. Выделение элементов по тегу, например: div</h2>
<div><div><table border="0" cellpadding="0" cellspacing="0"><tbody><tr><td><div><div><code>a { </code><code>color</code><code>: </code><code>red</code><code>; }</code></div><div><code>ul { </code><code>margin-left</code><code>: </code><code>0</code><code>; }</code></div></div></td></tr></tbody></table></div></div>
<p>Что делать, если вы хотите охватить все элементы данного типа на странице? Будьте проще, используйте
CSS-селектор типа. Если вы должны выделить все неупорядоченные списки, используйте ul{}, а если все ссылки, то a{}.</p>
<p><a target="_blank" href="[[~66]]">Демо</a></p>
Совместимость:
<ul class="caniuse">
<li>IE6 +</li>
<li>Firefox</li>
<li>Chrome</li>
<li>Safari</li>
<li>Opera</li>
</ul>
<div>

<hr size="1">
</div>
<h2>6. Псевдоклассы a:visited, a:link</h2>
<div><div><table border="0" cellpadding="0" cellspacing="0"><tbody><tr><td><div><div><code>a:link { </code><code>color</code><code>: </code><code>red</code><code>; }</code></div><div><code>a:visted { </code><code>color</code><code>: </code><code>purple</code><code>; }</code></div></div></td></tr></tbody></table></div></div>
<p>Мы используем псевдо-класс :link, для выделения всех ссылок, на которые еще не кликнули.</p>
<p>Если же нам надо применить определенный стиль к уже посещенным ссылкам, то используем псевдо-класс :visited.</p>
<p><a target="_blank" href="[[~67]]">Демо</a></p>
Совместимость:
<ul class="caniuse">
<li>IE7 +</li>
<li>Firefox</li>
<li>Chrome</li>
<li>Safari</li>
<li>Opera</li>
</ul>
<div>

<hr size="1">
</div>
<h2>7. Выделение следующего элемента, например: h1<b style="color:red">+</b>p</h2>
<div><div><table border="0" cellpadding="0" cellspacing="0"><tbody><tr><td><div><div><code>h1 + p { </code><code>color</code><code>: </code><code>red</code><code>; }</code></div></div></td></tr></tbody></table></div></div>
<p>Символ плюса используется дл выделения следующего элемента. Он будет выбирать <em>только</em> те элементы указанные после знака +, которые идет сразу после элемента до него. В примере текст первого абзаца после каждого заголовка h1 будет красного цвета.</p>
<p><a target="_blank" href="[[~68]]">Демо</a></p>
Совместимость:
<ul class="caniuse">
<li>IE7+</li>
<li>Firefox</li>
<li>Chrome</li>
<li>Safari</li>
<li>Chrome</li>
</ul>
<div>

<hr size="1">
</div>
<h2>8. Выбор непосредственно дочерних элементов, например: body<b style="color:red">&gt;</b>div</h2>
<div><div><table border="0" cellpadding="0" cellspacing="0"><tbody><tr><td><div><div><code>div#container &gt; ul { </code><code>border</code><code>: </code><code>1px</code> <code>solid</code> <code>black</code><code>; }</code></div></div></td></tr></tbody></table></div></div>
<p>Разница между стандартными body div и body&gt;div состоит в том, что рассматриваемый CSS-селектор будет выбирать только непосредственные дочерние элементы. Например, рассмотрим следующий код.</p>
<div><div><table border="0" cellpadding="0" cellspacing="0"><tbody><tr><td><div><div><code> </code> </div><div><code>&lt;</code><code>div</code> <code>id</code><code>=</code><code>"container"</code><code>&gt;</code></div><div><code>&nbsp;&nbsp;&nbsp;&nbsp;</code><code>&lt;</code><code>ul</code><code>&gt;</code></div><div><code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><code>&lt;</code><code>li</code><code>&gt; Элемент списка</code></div><div><code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><code>&lt;</code><code>ul</code><code>&gt;</code></div><div><code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><code>&lt;</code><code>li</code><code>&gt; Дочерний элемент&lt;/</code><code>li</code><code>&gt; </code></div><div><code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><code>&lt;/</code><code>ul</code><code>&gt;</code></div><div><code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><code>&lt;/</code><code>li</code><code>&gt;</code></div><div><code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><code>&lt;</code><code>li</code><code>&gt; Элемент списка &lt;/</code><code>li</code><code>&gt;</code></div><div><code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><code>&lt;</code><code>li</code><code>&gt; Элемент списка &lt;/</code><code>li</code><code>&gt;</code></div><div><code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><code>&lt;</code><code>li</code><code>&gt; Элемент списка &lt;/</code><code>li</code><code>&gt;</code></div><div><code>&nbsp;&nbsp;&nbsp;&nbsp;</code><code>&lt;/</code><code>ul</code><code>&gt;</code></div><div><code>&lt;/</code><code>div</code><code>&gt;</code></div></div></td></tr></tbody></table></div></div>
<p>CSS-селектор #container &gt; ul выберет только ul-ы, которые являются непосредственными дочерними элементами div с id&nbsp;=container&nbsp;. Он не выберет, например,&nbsp;ul-ы, являющиеся дочерними элементами первых li&nbsp;.</p>
<p>Поэтому можно получить выигрыш в производительности используя данный CSS-селектор. В самом деле, это особенно рекомендуется при работе с jQuery или другими библиотеками, выбирающими элементы на основе правил CSS -селекторов.</p>
<p><a target="_blank" href="http://d2o0t5hpnwv4c1.cloudfront.net/840_cssSelectors/selectors/childcombinator.html">Демо</a></p>
Совместимость:
<ul class="caniuse">
<li>IE7+</li>
<li>Firefox</li>
<li>Chrome</li>
<li>Safari</li>
<li>Opera</li>
</ul>
<div>

<hr size="1">
</div>
<h2>9. h1 <b style="color:red">~</b> p</h2>
<div><div><table border="0" cellpadding="0" cellspacing="0"><tbody><tr><td><div><div><code>h1 ~ p { </code><code>color</code><code>: </code><code>red</code><code>; }</code></div></div></td></tr></tbody></table></div></div>
<p>Этот CSS-селектор очень похож на h1 + p, однако, является менее строгим. При использовании h1 + p будет выбрать только первый элемент, идущий за h1. В данном случае будут выбраны все элементы p, идущие за h1.</p>
<p><a target="_blank" href="[[~71]]" target="_blank">Демо</a></p>
Совместимость:
<ul class="caniuse">
<li>IE7 +</li>
<li>Firefox</li>
<li>Chrome</li>
<li>Safari</li>
<li>Opera</li>
</ul>
<div>

<hr size="1">
</div>
<h2>10. Выделение по наличию атрибута, например: <b style="color:red">[</b>target<b style="color:red">]</b></h2>
<div><div><table border="0" cellpadding="0" cellspacing="0"><tbody><tr><td><div><div><code>a[target] { </code><code>color</code><code>: </code><code>green</code><code>; }</code></div></div></td></tr></tbody></table></div></div>
<p>В CSS-селекторах также можно использовать атрибуты. Например, в данном примере мы выделили все ссылки, имеющие атрибут target, который указывает браузеру как открывать ссылки - в новой вкладке, в той же или в новом окне. При этом стили применятся к тем ссылкам, у которых этот атрибут установлен в какое-либо значение, а значит и отличается от значения атрибута по умолчанию (обычно это "в той же вкладке", но значение по умолчанию можно задавать тегом &lt;base target="<i>_blank</i>">). Остальные ссылки, то есть те, у которых остается значение по умолчанию, останутся не затронутыми. Для разных атрибутов значение по умолчанию может быть разным, например атрибут type в теге &lt;input> по умолчанию определен как "text", значит если он не указан то поле будет текстовым, а отсутсвие атрибута action у тега form говорит о том, что форма отправится той же странице, на которой она размещена.</p>
<p><a target="_blank" href="http://d2o0t5hpnwv4c1.cloudfront.net/840_cssSelectors/selectors/attributes.html" target="_blank">Демо</a></p>
Совместимость:
<ul class="caniuse">
<li>IE7 +</li>
<li>Firefox</li>
<li>Chrome</li>
<li>Safari</li>
<li>Opera</li>
</ul>
<div>

<hr size="1">
</div>
<h2>11. Выделение по значению атрибута тега, например: a[href="index.php?page=active_page"]</h2>
<div><div><table border="0" cellpadding="0" cellspacing="0"><tbody><tr><td><div><div><code>a[href=</code><code>"<a target="_blank" href="index.php?page=active_page">active_page</a>"</code><code>] { </code><code>color</code><code>: </code><code>#ffde00</code><code>; }</code></div></div></td></tr></tbody></table></div></div>
<p>Все ссылки, которые ссылаются на "index.php?page=active_page" будут золотыми. Все остальные ссылки останутся неизменными. Можно выбирать любые элементы с любыми атрибутами и значениями атрибутов. В данном примере при некоторых нехитрых манипуляциях можно выделить в меню активную страницу.</p>
<blockquote>Обратите внимание, на кавычки. Не забудьте так же делать в jQuery и других JavaScript библиотеках, в которых элементы выбираются по CSS-селекторам. По возможности, всегда используйте CSS3-селекторы.</blockquote>
<p>Хорошее правило, но слишком строгое, любые отклонения от содержимого кавычек в атрибуте и стиль не примениться. Что же делать, если в той же ссылке могут быть некоторые параметры, например "index.php?page=active_page&get1=some1&get2=some2"? В этих случаях мы можем использовать регулярные выражения. Все регулярные выражения будут рассмотрены п=на примере ссылок и преимущественно атрибута href, однако вы можете использовать любой тег, любой атрибут тега и любые его значения Кроме того, можно выделять элементы по атрибуту тега, даже не указывая какой-то определенный тег, например атрибут title может быть у каких угодно элементов. В таком случае достаточно написать [title="some_title"]{}.</p>
<p><a target="_blank" href="[[~73]]">Демо</a></p>
Совместимость:
<ul class="caniuse">
<li>IE7 +</li>
<li>Firefox</li>
<li>Chrome</li>
<li>Safari</li>
<li>Chrome</li>
</ul>
<div>

<hr size="1">
</div>
<h2>12. a[href *=
"page=active_page"]</h2>
<div><div><table border="0" cellpadding="0" cellspacing="0"><tbody><tr><td><div><div><code>a[href*=</code><code>"everstudent"</code><code>] { </code><code>color</code><code>: # </code><code>1</code><code>f</code><code>6053</code><code>; }</code></div></div></td></tr></tbody></table></div></div>
<p>Вот то, что нам нужно. Звезда обозначает, что искомое значение должно появляться <em>где-нибудь</em> в атрибуте. Таким образом, CSS-селектор охватывает <em>"index.php?page=active_page", "index.php?page=active_page&get=some"</em> и т.д. Обратите внимание, что если указать в таком случае "page=1", то "page=10", "page=11" и т.д. также попадут в диапазон.</p>
<p>Следующий пример поможет, если ссылка необходимо выделить все страницы, которые ведут на какие-то сторонние и не связанные ресурсы.</p>
<p><a target="_blank" href="[[~74]]" target="_blank">Демо</a></p>
Совместимость:
<ul class="caniuse">
<li>IE7 +</li>
<li>Firefox</li>
<li>Chrome</li>
<li>Safari</li>
<li>Opera</li>
</ul>
<div>

<hr size="1">
</div>
<h2>13. a[href^="http://"]<b style="color:red">,</b> a[href^="https://"]{}</h2>
<div><div><table border="0" cellpadding="0" cellspacing="0"><tbody><tr><td><div><div><code>a[href^=</code><code>"http"</code><code>] {</code></div><div><code>&nbsp;&nbsp;&nbsp;</code><code>background</code><code>: </code><code>url</code><code>(path/to/external/</code><code>icon</code><code>.png) </code><code>no-repeat</code><code>;</code></div><div><code>&nbsp;&nbsp;&nbsp;</code><code>padding-left</code><code>: </code><code>10px</code><code>;</code></div><div><code>}</code></div></div></td></tr></tbody></table></div></div>
<p>Вы никогда не задумывались, как некоторые веб-сайты могут отображать маленький значок рядом с внешними ссылками, указывающий на то, что ссылка откроется в новом окне или что она ведет на сторонний ресурс? Я уверен, что вы видели их прежде, они хорошо запоминаются.</p>
<p>"^" - наиболее часто используемый в регулярных выражениях символ. Он используется для обозначения начала строки. Если мы хотим охватить все тэги, у которых href начинается с http, нам надо использовать CSS-селектор, приведенных выше.</p>
<blockquote>Обратите внимание, что для того, чтобы охватить http и https мы поставили запятую между селекторами, что позволяет использовать оба селектора для применения одинаковых стилей. Почему мы написали так, а не просто a[href^="http"]? Только с одной целью - если на вашем сайте есть ссылки, ведущие на страницы, адрес которых начинается на http (например http_protocol_page.php), то приведенный селектор захватит и их, а используя код из примера мы избегаем данных недостатков.<em> </em></blockquote>
<p>С началом строки разобрались. А что, если мы хотим задать стиль только для ссылок, ведущих на ихзображения? То есть, что делать, если необходимо привязать значение тега к <em>концу</em> строки?.</p>
<p><a target="_blank" href="[[~75]]">Демо</a></p>
Совместимость:
<ul class="caniuse">
<li>IE7+</li>
<li>Firefox</li>
<li>Хром</li>
<li>Safari</li>
<li>Опера</li>
</ul>
<div>

<hr size="1">
</div>
<h2>14. a[href$=".jpg"], a[href$=".png"], a[href$=".gif"], a[href$=".ico"] ...</h2>
<div><div><table border="0" cellpadding="0" cellspacing="0"><tbody><tr><td><div><div><code> </code><code>a[href$=</code><code>".jpg"</code><code>] { </code><code>color</code><code>: </code><code>red</code><code>; }</code></div></div></td></tr></tbody></table></div></div>
<p>Опять же, мы используем символ регулярного выражения "$" для обозначения конца строки. В данном примере мы ищем ссылки, которые ссылаются на jpg-файлы, то есть все ссылки, в конце у которых стоит ".jpg".</p>
<p><a target="_blank" href="[[~76]]" target="_blank">Демо</a></p>
Совместимость:
<ul class="caniuse">
<li>IE7+</li>
<li>Firefox</li>
<li>Хром</li>
<li>Safari</li>
<li>Опера</li>
</ul>
<div>

<hr size="1">
</div>
<h2>15. a[data-filetype*="image"]</h2>
<div><div><table border="0" cellpadding="0" cellspacing="0"><tbody><tr><td><div><div><code>a[data-filetype=</code><code>"image"</code><code>]{ </code><code>color</code><code>: </code><code>red</code><code>; }</code></div></div></td></tr></tbody></table></div></div>
<p>Если требуется написать CSS-селектор, который бы выделял ссылки на все виды изображений, мы могли бы использовать пример кода выше, но это громоздко и не эффективно:</p>
<div><div><table border="0" cellpadding="0" cellspacing="0"><tbody><tr><td><div><div><code>a[href$=</code><code>".jpg"</code><code>],</code></div><div><code>a[href$=</code><code>".jpeg"</code><code>],</code></div><div><code>a[href$=</code><code>".png"</code><code>],</code></div><div><code>a[href$=</code><code>".gif"</code><code>] {</code></div><div><code>&nbsp;&nbsp;&nbsp;color</code><code>: </code><code>red</code><code>;</code></div><div><code>}</code></div></div></td></tr></tbody></table></div></div>
<p>Другим возможным решением является применение пользовательских атрибутов. Почему бы нам не добавить наш собственный атрибут data-filetype в каждую ссылку?</p>
<div><div><table border="0" cellpadding="0" cellspacing="0"><tbody><tr><td><div><div><code> </code><code>&lt;</code><code>a</code> <code>href</code><code>=</code><code>"path/to/image.jpg"</code> <code>data-filetype</code><code>=</code><code>"image"</code><code>&gt; Ссылка на изображение &lt;/</code><code>a</code><code>&gt;</code></div></div></td></tr></tbody></table></div></div>
<p>HTML позволяет нам использовать какие угодно атрибуты тегов, вы можете придумать любой свой атрибут. Затем мы можем выделить такие ссылки при помощи данного CSS-селектора:</p>
<div><div><table border="0" cellpadding="0" cellspacing="0"><tbody><tr><td><div><div><code> </code><code>a[data-filetype=</code><code>"image"</code><code>] { </code><code>color</code><code>: </code><code>red</code><code>; }</code></div></div></td></tr></tbody></table></div></div>
<p><a target="_blank" href="[[~77]]" target="_blank">Демо</a></p>
Совместимость:
<ul class="caniuse">
<li>IE7 +</li>
<li>Firefox</li>
<li>Хром</li>
<li>Safari</li>
<li>Опера</li>
</ul>
<div>

<hr size="1">
</div>
<h2>16. a[some_attr~="some_value"]</h2>
<div><div><table border="0" cellpadding="0" cellspacing="0"><tbody><tr><td><div>1</div><div>2</div></td><td><div><div><code>a[data-info~=</code><code>"external"</code><code>] { </code><code>color</code><code>: </code><code>red</code><code>; }</code></div><div><code>a[data-info~=</code><code>"image"</code><code>] { </code><code>border</code><code>: </code><code>1px</code> <code>solid</code> <code>black</code><code>; }</code></div></div></td></tr></tbody></table></div></div>
<p>А вот кое-что особенное. Не все знают об этом CSS-селекторе. Тильда (~) позволяет выделить определенный атрибут из списка атрибутов, разделенных запятой.</p>
<p>Например, мы можем задать наш собственный атрибут data-info, в котором указывать несколько ключевых слов через пробел. Так, мы можем указать, что ссылка является внешней и что она ссылается на изображение.</p>
<div><div><table border="0" cellpadding="0" cellspacing="0"><tbody><tr><td><div><div><code>&lt;</code><code>a</code> <code>href</code><code>=</code><code>"path/to/image.jpg"</code> <code>data-info</code><code>=</code><code>"external image"</code><code>&gt; Click Me &lt;/</code><code>a</code><code>&gt;</code></div></div></td></tr></tbody></table></div></div>
<p>Вот, html-код на месте, теперь напишем стили.</p>
<div><div><table border="0" cellpadding="0" cellspacing="0"><tbody><tr><td><div><div><code>/ * Выбираем ссылки с атрибутом data-info, содержащий значение </code><code>"external"</code> <code>* /</code></div><div><code>a[data-info~=</code><code>"external"</code><code>] { </code><code>color</code><code>: </code><code>red</code><code>; }</code></div><div><code>/ * И которые содержат значения </code><code>"image"</code> <code>* /</code></div><div><code>a[data-info~=</code><code>"image"</code><code>] { </code><code>border</code><code>: </code><code>1px</code> <code>solid</code> <code>black</code><code>; }</code></div></div></td></tr></tbody></table></div></div>
<p>Неплохо, да?</p>
<p><a target="_blank" href="[[~78]]" target="_blank">Демо</a></p>
Совместимость:
<ul class="caniuse">
<li>IE7 +</li>
<li>Firefox</li>
<li>Хром</li>
<li>Safari</li>
<li>Опера</li>
</ul>
<div>

<hr size="1">
</div>
<h2>17. Псевдокласс :checked</h2>
<div><div><table border="0" cellpadding="0" cellspacing="0"><tbody><tr><td><div><div><code>input[type=radio]:checked { </code><code>border</code><code>:</code><code>1px</code> <code>solid</code> <code>black</code><code>; }</code></div></div></td></tr></tbody></table></div></div>
<p>Этот псевдокласс выделяет только элементы пользовательского интерфейса, такие как переключатель или флажок. Причем те, которые отмечены/выбраны. Очень просто.</p>
<p><a target="_blank" href="[[~79]]" target="_blank">Демо</a></p>
Совместимость:
<ul class="caniuse">
<li>IE9 +</li>
<li>Firefox</li>
<li>Хром</li>
<li>Safari</li>
<li>Опера</li>
</ul>
<div>

<hr size="1">
</div>
<h2>18. Псевдоклассы :before, :after{}</h2>
<p>Псевдоклассы :before и :after очень крутые. Создается впечатление, что каждый день появляются новые способы их эффективного использования. Они просто генерируют контент вокруг выбранного элемента.</p>
<p>Многие познакомились с этими псевдоклассами при работе с clear-fix hack.</p>
<div><div><table border="0" cellpadding="0" cellspacing="0"><tbody><tr><td><div><div><code>.clearfix:after {</code></div><div><code>&nbsp;&nbsp;&nbsp;&nbsp;</code><code>content</code><code>: </code><code>""</code><code>;</code></div><div><code>&nbsp;&nbsp;&nbsp;&nbsp;</code><code>display</code><code>: </code><code>block</code><code>;</code></div><div><code>&nbsp;&nbsp;&nbsp;&nbsp;</code><code>clear</code><code>: </code><code>both</code><code>;</code></div><div><code>&nbsp;&nbsp;&nbsp;&nbsp;</code><code>visibility</code><code>: </code><code>hidden</code><code>;</code></div><div><code>&nbsp;&nbsp;&nbsp;&nbsp;</code><code>font-size</code><code>: </code><code>0</code><code>;</code></div><div><code>&nbsp;&nbsp;&nbsp;&nbsp;</code><code>height</code><code>: </code><code>0</code><code>;</code></div><div><code></code><code>}</code></div><div><code>.clearfix {</code></div><div><code>&nbsp;&nbsp;&nbsp;&nbsp;</code><code>*</code><code>display</code><code>: inline-</code><code>block</code><code>;</code></div><div><code>&nbsp;&nbsp;&nbsp;&nbsp;</code><code>_height</code><code>: </code><code>1%</code><code>;</code></div><div><code>}</code></div></div></td></tr></tbody></table></div></div>
<p>Этот <em>хак</em> использует :after чтобы добавить пробел после элемента, чтобы запретить его обтекание.</p>
<blockquote>Согласно спецификации CSS3, вы должны использовать два двоеточия (::). Однако, можно использовать и одно двоеточие для обратной совместимости.</blockquote>
Совместимость:
<ul class="caniuse">
<li>IE8 +</li>
<li>Firefox</li>
<li>Хром</li>
<li>Safari</li>
<li>Опера</li>
</ul>
<div>

<hr size="1">
</div>
<h2>19. Псевдокласс :hover</h2>
<div><div><table border="0" cellpadding="0" cellspacing="0"><tbody><tr><td><div><div><code>div:hover { </code><code>background</code><code>: </code><code>#e3e3e3</code><code>; }</code></div></div></td></tr></tbody></table></div></div>
<p>Хотите применить стиль к элементу, когда наводите на него мышкой? Тогда этот CSS-селектор для вас.</p>
<blockquote>Имейте в виду, что старые версии Internet Explorer применяют :hover только к ссылкам.</blockquote>
<p>Этот CSS-селектор часто используют для того, чтобы поставить border-bottom на ссылки, когда на них наводят мышкой. Или чтобы изменить цвет ссылки при наведении, сменить фоновое изображение на кнопке и т. д.</p>
<div><div><table border="0" cellpadding="0" cellspacing="0"><tbody><tr><td><div><div><code>a:hover { &nbsp;</code><code>border-bottom</code><code>: </code><code>1px</code> <code>solid</code> <code>black</code><code>; }</code></div></div></td></tr></tbody></table></div></div>
<blockquote>border-bottom: 1px solid black; выглядит лучше, чем text-decoration: underline; во многих случаях и позволяет манипулировать его цветом, стилем и т.д. Например, можно сделать чтобы ссылки подчеркивались пунктирными линиями. Не забывайте также вытавлять text-decoration: none, если вы применяете подчеркиваниве ссылко таким способом.</blockquote>
Совместимость:
<ul class="caniuse">
<li>IE6 + (В IE6: hover должен быть применен к ссылке)</li>
<li>Firefox</li>
<li>Хром</li>
<li>Safari</li>
<li>Опера</li>
</ul>
<div>

<hr size="1">
</div>
<h2>20. Псевдокласс :not(selector)</h2>
<div><div><table border="0" cellpadding="0" cellspacing="0"><tbody><tr><td><div><div><code>div:not(#container) { </code><code>color</code><code>: </code><code>blue</code><code>; }</code></div></div></td></tr></tbody></table></div></div>
<p>Псевдокласс отрицания бывает очень полезным. Скажем, я хочу выбрать все div, за исключением того, который имеет id&nbsp;=&nbsp;container&nbsp;.
Приведенный выше код справиться с этим!</p>
<p>Или, если бы я хотел выбрать все элементы, за исключением p.</p>
<div><div><table border="0" cellpadding="0" cellspacing="0"><tbody><tr><td><div><div><code>*:not(p) {&nbsp;</code><code>color</code><code>: </code><code>green</code><code>; }</code></div></div></td></tr></tbody></table></div></div>
<p><a target="_blank" href="[[~80]]" target="_blank">Демо</a></p>
Совместимость:
<ul class="caniuse">
<li>IE9 +</li>
<li>Firefox</li>
<li>Хром</li>
<li>Safari</li>
<li>Опера</li>
</ul>
<div>

<hr size="1">
</div>
<h2>21. ::псевдо_элемент </h2>
<div><div><table border="0" cellpadding="0" cellspacing="0"><tbody><tr><td><div><div><code>p::first-line {</code></div><div><code>&nbsp;&nbsp;&nbsp;</code><code>font-weight</code><code>: </code><code>bold</code><code>;</code></div><div><code>&nbsp;&nbsp;&nbsp;</code><code>font-size</code><code>: </code><code>1.2em</code><code>;</code></div><div><code>}</code></div></div></td></tr></tbody></table></div></div>
<p>Мы можем использовать псевдо элементы, чтобы оформлять фрагменты элементов, такие как первая строка, или первая буква. Имейте в виду, что они должны быть применены к элементам уровня блока для того, чтобы вступили в силу.</p>
<blockquote>Псевдо-элемент задается двумя двоеточиями: ::<em> </em></blockquote>
<p>Выбираем первую букву в параграфе</p>
<div><div><table border="0" cellpadding="0" cellspacing="0"><tbody><tr><td><div><div><code>p::first-letter {</code></div><div><code>&nbsp;&nbsp;&nbsp;&nbsp;</code><code>float</code><code>: </code><code>left</code><code>;</code></div><div><code>&nbsp;&nbsp;&nbsp;&nbsp;</code><code>font-size</code><code>: </code><code>2em</code><code>;</code></div><div><code>&nbsp;&nbsp;&nbsp;&nbsp;</code><code>font-weight</code><code>: </code><code>bold</code><code>;</code></div><div><code>&nbsp;&nbsp;&nbsp;&nbsp;</code><code>font-family</code><code>: </code><code>cursive</code><code>;</code></div><div><code>&nbsp;&nbsp;&nbsp;&nbsp;</code><code>padding-right</code><code>:</code><code>2px</code><code>;</code></div><div><code>}</code></div></div></td></tr></tbody></table></div></div>
<p>Этот код выберет все параграфы, и в них в
свою очередь выберет первые буквы и применит к ним этот стиль.</p>
<p> </p>
<p>Выбираем первую строку в абзаце</p>
<div><div><table border="0" cellpadding="0" cellspacing="0"><tbody><tr><td><div><div><code>p::first-line {</code></div><div><code>&nbsp;&nbsp;&nbsp;&nbsp;</code><code>font-weight</code><code>: </code><code>bold</code><code>;</code></div><div><code>&nbsp;&nbsp;&nbsp;&nbsp;</code><code>font-size</code><code>: </code><code>1.2em</code><code>;</code></div><div><code>}</code></div></div></td></tr></tbody></table></div></div>
<p>Аналогичным образом благодаря&nbsp;::first-line мы задаем стиль первой строки в абзаце.</p>
<blockquote>"Для совместимости с существующими таблицами стилей, браузер должен
понимать прежнее обозначения псевдо элементов с одним двоеточием, введенные в
CSS 1, 2 (:first-line, :first-letter, :before and :after). Эта совместимость не
допускается для новых псевдо-элементов, введенных в этой спецификации"&nbsp;<a target="_blank" href="http://www.w3.org/TR/css3-selectors/">Источник</a></blockquote>
<p><a target="_blank" href="[[~81]]" target="_blank">Демо</a></p>
Совместимость:
<ul class="caniuse">
<li>IE6 +</li>
<li>Firefox</li>
<li>Хром</li>
<li>Safari</li>
<li>Опера</li>
</ul>
<div>

<hr size="1">
</div>
<h2>22. Псевдокласс порядкового номера :nth-child(n)</h2>
<div><div><table border="0" cellpadding="0" cellspacing="0"><tbody><tr><td><div><div><code>li:nth-child(</code><code>3</code><code>) { </code><code>color</code><code>: </code><code>red</code><code>; }</code></div></div></td></tr></tbody></table></div></div>
<p>Раньше (до CSS3) мы не могли выделить, например, третий дочерний элемент. nth-child решает это!</p>
<p>Обратите внимание, что nth-child принимает целое число в качестве параметра, однако отсчет ведется не с 0, а с единицы! Если вы хотите выбрать второй пункт списка, используйте li:nth-child(2){}.</p>
<p>Мы даже можем выбрать каждый четвертый элемент списка, просто написав li:nth-child(4n){} или можно делать вычисления, например так: li:nth-child(4n + 3){}.</p>
<p><a target="_blank" href="[[~82]]" target="_blank">Демо</a></p>
Совместимость:
<ul class="caniuse">
<li>IE9 +</li>
<li>Firefox 3,5 +</li>
<li>Хром</li>
<li>Safari</li>
</ul>
<div>

<hr size="1">
</div>
<h2>23. Псевдокласс порядкового номера с конца :nth-last-child(n)</h2>
<div><div><table border="0" cellpadding="0" cellspacing="0"><tbody><tr><td><div><div><code>li:nth-last-child(</code><code>2</code><code>) { </code><code>color</code><code>: </code><code>red</code><code>; }</code></div></div></td></tr></tbody></table></div></div>
<p>Что делать, если у вас огромный список элементов в ul, а нем нужно выбрать третий элемент с конца? Вместо того, чтобы писать li:nth-child(397), можно использовать nth-last-child. Или список формируется динамически и узнать сколько будет элементов заранее некак, а нужнно применить стили к последнему элементу.</p>
<p>Этот метод почти идентичен приведенному выше, однако отсчет ведется с конца. Очень полезно для применения к последнему элементу, например, очень часто при создании меню или подобного списка у последнего элемента нужно убрать лишний отступ или border.</p>
<p><a target="_blank" href="[[~83]]" target="_blank">Демо</a></p>
Совместимость:
<ul class="caniuse">
<li>IE9 +</li>
<li>Firefox 3,5 +</li>
<li>Хром</li>
<li>Safari</li>
<li>Опера</li>
</ul>
<div>

<hr size="1">
</div>
<h2>24. Псевдокласс :nth-of-type(n)</h2>
<div><div><table border="0" cellpadding="0" cellspacing="0"><tbody><tr><td><div><div><code>ul:nth-of-type(</code><code>3</code><code>) { </code><code>border</code><code>: </code><code>1px</code> <code>solid</code> <code>black</code><code>; }</code></div></div></td></tr></tbody></table></div></div>
<p>Бывает, что надо выбрать не дочерний элемент, а элемент определенного типа.</p>
<p>Представьте себе, что на странице пять неупорядоченных списков. Если вы хотите применить стиль только к третьему ul, не имеющему уникального id, нужно использовать nth-of-type.</p>
<p><a target="_blank" href="[[~84]]" target="_blank">Демо</a></p>
Совместимость:
<ul class="caniuse">
<li>IE9 +</li>
<li>Firefox 3,5 +</li>
<li>Хром</li>
<li>Safari</li>
</ul>
<div>

<hr size="1">
</div>
<h2>25. Псевдокласс :nth-last-of-type(n)</h2>
<div><div><table border="0" cellpadding="0" cellspacing="0"><tbody><tr><td><div><div><code>ul:nth-last-of-type(</code><code>3</code><code>) { </code><code>border</code><code>: </code><code>1px</code> <code>solid</code> <code>black</code><code>; }</code></div></div></td></tr></tbody></table></div></div>
<p>Мы можем также использовать nth-last-of-type, отсчитывая элементы с конца.</p>
Совместимость:
<ul class="caniuse">
<li>IE9 +</li>
<li>Firefox 3,5 +</li>
<li>Хром</li>
<li>Safari</li>
<li>Опера</li>
</ul>
<div>

<hr size="1">
</div>
<h2>26. Псевдокласс :first-child</h2>
<div><div><table border="0" cellpadding="0" cellspacing="0"><tbody><tr><td><div><div><code>ul li:first-child { </code><code>border-top</code><code>: </code><code>none</code><code>; }</code></div></div></td></tr></tbody></table></div></div>
<p>Этот псевдокласс выбирает первый дочерний элемент. Часто используется чтобы убрать border в первом и
последнем элементе списка.</p>
<p><a target="_blank" href="[[~85]]" target="_blank">Демо</a></p>
Совместимость:
<ul class="caniuse">
<li>IE7 +</li>
<li>Firefox</li>
<li>Хром</li>
<li>Safari</li>
<li>Опера</li>
</ul>
<div>

<hr size="1">
</div>
<h2>27. Псевдокласс :last-child</h2>
<div><div><table border="0" cellpadding="0" cellspacing="0"><tbody><tr><td><div><div><code>ul &gt; li:last-child { </code><code>color</code><code>: </code><code>green</code><code>; }</code></div></div></td></tr></tbody></table></div></div>
<p>В противоположность&nbsp;:first-child&nbsp;:last-child выбирает последний дочерний элемент.</p>
<p><a target="_blank" href="[[~85]]" target="_blank">Демо</a></p>
Совместимость:
<ul class="caniuse">
<li>IE9 + (Да да, IE8 поддерживает :first-child , но не поддерживает :last-child. Microsoft-у привет! )</li>
<li>Firefox</li>
<li>Хром</li>
<li>Safari</li>
<li>Опера</li>
</ul>
<div>
<hr size="1">
</div>
<h2>28. Псевдокласс :only-child</h2>
<div><div><table border="0" cellpadding="0" cellspacing="0"><tbody><tr><td><div><div><code>div p:only-child { </code><code>color</code><code>: </code><code>red</code><code>; }</code></div></div></td></tr></tbody></table></div></div>
<p>Вы не часто встретите этот псевдокласс, тем не менее он существует.</p>
<p>Он позволяет вам выбрать элементы, которые являются единственными дочерними. Например, применим приведенный выше
стиль к этому html-коду:</p>
<div><div><table border="0" cellpadding="0" cellspacing="0"><tbody><tr><td><div><div><code>&lt;</code><code>div</code><code>&gt;</code></div><div><code>&nbsp;&nbsp;&nbsp;&nbsp;</code><code>&lt;</code><code>p</code><code>&gt; Один параграф.&lt;/</code><code>p</code><code>&gt;</code></div><div><code>&lt;/</code><code>div</code><code>&gt;</code></div><div><code>&lt;</code><code>div</code><code>&gt;</code></div><div><code>&nbsp;&nbsp;&nbsp;&nbsp;</code><code>&lt;</code><code>p</code><code>&gt; Два параграфа &lt;/</code><code>p</code><code>&gt;</code></div><div><code>&nbsp;&nbsp;&nbsp;&nbsp;</code><code>&lt;</code><code>p</code><code>&gt; Два параграфа &lt;/</code><code>p</code><code>&gt;</code></div><div><code>&lt;/</code><code>div</code><code>&gt;</code></div></div></td></tr></tbody></table></div></div>
<p>Будет выбран p только первого
div`a, потому что он единственный дочерний элемент.</p>
<p><a target="_blank" href="[[~86]]" target="_blank">Демо</a></p>
Совместимость:
<ul class="caniuse">
<li>IE9 +</li>
<li>Firefox</li>
<li>Хром</li>
<li>Safari</li>
<li>Опера</li>
</ul>
<div>

<hr size="1">
</div>
<h2>29. Псевдокласс :only-of-type</h2>
<div><div><table border="0" cellpadding="0" cellspacing="0"><tbody><tr><td><div><div><code>li:only-of-type { </code><code>font-weight</code><code>: </code><code>bold</code><code>; }</code></div></div></td></tr></tbody></table></div></div>
<p>Очень интересный псевдокласс. Он затрагивает элементы, не имеющие соседей в пределах родительского
элемента. В качестве примера выберем ul только с одним элементом в списке.</p>
<p>Единственное решение заключается в использовании only-of-type&nbsp;.</p>
<div><div><table border="0" cellpadding="0" cellspacing="0"><tbody><tr><td><div><div><code>ul &gt; li:only-of-type { </code><code>font-weight</code><code>: </code><code>bold</code><code>; }</code></div></div></td></tr></tbody></table></div></div>
<p><a target="_blank" href="[[~87]]" target="_blank">Демо</a></p>
Совместимость:
<ul class="caniuse">
<li>IE9 +</li>
<li>Firefox 3,5 +</li>
<li>Хром</li>
<li>Safari</li>
<li>Опера</li>
</ul>
<div>

<hr size="1">
</div>
<h2>30. Псевдокласс :first-of-type</h2>
<p>first-of-type выбирает первый элемент заданного типа.</p>
<p>Чтобы лучше понять, приведем</p>
<p>пример.</p>
<div><div><table border="0" cellpadding="0" cellspacing="0"><tbody><tr><td><div><div><code>&lt;</code><code>div</code><code>&gt;&nbsp;&nbsp;</code></div><div><code>&nbsp;&nbsp;&nbsp;&nbsp;</code><code>&lt;</code><code>p</code><code>&gt; Параграф &lt;/</code><code>p</code><code>&gt;&nbsp;&nbsp;</code></div><div><code>&nbsp;&nbsp;&nbsp;&nbsp;</code><code>&lt;</code><code>ul</code><code>&gt;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code></div><div><code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><code>&lt;</code><code>li</code><code>&gt; Пункт 1 &lt;/</code><code>li</code><code>&gt;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code></div><div><code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><code>&lt;</code><code>li</code><code>&gt; Пункт 2 &lt;/</code><code>li</code><code>&gt;&nbsp;&nbsp;</code></div><div><code>&nbsp;&nbsp;&nbsp;&nbsp;</code><code>&lt;/</code><code>ul</code><code>&gt;&nbsp;&nbsp;</code></div><div><code>&nbsp;&nbsp;&nbsp;&nbsp;</code><code>&lt;</code><code>ul</code><code>&gt;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code></div><div><code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><code>&lt;</code><code>li</code><code>&gt;&nbsp;Пункт 3 &lt;/</code><code>li</code><code>&gt;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code></div><div><code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><code>&lt;</code><code>li</code><code>&gt; Пункт 4 &lt;/</code><code>li</code><code>&gt;&nbsp;&nbsp;</code></div><div><code>&nbsp;&nbsp;&nbsp;&nbsp;</code><code>&lt;/</code><code>ul</code><code>&gt;</code></div><div><code>&lt;</code><code>div</code><code>&gt;</code></div></div></td></tr></tbody></table></div></div>
<p>А теперь попытайтесь понять как
выделить пункт 2.</p>
<p>Решение 1</p>
<div><div><table border="0" cellpadding="0" cellspacing="0"><tbody><tr><td><div><div><code>ul:first-of-type &gt; li:nth-child(</code><code>2</code><code>) { </code><code>font-weight</code><code>: </code><code>bold</code><code>; }</code></div></div></td></tr></tbody></table></div></div>
<p>Решение 2</p>
<div><div><table border="0" cellpadding="0" cellspacing="0"><tbody><tr><td><div><div><code>p + ul li:last-child { </code><code>font-weight</code><code>: </code><code>bold</code><code>; }</code></div></div></td></tr></tbody></table></div></div>
<p>Решение 3</p>
<div><div><table border="0" cellpadding="0" cellspacing="0"><tbody><tr><td><div><div><code>ul:first-of-type li:nth-last-child(</code><code>1</code><code>) { </code><code>font-weight</code><code>: </code><code>bold</code><code>; }</code></div></div></td></tr></tbody></table></div></div>
<p><a target="_blank" href="[[~88]]">Демо</a></p>
Совместимость:
<ul class="caniuse">
<li>IE9 +</li>
<li>Firefox 3,5 +</li>
<li>Хром</li>
<li>Safari</li>
<li>Опера</li>
</ul>
<p>Source: <a target="_blank" href="http://net.tutsplus.com/tutorials/html-css-techniques/the-30-css-selectors-you-must-memorize/">tutsplus.com</a></p>
            <div></div>
        </div>