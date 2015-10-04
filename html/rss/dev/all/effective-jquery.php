<h1>Эффективное использование jQuery</h1>

<p><h3>1. Предисловие</h3>

<p>Я бы хотел начать эту статью с цитаты Джона Ресига (John Resig), основного идеолога jQuery и корпорации Mozilla.

<p><blockquote>Я думаю, вы переоцениваете полезность jQuery. Используя его пользователи теперь ограничены селекторами которые могут использовать (они могут использовать, только то, что предоставляет браузер и полагаться на милость кросс-браузерных багов) и это большая проблема. Не говоря уже о том что jQuery призывает к смешиванию html разметки, css и javascript.</blockquote>

<p>В этой статье я хочу показать что в умелых руках и хуй — балалайка.

<p>Итак начнем настраивать наш… инструмент с самого начала.

<p><h3>2. Selectors</h3>

<p>Начну, пожалуй, с самого начала, с функции $, она принимает два параметра: первый — селектор, второй — контекст. Хотя контекст обычно опускают, я в последствии покажу как им грамотно пользоваться.

<p><h4>2.1. Простой селект</h4>

<p>Самый простой вариант это выбор по id, имени тега и имени класса.

<p><pre><code class="javascript hljs">
$(<span class="hljs-string">"#id"</span>)
$(<span class="hljs-string">"tag"</span>)
$(<span class="hljs-string">".class"</span>)
</code></pre>

<p>Я не случайно расположил их именно в такой последовательности, они идут по сложности алгоритма выборки. В первом случаи вызов функции эквивалентен вызову:

<p><pre><code class="javascript hljs ">
<span class="hljs-built_in">document</span>.getElementById(<span class="hljs-string">"id"</span>);
</code></pre>

<p>Поскольку предполагается что id уникальный то поиск проходит очень быстро, и если на странице есть два элемента с таким id то найден будет только первый. Хот я в IE и тут накосячили и до 7 версии включительно в случаи отсутствия элемента с таким id он вернет элемент у которого совпадает атрибут name.

<p>Во втором случаи тоже всё относительно просто:

<p><pre><code class="javascript hljs ">
<span class="hljs-built_in">document</span>.getElementsByTagName(<span class="hljs-string">"tag"</span>);
</code></pre>

<p>Получили все ноды с таким именем из документа и все готово. И на удивление никаких косяков, если не учитывать что при запросе getElementsByTagName(«*») IE вернет и комментарии тоже.

<p>В третьем случаи если есть возможность работу перехватывает:

<p><pre><code class="javascript hljs ">
<span class="hljs-built_in">document</span>.getElementsByClassName(<span class="hljs-string">"class"</span>);
</code></pre>

<p>(Табличку поддерживаемости этой функции смотрите на <a href="http://www.quirksmode.org/dom/w3c_core.html">quirksmode.org</a>)

<p>Но эту функцию поддерживают уже не все браузеры. Для остальных применяется совсем другой алгоритм — нужно получить абсолютно все ноды, потом обойти их циклом проверяя имена классов, и если совпали то добавить в массив результата.

<p><pre><code class="javascript hljs">
<span class="hljs-keyword">var</span> nodes = <span class="hljs-built_in">document</span>.getElementsByTagName(<span class="hljs-string">"*"</span>), result = [];
<span class="hljs-keyword">for</span> (<span class="hljs-keyword">var</span> i=<span class="hljs-number">0</span>; i&lt;nodes.length; i++){
    <span class="hljs-keyword">if</span>(<span class="hljs-string">" "</span> + (nodes[i].className || nodes[i].getAttribute(<span class="hljs-string">"class"</span>)) + <span class="hljs-string">" "</span>).indexOf(<span class="hljs-string">"class"</span>) &gt; -<span class="hljs-number">1</span>)
        result.push(nodes[i]);
}
</code></pre>

<p>Какой метод использовать определяется в самом начале при подключении библиотеки.

<p><h4>2.2. Селекст через querySelectorAll</h4>

<p>Но это все подходит только для элементарных селекторов. А на практике приходится обычно использовать намного более сложные конструкции. И для них в современных браузерах FireFox 3.0, Safari 3.2, Opera 9.5 в том числе и в IE8 появились функция querySelector и querySelectorAll. Они соответственно предназначены для поиска одной или нескольких нод по CSS3 селекторам. Если браузер клиента поддерживает эту функцию то все о чем мы говорили в прошлом пункте — отпадает и поиск происходит через querySelectorAll.

