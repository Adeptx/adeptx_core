<div id="post-699" class="post-699 post type-post status-publish format-standard hentry category-jquery category-news tag-jquery tag-select" style="margin:0 0 5px;">
    	   <h2>jQuery работа с select</h2>
       <br>
	   <div class="entry">
          <div class="postbody entry clearfix">
	       <p>Очень часто приходится сталкиваться с выпадающим HTML списком <span style="color: #888888;">&lt;select&gt;</span>, по этому на заметку оставлю несколько селекторов jQuery.</p>
<p><span id="more-699"></span></p>
<p>Например, у нас имеется простенький <strong><span style="color: #888888;">&lt;select id=”my_select” name=”my_select”&gt;</span></strong> с id=”my_select”</p>
<div id="highlighter_492810" class="syntaxhighlighter "><div class="bar  "><div class="toolbar"><a href="#viewSource" title="view source" class="item viewSource" style="width: 16px; height: 16px;">view source</a><a href="#printSource" title="print" class="item printSource" style="width: 16px; height: 16px;">print</a><a href="#about" title="?" class="item about" style="width: 16px; height: 16px;">?</a></div></div><div class="lines"><div class="line alt1"><code class="number">1.</code><span class="content"><span class="block" style="margin-left: 0px !important;"><code class="plain">&lt;</code><code class="keyword">select</code> <code class="color1">id</code><code class="plain">=</code><code class="string">"my_select"</code> <code class="color1">name</code><code class="plain">=</code><code class="string">"my_select"</code><code class="plain">&gt;</code></span></span></div><div class="line alt2"><code class="number">2.</code><span class="content"><span class="block" style="margin-left: 0px !important;"><code class="plain">&lt;</code><code class="keyword">option</code> <code class="color1">value</code><code class="plain">=</code><code class="string">"1"</code><code class="plain">&gt;one&lt;/</code><code class="keyword">option</code><code class="plain">&gt;</code></span></span></div><div class="line alt1"><code class="number">3.</code><span class="content"><span class="block" style="margin-left: 0px !important;"><code class="plain">&lt;</code><code class="keyword">option</code> <code class="color1">value</code><code class="plain">=</code><code class="string">"2"</code><code class="plain">&gt;two&lt;/</code><code class="keyword">option</code><code class="plain">&gt;</code></span></span></div><div class="line alt2"><code class="number">4.</code><span class="content"><span class="block" style="margin-left: 0px !important;"><code class="plain">&lt;</code><code class="keyword">option</code> <code class="color1">value</code><code class="plain">=</code><code class="string">"3"</code><code class="plain">&gt;three&lt;/</code><code class="keyword">option</code><code class="plain">&gt;</code></span></span></div><div class="line alt1"><code class="number">5.</code><span class="content"><span class="block" style="margin-left: 0px !important;"><code class="plain">&lt;/</code><code class="keyword">select</code><code class="plain">&gt;</code></span></span></div></div></div>
<p><span style="color: #333399;"><strong>1) </strong>Самое простое – получить значение выбранного элемента</span></p>
<div id="highlighter_682279" class="syntaxhighlighter "><div class="bar "><div class="toolbar"><a href="#viewSource" title="view source" class="item viewSource" style="width: 16px; height: 16px;">view source</a><a href="#printSource" title="print" class="item printSource" style="width: 16px; height: 16px;">print</a><a href="#about" title="?" class="item about" style="width: 16px; height: 16px;">?</a></div></div><div class="lines"><div class="line alt1"><code class="number">1.</code><span class="content"><span class="block" style="margin-left: 0px !important;"><code class="plain">$(</code><code class="string">"#my_select option:selected"</code><code class="plain">).val();</code></span></span></div><div class="line alt2"><code class="number">2.</code><span class="content"><span class="block" style="margin-left: 0px !important;"><code class="plain">сокращенно:</code></span></span></div><div class="line alt1"><code class="number">3.</code><span class="content"><span class="block" style="margin-left: 0px !important;"><code class="plain">$(</code><code class="string">"#my_select :selected"</code><code class="plain">).val();</code></span></span></div><div class="line alt2"><code class="number">4.</code><span class="content"><span class="block" style="margin-left: 0px !important;"><code class="plain">или:</code></span></span></div><div class="line alt1"><code class="number">5.</code><span class="content"><span class="block" style="margin-left: 0px !important;"><code class="plain">$(</code><code class="string">"select#my_select"</code><code class="plain">).val();</code></span></span></div></div></div>
<p><span style="color: #333399;"><strong>2)</strong> Получаем текст того же выбранного элемента</span></p>
<div id="highlighter_301005" class="syntaxhighlighter "><div class="bar"><div class="toolbar"><a href="#viewSource" title="view source" class="item viewSource" style="width: 16px; height: 16px;">view source</a><a href="#printSource" title="print" class="item printSource" style="width: 16px; height: 16px;">print</a><a href="#about" title="?" class="item about" style="width: 16px; height: 16px;">?</a></div></div><div class="lines"><div class="line alt1"><code class="number">1.</code><span class="content"><span class="block" style="margin-left: 0px !important;"><code class="plain">$(</code><code class="string">"#my_select :selected"</code><code class="plain">).html();</code></span></span></div><div class="line alt2"><code class="number">2.</code><span class="content"><span class="block" style="margin-left: 0px !important;"><code class="plain">или:</code></span></span></div><div class="line alt1"><code class="number">3.</code><span class="content"><span class="block" style="margin-left: 0px !important;"><code class="plain">$(</code><code class="string">"#my_select :selected"</code><code class="plain">).text();</code></span></span></div></div></div>
<p><span style="color: #333399;"><strong>3)</strong> Сделать &lt;select&gt; недоступным</span></p>
<div id="highlighter_269557" class="syntaxhighlighter "><div class="bar"><div class="toolbar"><a href="#viewSource" title="view source" class="item viewSource" style="width: 16px; height: 16px;">view source</a><a href="#printSource" title="print" class="item printSource" style="width: 16px; height: 16px;">print</a><a href="#about" title="?" class="item about" style="width: 16px; height: 16px;">?</a></div></div><div class="lines"><div class="line alt1"><code class="number">1.</code><span class="content"><span class="block" style="margin-left: 0px !important;"><code class="plain">$(</code><code class="string">"#my_select"</code><code class="plain">).attr(</code><code class="string">"disabled"</code><code class="plain">,</code><code class="string">"disabled"</code><code class="plain">);</code></span></span></div></div></div>
<p><span style="color: #333399;"><strong>4)</strong> Разблокировать &lt;select&gt;</span></p>
<div id="highlighter_507289" class="syntaxhighlighter "><div class="bar"><div class="toolbar"><a href="#viewSource" title="view source" class="item viewSource" style="width: 16px; height: 16px;">view source</a><a href="#printSource" title="print" class="item printSource" style="width: 16px; height: 16px;">print</a><a href="#about" title="?" class="item about" style="width: 16px; height: 16px;">?</a></div></div><div class="lines"><div class="line alt1"><code class="number">1.</code><span class="content"><span class="block" style="margin-left: 0px !important;"><code class="plain">$(</code><code class="string">"#my_select"</code><code class="plain">).attr(</code><code class="string">"disabled"</code><code class="plain">,</code><code class="string">""</code><code class="plain">);</code></span></span></div></div></div>
<p><span style="color: #333399;"><strong>5)</strong> Удалить выбранный элемент</span></p>
<div id="highlighter_574137" class="syntaxhighlighter "><div class="bar"><div class="toolbar"><a href="#viewSource" title="view source" class="item viewSource" style="width: 16px; height: 16px;">view source</a><a href="#printSource" title="print" class="item printSource" style="width: 16px; height: 16px;">print</a><a href="#about" title="?" class="item about" style="width: 16px; height: 16px;">?</a></div></div><div class="lines"><div class="line alt1"><code class="number">1.</code><span class="content"><span class="block" style="margin-left: 0px !important;"><code class="plain">$(</code><code class="string">"#my_select :selected"</code><code class="plain">).remove();</code></span></span></div></div></div>
<p><span style="color: #333399;"><strong>6)</strong> Удалить первый элемент</span></p>
<div id="highlighter_167718" class="syntaxhighlighter "><div class="bar"><div class="toolbar"><a href="#viewSource" title="view source" class="item viewSource" style="width: 16px; height: 16px;">view source</a><a href="#printSource" title="print" class="item printSource" style="width: 16px; height: 16px;">print</a><a href="#about" title="?" class="item about" style="width: 16px; height: 16px;">?</a></div></div><div class="lines"><div class="line alt1"><code class="number">1.</code><span class="content"><span class="block" style="margin-left: 0px !important;"><code class="plain">$(</code><code class="string">"#my_select :first"</code><code class="plain">).remove();</code></span></span></div></div></div>
<p><span style="color: #333399;"><strong>7)</strong> Удалить последний элемент</span></p>
<div id="highlighter_713054" class="syntaxhighlighter "><div class="bar"><div class="toolbar"><a href="#viewSource" title="view source" class="item viewSource" style="width: 16px; height: 16px;">view source</a><a href="#printSource" title="print" class="item printSource" style="width: 16px; height: 16px;">print</a><a href="#about" title="?" class="item about" style="width: 16px; height: 16px;">?</a></div></div><div class="lines"><div class="line alt1"><code class="number">1.</code><span class="content"><span class="block" style="margin-left: 0px !important;"><code class="plain">$(</code><code class="string">"#my_select :last"</code><code class="plain">).remove();</code></span></span></div></div></div>
<p><span style="color: #333399;"><strong>8)</strong> Удалить элемент, у которого value='2'</span></p>
<div id="highlighter_485388" class="syntaxhighlighter "><div class="bar"><div class="toolbar"><a href="#viewSource" title="view source" class="item viewSource" style="width: 16px; height: 16px;">view source</a><a href="#printSource" title="print" class="item printSource" style="width: 16px; height: 16px;">print</a><a href="#about" title="?" class="item about" style="width: 16px; height: 16px;">?</a></div></div><div class="lines"><div class="line alt1"><code class="number">1.</code><span class="content"><span class="block" style="margin-left: 0px !important;"><code class="plain">$(</code><code class="string">"#my_select option[value='2']"</code><code class="plain">). remove();</code></span></span></div><div class="line alt2"><code class="number">2.</code><span class="content"><span class="block" style="margin-left: 0px !important;"><code class="plain">сокращенно:</code></span></span></div><div class="line alt1"><code class="number">3.</code><span class="content"><span class="block" style="margin-left: 0px !important;"><code class="plain">$(</code><code class="string">"#my_select [value='2']"</code><code class="plain">). remove();</code></span></span></div></div></div>
<p><span style="color: #333399;"><strong>9) </strong>Очистить весь список &lt;select&gt;</span></p>
<div id="highlighter_585561" class="syntaxhighlighter "><div class="bar"><div class="toolbar"><a href="#viewSource" title="view source" class="item viewSource" style="width: 16px; height: 16px;">view source</a><a href="#printSource" title="print" class="item printSource" style="width: 16px; height: 16px;">print</a><a href="#about" title="?" class="item about" style="width: 16px; height: 16px;">?</a></div></div><div class="lines"><div class="line alt1"><code class="number">1.</code><span class="content"><span class="block" style="margin-left: 0px !important;"><code class="plain">$(</code><code class="string">"#my_select"</code><code class="plain">).empty();</code></span></span></div><div class="line alt2"><code class="number">2.</code><span class="content"><span class="block" style="margin-left: 0px !important;"><code class="plain">или:</code></span></span></div><div class="line alt1"><code class="number">3.</code><span class="content"><span class="block" style="margin-left: 0px !important;"><code class="plain">$(</code><code class="string">'option'</code><code class="plain">, $(</code><code class="string">"#my_select"</code><code class="plain">)).remove();</code></span></span></div></div></div>
<p><span style="color: #333399;"><strong><span style="color: #333399;">10)</span></strong> Перебрать все элементы списка &lt;select&gt;</span></p>
<div id="highlighter_686" class="syntaxhighlighter "><div class="bar"><div class="toolbar"><a href="#viewSource" title="view source" class="item viewSource" style="width: 16px; height: 16px;">view source</a><a href="#printSource" title="print" class="item printSource" style="width: 16px; height: 16px;">print</a><a href="#about" title="?" class="item about" style="width: 16px; height: 16px;">?</a></div></div><div class="lines"><div class="line alt1"><code class="number">1.</code><span class="content"><span class="block" style="margin-left: 0px !important;"><code class="plain">$(</code><code class="string">'#my_select option'</code><code class="plain">).each(</code><code class="keyword">function</code><code class="plain">(){</code></span></span></div><div class="line alt2"><code class="number">2.</code><span class="content"><span class="block" style="margin-left: 0px !important;"><code class="plain">alert(</code><code class="keyword">this</code><code class="plain">.text);</code></span></span></div><div class="line alt1"><code class="number">3.</code><span class="content"><span class="block" style="margin-left: 0px !important;"><code class="plain">});</code></span></span></div></div></div>
<p><span style="color: #333399;"><strong>11)</strong> Сделать выбранным последний элемент</span></p>
<div id="highlighter_431522" class="syntaxhighlighter "><div class="bar"><div class="toolbar"><a href="#viewSource" title="view source" class="item viewSource" style="width: 16px; height: 16px;">view source</a><a href="#printSource" title="print" class="item printSource" style="width: 16px; height: 16px;">print</a><a href="#about" title="?" class="item about" style="width: 16px; height: 16px;">?</a></div></div><div class="lines"><div class="line alt1"><code class="number">1.</code><span class="content"><span class="block" style="margin-left: 0px !important;"><code class="plain">$(</code><code class="string">"#my_select :last"</code><code class="plain">).attr(</code><code class="string">"selected"</code><code class="plain">, </code><code class="string">"selected"</code><code class="plain">);</code></span></span></div></div></div>
<p><span style="color: #333399;"><strong>12)</strong> Сделать выбранным второй элемент</span></p>
<div id="highlighter_138748" class="syntaxhighlighter "><div class="bar"><div class="toolbar"><a href="#viewSource" title="view source" class="item viewSource" style="width: 16px; height: 16px;">view source</a><a href="#printSource" title="print" class="item printSource" style="width: 16px; height: 16px;">print</a><a href="#about" title="?" class="item about" style="width: 16px; height: 16px;">?</a></div></div><div class="lines"><div class="line alt1"><code class="number">1.</code><span class="content"><span class="block" style="margin-left: 0px !important;"><code class="plain">$(</code><code class="string">"#my_select :nth-child(2)"</code><code class="plain">).attr(</code><code class="string">"selected"</code><code class="plain">, </code><code class="string">"selected"</code><code class="plain">);</code></span></span></div></div></div>
<p><span style="color: #333399;"><strong>13)</strong> Сделать выбранным элемент, содержащий текст 'two'</span></p>
<div id="highlighter_186785" class="syntaxhighlighter "><div class="bar"><div class="toolbar"><a href="#viewSource" title="view source" class="item viewSource" style="width: 16px; height: 16px;">view source</a><a href="#printSource" title="print" class="item printSource" style="width: 16px; height: 16px;">print</a><a href="#about" title="?" class="item about" style="width: 16px; height: 16px;">?</a></div></div><div class="lines"><div class="line alt1"><code class="number">1.</code><span class="content"><span class="block" style="margin-left: 0px !important;"><code class="plain">$(</code><code class="string">"#my_select :contains('two')"</code><code class="plain">).attr(</code><code class="string">"selected"</code><code class="plain">, </code><code class="string">"selected"</code><code class="plain">);</code></span></span></div><div class="line alt2"><code class="number">2.</code><span class="content"><span class="block" style="margin-left: 0px !important;"><code class="plain">или:</code></span></span></div><div class="line alt1"><code class="number">3.</code><span class="content"><span class="block" style="margin-left: 0px !important;"><code class="plain">$(</code><code class="string">"#my_select"</code><code class="plain">).find(</code><code class="string">"option:contains('two')"</code><code class="plain">).attr(</code><code class="string">"selected"</code><code class="plain">, </code><code class="string">"selected"</code><code class="plain">);</code></span></span></div><div class="line alt2"><code class="number">4.</code><span class="content"><span class="block" style="margin-left: 0px !important;"><code class="plain">или только первое вхождение:</code></span></span></div><div class="line alt1"><code class="number">5.</code><span class="content"><span class="block" style="margin-left: 0px !important;"><code class="plain">$(</code><code class="string">"#my_select :contains('two')"</code><code class="plain">).first().attr(</code><code class="string">"selected"</code><code class="plain">, </code><code class="string">"selected"</code><code class="plain">);</code></span></span></div><div class="line alt2"><code class="number">6.</code><span class="content"><span class="block" style="margin-left: 0px !important;"><code class="plain">или:</code></span></span></div><div class="line alt1"><code class="number">7.</code><span class="content"><span class="block" style="margin-left: 0px !important;"><code class="plain">$(</code><code class="string">"#my_select"</code><code class="plain">).find(</code><code class="string">"option:contains('two')"</code><code class="plain">).first().attr(</code><code class="string">"selected"</code><code class="plain">, </code><code class="string">"selected"</code><code class="plain">);</code></span></span></div></div></div>
<p><span style="color: #333399;"><strong>14)</strong> Сделать выбранным элемент, value которого = 2</span></p>
<div id="highlighter_121464" class="syntaxhighlighter "><div class="bar"><div class="toolbar"><a href="#viewSource" title="view source" class="item viewSource" style="width: 16px; height: 16px;">view source</a><a href="#printSource" title="print" class="item printSource" style="width: 16px; height: 16px;">print</a><a href="#about" title="?" class="item about" style="width: 16px; height: 16px;">?</a></div></div><div class="lines"><div class="line alt1"><code class="number">1.</code><span class="content"><span class="block" style="margin-left: 0px !important;"><code class="plain">$(</code><code class="string">"#my_select [value='2']"</code><code class="plain">).attr(</code><code class="string">"selected"</code><code class="plain">, </code><code class="string">"selected"</code><code class="plain">);</code></span></span></div></div></div>
<p><span style="color: #333399;"><strong>15) </strong>Добавить элемент в начало списка &lt;select&gt;</span></p>
<div id="highlighter_489948" class="syntaxhighlighter "><div class="bar"><div class="toolbar"><a href="#viewSource" title="view source" class="item viewSource" style="width: 16px; height: 16px;">view source</a><a href="#printSource" title="print" class="item printSource" style="width: 16px; height: 16px;">print</a><a href="#about" title="?" class="item about" style="width: 16px; height: 16px;">?</a></div></div><div class="lines"><div class="line alt1"><code class="number">1.</code><span class="content"><span class="block" style="margin-left: 0px !important;"><code class="plain">$(</code><code class="string">"#my_select"</code><code class="plain">).prepend( $(</code><code class="string">'&lt;option value="0"&gt;zero&lt;/option&gt;'</code><code class="plain">));</code></span></span></div></div></div>
<p><span style="color: #333399;"><strong>16) </strong>Добавить элемент в конец списка &lt;select&gt;</span></p>
<div id="highlighter_788941" class="syntaxhighlighter "><div class="bar"><div class="toolbar"><a href="#viewSource" title="view source" class="item viewSource" style="width: 16px; height: 16px;">view source</a><a href="#printSource" title="print" class="item printSource" style="width: 16px; height: 16px;">print</a><a href="#about" title="?" class="item about" style="width: 16px; height: 16px;">?</a></div></div><div class="lines"><div class="line alt1"><code class="number">1.</code><span class="content"><span class="block" style="margin-left: 0px !important;"><code class="plain">$(</code><code class="string">"#my_select"</code><code class="plain">).append( $(</code><code class="string">'&lt;option value="4"&gt;four&lt;/option&gt;'</code><code class="plain">));</code></span></span></div></div></div>
<p><span style="color: #333399;"><strong>17)</strong> Добавить новый элемент после второго</span></p>
<div id="highlighter_445082" class="syntaxhighlighter "><div class="bar"><div class="toolbar"><a href="#viewSource" title="view source" class="item viewSource" style="width: 16px; height: 16px;">view source</a><a href="#printSource" title="print" class="item printSource" style="width: 16px; height: 16px;">print</a><a href="#about" title="?" class="item about" style="width: 16px; height: 16px;">?</a></div></div><div class="lines"><div class="line alt1"><code class="number">1.</code><span class="content"><span class="block" style="margin-left: 0px !important;"><code class="plain">$(</code><code class="string">"#my_select option:nth-child(2)"</code><code class="plain">).after($(</code><code class="string">'&lt;option value="22"&gt;twotwo&lt;/option&gt;'</code><code class="plain">));</code></span></span></div></div></div>
<p><span style="color: #333399;"><strong>18) </strong>Количество элементов option в </span><span style="color: #333399;">списке &lt;select&gt;</span></p>
<div id="highlighter_954113" class="syntaxhighlighter "><div class="bar"><div class="toolbar"><a href="#viewSource" title="view source" class="item viewSource" style="width: 16px; height: 16px;">view source</a><a href="#printSource" title="print" class="item printSource" style="width: 16px; height: 16px;">print</a><a href="#about" title="?" class="item about" style="width: 16px; height: 16px;">?</a></div></div><div class="lines"><div class="line alt1"><code class="number">1.</code><span class="content"><span class="block" style="margin-left: 0px !important;"><code class="plain">$(</code><code class="string">"select[id=my_select] option"</code><code class="plain">).size();</code></span></span></div></div></div>
<p><span style="color: #333399;"><strong>19) </strong>Проверяем, выбран ли элемент в списке &lt;select&gt;</span></p>
<div id="highlighter_421950" class="syntaxhighlighter "><div class="bar"><div class="toolbar"><a href="#viewSource" title="view source" class="item viewSource" style="width: 16px; height: 16px;">view source</a><a href="#printSource" title="print" class="item printSource" style="width: 16px; height: 16px;">print</a><a href="#about" title="?" class="item about" style="width: 16px; height: 16px;">?</a></div></div><div class="lines"><div class="line alt1"><code class="number">1.</code><span class="content"><span class="block" style="margin-left: 0px !important;"><code class="keyword">if</code><code class="plain">($(</code><code class="string">"#my_select"</code><code class="plain">).val())</code></span></span></div></div></div>
<p><span style="color: #333399;"><strong>20) </strong>Сделать все элементы в списке &lt;select&gt; не выбранными</span></p>
<div id="highlighter_303199" class="syntaxhighlighter "><div class="bar"><div class="toolbar"><a href="#viewSource" title="view source" class="item viewSource" style="width: 16px; height: 16px;">view source</a><a href="#printSource" title="print" class="item printSource" style="width: 16px; height: 16px;">print</a><a href="#about" title="?" class="item about" style="width: 16px; height: 16px;">?</a></div></div><div class="lines"><div class="line alt1"><code class="number">1.</code><span class="content"><span class="block" style="margin-left: 0px !important;"><code class="plain">$(</code><code class="string">'#my_select option:selected'</code><code class="plain">).each(</code><code class="keyword">function</code><code class="plain">(){</code></span></span></div><div class="line alt2"><code class="number">2.</code><span class="content"><span class="block" style="margin-left: 0px !important;"><code class="keyword">this</code><code class="plain">.selected=</code><code class="keyword">false</code><code class="plain">;</code></span></span></div><div class="line alt1"><code class="number">3.</code><span class="content"><span class="block" style="margin-left: 0px !important;"><code class="plain">});</code></span></span></div></div></div>
<p><span style="color: #333399;"><strong>21) </strong>Добавить несколько элементов option в список &lt;select&gt; из массива</span></p>
<div id="highlighter_347603" class="syntaxhighlighter "><div class="bar"><div class="toolbar"><a href="#viewSource" title="view source" class="item viewSource" style="width: 16px; height: 16px;">view source</a><a href="#printSource" title="print" class="item printSource" style="width: 16px; height: 16px;">print</a><a href="#about" title="?" class="item about" style="width: 16px; height: 16px;">?</a></div></div><div class="lines"><div class="line alt1"><code class="number">01.</code><span class="content"><span class="block" style="margin-left: 0px !important;"><code class="comments">//добавим эти элементы несколькими способами</code></span></span></div><div class="line alt2"><code class="number">02.</code><span class="content"><span class="block" style="margin-left: 0px !important;"><code class="keyword">var</code> <code class="plain">newOptions = {</code></span></span></div><div class="line alt1"><code class="number">03.</code><span class="content"><span class="block" style="margin-left: 0px !important;"><code class="string">"key_1"</code><code class="plain">: </code><code class="string">"test 1"</code><code class="plain">,</code></span></span></div><div class="line alt2"><code class="number">04.</code><span class="content"><span class="block" style="margin-left: 0px !important;"><code class="string">"key_2"</code><code class="plain">: </code><code class="string">"test 2"</code></span></span></div><div class="line alt1"><code class="number">05.</code><span class="content"><span class="block" style="margin-left: 0px !important;"><code class="plain">};</code></span></span></div><div class="line alt2"><code class="number">06.</code><span class="content"><span class="block" style="margin-left: 0px !important;"><code class="comments">//способ 1</code></span></span></div><div class="line alt1"><code class="number">07.</code><span class="content"><span class="block" style="margin-left: 0px !important;"><code class="plain">$.each(newOptions, </code><code class="keyword">function</code><code class="plain">(key, value) {</code></span></span></div><div class="line alt2"><code class="number">08.</code><span class="content"><span class="block" style="margin-left: 0px !important;"><code class="plain">$(</code><code class="string">'#my_select'</code><code class="plain">).append($(</code><code class="string">""</code><code class="plain">, {</code></span></span></div><div class="line alt1"><code class="number">09.</code><span class="content"><span class="block" style="margin-left: 0px !important;"><code class="plain">value: key,</code></span></span></div><div class="line alt2"><code class="number">10.</code><span class="content"><span class="block" style="margin-left: 0px !important;"><code class="plain">text: value</code></span></span></div><div class="line alt1"><code class="number">11.</code><span class="content"><span class="block" style="margin-left: 0px !important;"><code class="plain">}));</code></span></span></div><div class="line alt2"><code class="number">12.</code><span class="content"><span class="block" style="margin-left: 0px !important;"><code class="plain">});</code></span></span></div><div class="line alt1"><code class="number">13.</code><span class="content"><span class="block" style="margin-left: 0px !important;"><code class="comments">//способ 2</code></span></span></div><div class="line alt2"><code class="number">14.</code><span class="content"><span class="block" style="margin-left: 0px !important;"><code class="keyword">var</code> <code class="plain">new_options = </code><code class="string">''</code><code class="plain">;</code></span></span></div><div class="line alt1"><code class="number">15.</code><span class="content"><span class="block" style="margin-left: 0px !important;"><code class="plain">$.each(newOptions, </code><code class="keyword">function</code><code class="plain">(key, value) {</code></span></span></div><div class="line alt2"><code class="number">16.</code><span class="content"><span class="block" style="margin-left: 0px !important;"><code class="plain">new_options += </code><code class="string">''</code> <code class="plain">+ value + </code><code class="string">''</code><code class="plain">;</code></span></span></div><div class="line alt1"><code class="number">17.</code><span class="content"><span class="block" style="margin-left: 0px !important;"><code class="plain">});</code></span></span></div><div class="line alt2"><code class="number">18.</code><span class="content"><span class="block" style="margin-left: 0px !important;"><code class="plain">$(</code><code class="string">'#my_select'</code><code class="plain">).html(new_options);</code></span></span></div><div class="line alt1"><code class="number">19.</code><span class="content"><span class="block" style="margin-left: 0px !important;"><code class="comments">//способ 3</code></span></span></div><div class="line alt2"><code class="number">20.</code><span class="content"><span class="block" style="margin-left: 0px !important;"><code class="keyword">var</code> <code class="plain">select = $(</code><code class="string">'#my_select'</code><code class="plain">);</code></span></span></div><div class="line alt1"><code class="number">21.</code><span class="content"><span class="block" style="margin-left: 0px !important;"><code class="keyword">if</code><code class="plain">(select.prop) {</code></span></span></div><div class="line alt2"><code class="number">22.</code><span class="content"><span class="block" style="margin-left: 0px !important;"><code class="keyword">var</code> <code class="plain">options = select.prop(</code><code class="string">'options'</code><code class="plain">);</code></span></span></div><div class="line alt1"><code class="number">23.</code><span class="content"><span class="block" style="margin-left: 0px !important;"><code class="plain">}</code></span></span></div><div class="line alt2"><code class="number">24.</code><span class="content"><span class="block" style="margin-left: 0px !important;"><code class="keyword">else</code> <code class="plain">{</code></span></span></div><div class="line alt1"><code class="number">25.</code><span class="content"><span class="block" style="margin-left: 0px !important;"><code class="keyword">var</code> <code class="plain">options = select.attr(</code><code class="string">'options'</code><code class="plain">);</code></span></span></div><div class="line alt2"><code class="number">26.</code><span class="content"><span class="block" style="margin-left: 0px !important;"><code class="plain">}</code></span></span></div><div class="line alt1"><code class="number">27.</code><span class="content"><span class="block" style="margin-left: 0px !important;"><code class="plain">$.each(newOptions, </code><code class="keyword">function</code><code class="plain">(val, text) {</code></span></span></div><div class="line alt2"><code class="number">28.</code><span class="content"><span class="block" style="margin-left: 0px !important;"><code class="plain">options[options.length] = </code><code class="keyword">new</code> <code class="plain">Option(text, val);</code></span></span></div><div class="line alt1"><code class="number">29.</code><span class="content"><span class="block" style="margin-left: 0px !important;"><code class="plain">});</code></span></span></div></div></div>
<p>На этом пока все.</p>
<p>Если что-то не упомянул, пишите в комментариях!</p>


