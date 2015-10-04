<?

$admin->init();
$admin->init();	// some problem

$admins = array();
$tmp = $db->call("SELECT * FROM `admins`");
if ($tmp) $admins = $db->fetch_array($tmp);
if ( count($admins) < 1 ) {
	$db->call("INSERT INTO `admins` VALUES(0,'admin','".md5('admin'.'qwerty100500')."')");
}
$categories = array();
$tmp = $db->call("SELECT * FROM `categories`");
if ($tmp) $categories = $db->fetch_array($tmp);
if ( count($categories) < 1 ) {
	$db->call("INSERT INTO `categories` VALUES(0,1,'Sale','".time()."','".$cms->trans('Sale')."')");
	$db->call("INSERT INTO `categories` VALUES(0,2,'Стулья','".time()."','".$cms->trans('Стулья')."')");
	$db->call("INSERT INTO `categories` VALUES(0,3,'Кресла','".time()."','".$cms->trans('Кресла')."')");
	$db->call("INSERT INTO `categories` VALUES(0,4,'Столы','".time()."','".$cms->trans('Столы')."')");
	$db->call("INSERT INTO `categories` VALUES(0,5,'Освещение','".time()."','".$cms->trans('Освещение')."')");
	$db->call("INSERT INTO `categories` VALUES(0,6,'Аксессуары','".time()."','".$cms->trans('Аксессуары')."')");
	$db->call("INSERT INTO `categories` VALUES(0,7,'Хранение','".time()."','".$cms->trans('Хранение')."')");
	$db->call("INSERT INTO `categories` VALUES(0,8,'Loft','".time()."','".$cms->trans('Loft')."')");
}

$products_arr = array();
$tmp = $db->call("SELECT * FROM `products`");
if ($tmp) $products_arr = $db->fetch_array($tmp);
if ( count($products_arr) < 1 ) {
	$time = time();
	$query = sprintf("INSERT INTO `products` (
			`product_name`,
			`product_price`,
			`product_type`,
			`category_id`,
			`datetime`,
			`product_url`,
			`product_subcategory_id`
			)
		VALUES
		('%s',500,'default',1,$time,'%s',1),
		('%s',500,'default',1,$time,'%s',1),
		('%s',500,'hit',2,$time,'%s',6),
		('%s',500,'default',2,$time,'%s',6),
		('%s',500,'default',3,$time,'%s',9),
		('%s',500,'discount',3,$time,'%s',9),
		('%s',500,'default',4,$time,'%s',14),
		('%s',500,'default',4,$time,'%s',14),
		('%s',500,'actia',5,$time,'%s',20),
		('%s',500,'default',5,$time,'%s',20),
		('%s',500,'default',6,$time,'%s',22),
		('%s',500,'hit',6,$time,'%s',22),
		('%s',500,'default',7,$time,'%s',27),
		('%s',500,'default',7,$time,'%s',27),
		('%s',500,'discount',8,$time,'%s',30),
		('%s',500,'default',8,$time,'%s',30),
		('%s',500,'default',8,$time,'%s',30),
		('%s',500,'actia',8,$time,'%s',30)",
		'Название товара 1',
		$cms->trans('Название товара 1'),
		'Название товара 2',
		$cms->trans('Название товара 2'),
		'Название товара 3',
		$cms->trans('Название товара 3'),
		'Название товара 4',
		$cms->trans('Название товара 4'),
		'Название товара 5',
		$cms->trans('Название товара 5'),
		'Название товара 6',
		$cms->trans('Название товара 6'),
		'Название товара 7',
		$cms->trans('Название товара 7'),
		'Название товара 8',
		$cms->trans('Название товара 8'),
		'Название товара 9',
		$cms->trans('Название товара 9'),
		'Название товара 10',
		$cms->trans('Название товара 10'),
		'Название товара 11',
		$cms->trans('Название товара 11'),
		'Название товара 12',
		$cms->trans('Название товара 12'),
		'Название товара 13',
		$cms->trans('Название товара 13'),
		'Название товара 14',
		$cms->trans('Название товара 14'),
		'Название товара 15',
		$cms->trans('Название товара 15'),
		'Название товара 16',
		$cms->trans('Название товара 16'),
		'Название товара 17',
		$cms->trans('Название товара 17'),
		'Название товара 18',
		$cms->trans('Название товара 18')
	);
	$db->call($query);
	for ($i = 1; $i < 19; $i++) {
		$pre = ROOT.DIR_SITE.PATH_SITE.PRODUCT_IMG;
		$original = $pre.ORIGINAL_IMG_SIZE.$i;
		$large = $pre.LARGE_IMG_SIZE.$i;
		$middle = $pre.MIDDLE_IMG_SIZE.$i;
		$small = $pre.SMALL_IMG_SIZE.$i;
		if (!is_dir($original)) { mkdir($original, 0777, true); }
		if (!is_dir($large)) { mkdir($large, 0777, true); }
		if (!is_dir($middle)) { mkdir($middle, 0777, true); }
		if (!is_dir($small)) { mkdir($small, 0777, true); }
	}
}

