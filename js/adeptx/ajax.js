$.ajaxSetup({
	type: 'post',
	dataType: 'text json'
});

/*
	нужно изменить формат ответа сервера, на что-то в таком духе:

	{
		{
			"type": "replace",	// append / prepend / replace
			"cache": {		// или булево значение, или, лучше, указывать что и на сколько кешировать -- результат функции вообще при любых аргументах / только при указанных значениях аргументов / на сколько или до какого периода времени
				"expires": "$date"
				// "time": "$time"
				// "params": "any" // only current
			}
			".user-new-messages-count": "3",
			"text": "Результат выполнения команды"
		},
		{
			"type": "append",	// append / prepend / replace
			"cache": false		// или просто не указываем
			"#cmd-answer": "Результат выполнения команды"
		}
	}
*/

// по возможности полностью заменить на ajaxSetup
function update(data, options){
	$.ajax({
		data: data,
		success: function (up) {
			$('#connection-status').addClass('fa-wifi').removeClass('fa-warning');
			
			// systemMessage(up);
			if (up["#user-new-messages-count"] > $('#user-new-messages-count').html()) {
				run('select mail', 'append');
				// $('#user-new-messages-count').html(  );
				systemMessage('ajax.js:x1\nУ вас ' + up["#user-new-messages-count"] + ' непрочитанных сообщений.\n`select mail`', 300, 5000, 1000);

				// if ($(e.target).is('#user-new-messages-count')) {
				// 	run('select mail', 'replace');
				// }
			}
			// else if (up["#cmd-answer"]) {
			// 	systemMessage('ajax.js:x2<br>Получены данные от сервера (кликните по этому уведомлению, чтобы оно исчезло):<br>' + up["#cmd-answer"], 100, 60000, 2000);
			// }

			// if cmd & cache $cache[$command_vs_args]) = result. . .

			if(!options || options == 'replace'){
				$.each(up, function(key, val){
					$(key).html(val).val(val);
				});
			} else if (options == 'append') {
				$.each(up, function(key, val){
					if ($.type(val) == 'array' || $.type(val) == 'object') {	// Значит мы получили построчное содержимое файла history с переносами внутри (поэтому я их убрал) и поскольку это команды норма, что начинается с символа >
						// в идеале же нужно рассмотреть более универсальный подход
						$.each(val, function(k, v) {
							$(key).append(v);
						});
						$(key).append($Adeptx.cmd.separator);
					} else {
						$(key).append(val + '\n' + $Adeptx.cmd.separator);
					}
					$(key).animate({ scrollTop: $(key).scrollTop() + $(key).height() + 99999999999999999999 }, 300);
				});
			}
			$('#cmd-line').css({'background-color':'#242b33'});
			$('#cmd-line-input').css({'background-color':'#242b33'});
			$('#cmd-line-input').prop({'disabled':false});
		},
		error: function (er) {
			$('#connection-status').addClass('fa-warning').removeClass('fa-wifi');

			systemMessage('ajax.js:error1\nОшибка отправки данных на сервер, подробности в консоли (используйте Ctrl+Enter для открытия консоли).\n' + er);
			console.log(er.responseText);
			append_line(er.responseText);
			
			if(!options){
				$.each(er, function(key, val){
					$(key).html(val).val(val);
				});
			} else if (options == 'append') {
				$.each(er, function(key, val){
					$(key).append(val + '\n' + $Adeptx.cmd.separator);
				});
			}
		}
	});
}