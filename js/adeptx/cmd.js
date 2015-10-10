function systemMessage($msgText, $appearanceSpeed, $displayTime, $disappearanceSpeed) {
	if (!$appearanceSpeed) $appearanceSpeed = 100;
	if (!$displayTime) $displayTime = 2000;
	if (!$disappearanceSpeed) $disappearanceSpeed = 500;

	if ($systemMessageDisappearanceTimerID) clearTimeout($systemMessageDisappearanceTimerID);
	
	$('.system-message').html($msgText).show($appearanceSpeed);
	$systemMessageDisappearanceTimerID = setTimeout(function(){
		$('.system-message').hide($disappearanceSpeed);
	}, $displayTime);
}

function cmd_toggle() {
	//clrscr();			// можно сделать настройку "очищать окно вывода результатов при закрытии"
	$('#cmd').toggle({
		duration: 300,
		easing: 'easeOutQuart',
		specialEasing: 'height'
		// можно сделать настройку "прокручивать рабочий стол как веб-страницу" и тогда нужно будет скрывать полосу прокрутки при открытии этого окна
		// start: function() {
		// 	if ($('body').css('overflow') == 'hidden') {
		// 		$('body').css({overflow: "auto"});
		// 	} else {
		// 		$('body').css({overflow: "hidden"});
		// 	}
		// }
	});
	$('#cmd-line-input').focus();
}

function append_line($text_line) {
	$('#cmd-answer').append($text_line + "\n").animate({
		scrollTop: $('#cmd-answer').height() + 999999
	}, 300);
}

function run($command_vs_args, $mode) {
	if (!$command_vs_args) {
		$command_vs_args = $('#cmd-line-input').val();
		$mode = 'append';
	}

	// первый шаг к поэтапному считыванию (там тоже аргументы массивом)
	$command_args = $command_vs_args.split(' ');
	$command = $command_args[0];

	// не записываем в историю ввода команды с паролями и команды, которые дублируют предыдущий ввод
	if (!$command_vs_pass && $history[$history.length - 1] != $command_vs_args) {
		$line = $history.length;
		$history[$line++] = $command_vs_args;
	}

	// 1. switch $command_vs_args:
	//			case 'auth':
	// 2. $('#cmd-answer').append('auth(email, pass) - Authorization' + '\n' + $Adeptx.cmd.separator);
	// 3. $('#cmd-answer').append('Input email:' + '\n' + $Adeptx.cmd.separator);
	// 4. [return] var email = $command_vs_args;
	// 5. $('#cmd-answer').append('Input pass:' + '\n' + $Adeptx.cmd.separator);
	// 6. [return] var pass = $command_vs_args;
	// 7. update({cmd:'auth',email:email,pass:pass}, 'append');

	if (!$command_vs_pass) {
		append_line($command_vs_args + $Adeptx.cmd.separator);
	} else {
		append_line('**********' + $Adeptx.cmd.separator);
	}

	if ($command == 'run') {
		new_cloud($command_args[1]);
		cmd_toggle();
	} else if($command == 'exit') {
		$('.user-data').empty();
		$history = [];
		update({cmd: $command_vs_args}, $mode);
	} else if ($command == 'js') {
		console.log('Command Line Output: ' + eval($command_vs_args.substr(3)));
	} else if ($command == 'auth' || $command == 'reg' || $command == 'unreg') {
		// порядок действий при авторизации (и любых операциях, требующих запрос пароля):
		// меняем тип поля ввода команд с text на password
		// ставим флаг, запоминаем команду, логин
		// команду с паролем вместе отправляем на сервак, естественно в обход любых логов
		// профит
		$command_vs_pass = $command_vs_args;	// флаг/запоминаем команду
		$('#cmd-line-input').attr({'type':'password'});
		append_line('Пароль:');
			// systemMessage('ajax.js:x1\nУ вас ' + up["#user-new-messages-count"] + ' непрочитанных сообщений.\n`select mail`', 300, 5000, 1000);

	} else {
		if ($command_vs_pass) {
			$('#cmd-line-input').attr({'type':'text'});
			update({cmd: $command_vs_pass + ' ' + $command_vs_args}, $mode);
			$command_vs_pass = false;
		}
		else {
			// было бы очень кстати кешировать некоторые запросы, о чём инфа может предоставляться самим сервером при получении ответа. например, если сервер указал "cache: true" для запроса "epigraph 60", мы просто записываем полученную команду в js массив и при следующем запросе "epigraph 60" выводим значение из массива. Ну на сервере своё кеширование, на клиенте своё - во избежание повторных обращений к серверу лишний раз.
			if ($cache[$command_vs_args] !== undefined) {
				append_line($cache[$command_vs_args]);
			} else {
				// блокируем поле ввода до получения ответа сервера, для создания дополнительных паралельных запросов, если выполняется процесс с длительным периодом ожидания, можно открыть паралельно несколько окон для ввода команд

				// #$ajax['id']['cmd']['line']
				$('#cmd-line').css({'background-color':'#676767'});
				$('#cmd-line-input').css({'background-color':'#676767'});
				$('#cmd-line-input').prop({'disabled':true});
				update({cmd: $command_vs_args}, $mode);
			}
		}
	}
	$('#cmd-line-input').val('').focus();
	//	$('#cmd-answer').show();
	//	setTimeout(function(){
	//		$('#cmd-answer').hide(1000).text('error');
	//	}, 2000);
}

function clr_line(){
	$('#cmd-line-input').val('').focus();
	line = 1;
}

function clrscr(){
	$('#cmd-answer').html($Adeptx.cmd.separator + '\n\n');
	clr_line();
}