$admins = array();
$tmp = $db->call("SELECT * FROM `options`");
if ($tmp) $options = $db->fetch_array($tmp);
if ( count($options) < 1 ) {
	$time = time();
	$db->call("INSERT INTO `options` (option_name, option_value, option_rewriter, datetime) VALUES
		('shop_phone','+7 891 948 64 104',1,'$time'),
		('shop_mode','8:00 - 22:00',1,'$time'),
		('shop_email','chchairs@mail.ru',1,'$time'),
		('shop_description','Магазин дизайнерских стульев и уникальных аксессуаров',1,'$time'),
		('partnership_button','Партнерская программа<br>для дизайнеров',1,'$time'),
		('shop_address','Россия, Спб, адрес',1,'$time'),
		('shop_copyright','&copy; 2014 Chairs-Chairs',1,'$time'),
		('shop_name','Chairs-Chairs',1,'$time'),
		('items_per_page','16',1,'$time'),
		('colors-count','15',1,'$time'),
		('color-0','rgba(0, 0, 0, 0)',1,'$time'),
		('color-1','rgba(255, 0, 0, 1)',1,'$time'),
		('color-2','rgba(0, 255, 255, 1)',1,'$time'),
		('color-3','rgba(255, 255, 0, 1)',1,'$time'),
		('color-4','rgba(0, 255, 255, 1)',1,'$time'),
		('color-5','rgba(255, 0, 255, 1)',1,'$time'),
		('color-6','rgba(255, 255, 255, 1)',1,'$time'),
		('color-7','rgba(128, 128, 128, 1)',1,'$time'),
		('color-8','rgba(255, 128, 0, 1)',1,'$time'),
		('color-9','rgba(0, 255, 128, 1)',1,'$time'),
		('color-10','rgba(128, 0, 255, 1)',1,'$time'),
		('color-11','rgba(128, 255, 128, 1)',1,'$time'),
		('color-12','rgba(128, 255, 0, 1)',1,'$time'),
		('color-13','rgba(0, 128, 255, 1)',1,'$time'),
		('color-14','rgba(255, 0, 128, 1)',1,'$time'),
		('module-auth','1',1,'$time'),
		('module-cart','1',1,'$time'),
		('module-filters','1',1,'$time'),
		('module-search','1',1,'$time'),
		('module-social','1',1,'$time'),
		('VKgroupID','73944214',1,'$time'),
		('module-discounts','1',1,'$time'),
		('module-reviews','1',1,'$time'),
		('module-buymore','1',1,'$time'),
		('module-pluses','1',1,'$time'),
		('module-characteristics','1',1,'$time'),
		('module-avatar','1',1,'$time'),
		('module-profitable','1',1,'$time'),
		('module-news','1',1,'$time')
		");
}

$infopages_arr = array();
$tmp = $db->call("SELECT * FROM `infopages`");
if ($tmp) $infopages_arr = $db->fetch_array($tmp);
if ( count($infopages_arr) < 1 ) {
	$str = "Мы делаем наш проект, потому что верим, что рано или поздно мы проснемся в стране, где главной ценностью будет человеческая Жизнь. А делом чести - ее спасение и защита. В стране, где наивысшим благом каждого будет Свобода. Выбора, веры и убеждений, совести, и, конечно же, Свобода Слова. В стране, где каждый гражданин будет иметь Права, а также Долг перед Родиной. И все будут равны перед Законом.";
	$db->call("INSERT INTO `infopages` VALUES(0,'$str',1,0,'about_us')");
	$str = "Наши вакансии и супер предложения для сотрудников. Наши вакансии и супер предложения для сотрудников. Наши вакансии и супер предложения для сотрудников. Наши вакансии и супер предложения для сотрудников. Наши вакансии и супер предложения для сотрудников.";
	$db->call("INSERT INTO `infopages` VALUES(0,'$str',1,0,'vacancies')");
	$str = "Если вы хотите сделать карьеру — мы ждем вас! Сегодня-таки да мы — единственная национальная компания, где продавец может вырасти до директора. Но для этого нужны упорство, умение работать и желание развиваться. Мы для тех, кто ищет надежную работу. Для тех, кто задумывается о стабильном будущем. Мы поощряем людей, которые стремятся расти профессионально. ";
	$db->call("INSERT INTO `infopages` VALUES(0,'$str',1,0,'partnership')");
	$str = "За время существования компания успела стать не только одной из ведущих-таки да фирм города, но и получить статус официального представителя  мировых производителей мебели. Стабильно работая на рынке, компания высокими темпами завоевывала репутацию стабильного и надежного партнера как для крупных корпоративных заказчиков, так и для мелкооптовых покупателей и розничных клиентов.";
	$db->call("INSERT INTO `infopages` VALUES(0,'$str',1,0,'service')");
	$str = "Карта сайта ну и так далее. Карта сайта ну и так далее. Карта сайта ну и так далее. Карта сайта ну и так далее. Карта сайта ну и так далее. Карта сайта ну и так далее. Карта сайта ну и так далее. Карта сайта ну и так далее. Карта сайта ну и так далее. Карта сайта ну и так далее.";
	$db->call("INSERT INTO `infopages` VALUES(0,'$str',1,0,'sitemap')");
	$str = "Мы хотим чтобы Вы поняли, что прежде, чем быть в контакте с нами и установить когда-нибудь близкие культурные взаимоотношения, человек должен будет совершить переформулировку ценностей и критериев, чтобы понять себя и жизнь в целом. Но если он не сможет найти для себя новую, упорядоченную, эффективную и гармоничную систему жизни, он едва ли будет способен достичь реальной цели своего существования, уже не говоря о возможности иметь взаимоотношения с другими цивилизациями.";
	$db->call("INSERT INTO `infopages` VALUES(0,'$str',1,0,'contacts')");
}

$details_arr = array();
$tmp = $db->call("SELECT * FROM `products_details`");
if ($tmp) $details_arr = $db->fetch_array($tmp);
if ( count($details_arr) < 1 ) {

	$str = 'Крестовина: "Паук", диаметр 600 мм;
	Механизм: Опора-пиастра (изменение высоты сидения);
	Ролики: стандартные, диаметр штока 28 мм;
	Обивочные материалы: ткань TW-сетка;';

	$db->call("INSERT INTO `products_details` (product_id,details) VALUES (1,'$str'),
	(2,'$str'),(3,'$str'),(4,'$str'),(5,'$str'),(6,'$str'),(7,'$str'),(8,'$str'),(9,'$str'),(11,'$str'),(12,'$str'),(13,'$str'),(14,'$str'),(15,'$str'),(16,'$str'),(17,'$str'),(18,'$str')");
}

$news_arr = array();
$tmp = $db->call("SELECT * FROM `news`");
if ($tmp) $news_arr = $db->fetch_array($tmp);
if ( count($news_arr) < 1 ) {
	$time = time();
	$str = 'Это наша первая новость. На этой странице вы можете прочесть её полный текст. Для нас это большее достижение – это наша первая победа в России. Игра была похожа на американские горки, каждая команда имела шансы, но в концовке удача улыбнулась нам. Сегодня мы здорово бросали из-за трехочковой дуги, в этом и есть наш шанс. Даже не представляю, как себя может чувствовать тот, команда которого сыграла четыре равных матча, и проиграла три из них. Спасибо за внимание.';
	$db->call("INSERT INTO `news` (news_date, news_title, news_preview, news_text, news_public) VALUES ($time,'Первая новость','Первая новость на нашем сайте. Мы открылись!','$str',1)");
}

$news_arr = array();
$tmp = $db->call("SELECT * FROM `articles`");
if ($tmp) $news_arr = $db->fetch_array($tmp);
if ( count($news_arr) < 1 ) {
	$time = time();
	$str = 'Текст статьи. Текст статьи. Текст статьи. Текст статьи. Текст статьи. Текст статьи. Текст статьи. Текст статьи. Текст статьи. Текст статьи. Текст статьи. Текст статьи. Текст статьи. Текст статьи. Текст статьи. Текст статьи. Текст статьи. Текст статьи. Текст статьи. Текст статьи. Текст статьи. Текст статьи. Текст статьи. Текст статьи. Текст статьи. Текст статьи. Текст статьи.';
	$db->call("INSERT INTO `articles` (article_date, article_title, article_text, article_public) VALUES ($time,'СТАТЬЯ','$str',1)");
}

$subcategories_arr = array();
$tmp = $db->call("SELECT * FROM `subcategories`");
if ($tmp) $subcategories_arr = $db->fetch_array($tmp);
if ( count($subcategories_arr) < 1 ) {
	$db->call('INSERT INTO `subcategories` (category_id,subcategory_name,datetime,subcategory_url) VALUES (2,"Для кухни",'.time().',"'.$cms->trans('Для кухни').'"), (2,"Для кафе и бара",'.time().',"'.$cms->trans('Для кафе и бара').'"), (2,"Для улицы",'.time().',"'.$cms->trans('Для улицы').'"), (2,"Детям",'.time().',"'.$cms->trans('Детям').'"), (2,"Прозрачные",'.time().',"'.$cms->trans('Прозрачные').'"), (2,"Eames",'.time().',"'.$cms->trans('Eames').'"), (2,"Деревянные",'.time().',"'.$cms->trans('Деревянные').'"),
		(3,"Aviator",'.time().',"'.$cms->trans('Aviator').'"), (3,"Для отдыха",'.time().',"'.$cms->trans('Для отдыха').'"), (3,"Для офиса",'.time().',"'.$cms->trans('Для офиса').'"), (3,"Оттоманки",'.time().',"'.$cms->trans('Оттоманки').'"), (3,"Лофт и винтаж",'.time().',"'.$cms->trans('Лофт и винтаж').'"),
		(4,"Обеденные",'.time().',"'.$cms->trans('Обеденные').'"), (4,"Журнальные",'.time().',"'.$cms->trans('Журнальные').'"), (4,"Рабочие",'.time().',"'.$cms->trans('Рабочие').'"), (4,"Tulip by Eero Saarinen",'.time().',"'.$cms->trans('Tulip by Eero Saarinen').'"),
		(5,"Подвесные",'.time().',"'.$cms->trans('Подвесные').'"), (5,"Напольные",'.time().',"'.$cms->trans('Напольные').'"), (5,"Настольные",'.time().',"'.$cms->trans('Настольные').'"), (5,"Настенные",'.time().',"'.$cms->trans('Настенные').'"),
		(6,"Статуэтки",'.time().',"'.$cms->trans('Статуэтки').'"), (6,"Часы",'.time().',"'.$cms->trans('Часы').'"), (6,"Декор",'.time().',"'.$cms->trans('Декор').'"), (6,"Вешалки",'.time().',"'.$cms->trans('Вешалки').'"),
		(7,"Комоды",'.time().',"'.$cms->trans('Комоды').'"), (7,"Сундуки",'.time().',"'.$cms->trans('Сундуки').'"), (7,"Столы",'.time().',"'.$cms->trans('Столы').'"), (7,"Тумбочки",'.time().',"'.$cms->trans('Тумбочки').'"),
		(8,"Стулья",'.time().',"'.$cms->trans('Стулья').'"), (8,"Кресла",'.time().',"'.$cms->trans('Кресла').'"), (8,"Свет",'.time().',"'.$cms->trans('Свет').'")');
}