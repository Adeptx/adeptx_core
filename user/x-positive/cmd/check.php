<?
	// other validation examples: http://php.net/manual/ru/filter.examples.validation.php

	$obj = $arg[1];

	swithc ($obj) {
		case 'path':
			# проверить введённый пользователем путь, на предмет доступности пользователю, возможности записи, существования и т.п.
			break;
		case 'phone':
			# проверка валидности телефонного формата с указанием уровня строгости (максимальный - телефон в международном формате без доп. символов)
			# если указан доп. параметр fix то по возможности номер будет пытаться привести в указанный формат, например +7 (965) 775-50-44
			if ( filter_var($obj, FILTER_VALIDATE_REGEXP, [
					'options' => [
						'regexp' => '/^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/'
					]
				] ) ) {
				$return = true;
			} else {
				$return = false;
			}
			break;
		case 'email':
			# проверка валидности email адреса, можно будет задуматься и о проверке существования такого email если SMTP ли что-то подобное позволяет это сделать.
			if ( filter_var($obj, FILTER_VALIDATE_EMAIL) ) {
				$return = true;
			} else {
				$return = false;
			}
			break;
		case 'url':
			if ( filter_var($obj, FILTER_VALIDATE_URL) ) {
				$return = true;
			} else {
				$return = false;
			}
			break;
		case 'ip':
			if ( filter_var($obj, FILTER_VALIDATE_IP) ) {
				$return = true;
			} else {
				$return = false;
			}
			break;
		case 'dir':
		case 'fold':
		case 'folder':
			# то же что и path, но исключительно для папок
			break;
		case 'file':
			# то же что и path, но исключительно для файлов, весь путь до файла поэтому затирается! проверка осуществляется внутри выбраннного каталога
			break;
		case 'user':
			# проверяет есть ли в системе пользователь с такими данными (id, nickname, email или другие указанные)
			break;
	}

	return $return;