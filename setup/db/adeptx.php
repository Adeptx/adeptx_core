<?

# значение настроек можно изменить прямо здесь:
# $drop_if_exist = true;

# Это обыкновенный .sql-файл импорта БД, только здесь используются переменные значения (префикс БД и имя БД), потом файл просто исполняется. Перед заливкой БД проверяется на существование, если её не существует она создаётся (класс $db всегда проверяет БД на существование и создаёт в случае отсутствия). Перед запилом каждой таблицы тоже проверяется, существует ли таблица, если да её не создаёт (следите за значением настройки $drop_if_exist). При необходимости можно изменить режим и прежде все таблицы дропать, а тогда уже только писать новые.

echo "Выполнена инсталяция БД.\n";

$report = 'В процессе установки создана база данных ';
if ($drop_if_exist) {
	$report .= "с перезаписью текущей базы, если она есть. Если вы не сделали dump базы ${database['name']}, восстановление невозможно.";
} else {
	$report .= "без перезаписи текущей базы данных. Если база данных ${database['name']} уже существует, в соответствующие таблицы будет добавлена тестовая информация (если она присутствует). Возможно, вы захотите выполнить чистку тестовой информации из базы ${database['name']}, если вы не отключили запись тестовой информации ранее.";
}
$error->report($report, __LINE__, 'Database Information', __FILE__);

$query = "SET FOREIGN_KEY_CHECKS = 0;";
$db->call($query);

# Table structure for table `session`
if ($drop_if_exist) {
	$db->call("DROP TABLE IF EXISTS `${database['prefix']}${database['table']['session']}`;");
}

// $database['name'] = addcslashes($database['name'], '%_');
// $database['prefix'] = addcslashes($database['prefix'], '%_');

