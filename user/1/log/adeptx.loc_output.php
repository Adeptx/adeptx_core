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
<hr>