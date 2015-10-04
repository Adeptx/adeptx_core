<div id="code" contenteditable="true"></div>
	<div id="cheats">
		<div id="replace">
   			<input type="text" id="from" placeholder="искомое">
   			<input type="button" id="next" value="Заменить">
   			<input type="text" id="to" placeholder="замена">
   			<input type="button" id="all" value="Заменить все">
   			<label><input type="checkbox" id="replace_i">Не учитывать регистр</label>
   			<label><input type="checkbox" id="replace_reverse">Реверсивный поиск</label>
   			<label><input type="checkbox" id="replace_regex">Регулярные выражения</label>
   			<label><input type="checkbox" id="replace_hightlight">Подсветить результат</label>
   		</div>
		<div id="vars">
   			<input type="text" id="var_name" placeholder="Название переменной">
   			<input type="text" id="var_val" placeholder="Значение переменной">
			<div id="var">
				Переменные:
				<input id="create_var" type="button" value="$ = " title="Создать новую переменную">
				<input id="use_var" type="button" value="$" title="Использовать переменную">
				<input id="print_var" type="button" value="var_dump" title="Вывести значение переменной">
				<input id="isset" type="button" value="isset" title="Проверить, установлена ли переменная">
				<input id="unset" type="button" value="unset" title="Удалить переменную">
				<input id="init_var" type="button" value="$ = false" title="Инициализировать (создать пустую) переменную">
			</div>
   		</div>
		<div id="global">
			<div id="func">
				Функции:
				<input id="create_func" type="button" value="function(){}" title="Инициализировать фунцию">
				<input id="print_var" type="button" value="()" title="Выполнить фунцию">
				<input id="precall" type="button" value="precall" title="Привязать функцию предобработки">
				<input id="callback" type="button" value="callback" title="Привязать функцию постобработки">
			</div>
			<div id="condition">
				Структуры языка - условия, циклы
				<input id="if" type="button" value="if" title="">
				<input id="while" type="button" value="while" title="">
				<input id="for" type="button" value="for" title="">
				<input id="switch"  type="button" value="switch" title="">
				<input id="foreach" type="button" value="foreach" title="">
			</div>
			<div id="math">
				Математические операции:
				<input type="button" value="+">
				<input type="button" value="-">
				<input type="button" value="*">
				<input type="button" value="/">
			</div>
			<div id="bool">
				Логические операции:
				<input type="button" value="&&" title="and">
				<input type="button" value="||" title="or">
				<input type="button" value="^^" title="xor">
				<input type="button" value="!" title="not">
				<input type="button" value="()" title="Приоритет">
				<input type="button" value="==" title="Тождественно">
				<input type="button" value="!=" title="Не равно">
				<input type="button" value=">" title="Больше">
				<input type="button" value="<" title="Меньше">
				<input type="button" value=">=" title="Больше или равно">
				<input type="button" value="<=" title="Меньше или равно">
				<input type="button" value="===" title="Идентично по значению и типу">
			</div>
			<div id="str">
				Операции работы со строками:
				<input type="button" value="." title="Конкатенация (обьединение)">
				<input type="button" value="strstr" title="Поиск подстроки в строке">
				<input type="button" value="substr" title="Вырезание части строки">
				<input type="button" value="strpos" title="Поиск места вхождения подстроки">
				<input type="button" value="str_replace" title="Замена в строке">
			</div>
		</div>
		<div id="file">
			Работа с файлами, страницами, файловой системой и сайтом
			<input type="button" value="import" title="Подключить файл">
			<input type="button" value="fwrite_x" title="Создать файл">
			<input type="button" value="remove" title="Удалить файл">
			<input type="button" value="rename" title="Переименовать файл">
			<input type="button" value="copy" title="Копировать файл">
			<input type="button" value="copy_remove" title="Перенести файл">
			<input type="button" value="fopen" title="Открыть файл">
			<input type="button" value="fwrite" title="Записать в файл">
			<input type="button" value="file_get_contents" title="Считать содержимое файла в одну строку">
			<input type="button" value="file" title="Считать содержимое файла в массив строк">
			<input type="button" value="fclose" title="Закрыть файл">
			<input type="button" value="glob" title="Получить содержимое папки и вернуть как массив имен файлов">
			<input type="button" value="rmdir" title="Удалить пустую директорию">
			<input type="button" value="mkdir" title="Создать директорию">
			<input type="button" value="rename" title="Переименовать директорию">
			<input type="button" value="rmdir_" title="Удалить полную директорию">
		</div>
		<div id="html">
			<input type="button" value="section" title="Секция">
			<input type="button" value="div" title="Блок">
			<input type="button" value="span" title="Манипулируемый текст">
			<input type="button" value="input" title="Поле (тег <form добавляется автоматически>)">
		</div>
		<div id="css">
			<div id="tag">
			</div>
			<div id="class">
			</div>
			<div id="id">
			</div>
		</div>
		<div id="php">
			<input type="button" value="preg_match_all">
			<div id="regex">
				<input type="button" value="^" title="Начало текста (может быть только первым)">
				<input type="button" value="\w" title="Любой буквенный символ">
				<input type="button" value="\W" title="Любой не буквенный символ">
				<input type="button" value="\d" title="Любой цифровой символ">
				<input type="button" value="\D" title="Любой не цифровой символ">
				<input type="button" value="\s" title="Любой невидимый символ символ">
				<input type="button" value="\S" title="Любой видимый символ">
				<input type="button" value="\b" title="Граница слова">
				<input type="button" value="\B" title="Не граница слова">
				<input type="button" value="." title="Любой символ ([\w\W])">
				<input type="button" value="?" title="Необязательное указание {0,1}">
				<input type="button" value="+" title="Любое количество символов {1,}">
				<input type="button" value="*" title="Любое количество символов {0,}">
				<input type="button" value="[]" title="Любой из символов. А или Б или Г: [АБГ] Любая буква из диапазона от Г до Я или цифра от 0 до 9 [Г-Я0-9] Любой символ, кроме символов из диапазона [^А-Я]">
				<input type="button" value="|" title="Или. A или Z (A|Z)">
				<input type="button" value="()" title="Выделить указание. (или_этот_текст)|(или_вот_этот_текст)">
				<input type="button" value="{}" title="Количество. 1 ровно: {1} от 1 до 3: {1,3} 3 или больше: {3,}">
				<input type="button" value="$" title="Конец текста (может быть только последним)">
				
				<input type="button" value="\n" title="Перенос на новую строку">
				<input type="button" value="\r" title="Символ возврата каретки в начало строки">
				<input type="button" value="\t" title="Tab">
				<input type="button" value="\0" title="NULL-character">
