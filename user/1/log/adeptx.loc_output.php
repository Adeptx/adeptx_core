select mail<hr>

Последние непрочитанные сообщения (LIMIT 50):

Отправитель: #2 $from_nickname ($from_email)
Тема: Simple 2
Сообщение: Simple letter 2
Дата: 2015-09-10 23:44:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 3
Сообщение: Simple letter 3
Дата: 2015-09-10 23:49:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 4
Сообщение: Simple letter 3
Дата: 2015-09-10 23:50:11

<hr>cd cmd<hr>

Текущий каталог изменён на <strong style="color:lightgreen">/home/x-positive/srv/adeptx/user/1/cmd</strong>, узнать текущий каталог: <strong><em>pwd</em></strong>
<hr>./ii<hr>


<hr>./ii HI THERE!<hr>

HI
<hr>ls<hr>

Содержимое текущей директории:

./check.php
./eval (2).php
./help (2).php
./ii.php
./shell.php

<hr>ls<hr>

Содержимое текущей директории:

./check.php
./eval-s.php
./help-s.php
./ii.php
./shell.php

<hr>source shell<hr>

RU: В текущем каталоге (см. `pwd`) не существует файла "cmd/shell.php" или он переименован, перемещен или скрыт настройками приватности. EN: File "" not exit.
<hr>source ls<hr>

&lt;?
	// $handler['ls'] = [
	// 	 'name'			=&gt; 'ls'
	// 	,'version'		=&gt; '0.2'
	// 	,'summary'		=&gt; 'list directory contents'
	// 	,'syntax'		=&gt; 'ls [OPTIONS] [FILES]'
	// 	,'description'	=&gt; 'there no manual for this script yet...'
	// 	,'author'		=&gt; 'Written by Evgeny Grinec aka x-positive @ Adeptx, Inc.'
	// 	,'callback'		=&gt; 'E-mail: e.grinec@gmail.com'
	// 	,'copyright'	=&gt; 'Copyright © 2015 Adeptx, Inc. License GPLv3+: GNU GPL version 3 or later &lt;http://gnu.org/licenses/gpl.html&gt;. This is free software: you are free to change and redistribute it. There is NO WARRANTY, to the extent permitted by law.'
	// 	,'run'			=&gt; function($arguments) use ($handler) {
	// 	include_once 'handler/output.php';

	/**
	* Выводит перечень директорий и файлов которые находятся по указанному адресу в алфавитном порядке
	* @param string $source - директория, содержимое которой необходимо вывести
	* @return string $return - список файлов и папок, каждый с новой строки
	*/

	return ls($arg[1]);

	function ls($source) {
		if (!$source) $source = './';
		$source = str_replace('\\', '/',  $source);
		if (substr($source, -1) != '/') {
			$source .= '/';
		}

		if (file_exists($source)) {
			if (is_dir($source)) {
				if ($source == './') $return = &quot;Содержимое текущей директории:\n\n&quot;;
				else $return = &quot;Содержимое директории \&quot;$source\&quot;:\n\n&quot;;

				foreach (glob(&quot;$source*&quot;, GLOB_MARK | GLOB_NOESCAPE) as $file_name) {
					$file_name = str_replace('\\', '/',  $file_name);
					$return .= $file_name . &quot;\n&quot;;
				}
				return $return;
			}
			throw new Exception(&quot;&lt;strong style=\&quot;color:orange\&quot;&gt;Путь является файлом, а не директорией; вывод вложенных файлов и директорий неприменим.&lt;/strong&gt;&quot;);
		}
		throw new Exception(&quot;&lt;strong style=\&quot;color:red\&quot;&gt;Указанного пути не существует!&lt;/strong&gt;&quot;);
	}

<hr>source ./<hr>

RU: В текущем каталоге (см. `pwd`) не существует файла "cmd/./.php" или он переименован, перемещен или скрыт настройками приватности. EN: File "" not exit.
<hr>source ./ii<hr>

RU: В текущем каталоге (см. `pwd`) не существует файла "cmd/./ii.php" или он переименован, перемещен или скрыт настройками приватности. EN: File "" not exit.
<hr>source ./ii<hr>

RU: В корневом каталоге (см. `cd` [без параметров]) не существует файла "cmd/./ii.php" или он переименован, перемещен или скрыт настройками приватности. EN: File "" not exit.
<hr>source ./ii<hr>

&lt;?
	return $arg[1];
<hr>source ii<hr>

RU: В корневом каталоге (см. `cd` [без параметров]) не существует файла "cmd/ii.php" или он переименован, перемещен или скрыт настройками приватности. EN: File "" not exit.
<hr>source ls<hr>

&lt;?
	// $handler['ls'] = [
	// 	 'name'			=&gt; 'ls'
	// 	,'version'		=&gt; '0.2'
	// 	,'summary'		=&gt; 'list directory contents'
	// 	,'syntax'		=&gt; 'ls [OPTIONS] [FILES]'
	// 	,'description'	=&gt; 'there no manual for this script yet...'
	// 	,'author'		=&gt; 'Written by Evgeny Grinec aka x-positive @ Adeptx, Inc.'
	// 	,'callback'		=&gt; 'E-mail: e.grinec@gmail.com'
	// 	,'copyright'	=&gt; 'Copyright © 2015 Adeptx, Inc. License GPLv3+: GNU GPL version 3 or later &lt;http://gnu.org/licenses/gpl.html&gt;. This is free software: you are free to change and redistribute it. There is NO WARRANTY, to the extent permitted by law.'
	// 	,'run'			=&gt; function($arguments) use ($handler) {
	// 	include_once 'handler/output.php';

	/**
	* Выводит перечень директорий и файлов которые находятся по указанному адресу в алфавитном порядке
	* @param string $source - директория, содержимое которой необходимо вывести
	* @return string $return - список файлов и папок, каждый с новой строки
	*/

	return ls($arg[1]);

	function ls($source) {
		if (!$source) $source = './';
		$source = str_replace('\\', '/',  $source);
		if (substr($source, -1) != '/') {
			$source .= '/';
		}

		if (file_exists($source)) {
			if (is_dir($source)) {
				if ($source == './') $return = &quot;Содержимое текущей директории:\n\n&quot;;
				else $return = &quot;Содержимое директории \&quot;$source\&quot;:\n\n&quot;;

				foreach (glob(&quot;$source*&quot;, GLOB_MARK | GLOB_NOESCAPE) as $file_name) {
					$file_name = str_replace('\\', '/',  $file_name);
					$return .= $file_name . &quot;\n&quot;;
				}
				return $return;
			}
			throw new Exception(&quot;&lt;strong style=\&quot;color:orange\&quot;&gt;Путь является файлом, а не директорией; вывод вложенных файлов и директорий неприменим.&lt;/strong&gt;&quot;);
		}
		throw new Exception(&quot;&lt;strong style=\&quot;color:red\&quot;&gt;Указанного пути не существует!&lt;/strong&gt;&quot;);
	}

<hr>source ./ls<hr>

RU: В текущем каталоге (см. `pwd`) не существует файла "./ls.php" или он переименован, перемещен или скрыт настройками приватности. EN: File "" not exit.
<hr>hello<hr>

Добро пожаловать в Adeptx Driver, x-positive!

<hr>select mail<hr>

Последние непрочитанные сообщения (LIMIT 50):

Отправитель: #2 $from_nickname ($from_email)
Тема: Simple 2
Сообщение: Simple letter 2
Дата: 2015-09-10 23:44:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 3
Сообщение: Simple letter 3
Дата: 2015-09-10 23:49:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 4
Сообщение: Simple letter 3
Дата: 2015-09-10 23:50:11

<hr>hello<hr>

Добро пожаловать в Adeptx Driver, x-positive!

<hr>select mail<hr>

Последние непрочитанные сообщения (LIMIT 50):

Отправитель: #2 $from_nickname ($from_email)
Тема: Simple 2
Сообщение: Simple letter 2
Дата: 2015-09-10 23:44:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 3
Сообщение: Simple letter 3
Дата: 2015-09-10 23:49:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 4
Сообщение: Simple letter 3
Дата: 2015-09-10 23:50:11

<hr>hello<hr>

Добро пожаловать в Adeptx Driver, x-positive!

<hr>select mail<hr>

Последние непрочитанные сообщения (LIMIT 50):

Отправитель: #2 $from_nickname ($from_email)
Тема: Simple 2
Сообщение: Simple letter 2
Дата: 2015-09-10 23:44:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 3
Сообщение: Simple letter 3
Дата: 2015-09-10 23:49:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 4
Сообщение: Simple letter 3
Дата: 2015-09-10 23:50:11

<hr>hello<hr>

Добро пожаловать в Adeptx Driver, x-positive!

<hr>select mail<hr>

Последние непрочитанные сообщения (LIMIT 50):

Отправитель: #2 $from_nickname ($from_email)
Тема: Simple 2
Сообщение: Simple letter 2
Дата: 2015-09-10 23:44:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 3
Сообщение: Simple letter 3
Дата: 2015-09-10 23:49:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 4
Сообщение: Simple letter 3
Дата: 2015-09-10 23:50:11

<hr>hello<hr>

Добро пожаловать в Adeptx Driver, x-positive!

<hr>select mail<hr>

Последние непрочитанные сообщения (LIMIT 50):

Отправитель: #2 $from_nickname ($from_email)
Тема: Simple 2
Сообщение: Simple letter 2
Дата: 2015-09-10 23:44:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 3
Сообщение: Simple letter 3
Дата: 2015-09-10 23:49:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 4
Сообщение: Simple letter 3
Дата: 2015-09-10 23:50:11

<hr>hello<hr>

Добро пожаловать в Adeptx Driver, x-positive!

<hr>select mail<hr>

Последние непрочитанные сообщения (LIMIT 50):

Отправитель: #2 $from_nickname ($from_email)
Тема: Simple 2
Сообщение: Simple letter 2
Дата: 2015-09-10 23:44:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 3
Сообщение: Simple letter 3
Дата: 2015-09-10 23:49:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 4
Сообщение: Simple letter 3
Дата: 2015-09-10 23:50:11

<hr>hello<hr>

Добро пожаловать в Adeptx Driver, x-positive!

<hr>select mail<hr>

Последние непрочитанные сообщения (LIMIT 50):

Отправитель: #2 $from_nickname ($from_email)
Тема: Simple 2
Сообщение: Simple letter 2
Дата: 2015-09-10 23:44:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 3
Сообщение: Simple letter 3
Дата: 2015-09-10 23:49:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 4
Сообщение: Simple letter 3
Дата: 2015-09-10 23:50:11

<hr>hello<hr>

Добро пожаловать в Adeptx Driver, x-positive!

<hr>select mail<hr>

Последние непрочитанные сообщения (LIMIT 50):

Отправитель: #2 $from_nickname ($from_email)
Тема: Simple 2
Сообщение: Simple letter 2
Дата: 2015-09-10 23:44:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 3
Сообщение: Simple letter 3
Дата: 2015-09-10 23:49:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 4
Сообщение: Simple letter 3
Дата: 2015-09-10 23:50:11

<hr>hello<hr>

Добро пожаловать в Adeptx Driver, x-positive!

<hr>select mail<hr>

Последние непрочитанные сообщения (LIMIT 50):

Отправитель: #2 $from_nickname ($from_email)
Тема: Simple 2
Сообщение: Simple letter 2
Дата: 2015-09-10 23:44:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 3
Сообщение: Simple letter 3
Дата: 2015-09-10 23:49:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 4
Сообщение: Simple letter 3
Дата: 2015-09-10 23:50:11

<hr>hello<hr>

Добро пожаловать в Adeptx Driver, x-positive!

<hr>hello<hr>

Добро пожаловать в Adeptx Driver, x-positive!

<hr>select mail<hr>

Последние непрочитанные сообщения (LIMIT 50):

Отправитель: #2 $from_nickname ($from_email)
Тема: Simple 2
Сообщение: Simple letter 2
Дата: 2015-09-10 23:44:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 3
Сообщение: Simple letter 3
Дата: 2015-09-10 23:49:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 4
Сообщение: Simple letter 3
Дата: 2015-09-10 23:50:11

<hr>ls<hr>

Содержимое текущей директории:

./check.php
./eval-s.php
./help-s.php
./ii.php
./shell.php

<hr>cd<hr>

Текущий каталог изменён на <strong style="color:lightgreen">/home/x-positive/srv/adeptx</strong>, узнать текущий каталог: <strong><em>pwd</em></strong>
<hr>cd cmd<hr>

Текущий каталог изменён на <strong style="color:lightgreen">/home/x-positive/srv/adeptx/cmd</strong>, узнать текущий каталог: <strong><em>pwd</em></strong>
<hr>ls<hr>

Содержимое текущей директории:

./add.php
./aliases.php
./auth.php
./cal.php
./cat.php
./cd.php
./chmod.php
./copy.php
./create_backup.php
./date.php
./db.php
./download.php
./dump.php
./echo.php
./epigraph.php
./error.log.php
./eval.php
./exit.php
./fa.php
./filesize.php
./get.php
./head.php
./hello.php
./help.php
./history
./history.php
./killallprocesses.php
./lang.php
./ls.php
./mail.php
./message.php
./more.php
./n.php
./names.php
./output.php
./pwd.php
./pwdb.php
./reg.php
./remove.php
./rename.php
./select.php
./set.php
./site.php
./source.php
./symlink.php
./tail.php
./touch.php
./tree.php
./unreg.php
./unzip.php
./upload.php
./y.php
./zip.php

<hr>source lang<hr>

&lt;?
	$_SESSION['lang'] = $arg[1];
	return &quot;Язык системы успешно установлен.\n&quot;;
<hr>lang en<hr>

Язык системы успешно установлен.

<hr>lang ru<hr>

Язык системы успешно установлен.

<hr>source mail-7<hr>

RU: В корневом каталоге (см. `cd` [без параметров]) не существует файла "cmd/mail-7.php" или он переименован, перемещен или скрыт настройками приватности. EN: File "" not exit.
<hr>source email-7<hr>

&lt;?php 	// there was first line: #!/usr/bin/php
   # внутренние настройки программы
   ignore_user_abort(true);
   set_time_limit(0);
   ini_set('max_execution_time',0);
   error_reporting(0);
   
   /********************************************************************************
    * Запись в cron:	* * * * * /usr/bin/wget -O /dev/null http://domen.ru/mail.php *
    ********************************************************************************/
	
   # Опции генератора. 1 - включить, 0 - выключить
   $random_mail  = 1; # генерировать email отправителя
   $random_name  = 1; # генерировать имя отправителя
   $random_reply = 1; # генерировать email для ответа
   $random_sabj  = 1; # генерировать тему сообщений
   $random_msg   = 1; # генерировать текст сообщений
   
   # настройки по-умолчанию. при генерации перезаписываются сгенерированными значениями
   $to = 'e.grinec@gmail.com';        # 'Shailov.1968@yandex.ru';   # E-mail получателя(-ей)
   $subject = 'Почтовый робот';       # Тема письма
   $msg = 'Это тестовое сообщение будет отправлятся сразу, как только страница будет запрошена через браузер или через cron. Сейчас на указанную почту уже отправлено письмо с этим текстом (доходит обычно в течении 5 минут). При этом, если указать новые данные, которые нужно отправить и нажать кнопку отправить - то письмо отправится по новому адресу и с новыми данными, данные сохранятся и при следующем запрашивании страницы сразу же отправятся и отобразятся уже новые данные. Если просто повторно запросить страницу, данные просто отправятся снова.';
   $format = 'plain';                  # &quot;html&quot; или &quot;plain&quot;, значение &quot;text&quot; не используется, вместо него - &quot;plain&quot;
   $from_name = 'Evgeny Grinec';       # Имя отправителя
   $from_email = 'e.grinec@gmail.com'; # Мыло отправителя
   $reaplyto = 'e.grinec@gmail.com';   # &quot;отвечайте на адрес&quot;
   $num = 1;                           # Отправить письмо $num раз
   $files = array(				# Имена прикрепляемых файлов =&gt; адрес их расположения относительно местонахождения скрипта
# если необходимо прикрепить файлы, убрать решетку перед следующими строками, заменить адрес до файла реальным адресом
#     'dir0/dir1/dir2/file_name1'
#     ,'dir0/dir1/dir2/file_name2'
#     ,'dir0/dir1/dir2/file_name3'
   );					# если письмо не содержит прикрепленных файлов, оставить как есть
   $log = &quot;log.txt&quot;; # адрес к файлу, в который будут записываться логи, если в отчетах об успешности отправки сообщений нет нужды, вместо адреса указать 0 или пустую строку
   $mailfilename = &quot;&quot;;       # адрес к файлу, с которого будет браться список адресов для рассылки, каждый адрес с новой строки. 0 или пустая строка чтобы использовать список адресатов из переменной $emaillist (многострочная переменная, каждый адрес с новой строки)
   $emaillist = &quot;e.grinec@gmail.com&quot;;

?&gt;
&lt;!doctype html&gt;
&lt;html&gt;&lt;head&gt;&lt;meta charset=&quot;utf-8&quot;&gt;&lt;/head&gt;&lt;body&gt;
&lt;?

	/*************************************************************
	 * Дальше идет непосредственно составление и отправка письма *
	 *************************************************************/
	 
if ($mailfilename) $allemails = file($mailfilename);
else $allemails = split(&quot;\n&quot;, $emaillist);

if ($log)
{
	print &quot;Work started&lt;br&gt;Logs saves in $log&lt;br&gt;&quot;;
	$fp=fopen($log,&quot;a&quot;);
	flush();
}

