<?
	# ! В этом файле проверяется $_POST и если есть инфа и она корректна, отправляет письмо на указанный почтовый ящик
	if (!empty($_POST)) {
		// run('mail ...');
		// include_once 'html/mail/adeptx_feedback_mail.php';
	}
?>

<script>
	$(document).ready(function() { // вопрос совпадающий с faq мгновенно получает автоматический ответ
		$('.send').click(function() {
			update({mail: $('#mail').serialize()});	// .replace('\n', '<br>')
		});
		//    $('.answer').last().text(' — ' + msg.msg); // last
		// $('.answer:last').before('<article class="answer">' + ' — ' + msg.msg + '</article>');
	});
</script>

<article class="answer">
	 — Напишите нам и вскоре мы ответим.
	Если отет нужен прямо сейчас, попробуйте посмотреть <a href="faq">базу ответов</a>.
</article>

<article class="answer"></article>

<form id="mail" method="post" enctype="multipart/form-data">
	<label>Представтесь:
		<input name="name" size="40" placeholder="Фамилия Имя [Отчество]" value="<?=$_POST['from_name'];?>">
	</label>
	<label><b>Ваш e-mail (для ответа):</b>
		<input name="email" size="40" placeholder="e.g.: e-mail@gmail.com" value="<?=$_POST['from_email'];?>">
	</label>
	<label><b>TEMA:</b>
		<input name="subject" size="40" placeholder="e.g.: заказ сайта" value="<?=$_POST['subject'];?>">
	</label>
	
	<br><b>Текст письма:</b>
		<textarea name="msg" rows="40" cols="60" autofocus placeholder="<?=$_POST['msg'];?>"></textarea>
	
	<label>Если необходимо, прикрепите файлы:
		<input name="attachment[]" type="file" size="40">
	</label>
	
	<label>Текст или HTML?
		<select id="format" name="format">
			<option value="plain" <? if($_POST['format'] == 'plain') echo 'selected';?>>Текст</option>
			<option value="html" <? if($_POST['format'] == 'html') echo 'selected';?>>HTML</option>
		</select>
	</label>
	
	<label>
		<input class="send" type="button" value="Отправить">
	</label>
</form>