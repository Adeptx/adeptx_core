$.ajaxSetup({
	type: 'post',
	dataType: 'text json'
});

// по возможности полностью заменить на ajaxSetup
function update(data, options){
	$.ajax({
		data: data,
		success: function (up) {
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
		},
		error: function (er) {
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