<p><pre><code class="javascript hljs ">
$(<span class="hljs-string">"#id .class tag"</span>)
</code></pre>

<p>В лучшем случаи селектор будет обработан именно querySelectorAll потому что он написан по правилам CSS3. Но так можно не со всеми селекторами, jQuery поддерживает ряд селекторов которые не входят в CSS3 такие, например, как :visible.

<p><pre><code class="javascript hljs ">
$(<span class="hljs-string">"#id .class tag:visible"</span>)
</code></pre>

<p>Такой селектор выдаст ошибку в функции querySelectorAll и селектор будет перенаправлен в поисковый движок Sizzle где строка будет разбита на простые селекторы и превратится по сути в несколько разных поисков в котором каждым следующим контекстом является предыдущий селектор.

<p><pre><code class="javascript hljs ">
$(<span class="hljs-built_in">document</span>).find(<span class="hljs-string">"#id"</span>).find(<span class="hljs-string">".class"</span>).find(<span class="hljs-string">"tag"</span>).filter(<span class="hljs-string">":visible"</span>)
</code></pre>

<p>Скорость этого метода поиска напрямую зависит от величины DOM дерева, чем оно больше — тем медленнее, но её можно значительно увеличить написав селектор раздельно.

<p><pre><code class="javascript hljs ">
$(<span class="hljs-string">"#id .class tag"</span>).filter(<span class="hljs-string">":visible"</span>)
</code></pre>

<p>При этом querySelectorAll выберет все ноды, а Sizzle разберется с «:visible»

<p>По поводу псевдо-селекторов тоже кстати очень интересный вопрос: CSS3 поддерживает несколько видов псевдо-классов такие как :nth-of-type/:nth-child/:parent/:not/:checked , jQuery имеет свою реализацию этих селекторов для браузеров не поддерживающих querySelectorAll или для браузеров в которых querySelectorAll не поддерживает данный селектор (табличку поддерживаемости селекторов смотрите на <a href="http://www.quirksmode.org/css/contents.html" rel="nofollow external">quirksmode.org</a>), но эта реализация иногда отличается. Для примера возьмем псевдо-класс :nth-of-type и выберем все четные дивы а из них все нечетные.

<p><pre><code class="javascript hljs ">
<span class="hljs-built_in">document</span>.querySelectorAll(<span class="hljs-string">"div:nth-of-type(even):nth-of-type(odd)"</span>) <span class="hljs-comment">// Safari/FireFox:0  IE/Opera:N/A</span>
$(<span class="hljs-string">"div:nth-of-type(even):nth-of-type(odd)"</span>); <span class="hljs-comment">// Safari/FireFox:0  IE/Opera:All</span>
$(<span class="hljs-string">"div:even:odd"</span>); <span class="hljs-comment">// All: вернут 1,5,9 дивы </span>
</code></pre>

<p>Первых два примера работают одинаково и вернут либо 0, если отработала функция querySelectorAll (это касается первого примера), либо все элементы, потому что их обработал Sizzle (это особенность реализации выражения «:»), а третий вернет 1, 5, 9 и тд. элементы, а значит селекторы отрабатывали в три прохода, сначала из всего дом дерева были выбраны все дивы, потом из них были выбраны все нечётные, а потом из оставшихся были выбраны все чётные.
<p>jQuery так же имеет набор псевдо-селекторов который не входят в CSS3 и обслуживаются только Sizzle’ом :visible/:animated/:input/:header. Их лучше выделять отдельно так как они могут сильно замедлить выборку. Так например было с селекторами :visible/:hidden в версии 1.2.6, для того чтобы узнать видимый элемент или нет надо было подняться до самого верха по DOM-дереву проверяя атрибуты display и visible каждого родителя. <a href="/2009/02/07/accelerates-selectors-in-jquery/">[пруфлинк]</a></p>
<pre><code class="javascript hljs ">
$(<span class="hljs-string">"div"</span>).filter(<span class="hljs-string">":visible"</span>)
</code></pre>

<p>Псевдо-классы используемые для поиска элементов формы такие как :radio тоже имеют некоторое преимущество если не используется querySelectorAll в противном случаи CSS3 селектор input[type=radio] работает быстрее

<p><h4>2.3. Сложенный селект</h4>

