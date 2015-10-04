<div id="main" class="content content-primary hentry">
						<div class="heading-group heading-article">
							<h1 class="heading entry-title"><a href="http://web-standards.ru/articles/vertical-align/" rel="bookmark">Разбираемся с vertical-align</a></h1>
							<p>
								<span class="vcard"><a href="http://www.impressivewebs.com/" class="user fn n url author"><span class="first-name">Луис&nbsp;Лазарис</span>&nbsp;<span class="last-name"></span></a></span>								<abbr class="published" title="2012-03-09T15:07:02+00:00">9 марта 2012</abbr>
							</p>
						</div>
						<div class="content-article entry-content">
							<p>«Опять <code>vertical-align</code> не&nbsp;работает!»&nbsp;— вздохнёт веб-разработчик.</p>
<p>CSS-свойство <code>vertical-align</code> — одно из тех, которые с&nbsp;виду очень просты, но&nbsp;могут вызвать вопросы у&nbsp;начинающих разработчиков. Я&nbsp;думаю, что даже у&nbsp;многих ветеранов CSS когда-то были проблемы с&nbsp;тем, чтобы его до&nbsp;конца понять.</p>
<p>В этой статье я&nbsp;постараюсь в&nbsp;понятной форме рассказать про это свойство.</p>

<h2>Чего оно не&nbsp;делает</h2>
<p>Распространенное заблуждение о&nbsp;<code>vertical-align</code> состоит в&nbsp;том, что применяясь к&nbsp;одному элементу, оно заставляет все элементы внутри него изменить свою вертикальную позицию. Например, когда элементу задан <code>vertical-align:top</code>, это подразумевает, что его содержимое поднимется к&nbsp;его же&nbsp;верхней границе.</p>
<p>Вспоминаются времена, когда мы делали раскладки на основе таблиц:</p>

<pre><code>&lt;td valign="top"&gt;</code>
<code>    Что-нибудь…</code>
<code>&lt;/td&gt;</code>
</pre>

<p>В&nbsp;данном примере с&nbsp;ячейкой таблицы использование свойства <code>valign</code> (в&nbsp;настоящее время <a href="http://www.w3.org/TR/html5/obsolete.html#non-conforming-features">исключенного из&nbsp;HTML5</a>) приведёт к&nbsp;тому, что элементы внутри ячейки прижмутся к&nbsp;её&nbsp;верху. И&nbsp;естественно, когда верстальщики начинают использовать <code>vertical-align</code>, они думают, что получится то&nbsp;же&nbsp;самое, и&nbsp;содержимое элемента выровняется в&nbsp;соответствии со&nbsp;значением свойства.</p>
<p>Но <code>vertical-align</code> работает не&nbsp;так.</p>

<h2>Чем оно является на&nbsp;самом деле</h2>
<p>Использование свойства <code>vertical-align</code> может быть разбито на&nbsp;три простых для понимания правила:</p>

<ol>
<li>Оно применяется только к&nbsp;строчным элементам <code>inline</code> или строчным блокам <code>inline-block</code>.</li>
<li>Оно влияет на&nbsp;выравнивание самого элемента, а&nbsp;не&nbsp;его содержимого (кроме случаев, когда применяется к&nbsp;ячейкам таблицы).</li>
<li>Когда оно применяется к&nbsp;ячейке таблицы, выравнивание влияет на&nbsp;содержимое ячейки, а&nbsp;не на&nbsp;неё саму.</li>
</ol>

<p>Иными словами, следующий код не&nbsp;даст никакого эффекта:</p>

<pre><code>div {</code>
<code>    vertical-align:middle; /* эта строка бесполезна */</code>
<code>    }</code>
</pre>

<p>Почему? Потому что <code>&lt;div&gt;</code>&nbsp;— это не&nbsp;строчный элемент и&nbsp;даже не&nbsp;строчный блок. Конечно, если вы&nbsp;сделаете его строчным или строчным блоком, то&nbsp;применение <code>vertical-align</code> даст желаемый эффект.</p>

<p>С&nbsp;другой стороны, при правильном применении (к&nbsp;строчному элементу или строчному блоку), свойство <code>vertical-align</code> заставит текущий элемент выровняться относительно других строчных элементов.</p>

<p>Выше или ниже расположится элемент, будет зависеть от&nbsp;высоты строчных элементов на&nbsp;этой&nbsp;же строке или от&nbsp;свойства <code>line-height</code>, заданного для неё.</p>

<h2>Несколько картинок</h2>

<p>Вот картинка с&nbsp;пояснительным текстом, которая поможет вам понять, что происходит при вертикальном выравнивании строчных элементов:</p>

<img src="http://static.web-standards.ru/articles/vertical-align/vertical-align.png" class="pic" alt="">

