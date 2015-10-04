admin.options = {};
admin.options.init = function(){
	loadmore.init("option_id", 0, 16, function(data){
		var element;
		$.each(data, function(index, data){
			element = admin.options.createElement(data);
			$(".admin-table tbody").append(element);
		});
	});
	loadmore.call(function(data){
		var element;
		$.each(data, function(index, data){
			element = admin.options.createElement(data);
			$(".admin-table tbody").append(element);
		});
	});
}
admin.options.createElement = function(data){
	var element;
	element  = '<tr class="options" data-id="' +data['option_id']+ '">';

		element += '<td class="options-name">';

		var options = {
			"shop_phone": "Телефон:",
			"shop_mode": "Режим работы:",
			"shop_email": "E-mail:",
			"shop_description": "Описание магазина:",
			"partnership_button": "Надпись на кнопке:",
			"shop_address": "Адрес магазина:",
			"shop_copyright": "Копирайт:",
			"shop_name": "Название магазина:",
			"items_per_page": "Количество товаров на странице:",
			"colors-count": "Количество цветов в палитре:",
			"module-auth": "Модуль авторизации",
			"module-cart": "Модуль корзины",
			"module-filters": "Модуль фильтров",
			"module-search": "Модуль поиска",
			"module-social": "Модуль соц. сетей",
			"module-discounts": "Модуль скидок",
			"module-reviews": "Модуль отзывов",
			"module-buymore": "Модуль \"с этим также покупают\"",
			"module-pluses": "Модуль \"плюсы компании\"",
			"module-characteristics": "Модуль характеристик товара",
			"module-avatar": "Модуль профилей пользователей",
			"module-profitable": "Модуль \"выгодные предложения\"",
			"module-news": "Модуль новостей сайта",
			"VKgroupID": "ID группы Вконтакте",
			"color-0": "Цвет #1 в палитре",
			"color-1": "Цвет #2 в палитре",
			"color-2": "Цвет #3 в палитре",
			"color-3": "Цвет #4 в палитре",
			"color-4": "Цвет #5 в палитре",
			"color-5": "Цвет #6 в палитре",
			"color-6": "Цвет #7 в палитре",
			"color-7": "Цвет #8 в палитре",
			"color-8": "Цвет #9 в палитре",
			"color-9": "Цвет #10 в палитре",
			"color-10": "Цвет #11 в палитре",
			"color-11": "Цвет #12 в палитре",
			"color-12": "Цвет #13 в палитре",
			"color-13": "Цвет #14 в палитре",
			"color-14": "Цвет #15 в палитре",
			"color-15": "Цвет #16 в палитре"
		}
		if (options[data['option_name']]) {
			element += options[data['option_name']];
		}
		else {
			element += data['option_name'];
		}
		element += '</td>';
		element += '<td class="options-value"><input name="option_value" value="';
		element += data['option_value'];
		element += '">';
		// Who last edit this fild (ID)
		// element += '<td class="options-rewriter"><input value=' + data['option_rewriter'] + '">';
	element += '</tr>';
	return element;
}