<p>Сложенный селект это когда нам надо выбрать группу из двух или более разных селекторов, например все дивы у которых класс равен A, B и C</p>
<p>Это можно сделать двумя способами</p>
<pre><code class="javascript hljs ">
$(<span class="hljs-string">".a,.b,.c"</span>)
</code></pre>
<p>выбрать все сразу</p>
<pre><code class="javascript hljs ">
$(<span class="hljs-string">".a"</span>).add(<span class="hljs-string">".b"</span>).add(<span class="hljs-string">".c"</span>)
</code></pre>
<p>или по одному.</p>
<p>При этом если задействована функция querySelectorAll то первый быстрее второго в четыре раза, а если нет то второй в два раза быстрее первого.</p>
<p>Если уже заговорили про классы их можно искать как любые другие атрибуты например если надо найти все классы имена которых начинаются на «my» можно сделать так</p>
<pre><code class="javascript hljs ">
$(<span class="hljs-string">"[class^=my]"</span>)
</code></pre>
<p>а не городить логику с использованием add, тем более что такой способ поддерживается querySelectorAll. <a href="/2009/02/21/testing-productivity-jquery-selectors/">[пруфлинк]</a></p>

<h4>2.4. Неправильный селект в контексте</h4>
<p>На сайте <a href="http://www.tvidesign.co.uk/blog/improve-your-jquery-25-excellent-tips.aspx" rel="nofollow external">tvidesign.co.uk</a> в одной очень популярной статье «Improve your jQuery — 25 excellent tips» которую перевели на русский и перепечатывают где только не лень, начиная с Хабра, написано что селект лучше делать в контексте и приведен вот такой пример:</p>
<pre><code class="javascript hljs ">
$(<span class="hljs-string">'#listItem'</span> + i, $(<span class="hljs-string">'.myList'</span>))
</code></pre>
<p>Я не спорю что Jon Hobbs-Smith иммет неплохое портфолио но тем не менее он ничего не знает о jQuery. Да и вообще статьи начинающиеся на «100-500 советов» попахивают несостоятельностью автора излагать свою мысль последовательно, не говоря уже о том что все эти советы Капитан Очевидность уже давно нам дал в мануалах, факах и руководствах.</p>
<p>Рассмотрим пример подробнее: контекст это то, где ищут селектор, значит пример можно переписать в более наглядную но менее читаемую форму</p>
<pre><code class="javascript hljs ">
$($(<span class="hljs-string">".myList"</span>)).find(<span class="hljs-string">"#listItem"</span>)
</code></pre>
<p>При этом контекст от первого поиска будет являться document.</p>
<pre><code class="javascript hljs ">
$($(<span class="hljs-string">".myList"</span>,<span class="hljs-built_in">document</span>)).find(<span class="hljs-string">"#listItem"</span>)
</code></pre>
<p>Еще раз перепишу согласно формуле.</p>
<pre><code class="javascript hljs ">
$($(<span class="hljs-built_in">document</span>).find(<span class="hljs-string">".myList"</span>)).find(<span class="hljs-string">"#listItem"</span>)
</code></pre>
<p>И наконец раскроем скобки</p>
<pre><code class="javascript hljs ">
$(<span class="hljs-built_in">document</span>).find(<span class="hljs-string">".myList"</span>).find(<span class="hljs-string">"#listItem"</span>)
</code></pre>
<p>Что же получается мы выполняем дорогостоящую операцию поиска по имени класса (по всему DOM-дереву в худшем случаи) для того чтобы упростить и без того самую простую операцию поиска по id. БРЕД!</p>

