admin.users = {};
admin.users.init = function(){
	loadmore.init("user_id", 0, 16, function(data){
		var element;
		$.each(data, function(index, data){
			element = admin.users.createElement(data);
			$(".admin-table tbody").append(element);
		});
	});
	loadmore.call(function(data){
		var element;
		$.each(data, function(index, data){
			element = admin.users.createElement(data);
			$(".admin-table tbody").append(element);
		});
	});
}
admin.users.add = function(){
	var element = {};
	element.text = document.getElementsByTagName("iframe")[0].contentDocument.getElementById("tinymce").innerHTML;
	common.ajax({
			with: "users",
			what: "add",
			element: element
		},
		function( answer ){
			console.log( answer );
			element.id = answer;
			element.views = 0;
			element.date = "только что";
			admin.users.createElement( element );
		}
	);
}
admin.users.createElement = function(data){
	var element;
	element  = '<tr class="users" data-id="' +data['user_id']+ '">';
		element += '<td class="users-first-name"><input name="user_first_name" placeholder="—" value="';
		if (data['user_first_name']) element += data['user_first_name'];
		element += '"></td>';
		element += '<td class="users-last-name"><input name="user_last_name" placeholder="—" value="';
		if (data['user_last_name']) element += data['user_last_name'];
		element += '"></td>';
		element += '<td class="users-email"><input disabled placeholder="—" value="';
		if (data['user_email']) element += data['user_email'];
		element += '"></td>';
		element += '<td class="users-sex"><select name="user_sex">';
		element += '<option value="0"';
		if(data['user_sex'] == 0) element += 'selected="selected"';
		element += '>—</option>';
		element += '<option value="1"';
		if(data['user_sex'] == 1) element += 'selected="selected"';
		element += '>М</option>';
		element += '<option value="2"';
		if(data['user_sex'] == 2) element += 'selected="selected"';
		element += '>Ж</option>';
		element += '</td>';
		element += '<td class="users-reset-pass"><a class="reset-user-pass">Сбросить</a></td>';
		element += '<td class="options"><div class="remove">&#215;</div></td>';
	element += '</tr>';
	return element;
}