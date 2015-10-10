$(function(){

	/* DEFAULT GLOBAL VARIABLES VALUE */

	// cmd.js
	$line = 0;
	$command_vs_pass = false;
	$systemMessageDisappearanceTimerID = 0;
	$cache = [];
	$history = [];	// к сожалению, история ввода пока стирается после каждого обновления страницы, надо добавить чтобы она хранилась в сессии... и реверсивный поиск по истории ввода по Ctrl + R тоже надо добавить
	// кроме того в эту историю, в отиличе от официальной, записываются все неправильные команды (что грозит записью пароля в случае ошибки в слове авторизация или использовании её синонимов). Это тоже очень нуждается в том, чтобы быть пофиксиным

	// cloud.js
	window.process = 1;
	window.focus = 1;
	window.previous_focus = 1;

	/* AJAX.js */

/*	// buty scrollbar
	$('.scroll-pane').jScrollPane({
		showArrows: true,
		verticalDragMinHeight: 20,
		verticalDragMaxHeight: 20
	});
	$('body .jspContainer .jspTrack').css('height', $(window).height() - 63 + 'px');
	$('.jspContainer').css('height', $(window).height() - 30 + 'px');
*/
	
	update({date:'.', msg:'.', epigraph:'.', mail:'.'}, 'replace');

	// every second update .time .ss
	var ss = 0;
	setInterval(function(){
		if (!ss) ss = parseInt($('.date .ss').first().text());

		// every minute update time && msg box
		if (ss > 59) {
			ss = 0;
			update({date:'.', msg:'.', mail:'.'}, 'replace');
		} 
		$('.date .ss').first().text((ss < 10)?('0' + ss++):ss++);
	}, 1000);

	systemMessage('ajax.js:x3<br>Подключение к серверу успешно установлено.');

	/* CMD.js */

	clrscr();
	run('hello', 'append');
	$('.scroll-pane').jScrollPane();

	/* CLOUD.js */

});