<!-- Begin SexyBookmarks Menu Code -->
<noindex><div class="sexy-bookmarks sexy-bookmarks-expand" style="">
<ul class="socials">
		<li class="sexy-google">
			<a href="http://www.google.com/bookmarks/mark?op=add&amp;bkmk=http://www.webnotes.com.ua/index.php/archives/699&amp;title=jQuery+%D1%80%D0%B0%D0%B1%D0%BE%D1%82%D0%B0+%D1%81+select" rel="nofollow" title="Add this to Google Bookmarks">Add this to Google Bookmarks</a>
		</li>
		<li class="sexy-twitter">
			<a href="http://twitter.com/home?status=jQuery+%D1%80%D0%B0%D0%B1%D0%BE%D1%82%D0%B0+%D1%81+select+-+&lt;br /&gt;
&lt;b&gt;Notice&lt;/b&gt;:  Undefined index:  alias in &lt;b&gt;/home/shared_useracct/e7t.us/create.php&lt;/b&gt; on line &lt;b&gt;9&lt;/b&gt;&lt;br /&gt;
http://e7t.us/jtr6+(via+@niceteg)" rel="nofollow" title="Tweet This!">Tweet This!</a>
		</li>
		<li class="sexy-delicious">
			<a href="http://del.icio.us/post?url=http://www.webnotes.com.ua/index.php/archives/699&amp;title=jQuery+%D1%80%D0%B0%D0%B1%D0%BE%D1%82%D0%B0+%D1%81+select" rel="nofollow" title="Share this on del.icio.us">Share this on del.icio.us</a>
		</li>
		<li class="sexy-facebook">
			<a href="http://www.facebook.com/share.php?v=4&amp;src=bm&amp;u=http://www.webnotes.com.ua/index.php/archives/699&amp;t=jQuery+%D1%80%D0%B0%D0%B1%D0%BE%D1%82%D0%B0+%D1%81+select" rel="nofollow" title="Share this on Facebook">Share this on Facebook</a>
		</li>
		<li class="sexy-myspace">
			<a href="http://www.myspace.com/Modules/PostTo/Pages/?u=http://www.webnotes.com.ua/index.php/archives/699&amp;t=jQuery+%D1%80%D0%B0%D0%B1%D0%BE%D1%82%D0%B0+%D1%81+select" rel="nofollow" title="Post this to MySpace">Post this to MySpace</a>
		</li>
		<li class="sexy-bobrdobr">
			<a href="http://bobrdobr.ru/addext.html?url=http://www.webnotes.com.ua/index.php/archives/699&amp;title=jQuery+%D1%80%D0%B0%D0%B1%D0%BE%D1%82%D0%B0+%D1%81+select" rel="nofollow" title="Share this on BobrDobr">Share this on BobrDobr</a>
		</li>
		<li class="sexy-yandex">
			<a href="http://zakladki.yandex.ru/userarea/links/addfromfav.asp?bAddLink_x=1&amp;lurl=http://www.webnotes.com.ua/index.php/archives/699&amp;lname=jQuery+%D1%80%D0%B0%D0%B1%D0%BE%D1%82%D0%B0+%D1%81+select" rel="nofollow" title="Add this to Yandex.Bookmarks">Add this to Yandex.Bookmarks</a>
		</li>
		<li class="sexy-memoryru">
			<a href="http://memori.ru/link/?sm=1&amp;u_data[url]=http://www.webnotes.com.ua/index.php/archives/699&amp;u_data[name]=jQuery+%D1%80%D0%B0%D0%B1%D0%BE%D1%82%D0%B0+%D1%81+select" rel="nofollow" title="Add this to Memory.ru">Add this to Memory.ru</a>
		</li>
		<li class="sexy-100zakladok">
			<a href="http://www.100zakladok.ru/save/?bmurl=http://www.webnotes.com.ua/index.php/archives/699&amp;bmtitle=jQuery+%D1%80%D0%B0%D0%B1%D0%BE%D1%82%D0%B0+%D1%81+select" rel="nofollow" title="Add this to 100 bookmarks">Add this to 100 bookmarks</a>
		</li>
		<li class="sexy-comfeed">
			<a href="http://www.webnotes.com.ua/index.php/archives/699/feed" rel="nofollow" title="Subscribe to the comments for this post?">Subscribe to the comments for this post?</a>
		</li>