<h4>2.5. Правильный селект в контексте</h4>
<p>Правильно делать с точностью да наоборот. В контекст надо указывать id элемента.</p>
<pre><code class="javascript hljs ">
$(<span class="hljs-string">".class"</span>,$(<span class="hljs-string">"#id"</span>))
</code></pre>
<p>Только вот я не понимаю зачем вообще в контекст передавать jQuery объект вполне достаточно.</p>
<pre><code class="javascript hljs ">
$(<span class="hljs-string">".class"</span>,<span class="hljs-string">"#id"</span>)
</code></pre>
<p>Это можно переписать как.</p>
<pre><code class="javascript hljs ">
$(<span class="hljs-string">"#id"</span>).find(<span class="hljs-string">".class"</span>)
</code></pre>
<p>Можно еще больше ускорить работу, если искать вот таким способом:</p>
<pre><code class="javascript hljs ">
$(<span class="hljs-built_in">document</span>.getElementById(<span class="hljs-string">"id"</span>)).find(<span class="hljs-string">".class"</span>)
</code></pre>
<p>Но это ИМХО будет уже плохим тоном. Хотя поэкспериментировать интересно, что если вместо getElementById взять querySelectorAll</p>
<pre><code class="javascript hljs ">
$(<span class="hljs-string">"div"</span>,<span class="hljs-built_in">document</span>.querySelectorAll(<span class="hljs-string">"#id"</span>))
</code></pre>
<p>Это примерно тоже самое что и</p>
<pre><code class="javascript hljs ">
$(<span class="hljs-string">"div"</span>,[<span class="hljs-built_in">document</span>.getElementById(<span class="hljs-string">"id"</span>)])
</code></pre>
<p>Не прироста производительности ни красоты кода из этого не получить, поэтому советую в контекст передавать что-то простое вроде id или при использовании псевдо-селекторов обрабатываемых Sizzle’ом передавать их в селектор а все остальное в контекст</p>
<pre><code class="javascript hljs ">
$(<span class="hljs-string">":visible"</span>,<span class="hljs-string">"input[type=checkbox]"</span>)
</code></pre>
<p>Ну раз уже заговорили о псевдо-селекторах то</p>
<pre><code class="javascript hljs ">
$(<span class="hljs-string">":checkbox"</span>)
</code></pre>
<p>быстрее чем</p>
<pre><code class="javascript hljs ">
$(<span class="hljs-string">"input[type=checkbox]"</span>)
</code></pre>
<p>без использования querySelectorAll и наоборот.</p>

<h4>2.6. Cложный селест</h4>
<p>Часто возникает задача найти всех потомков одного родителя, если нам известно что все потомки являются непосредственными, то есть детьми, то на этом можно сэкономить. Конечно же лучше всего было бы написать правильный селектор</p>
<pre><code class="javascript hljs ">
$(<span class="hljs-string">"#id &gt; div"</span>)
</code></pre>
<p>Но если выборка уже есть то будем использовать ее как контекст. Как мы уже выяснили поиск в контексте происходит при помощи функции find</p>
<pre><code class="javascript hljs ">
$(<span class="hljs-string">"#id"</span>).find(<span class="hljs-string">"&gt; div"</span>)
</code></pre>
<p>Но find очень дорогая функция, она просматривает абсолютно всех потомков контекста, поэтому лучше использовать функцию children, она просматривает только непосредственных потомков.</p>
<pre><code class="javascript hljs ">
$(<span class="hljs-string">"#id"</span>).children(<span class="hljs-string">"div"</span>)
</code></pre>
<p>Есть еще ряд функций поиска и манипуляций которых стоит избегать без крайней необходимости это: find, closest, wrap, wrapInner, replaceWith, clone. Заметте wrapAll сюда не входит. <a href="/2009/03/29/jquery-profiling/">[пруфлинк]</a></p>

<h3>3. Cache</h3>

<h4>3.1. Внутреннее кеширование</h4>
<p>Кеш у jQuery крайне не развит, если не сказать отсутствует, поэтому кешируется только предыдущий элемент выбранный в цепочке. Это можно наглядно рассмотреть на двух примерах.</p>
<p>Ситуация такая, вы работаете со списком у вас если один из элементов li для того чтобы получить все элементы включая текущий надо выбрать всех братьев (все у кого родитель это родитель текущего) этого элемента и добавляем его самого</p>
<pre><code class="javascript hljs ">
$(<span class="hljs-string">"#id"</span>).siblings().add(<span class="hljs-string">"#id"</span>)
</code></pre>
<p>Так как он — прошлый элемент, с которым работали в цепочке вызовов, мы можем взять его из кеша.</p>
<pre><code class="javascript hljs ">
$(<span class="hljs-string">"#id"</span>).siblings().andSelf()
</code></pre>
<p>Конечно в данном конкретном случаи быстрее было бы сделать</p>
<pre><code class="javascript hljs ">
$(<span class="hljs-string">"#id"</span>).parent().children()
</code></pre>
<p>Потому что siblings это и есть выбор всех детей родителя. Но я думаю что принцип использования этот пример иллюстрирует нормально.</p>
<p>Второй пример использования кеша это простой возврат к предыдущей выборке, вместо того чтобы размазывать код на три строчки</p>
<pre><code class="javascript hljs ">
<span class="hljs-keyword">var</span> elt = $(<span class="hljs-string">"#id"</span>);
elt.children().css({<span class="hljs-comment">/**/</span>})
elt.click();
</code></pre>
<p>Можно после работы с детьми вернуться обратно к родителю и работать с ним дальше</p>
<pre><code class="javascript hljs ">
$(<span class="hljs-string">"#id"</span>).children().css({<span class="hljs-comment">/**/</span>}).end().click()
</code></pre>

