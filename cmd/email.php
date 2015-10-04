<?php 	// there was first line: #!/usr/bin/php
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
   $format = 'plain';                  # "html" или "plain", значение "text" не используется, вместо него - "plain"
   $from_name = 'Evgeny Grinec';       # Имя отправителя
   $from_email = 'e.grinec@gmail.com'; # Мыло отправителя
   $reaplyto = 'e.grinec@gmail.com';   # "отвечайте на адрес"
   $num = 1;                           # Отправить письмо $num раз
   $files = array(				# Имена прикрепляемых файлов => адрес их расположения относительно местонахождения скрипта
# если необходимо прикрепить файлы, убрать решетку перед следующими строками, заменить адрес до файла реальным адресом
#     'dir0/dir1/dir2/file_name1'
#     ,'dir0/dir1/dir2/file_name2'
#     ,'dir0/dir1/dir2/file_name3'
   );					# если письмо не содержит прикрепленных файлов, оставить как есть
   $log = "log.txt"; # адрес к файлу, в который будут записываться логи, если в отчетах об успешности отправки сообщений нет нужды, вместо адреса указать 0 или пустую строку
   $mailfilename = "";       # адрес к файлу, с которого будет браться список адресов для рассылки, каждый адрес с новой строки. 0 или пустая строка чтобы использовать список адресатов из переменной $emaillist (многострочная переменная, каждый адрес с новой строки)
   $emaillist = "e.grinec@gmail.com";

?>
<!doctype html>
<html><head><meta charset="utf-8"></head><body>
<?

	/*************************************************************
	 * Дальше идет непосредственно составление и отправка письма *
	 *************************************************************/
	 
if ($mailfilename) $allemails = file($mailfilename);
else $allemails = split("\n", $emaillist);

if ($log)
{
	print "Work started<br>Logs saves in $log<br>";
	$fp=fopen($log,"a");
	flush();
}

for($i=0; $i < $num; $i++)
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
				$msg = ereg_replace("%5C%22", "%22", $msg);
				$msg = urldecode($msg);
				$msg = stripslashes($msg);
  			}
		 
			$to = ereg_replace(" ", "", $to);
			$message = ereg_replace("&email&", $to, $msg);
			$subject = ereg_replace("&email&", $to, $subject);
			 
			$boundary = md5(uniqid(time()));
	
			$header = "From: $from_name <$from_email>\r\nReply-To: $reaplyto\r\n";
			$header.= "MIME-Version: 1.0\r\n";
			$header.= "Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n";
			$header.= "X-Sender: " . $_SERVER['REMOTE_ADDR'] . "\n";

			$message = "--$boundary\r\nContent-Type: text/$format; charset=\"utf-8\"\r\nContent-Transfer-Encoding: quoted-printable\n\n" . nl2br($msg) . "\n";
			foreach($files as $file)		# See: http://www.php.net/manual/ru/features.file-upload.multiple.php
				if(is_​readable($file)) {
					$dir = explode('/', $file);
					$fname = $dir[count($dir) - 1];
					$str = @chunk_split(base64_encode(@fread(@fopen($file, "r"), filesize($file))));
					$message.="--$boundary\nContent-Type: application/octet-stream; name=\"$fname\"\nContent-disposition: attachment; filename=\"$fname\"\nContent-Transfer-Encoding: base64\n\n$str\n\n";
			}
			$message.="--$boundary--\n";
		 
		 # See: php.net/mail
			if(mail($to, $subject, $message, $header)) {
				if ($log)
				 	 fwrite ($fp, ($x+1)."th mail successfully sended");
				else
				{
					  print "Sending mail to $to. Status: OK";
					  flush();
				}
			} else {
				if ($log)
					 fwrite ($fp, ($x+1)."th mail NOT sended. There was some problem occupated...");
				else
				{
					 print "Sending mail to $to. Status: ERROR. Mail NOT sended!";
					 flush();
				}
			}
		}
	}
?>
</body></html>
<?
 /**********************
  * ФУНКЦИИ ГЕНЕРАТОРА *
  **********************/

function c() {return mt_rand(0,9);}
function s() {
   $word="qwrtpsdfghjklzxcvbnm";
   return $word[mt_rand(0,19)];
}
function g() {
   $word="eyuioa";
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
 return randword()."@".$domain[mt_rand(0,count($domain)-1)];
}
function randsabj()
{
 $c=mt_rand(1,5);
 $sabj="";
 for($a=0;$a<=$c;$a++)
  $sabj .= randword()." ";
 return $sabj;
}
function randmsg()
{
 $c=mt_rand(1,500);
 $msg="";
 for($a=0;$a<=$c;$a++)
  $msg .= randword()." ";
 return $msg;
}
?>