for($i=0; $i &lt; $num; $i++)
	foreach($allemails as $to) {
		if ($to) {
	  
			if ($random_mail) $from_email = randmail();
			if ($random_name) $from_name = randword();
			if ($random_reply)$replyto = randmail();
			if ($random_sabj) $subject = randsabj();
			else $subject = stripslashes($subject);
			if ($random_msg)  $msg = randmgs();
			else {
				$msg = urlencode($msg);
				$msg = ereg_replace(&quot;%5C%22&quot;, &quot;%22&quot;, $msg);
				$msg = urldecode($msg);
				$msg = stripslashes($msg);
  			}
		 
			$to = ereg_replace(&quot; &quot;, &quot;&quot;, $to);
			$message = ereg_replace(&quot;&amp;email&amp;&quot;, $to, $msg);
			$subject = ereg_replace(&quot;&amp;email&amp;&quot;, $to, $subject);
			 
			$boundary = md5(uniqid(time()));
	
			$header = &quot;From: $from_name &lt;$from_email&gt;\r\nReply-To: $reaplyto\r\n&quot;;
			$header.= &quot;MIME-Version: 1.0\r\n&quot;;
			$header.= &quot;Content-Type: multipart/mixed; boundary=\&quot;$boundary\&quot;\r\n&quot;;
			$header.= &quot;X-Sender: &quot; . $_SERVER['REMOTE_ADDR'] . &quot;\n&quot;;

			$message = &quot;--$boundary\r\nContent-Type: text/$format; charset=\&quot;utf-8\&quot;\r\nContent-Transfer-Encoding: quoted-printable\n\n&quot; . nl2br($msg) . &quot;\n&quot;;
			foreach($files as $file)		# See: http://www.php.net/manual/ru/features.file-upload.multiple.php
				if(is_​readable($file)) {
					$dir = explode('/', $file);
					$fname = $dir[count($dir) - 1];
					$str = @chunk_split(base64_encode(@fread(@fopen($file, &quot;r&quot;), filesize($file))));
					$message.=&quot;--$boundary\nContent-Type: application/octet-stream; name=\&quot;$fname\&quot;\nContent-disposition: attachment; filename=\&quot;$fname\&quot;\nContent-Transfer-Encoding: base64\n\n$str\n\n&quot;;
			}
			$message.=&quot;--$boundary--\n&quot;;
		 
		 # See: php.net/mail
			if(mail($to, $subject, $message, $header)) {
				if ($log)
				 	 fwrite ($fp, ($x+1).&quot;th mail successfully sended&quot;);
				else
				{
					  print &quot;Sending mail to $to. Status: OK&quot;;
					  flush();
				}
			} else {
				if ($log)
					 fwrite ($fp, ($x+1).&quot;th mail NOT sended. There was some problem occupated...&quot;);
				else
				{
					 print &quot;Sending mail to $to. Status: ERROR. Mail NOT sended!&quot;;
					 flush();
				}
			}
		}
	}
?&gt;
&lt;/body&gt;&lt;/html&gt;
&lt;?
 /**********************
  * ФУНКЦИИ ГЕНЕРАТОРА *
  **********************/

function c() {return mt_rand(0,9);}
function s() {
   $word=&quot;qwrtpsdfghjklzxcvbnm&quot;;
   return $word[mt_rand(0,19)];
}
function g() {
   $word=&quot;eyuioa&quot;;
   return $word[mt_rand(0,5)];
}
function randslog(){
 switch (mt_rand(0,4)){
   case  0: return s().g().s();
   case  1: return s().g().s().g();
   case  2: return s().g().s().g().s();
   case  3: return c().c().c().c();
   default: return s().g();
 }
}
function randword()
{
 $r=mt_rand(1,9);
 $cool=array('','_','-','.');
 $s=$cool[mt_rand(0,count($cool)-1)];
 switch (mt_rand(0,8)){
   case  0: return randslog().$s.randslog();
   case  1: return randslog().$s.$r;
   case  2: return randslog().$s.$r.'0';
   case  3: return randslog().$s.$r.'00';
   case  4: return randslog().$s.$r.$r;
   case  5: return randslog().$s.$r.$r.$r;
   case  6: return randslog().$s.mt_rand(date('Y')-70,date('Y')-7);
   default: return slog1().$s.slog1();
 }
}
function randname()
{
 $name_male=array('Василий','Иван','Виктор','Федор','Петр','Захар','Константин','Александр','Евгений','Алексей',
 'Антон','Максим','Борис','Анатолий');
 $name_female=array('Тамара','Татьяна','Анна','Мария','Александра','Евгения',
 'Антонина','Анастасия','Виолетта','Ксения','Иванна','Юлия','Дарья');
 $surname_male=array('Васильев','Самарин','Кулыгин','Иванов','Викторич','Федоров','Анубин','Петров','Тавров','Захаров','Константинович','Александров',
 'Евгеньев','Алексеев',
 'Антонов');
 $surname_female=array('Васильева','Самарина','Кулыгина','Иванова','Викторова','Федорова','Анубина','Петрова','Мария','Захарова','Константинова',
 'Александрова','Евгеньева','Алексеева',
 'Антоновна','Анастасьева','Виолетта');
 return (mt_rand(0,1))?($name_male.' '.$surname_male):($name_female.' '.$surname_female);
}
function randmail()
{
 $domain=array('vk.com','vk.cc','mail.ua','list.ru','inbox.ru','bk.ru','yandex.ua','yandex.kz','yandex.com','yandex.by','narod.ru','yandex.ru','ya.ru','mail.ru','mail.com','hotmail.com','aol.com','microsoft.com','yahoo.com','gmail.com','theglobeandmail.com','mail333.com','pmail.com','lycos.com','royalmail.com','dailymail.co.uk','apple.com','imc.org','sun.com','hushmail.com','mozilla.org','worldemail.com','mailstart.com','cnn.com','operamail.com','almail.com','netscape.com','email.com','latinmail.com','bigmailbox.com','e-mps.org','internet.com','comcast.net','nova.edu');
 return randword().&quot;@&quot;.$domain[mt_rand(0,count($domain)-1)];
}
function randsabj()
{
 $c=mt_rand(1,5);
 $sabj=&quot;&quot;;
 for($a=0;$a&lt;=$c;$a++)
  $sabj .= randword().&quot; &quot;;
 return $sabj;
}
function randmsg()
{
 $c=mt_rand(1,500);
 $msg=&quot;&quot;;
 for($a=0;$a&lt;=$c;$a++)
  $msg .= randword().&quot; &quot;;
 return $msg;
}
?&gt;

<hr>cd<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Текущий каталог изменён на <strong style="color:lightgreen">/home/x-positive/srv/adeptx</strong>, узнать текущий каталог: <strong><em>pwd</em></strong>
<hr>add new bd custom<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;База данных `bd` успешно создана
<hr>add new bd custom<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;База данных `custom` успешно создана
<hr>db custom<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Текущей БД выбрана база данных <strong style="color:lightgreen">user_1_custom</strong>, узнать текущую БД: <strong><em>pwdb</em></strong>
<hr>pwdb<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Текущей БД сейчас является user_1_custom
<hr>db custom<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Текущей БД выбрана база данных <strong style="color:lightgreen">user_1_custom</strong>, узнать текущую БД: <strong><em>pwdb</em></strong>
<hr>db ~<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Текущей БД выбрана база данных <strong style="color:lightgreen">user_1_~</strong>, узнать текущую БД: <strong><em>pwdb</em></strong>
<hr>db<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Текущей БД выбрана база данных <strong style="color:lightgreen">user_1_user_1_default</strong>, узнать текущую БД: <strong><em>pwdb</em></strong>
<hr>db<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Текущей БД выбрана база данных <strong style="color:lightgreen">user_1_user_1_default</strong>, узнать текущую БД: <strong><em>pwdb</em></strong>
<hr>pwdb<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Текущей БД сейчас является user_1_user_1_default
<hr>db custom<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Текущей БД выбрана база данных <strong style="color:lightgreen">user_1_custom</strong>, узнать текущую БД: <strong><em>pwdb</em></strong>
<hr>db<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Текущей БД выбрана база данных <strong style="color:lightgreen">user_1_user_1_default</strong>, узнать текущую БД: <strong><em>pwdb</em></strong>
<hr>sql -d "SELECT IF('adeptx_driver' IN(SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA), 1, 0) AS found"<hr>

1
<hr>sql "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = 'adeptx_driver'"<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;=== КОНЕЦ РЕЗУЛЬТАТОВ SQL ЗАПРОСА ===
<hr>sql -q "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = 'adeptx_driver'"<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;=== КОНЕЦ РЕЗУЛЬТАТОВ SQL ЗАПРОСА ===
<hr>sql "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = 'adeptx_driver'" -i 1<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;=== КОНЕЦ РЕЗУЛЬТАТОВ SQL ЗАПРОСА ===
<hr>sql "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = 'adeptx_driver'" -i 2<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;=== КОНЕЦ РЕЗУЛЬТАТОВ SQL ЗАПРОСА ===
<hr>sql "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = 'adeptx_driver'" -qb custom<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;=== НАЧАЛО РЕЗУЛЬТАТОВ SQL ЗАПРОСА ===

<hr>sql "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = 'adeptx_driver'" -qb custom<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;
=== КОНЕЦ РЕЗУЛЬТАТОВ SQL ЗАПРОСА ===
<hr>pwdb<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Текущей БД сейчас является user_1_user_1_default
<hr>db custom<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Текущей БД выбрана база данных <strong style="color:lightgreen">user_1_custom</strong>, узнать текущую БД: <strong><em>pwdb</em></strong>
<hr>db custom<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Текущей БД выбрана база данных <strong style="color:lightgreen">user_1_custom</strong>, узнать текущую БД: <strong><em>pwdb</em></strong>
<hr>db ~<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Текущей БД выбрана база данных <strong style="color:lightgreen">user_1_default</strong>, узнать текущую БД: <strong><em>pwdb</em></strong>
<hr>pwdb<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Текущей БД сейчас является user_1_default
<hr>pwdb<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;user_1_default
<hr>pwdb<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;user_1_default
<hr>db custom<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Текущей БД выбрана база данных <strong style="color:lightgreen">user_1_custom</strong>, узнать текущую БД: <strong><em>pwdb</em></strong>
<hr>sql "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = 'adeptx_driver'" -b custom<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;
=== КОНЕЦ РЕЗУЛЬТАТОВ SQL ЗАПРОСА ===
<hr>pwdb<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Текущей БД сейчас является user_1_1=/home/x-positive/srv/adeptx;2=cmd/;user_1_default

<hr>db custom<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Текущей БД выбрана база данных <strong style="color:lightgreen">user_1_custom</strong>, узнать текущую БД: <strong><em>pwdb</em></strong>
<hr>sql "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = 'adeptx_driver'" -b custom<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;
=== КОНЕЦ РЕЗУЛЬТАТОВ SQL ЗАПРОСА ===
<hr>pwdb<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Текущей БД сейчас является user_1_1=/home/x-positive/srv/adeptx;2=cmd/;Текущей БД сейчас является user_1_1=/home/x-positive/srv/adeptx;2=cmd/;user_1_default

<hr>aliases<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Array
<hr>pwdb<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Текущей БД сейчас является user_1_1=/home/x-positive/srv/adeptx;2=cmd/;Текущей БД сейчас является user_1_1=/home/x-positive/srv/adeptx;2=cmd/;user_1_default

<hr>aliases<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Array
<hr>aliases<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Array
<hr>aliases<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;
<hr>aliases ls<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;glob|dir|scandir|ысфтвшк|ды|пдщы|файлы|пути|pathes|afqks|genb
<hr>aliases <hr>

1=/home/x-positive/srv/adeptx;2=cmd/;
<hr>"цитата дня"<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Я не знаю какой результат принесёт мне реклама, но даже если я заработаю доллар — я вложу его в рекламу.
<hr>quote<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Если у тебя есть энтузиазм, ты можешь совершить всё, что угодно. Энтузиазм — это основа любого прогресса.
<hr>aliases about<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Команда `about` является псевдонимом команды `help`, для просмотра других псевдонимов следует использовать `aliases help`. Все псевдонимы команды: about|man|info|штащ|ьфт|рудз|manual|про|о|об|?|tutorial|hotkeys|keys|reference|inquiry|enquiry|помощь|справка|руковоство|мануал|мануэль|мануил|эмануэль|исмаил|измаил|иммануил|ман|мэн|чаво|faq|факью|omg|motherofgod|godhelpme|helpme|sos|introduce
<hr>aliases tree<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Псевдонимы функции `tree`: lstree
<hr>aliases lstree<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Команда `lstree` является псевдонимом команды `tree`, для просмотра других псевдонимов следует использовать `aliases tree`. Все псевдонимы команды: lstree
<hr>aliases lstree<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Команда `lstree` является псевдонимом команды `tree`. Результат `aliases tree`: lstree
<hr>aliases tree<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Псевдонимы функции `tree`: lstree
<hr>db custom<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Текущей БД выбрана база данных <strong style="color:lightgreen">user_1_custom</strong>, узнать текущую БД: <strong><em>pwdb</em></strong>
<hr>db custom<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Текущей БД выбрана база данных <strong style="color:lightgreen">user_1_custom</strong>, узнать текущую БД: <strong><em>pwdb</em></strong>
<hr>sql "SELECT * FROM adeptx_user"<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;
=== КОНЕЦ РЕЗУЛЬТАТОВ SQL ЗАПРОСА ===
<hr>db custom<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Текущей БД выбрана база данных <strong style="color:lightgreen">user_1_custom</strong>, узнать текущую БД: <strong><em>pwdb</em></strong>
<hr>sql "SELECT * FROM adeptx_user"<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;
=== КОНЕЦ РЕЗУЛЬТАТОВ SQL ЗАПРОСА ===
<hr>db custom<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Текущей БД выбрана база данных <strong style="color:lightgreen">user_1_custom</strong>, узнать текущую БД: <strong><em>pwdb</em></strong>
<hr>sql "SELECT * FROM adeptx_user"<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;
=== КОНЕЦ РЕЗУЛЬТАТОВ SQL ЗАПРОСА ===
<hr>db custom<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Текущей БД выбрана база данных <strong style="color:lightgreen">user_1_custom</strong>, узнать текущую БД: <strong><em>pwdb</em></strong>
<hr>sql "SELECT * FROM adeptx_user" -d<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;
=== КОНЕЦ РЕЗУЛЬТАТОВ SQL ЗАПРОСА ===
<hr>db custom<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Текущей БД выбрана база данных <strong style="color:lightgreen">user_1_custom</strong>, узнать текущую БД: <strong><em>pwdb</em></strong>
<hr>sql "SELECT * FROM adeptx_user" -d<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;
=== КОНЕЦ РЕЗУЛЬТАТОВ SQL ЗАПРОСА ===
<hr>db custom;sql "SELECT * FROM adeptx_user" -d<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Текущей БД выбрана база данных <strong style="color:lightgreen">user_1_custom</strong>, узнать текущую БД: <strong><em>pwdb</em></strong>
<hr>db custom; sql "SELECT * FROM adeptx_user" -d<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Текущей БД выбрана база данных <strong style="color:lightgreen">user_1_custom</strong>, узнать текущую БД: <strong><em>pwdb</em></strong>
<hr>db custom;    sql "SELECT * FROM adeptx_user" -d<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Текущей БД выбрана база данных <strong style="color:lightgreen">user_1_custom</strong>, узнать текущую БД: <strong><em>pwdb</em></strong>
<hr>db custom;sql "SELECT * FROM adeptx_user" -d<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Текущей БД выбрана база данных <strong style="color:lightgreen">user_1_custom</strong>, узнать текущую БД: <strong><em>pwdb</em></strong>
<hr>db custom;hello<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Текущей БД выбрана база данных <strong style="color:lightgreen">user_1_custom</strong>, узнать текущую БД: <strong><em>pwdb</em></strong>
<hr>db custom;hello;<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Текущей БД выбрана база данных <strong style="color:lightgreen">user_1_custom</strong>, узнать текущую БД: <strong><em>pwdb</em></strong>
<hr>db custom;hello;sql "SELECT * FROM adeptx_user"<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Текущей БД выбрана база данных <strong style="color:lightgreen">user_1_custom</strong>, узнать текущую БД: <strong><em>pwdb</em></strong>
<hr>db custom;hello;sql "SELECT * FROM adeptx_user"<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Текущей БД выбрана база данных <strong style="color:lightgreen">user_1_custom</strong>, узнать текущую БД: <strong><em>pwdb</em></strong>
<hr>db custom;hello;sql "SELECT * FROM adeptx_user"<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Текущей БД выбрана база данных <strong style="color:lightgreen">user_1_custom</strong>, узнать текущую БД: <strong><em>pwdb</em></strong>
<hr>db custom;hello;sql "SELECT * FROM adeptx_user"<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Текущей БД выбрана база данных <strong style="color:lightgreen">user_1_custom</strong>, узнать текущую БД: <strong><em>pwdb</em></strong>
<hr>db custom;hello;sql "SELECT * FROM adeptx_user"<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Текущей БД выбрана база данных <strong style="color:lightgreen">user_1_custom</strong>, узнать текущую БД: <strong><em>pwdb</em></strong>
1=/home/x-positive/srv/adeptx;2=cmd/;Добро пожаловать в Adeptx Driver, x-positive!

<hr>db custom;hello;sql "SELECT * FROM adeptx_user"<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Текущей БД выбрана база данных <strong style="color:lightgreen">user_1_custom</strong>, узнать текущую БД: <strong><em>pwdb</em></strong>
1=/home/x-positive/srv/adeptx;2=cmd/;Добро пожаловать в Adeptx Driver, x-positive!
1=/home/x-positive/srv/adeptx;2=cmd/;
=== КОНЕЦ РЕЗУЛЬТАТОВ SQL ЗАПРОСА ===
<hr>db custom;hello;get my status;get my id<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Текущей БД выбрана база данных <strong style="color:lightgreen">user_1_custom</strong>, узнать текущую БД: <strong><em>pwdb</em></strong>
<hr>db custom;hello;get my status;get my id<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Текущей БД выбрана база данных <strong style="color:lightgreen">user_1_custom</strong>, узнать текущую БД: <strong><em>pwdb</em></strong>
1=/home/x-positive/srv/adeptx;2=cmd/;Добро пожаловать в Adeptx Driver, x-positive!

<hr>db custom;hello;get my status;get my id<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Текущей БД выбрана база данных <strong style="color:lightgreen">user_1_custom</strong>, узнать текущую БД: <strong><em>pwdb</em></strong>
1=/home/x-positive/srv/adeptx;2=cmd/;Добро пожаловать в Adeptx Driver, x-positive!
1=/home/x-positive/srv/adeptx;2=cmd/;admin
<hr>db custom; hello; get my status; get my id<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Текущей БД выбрана база данных <strong style="color:lightgreen">user_1_custom</strong>, узнать текущую БД: <strong><em>pwdb</em></strong>
<hr>db custom  ;  hello  ;  get my status  ;  get my id<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Текущей БД выбрана база данных <strong style="color:lightgreen">user_1_custom</strong>, узнать текущую БД: <strong><em>pwdb</em></strong>
<hr>db custom  ;  hello  ;  get my status  ;  get my id<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Текущей БД выбрана база данных <strong style="color:lightgreen">user_1_custom</strong>, узнать текущую БД: <strong><em>pwdb</em></strong>
<hr>db custom  ;  hello  ;  get my status  ;  get my id<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Текущей БД выбрана база данных <strong style="color:lightgreen">user_1_custom</strong>, узнать текущую БД: <strong><em>pwdb</em></strong>
1=/home/x-positive/srv/adeptx;2=cmd/;Добро пожаловать в Adeptx Driver, x-positive!

<hr>db custom  ;  hello  ;  get my status  ;  get my id<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Текущей БД выбрана база данных <strong style="color:lightgreen">user_1_custom</strong>, узнать текущую БД: <strong><em>pwdb</em></strong>
1=/home/x-positive/srv/adeptx;2=cmd/;Добро пожаловать в Adeptx Driver, x-positive!
1=/home/x-positive/srv/adeptx;2=cmd/;admin
<hr>db custom;hello;get my status;get my id<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Текущей БД выбрана база данных <strong style="color:lightgreen">user_1_custom</strong>, узнать текущую БД: <strong><em>pwdb</em></strong>
<hr>db custom;hello;get my status;get my id<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Текущей БД выбрана база данных <strong style="color:lightgreen">user_1_custom</strong>, узнать текущую БД: <strong><em>pwdb</em></strong>
1=/home/x-positive/srv/adeptx;2=cmd/;Добро пожаловать в Adeptx Driver, x-positive!