<h4>3.2. Кеширование селекторов</h4>
<p>Поскольку кеш так слабо развит, селекторы нужно кешировать вручную. Возьмем например вот такой код</p>
<pre><code class="javascript hljs ">
<span class="hljs-keyword">for</span>(<span class="hljs-keyword">var</span> i=<span class="hljs-number">0</span>;i&lt;<span class="hljs-number">1000</span>;i++)
    $(<span class="hljs-string">"ul"</span>).append(<span class="hljs-string">"&lt;li&gt;"</span>+i+<span class="hljs-string">"&lt;/li&gt;"</span>)
</code></pre>
<p>Все работает и выглядит красиво, но это можно оптимизировать если вынести выборку за пределы цикла добавление новых элементов будет проходить быстрее</p>
<pre><code class="javascript hljs ">
<span class="hljs-keyword">var</span> elts = $(<span class="hljs-string">"ul"</span>);
<span class="hljs-keyword">for</span>(<span class="hljs-keyword">var</span> i=<span class="hljs-number">0</span>;i&lt;<span class="hljs-number">1000</span>;i++)
    elts.append(<span class="hljs-string">"&lt;li&gt;"</span>+i+<span class="hljs-string">"&lt;/li&gt;"</span>)
</code></pre>

<h4>3.3. Буферизация</h4>
<p>Но и это еще не все, этот код можно заставить работать еще быстрее. Каждый раз делая append мы заставляем обновиться DOM-дерево и заставляем браузер перерисовать страницу. Этого можно избежать придерживая вставку в DOM-дерево.</p>
<pre><code class="javascript hljs ">
<span class="hljs-keyword">var</span> str = <span class="hljs-string">""</span>;
<span class="hljs-keyword">for</span>(<span class="hljs-keyword">var</span> i=<span class="hljs-number">0</span>;i&lt;<span class="hljs-number">1000</span>;i++)
    str += <span class="hljs-string">"&lt;li&gt;"</span>+i+<span class="hljs-string">"&lt;/li&gt;"</span>
$(<span class="hljs-string">"ul"</span>).html(str);
</code></pre>
<p>Дело в том что функции для работы с DOM-деревом у jQuery самые "тяжелые" <a href="/2009/03/29/jquery-profiling/">[пруфлинк]</a>. Это просто объясняется. Все html ноды на которые повешены события через jQuery имею в себе атрибут с объектом jQuery. При удалении этих нод нужно следить чтобы не было утечек памяти и удаляет эти атрибуты перед удалением ноды. В результате функции html и text вызывают функции полной очистки и только потом вставки нового содержимого.</p>
<pre><code class="javascript hljs ">
jQuery(DOMElement).empty().append(text)
</code></pre>
<p>Функция empty выбирает все ноды и по очереди удаяет</p>
<pre><code class="javascript hljs ">
jQuery(DOMElement).children().remove()
</code></pre>
<p>А функция remove уже заботится чтобы из элементов были удалены все дополнительные данные и события</p>
<p>Джон Ресиг (John Resig) утверждал что знает способ быстро удалить все это и что улучшит эти методы, но что-то воз и ныне там. Поэтому будем ждать улучшенных функций уже в jQuery 1.4 </p>

