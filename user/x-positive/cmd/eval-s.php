<?
	$handler['eval'] = array(
		 'name'			=> 'eval'
		,'version'		=> '0.0.1'
		,'summary'		=> 'Исполняет код PHP, содержащейся в строке'
		,'syntax'		=> 'eval [CODE]'
		,'description'	=> <<<HEREDOC
Исполняет строку, переданную в параметре code, как код PHP. Параметр CODE - исполняемая строка кода PHP.

Код не должен быть обрамлен открывающимся и закрывающимся тегами PHP, т.е. строка должна быть, например, такой 'echo "Привет!";', но не такой '<? echo "Привет!"; >'. Возможно переключатся между режимами PHP и HTML кода, например 'echo "Код PHP!"; ?>Код HTML<? echo "Снова код PHP!";'.

Передаваемый код должен быть верным исполняемым кодом PHP. Это значит, что операторы должны быть разделены точкой с запятой (;). При исполнении строки 'echo "Привет!"' будет сгенерирована ошибка, а строка 'echo "Привет!";' будет успешно выполнена.

Ключевое слово return прекращает исполнение кода в строке.

Исполняемый код из строки будет выполняться в области видимости кода, вызвавшего eval(). Таким образом, любые переменные, определенные или измененные кодом, выполненным eval(), будут доступны после его выполнения в теле программы, как если бы вы включили этот код из файла через оператор include.'
HEREDOC
		,'author'		=> 'Written by Evgeny Grinec aka x-positive @ Adeptx, Inc.'
		,'callback'		=> 'E-mail: e.grinec@gmail.com'
		,'copyright'	=> 'Copyright © 2015 Adeptx, Inc. License GPLv3+: GNU GPL version 3 or later <http://gnu.org/licenses/gpl.html>. This is free software: you are free to change and redistribute it. There is NO WARRANTY, to the extent permitted by law.'
	);

	$handler['eval']['run'] = function($arguments) use ($handler) {
		if (is_array($arguments)) {
			foreach ($arguments as $arg) {
				eval($arg);
			}
		} else {
			eval($arguments);
		}
	};