<hr>db custom;hello;get my status;get my id<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Текущей БД выбрана база данных <strong style="color:lightgreen">user_1_custom</strong>, узнать текущую БД: <strong><em>pwdb</em></strong>
1=/home/x-positive/srv/adeptx;2=cmd/;Добро пожаловать в Adeptx Driver, x-positive!
1=/home/x-positive/srv/adeptx;2=cmd/;admin
<hr>db custom;hello;get my status;get my id;<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Текущей БД выбрана база данных <strong style="color:lightgreen">user_1_custom</strong>, узнать текущую БД: <strong><em>pwdb</em></strong>
<hr>db custom;hello;get my status;get my id;<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Текущей БД выбрана база данных <strong style="color:lightgreen">user_1_custom</strong>, узнать текущую БД: <strong><em>pwdb</em></strong>
1=/home/x-positive/srv/adeptx;2=cmd/;Добро пожаловать в Adeptx Driver, x-positive!

<hr>db custom;hello;get my status;get my id;<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Текущей БД выбрана база данных <strong style="color:lightgreen">user_1_custom</strong>, узнать текущую БД: <strong><em>pwdb</em></strong>
1=/home/x-positive/srv/adeptx;2=cmd/;Добро пожаловать в Adeptx Driver, x-positive!
1=/home/x-positive/srv/adeptx;2=cmd/;admin
<hr>db custom;hello;get my status;get my id;;;;<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Текущей БД выбрана база данных <strong style="color:lightgreen">user_1_custom</strong>, узнать текущую БД: <strong><em>pwdb</em></strong>
<hr>db custom;hello;get my status;get my id;;;;<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Текущей БД выбрана база данных <strong style="color:lightgreen">user_1_custom</strong>, узнать текущую БД: <strong><em>pwdb</em></strong>
1=/home/x-positive/srv/adeptx;2=cmd/;Добро пожаловать в Adeptx Driver, x-positive!

<hr>db custom;hello;get my status;get my id;;;;<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Текущей БД выбрана база данных <strong style="color:lightgreen">user_1_custom</strong>, узнать текущую БД: <strong><em>pwdb</em></strong>
1=/home/x-positive/srv/adeptx;2=cmd/;Добро пожаловать в Adeptx Driver, x-positive!
1=/home/x-positive/srv/adeptx;2=cmd/;admin
<hr>db custom;hello;get my status;get my id;;;;;;<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Текущей БД выбрана база данных <strong style="color:lightgreen">user_1_custom</strong>, узнать текущую БД: <strong><em>pwdb</em></strong>
<hr>db custom;hello;get my status;get my id;;;;;;<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Текущей БД выбрана база данных <strong style="color:lightgreen">user_1_custom</strong>, узнать текущую БД: <strong><em>pwdb</em></strong>
1=/home/x-positive/srv/adeptx;2=cmd/;Добро пожаловать в Adeptx Driver, x-positive!

<hr>db custom;hello;get my status;get my id;;;;;;<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Текущей БД выбрана база данных <strong style="color:lightgreen">user_1_custom</strong>, узнать текущую БД: <strong><em>pwdb</em></strong>
1=/home/x-positive/srv/adeptx;2=cmd/;Добро пожаловать в Adeptx Driver, x-positive!
1=/home/x-positive/srv/adeptx;2=cmd/;admin
<hr>db custom;hello;get my status;get my id  ;;;;;;<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Текущей БД выбрана база данных <strong style="color:lightgreen">user_1_custom</strong>, узнать текущую БД: <strong><em>pwdb</em></strong>
<hr>db custom;hello;get my status;get my id  ;;;;;;<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Текущей БД выбрана база данных <strong style="color:lightgreen">user_1_custom</strong>, узнать текущую БД: <strong><em>pwdb</em></strong>
1=/home/x-positive/srv/adeptx;2=cmd/;Добро пожаловать в Adeptx Driver, x-positive!

<hr>db custom;hello;get my status;get my id  ;;;;;;<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Текущей БД выбрана база данных <strong style="color:lightgreen">user_1_custom</strong>, узнать текущую БД: <strong><em>pwdb</em></strong>
1=/home/x-positive/srv/adeptx;2=cmd/;Добро пожаловать в Adeptx Driver, x-positive!
1=/home/x-positive/srv/adeptx;2=cmd/;admin
<hr>db custom;hello;get my     id;<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Текущей БД выбрана база данных <strong style="color:lightgreen">user_1_custom</strong>, узнать текущую БД: <strong><em>pwdb</em></strong>
<hr>db custom;hello;get my     id;<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Текущей БД выбрана база данных <strong style="color:lightgreen">user_1_custom</strong>, узнать текущую БД: <strong><em>pwdb</em></strong>
1=/home/x-positive/srv/adeptx;2=cmd/;Добро пожаловать в Adeptx Driver, x-positive!

<hr>db custom;hello;get my     id;<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Текущей БД выбрана база данных <strong style="color:lightgreen">user_1_custom</strong>, узнать текущую БД: <strong><em>pwdb</em></strong>
1=/home/x-positive/srv/adeptx;2=cmd/;Добро пожаловать в Adeptx Driver, x-positive!
1=/home/x-positive/srv/adeptx;2=cmd/;1
<hr>   db   custom    ;  ;  ; ;; ;;;   ;;;hello    ;    get   my    id;;;;  get my nickname   ;;; ; ;  <hr>