<input type="button" value="$1" title="$2">
				<input type="button" value="(?>...)" title="Atomic group [possessive]">
				<input type="button" value="(?|...)" title="Duplicate subpattern group">
				<input type="button" value="(?#...)" title="Comment">
				<input type="button" value="(?'name'...)" title="Named capturing group">
				<input type="button" value="(?<name>...)" title="Named capturing group">
				<input type="button" value="(?P<name>...)" title="Named capturing group">
				<input type="button" value="(?imsxXU)" title="Inline modifiers">
				<input type="button" value="(?(...)|)" title="Conditional statement">
				<input type="button" value="(?R)" title="Recurse entire pattern">
				<input type="button" value="(?1)" title="Recurse first subpattern">
				<input type="button" value="(?+1)" title="Recurse first relative subpattern">
				<input type="button" value="(?&name)" title="Recurse subpattern `name`">
				<input type="button" value="(?P>name)" title="Recurse subpattern `name`">
				<input type="button" value="(?=...)" title="Positive lookahead">
				<input type="button" value="(?!...)" title="Negative lookahead">
				<input type="button" value="(?<=...)" title="Positive lookbehind">
				<input type="button" value="(?<!...)" title="Negative lookbehind">
				<input type="button" value="(*UTF16)" title="Verbs">
				Character classes
				<input type="button" value="[abc]" title="A single character of: a, b or c">
				<input type="button" value="[^abc]" title="A character except: a, b or c">
				<input type="button" value="[a-z]" title="A character in the range: a-z">
				<input type="button" value="[^a-z]" title="A character not in the range: a-z">
				<input type="button" value="[a-zA-Z]" title="A character in the range: a-z or A-Z">
				<input type="button" value="[[:alnum:]]" title="Letters and digits">
				<input type="button" value="[[:alpha:]]" title="Letters">
				<input type="button" value="[[:ascii:]]" title="Ascii codes 0-127">
				<input type="button" value="[[:blank:]]" title="Space or tab only">
				<input type="button" value="[[:cntrl:]]" title="Control characters">
				<input type="button" value="[[:digit:]]" title="Decimal digits">
				<input type="button" value="[[:graph:]]" title="Visible characters (not space)">
				<input type="button" value="[[:lower:]]" title="Lowercase letters">
				<input type="button" value="[[:print:]]" title="Visible characters">
				<input type="button" value="[[:punct:]]" title="Visible punctuation characters">
				<input type="button" value="[[:space:]]" title="Whitespace">
				<input type="button" value="[[:upper:]]" title="Uppercase letters">
				<input type="button" value="[[:word:]]" title="Word characters">
				<input type="button" value="[[:xdigit:]]" title="Hexadecimal digits">
				Meta sequences
				<input type="button" value="\s" title="Any whitespace character">
				<input type="button" value="\S" title="Any non-whitespace character">
				<input type="button" value="\d" title="Any digit">
				<input type="button" value="\D" title="Any non-digit">
				<input type="button" value="\w" title="Any word character">
				<input type="button" value="\W" title="Any non-word character">
				<input type="button" value="\b" title="A word boundary">
				<input type="button" value="\B" title="Non-word boundary">
				<input type="button" value="\G" title="Start of match">
				<input type="button" value="\X" title="Any unicode sequences">
				<input type="button" value="\C" title="Match one byte">
				<input type="button" value="\R" title="Unicode newlines">
				<input type="button" value="\v" title="Vertical whitespace character">
				<input type="button" value="\V" title="Negation of ">\v
				<input type="button" value="\h" title="Horizontal whitespace character">
				<input type="button" value="\H" title="Negation of ">\h
				<input type="button" value="\K" title="Reset match">
				<input type="button" value="\A" title="Start of string">
				<input type="button" value="\Z" title="End of string">
				<input type="button" value="\z" title="Absolute end of string">
				<input type="button" value="\n" title="Match nth subpattern">
				<input type="button" value="\pX" title="Unicode property X">
				<input type="button" value="\p{...}" title="Unicode property">
				<input type="button" value="\PX" title="Negation of ">\p
				<input type="button" value="\P{...}" title="Negation of ">\p
				<input type="button" value="\Q...\E" title="Quote">; treat as literals
				<input type="button" value="\k<name>" title="Match subpattern `name`">
				<input type="button" value="\k'name'" title="Match subpattern `name`">
				<input type="button" value="\k{name}" title="Match subpattern `name`">
				<input type="button" value="\gn" title="Match nth subpattern">
				<input type="button" value="\g{n}" title="Match nth subpattern">
				<input type="button" value="\g{-n}" title="Match nth relative subpattern">
				<input type="button" value="\g'name'" title="Recurse subpattern `name`">
				<input type="button" value="\g<n>" title="Recurse nth subpattern">
				<input type="button" value="\g'n'" title="Recurse nth subpattern">
				<input type="button" value="\g<+n>" title="Recurse nth relative subpattern">
				<input type="button" value="\g'+n'" title="Recurse nth relative subpattern">
				<input type="button" value="\xYY" title="Hex character YY">
				<input type="button" value="\x{YYYY}" title="Hex character YYYY">
				<input type="button" value="\ddd" title="Octal character ddd">
				<input type="button" value="\cY" title="Control character Y">
				<input type="button" value="[\b]" title="Backspace character">
				<input type="button" value="\" title="Makes any character literal">
			</div>
		</div>
		<div id="js">
			<div id="js">
			</div>
			<div id="init">
			</div>
			<div id="dom">
			</div>
			<div id="event">
			</div>
			<div id="ajax">
				<input type="button" value="ajax" title="Отправить даные">
			</div>
		</div>
		<div id="db">
			<div id="mysql">Функции работы с MySQL (подключение и отключение происходят автоматически 1 раз если ф-ции БД используются):
				<input type="button" value="=" title="Получить значение">
				<input type="button" value="+" title="Записать значение">
				<input type="button" value="~" title="Перезаписать значение">
				<input type="button" value="x" title="Удалить значение">
			</div>
		</div>
	</div>

	<!--textarea id="regular-expression">Здесь пишется то, что требуется найти (регулярное выражение) с любыми знаками, не заморачиваясь на экранирование символов. Если требуется специфическое для регулярок выражение - нажимайте кнопки. На месте курсора появится это самое выражение. В выражении регулярки все будет наоборот - вместо изображения будет стоят регулярное выражение, а в самом тексте специфические символы проэкранируются атоматически.</textarea-->

