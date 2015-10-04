<?

$drop_if_exist = true;

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
	$db->call("DROP TABLE IF EXISTS `${database['prefix']}session`;");
}

// $database['name'] = addcslashes($database['name'], '%_');
// $database['prefix'] = addcslashes($database['prefix'], '%_');

$query = "
CREATE TABLE IF NOT EXISTS `${database['prefix']}session` (
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
	$db->call("DROP TABLE IF EXISTS `${database['prefix']}user`;");
}

$query = "
CREATE TABLE IF NOT EXISTS `${database['prefix']}user` (
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
	$db->call("DROP TABLE IF EXISTS `${database['prefix']}user_message`;");
}

$query = "
CREATE TABLE IF NOT EXISTS `${database['prefix']}user_message` (
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
	$db->call("DROP TABLE IF EXISTS `${database['prefix']}epigraph`;");
}

$query = "
CREATE TABLE IF NOT EXISTS `${database['prefix']}epigraph` (
`id` int(15) NOT NULL auto_increment,
`epigraph` varchar(255) NOT NULL,
`utter` varchar(255),
`footnote` varchar(255),
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1;
";
$db->call($query);

# Table structure for table `lang`
if ($drop_if_exist) {
	$db->call("DROP TABLE IF EXISTS `${database['prefix']}lang`;");
}

$query = "
CREATE TABLE IF NOT EXISTS `${database['prefix']}lang` (
`id` int(15) NOT NULL auto_increment,
`noconflict` varchar(255) NOT NULL,
`en` text NOT NULL,
`ru` text NOT NULL,
`ua` text,
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
INSERT INTO `${database['prefix']}user` (`nickname`, `email`, `hash`, `salt`) VALUES ('x-positive','e.grinec@gmail.com','6ab39c41030d3888846c4ecb11375bb3ad7138f7879ac19f2f9e192f7614cf1523f1b3ac951eea304b09d911d3797f32','5024467d5acfd9d9d3592340ee2800cf'),
 ('gcorp','gcorp.gcorp@gmail.com','0359ac6aa8df54fe9dad42ef88a5134e5d2389e4339cdc91330de5f6bdf24e8f1c2081763a03d00838c1aa16f18db61e','0cc27475046ec987dfc168c0669b6323');
";
$db->call($query);

# Dumping data for table `user_message`
# Здесь я предлагаю при установке системы залить в БД сообщения или только админу 1 или по 1 на каждого созданного пользователя, в качестве приветсвенного сообщения (хотя лучше для этого использовать новостную информационную систему оповещений)

$query = "
INSERT INTO `${database['prefix']}user_message` (`to_uid`, `subject`, `message`, `from_uid`, `sender_ip`, `date_sent`, `was_read`) VALUES ('2','Тест 1','Тестовое сообщение 1','1','127.0.0.1','2009-09-09 22:22:22','1'),
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
INSERT INTO `${database['prefix']}epigraph` (`epigraph`, `utter`, `footnote`) VALUES ('Машины должны работать. Люди должны думать.','Лозунг IBM',''),
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

# Dumping data for table `lang`
# Для однозначного соответсвтия нужно также добавить столбцы: UserID, ProjectAlias, ModuleName, TranslateDate, TranslateVersion для поиска соответствий по WHERE и безконфликтного сосуществования разных версий перевода

$query = "
INSERT INTO `${database['prefix']}lang` (`noconflict_hash`,`unique_key`,`en`,`ru`,`ua`) VALUES ('adeptx.cmd.exception','403','Access denied','Это действие доступно для исполнения только после авторизации','Цю операцiю можливо здiйснювати лише будучи аутентифiкованим'),
 ('adeptx.cmd.exception','1007','The number of arguments passed is less than the number of mandatory','Количество переданных аргументов меньше количества обязательных','Передано меньше аргументiв нiж найменьш можливо для правильного тлумачення'),
 ('adeptx.cmd.exception','4978','No one dump yet','В папке хранения дампов не обнаружено ни одного дампа базы данных','Жодного дампа не знайдено'),
 ('adeptx.cmd.exception','9846','No user with such login','Указанный логин не зарегистрирован','Юзер з таким логiном не зарегован');
";
$db->call($query);

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