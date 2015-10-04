<?
	$grinec['mail'] = 'e.grinec@gmail.com';
?>
<!DOCTYPE html>
<html>
<head>
<title>Grinec Web Studio</title>
<script src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
<script src="js/getTime.js"></script>
<script>
	$(document).ready(function() { // три клика открывают все даты. три скрытия скрвают все
		$('.infoblock').append(' | <a class="time">time</a>').on('click', '.time', function() {
			if ($(this).hasClass('showed')) {
				$(this).text('time');
				$(this).removeClass('showed');
			}
			else {
				$(this).text('2014.03.10 2:44:33 (+2:00)');
				$(this).addClass('showed');
			}
		});
	});
</script>

</head>

<body>
	<header>
		<p class="date"><?
			ini_set('date.timezone', 'Europe/Kiev');
			$date = date('D d M Y H:i:s');
			$date = str_replace(array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'), array('вс', 'пн', 'вт', 'ср', 'чт', 'пт', 'сб'), $date);
			$date = str_replace(array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'), array('января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря'), $date);
			echo $date;
		?></p>
		<h1><a href="/" class="logotype"><div class="logo">G</div>rinec`s</a> Live «Room 5»</h1>
	</header>
	
	<article id="0" class="creator">
		<div class="infoblock">&lt;x-positive></div>
		Добрый день, <span class="update" title="исправлено автором &lt;x-positive> 2014.03.10 2:44:56 (+2:00)">финики</span><span class="added" title="добавлено автором &lt;x-positive> 2014.03.10 2:44:58 (+2:00)">форумчане</span>! Где можно скачать кошерный ajax мультиаплоадер?
	</article>
	
	<article id="1" class="answer">
		<div class="infoblock">(gcorp)</div>
		Уважаемый, ну <span class="moder" title="исправлено модератором modern_talking 2014.03.10 в 2:44:35 (+2:00)">в</span>ы как заново родились. <a href="goto.php?utl=http://grinec.tk">http://grinec.tk</a>
	</article>
	
	<article id="2" class="creator">
		<div class="infoblock">&lt;x-positive></div>
		Сколько польз<span class="auto" title="исправлено автоматически">у</span>юсь этим форумом, что уже забыл где ви<span class="auto" title="исправлено автоматически">д</span>ел его (*^.^*).
		Спасибо огромнейшее! 
	</article>
	
	<article id="3">
		<div class="infoblock">(gcorp)</div>
		Обращайтесь :)
	</article>
	
	<article id="3">
		<div class="infoblock">(gcorp)</div>
		Обращайтесь :)
	</article>
	
	<article id="3">
		<div class="infoblock">(gcorp)</div>
		Обращайтесь :)
	</article>
	
	<article id="3">
		<div class="infoblock">(gcorp)</div>
		Обращайтесь :)
	</article>
	
	<article id="3">
		<div class="infoblock">(gcorp)</div>
		Обращайтесь :)
	</article>
	
	<article id="3">
		<div class="infoblock">(gcorp)</div>
		Обращайтесь :)
	</article>
	
	<article id="3">
		<div class="infoblock">(gcorp)</div>
		Обращайтесь :)
	</article>
	
	<article id="3">
		<div class="infoblock">(gcorp)</div>
		Обращайтесь :)
	</article>
	
	<article id="3">
		<div class="infoblock">(gcorp)</div>
		Обращайтесь :)
	</article>
	
	<article id="3">
		<div class="infoblock">(gcorp)</div>
		Обращайтесь :)
	</article>
	
	<article id="3">
		<div class="infoblock">(gcorp)</div>
		Обращайтесь :)
	</article>
	
	<article id="3">
		<div class="infoblock">(gcorp)</div>
		Обращайтесь :)
	</article>
	
	<article id="3">
		<div class="infoblock">(gcorp)</div>
		Обращайтесь :)
	</article>
	
	<article id="3">
		<div class="infoblock">(gcorp)</div>
		Обращайтесь :)
	</article>
	
	<article id="3">
		<div class="infoblock">(gcorp)</div>
		Обращайтесь :)
	</article>
	
	<article id="3">
		<div class="infoblock">(gcorp)</div>
		Обращайтесь :)
	</article>
	
	<article id="3">
		<div class="infoblock">(gcorp)</div>
		Обращайтесь :)
	</article>
	
	<article id="3">
		<div class="infoblock">(gcorp)</div>
		Обращайтесь :)
	</article>
	
	<article id="3">
		<div class="infoblock">(gcorp)</div>
		Обращайтесь :)
	</article>
	
	<article id="3">
		<div class="infoblock">(gcorp)</div>
		Обращайтесь :)
	</article>
	
	<article id="3">
		<div class="infoblock">(gcorp)</div>
		Обращайтесь :)
	</article>
	
	<article id="4" class="admin">
		<div class="infoblock">[e.grinec]</div>
		Вопрос решен. Ответ в сообщении <a href="#1">#1</a>
	</article>
	
	<footer>
		<form method="post">
			<input class="send" type="submit" value="Send">
			<textarea autofocus placeholder="your answer"></textarea>
		</form>
	</footer>
</body>
</html>
