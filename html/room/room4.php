<?
	$grinec['mail'] = 'e.grinec@gmail.com';
?>
<!DOCTYPE html>
<html>
<head>
<title>Grinec Web Studio</title>
<style>
	@font-face {
		font-family: 'Open Sans';
		font-style: normal;
		font-weight: 300;
		src: local('Open Sans Light'), local('OpenSans-Light'), url(http://themes.googleusercontent.com/static/fonts/opensans/v8/DXI1ORHCpsQm3Vp6mXoaTRsxEYwM7FgeyaSgU71cLG0.woff) format('woff');
	}
	@font-face {
		font-family: 'Open Sans';
		font-style: normal;
		font-weight: 400;
		src: local('Open Sans'), local('OpenSans'), url(http://themes.googleusercontent.com/static/fonts/opensans/v8/uYKcPVoh6c5R0NpdEY5A-Q.woff) format('woff');
	}
	@font-face {
		font-family: 'Open Sans';
		font-style: normal;
		font-weight: 700;
		src: local('Open Sans Bold'), local('OpenSans-Bold'), url(http://themes.googleusercontent.com/static/fonts/opensans/v8/k3k702ZOKiLJc3WVjuplzBsxEYwM7FgeyaSgU71cLG0.woff) format('woff');
	}
	@font-face {
		font-family: 'Open Sans';
		font-style: italic;
		font-weight: 300;
		src: local('Open Sans Light Italic'), local('OpenSansLight-Italic'), url(http://themes.googleusercontent.com/static/fonts/opensans/v8/PRmiXeptR36kaC0GEAetxv25ds880Du_gFZbUlZlsbg.woff) format('woff');
	}
	@font-face {
		font-family: 'Open Sans';
		font-style: italic;
		font-weight: 400;
		src: local('Open Sans Italic'), local('OpenSans-Italic'), url(http://themes.googleusercontent.com/static/fonts/opensans/v8/O4NhV7_qs9r9seTo7fnsVD8E0i7KZn-EPnyo3HZu7kw.woff) format('woff');
	}
	@font-face {
		font-family: 'Open Sans';
		font-style: italic;
		font-weight: 700;
		src: local('Open Sans Bold Italic'), local('OpenSans-BoldItalic'), url(http://themes.googleusercontent.com/static/fonts/opensans/v8/PRmiXeptR36kaC0GEAetxpXMLUeV6_io0G3F6eXSVcg.woff) format('woff');
	}
	@font-face {
		font-family: 'Open Sans Light2';
		font-style: normal;
		font-weight: 300;
		src: local('Open Sans Light'), url(font/opensans-light.woff) format('woff');
	}
	@font-face {
		font-family: 'CatullBQ';
		font-style: normal;
		font-weight: 300;
		src: local('CatullBQ'), url(font/CatullBQ-Regular.otf) format('woff');
	}
    body {
        margin: 0 auto;
        font-family: 'Open Sans Light2', 'Open Sans Light', 'Open Sans', sans-serif;
        font-size: 13px;
        padding-bottom: 100px;
    }
    a {
    	color: #0844ff;
    	text-decoration: none;
    	border-bottom: 1px dashed #086ca2;
    }
    a:active, a:visited {
    	color: #086ca2;
    }
    ul {
    	list-style: none;
    }
    li {
    	padding-left: 20px;
    }
    ul li {
    	background: url('img/16x16/ul.png') 0 1px no-repeat;
    }
    textarea {
 		outline: none;
 		resize: none;
    }
    input[type="button"], input[type="submit"] {
    	cursor: pointer;
    }
    
    header {
    	background-color: #878e96;
    	height: 70px;
    	padding-bottom: 20px;
    }
    
    header .logo {
    	background-color: black;
    	width: 35px;
    	height: 35px;
    	line-height: 40px;
    	display: inline-block;
    	text-align: center;
    	font-family: 'CatullBQ';
    }
    
    header .logotype {
    	color: #0f7fe6;
    	border: 0;
    }
    
    header h1 {
    	text-align: center;
    	line-height: 20px;
    	color: #f7f7f7;
    	text-shadow: 1px 1px 0 #000, 2px 2px 3px rgba(0, 0, 0, 0.5);
        font-family: 'CatullBQ', sans-serif;
    }
    
    header p {
    	background-color: #c2c7cc;
    	text-align: right;
    	padding-right: 5px;
    }
    
    article {
    	padding-left: 5px;
    	border-bottom: 1px solid gray;
    }
    
    .creator {
    	background-color: #e7efff;
    }
    
    .admin, .answer {
    	background-color: #e7ffef;
    }
    
    .auto, .moder, .update {
    	color: red;
    }
    
    .update {
    	text-decoration: line-through;
    }
    
    .added {
    	text-decoration: underline;
    }
    
    .infoblock {
    	border-left: 1px dotted black;
    	float: right;
    	padding: 0 5px;
    }
    
    .time {
    	cursor: pointer;
    }
    
    footer {
 		width: 100%;
    	position: fixed;
    	bottom: 0;
    }
    
    footer textarea {
 		width: 100%;
 		height: 50px;
 		border: 0;
    }
</style>

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