1=/home/x-positive/srv/adeptx;2=cmd/;RU: Комманда "" не существует или её файл (/home/x-positive/srv/adeptx//home/x-positive/srv/adeptx/cmd/.php) переименован, перемещён, недоступен, скрыт настройками приватности или повреждён. Воспользуйтесь командой help чтобы узнать список доступных команд.
EN: Command "" not useful for this site/profile, command-package not install, rename or moved. Use command "help" for access commands list.
1=/home/x-positive/srv/adeptx;2=cmd/;Добро пожаловать в Adeptx Driver, x-positive!

<hr>   db   custom    ;  ;  ; ;; ;;;   ;;;hello    ;    get   my    id;;;;  get my nickname   ;;; ; ;  <hr>

1=/home/x-positive/srv/adeptx;2=cmd/;RU: Комманда "" не существует или её файл (/home/x-positive/srv/adeptx//home/x-positive/srv/adeptx/cmd/.php) переименован, перемещён, недоступен, скрыт настройками приватности или повреждён. Воспользуйтесь командой help чтобы узнать список доступных команд.
EN: Command "" not useful for this site/profile, command-package not install, rename or moved. Use command "help" for access commands list.
1=/home/x-positive/srv/adeptx;2=cmd/;Добро пожаловать в Adeptx Driver, x-positive!
1=/home/x-positive/srv/adeptx;2=cmd/;1
<hr>   db   custom    ;  ;  ; ;; ;;;   ;;;hello    ;    get   my    id;;;;  get my nickname   ;;; ; ;  <hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Текущей БД выбрана база данных <strong style="color:lightgreen">user_1_custom</strong>, узнать текущую БД: <strong><em>pwdb</em></strong>
<hr>   db   custom    ;  ;  ; ;; ;;;   ;;;hello    ;    get   my    id;;;;  get my nickname   ;;; ; ;  <hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Текущей БД выбрана база данных <strong style="color:lightgreen">user_1_custom</strong>, узнать текущую БД: <strong><em>pwdb</em></strong>
1=/home/x-positive/srv/adeptx;2=cmd/;Добро пожаловать в Adeptx Driver, x-positive!

<hr>   db   custom    ;  ;  ; ;; ;;;   ;;;hello    ;    get   my    id;;;;  get my nickname   ;;; ; ;  <hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Текущей БД выбрана база данных <strong style="color:lightgreen">user_1_custom</strong>, узнать текущую БД: <strong><em>pwdb</em></strong>
1=/home/x-positive/srv/adeptx;2=cmd/;Добро пожаловать в Adeptx Driver, x-positive!
1=/home/x-positive/srv/adeptx;2=cmd/;1
<hr>sql "SELECT * FROM `adeptx_user`"<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;
=== КОНЕЦ РЕЗУЛЬТАТОВ SQL ЗАПРОСА ===
<hr>sql "SELECT * FROM `adeptx_message`"<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;
=== КОНЕЦ РЕЗУЛЬТАТОВ SQL ЗАПРОСА ===
<hr>sql "SELECT * FROM `adeptx_user_message`"<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;
=== КОНЕЦ РЕЗУЛЬТАТОВ SQL ЗАПРОСА ===
<hr>'цитата дня'<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Если бы я спросил людей, чего они хотят, они бы попросили более быструю лошадь.
<hr>`цитата дня`<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Я не знаю какой результат принесёт мне реклама, но даже если я заработаю доллар — я вложу его в рекламу.
<hr>цитата дня<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;
<hr>цитата дня<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;
<hr>цитата 8<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Женщина — это не только вагон удовольствий, но и три, а то и четыре тонны проблем.
<hr>sql "SELECT * FROM `adeptx_user_message`"<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;
=== КОНЕЦ РЕЗУЛЬТАТОВ SQL ЗАПРОСА ===
<hr>sql "SELECT * FROM `adeptx_user_message`" -fa<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;
=== КОНЕЦ РЕЗУЛЬТАТОВ SQL ЗАПРОСА ===
<hr>sql "SELECT * FROM `adeptx_user_message`" -fa<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;
=== КОНЕЦ РЕЗУЛЬТАТОВ SQL ЗАПРОСА ===
<hr>sql "SELECT * FROM `adeptx_user_message`"<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;
=== КОНЕЦ РЕЗУЛЬТАТОВ SQL ЗАПРОСА ===
<hr>sql "SELECT * FROM `adeptx_user_message`" -fa<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;
=== КОНЕЦ РЕЗУЛЬТАТОВ SQL ЗАПРОСА ===
<hr>select mail<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Последние непрочитанные сообщения (LIMIT 50):

Отправитель: #2 $from_nickname ($from_email)
Тема: Simple 2
Сообщение: Simple letter 2
Дата: 2015-09-10 23:44:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 3
Сообщение: Simple letter 3
Дата: 2015-09-10 23:49:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 4
Сообщение: Simple letter 3
Дата: 2015-09-10 23:50:11

<hr>sql "SELECT * FROM `adeptx_user_message` WHERE was_read=0" -fa<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;
=== КОНЕЦ РЕЗУЛЬТАТОВ SQL ЗАПРОСА ===
<hr>sql "SELECT * FROM `adeptx_user_message` WHERE was_read=0 AND to_uid=1" -fa<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;
=== КОНЕЦ РЕЗУЛЬТАТОВ SQL ЗАПРОСА ===
<hr>add db 12345<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;База данных `12345` успешно создана
<hr>add db default<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;База данных `default` успешно создана
<hr>add db emmanuil<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;База данных `emmanuil` успешно создана
<hr>add db \emmanuil<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;База данных `emmanuil` успешно создана
<hr>add db emmanuil<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;База данных `emmanuil` успешно создана
<hr>del db emmanuil<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;База данных `emmanuil` успешно создана
<hr>del db \emmanuil<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;База данных `emmanuil` успешно <strong style="color:orange">удалена</strong>
<hr>drop db 12345<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;База данных `12345` успешно <strong style="color:orange">удалена</strong>
<hr>drop db bd<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;База данных `bd` успешно <strong style="color:orange">удалена</strong>
<hr>add db rrt<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;База данных `rrt` успешно <strong style="color:orange">создана</strong>
<hr>add db rrt<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;База данных `rrt` успешно <strong style="color:green">создана</strong>
<hr>drop db rrt<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;База данных `rrt` успешно <strong style="color:orange">удалена</strong>
<hr>add db 12345<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;База данных `12345` успешно <strong style="color:green">создана</strong>
<hr>del db \emmanuil<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;База данных `emmanuil` успешно <strong style="color:orange">удалена</strong>
<hr>drop db 12345<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;База данных `12345` успешно <strong style="color:orange">удалена</strong>
<hr>pwdb<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Текущей БД сейчас является user_1_custom
<hr>db custom<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Текущей БД выбрана база данных <strong style="color:lightgreen">user_1_custom</strong>, узнать текущую БД: <strong><em>pwdb</em></strong>
<hr>sql "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = 'adeptx_driver'" -b custom<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;
=== КОНЕЦ РЕЗУЛЬТАТОВ SQL ЗАПРОСА ===
<hr>sql "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = 'adeptx_driver'" -fa<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;
=== КОНЕЦ РЕЗУЛЬТАТОВ SQL ЗАПРОСА ===
<hr>del db ghjk<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;База данных `ghjk` успешно <strong style="color:orange">удалена</strong>
<hr>del db ghjkdsfsd<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;База данных `ghjkdsfsd` успешно <strong style="color:orange">удалена</strong>
<hr>add db 65535<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;База данных `65535` успешно <strong style="color:green">создана</strong>
<hr>add db 65535<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;База данных `65535` успешно <strong style="color:green">создана</strong>
<hr>del db 65535<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;База данных `65535` успешно <strong style="color:orange">удалена</strong>
<hr>is exists user id 1<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;
<hr>is exists user id 3<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;
<hr>is exists user id 35<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;
<hr>is exists user id 1<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;
<hr>is exists user id 165+<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;
<hr>is exists user id 1<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;
<hr>is exists user id 10<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;
<hr>is exists user id 1<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;
<hr>is exists user id 10<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;
<hr>is exists user id 1<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;
<hr>is exists user id 10<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;
<hr>is exists user id 10<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;
<hr>is exists user id 10<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;
<hr>is exists user id 1<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;
<hr>is exists user id 1<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;
<hr>is exists user id 10<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;
<hr>is exists user id 1<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;111
<hr>is exists user id 10<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;111
<hr>is exists user id 100<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;111
<hr>is exists user id 1<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;0
<hr>is exists user id 100<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;0
<hr>is exists user id 10<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;0
<hr>is exists user id 1<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;0
<hr>is exists user id 10<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;0
<hr>is exists user id 1<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;0
<hr>is exists user id 10<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;0
<hr>is exists user id 1<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;0
<hr>is exists user id 1<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;1
<hr>is exists user id 10<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;0
<hr>is exists user id 100<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;0
<hr>is exists user id 2<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;1
<hr>is exists user id 3<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;0
<hr>is exists user id 30<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;1
<hr>is exists user email e.grinec@gmail.com<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;1
<hr>is exists user email e.grinec@gmail.com5<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;0
<hr>is exists user email ts@ts.ts tsts<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;1
<hr>is exists db default<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;0
<hr>is exists db user_1_default<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;0
<hr>is exists db user_1_default<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;0
<hr>is exists db \user_1_default<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;0
<hr>is exists db default<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;1
<hr>is exists db \user_1_default<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;1
<hr>is exists db \user_1_defaultw<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;0
<hr>is exists db \user_2_default<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;0
<hr>is exists db \user_30_default<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;1
<hr>is exists db \adeptx_driver<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;1
<hr>is exists db adeptx_driver<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;0
<hr>is exists db adeptx_driver<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;0
<hr>is exists db \adeptx_driver<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;1
<hr>is not exists db \adeptx_driver<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;0
<hr>is not exists db adeptx_driver<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;1
<hr>isnt exists user id 1<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;0
<hr>is exists user id 1<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;1
<hr>is not exists user id 1<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;0
<hr>isnt not exists user id 1<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;0
<hr>is exists user id 1<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;1
<hr>isnt exists user id 1<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;0
<hr>is not exists user id 1<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;0
<hr>isnt not exists user id 1<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;1
<hr>hello<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Добро пожаловать в Adeptx Driver, x-positive!

<hr>select mail<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Последние непрочитанные сообщения (LIMIT 50):

Отправитель: #2 $from_nickname ($from_email)
Тема: Simple 2
Сообщение: Simple letter 2
Дата: 2015-09-10 23:44:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 3
Сообщение: Simple letter 3
Дата: 2015-09-10 23:49:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 4
Сообщение: Simple letter 3
Дата: 2015-09-10 23:50:11

<hr>ls<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Содержимое текущей директории:

./README.md
./ajax/
./class/
./cmd/
./conf/
./css/
./db/
./extra/
./font/
./handler/
./html/
./img/
./index-2.php
./index.php
./index.php~
./js/
./lang/
./log/
./pma/
./robots.txt
./rout/
./setup/
./sftp-config.json
./temp/
./theme/
./user/

<hr>cd cmd<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Текущий каталог изменён на <strong style="color:lightgreen">/home/x-positive/srv/adeptx/cmd</strong>, узнать текущий каталог: <strong><em>pwd</em></strong>
<hr>hello<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Добро пожаловать в Adeptx Driver, x-positive!

<hr>select mail<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Последние непрочитанные сообщения (LIMIT 50):

Отправитель: #2 $from_nickname ($from_email)
Тема: Simple 2
Сообщение: Simple letter 2
Дата: 2015-09-10 23:44:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 3
Сообщение: Simple letter 3
Дата: 2015-09-10 23:49:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 4
Сообщение: Simple letter 3
Дата: 2015-09-10 23:50:11

<hr>hello<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Добро пожаловать в Adeptx Driver, x-positive!

<hr>select mail<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;Последние непрочитанные сообщения (LIMIT 50):

Отправитель: #2 $from_nickname ($from_email)
Тема: Simple 2
Сообщение: Simple letter 2
Дата: 2015-09-10 23:44:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 3
Сообщение: Simple letter 3
Дата: 2015-09-10 23:49:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 4
Сообщение: Simple letter 3
Дата: 2015-09-10 23:50:11

<hr>eval 18*4<hr>

1=/home/x-positive/srv/adeptx;2=cmd/;
<hr>eval 18*4<hr>


<hr>eval echo 18*<hr>


<hr>eval echo 18*4<hr>


<hr>php echo 192/17<hr>


<hr>eval echo 192/17<hr>


<hr>php echo 192/17<hr>


<hr>php is.php<hr>


<hr>php 98/3<hr>


<hr>php echo 98/3<hr>


<hr>php echo 11<hr>


<hr>hello<hr>

Добро пожаловать в Adeptx Driver, x-positive!

<hr>select mail<hr>

Последние непрочитанные сообщения (LIMIT 50):

Отправитель: #2 $from_nickname ($from_email)
Тема: Simple 2
Сообщение: Simple letter 2
Дата: 2015-09-10 23:44:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 3
Сообщение: Simple letter 3
Дата: 2015-09-10 23:49:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 4
Сообщение: Simple letter 3
Дата: 2015-09-10 23:50:11

<hr>hello<hr>

Добро пожаловать в Adeptx Driver, x-positive!

<hr>select mail<hr>

Последние непрочитанные сообщения (LIMIT 50):

Отправитель: #2 $from_nickname ($from_email)
Тема: Simple 2
Сообщение: Simple letter 2
Дата: 2015-09-10 23:44:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 3
Сообщение: Simple letter 3
Дата: 2015-09-10 23:49:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 4
Сообщение: Simple letter 3
Дата: 2015-09-10 23:50:11

<hr>hello<hr>

Добро пожаловать в Adeptx Driver, x-positive!

<hr>select mail<hr>

Последние непрочитанные сообщения (LIMIT 50):

Отправитель: #2 $from_nickname ($from_email)
Тема: Simple 2
Сообщение: Simple letter 2
Дата: 2015-09-10 23:44:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 3
Сообщение: Simple letter 3
Дата: 2015-09-10 23:49:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 4
Сообщение: Simple letter 3
Дата: 2015-09-10 23:50:11

<hr>hello<hr>

Добро пожаловать в Adeptx Driver, x-positive!

<hr>select mail<hr>

Последние непрочитанные сообщения (LIMIT 50):

Отправитель: #2 $from_nickname ($from_email)
Тема: Simple 2
Сообщение: Simple letter 2
Дата: 2015-09-10 23:44:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 3
Сообщение: Simple letter 3
Дата: 2015-09-10 23:49:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 4
Сообщение: Simple letter 3
Дата: 2015-09-10 23:50:11

<hr>select mail<hr>

Последние непрочитанные сообщения (LIMIT 50):

Отправитель: #2 $from_nickname ($from_email)
Тема: Simple 2
Сообщение: Simple letter 2
Дата: 2015-09-10 23:44:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 3
Сообщение: Simple letter 3
Дата: 2015-09-10 23:49:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 4
Сообщение: Simple letter 3
Дата: 2015-09-10 23:50:11

<hr>hello<hr>

Добро пожаловать в Adeptx Driver, x-positive!

<hr>select mail<hr>

Последние непрочитанные сообщения (LIMIT 50):

Отправитель: #2 $from_nickname ($from_email)
Тема: Simple 2
Сообщение: Simple letter 2
Дата: 2015-09-10 23:44:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 3
Сообщение: Simple letter 3
Дата: 2015-09-10 23:49:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 4
Сообщение: Simple letter 3
Дата: 2015-09-10 23:50:11

<hr>hello<hr>

Добро пожаловать в Adeptx Driver, x-positive!

<hr>select mail<hr>

Последние непрочитанные сообщения (LIMIT 50):

Отправитель: #2 $from_nickname ($from_email)
Тема: Simple 2
Сообщение: Simple letter 2
Дата: 2015-09-10 23:44:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 3
Сообщение: Simple letter 3
Дата: 2015-09-10 23:49:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 4
Сообщение: Simple letter 3
Дата: 2015-09-10 23:50:11

<hr>hello<hr>

Добро пожаловать в Adeptx Driver, x-positive!

<hr>select mail<hr>

Последние непрочитанные сообщения (LIMIT 50):

Отправитель: #2 $from_nickname ($from_email)
Тема: Simple 2
Сообщение: Simple letter 2
Дата: 2015-09-10 23:44:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 3
Сообщение: Simple letter 3
Дата: 2015-09-10 23:49:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 4
Сообщение: Simple letter 3
Дата: 2015-09-10 23:50:11

<hr>hello<hr>

Добро пожаловать в Adeptx Driver, x-positive!

<hr>select mail<hr>

Последние непрочитанные сообщения (LIMIT 50):

Отправитель: #2 $from_nickname ($from_email)
Тема: Simple 2
Сообщение: Simple letter 2
Дата: 2015-09-10 23:44:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 3
Сообщение: Simple letter 3
Дата: 2015-09-10 23:49:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 4
Сообщение: Simple letter 3
Дата: 2015-09-10 23:50:11

<hr>get my status<hr>

admin
<hr>get my status<hr>

admin
<hr>set my id 1<hr>

Success
<hr>set my id 1<hr>

Success
<hr>get my id<hr>

1
<hr>get my id<hr>

1
<hr>eval echo `get my id`<hr>


<hr>eval echo 1<hr>


<hr>get my id<hr>

1
<hr>eval echo 1<hr>


<hr>eval echo "1"<hr>


<hr>eval echo "1";<hr>


<hr>eval echo("1");<hr>


<hr>eval echo("178");<hr>


<hr>eval echo("ghj");<hr>


<hr>eval print 1;<hr>


<hr>eval return 1;<hr>

1
<hr>eval return 198;<hr>

198
<hr>set my id 15<hr>


<hr>get my id 15<hr>

1
<hr>set my id 13<hr>


<hr>set my id 1<hr>

Success
<hr>get my status<hr>

13

<hr>select mail<hr>

Последние непрочитанные сообщения (LIMIT 50):

Отправитель: #2 $from_nickname ($from_email)
Тема: Simple 2
Сообщение: Simple letter 2
Дата: 2015-09-10 23:44:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 3
Сообщение: Simple letter 3
Дата: 2015-09-10 23:49:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 4
Сообщение: Simple letter 3
Дата: 2015-09-10 23:50:11

<hr>get my status<hr>

admin
<hr>get my nickname<hr>

x-positive
<hr>get my id<hr>

1
<hr>get my id<hr>


<hr>select mail<hr>


<hr>get my id<hr>

1
<hr>select mail<hr>

Последние непрочитанные сообщения (LIMIT 50):

Отправитель: #2 $from_nickname ($from_email)
Тема: Simple 2
Сообщение: Simple letter 2
Дата: 2015-09-10 23:44:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 3
Сообщение: Simple letter 3
Дата: 2015-09-10 23:49:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 4
Сообщение: Simple letter 3
Дата: 2015-09-10 23:50:11

<hr>add db navitronika<hr>

База данных `navitronika` успешно <strong style="color:green">создана</strong>
<hr>add db navitronika<hr>

База данных `navitronika` успешно <strong style="color:green">создана</strong>
<hr>is exists db navitronika<hr>

1
<hr>is exists db navitronika<hr>

1
<hr>drop db navitronika<hr>

База данных `navitronika` успешно <strong style="color:orange">удалена</strong>
<hr>is exists db navitronika<hr>

0
<hr>is exists db navitronika<hr>

0
<hr>hello<hr>

Добро пожаловать в Adeptx Driver, x-positive!

<hr>select mail<hr>

Последние непрочитанные сообщения (LIMIT 50):

Отправитель: #2 $from_nickname ($from_email)
Тема: Simple 2
Сообщение: Simple letter 2
Дата: 2015-09-10 23:44:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 3
Сообщение: Simple letter 3
Дата: 2015-09-10 23:49:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 4
Сообщение: Simple letter 3
Дата: 2015-09-10 23:50:11

<hr>sql "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = 'navitronika'"<hr>


=== КОНЕЦ РЕЗУЛЬТАТОВ SQL ЗАПРОСА ===
<hr>sql "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = 'user_1_navitronika'"<hr>


=== КОНЕЦ РЕЗУЛЬТАТОВ SQL ЗАПРОСА ===
<hr>isnt user authorized<hr>

0
<hr>sql "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = 'user_1_navitronika'"<hr>


=== КОНЕЦ РЕЗУЛЬТАТОВ SQL ЗАПРОСА ===
<hr>dump<hr>

Дамп _2015-10-03_04-07-16.sql успешно создан в папку дампов и бекапов "extra/copy/". Создание дампа с просмотром осуществляется командой get mysql dump.

<hr>get last dump<hr>

SET FOREIGN_KEY_CHECKS = 0;

-- 
-- Table structure for table `adeptx_epigraph` 
-- 

DROP TABLE IF EXISTS `adeptx_epigraph`;
CREATE TABLE `adeptx_epigraph` (
`id` int(15) NOT NULL auto_increment,
`epigraph` varchar(255) NOT NULL,
`utter` varchar(255),
`footnote` varchar(255),
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=66;

-- --------------------------------------------------------

-- 
-- Table structure for table `adeptx_session` 
-- 

DROP TABLE IF EXISTS `adeptx_session`;
CREATE TABLE `adeptx_session` (
`id` bigint(255) NOT NULL auto_increment,
`user_id` bigint(255) NOT NULL,
`line_desc` varchar(255) NOT NULL,
`line_value` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3;

-- --------------------------------------------------------

-- 
-- Table structure for table `adeptx_user` 
-- 

DROP TABLE IF EXISTS `adeptx_user`;
CREATE TABLE `adeptx_user` (
`id` bigint(255) NOT NULL auto_increment,
`nickname` varchar(255) NOT NULL,
`email` varchar(255) NOT NULL,
`hash` varchar(255) NOT NULL,
`salt` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=32;

-- --------------------------------------------------------

-- 
-- Table structure for table `adeptx_user_message` 
-- 

DROP TABLE IF EXISTS `adeptx_user_message`;
CREATE TABLE `adeptx_user_message` (
`id` int(15) NOT NULL auto_increment,
`to_uid` int(9) NOT NULL,
`subject` varchar(255) NOT NULL,
`message` text,
`from_uid` int(9) NOT NULL,
`sender_ip` varchar(255),
`date_sent` timestamp DEFAULT '2015-09-25 19:14:43' NOT NULL,
`was_read` tinyint(1),
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8;

-- --------------------------------------------------------

-- 
-- Dumping data for table `adeptx_epigraph` 
-- 

INSERT INTO `adeptx_epigraph` (`id`, `epigraph`, `utter`, `footnote`) VALUES ('1','Машины должны работать. Люди должны думать.','Лозунг IBM',''),
 ('2','Почта должна доставляться вовремя.','Из причины запрета на учебник математики в РФ',''),
 ('3','Вам были даны другие качества.\nВы тот, кто не может сыграть то, чего на самом деле не чувствует.','Мария Герасимова',''),
 ('4','Вы вызываете у меня искреннюю улыбку...\nВ этом есть романтика нашего времени, Вы не находите?','Мария Герасимова',''),
 ('5','Smile! Why? Becouse you can.','',''),
 ('6','Никогда не заставляйте родителей сомневаться в однажды принятом решении.','',''),
 ('7','Тот, кто лишен чувства юмора, может быть абсолютно свободен и ничего не бояться, так как самое страшное с ним уже произошло.','',''),
 ('8','Фразы бесподобны, только они вторичны. Мой дорогой человек, я желаю Вам меньше думать о том, как произвести впечатление, Вы — стоящее доказательство всему вышесказанному.','Мария Герасимова',''),
 ('9','Не принимай подачки, а бьют — давай сдачи.','Мария Малиновская aka Mizz Paper',''),
 ('10','Никогда не благодарите за искренность.','Мария Герасимова',''),
 ('11','Вы слишком интересны и идеальны, будто искусственные.','Мария Герасимова',''),
 ('12','Если не любите рисковать, не начинайте свое дело. Наймитесь к тем людям, которые рисковать готовы.','<a href="http://habrahabr.ru/company/yandex/blog/208886/#comment_7198828">Ксения Елкина</a>',''),
 ('13','Каждый охотник знать желает, где фазаны обитают.','Не помогло',''),
 ('14','Мы все притворщики.\nКто-то маски носит лучше, кто-то - хуже.','Мария Герасимова',''),
 ('15','Дисциплина — это не ограничение свободы.\nЭто отсечение всего лишнего.','Брюс Ли',''),
 ('16','Оболочка не важна, никогда.','Яна Толмачева',''),
 ('17','Слова пусты, но суть велика и значительна.','Мария Малиновская',''),
 ('18','Хочешь популярности — научись удивлять, хочешь познать — умей удивляться.','',''),
 ('19','Не все парни забывают.','Виталий Омельченко',''),
 ('20','Успешные люди меняются сами, остальных меняет жизнь.','Джим Рон',''),
 ('21','никогда свобода суицид','Марти Кан',''),
 ('22','If all objects and people in daily life were equipped with identifiers,\nthey could be managed and inventoried by computers','Концепция IoT',''),
 ('23','Раз все объекты и люди в быту оснащены идентификаторами,\nих можно регулировать и инвентаризовать компьютерами.','Концепция «Интернета вещей»',''),
 ('24','Если не можешь простить, вспомни, сколько прощено тебе.','',''),
 ('25','Если вы до сих пор не поняли, чем мы занимаемся, значит мы хорошо справляемся.','',''),
 ('26','Наши любимые игры: Business, Development, Sales & Marketing.','',''),
 ('27','Вся проблема современной системы образования в том, что учителя преимущественно женщины, при том, что парни и девушки учатся вместе.','',''),
 ('28','Любящий многих — познает женщин.\nЛюбящий одну — познает любовь.','',''),
 ('29','Когда молчание вдвоем не напрягает, ты понимаешь, что нашел кого-то особенного.','',''),
 ('30','Богатство — это состояние ума.','',''),
 ('31','Все так бояться остаться никем в этой жизни, что становятся кем попало.','',''),
 ('32','Люди действительно готовы продать все, если цена их устроит.','Чак Паланик',''),
 ('33','Там, где все горбаты, стройность становится уродством.','Оноре де Бальзак',''),
 ('34','Неважно сколько у вас ресурсов. Если вы не умеете их правильно использовать, их никогда не будет достаточно.','Анна Бурхович',''),
 ('35','Нельзя приходить и уходить, когда вздумается.\nНельзя просто оставлять человека на улице в дождь, а на следующее утро ждать, что он бросится к тебе на шею.','',''),
 ('36','Если вы думаете, что сможете — вы сможете,\nесли думаете, что нет — вы правы.','Мао Цзэдун',''),
 ('37','Если вы думаете, что вы способны на что-то, вы правы, если вы думаете, что у вас не получится что-то, вы тоже правы.','Генри Форд',''),
 ('38','Пройдёмте в сад?\nЯ покажу Вас розам...','Ричард Шеридан',''),
 ('39','Да не о том думай, что спросили, а о том, для чего?\nДогадаешься, для чего, тогда и поймешь, как надо ответить.','Максим Горький',''),
 ('40','Будьте добрее, когда это возможно.\nА это возможно всегда.','',''),
 ('41','Практикуйте хаотичное добро!','Антон Громов',''),
 ('42','Будьте добрее, а то как лохи.','Даша Солнцева',''),
 ('43','Жизнь пролетает моментально,\nА мы живем, как будто пишем черновик,<br>Не понимая в суете скандальной,\nЧто наша жизнь — всего лишь только миг.','',''),
 ('44','Неуверенность разрушила столько возможностей.','Эрих Мария Ремарк',''),
 ('45','Вчера я бежал запломбировать зуб\nИ смех меня брал на бегу:\nВсю жизнь я таскаю свой будущий труп\nИ рьяно его берегу.','Губерман',''),
 ('46','Лучшее что нам доступно, это самопознание.','',''),
 ('47','Спрашивать: «Кто должен быть боссом?» — всё равно, что спрашивать: «Кто должен быть тенором в этом квартете?». Конечно тот, кто может петь тенором.','Генри Форд',''),
 ('48','Боссами становятся те, кто может быть боссом.','',''),
 ('49','Гимнастика — это полная чушь. Здоровым она не нужна, а больным противопоказана.','Генри Форд',''),
 ('50','Когда я не могу управлять событиями, я представляю им самим управлять собой.','Генри Форд',''),
 ('51','Думать — самая трудная работа; вот, вероятно, почему этим занимаются, столь не многие.','Генри Форд',''),
 ('52','Я не знаю какой результат принесёт мне реклама, но даже если я заработаю доллар — я вложу его в рекламу.','Генри Форд',''),
 ('53','Я никогда не говорю: «Мне нужно, чтоб вы это сделали». Я говорю: «Мне интересно, сумеете ли вы это сделать».','Генри Форд',''),
 ('54','Когда кажется, что весь мир настроен против тебя, помни, что самолёт взлетает против ветра.','Генри Форд',''),
 ('55','Nothing is particularly hard if you divide it into small jobs.','Генри Форд',''),
 ('56','Время не любит, когда его тратят впустую.','Генри Форд',''),
 ('57','Всё можно сделать лучше, чем делалось до сих пор.','Генри Форд',''),
 ('58','Если бы я спросил людей, чего они хотят, они бы попросили более быструю лошадь.','Генри Форд',''),
 ('59','Если у тебя есть энтузиазм, ты можешь совершить всё, что угодно. Энтузиазм — это основа любого прогресса.','Генри Форд',''),
 ('60','Женщина — это не только вагон удовольствий, но и три, а то и четыре тонны проблем.','Генри Форд',''),
 ('61','Более одаренные люди ведут общество вперед, облегчая остальным условия жизни.','Генри Форд',''),
 ('62','Успешные люди вырываются вперёд, используя то время которое остальные используют в пустую.','Генри Форд',''),
 ('63','Гораздо больше людей сдавшихся, чем побежденных.','Генри Форд',''),
 ('64','Мой секрет успеха заключается в умении понять точку зрения другого человека и смотреть на вещи и с его и со своей точек зрения.','Генри Форд',''),
 ('65','Когда часто выходишь за зону комфорта, становится скучно, а спастись от скуки ещё сложнее, чем почувствовать себя свободным','Евгения Матросова','');

-- --------------------------------------------------------

-- 
-- Dumping data for table `adeptx_session` 
-- 

INSERT INTO `adeptx_session` (`id`, `user_id`, `line_desc`, `line_value`) VALUES ('1','1','cloud','fm'),
 ('2','2','cloud','diff');

-- --------------------------------------------------------

-- 
-- Dumping data for table `adeptx_user` 
-- 

INSERT INTO `adeptx_user` (`id`, `nickname`, `email`, `hash`, `salt`) VALUES ('1','x-positive','e.grinec@gmail.com','6ab39c41030d3888846c4ecb11375bb3ad7138f7879ac19f2f9e192f7614cf1523f1b3ac951eea304b09d911d3797f32','5024467d5acfd9d9d3592340ee2800cf'),
 ('2','gcorp','gcorp.gcorp@gmail.com','0359ac6aa8df54fe9dad42ef88a5134e5d2389e4339cdc91330de5f6bdf24e8f1c2081763a03d00838c1aa16f18db61e','0cc27475046ec987dfc168c0669b6323'),
 ('30','test','','74be16979710d4c4e7c6647856088456098f6bcd4621d373cade4e832627b4f6ad9402f64107cd7857359e6849622ce2','d41d8cd98f00b204e9800998ecf8427e'),
 ('31','','ts@ts.ts','68573ec824e9776f703711b20ed25c8f6120ebabcd02e35082049723d85f6a08dc3e3bfae317af2346b20a4fb086cf48','284e699af555e280e7e2c9ed3578e575');

-- --------------------------------------------------------

-- 
-- Dumping data for table `adeptx_user_message` 
-- 

INSERT INTO `adeptx_user_message` (`id`, `to_uid`, `subject`, `message`, `from_uid`, `sender_ip`, `date_sent`, `was_read`) VALUES ('1','2','Тест 1','Тестовое сообщение 1','1','127.0.0.1','2009-09-09 22:22:22','1'),
 ('2','2','Тест 2','Тестовое сообщение 2 (непрочитанное сообщение. первое прочитано)','1','127.0.0.1','2015-09-10 22:29:10','0'),
 ('3','1','Simple 1','Пример прочитанного сообщения','2','127.0.0.1','2015-09-10 22:42:10','1'),
 ('4','0','Тестовое сообщение','Так будут выглядеть ваши новые непрочитанные сообщения когда вы зарегистрируетесь.<br>Это лишь один из многих мессенджеров, вы можете подключать любой мессенджер, в том числе писать свой собственный. <br>Как следствие темы оформления могут быть любыми, как и настройки считывания сообщений.','2','127.0.0.1','2015-09-10 23:41:11','0'),
 ('5','1','Simple 2','Simple letter 2','2','127.0.0.1','2015-09-10 23:44:11','0'),
 ('6','1','Simple 3','Simple letter 3','0','127.0.0.1','2015-09-10 23:49:11','0'),
 ('7','1','Simple 4','Simple letter 3','0','127.0.0.1','2015-09-10 23:50:11','0');

-- --------------------------------------------------------

SET FOREIGN_KEY_CHECKS = 1;


<hr>select mail<hr>

Последние непрочитанные сообщения (LIMIT 50):

Отправитель: #2 $from_nickname ($from_email)
Тема: Simple 2
Сообщение: Simple letter 2
Дата: 2015-09-10 23:44:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 3
Сообщение: Simple letter 3
Дата: 2015-09-10 23:49:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 4
Сообщение: Simple letter 3
Дата: 2015-09-10 23:50:11

<hr>is exists db lang<hr>

0
<hr>is exists db \lang<hr>

0
<hr>is exists db \adeptx_lang<hr>

0
<hr>is exists db \user_2_default<hr>

0
<hr>is exists db \lang<hr>

0
<hr>select mail<hr>

Последние непрочитанные сообщения (LIMIT 50):

Отправитель: #2 $from_nickname ($from_email)
Тема: Simple 2
Сообщение: Simple letter 2
Дата: 2015-09-10 23:44:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 3
Сообщение: Simple letter 3
Дата: 2015-09-10 23:49:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 4
Сообщение: Simple letter 3
Дата: 2015-09-10 23:50:11

<hr>is exists db lang<hr>

0
<hr>is exists db \lang<hr>

0
<hr>is exists dsb \lang<hr>

0
<hr>is exists db \adeptx_session<hr>

0
<hr>is exists db \adeptx<hr>

1
<hr>is exists db \adeptx_driver<hr>

1
<hr>is exists db \lang<hr>

0
<hr>is exists db \lang<hr>

0
<hr>is exists db \lang<hr>

0
<hr>is exists db \lang<hr>

0
<hr>is exists db \lang<hr>

0
<hr>is exists db \lang<hr>

0
<hr>is exists db \lang<hr>

0
<hr>is exists db \lang<hr>

0
<hr>is exists db \lang<hr>

0
<hr>is exists db \lang<hr>

0
<hr>is exists db \lang<hr>

0
<hr>add db \lang<hr>

База данных `lang` успешно <strong style="color:green">создана</strong>
<hr>is exists db \user_2_default<hr>

0
<hr>add db \user_2_default<hr>

База данных `user_2_default` успешно <strong style="color:green">создана</strong>
<hr>is exists db \user_2_custom<hr>

0
<hr>add db \user_2_custom<hr>

База данных `user_2_custom` успешно <strong style="color:green">создана</strong>
<hr>is exists db \user_2_test<hr>

0
<hr>add db \user_2_test<hr>

База данных `user_2_test` успешно <strong style="color:green">создана</strong>
<hr>select mail<hr>

Последние непрочитанные сообщения (LIMIT 50):

Отправитель: #2 $from_nickname ($from_email)
Тема: Simple 2
Сообщение: Simple letter 2
Дата: 2015-09-10 23:44:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 3
Сообщение: Simple letter 3
Дата: 2015-09-10 23:49:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 4
Сообщение: Simple letter 3
Дата: 2015-09-10 23:50:11

<hr>is exists db myp<hr>

0
<hr>add db myp<hr>

База данных `myp` успешно <strong style="color:green">создана</strong>
<hr>drop db myp<hr>

База данных `myp` успешно <strong style="color:orange">удалена</strong>
<hr>whoami<hr>

1
<hr>whoami<hr>

x-positive
<hr>whoami<hr>

x-positive
<hr>id<hr>

1
<hr>who am i<hr>

x-positive pts/1        2015-10-03 17:56 (:0)
<hr>who is he<hr>


<hr>who<hr>

1 x-positive admin
<hr>who is he<hr>


<hr>who<hr>

1 x-positive admin
<hr>who<hr>

1	x-positive	admin
<hr>who<hr>

1		x-positive		admin
<hr>select mail<hr>

Последние непрочитанные сообщения (LIMIT 50):

Отправитель: #2 $from_nickname ($from_email)
Тема: Simple 2
Сообщение: Simple letter 2
Дата: 2015-09-10 23:44:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 3
Сообщение: Simple letter 3
Дата: 2015-09-10 23:49:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 4
Сообщение: Simple letter 3
Дата: 2015-09-10 23:50:11

<hr>hello<hr>

Добро пожаловать в Adeptx Driver, x-positive!

<hr>select mail<hr>

Последние непрочитанные сообщения (LIMIT 50):

Отправитель: #2 $from_nickname ($from_email)
Тема: Simple 2
Сообщение: Simple letter 2
Дата: 2015-09-10 23:44:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 3
Сообщение: Simple letter 3
Дата: 2015-09-10 23:49:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 4
Сообщение: Simple letter 3
Дата: 2015-09-10 23:50:11

<hr>hello<hr>

Добро пожаловать в Adeptx Driver, x-positive!

<hr>select mail<hr>

Последние непрочитанные сообщения (LIMIT 50):

Отправитель: #2 $from_nickname ($from_email)
Тема: Simple 2
Сообщение: Simple letter 2
Дата: 2015-09-10 23:44:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 3
Сообщение: Simple letter 3
Дата: 2015-09-10 23:49:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 4
Сообщение: Simple letter 3
Дата: 2015-09-10 23:50:11

<hr>open fm<hr>

1
<hr>open fm<hr>

1
<hr>hello<hr>

Добро пожаловать в Adeptx Driver, x-positive!

<hr>select mail<hr>

Последние непрочитанные сообщения (LIMIT 50):

Отправитель: #2 $from_nickname ($from_email)
Тема: Simple 2
Сообщение: Simple letter 2
Дата: 2015-09-10 23:44:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 3
Сообщение: Simple letter 3
Дата: 2015-09-10 23:49:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 4
Сообщение: Simple letter 3
Дата: 2015-09-10 23:50:11

<hr>open fm<hr>

1
<hr>open fm<hr>

1
<hr>open fm<hr>


<hr>select mail<hr>

Последние непрочитанные сообщения (LIMIT 50):

Отправитель: #2 $from_nickname ($from_email)
Тема: Simple 2
Сообщение: Simple letter 2
Дата: 2015-09-10 23:44:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 3
Сообщение: Simple letter 3
Дата: 2015-09-10 23:49:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 4
Сообщение: Simple letter 3
Дата: 2015-09-10 23:50:11

<hr>hello<hr>

Добро пожаловать в Adeptx Driver, x-positive!

<hr>open fm<hr>


<hr>open fm<hr>


<hr>hello<hr>

Добро пожаловать в Adeptx Driver, x-positive!

<hr>select mail<hr>

Последние непрочитанные сообщения (LIMIT 50):

Отправитель: #2 $from_nickname ($from_email)
Тема: Simple 2
Сообщение: Simple letter 2
Дата: 2015-09-10 23:44:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 3
Сообщение: Simple letter 3
Дата: 2015-09-10 23:49:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 4
Сообщение: Simple letter 3
Дата: 2015-09-10 23:50:11

<hr>hello<hr>

Добро пожаловать в Adeptx Driver, x-positive!

<hr>select mail<hr>

Последние непрочитанные сообщения (LIMIT 50):

Отправитель: #2 $from_nickname ($from_email)
Тема: Simple 2
Сообщение: Simple letter 2
Дата: 2015-09-10 23:44:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 3
Сообщение: Simple letter 3
Дата: 2015-09-10 23:49:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 4
Сообщение: Simple letter 3
Дата: 2015-09-10 23:50:11

<hr>open fm<hr>


<hr>hello<hr>

Добро пожаловать в Adeptx Driver, x-positive!

<hr>select mail<hr>

Последние непрочитанные сообщения (LIMIT 50):

Отправитель: #2 $from_nickname ($from_email)
Тема: Simple 2
Сообщение: Simple letter 2
Дата: 2015-09-10 23:44:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 3
Сообщение: Simple letter 3
Дата: 2015-09-10 23:49:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 4
Сообщение: Simple letter 3
Дата: 2015-09-10 23:50:11

<hr>hello<hr>

Добро пожаловать в Adeptx Driver, x-positive!

<hr>select mail<hr>

Последние непрочитанные сообщения (LIMIT 50):

Отправитель: #2 $from_nickname ($from_email)
Тема: Simple 2
Сообщение: Simple letter 2
Дата: 2015-09-10 23:44:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 3
Сообщение: Simple letter 3
Дата: 2015-09-10 23:49:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 4
Сообщение: Simple letter 3
Дата: 2015-09-10 23:50:11

<hr>hello<hr>

Добро пожаловать в Adeptx Driver, x-positive!

<hr>select mail<hr>

Последние непрочитанные сообщения (LIMIT 50):

Отправитель: #2 $from_nickname ($from_email)
Тема: Simple 2
Сообщение: Simple letter 2
Дата: 2015-09-10 23:44:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 3
Сообщение: Simple letter 3
Дата: 2015-09-10 23:49:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 4
Сообщение: Simple letter 3
Дата: 2015-09-10 23:50:11

<hr>hello<hr>

Добро пожаловать в Adeptx Driver, x-positive!

<hr>select mail<hr>

Последние непрочитанные сообщения (LIMIT 50):

Отправитель: #2 $from_nickname ($from_email)
Тема: Simple 2
Сообщение: Simple letter 2
Дата: 2015-09-10 23:44:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 3
Сообщение: Simple letter 3
Дата: 2015-09-10 23:49:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 4
Сообщение: Simple letter 3
Дата: 2015-09-10 23:50:11

<hr>id<hr>

1
<hr>hello<hr>

Добро пожаловать в Adeptx Driver, x-positive!

<hr>select mail<hr>

Последние непрочитанные сообщения (LIMIT 50):

Отправитель: #2 $from_nickname ($from_email)
Тема: Simple 2
Сообщение: Simple letter 2
Дата: 2015-09-10 23:44:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 3
Сообщение: Simple letter 3
Дата: 2015-09-10 23:49:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 4
Сообщение: Simple letter 3
Дата: 2015-09-10 23:50:11

<hr>hello<hr>

Добро пожаловать в Adeptx Driver, x-positive!

<hr>select mail<hr>

Последние непрочитанные сообщения (LIMIT 50):

Отправитель: #2 $from_nickname ($from_email)
Тема: Simple 2
Сообщение: Simple letter 2
Дата: 2015-09-10 23:44:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 3
Сообщение: Simple letter 3
Дата: 2015-09-10 23:49:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 4
Сообщение: Simple letter 3
Дата: 2015-09-10 23:50:11

<hr>hello<hr>

Добро пожаловать в Adeptx Driver, x-positive!

<hr>select mail<hr>

Последние непрочитанные сообщения (LIMIT 50):

Отправитель: #2 $from_nickname ($from_email)
Тема: Simple 2
Сообщение: Simple letter 2
Дата: 2015-09-10 23:44:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 3
Сообщение: Simple letter 3
Дата: 2015-09-10 23:49:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 4
Сообщение: Simple letter 3
Дата: 2015-09-10 23:50:11

<hr>hello<hr>

Добро пожаловать в Adeptx Driver, x-positive!

<hr>select mail<hr>

Последние непрочитанные сообщения (LIMIT 50):

Отправитель: #2 $from_nickname ($from_email)
Тема: Simple 2
Сообщение: Simple letter 2
Дата: 2015-09-10 23:44:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 3
Сообщение: Simple letter 3
Дата: 2015-09-10 23:49:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 4
Сообщение: Simple letter 3
Дата: 2015-09-10 23:50:11

<hr>hello<hr>

Добро пожаловать в Adeptx Driver, x-positive!

<hr>select mail<hr>

Последние непрочитанные сообщения (LIMIT 50):

Отправитель: #2 $from_nickname ($from_email)
Тема: Simple 2
Сообщение: Simple letter 2
Дата: 2015-09-10 23:44:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 3
Сообщение: Simple letter 3
Дата: 2015-09-10 23:49:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 4
Сообщение: Simple letter 3
Дата: 2015-09-10 23:50:11

<hr>hello<hr>

Добро пожаловать в Adeptx Driver, x-positive!

<hr>select mail<hr>

Последние непрочитанные сообщения (LIMIT 50):

Отправитель: #2 $from_nickname ($from_email)
Тема: Simple 2
Сообщение: Simple letter 2
Дата: 2015-09-10 23:44:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 3
Сообщение: Simple letter 3
Дата: 2015-09-10 23:49:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 4
Сообщение: Simple letter 3
Дата: 2015-09-10 23:50:11

<hr>hello<hr>

Добро пожаловать в Adeptx Driver, x-positive!

<hr>select mail<hr>

Последние непрочитанные сообщения (LIMIT 50):

Отправитель: #2 $from_nickname ($from_email)
Тема: Simple 2
Сообщение: Simple letter 2
Дата: 2015-09-10 23:44:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 3
Сообщение: Simple letter 3
Дата: 2015-09-10 23:49:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 4
Сообщение: Simple letter 3
Дата: 2015-09-10 23:50:11

<hr>hello<hr>

Добро пожаловать в Adeptx Driver, x-positive!

<hr>select mail<hr>

Последние непрочитанные сообщения (LIMIT 50):

Отправитель: #2 $from_nickname ($from_email)
Тема: Simple 2
Сообщение: Simple letter 2
Дата: 2015-09-10 23:44:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 3
Сообщение: Simple letter 3
Дата: 2015-09-10 23:49:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 4
Сообщение: Simple letter 3
Дата: 2015-09-10 23:50:11

<hr>hello<hr>

Добро пожаловать в Adeptx Driver, x-positive!

<hr>select mail<hr>

Последние непрочитанные сообщения (LIMIT 50):

Отправитель: #2 $from_nickname ($from_email)
Тема: Simple 2
Сообщение: Simple letter 2
Дата: 2015-09-10 23:44:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 3
Сообщение: Simple letter 3
Дата: 2015-09-10 23:49:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 4
Сообщение: Simple letter 3
Дата: 2015-09-10 23:50:11

<hr>hello<hr>

Добро пожаловать в Adeptx Driver, x-positive!

<hr>select mail<hr>

Последние непрочитанные сообщения (LIMIT 50):

Отправитель: #2 $from_nickname ($from_email)
Тема: Simple 2
Сообщение: Simple letter 2
Дата: 2015-09-10 23:44:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 3
Сообщение: Simple letter 3
Дата: 2015-09-10 23:49:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 4
Сообщение: Simple letter 3
Дата: 2015-09-10 23:50:11

<hr>hello<hr>

Добро пожаловать в Adeptx Driver, x-positive!

<hr>select mail<hr>

Последние непрочитанные сообщения (LIMIT 50):

Отправитель: #2 $from_nickname ($from_email)
Тема: Simple 2
Сообщение: Simple letter 2
Дата: 2015-09-10 23:44:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 3
Сообщение: Simple letter 3
Дата: 2015-09-10 23:49:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 4
Сообщение: Simple letter 3
Дата: 2015-09-10 23:50:11

<hr>hello<hr>

Добро пожаловать в Adeptx Driver, x-positive!

<hr>select mail<hr>

Последние непрочитанные сообщения (LIMIT 50):

Отправитель: #2 $from_nickname ($from_email)
Тема: Simple 2
Сообщение: Simple letter 2
Дата: 2015-09-10 23:44:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 3
Сообщение: Simple letter 3
Дата: 2015-09-10 23:49:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 4
Сообщение: Simple letter 3
Дата: 2015-09-10 23:50:11

<hr>hello<hr>

Добро пожаловать в Adeptx Driver, x-positive!

<hr>select mail<hr>

Последние непрочитанные сообщения (LIMIT 50):

Отправитель: #2 $from_nickname ($from_email)
Тема: Simple 2
Сообщение: Simple letter 2
Дата: 2015-09-10 23:44:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 3
Сообщение: Simple letter 3
Дата: 2015-09-10 23:49:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 4
Сообщение: Simple letter 3
Дата: 2015-09-10 23:50:11

<hr>hello<hr>

Добро пожаловать в Adeptx Driver, x-positive!

<hr>select mail<hr>

Последние непрочитанные сообщения (LIMIT 50):

Отправитель: #2 $from_nickname ($from_email)
Тема: Simple 2
Сообщение: Simple letter 2
Дата: 2015-09-10 23:44:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 3
Сообщение: Simple letter 3
Дата: 2015-09-10 23:49:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 4
Сообщение: Simple letter 3
Дата: 2015-09-10 23:50:11

<hr>add table \adeptx_phrase<hr>

Таблица `adeptx_phrase` успешно <strong style="color:green">создана</strong> в текущей базе данных
<hr>add table \adeptx_phrase<hr>

Таблица `adeptx_phrase` успешно <strong style="color:green">создана</strong> в текущей базе данных
<hr>hello<hr>

Добро пожаловать в Adeptx Driver, x-positive!

<hr>select mail<hr>

Последние непрочитанные сообщения (LIMIT 50):

Отправитель: #2 $from_nickname ($from_email)
Тема: Simple 2
Сообщение: Simple letter 2
Дата: 2015-09-10 23:44:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 3
Сообщение: Simple letter 3
Дата: 2015-09-10 23:49:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 4
Сообщение: Simple letter 3
Дата: 2015-09-10 23:50:11

<hr>hello<hr>

Добро пожаловать в Adeptx Driver, x-positive!

<hr>select mail<hr>

Последние непрочитанные сообщения (LIMIT 50):

Отправитель: #2 $from_nickname ($from_email)
Тема: Simple 2
Сообщение: Simple letter 2
Дата: 2015-09-10 23:44:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 3
Сообщение: Simple letter 3
Дата: 2015-09-10 23:49:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 4
Сообщение: Simple letter 3
Дата: 2015-09-10 23:50:11

<hr>hello<hr>

Добро пожаловать в Adeptx Driver, x-positive!

<hr>select mail<hr>

Последние непрочитанные сообщения (LIMIT 50):

Отправитель: #2 $from_nickname ($from_email)
Тема: Simple 2
Сообщение: Simple letter 2
Дата: 2015-09-10 23:44:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 3
Сообщение: Simple letter 3
Дата: 2015-09-10 23:49:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 4
Сообщение: Simple letter 3
Дата: 2015-09-10 23:50:11

<hr>hello<hr>

Добро пожаловать в Adeptx Driver, x-positive!

<hr>select mail<hr>

Последние непрочитанные сообщения (LIMIT 50):

Отправитель: #2 $from_nickname ($from_email)
Тема: Simple 2
Сообщение: Simple letter 2
Дата: 2015-09-10 23:44:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 3
Сообщение: Simple letter 3
Дата: 2015-09-10 23:49:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 4
Сообщение: Simple letter 3
Дата: 2015-09-10 23:50:11

<hr>hello<hr>

Добро пожаловать в Adeptx Driver, x-positive!

<hr>select mail<hr>

Последние непрочитанные сообщения (LIMIT 50):

Отправитель: #2 $from_nickname ($from_email)
Тема: Simple 2
Сообщение: Simple letter 2
Дата: 2015-09-10 23:44:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 3
Сообщение: Simple letter 3
Дата: 2015-09-10 23:49:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 4
Сообщение: Simple letter 3
Дата: 2015-09-10 23:50:11

<hr>hello<hr>

Добро пожаловать в Adeptx Driver, x-positive!

<hr>select mail<hr>

Последние непрочитанные сообщения (LIMIT 50):

Отправитель: #2 $from_nickname ($from_email)
Тема: Simple 2
Сообщение: Simple letter 2
Дата: 2015-09-10 23:44:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 3
Сообщение: Simple letter 3
Дата: 2015-09-10 23:49:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 4
Сообщение: Simple letter 3
Дата: 2015-09-10 23:50:11

<hr>hello<hr>

Добро пожаловать в Adeptx Driver, x-positive!

<hr>select mail<hr>

Последние непрочитанные сообщения (LIMIT 50):

Отправитель: #2 $from_nickname ($from_email)
Тема: Simple 2
Сообщение: Simple letter 2
Дата: 2015-09-10 23:44:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 3
Сообщение: Simple letter 3
Дата: 2015-09-10 23:49:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 4
Сообщение: Simple letter 3
Дата: 2015-09-10 23:50:11

<hr>hello<hr>

Добро пожаловать в Adeptx Driver, x-positive!

<hr>select mail<hr>

Последние непрочитанные сообщения (LIMIT 50):

Отправитель: #2 $from_nickname ($from_email)
Тема: Simple 2
Сообщение: Simple letter 2
Дата: 2015-09-10 23:44:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 3
Сообщение: Simple letter 3
Дата: 2015-09-10 23:49:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 4
Сообщение: Simple letter 3
Дата: 2015-09-10 23:50:11

<hr>hello<hr>

Добро пожаловать в Adeptx Driver, x-positive!

<hr>select mail<hr>

Последние непрочитанные сообщения (LIMIT 50):

Отправитель: #2 $from_nickname ($from_email)
Тема: Simple 2
Сообщение: Simple letter 2
Дата: 2015-09-10 23:44:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 3
Сообщение: Simple letter 3
Дата: 2015-09-10 23:49:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 4
Сообщение: Simple letter 3
Дата: 2015-09-10 23:50:11

<hr>hello<hr>

Добро пожаловать в Adeptx Driver, x-positive!

<hr>select mail<hr>

Последние непрочитанные сообщения (LIMIT 50):

Отправитель: #2 $from_nickname ($from_email)
Тема: Simple 2
Сообщение: Simple letter 2
Дата: 2015-09-10 23:44:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 3
Сообщение: Simple letter 3
Дата: 2015-09-10 23:49:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 4
Сообщение: Simple letter 3
Дата: 2015-09-10 23:50:11

<hr>hello<hr>

Добро пожаловать в Adeptx Driver, x-positive!

<hr>select mail<hr>

Последние непрочитанные сообщения (LIMIT 50):

Отправитель: #2 $from_nickname ($from_email)
Тема: Simple 2
Сообщение: Simple letter 2
Дата: 2015-09-10 23:44:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 3
Сообщение: Simple letter 3
Дата: 2015-09-10 23:49:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 4
Сообщение: Simple letter 3
Дата: 2015-09-10 23:50:11

<hr>hello<hr>

Добро пожаловать в Adeptx Driver, x-positive!

<hr>select mail<hr>

Последние непрочитанные сообщения (LIMIT 50):

Отправитель: #2 $from_nickname ($from_email)
Тема: Simple 2
Сообщение: Simple letter 2
Дата: 2015-09-10 23:44:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 3
Сообщение: Simple letter 3
Дата: 2015-09-10 23:49:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 4
Сообщение: Simple letter 3
Дата: 2015-09-10 23:50:11

<hr>hello<hr>

Добро пожаловать в Adeptx Driver, x-positive!

<hr>select mail<hr>

Последние непрочитанные сообщения (LIMIT 50):

Отправитель: #2 $from_nickname ($from_email)
Тема: Simple 2
Сообщение: Simple letter 2
Дата: 2015-09-10 23:44:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 3
Сообщение: Simple letter 3
Дата: 2015-09-10 23:49:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 4
Сообщение: Simple letter 3
Дата: 2015-09-10 23:50:11

<hr>hello<hr>

Добро пожаловать в Adeptx Driver, x-positive!

<hr>select mail<hr>

Последние непрочитанные сообщения (LIMIT 50):

Отправитель: #2 $from_nickname ($from_email)
Тема: Simple 2
Сообщение: Simple letter 2
Дата: 2015-09-10 23:44:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 3
Сообщение: Simple letter 3
Дата: 2015-09-10 23:49:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 4
Сообщение: Simple letter 3
Дата: 2015-09-10 23:50:11

<hr>hello<hr>

Добро пожаловать в Adeptx Driver, x-positive!

<hr>select mail<hr>

Последние непрочитанные сообщения (LIMIT 50):

Отправитель: #2 $from_nickname ($from_email)
Тема: Simple 2
Сообщение: Simple letter 2
Дата: 2015-09-10 23:44:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 3
Сообщение: Simple letter 3
Дата: 2015-09-10 23:49:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 4
Сообщение: Simple letter 3
Дата: 2015-09-10 23:50:11

<hr>hello<hr>

Добро пожаловать в Adeptx Driver, x-positive!

<hr>select mail<hr>

Последние непрочитанные сообщения (LIMIT 50):

Отправитель: #2 $from_nickname ($from_email)
Тема: Simple 2
Сообщение: Simple letter 2
Дата: 2015-09-10 23:44:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 3
Сообщение: Simple letter 3
Дата: 2015-09-10 23:49:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 4
Сообщение: Simple letter 3
Дата: 2015-09-10 23:50:11

<hr>hello<hr>

Добро пожаловать в Adeptx Driver, x-positive!

<hr>select mail<hr>

Последние непрочитанные сообщения (LIMIT 50):

Отправитель: #2 $from_nickname ($from_email)
Тема: Simple 2
Сообщение: Simple letter 2
Дата: 2015-09-10 23:44:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 3
Сообщение: Simple letter 3
Дата: 2015-09-10 23:49:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 4
Сообщение: Simple letter 3
Дата: 2015-09-10 23:50:11

<hr>hello<hr>

Добро пожаловать в Adeptx Driver, x-positive!

<hr>select mail<hr>

Последние непрочитанные сообщения (LIMIT 50):

Отправитель: #2 $from_nickname ($from_email)
Тема: Simple 2
Сообщение: Simple letter 2
Дата: 2015-09-10 23:44:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 3
Сообщение: Simple letter 3
Дата: 2015-09-10 23:49:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 4
Сообщение: Simple letter 3
Дата: 2015-09-10 23:50:11

<hr>hello<hr>

Добро пожаловать в Adeptx Driver, x-positive!

<hr>select mail<hr>

Последние непрочитанные сообщения (LIMIT 50):

Отправитель: #2 $from_nickname ($from_email)
Тема: Simple 2
Сообщение: Simple letter 2
Дата: 2015-09-10 23:44:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 3
Сообщение: Simple letter 3
Дата: 2015-09-10 23:49:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 4
Сообщение: Simple letter 3
Дата: 2015-09-10 23:50:11

<hr>php eval 1;<hr>


<hr>php 1;<hr>


<hr>eval echo 1;<hr>


<hr>eval return 1;<hr>


<hr>eval "return 1;"<hr>


<hr>eval return 1;<hr>

1
<hr>eval return "some_text";<hr>

some_text
<hr>eval return `coming`;<hr>


<hr>ls<hr>

Содержимое текущей директории:

./README.md
./ajax/
./class/
./cmd/
./conf/
./css/
./db/
./extra/
./font/
./handler/
./html/
./img/
./index-2.php
./index.php
./index.php~
./js/
./lang/
./log/
./repo/
./robots.txt
./rout/
./setup/
./sftp-config.json
./sql/
./temp/
./theme/
./user/

<hr>eval return `ls`;<hr>


<hr>id<hr>

1
<hr>id<hr>

1
<hr>eval return `id`<hr>

1
<hr>whoami<hr>

x-positive
<hr>eval return `whoami`<hr>

0
<hr>whoami<hr>

x-positive
<hr>whoami<hr>

x-positive
<hr>eval return `whoami`<hr>

x-positive
<hr>whoami<hr>

x-positive
<hr>eval return "id";<hr>

id
<hr>get my id<hr>

1
<hr>eval return "id";<hr>

id
<hr>eval return "id";<hr>

id
<hr>get my `eval return "id";`<hr>

1
<hr>Array<hr>


<hr>Array<hr>


<hr>Array<hr>


<hr>eval return "id";<hr>

id
<hr>eval return "id";<hr>

id
<hr>get my `eval return "id";`<hr>

1
<hr>eval return "i" . "d";<hr>

id
<hr>get my `eval return "i" . "d";`<hr>

1
<hr>whoami<hr>

x-positive
<hr>who am i<hr>

1		x-positive		admin
<hr>phpinfo<hr>


<hr>phpinfo<hr>


<hr>phpinfo<hr>


<hr>phpinfo<hr>

1
<hr>ip-to-country<hr>

1
<hr>exec ls<hr>


<hr>exec ls<hr>


<hr>cd user/1<hr>

Текущий каталог изменён на <strong style="color:lightgreen">/home/x-positive/srv/adeptx</strong>, узнать текущий каталог: <strong><em>pwd</em></strong>
<hr>ls<hr>

Содержимое текущей директории:

./README.md
./ajax/
./class/
./cmd/
./conf/
./css/
./db/
./extra/
./font/
./handler/
./html/
./img/
./index-2.php
./index.php
./index.php~
./js/
./lang/
./log/
./repo/
./robots.txt
./rout/
./setup/
./sftp-config.json
./sql/
./temp/
./theme/
./user/

<hr>cd cmd<hr>

Текущий каталог изменён на <strong style="color:lightgreen">/home/x-positive/srv/adeptx</strong>, узнать текущий каталог: <strong><em>pwd</em></strong>
<hr>cd user/1/cmd<hr>

Текущий каталог изменён на <strong style="color:lightgreen">/home/x-positive/srv/adeptx</strong>, узнать текущий каталог: <strong><em>pwd</em></strong>
<hr>cd cmd<hr>

Текущий каталог изменён на <strong style="color:lightgreen">/home/x-positive/srv/adeptx/cmd</strong>, узнать текущий каталог: <strong><em>pwd</em></strong>
<hr>cd<hr>

Текущий каталог изменён на <strong style="color:lightgreen">/home/x-positive/srv/adeptx</strong>, узнать текущий каталог: <strong><em>pwd</em></strong>
<hr>cd user/1/cmd<hr>

Текущий каталог изменён на <strong style="color:lightgreen">/home/x-positive/srv/adeptx/user/1/cmd</strong>, узнать текущий каталог: <strong><em>pwd</em></strong>
<hr>ls<hr>

Содержимое текущей директории:

./check.php
./email-7.php
./eval-s.php
./help-s.php
./ii.php
./shell.php

<hr>get latest version<hr>

0.732
<hr>hello<hr>

Добро пожаловать в Adeptx Driver, x-positive!

<hr>select mail<hr>

Последние непрочитанные сообщения (LIMIT 50):

Отправитель: #2 $from_nickname ($from_email)
Тема: Simple 2
Сообщение: Simple letter 2
Дата: 2015-09-10 23:44:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 3
Сообщение: Simple letter 3
Дата: 2015-09-10 23:49:11

Отправитель: #0 $from_nickname ($from_email)
Тема: Simple 4
Сообщение: Simple letter 3
Дата: 2015-09-10 23:50:11

<hr>get latest version<hr>

0.732
<hr>get latest versio<hr>


<hr>get latest version<hr>

0.732
<hr>get current version<hr>

0.732
<hr>var a 123<hr>

123
<hr>get var a<hr>

123
<hr>get var b<hr>


<hr>get var b<hr>


<hr>get var b<hr>

NULL
<hr>get var b<hr>

NULL
<hr>var a 0<hr>

0
<hr>get var b<hr>

NULL
<hr>get var a<hr>

0
<hr>var a false<hr>

false
<hr>get var a<hr>

false
<hr>var a<hr>


<hr>get var a<hr>

NULL
<hr>var a <hr>


<hr>get var a<hr>

NULL
<hr>get var a<hr>

\0
<hr>var a 1234<hr>

1234
<hr>get var a<hr>

1234
<hr>var a 14<hr>

14
<hr>var b 2<hr>

2
<hr>get var a/b<hr>

\0
<hr>get current version<hr>

0.732
<hr>get latest version<hr>

0.732
<hr>var current_version `get current version`; var latest_version `get latest version`; if current_version != latest_version -then "whoami; get my id; ls;" -else "who am i; ls; get my nickname;"<hr>

0.732
<hr>get current version<hr>

0.732
<hr>get latest version<hr>

0.732
<hr>var current_version `get current version`; var latest_version `get latest version`; if current_version != latest_version -then "whoami; get my id; ls;" -else "who am i; ls; get my nickname;"<hr>

0.732
<hr>get current version<hr>

0.732
<hr>get latest version<hr>

0.732
<hr>var current_version `get current version`;   var latest_version `get latest version`; if current_version != latest_version -then "whoami; get my id; ls;" -else "who am i; ls; get my nickname;"<hr>

0.732
<hr>get current version<hr>

0.732
<hr>get latest version<hr>

0.732
<hr>var current_version `get current version`  ;   var latest_version `get latest version`; if current_version != latest_version -then "whoami; get my id; ls;" -else "who am i; ls; get my nickname;"<hr>

0.732
<hr>get current version<hr>

0.732
<hr>get latest version<hr>

0.732
<hr>get current version<hr>

0.732
<hr>get latest version<hr>

0.732
<hr>   var current_version `get current version`  ;   var latest_version `get latest version`; if current_version != latest_version -then "whoami; get my id; ls;" -else "who am i; ls; get my nickname;"<hr>

0.732
<hr>whoami; get my id; ls;<hr>

x-positive
<hr>whoami; get my id; ls;<hr>

x-positive1
<hr>whoami; get my id; ls;<hr>

x-positive1Содержимое текущей директории:

./check.php
./email-7.php
./eval-s.php
./help-s.php
./ii.php
./shell.php

<hr>get current version<hr>

0.732
<hr>get latest version<hr>

0.732
<hr>var current_version `get current version`; var latest_version `get latest version`; if current_version != latest_version -then "whoami; get my id; ls;" -else "who am i; ls; get my nickname;"<hr>

0.732
<hr>var current_version `get current version`; var latest_version `get latest version`; if current_version != latest_version -then "whoami; get my id; ls;" -else "who am i; ls; get my nickname;"<hr>

0.7320.732
<hr>get current version<hr>

0.732
<hr>get latest version<hr>

0.732
<hr>var current_version `get current version`; var latest_version `get latest version`; if current_version != latest_version -then "whoami; get my id; ls;" -else "who am i; ls; get my nickname;"<hr>

0.732
<hr>var current_version `get current version`; var latest_version `get latest version`; if current_version != latest_version -then "whoami; get my id; ls;" -else "who am i; ls; get my nickname;"<hr>

0.7320.732
<hr>var current_version `get current version`; var latest_version `get latest version`; if current_version != latest_version -then "whoami; get my id; ls;" -else "who am i; ls; get my nickname;"<hr>

get current version
<hr>var current_version `get current version`; var latest_version `get latest version`; if current_version != latest_version -then "whoami; get my id; ls;" -else "who am i; ls; get my nickname;"<hr>

get current versionget latest version
<hr>get current version<hr>

0.732
<hr>get latest version<hr>

0.732
<hr>var current_version `get current version`; var latest_version `get latest version`; if current_version != latest_version -then "whoami; get my id; ls;" -else "who am i; ls; get my nickname;"<hr>

0.732
<hr>var current_version `get current version`; var latest_version `get latest version`; if current_version != latest_version -then "whoami; get my id; ls;" -else "who am i; ls; get my nickname;"<hr>

0.7320.732
<hr>get current version<hr>

0.732
<hr>get latest version<hr>

0.732
<hr>var current_version `get current version`; var latest_version `get latest version`; if current_version != latest_version -then "whoami; get my id; ls;" -else "who am i; ls; get my nickname;"<hr>

0.732
<hr>var current_version `get current version`; var latest_version `get latest version`; if current_version != latest_version -then "whoami; get my id; ls;" -else "who am i; ls; get my nickname;"<hr>

0.7320.732
<hr>get current version<hr>

0.732
<hr>get latest version<hr>

0.732
<hr>var current_version `get current version`; var latest_version `get latest version`; if current_version != latest_version -then "whoami; get my id; ls;" -else "who am i; ls; get my nickname;"<hr>

0.732
<hr>var current_version `get current version`; var latest_version `get latest version`; if current_version != latest_version -then "whoami; get my id; ls;" -else "who am i; ls; get my nickname;"<hr>

0.7320.732
<hr>get current version<hr>

0.732
<hr>get latest version<hr>

0.732
<hr>var current_version `get current version`; var latest_version `get latest version`; if current_version != latest_version -then "whoami; get my id; ls;" -else "who am i; ls; get my nickname;"<hr>

0.732
<hr>var current_version `get current version`; var latest_version `get latest version`; if current_version != latest_version -then "whoami; get my id; ls;" -else "who am i; ls; get my nickname;"<hr>

0.7320.732
<hr>get current version<hr>

0.732
<hr>get latest version<hr>

0.732
<hr>var current_version `get current version`; var latest_version `get latest version`; if current_version != latest_version -then "whoami; get my id; ls;" -else "who am i; ls; get my nickname;"<hr>

0.732
<hr>var current_version `get current version`; var latest_version `get latest version`; if current_version != latest_version -then "whoami; get my id; ls;" -else "who am i; ls; get my nickname;"<hr>

0.7320.732
<hr>get current version<hr>

0.732
<hr>get latest version<hr>

0.732
<hr>var current_version `get current version`; var latest_version `get latest version`; if current_version != latest_version -then "whoami; get my id; ls;" -else "who am i; ls; get my nickname;"<hr>

0.732
<hr>var current_version `get current version`; var latest_version `get latest version`; if current_version != latest_version -then "whoami; get my id; ls;" -else "who am i; ls; get my nickname;"<hr>

0.7320.732
<hr>get current version<hr>

0.732
<hr>get latest version<hr>

0.732
<hr>var current_version `get current version`; var latest_version `get latest version`; if current_version != latest_version -then "whoami; get my id; ls;" -else "who am i; ls; get my nickname;"<hr>

0.732
<hr>var current_version `get current version`; var latest_version `get latest version`; if current_version != latest_version -then "whoami; get my id; ls;" -else "who am i; ls; get my nickname;"<hr>

0.7320.732
<hr>get current version<hr>

0.732
<hr>get latest version<hr>

0.732
<hr>var current_version `get current version`; var latest_version `get latest version`; if current_version != latest_version -then "whoami; get my id; ls;" -else "who am i; ls; get my nickname;"<hr>

0.732
<hr>var current_version `get current version`; var latest_version `get latest version`; if current_version != latest_version -then "whoami; get my id; ls;" -else "who am i; ls; get my nickname;"<hr>

0.7320.732
<hr>var current_version `get current version`; var latest_version `get latest version`; if current_version != latest_version -then "whoami; get my id; ls;" -else "who am i; ls; get my nickname;"<hr>

0.7320.732
<hr>get current version<hr>

0.732
<hr>get latest version<hr>

0.732
<hr>if `get current version` != `get latest version` -then "whoami; get my id; ls;" -else "who am i; ls; get my nickname;"<hr>


<hr>get current version<hr>

0.732
<hr>get latest version<hr>

0.732
<hr>whoami; get my id; ls;<hr>

x-positive
<hr>whoami; get my id; ls;<hr>

x-positive1
<hr>whoami; get my id; ls;<hr>

x-positive1Содержимое текущей директории:

./check.php
./email-7.php
./eval-s.php
./help-s.php
./ii.php
./shell.php

<hr>if `get current version` != `get latest version` -then "whoami; get my id; ls;" -else "who am i; ls; get my nickname;"<hr>

x-positive1Содержимое текущей директории:

./check.php
./email-7.php
./eval-s.php
./help-s.php
./ii.php
./shell.php

<hr>get latest version<hr>

0.732
<hr>whoami; get my id; ls;<hr>

x-positive
<hr>whoami; get my id; ls;<hr>

x-positive1
<hr>whoami; get my id; ls;<hr>

x-positive1Содержимое текущей директории:

./check.php
./email-7.php
./eval-s.php
./help-s.php
./ii.php
./shell.php

<hr>if 0 != `get latest version` -then "whoami; get my id; ls;" -else "who am i; ls; get my nickname;"<hr>

x-positive1Содержимое текущей директории:

./check.php
./email-7.php
./eval-s.php
./help-s.php
./ii.php
./shell.php

<hr>get latest version<hr>

0.732
<hr>if "" != `get latest version` -then "whoami; get my id; ls;" -else "who am i; ls; get my nickname;"<hr>

RU: Комманда "" не существует или её файл (/home/x-positive/srv/adeptx//home/x-positive/srv/adeptx/cmd/.php) переименован, перемещён, недоступен, скрыт настройками приватности или повреждён. Воспользуйтесь командой help чтобы узнать список доступных команд.
EN: Command "" not useful for this site/profile, command-package not install, rename or moved. Use command "help" for access commands list.
<hr>exec <hr>


<hr>linux<hr>

ls: cannot access file_not_exist: No such file or directory

<hr>linux<hr>


<hr>linux<hr>

total 40
-rwxrwxrwx 1 x-positive x-positive  520 Sep 19 22:30 shell.php
-rwxrwxrwx 1 x-positive x-positive 1883 Sep 19 22:30 help-s.php
-rwxrwxrwx 1 x-positive x-positive 2495 Sep 19 22:30 eval-s.php
-rwxrwxrwx 1 x-positive x-positive 9927 Sep 19 22:30 email-7.php
-rwxrwxrwx 1 x-positive x-positive 2392 Sep 19 22:30 check.php
-rwxrwxrwx 1 x-positive x-positive   19 Sep 28 02:47 ii.php
drwxrwxrwx 2 x-positive x-positive 4096 Oct  2 09:28 .
drwxrwxrwx 4 x-positive x-positive 4096 Oct  2 09:32 ..

<hr>pwd<hr>

Текущим какталогом сейчас является /home/x-positive/srv/adeptx/user/1/cmd
<hr>cd ../../../<hr>

Текущий каталог изменён на <strong style="color:lightgreen">/home/x-positive/srv/adeptx</strong>, узнать текущий каталог: <strong><em>pwd</em></strong>
<hr>linux<hr>

total 164
drwxrwxrwx  2 x-positive x-positive  4096 Sep 19 22:30 rout
-rwxrwxrwx  1 x-positive x-positive    22 Sep 19 22:30 robots.txt
drwxrwxrwx  4 x-positive x-positive  4096 Sep 19 22:30 lang
-rwxrwxrwx  1 x-positive x-positive  8723 Sep 19 22:30 index.php~
-rwxrwxrwx  1 x-positive x-positive 11251 Sep 19 22:30 index-2.php
drwxrwxrwx 31 x-positive x-positive  4096 Sep 19 22:30 img
drwxrwxrwx 45 x-positive x-positive  4096 Sep 19 22:30 html
drwxrwxrwx  2 x-positive x-positive  4096 Sep 19 22:30 handler
drwxrwxrwx  3 x-positive x-positive  4096 Sep 19 22:30 extra
drwxrwxrwx  2 x-positive x-positive  4096 Sep 19 22:30 db
drwxrwxrwx  5 x-positive x-positive  4096 Sep 19 22:30 conf
drwxrwxrwx  2 x-positive x-positive  4096 Sep 19 22:30 class
drwxrwxrwx  2 x-positive x-positive  4096 Sep 19 22:30 ajax
-rwxrwxrwx  1 x-positive x-positive    78 Sep 19 22:30 README.md
-rwxrwxrwx  1 x-positive x-positive    68 Sep 19 22:30 .flooignore
-rwxrwxrwx  1 x-positive x-positive    59 Sep 19 22:30 .floo
drwxrwxrwx  3 x-positive x-positive  4096 Sep 27 05:01 theme
drwxrwxrwx 20 x-positive x-positive  4096 Sep 27 05:34 css
drwxrwxrwx  2 x-positive x-positive  4096 Sep 28 05:05 log
drwxrwxrwx 23 x-positive x-positive  4096 Sep 28 22:34 font
-rwxrwxrwx  1 x-positive x-positive 17761 Oct  1 02:04 index.php
-rwxrwxrwx  1 x-positive x-positive  1351 Oct  2 08:40 sftp-config.json
drwxrwxrwx 15 x-positive x-positive  4096 Oct  2 09:07 js
drwxrwxrwx 10 x-positive x-positive  4096 Oct  2 09:23 user
-rwxrwxrwx  1 x-positive x-positive  3640 Oct  2 09:36 .htaccess
drwxr-xr-x  2 x-positive x-positive  4096 Oct  3 16:51 sql
drwxrwxrwx 14 x-positive x-positive  4096 Oct  4 00:33 ..
drwxr-xr-x  8 root       root        4096 Oct  4 08:24 .git
drwxrwxrwx  5 x-positive x-positive  4096 Oct  4 19:54 repo
drwxrwxrwx 24 x-positive x-positive  4096 Oct  4 21:02 .
drwxrwxrwx  3 x-positive x-positive  4096 Oct  4 21:03 temp
drwxrwxrwx  5 x-positive x-positive  4096 Oct  4 23:46 setup
drwxrwxrwx  3 x-positive x-positive  4096 Oct  5 02:35 cmd

<hr>linux ls<hr>

README.md
ajax
class
cmd
conf
css
db
extra
font
handler
html
img
index-2.php
index.php
index.php~
js
lang
log
repo
robots.txt
rout
setup
sftp-config.json
sql
temp
theme
user

<hr>linux -lart<hr>


<hr>linux ls -lart<hr>

total 164
drwxrwxrwx  2 x-positive x-positive  4096 Sep 19 22:30 rout
-rwxrwxrwx  1 x-positive x-positive    22 Sep 19 22:30 robots.txt
drwxrwxrwx  4 x-positive x-positive  4096 Sep 19 22:30 lang
-rwxrwxrwx  1 x-positive x-positive  8723 Sep 19 22:30 index.php~
-rwxrwxrwx  1 x-positive x-positive 11251 Sep 19 22:30 index-2.php
drwxrwxrwx 31 x-positive x-positive  4096 Sep 19 22:30 img
drwxrwxrwx 45 x-positive x-positive  4096 Sep 19 22:30 html
drwxrwxrwx  2 x-positive x-positive  4096 Sep 19 22:30 handler
drwxrwxrwx  3 x-positive x-positive  4096 Sep 19 22:30 extra
drwxrwxrwx  2 x-positive x-positive  4096 Sep 19 22:30 db
drwxrwxrwx  5 x-positive x-positive  4096 Sep 19 22:30 conf
drwxrwxrwx  2 x-positive x-positive  4096 Sep 19 22:30 class
drwxrwxrwx  2 x-positive x-positive  4096 Sep 19 22:30 ajax
-rwxrwxrwx  1 x-positive x-positive    78 Sep 19 22:30 README.md
-rwxrwxrwx  1 x-positive x-positive    68 Sep 19 22:30 .flooignore
-rwxrwxrwx  1 x-positive x-positive    59 Sep 19 22:30 .floo
drwxrwxrwx  3 x-positive x-positive  4096 Sep 27 05:01 theme
drwxrwxrwx 20 x-positive x-positive  4096 Sep 27 05:34 css
drwxrwxrwx  2 x-positive x-positive  4096 Sep 28 05:05 log
drwxrwxrwx 23 x-positive x-positive  4096 Sep 28 22:34 font
-rwxrwxrwx  1 x-positive x-positive 17761 Oct  1 02:04 index.php
-rwxrwxrwx  1 x-positive x-positive  1351 Oct  2 08:40 sftp-config.json
drwxrwxrwx 15 x-positive x-positive  4096 Oct  2 09:07 js
drwxrwxrwx 10 x-positive x-positive  4096 Oct  2 09:23 user
-rwxrwxrwx  1 x-positive x-positive  3640 Oct  2 09:36 .htaccess
drwxr-xr-x  2 x-positive x-positive  4096 Oct  3 16:51 sql
drwxrwxrwx 14 x-positive x-positive  4096 Oct  4 00:33 ..
drwxr-xr-x  8 root       root        4096 Oct  4 08:24 .git
drwxrwxrwx  5 x-positive x-positive  4096 Oct  4 19:54 repo
drwxrwxrwx 24 x-positive x-positive  4096 Oct  4 21:02 .
drwxrwxrwx  3 x-positive x-positive  4096 Oct  4 21:03 temp
drwxrwxrwx  5 x-positive x-positive  4096 Oct  4 23:46 setup
drwxrwxrwx  3 x-positive x-positive  4096 Oct  5 02:35 cmd

<hr>linux ls -lat<hr>

total 164
drwxrwxrwx  3 x-positive x-positive  4096 Oct  5 02:35 cmd
drwxrwxrwx  5 x-positive x-positive  4096 Oct  4 23:46 setup
drwxrwxrwx  3 x-positive x-positive  4096 Oct  4 21:03 temp
drwxrwxrwx 24 x-positive x-positive  4096 Oct  4 21:02 .
drwxrwxrwx  5 x-positive x-positive  4096 Oct  4 19:54 repo
drwxr-xr-x  8 root       root        4096 Oct  4 08:24 .git
drwxrwxrwx 14 x-positive x-positive  4096 Oct  4 00:33 ..
drwxr-xr-x  2 x-positive x-positive  4096 Oct  3 16:51 sql
-rwxrwxrwx  1 x-positive x-positive  3640 Oct  2 09:36 .htaccess
drwxrwxrwx 10 x-positive x-positive  4096 Oct  2 09:23 user
drwxrwxrwx 15 x-positive x-positive  4096 Oct  2 09:07 js
-rwxrwxrwx  1 x-positive x-positive  1351 Oct  2 08:40 sftp-config.json
-rwxrwxrwx  1 x-positive x-positive 17761 Oct  1 02:04 index.php
drwxrwxrwx 23 x-positive x-positive  4096 Sep 28 22:34 font
drwxrwxrwx  2 x-positive x-positive  4096 Sep 28 05:05 log
drwxrwxrwx 20 x-positive x-positive  4096 Sep 27 05:34 css
drwxrwxrwx  3 x-positive x-positive  4096 Sep 27 05:01 theme
-rwxrwxrwx  1 x-positive x-positive    59 Sep 19 22:30 .floo
-rwxrwxrwx  1 x-positive x-positive    68 Sep 19 22:30 .flooignore
-rwxrwxrwx  1 x-positive x-positive    78 Sep 19 22:30 README.md
drwxrwxrwx  2 x-positive x-positive  4096 Sep 19 22:30 ajax
drwxrwxrwx  2 x-positive x-positive  4096 Sep 19 22:30 class
drwxrwxrwx  5 x-positive x-positive  4096 Sep 19 22:30 conf
drwxrwxrwx  2 x-positive x-positive  4096 Sep 19 22:30 db
drwxrwxrwx  3 x-positive x-positive  4096 Sep 19 22:30 extra
drwxrwxrwx  2 x-positive x-positive  4096 Sep 19 22:30 handler
drwxrwxrwx 45 x-positive x-positive  4096 Sep 19 22:30 html
drwxrwxrwx 31 x-positive x-positive  4096 Sep 19 22:30 img
-rwxrwxrwx  1 x-positive x-positive 11251 Sep 19 22:30 index-2.php
-rwxrwxrwx  1 x-positive x-positive  8723 Sep 19 22:30 index.php~
drwxrwxrwx  4 x-positive x-positive  4096 Sep 19 22:30 lang
-rwxrwxrwx  1 x-positive x-positive    22 Sep 19 22:30 robots.txt
drwxrwxrwx  2 x-positive x-positive  4096 Sep 19 22:30 rout

<hr>linux ls -la<hr>

total 164
drwxrwxrwx 24 x-positive x-positive  4096 Oct  4 21:02 .
drwxrwxrwx 14 x-positive x-positive  4096 Oct  4 00:33 ..
-rwxrwxrwx  1 x-positive x-positive    59 Sep 19 22:30 .floo
-rwxrwxrwx  1 x-positive x-positive    68 Sep 19 22:30 .flooignore
drwxr-xr-x  8 root       root        4096 Oct  4 08:24 .git
-rwxrwxrwx  1 x-positive x-positive  3640 Oct  2 09:36 .htaccess
-rwxrwxrwx  1 x-positive x-positive    78 Sep 19 22:30 README.md
drwxrwxrwx  2 x-positive x-positive  4096 Sep 19 22:30 ajax
drwxrwxrwx  2 x-positive x-positive  4096 Sep 19 22:30 class
drwxrwxrwx  3 x-positive x-positive  4096 Oct  5 02:35 cmd
drwxrwxrwx  5 x-positive x-positive  4096 Sep 19 22:30 conf
drwxrwxrwx 20 x-positive x-positive  4096 Sep 27 05:34 css
drwxrwxrwx  2 x-positive x-positive  4096 Sep 19 22:30 db
drwxrwxrwx  3 x-positive x-positive  4096 Sep 19 22:30 extra
drwxrwxrwx 23 x-positive x-positive  4096 Sep 28 22:34 font
drwxrwxrwx  2 x-positive x-positive  4096 Sep 19 22:30 handler
drwxrwxrwx 45 x-positive x-positive  4096 Sep 19 22:30 html
drwxrwxrwx 31 x-positive x-positive  4096 Sep 19 22:30 img
-rwxrwxrwx  1 x-positive x-positive 11251 Sep 19 22:30 index-2.php
-rwxrwxrwx  1 x-positive x-positive 17761 Oct  1 02:04 index.php
-rwxrwxrwx  1 x-positive x-positive  8723 Sep 19 22:30 index.php~
drwxrwxrwx 15 x-positive x-positive  4096 Oct  2 09:07 js
drwxrwxrwx  4 x-positive x-positive  4096 Sep 19 22:30 lang
drwxrwxrwx  2 x-positive x-positive  4096 Sep 28 05:05 log
drwxrwxrwx  5 x-positive x-positive  4096 Oct  4 19:54 repo
-rwxrwxrwx  1 x-positive x-positive    22 Sep 19 22:30 robots.txt
drwxrwxrwx  2 x-positive x-positive  4096 Sep 19 22:30 rout
drwxrwxrwx  5 x-positive x-positive  4096 Oct  4 23:46 setup
-rwxrwxrwx  1 x-positive x-positive  1351 Oct  2 08:40 sftp-config.json
drwxr-xr-x  2 x-positive x-positive  4096 Oct  3 16:51 sql
drwxrwxrwx  3 x-positive x-positive  4096 Oct  4 21:03 temp
drwxrwxrwx  3 x-positive x-positive  4096 Sep 27 05:01 theme
drwxrwxrwx 10 x-positive x-positive  4096 Oct  2 09:23 user

<hr>linux ls -lt<hr>

total 140
drwxrwxrwx  3 x-positive x-positive  4096 Oct  5 02:35 cmd
drwxrwxrwx  5 x-positive x-positive  4096 Oct  4 23:46 setup
drwxrwxrwx  3 x-positive x-positive  4096 Oct  4 21:03 temp
drwxrwxrwx  5 x-positive x-positive  4096 Oct  4 19:54 repo
drwxr-xr-x  2 x-positive x-positive  4096 Oct  3 16:51 sql
drwxrwxrwx 10 x-positive x-positive  4096 Oct  2 09:23 user
drwxrwxrwx 15 x-positive x-positive  4096 Oct  2 09:07 js
-rwxrwxrwx  1 x-positive x-positive  1351 Oct  2 08:40 sftp-config.json
-rwxrwxrwx  1 x-positive x-positive 17761 Oct  1 02:04 index.php
drwxrwxrwx 23 x-positive x-positive  4096 Sep 28 22:34 font
drwxrwxrwx  2 x-positive x-positive  4096 Sep 28 05:05 log
drwxrwxrwx 20 x-positive x-positive  4096 Sep 27 05:34 css
drwxrwxrwx  3 x-positive x-positive  4096 Sep 27 05:01 theme
-rwxrwxrwx  1 x-positive x-positive    78 Sep 19 22:30 README.md
drwxrwxrwx  2 x-positive x-positive  4096 Sep 19 22:30 ajax
drwxrwxrwx  2 x-positive x-positive  4096 Sep 19 22:30 class
drwxrwxrwx  5 x-positive x-positive  4096 Sep 19 22:30 conf
drwxrwxrwx  2 x-positive x-positive  4096 Sep 19 22:30 db
drwxrwxrwx  3 x-positive x-positive  4096 Sep 19 22:30 extra
drwxrwxrwx  2 x-positive x-positive  4096 Sep 19 22:30 handler
drwxrwxrwx 45 x-positive x-positive  4096 Sep 19 22:30 html
drwxrwxrwx 31 x-positive x-positive  4096 Sep 19 22:30 img
-rwxrwxrwx  1 x-positive x-positive 11251 Sep 19 22:30 index-2.php
-rwxrwxrwx  1 x-positive x-positive  8723 Sep 19 22:30 index.php~
drwxrwxrwx  4 x-positive x-positive  4096 Sep 19 22:30 lang
-rwxrwxrwx  1 x-positive x-positive    22 Sep 19 22:30 robots.txt
drwxrwxrwx  2 x-positive x-positive  4096 Sep 19 22:30 rout

<hr>linux ls -at<hr>

cmd
setup
temp
.
repo
.git
..
sql
.htaccess
user
js
sftp-config.json
index.php
font
log
css
theme
.floo
.flooignore
README.md
ajax
class
conf
db
extra
handler
html
img
index-2.php
index.php~
lang
robots.txt
rout

<hr>linux ls -art<hr>

rout
robots.txt
lang
index.php~
index-2.php
img
html
handler
extra
db
conf
class
ajax
README.md
.flooignore
.floo
theme
css
log
font
index.php
sftp-config.json
js
user
.htaccess
sql
..
.git
repo
.
temp
setup
cmd

<hr>linux ls -at<hr>

cmd
setup
temp
.
repo
.git
..
sql
.htaccess
user
js
sftp-config.json
index.php
font
log
css
theme
.floo
.flooignore
README.md
ajax
class
conf
db
extra
handler
html
img
index-2.php
index.php~
lang
robots.txt
rout

<hr>linux ls<hr>

README.md
ajax
class
cmd
conf
css
db
extra
font
handler
html
img
index-2.php
index.php
index.php~
js
lang
log
repo
robots.txt
rout
setup
sftp-config.json
sql
temp
theme
user

<hr>linux git<hr>

usage: git [--version] [--help] [-C <path>] [-c name=value]
           [--exec-path[=<path>]] [--html-path] [--man-path] [--info-path]
           [-p|--paginate|--no-pager] [--no-replace-objects] [--bare]
           [--git-dir=<path>] [--work-tree=<path>] [--namespace=<name>]
           <command> [<args>]

The most commonly used git commands are:
   add        Add file contents to the index
   bisect     Find by binary search the change that introduced a bug
   branch     List, create, or delete branches
   checkout   Checkout a branch or paths to the working tree
   clone      Clone a repository into a new directory
   commit     Record changes to the repository
   diff       Show changes between commits, commit and working tree, etc
   fetch      Download objects and refs from another repository
   grep       Print lines matching a pattern
   init       Create an empty Git repository or reinitialize an existing one
   log        Show commit logs
   merge      Join two or more development histories together
   mv         Move or rename a file, a directory, or a symlink
   pull       Fetch from and integrate with another repository or a local branch
   push       Update remote refs along with associated objects
   rebase     Forward-port local commits to the updated upstream head
   reset      Reset current HEAD to the specified state
   rm         Remove files from the working tree and from the index
   show       Show various types of objects
   status     Show the working tree status
   tag        Create, list, delete or verify a tag object signed with GPG

'git help -a' and 'git help -g' lists available subcommands and some
concept guides. See 'git help <command>' or 'git help <concept>'
to read about a specific subcommand or concept.

<hr>linux git add .<hr>


<hr>linux git commit -m "Add `linux ...` command, `open ...` command, db phrase etc" -a<hr>


<hr>linux git push<hr>


<hr>linux git push origin master<hr>


<hr>help<hr>

Добро пожаловать в Adeptx Driver!

	Этот туториал призван помочь вам сориентироваться на самом начальном этапе. Ниже приведён список самых основных команд, с кратким описанием предназначения скрипта. Чтобы унать информацию о конкретной команде есть команда `about $command_name` (где $command_name = имя скрипта, например `about aliases`).

	Команды можно использовать как прямо в этой оболочке, так и вызывать в своих скриптах или программах через встроенную команду run($command_with_arguments_string) или подлключив исполняемый файл команды в свои проекты через include_once/require_once (once - потому что в этом файле объявляется функция, повторное обьявление приведет к ошибке), после подключения в любое удобное время вызвав функцию с соответствующим названием.

	Многие команды имеют синонимы для того, чтобы упростить запоминание и уменьшить количество ошибок при вводе. Однако рекомендуется всё же использовать оригинальное имя команды при вызове, это поможет избежать некоторых возможных недочетов.

	Для начала работы, первое что можно сделать - зарегистрироваться. Для этого выполните `reg $email $password`. После регистрации вы будете автоматически авторизованы. В дальнейшем вам необходимо будет авторизовываться самостоятельно используя команду `auth $login $password`, когда это необходимо (при открытии сайта на новом устройстве, истечения срока дейтсвия сессий и т.п.; $login это ваш $email или $nickname указанные при регистрации или позже) для того чтобы вытянуть из базы данных информацию о сессии и всё что связано с персонализацией системы и получить больше возможностей для выполнения команд. Всё, что необходимо запомнить о сессии и вашем профиле будет записываться в базу данных по возможности или вы можете обращаться к базе данных вручную.

	Каждый пользователь получает в распоряжение свою собственную базу данных `adeptx_user$USERID_customdb` (для доступа к ней вам не придётся указывать всё это, вы можете обращаться к ней через ~ или вообще не упоминая, по умолчанию всегда подразумевается, что вы обращаетесь в этой базе данных, если из контекста не следует иное) с персональными таблицами и полный доступ к своей базе данных. Кроме того, предоставленный доступ к публичным базам данных позволяет обращаться к расшаренным таблицам и другим пользователям (по установленным правилам: только для чтения или чтение и запись...).
	Также дела обстоят и с файлами, каждый пользователь получает в распоряжение свою папку и так далее. Кроме того в вашем распоряжении общий репозиторий файлов и скриптов, вы можете добавлять в него свои удачные скрипты, выкладывая их в общий доступ, помогая другим своими разработками. Также для выполнения доступны многие команды linux-терминала, только выполнение всех этих функций ограничено только вашим рабочим каталогом выделенной вам базой данных, за исключением комманд обращения к общедоступным директориям и базам, в частности репозиторию. Пытаясь достучаться до каталогов более высокого уровня через ../ вы получите ошибку безопасности. Разумеется, при таком наборе функциональности, ни о какой безопасности не может идти и речи, хоть мы и стараемся максимально свести на нет возможные уязвимости. Так что обход этих ограничений тем или иным методом всё равно доступен, но помните, что подобное поведение вредит другим пользователям, поэтому за проделки вы будете забанены с удалением всех ваших данных.
	Вот поэтому не забывайте делать бекапы своих данных и сохранять их в безопасном от уязвимостей месте, повышать разными средствами безопасность данных и делясь своими наработками в области безопасности данных со всеми.

	После того, как вы авторизуетесь, вызовите это окно снова, чтобы увидеть перечень доступных вам команд, поскольку сейчас вы видите только список команд, доступных для всех посетителей, авторизованные пользователи имеют более широкий функционал.

	Отдельно хочу отметить специфическую реализацию в системе функционала синонимов вызываемых команд, а кое-какие из них даже имеют синтаксический сахар. Попробуйте посмотреть на синонимы разных команд (`aliases $cmd`, например `aliases help`) и вы сами всё поймёте. Например, цитату дня, которая используется в качестве эпиграфа, можно получить такими способами: `epigraph`, `quote`, `цитата` или даже `"цитата дня"`. Если вы создадите или возьмете из репозитория исполняемый файл с названием, которое уже имеется в списке псевдонимов, то псевдоним будет проигнорирован, будет выполнена команда имеющая исполняемый файл со своим именем. Так что ни один псевдоним не может перезаписать название реальной функции и подменить оригинал, help всегда останется help-ом. Для того, чтобы изменить функционал по умолчанию для существующей команды нужно будет ковырять файлы программы.

	<em><b>Будьте бдительны, если передаваемый аргумент должен содержать пробел, заключите его в одинарные или двойные кавычки; косые кавычки используются для выполнения команды, которая в них заключена и возвращения результата её выполнения качестве передаваемого аргумента в другую команду. Если в выражение, заключенное в одинарные кавычки нужно добавить выражение в двойных кавычках, их не требуется экранировать, обратное также верно. Однако если вам понадобится указать двойные кавычки в выражении заключенном в двойные кавычки, их нужно экранировать обратным слешем вот так: \", при этом слеш не добавится к строке. если же вам необходимо использовать слеш в конце строки, вам необходимо экранировать сам слеш вот так: \\", тогда у вас стрка закончится на слеш. если у вас строка вида "C:\\", вам достаточно указать два слеша, обратные слеши не нужно экранировать до тех пор, пока их не будет нечетное количество в конце строки, но даже при этом экранировать нужно будет только последний слеш. то есть любое количество обратных слешей будет просто добавлено как есть, кроме последнего нечетного, он будет сьеден и к строке добавится кавычка, если вы не проэкранируете его. Кроме того у eval и shell несколько специфическая интерпретация введённых команд, кавычки могут чудесным образом вырезаться там, где это не должно происходить. Довести все эти моменты до ума находится в первоочередных задачах, когда это произойдёт данное уведомление исчезнет.</b></em>

	Приятной работы!

Перечень доступных клавиатурных сочетаний и горячих клавиш в этом окне:

<style>.help_table td {padding: 5px 10px;} .help_table tr:nth-child(2n) {background-color:rgba(255,255,255,0.05);} .help_table, .help_table * { box-sizing: border-box; } .help_table { max-width: 51em;
	    box-sizing: border-box;
	    font-size: 13px; }</style><table class="help_table"><tbody valign="top"><tr style="color:green"><td><b>Сочетание&nbsp;клавиш</b></td><td><b>Действие</b></td></tr><tr><td>Esc</td><td>Очистить экран и строку ввода команд</td></tr><tr><td>Ctrl + Enter</td><td>Показать/скрыть окно ввода команд в котором вы сейчас находитесь</td></tr><tr><td>Enter</td><td>Отправить команду на сервер для выполнения (POST)</td></tr><tr><td>Ctrl + H</td><td>Показать это руководство</td></tr></tbody></table>
Перечень всех доступных скриптов (в квадратных скобках указываются необязательные параметры):

<table class="help_table"><tbody valign="top"><tr style="color:green"><td><b>Имя&nbsp;скрипта</b></td><td><b>Параметры</b></td><td><b>Краткое&nbsp;описание</b></td></tr><tr><td>about</td><td>[$command]</td><td>Посмотреть справку по конкретному скрипту (на самом деле это псевдоним команды help)</td></tr><tr><td>add</td><td>$arg1 $arg2 $arg3 [$arg4] [$arg5] [$arg6]</td><td>Просто приведу примеры использования команды: `add hotkey "Ctrl + V" paste`, `add hotkey Ctrl+L ls`, `add alias pro about`, `add user test@test.com qwerty123`. Данная команда первая и пока единственная оснащена синтаксическим сахаром (можно ввести `add new alias "my_alias_name" for command help` или `add user alex with password qwerty321` и несколько ещё вариантов в том же духе)</td></tr><tr><td>aliases</td><td>$command</td><td>Посмотреть все возможные синонимы (алиасы) команды</td></tr><tr><td>auth</td><td>$email $pass</td><td>Авторизация в системе. Эта команда относится к командам со вводом пароля. Такие команды проводятся в два этапа: 1. Ввод команды со всеми параметрами и отправка на исполнение (Enter). 2. Ввод и отправка пароля (пароль при вводе отображаться не будет)</td></tr><tr><td>cal</td><td>[$year]</td><td>RU: Выводит календарь на $year год (по умолчанию на текущий год). EN: show calendar on YYYY year</td></tr><tr><td>cat</td><td>$file</td><td>RU: Вывести содержимое файла. Синтаксис: cat $file. EN: print $file content</td></tr><tr><td>cd</td><td>[$dir]</td><td>RU: Устанавливает $dir текущей директорией. Если $dir не указана делает текущим корневой каталог (каталог, в который установлен движок). Синтаксис: cd [$dir]. Посмотреть текущий каталог можно командой pwd. EN: go to home dir or change dir to [..|../..|-|/dir|dir/dir|~user]</td></tr><tr><td>chmod</td><td>$file $mode.</td><td>Осуществляет попытку изменения режима доступа файла $file на режим $mode. Синтаксис: chmod $file $mode.</td></tr><tr><td>copy</td><td>$file $copyname</td><td>RU: Создаёт копию файла $file с именем $copyname. Не забывайте, что второй параметр содержит не только путь, куда сохранить копию файла, но и содержит новое имя создаваемой копии! Синтаксис: copy $file $copyname. EN: copy file $from to file $to</td></tr><tr><td>create_backup</td><td></td><td>RU: Создает в папке  архив с дампом базы и файлами всего сайта (полный бекап), после создания архив отправляет на скачивание.</td></tr><tr><td>date</td><td>[$format]</td><td>RU: Выводит текущую дату, время и часовой пояс (селектором, позволяющим его изменить) в заданном формате. Синтаксис: date [$format]. EN: Show current date and time or set the $format of date</td></tr><tr><td>dump</td><td></td><td>Создание дампа текущей базы данных. Дамп создаётся в текущем каталоге. Просмотр содержимого последнего созданного дампа: `get last dump`. Создание дампа с просмотром содержимого в консоли: `get new dump`</td></tr><tr><td>epigraph</td><td>[$id]</td><td>Выводит случайную цитату или цитату с номером $id (для использования в качестве эпиграфа, но впринципе не только)</td></tr><tr><td>eval</td><td>$code</td><td>Временное решение нехватки функционала путём дыры в уязвимости - все недостающие команды можно выполнить через eval. Но при каждом применении не забывайте создать скрипт, который решает ту же задачу и тогда нехватка функционала быстро ликвидируется и можно будет не прибегать к прямому выполнени кода, достаточно будет использовать внутренне API. Подсказака: можно использовать eval также в качестве калькулятора, достаточно начать ввод с eval echo и можно писать любую математическую операцию на PHP, например: eval echo pow(398/4, 2);</td></tr><tr><td>exit</td><td></td><td>Обратный авторизации процесс, переход в режим стороннего наблюдателя (ghost-статус. Всего на сайте сейчас три статуса: ghost, staff, admin. Неавторизованные пользователи имеют статус ghost, авторизованные staff или admin, разница между которыми лишь в том, что admin может выполнять действия с профилями участников staff</td></tr><tr><td>get</td><td>$obj $info</td><td>RU: Выводит запрошенную информацию $info об объекте $obj. Синтаксис: get $obj $info. Примеры: get my nickname, get my status, get my email, get my id, get new dump, get last dump</td></tr><tr><td>group</td><td></td><td>Выполняет операции над пользовательскими группами</td></tr><tr><td>help</td><td>[$command]</td><td>Вызов этой справки</td></tr><tr><td>history</td><td></td><td>RU: Выводит историю всех введённых команд всеми пользователями. Позже будут добавлены параметры и проверки, чтобы выводить для указанного/текущего пользователя. Из списка удаляются дубли команд, пустые строки, некорректные команды записываются в отдельный лог и не выводятся здесь. Все команды сортируются и выводится первое вхождение команды, если требуется посмотреть историю без изменений, вводите cat </td></tr><tr><td>killallprocesses</td><td></td><td>RU: Собственно, название говорит само за себя: принудительно завершает все процессы.</td></tr><tr><td>lang</td><td></td><td>Указать предпочтительный язык</td></tr><tr><td>ls</td><td>[$dir]</td><td>RU: Выводит список файлов и папок в директории $dir (если не указано, то содержимое текущей директории). Синтаксис: ls [$dir] EN: Show content of current dir with some $regular expression or options</td></tr><tr><td>message</td><td>$user $subject $message</td><td>RU: Отправляет письмо пользователю $user с темой $subject. Синтаксис: message $user $subject $message. Отправленное письмо может быть прочитано любым ридером из репозитория. EN: send message to $user</td></tr><tr><td>names</td><td></td><td>Выводит список мужских и женских русских имён</td></tr><tr><td>permission</td><td>$user_id $key $value</td><td>Устанавливает параметр доступа $key в значение $value для пользователя с ID $user_id</td></tr><tr><td>pwd</td><td></td><td>RU: Выводит текущий каталог. EN: present working directory.</td></tr><tr><td>reg</td><td>$email $pass [$nickname]</td><td>Регистрация нового пользователя, некорректная запись email воспринимается как nickname, при этом символ @ вырезается, если он был включен. Эта команда относится к командам со вводом пароля, см. `about auth`</td></tr><tr><td>rename</td><td>$oldname $newname</td><td>RU: Пытается переименовать файл или директорию $oldname в $newname, переместив в конечную директорию, если необходимо. Если $newname существует, то он будет перезаписан. Синтаксис: rename $oldname $newname. EN: rename $oldname to $newname</td></tr><tr><td>select</td><td>mail</td><td>RU: Команда для получения данных из БД. На данный момент полный функционал не реализован, стоит плашка select mail для выборки LIMIT 50 последних непрочитанных писем.</td></tr><tr><td>source</td><td>$command</td><td>Выводит исходный код исполняемого файла программы</td></tr><tr><td>tail</td><td>$n $file</td><td>RU: Выводит $n последних строк файла $file. Синтаксис: tail $n $file. show $n last lines of $file.</td></tr><tr><td>tree</td><td>[$dir]</td><td>RU: Выводит дерево файлов и каталогов в директории $dir. Синтаксис: tree [$dir]. EN: show files tree from /</td></tr><tr><td>unreg</td><td>$email $pass [$nickname]</td><td>Удалить свою учётную запись пользователя, требуется указать свой пароль также как и при регистрации/авторизации. Польностью удаляет все данные пользователя из системы</td></tr><tr><td>unzip</td><td>$source_archive $destination_path [$file1 $file2 $fileN]</td><td>RU: Распаковывает содержимое архива pwd().$zip_archive.zip в директорию pwd().$destination (по умолчанию текущая директория). Если указаны дополнительные параметры $file1, $file2..$fileN то распакует только перечисленные файлы.</td></tr><tr><td>user</td><td>$user_id $act $param</td><td>Выполняет действие $act с пользователем $user_id. Позволяет выполнить блокировку пользователей, удалять пользователей, менять их профили и т.п.</td></tr><tr><td>zip</td><td>$source_path $destination_path</td><td>RU: Создает в произвольной директории архив из заданного файла или директории, после создания архив отправляет на скачивание. Известный баг: архив создается корректно из файла, но из папки создаётся пустой архив.</td></tr></tbody></table>
<hr>