</ul>
<div style="clear:both;"></div>
</div></noindex>
<!-- End SexyBookmarks Menu Code -->

<span style="clear:both;display:none;"><img src="http://www.webnotes.com.ua/wp-content/plugins/wp-spamfree/img/wpsf-img.php" width="0" height="0" alt="" style="border-style:none;width:0px;height:0px;display:none;"></span>          </div>
                              <p class="tags"><a href="http://www.webnotes.com.ua/index.php/archives/tag/jquery" rel="tag">jQuery</a>, <a href="http://www.webnotes.com.ua/index.php/archives/tag/select" rel="tag">select</a></p>
          <div class="clear"></div>
          		 
          <p class="postmetadata alt">
			<small>
        		Добавлено -         		Воскресенье, Сентябрь 27th, 2009, 13:36        		Раздел -                 <a href="http://www.webnotes.com.ua/index.php/archives/category/jquery" title="Просмотреть все записи в рубрике «jQuery»" rel="category tag">jQuery</a>, <a href="http://www.webnotes.com.ua/index.php/archives/category/news" title="Просмотреть все записи в рубрике «Заметки»" rel="category tag">Заметки</a>.
	            Подписаться на  <a href="http://www.webnotes.com.ua/index.php/archives/699/feed">RSS 2.0</a>.                Оставьте <a href="#respond">комментарий</a>, или <a href="http://www.webnotes.com.ua/index.php/archives/699/trackback" rel="trackback">trackback</a> с вашего сайта.                            </small>
		  </p>  
	   </div>
    </div>
	
	
	
	
	
	
	
	
<script>
	$(function(){
    $("#sel1").change(function(){
        switch($(this).val())
        {
            case "0": // do your code
                      break;
        }
    });
});
</script>
<select id="sel1">
            <option value="0" id="n">n</option>
            <option value="1" id="m">m</option>
</select>