$query = "
CREATE TABLE IF NOT EXISTS `${database['prefix']}${database['table']['session']}` (
`id` bigint(255) NOT NULL auto_increment,
`user_id` bigint(255) NOT NULL,
`line_desc` varchar(255) NOT NULL,
`line_value` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1;
";
$db->call($query);

# Table structure for table `user`
if ($drop_if_exist) {
	$db->call("DROP TABLE IF EXISTS `${database['prefix']}${database['table']['user']}`;");
}

$query = "
CREATE TABLE IF NOT EXISTS `${database['prefix']}${database['table']['user']}` (
`id` bigint(255) NOT NULL auto_increment,
`nickname` varchar(255) NOT NULL,
`email` varchar(255) NOT NULL,
`hash` varchar(255) NOT NULL,
`salt` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1;
";
$db->call($query);

# Table structure for table `user_message`
if ($drop_if_exist) {
	$db->call("DROP TABLE IF EXISTS `${database['prefix']}${database['table']['user_message']}`;");
}

$query = "
CREATE TABLE IF NOT EXISTS `${database['prefix']}${database['table']['user_message']}` (
`id` int(15) NOT NULL auto_increment,
`to_uid` int(9) NOT NULL,
`subject` varchar(255) NOT NULL,
`message` text,
`from_uid` int(9) NOT NULL,
`sender_ip` varchar(255),
`date_sent` timestamp DEFAULT '".date('Y-m-d H:i:s')."' NOT NULL,
`was_read` tinyint(1),
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1;
";
$db->call($query);

# Table structure for table `epigraph`
if ($drop_if_exist) {
	$db->call("DROP TABLE IF EXISTS `${database['prefix']}${database['table']['epigraph']}`;");
}

$query = "
CREATE TABLE IF NOT EXISTS `${database['prefix']}${database['table']['epigraph']}` (
`id` int(15) NOT NULL auto_increment,
`epigraph` varchar(255) NOT NULL,
`utter` varchar(255),
`footnote` varchar(255),
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1;
";
$db->call($query);

# Table structure for table `package`
if ($drop_if_exist) {
	$db->call("DROP TABLE IF EXISTS `${database['prefix']}${database['table']['package']}`;");
}

$query = "
CREATE TABLE IF NOT EXISTS `${database['prefix']}${database['table']['package']}` (
`id` int(15) NOT NULL auto_increment,
`name` varchar(255) NOT NULL,
`aliases` varchar(65535) NOT NULL,
`arguments` varchar(65535) NOT NULL,
`summary_key` varchar(255),
`description_key` varchar(255),
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1;
";
$db->call($query);

# Table structure for table `phrase`
if ($drop_if_exist) {
	$db->call("DROP TABLE IF EXISTS `${database['prefix']}${database['table']['phrase']}`;");
}

$query = "
CREATE TABLE IF NOT EXISTS `${database['prefix']}${database['prefix']}${database['table']['phrase']}` (
`id` int(15) NOT NULL auto_increment,
`noconflict` varchar(255) NOT NULL,
`en` varchar(65535) NOT NULL,
`ru` varchar(65535) NOT NULL,
`ua` varchar(65535),
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1;
";
$db->call($query);

#####
#
# Строго говоря, этот этап то при установке и не требуется, это заполнение "тестовыми" данными только для разрабов-админов, вроде меня. При дублировании системы кем-либо ещё этот этап смело можно опускать. И отправлять SQL запрос на выполнение в этом месте.
# if ($_SESSION['status'] != 'admin') $db->call($query);
#
#####

# Dumping data for table `session` 

$query = "INSERT INTO `${database['prefix']}session` (`user_id`, `line_desc`, `line_value`) VALUES ('1','cloud','fm'), ('2','cloud','diff');
";
$db->call($query);

# Dumping data for table `user` 

$query = "
INSERT INTO `${database['prefix']}${database['table']['user']}` (`nickname`, `email`, `hash`, `salt`) VALUES ('x-positive','e.grinec@gmail.com','6ab39c41030d3888846c4ecb11375bb3ad7138f7879ac19f2f9e192f7614cf1523f1b3ac951eea304b09d911d3797f32','5024467d5acfd9d9d3592340ee2800cf'),
 ('gcorp','gcorp.gcorp@gmail.com','0359ac6aa8df54fe9dad42ef88a5134e5d2389e4339cdc91330de5f6bdf24e8f1c2081763a03d00838c1aa16f18db61e','0cc27475046ec987dfc168c0669b6323');
";
$db->call($query);

# Dumping data for table `user_message`
# Здесь я предлагаю при установке системы залить в БД сообщения или только админу 1 или по 1 на каждого созданного пользователя, в качестве приветсвенного сообщения (хотя лучше для этого использовать новостную информационную систему оповещений)

$query = "
INSERT INTO `${database['prefix']}${database['table']['user_message']}` (`to_uid`, `subject`, `message`, `from_uid`, `sender_ip`, `date_sent`, `was_read`) VALUES ('2','Тест 1','Тестовое сообщение 1','1','127.0.0.1','2009-09-09 22:22:22','1'),
 ('2','Тест 2','Тестовое сообщение 2 (непрочитанное сообщение. первое прочитано)','1','127.0.0.1','2015-09-10 22:29:10','0'),
 ('1','Simple 1','Пример прочитанного сообщения','2','127.0.0.1','2015-09-10 22:42:10','1'),
 ('0','Тестовое сообщение','Так будут выглядеть ваши новые непрочитанные сообщения когда вы зарегистрируетесь.<br>Это лишь один из многих мессенджеров, вы можете подключать любой мессенджер, в том числе писать свой собственный. <br>Как следствие темы оформления могут быть любыми, как и настройки считывания сообщений.','2','127.0.0.1','2015-09-10 23:41:11','0'),
 ('1','Simple 2','Simple letter 2','2','127.0.0.1','2015-09-10 23:44:11','0'),
 ('1','Simple 3','Simple letter 3','0','127.0.0.1','2015-09-10 23:49:11','0'),
 ('1','Simple 4','Simple letter 3','0','127.0.0.1','2015-09-10 23:50:11','0');
";
$db->call($query);

# Dumping data for table `epigraph` 

$query = "
INSERT INTO `${database['prefix']}${database['table']['epigraph']}` (`epigraph`, `utter`, `footnote`) VALUES ('Машины должны работать. Люди должны думать.','Лозунг IBM',''),
-- ('На свете феньки есть такие, брат Горацио, которых лохи просто не секут','Шекспир, «Гамлет», вольный перевод','<span class=\"footnote\">есть многое в природе, друг Горацио, что и не снилось нашим мудрецам</span>'),
-- ('<strike>Нар</strike>котики крадут твои лучшие годы','социальная реклама','<span class=\"footnote\">с поправкой на учитывание «изменения сознания»...</span>'),
 ('Почта должна доставляться вовремя.','Из причины запрета на учебник математики в РФ',''),
 ('Вам были даны другие качества.\nВы тот, кто не может сыграть то, чего на самом деле не чувствует.','Мария Герасимова',''),
 ('Вы вызываете у меня искреннюю улыбку...\nВ этом есть романтика нашего времени, Вы не находите?','Мария Герасимова',''),
 ('Smile! Why? Becouse you can.','',''),
 ('Никогда не заставляйте родителей сомневаться в однажды принятом решении.','',''),
 ('Тот, кто лишен чувства юмора, может быть абсолютно свободен и ничего не бояться, так как самое страшное с ним уже произошло.','',''),
 ('Фразы бесподобны, только они вторичны. Мой дорогой человек, я желаю Вам меньше думать о том, как произвести впечатление, Вы — стоящее доказательство всему вышесказанному.','Мария Герасимова',''),
 ('Не принимай подачки, а бьют — давай сдачи.','Мария Малиновская aka Mizz Paper',''),
 ('Никогда не благодарите за искренность.','Мария Герасимова',''),
 ('Вы слишком интересны и идеальны, будто искусственные.','Мария Герасимова',''),
 ('Если не любите рисковать, не начинайте свое дело. Наймитесь к тем людям, которые рисковать готовы.','<a href=\"http://habrahabr.ru/company/yandex/blog/208886/#comment_7198828\">Ксения Елкина</a>',''),
 ('Каждый охотник знать желает, где фазаны обитают.','Не помогло',''),
 ('Мы все притворщики.\nКто-то маски носит лучше, кто-то - хуже.','Мария Герасимова',''),
 ('Дисциплина — это не ограничение свободы.\nЭто отсечение всего лишнего.','Брюс Ли',''),
 ('Оболочка не важна, никогда.','Яна Толмачева',''),
 ('Слова пусты, но суть велика и значительна.','Мария Малиновская',''),
 ('Хочешь популярности — научись удивлять, хочешь познать — умей удивляться.','',''),
 ('Не все парни забывают.','Виталий Омельченко',''),
 ('Успешные люди меняются сами, остальных меняет жизнь.','Джим Рон',''),
 ('никогда свобода суицид','Марти Кан',''),
 ('If all objects and people in daily life were equipped with identifiers,\nthey could be managed and inventoried by computers','Концепция IoT',''),
 ('Раз все объекты и люди в быту оснащены идентификаторами,\nих можно регулировать и инвентаризовать компьютерами.','Концепция «Интернета вещей»',''),
 ('Если не можешь простить, вспомни, сколько прощено тебе.','',''),
 ('Если вы до сих пор не поняли, чем мы занимаемся, значит мы хорошо справляемся.','',''),
 ('Наши любимые игры: Business, Development, Sales & Marketing.','',''),
-- ('О погоде. Бабушка гадала, да надвое сказала: то ли дождь, то ли снег; то ли будет, то ли нет.','',''),
 ('Вся проблема современной системы образования в том, что учителя преимущественно женщины, при том, что парни и девушки учатся вместе.','',''),
 ('Любящий многих — познает женщин.\nЛюбящий одну — познает любовь.','',''),
 ('Когда молчание вдвоем не напрягает, ты понимаешь, что нашел кого-то особенного.','',''),
 ('Богатство — это состояние ума.','',''),
 ('Все так бояться остаться никем в этой жизни, что становятся кем попало.','',''),
 ('Люди действительно готовы продать все, если цена их устроит.','Чак Паланик',''),
 ('Там, где все горбаты, стройность становится уродством.','Оноре де Бальзак',''),
 ('Неважно сколько у вас ресурсов. Если вы не умеете их правильно использовать, их никогда не будет достаточно.','Анна Бурхович',''),
 ('Нельзя приходить и уходить, когда вздумается.\nНельзя просто оставлять человека на улице в дождь, а на следующее утро ждать, что он бросится к тебе на шею.','',''),
 ('Если вы думаете, что сможете — вы сможете,\nесли думаете, что нет — вы правы.','Мао Цзэдун',''),
 ('Если вы думаете, что вы способны на что-то, вы правы, если вы думаете, что у вас не получится что-то, вы тоже правы.','Генри Форд',''),
 ('Пройдёмте в сад?\nЯ покажу Вас розам...','Ричард Шеридан',''),
 ('Да не о том думай, что спросили, а о том, для чего?\nДогадаешься, для чего, тогда и поймешь, как надо ответить.','Максим Горький',''),
 ('Будьте добрее, когда это возможно.\nА это возможно всегда.','',''),
 ('Практикуйте хаотичное добро!','Антон Громов',''),
 ('Будьте добрее, а то как лохи.','Даша Солнцева',''),
 ('Жизнь пролетает моментально,\nА мы живем, как будто пишем черновик,<br>Не понимая в суете скандальной,\nЧто наша жизнь — всего лишь только миг.','',''),
 ('Неуверенность разрушила столько возможностей.','Эрих Мария Ремарк',''),
 ('Вчера я бежал запломбировать зуб\nИ смех меня брал на бегу:\nВсю жизнь я таскаю свой будущий труп\nИ рьяно его берегу.','Губерман',''),
 ('Лучшее что нам доступно, это самопознание.','',''),
 ('Спрашивать: «Кто должен быть боссом?» — всё равно, что спрашивать: «Кто должен быть тенором в этом квартете?». Конечно тот, кто может петь тенором.','Генри Форд',''),
 ('Боссами становятся те, кто может быть боссом.','',''),
 ('Гимнастика — это полная чушь. Здоровым она не нужна, а больным противопоказана.','Генри Форд',''),
 ('Когда я не могу управлять событиями, я представляю им самим управлять собой.','Генри Форд',''),
 ('Думать — самая трудная работа; вот, вероятно, почему этим занимаются, столь не многие.','Генри Форд',''),
 ('Я не знаю какой результат принесёт мне реклама, но даже если я заработаю доллар — я вложу его в рекламу.','Генри Форд',''),
 ('Я никогда не говорю: «Мне нужно, чтоб вы это сделали». Я говорю: «Мне интересно, сумеете ли вы это сделать».','Генри Форд',''),
 ('Когда кажется, что весь мир настроен против тебя, помни, что самолёт взлетает против ветра.','Генри Форд',''),
 ('Nothing is particularly hard if you divide it into small jobs.','Генри Форд',''),
 ('Время не любит, когда его тратят впустую.','Генри Форд',''),
 ('Всё можно сделать лучше, чем делалось до сих пор.','Генри Форд',''),
 ('Если бы я спросил людей, чего они хотят, они бы попросили более быструю лошадь.','Генри Форд',''),
 ('Если у тебя есть энтузиазм, ты можешь совершить всё, что угодно. Энтузиазм — это основа любого прогресса.','Генри Форд',''),
 ('Женщина — это не только вагон удовольствий, но и три, а то и четыре тонны проблем.','Генри Форд',''),
 ('Более одаренные люди ведут общество вперед, облегчая остальным условия жизни.','Генри Форд',''),
 ('Успешные люди вырываются вперёд, используя то время которое остальные используют в пустую.','Генри Форд',''),
 ('Гораздо больше людей сдавшихся, чем побежденных.','Генри Форд',''),
 ('Мой секрет успеха заключается в умении понять точку зрения другого человека и смотреть на вещи и с его и со своей точек зрения.','Генри Форд',''),
 ('Когда часто выходишь за зону комфорта, становится скучно, а спастись от скуки ещё сложнее, чем почувствовать себя свободным','Евгения Матросова',''),
 ('Я сомневаюсь, значит мыслю; я мыслю, значит существую','Рене Декарт',''),
 ('Dubito ergo cogito, cogito ergo sum','René Descartes','');
";
$db->call($query);

# Dumping data for table `phrase`
# Для однозначного соответсвтия нужно также добавить столбцы: UserID, ProjectAlias, ModuleName, TranslateDate, TranslateVersion для поиска соответствий по WHERE и безконфликтного сосуществования разных версий перевода

$query = "
INSERT INTO `${database['prefix']}${database['prefix']}${database['table']['phrase']}` (`noconflict_hash`,`unique_key`,`en`,`ru`,`ua`) VALUES ('adeptx.cmd.exception','403','Access denied','Это действие доступно для исполнения только после авторизации','Цю операцiю можливо здiйснювати лише будучи аутентифiкованим'),
 ('adeptx.cmd.exception','1007','The number of arguments passed is less than the number of mandatory','Количество переданных аргументов меньше количества обязательных','Передано меньше аргументiв нiж найменьш можливо для правильного тлумачення'),
 ('adeptx.cmd.exception','4978','No one dump yet','В папке хранения дампов не обнаружено ни одного дампа базы данных','Жодного дампа не знайдено'),
 ('adeptx.cmd.exception','9846','No user with such login','Указанный логин не зарегистрирован','Юзер з таким логiном не зарегован');
";
$db->call($query);

# Dumping data for table `package`

$query = "
INSERT INTO `${database['prefix']}${database['table']['package']}` (`noconflict_hash`,`unique_key`,`en`,`ru`,`ua`) VALUES ('adeptx.cmd.exception','403','Access denied','Это действие доступно для исполнения только после авторизации','Цю операцiю можливо здiйснювати лише будучи аутентифiкованим'),
 ('adeptx.cmd.exception','1007','The number of arguments passed is less than the number of mandatory','Количество переданных аргументов меньше количества обязательных','Передано меньше аргументiв нiж найменьш можливо для правильного тлумачення'),
 ('adeptx.cmd.exception','4978','No one dump yet','В папке хранения дампов не обнаружено ни одного дампа базы данных','Жодного дампа не знайдено'),
 ('adeptx.cmd.exception','9846','No user with such login','Указанный логин не зарегистрирован','Юзер з таким логiном не зарегован');
";
$db->call($query);


//////////
		$hotkeys['ru'] = [
			 'Esc'					=> 'Очистить экран и строку ввода команд'
			,'Ctrl + Enter'			=> 'Показать/скрыть окно ввода команд в котором вы сейчас находитесь'
			,'Enter'				=> 'Отправить команду на сервер для выполнения (POST)'
			,'Ctrl + H'				=> 'Показать это руководство'
		];
		$hotkeys['en'] = [
			 'Esc'					=> 'Clear screen and input line'
			,'Ctrl + Enter'			=> 'Toggle command window'
			,'Enter'				=> 'Send command to server for processing (post method only)'
			,'Ctrl + H'				=> 'Show this manual'
		];

		$commands['arguments'] = [
			 'help'			=> '[$command]'
			,'auth'			=> '$email $pass'
			,'reg'			=> '$email $pass [$nickname]'
			,'exit'			=> ''
			,'aliases'		=> '$command'
			,'about'		=> '[$command]'
			,'unreg'		=> '$email $pass [$nickname]'
			,'epigraph'		=> '[$id]'
			,'names'		=> ''

			,'add'			=> '$arg1 $arg2 $arg3 [$arg4] [$arg5] [$arg6]'
			,'cat'			=> '$file'
			,'message'		=> '$user $subject $message'
			,'tail'			=> '$n $file'
			,'date'			=> '[$format]'
			,'cal'			=> '[$year]'
			,'get'			=> '$obj $info'
			,'select'		=> 'mail'
			,'cd'			=> '[$dir]'
			,'pwd'			=> ''
			,'ls'			=> '[$dir]'
			,'tree'			=> '[$dir]'
			,'source'		=> '$command'
			,'rename'		=> '$oldname $newname'
			,'copy'			=> '$file $copyname'
			,'eval'			=> '$code'
			,'chmod'		=> '$file $mode.'
			,'zip'			=> '$source_path $destination_path'
			,'unzip'		=> '$source_archive $destination_path [$file1 $file2 $fileN]'
			,'history'		=> ''
			,'create_backup'=> ''
			,'dump'			=> ''
			,'killallprocesses'=> ''

			,'user'			=> '$user_id $act $param'
			,'permission'	=> '$user_id $key $value'
			,'group'		=> ''
		];

		# язык первичен перед уровнем доступа. сначала определяется язык пользователя, затем его статус. (то что в приватбанковском corezoid названо состояниями давно было здесь реализовано и состояние языка определяется первично и в зависимости от языка этого процессы делятся по состояниям уровня доступа и так далее)
		# в зависимости от уровня доступа перечень комманд будет отличаться.

		$commands['summary']['ru']['ghost'] = [
			 'help'		=> 'Вызов этой справки'
			,'auth'		=> 'Авторизация в системе. Эта команда относится к командам со вводом пароля. Такие команды проводятся в два этапа: 1. Ввод команды со всеми параметрами и отправка на исполнение (Enter). 2. Ввод и отправка пароля (пароль при вводе отображаться не будет)'
			,'reg'		=> 'Регистрация нового пользователя, некорректная запись email воспринимается как nickname, при этом символ @ вырезается, если он был включен. Эта команда относится к командам со вводом пароля, см. `about auth`'
			,'unreg'	=> 'Удалить свою учётную запись пользователя, требуется указать свой пароль также как и при регистрации/авторизации. Польностью удаляет все данные пользователя из системы'
			,'exit'		=> 'Обратный авторизации процесс, переход в режим стороннего наблюдателя (ghost-статус. Всего на сайте сейчас три статуса: ghost, staff, admin. Неавторизованные пользователи имеют статус ghost, авторизованные staff или admin, разница между которыми лишь в том, что admin может выполнять действия с профилями участников staff'
			,'aliases'	=> 'Посмотреть все возможные синонимы (алиасы) команды'
			,'about'	=> 'Посмотреть справку по конкретному скрипту (на самом деле это псевдоним команды help)'
			,'lang'		=> 'Указать предпочтительный язык'
			,'epigraph'	=> 'Выводит случайную цитату или цитату с номером $id (для использования в качестве эпиграфа, но впринципе не только)'
			,'names'	=> 'Выводит список мужских и женских русских имён'
		];
		$commands['summary']['en']['ghost'] = [
			 'help'		=> 'This tutorial'
			,'auth'		=> 'User authorization'
			,'reg'		=> 'User registration'
			,'reg'		=> 'User unregistration'
			,'exit'		=> 'Sign out from site, session_destroy()'
			,'aliases'	=> 'Get command aliases'
			,'about'	=> 'Get command manual (alias for help)'
			,'lang'		=> 'Set language'
			,'epigraph'	=> 'Get random/$id-th epigraph'
			,'names'	=> 'Output russian names'
		];

		$commands['summary']['ru']['staff'] = [
			 'add'		=> 'Просто приведу примеры использования команды: `add hotkey "Ctrl + V" paste`, `add hotkey Ctrl+L ls`, `add alias pro about`, `add user test@test.com qwerty123`. Данная команда первая и пока единственная оснащена синтаксическим сахаром (можно ввести `add new alias "my_alias_name" for command help` или `add user alex with password qwerty321` и несколько ещё вариантов в том же духе)'
			,'cat'		=> 'RU: Вывести содержимое файла. Синтаксис: cat $file. EN: print $file content'
			,'message'	=> 'RU: Отправляет письмо пользователю $user с темой $subject. Синтаксис: message $user $subject $message. Отправленное письмо может быть прочитано любым ридером из репозитория. EN: send message to $user'
	#		,'tac $file'					=> '$file get content from last line to first'	# from last line to first
	#		,'more'							=> 'RU: Намеченная утилита постраничного просмотра текстового файла. Синтаксис: more $file. $file get content page to page'	# must be page to page
	#		,'less $file'					=> '$file get content page to page and scroll'	# must be page to page and scoll top and bottom
	#		,'head'							=> 'RU: Выводит $n первых строк файла $file. Синтаксис: head $n $file. EN: Show $n first lines of $file (if $n more then file kept lines, show all file content)'
			,'tail'		=> 'RU: Выводит $n последних строк файла $file. Синтаксис: tail $n $file. show $n last lines of $file.'
	#		,'_upload'						=> 'upload files to the server. (post no command)'
	#		,'_downoad'						=> 'upload files to the server. (post no command)'
	#		,'fa'							=> 'RU: Добавляет строку $line в файл $file. Синтаксис: fa $file $line. append $line to $file ($line must no kept spaces now)'
	#		,'_mail'						=> 'send email to admin. (post no command)'
	#		,'timezone [$from_UTC]'			=> 'RU: Устанавливает часовой пояс (временную зону). Cинтаксис: timezone [$from_UTC]. EN: set your local timezone or set difference between UTC'
			,'date'		=> 'RU: Выводит текущую дату, время и часовой пояс (селектором, позволяющим его изменить) в заданном формате. Синтаксис: date [$format]. EN: Show current date and time or set the $format of date'
			,'cal'		=> 'RU: Выводит календарь на $year год (по умолчанию на текущий год). EN: show calendar on YYYY year'
			,'source'	=> 'Выводит исходный код исполняемого файла программы'
			,'get'		=> 'RU: Выводит запрошенную информацию $info об объекте $obj. Синтаксис: get $obj $info. Примеры: get my nickname, get my status, get my email, get my id, get new dump, get last dump'
			,'select'	=> 'RU: Команда для получения данных из БД. На данный момент полный функционал не реализован, стоит плашка select mail для выборки LIMIT 50 последних непрочитанных писем.'
	#		,'calc'							=> 'RU: Запускает калькулятор прямо в командной строке. Синтаксис: calc.'
	#		,'default [$command]'			=> 'return default settings of date, timezone etc'
	#		,'site off'						=> 'block site to view'
	#		,'site on'						=> 'unblock site to view'
			,'cd'		=> 'RU: Устанавливает $dir текущей директорией. Если $dir не указана делает текущим корневой каталог (каталог, в который установлен движок). Синтаксис: cd [$dir]. Посмотреть текущий каталог можно командой pwd. EN: go to home dir or change dir to [..|../..|-|/dir|dir/dir|~user]'
			,'pwd'		=> 'RU: Выводит текущий каталог. EN: present working directory.'
			,'ls'		=> 'RU: Выводит список файлов и папок в директории $dir (если не указано, то содержимое текущей директории). Синтаксис: ls [$dir] EN: Show content of current dir with some $regular expression or options'
			,'tree'		=> 'RU: Выводит дерево файлов и каталогов в директории $dir. Синтаксис: tree [$dir]. EN: show files tree from /'
	#		,'mkdir'	=> 'Syntax: mkdir $dir [$dir2 [$dir3]]. make $dir (or few dirs)'
	#		,'rm, remove $file'				=> 'remove file'
	#		,'rmdir [$recursive]'			=> 'remove empty dir or dir with all content'
			,'rename'		=> 'RU: Пытается переименовать файл или директорию $oldname в $newname, переместив в конечную директорию, если необходимо. Если $newname существует, то он будет перезаписан. Синтаксис: rename $oldname $newname. EN: rename $oldname to $newname'
			,'copy'		=> 'RU: Создаёт копию файла $file с именем $copyname. Не забывайте, что второй параметр содержит не только путь, куда сохранить копию файла, но и содержит новое имя создаваемой копии! Синтаксис: copy $file $copyname. EN: copy file $from to file $to'
	#		,'find, whereis, which'			=> 'search of files and dir'
			,'eval'		=> 'Временное решение нехватки функционала путём дыры в уязвимости - все недостающие команды можно выполнить через eval. Но при каждом применении не забывайте создать скрипт, который решает ту же задачу и тогда нехватка функционала быстро ликвидируется и можно будет не прибегать к прямому выполнени кода, достаточно будет использовать внутренне API. Подсказака: можно использовать eval также в качестве калькулятора, достаточно начать ввод с eval echo и можно писать любую математическую операцию на PHP, например: eval echo pow(398/4, 2);'
			,'chmod'						=> 'Осуществляет попытку изменения режима доступа файла $file на режим $mode. Синтаксис: chmod $file $mode.'
	#		,'attr'							=> 'files attributes'
			,'zip'		=> 'RU: Создает в произвольной директории архив из заданного файла или директории, после создания архив отправляет на скачивание. Известный баг: архив создается корректно из файла, но из папки создаётся пустой архив.'
			,'unzip'	=> 'RU: Распаковывает содержимое архива pwd().$zip_archive.zip в директорию pwd().$destination (по умолчанию текущая директория). Если указаны дополнительные параметры $file1, $file2..$fileN то распакует только перечисленные файлы.'
			,'killallprocesses'	=> 'RU: Собственно, название говорит само за себя: принудительно завершает все процессы.'
			,'history'	=> 'RU: Выводит историю всех введённых команд всеми пользователями. Позже будут добавлены параметры и проверки, чтобы выводить для указанного/текущего пользователя. Из списка удаляются дубли команд, пустые строки, некорректные команды записываются в отдельный лог и не выводятся здесь. Все команды сортируются и выводится первое вхождение команды, если требуется посмотреть историю без изменений, вводите cat ' . $site['cmd_log']
	#		,'rpm'							=> 'package manager'
	#		,'yum'							=> 'update manager'
	#		,'dpkg'							=> 'developer manager'
	#		,'apt'							=> ''
	#		,'string'						=> 'processing of strings'
	#		,'array'						=> 'processing of arrays'
	#		,'file'							=> 'processing of files'	# etc
			,'create_backup'	=> 'RU: Создает в папке  архив с дампом базы и файлами всего сайта (полный бекап), после создания архив отправляет на скачивание.'
			,'dump'		=> 'Создание дампа текущей базы данных. Дамп создаётся в текущем каталоге. Просмотр содержимого последнего созданного дампа: `get last dump`. Создание дампа с просмотром содержимого в консоли: `get new dump`'
	#		,'shell'		=> 'RU: прмой запуск произвольной команды терминала. Почему то не очень я заметил работу, только если shell echo...'
	#		,'pid'			=> 'pid, cloud, puddle. manipulate with clouds and puddle (processes)'
		];
		$commands['summary']['ru']['staff'] = array_merge($commands['summary']['ru']['ghost'], $commands['summary']['ru']['staff']);

		$commands['summary']['ru']['admin'] = [
			 'permission'	=> 'Устанавливает параметр доступа $key в значение $value для пользователя с ID $user_id'
			,'user'			=> 'Выполняет действие $act с пользователем $user_id. Позволяет выполнить блокировку пользователей, удалять пользователей, менять их профили и т.п.'
			,'group'		=> 'Выполняет операции над пользовательскими группами'
		];
		$commands['summary']['en']['admin'] = [
			 'user'			=> 'Manipulations of users'
			,'group'		=> 'Manipulations of users group'
			,'permission'	=> 'Manipulations of users permissions'
		];
		$commands['summary']['ru']['admin'] = array_merge($commands['summary']['ru']['staff'], $commands['summary']['ru']['admin']);

		if (!$argv[1]) {
			$return .= 'Добро пожаловать в Adeptx Driver!

	Этот туториал призван помочь вам сориентироваться на самом начальном этапе. Ниже приведён список самых основных команд, с кратким описанием предназначения скрипта. Чтобы унать информацию о конкретной команде есть команда `about $command_name` (где $command_name = имя скрипта, например `about aliases`).

	Команды можно использовать как прямо в этой оболочке, так и вызывать в своих скриптах или программах через встроенную команду run($command_with_arguments_string) или подлключив исполняемый файл команды в свои проекты через include_once/require_once (once - потому что в этом файле объявляется функция, повторное обьявление приведет к ошибке), после подключения в любое удобное время вызвав функцию с соответствующим названием.

	Многие команды имеют синонимы для того, чтобы упростить запоминание и уменьшить количество ошибок при вводе. Однако рекомендуется всё же использовать оригинальное имя команды при вызове, это поможет избежать некоторых возможных недочетов.

	Для начала работы, первое что можно сделать - зарегистрироваться. Для этого выполните `reg $email $password`. После регистрации вы будете автоматически авторизованы. В дальнейшем вам необходимо будет авторизовываться самостоятельно используя команду `auth $login $password`, когда это необходимо (при открытии сайта на новом устройстве, истечения срока дейтсвия сессий и т.п.; $login это ваш $email или $nickname указанные при регистрации или позже) для того чтобы вытянуть из базы данных информацию о сессии и всё что связано с персонализацией системы и получить больше возможностей для выполнения команд. Всё, что необходимо запомнить о сессии и вашем профиле будет записываться в базу данных по возможности или вы можете обращаться к базе данных вручную.

	Каждый пользователь получает в распоряжение свою собственную базу данных `adeptx_user$USERID_customdb` (для доступа к ней вам не придётся указывать всё это, вы можете обращаться к ней через ~ или вообще не упоминая, по умолчанию всегда подразумевается, что вы обращаетесь в этой базе данных, если из контекста не следует иное) с персональными таблицами и полный доступ к своей базе данных. Кроме того, предоставленный доступ к публичным базам данных позволяет обращаться к расшаренным таблицам и другим пользователям (по установленным правилам: только для чтения или чтение и запись...).
	Также дела обстоят и с файлами, каждый пользователь получает в распоряжение свою папку и так далее. Кроме того в вашем распоряжении общий репозиторий файлов и скриптов, вы можете добавлять в него свои удачные скрипты, выкладывая их в общий доступ, помогая другим своими разработками. Также для выполнения доступны многие команды linux-терминала, только выполнение всех этих функций ограничено только вашим рабочим каталогом выделенной вам базой данных, за исключением комманд обращения к общедоступным директориям и базам, в частности репозиторию. Пытаясь достучаться до каталогов более высокого уровня через ../ вы получите ошибку безопасности. Разумеется, при таком наборе функциональности, ни о какой безопасности не может идти и речи, хоть мы и стараемся максимально свести на нет возможные уязвимости. Так что обход этих ограничений тем или иным методом всё равно доступен, но помните, что подобное поведение вредит другим пользователям, поэтому за проделки вы будете забанены с удалением всех ваших данных.
	Вот поэтому не забывайте делать бекапы своих данных и сохранять их в безопасном от уязвимостей месте, повышать разными средствами безопасность данных и делясь своими наработками в области безопасности данных со всеми.

	После того, как вы авторизуетесь, вызовите это окно снова, чтобы увидеть перечень доступных вам команд, поскольку сейчас вы видите только список команд, доступных для всех посетителей, авторизованные пользователи имеют более широкий функционал.

	Отдельно хочу отметить специфическую реализацию в системе функционала синонимов вызываемых команд, а кое-какие из них даже имеют синтаксический сахар. Попробуйте посмотреть на синонимы разных команд (`aliases $cmd`, например `aliases help`) и вы сами всё поймёте. Например, цитату дня, которая используется в качестве эпиграфа, можно получить такими способами: `epigraph`, `quote`, `цитата` или даже `"цитата дня"`. Если вы создадите или возьмете из репозитория исполняемый файл с названием, которое уже имеется в списке псевдонимов, то псевдоним будет проигнорирован, будет выполнена команда имеющая исполняемый файл со своим именем. Так что ни один псевдоним не может перезаписать название реальной функции и подменить оригинал, help всегда останется help-ом. Для того, чтобы изменить функционал по умолчанию для существующей команды нужно будет ковырять файлы программы.

	<em><b>Будьте бдительны, если передаваемый аргумент должен содержать пробел, заключите его в одинарные или двойные кавычки; косые кавычки используются для выполнения команды, которая в них заключена и возвращения результата её выполнения качестве передаваемого аргумента в другую команду. Если в выражение, заключенное в одинарные кавычки нужно добавить выражение в двойных кавычках, их не требуется экранировать, обратное также верно. Однако если вам понадобится указать двойные кавычки в выражении заключенном в двойные кавычки, их нужно экранировать обратным слешем вот так: \\", при этом слеш не добавится к строке. если же вам необходимо использовать слеш в конце строки, вам необходимо экранировать сам слеш вот так: \\\\", тогда у вас стрка закончится на слеш. если у вас строка вида "C:\\\\", вам достаточно указать два слеша, обратные слеши не нужно экранировать до тех пор, пока их не будет нечетное количество в конце строки, но даже при этом экранировать нужно будет только последний слеш. то есть любое количество обратных слешей будет просто добавлено как есть, кроме последнего нечетного, он будет сьеден и к строке добавится кавычка, если вы не проэкранируете его. Кроме того у eval и shell несколько специфическая интерпретация введённых команд, кавычки могут чудесным образом вырезаться там, где это не должно происходить. Довести все эти моменты до ума находится в первоочередных задачах, когда это произойдёт данное уведомление исчезнет.</b></em>

	Приятной работы!';

			$return .=  "\n\nПеречень доступных клавиатурных сочетаний и горячих клавиш в этом окне:\n\n";

			$return .= "<style>.help_table td {padding: 5px 10px;} .help_table tr:nth-child(2n) {background-color:rgba(255,255,255,0.05);} .help_table, .help_table * { box-sizing: border-box; } .help_table { max-width: 51em;
	    box-sizing: border-box;
	    font-size: 13px; }</style>";
			$return .= "<table class=\"help_table\"><tbody valign=\"top\">";
			$return .= "<tr style=\"color:green\"><td><b>Сочетание&nbsp;клавиш</b></td><td><b>Действие</b></td></tr>";
			foreach ($hotkeys[ $_SESSION['lang'] ] as $hotkey => $description) {
				$return .= "<tr><td>$hotkey</td><td>$description</td></tr>";
			}
			$return .= "</tbody></table>";

			$return .=  "\nПеречень всех доступных скриптов (в квадратных скобках указываются необязательные параметры):\n\n";

			ksort($commands['summary']['ru'][ $_SESSION['status'] ]);

			# после выхода стираются все данные сессии, однако при новом запросе status устанавливается в ghost
			$return .= "<table class=\"help_table\"><tbody valign=\"top\">";
			$return .= "<tr style=\"color:green\"><td><b>Имя&nbsp;скрипта</b></td><td><b>Параметры</b></td><td><b>Краткое&nbsp;описание</b></td></tr>";
			foreach ($commands['summary'][ $_SESSION['lang'] ][ $_SESSION['status'] ] as $command => $description) {
				$arguments = $commands['arguments'][$command];
				$return .= "<tr><td>$command</td><td>$arguments</td><td>$description</td></tr>";
			}
			$return .= "</tbody></table>";
		} else {
			$return .= "Справка по команде ${argv[1]}: " . $commands['summary'][ $_SESSION['lang'] ][ $_SESSION['status'] ][ $argv[1] ];
		}
////////


$query = "SET FOREIGN_KEY_CHECKS = 1;";
$db->call($query);

/*	 "Nunc est bibendum!"
	,"Quae nocent docent."
	,"Tibi et igni."
	,"Res tua agitur."
	,"Sic dicta."
	,"Sic transit gloria mundi."
	,"Natura sic voluit."
	,"Tale quale."
	,"Sic itur ad astra."
	,"Sic passim."
	,"Magni nominis umbra."
	,"Perfer et obdura."
	,"Tritum per tritum."
	,"Idem per idem."
	,"Modo vir, modo femina."
	,"Materia subtilis."
	,"Dimidium facti, qui eoepit, habet."
	,"Taurum toilet, qui vitulum sustulerit."
	,"Tertius gaudens."
	,"Tertium non datur."
	,"Tres faciunt collegium."
	,"Vana est sapientia nostra."
	,"Debes, ergo potes."
	,"Sine ira et studio."
	,"Sine ргесе, sine pretio, sine poculo."
	,"Cave ne cadas."
	,"Inutile terrae pond us."
	,"Pia causa."
	,"Pia desideria."
	,"Sal us populi suprema lex."
	,"Abyssus abyssum invocat."
	,"Nulla ratione."
	,"Beati pauperes spirilu."
	,"Beatus ille, qui procul negotiis."
	,"Censor morum."
	,"Deus ex machina."
	,"Dis aliter visum."
	,"Primus in orbe deos fecit timor."
	,"Perdissima republica plurimae legis."
	,"Barbam video, sed philosophum non video."
	,"Onus probandi."
	,"Onus proferendi."
	,"Gaudeamus igitur! Gaudeamus igitur, juvenes dum sumus."
	,"Fac fideli sis fidelis."
	,"Vale et me ama."
	,"Vale."
	,"Esse quam videri."
	,"Vestra salus - nostra salus."
	,"In aere piscari, in mare venari."
	,"Procul negotiis."
	,"Ex dono."
	,"Bis dat, qui cito dat."
	,"Cloaca maxima."
	,"Mysterium magnam."
	,"Certum, quia impossibile est."
	,"Amicus certus in re incerta cernitur."
	,"Crede experto."
	,"Credite, posteri!"
	,"Credo, quia absurdum (est)."
	,"Mundus universus exercet histrioniam."
	,"Credo ut intelligam."
	,"Aeterna historia."
	,"Aeterna nox."
	,"Aeternae veritates."
	,"Aeterna urbs."
	,"Pro re nata."
	,"Mens sana in corpore sano."
	,"Video meliora proboque, deteriora sequor."
	,"Sub alia forma."
	,"In brevi."
	,"Imperare sibi maximum imperium est."
	,"In parvo."
	,"In minimis maximus."
	,"In расе."
	,"In optima forma."
	,"Sensu obsceno."
	,"Sine dubio."
	,"In nubibus."
	,"In saecula saeculorum."
	,"De omnibus dubito."
	,"Onmi casu."
	,"Aqua vitae."
	,"Aqua et panis, vita canis."
	,"In una persona."
	,"Gaudium magnum nuntio vobis."
	,"Bellum omnium contra omnes."
	,"Volens-nolens."
	,"Lupus pilum mutat, non mentem."
	,"Sub umbra."
	,"In came."
	,"Contra rationem."
	,"Contra spem spero!"
	,"Illud erat vivere!"
	,"Quovis modo."
	,"In usum et abusum."
	,"In statu quo."
	,"In rerum natura."
	,"Medice, cura te ipsum."
	,"Tempora mutantur."
	,"Tempora mutantur, et nos mutamur in illis."
	,"Tempus fugit."
	,"http://skio.ru/latin/dict-vr.php"
	,"undefined"
*/