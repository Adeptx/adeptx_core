admin.news = {};
admin.news.init = function(){
	loadmore.init("news_id", 0, 16, function(data){
		var element;
		$.each(data, function(index, data){
			element = admin.news.createElement(data);
			$(".admin-table tbody").append(element);

		});
	});
	loadmore.call(function(data){
		var element;
		$.each(data, function(index, data){
			element = admin.news.createElement(data);
			$(".admin-table tbody").append(element);
		});
	});
}
admin.news.add = function(){
	var element = {};
	element.preview = '';
	element.title = '';
	element.text = $("#window textarea").val();
	common.ajax({
			with: "news",
			what: "add",
			news: element
		},
		function( answer ){
			console.log( answer );
			element = answer;
			element.news_views = 0;
			element.news_date = "только что";
			$('.admin-table tbody').append(
				admin.news.createElement(element)
			);
			win.hide();
		}
	);
}
// admin.news.createElement = function(data){
// 	var element;
// 	element  = '<tr class="news" data-id="' +data['news_id']+ '">';
// 		element += '<td class="news-text"><span>' +data['news_text']+ '</span></td>';
// 		element += '<td class="news-date">' +data['news_date']+ '</td>';
// 		element += '<td class="news-views"><span>' +data['news_views']+ '</span></td>';
// 		element += '<td class="options"><div class="remove">&#215;</div></td>';
// 	element += '</tr>';
// 	return element;
// }
admin.news.createElement = function(data){
	var element = '';

	element += '<tr class="news" data-id="' +data['news_id']+ '">';
	element += 	'<td class="news-preview">';
	element += 	 '<input name="news_preview" value="' +data['news_preview']+ '">';
	element += 	'</td>';
	element += 	'<td class="news-title">';
	element += 	 '<input name="news_title" value="' +data['news_title']+ '">';
	element += 	'</td>';
	element += 	'<td class="news-text">';
	element += 	 '<textarea name="news_text">' +data['news_text']+ '</textarea>';
	element += 	'</td>';
	element += 	'<td class="news-public">';
	element += 		'<select name="news_public">';
	element += 			'<option value="1"';
	if (data['news_public'] == 1) {
		element += ' selected="selected"';
	}
	element += 			'>ДА</option>';
	element += 			'<option value="0"';
	if (!data['news_public'] || data['news_public'] == 0) {
		element += ' selected="selected"';
	}
	element += 			'>НЕТ</option>';
	element += 		'</select>';
	element += 	'</td>';
	element += '<td class="news-views">' +data['news_date']+ '</td>';
	element += '<td class="news-views">';
	if (data['news_views']) element += data['news_views'];
	else element += 0;
	element +=  '</td>';
	element += '<td class="options"><div class="remove">&#215;</div></td>';
	element += '</tr>';
			
	//element += '<tr data-id="0"><td>Информационных страниц не найдено.</td></tr>';
	return element;
}


// admin.news = {};
// admin.news.init = function(){
// 	loadmore.init("news_id", 0, 16, function(data){
// 		var element;
// 		$.each(data, function(index, data){
// 			element = admin.news.createElement(data);
// 			$(".admin-table tbody").append(element);

// 		});
// 	});
// 	loadmore.call(function(data){
// 		var element;
// 		$.each(data, function(index, data){
// 			element = admin.news.createElement(data);
// 			$(".admin-table tbody").append(element);
// 		});
// 	});
// }
// admin.news.add = function(){
// 	var element = {};
// 	element.link = $("#window input[name=name]").val();
// 	element.text = $("#window textarea").val();
// 	common.ajax({
// 			with: "news",
// 			what: "add",
// 			news: element
// 		},
// 		function( answer ){
// 			console.log( answer );
// 			element = answer;
// 			element.public = 0;
// 			element.views = 0;
// 			// element.date = "только что";
// 			$('.admin-table tbody').append(
// 				admin.news.createElement(element)
// 			);
// 			win.hide();
// 		}
// 	);
// }