<p><a href="http://jsbin.com/isuvob/edit#html,live">А&nbsp;вот пример</a>, в&nbsp;котором есть несколько строчных элементов, один из&nbsp;которых прижат к&nbsp;верху.</p>

<h2>Ключевые слова</h2>

<p>Несколько ключевых слов, которые можно задавать в качестве значений для свойства <code>vertical-align</code>:</p>

<ul>
<li><code>baseline</code>, значение по умолчанию или «изначальное»</li>
<li><code>bottom</code></li>
<li><code>middle</code></li>
<li><code>sub</code></li>
<li><code>super</code></li>
<li><code>text-bottom</code></li>
<li><code>text-top</code></li>
<li><code>top</code></li>
</ul>

<p>Возможно, многие из&nbsp;них вы&nbsp;не&nbsp;будете использовать, но&nbsp;было&nbsp;бы неплохо знать все имеющиеся варианты. Например, <a href="http://jsbin.com/isuvob/edit#html,live">на&nbsp;демо-странице</a>, из-за того что значение <code>vertical-align</code> для <code>&lt;input&gt;</code> установлено как <code>top</code>, он&nbsp;выровнен по&nbsp;самому высокому элементу в&nbsp;строке (большой картинке).</p>

<p>Однако если вы&nbsp;не&nbsp;хотите выравнивать элемент относительно картинок или других строчных элементов, обладающих блочными свойствами, вы&nbsp;можете выбрать значение <code>text-top</code> или <code>text-bottom</code>, тогда элементы будут выравниваться относительно текста в&nbsp;строке.</p>

<h2>О&nbsp;ключевом слове <code>middle</code></h2>

<p>К&nbsp;сожалению, правило <code>vertical-align:middle</code> не&nbsp;выровняет строчный элемент по&nbsp;середине самого высокого элемента в&nbsp;строке (как вы,&nbsp;возможно, ожидали). Вместо этого значение <code>middle</code> заставит элемент выровняться по&nbsp;середине высоты гипотетической строчной буквы <strong>«x»</strong> (так&nbsp;же&nbsp;называемой <i>x-height</i>). Потому, мне кажется, что это значение на&nbsp;самом деле должно называться <code>text-middle</code>, чтобы стало понятно, какой будет результат.</p>

<p>Взгляните <a href="http://jsbin.com/apiqog/edit#html,live">на&nbsp;пример</a>, где я&nbsp;увеличил размер шрифта так, чтобы размер <i>x-height</i> стал гораздо больше. После этого станет понятно, что значение <code>middle</code> не&nbsp;получится использовать очень часто.</p>

<h2>Числовые значения</h2>

<p>Возможно, вы&nbsp;не&nbsp;знали о&nbsp;том, что <code>vertical-align</code> принимает числовые и&nbsp;процентные значения. Однако это так, и&nbsp;вот примеры их&nbsp;использования:</p>

<pre><code>input {</code>
<code>    vertical-align:100px;</code>
<code>    }</code>
<code>span {</code>
<code>    vertical-align:50%;</code>
<code>    }</code>
<code>img {</code>
<code>    vertical-align:-300px;</code>
<code>    }</code>
</pre>

<p>Несмотря на&nbsp;то, что вы&nbsp;можете прочитать <a href="http://www.w3.org/TR/CSS21/visudet.html#propdef-vertical-align">в&nbsp;спецификации</a> раздел, описывающий, какие есть ключевые слова и&nbsp;значения, я&nbsp;думаю, гораздо полезней будет самостоятельно <a href="http://jsbin.com/isuvob/edit#html,live">поиграть с&nbsp;ними</a> и&nbsp;сравнить результаты.</p>

<h2>Заключение</h2>

<p>Если в&nbsp;одной фразе подводить итог о&nbsp;том, как использовать это традиционно неправильно понимаемое свойство, я&nbsp;бы&nbsp;сказал:</p>

<p>Свойство <code>vertical-align</code> работает только со&nbsp;строчными элементами или строчными блоками и&nbsp;ячейками таблицы. В случае применения не&nbsp;к&nbsp;ячейкам таблицы, оно действует на&nbsp;сам элемент, а&nbsp;не на&nbsp;его содержимое.</p>

<p class="note note-last">Перевод оригинальной статьи «<a href="http://www.impressivewebs.com/css-vertical-align/">Understanding CSS’s vertical-align Property</a>» <a href="http://www.impressivewebs.com/about/">Луиса&nbsp;Лазариса</a> (Louis&nbsp;Lazaris), опубликованной на&nbsp;сайте «<a href="http://www.impressivewebs.com/">Impressive&nbsp;Webs</a>».</p>
<p class="note">Перевод выполнил <a href="http://htmlhero.ru/">Андрей&nbsp;Мотошин</a>.</p>														<script src="//yandex.st/share/share.js"></script>
							
													</div>
						
					</div>