<script>
	$(document).ready(function(){
		// поиск и замена
		$('#replace input[type="button"]#next').bind('click', function(){
			if ($('#replace #replace_regex').prop('checked')) {					// флаг "регулярки"
				var flags = 'mg';																// многострочный, глобальный поиск
				if ($('#replace #replace_i').prop('checked')) flags += 'i';		// без учета регистра
				var regexp = new RegExp($('#from').val(), flags);					// регулярка берется из поля from
				//$('#code').val().replace(regexp, $('#to').val());					// и в code заменяется на значение из поля to
				$('#code').html(
					$('#code').html().replace(regexp, $('#to').val())
				);
			} else
				$('#code').html(
					$('#code').val().replace($('#from').val(), $('#to').val())		// без регулярки обычная замена вхождения
			);
		});
		$('#replace input[type="button"]#all').bind('click', function(){
			$('#code').val(
				$('#code').val().split($('#from').val()).join($('#to').val())	// 
			);
		});
		$(document).bind('keypress', 'Ctrl+f', function(e){ alert('выполнить поиск?');
			e.preventDefault();
			('#replace #from').focus();
			return false;
		});
		$('#code').bind('keydown', 'tab', function(e){
			$('#code').insertAtCaret('\t');
			return false;
		});
		$('#regex input').bind('click', function(){
			$('#replace #from').insertAtCaret(this.value);
		});
		$('#bool input').bind('click', function(){
			$('#code').insertAtCaret(' ' + this.value + ' ');
		});
		$('#var #create_var').bind('click', function(){
			$('#code').insertAtCaret('$ = ');
		});
		$('#var #use_var').bind('click', function(){
			$('#code').insertAtCaret('$');
		});
		$('#var #print_var').bind('click', function(){
			$('#code').insertAtCaret('var_dump(mixed $_)');
		});
		$('#var #isset').bind('click', function(){
			$('#code').insertAtCaret(this.value + '($)');  // для функций ; ставится автоматом но только тогда, когда значение записывается в переменную, а не передается в ругую функцию или условие
		});
		$('#var #unset').bind('click', function(){
			$('#code').insertAtCaret(this.value + '($);\n');	// все процедуры заканчиваются на ;
		});
		$('#var #init_var').bind('click', function(){
			$('#code').insertAtCaret('$ = false;\n');
		});
		
		// выражение вставляется в виде шаблона для регулярки, вида:
		//  string str_replace(mixed $_, mixed $_, string $_)
		//  unset(mixed ...);
		//  string substr(string $_, int $_[int $_])
		//  fprintf(resource $_, string $_[, ...]);
		// при этом подтстановка происходит поэтапно, пока пользователь не заверщит ввод, однако выводится весь шаблон, а по мере ввода заполняются отведенные места для ввода
		// тип возвращаемого значения указывает на то, в каких случаях можно использовать ф-цию, а где нет
		// тип аргумента определяет список переменных, которые можно будет выбрать из списка в этом месте
		$('#condition #if').bind('click', function(){
			$('#code').insertAtCaret('if () ;\n');
		});
		// при переходе между скриптами автомат-определение js/php и соответствующие манипуляции
	});
</script>