<h4>3.4. Создание "на лету"</h4>
<p>Прошлый пример на самом деле был нужен, для того что бы я подобрался поближе к интересненькому. Часто приходится создавать какие-то вспомогательные дивы, естественно меня заинтересовал самый эргономичный способ это сделать. Казалось бы в чем проблема кинул кусок html кода в и jQuery сама все сделала. Возьмем самый простой и банальный пример надо создать пустой див.</p>
<pre><code class="javascript hljs ">
$(<span class="hljs-string">"&lt;div&gt;&lt;/div&gt;"</span>)
</code></pre>
<p>или</p>
<pre><code class="javascript hljs ">
$(<span class="hljs-string">"&lt;div/&gt;"</span>)
</code></pre>
<p>Второй вариант в 5 раз быстрее первого. Но это естественно не все, что если нам надо создать не пустой див, а содержащий текст, из прошлых заметок станет ясно что функция text тяжелая и выгоды от нее не будет и стоит создавать див как есть.</p>
<pre><code class="javascript hljs ">
$(<span class="hljs-string">"&lt;div&gt;text&lt;/div&gt;"</span>)
</code></pre>
<p>А не создавать а потом добавлять текст</p>
<pre><code class="javascript hljs ">
$(<span class="hljs-string">"&lt;div/&gt;"</span>).text(<span class="hljs-string">"text"</span>)
</code></pre>
<p>Но это не каcается создания атрибутов, для них используются намного более "легкие" функции attr/css/addClass <a href="/2009/03/29/jquery-profiling/">[пруфлинк]</a>, вот тут то и имеет смысл вместо</p>
<pre><code class="javascript hljs ">
$(<span class="hljs-string">"&lt;div style='background:red;'/&gt;"</span>)
</code></pre>
<p>писать</p>
<pre><code class="javascript hljs ">
$(<span class="hljs-string">"&lt;div/&gt;"</span>).css({background:<span class="hljs-string">'red'</span>});
</code></pre>
<p>это даст небольшой, но выигрыш.</p>

<h3>4. Events</h3>

<h4>4.1. Множественные события</h4>
<p>Иногда возникает необходимость повесить одно и тоже действие на несколько событий, это приводит к созданию новых функций либо к копи-пасте. Этого легко можно избежать. Например нужно задать размер дива при загрузке и изменять его при изменении размеров окна.</p>
<pre><code class="javascript hljs ">
$(<span class="hljs-built_in">window</span>).bind(<span class="hljs-string">"resize load"</span>,<span class="hljs-literal">null</span>,<span class="hljs-function"><span class="hljs-keyword">function</span><span class="hljs-params">()</span></span>{
    $(<span class="hljs-string">"#id"</span>).css({width:<span class="hljs-built_in">document</span>.clientWidth})
});
</code></pre>
<p>Только при этом не забываем что IE8 ведет себя не корректно и при загрузке страницы сначала происходит событие resize а только потом load.</p>
<p>Тоже самое корректно и в обратную сторону.</p>
<pre><code class="javascript hljs ">
$(<span class="hljs-built_in">window</span>).unbind(<span class="hljs-string">"resize load"</span>);
</code></pre>
<p>Но это не работает в версии 1.2.6, точнее это работает только с именованными функциями а с анонимными не работает, их надо удалять по одной.</p>.

<h4>4.2. Одно событие на много элементов</h4>
<p>Если случается повесить события на длинный список.</p>
<pre><code class="javascript hljs ">
<span class="hljs-keyword">var</span> ul = $(<span class="hljs-string">"&lt;ul/&gt;"</span>);
<span class="hljs-keyword">for</span>(<span class="hljs-keyword">var</span> i=<span class="hljs-number">0</span>,j=<span class="hljs-number">1000</span>;i&lt;j;i++)
    $(<span class="hljs-string">"&lt;li&gt;"</span>+i+<span class="hljs-string">"&lt;/li&gt;"</span>).click(<span class="hljs-function"><span class="hljs-keyword">function</span><span class="hljs-params">(e)</span></span>{
        alert(<span class="hljs-keyword">this</span>.innerHTML);
    }).appendTo(ul);

ul.appendTo(<span class="hljs-string">"body"</span>);
</code></pre>
<p>То в результате мы будем иметь 1000 одинаковых обработчиков событий, вряд ли это добавит скорости вашей странице, поэтому можно воспользоваться маленькой хитростью и повесить всего один обработчик на родительский элемент.</p>
<pre><code class="javascript hljs ">
<span class="hljs-keyword">var</span> str = <span class="hljs-string">""</span>;
<span class="hljs-keyword">for</span>(<span class="hljs-keyword">var</span> i=<span class="hljs-number">0</span>,j=<span class="hljs-number">1000</span>;i&lt;j;i++)
    str += <span class="hljs-string">"&lt;li&gt;"</span>+i+<span class="hljs-string">"&lt;/li&gt;"</span>;
$(<span class="hljs-string">"&lt;ul/&gt;"</span>)
    .append(str)
    .click(<span class="hljs-function"><span class="hljs-keyword">function</span><span class="hljs-params">(e)</span></span>{
        alert(e.target.innerHTML);
    })
    .appendTo(<span class="hljs-string">"body"</span>);
</code></pre>

<p>Дата: 10/08/2009

<p>Источник: http://mabp.kiev.ua/2009/08/10/presentation-from-coffee-n-code/