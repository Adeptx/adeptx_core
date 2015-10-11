var note = {};

note.create = function(ni)
{
	var $note;

	$('body').append('<div class="note draggable resizable" id=n' + ni + ' data-note-id="' + ni + '"">\
		<div class=note_name>Заметка</div>\
		<div class=note_main>\
		<textarea id=note' + ni + ' class=note_text onchange="run(\'note ' + ni + ' \' + $(this).val());"></textarea>\
		</div>\
		</div>');	// <div class=resize></div>\

	var $note = $(".note").last();

	// $('.note_name:last').mousedown(function(){
	// 	move($(this).parent());
	// });

	$('.note_name:last').dblclick(function(){
		slide($(this).next(), 345);
	});
	conf(0,ni);

	var exist=0;
	var doit=0;

	$note.css({
		'left': note[ni].left,
		'top': note[ni].top,
		'width': note[ni].width,
		'height': note[ni].height,
		'z-index': maxZ++
	});

	// $note.mousedown(function() // определение смен z-index-ов - меняется на меньший у всего класса, меняется на больший у одного.
	// {
	// 	if ($(this).css('z-index') != (maxZ-1)) {
	// 		$(this).css('z-index', maxZ++);
	// 	}
		
	// 	// do
	// 	// {
	// 	// 	var doit=0;
	// 	// 	for(var i=1; i<maxZ; i++)
	// 	// 	{
	// 	// 		exist=0;
	// 	// 		$('.note').each(function(index) {
	// 	// 			if ($(this).css('z-index') == i) {
	// 	// 				exist=1;
	// 	// 				doit=1;
	// 	// 			}
	// 	// 		});
	// 	// 		if (!exist) $('.note').each(function(n) {
	// 	// 			//alert(i);
	// 	// 			if ($(this).css('z-index') > i) {
	// 	// 				$(this).css('z-index',$(this).css('z-index')-1);
	// 	// 			}
	// 	// 		});
	// 	// 	}
	// 	// }
	// 	// while(doit);
	// });

	$note.contextmenu(function(event)
	{
		$('#context').remove();
		var $context_main = '<div class=context id=context>\
		<div id=context_main>\
		<div class=context_line id=del_note_'+this.id+'>Удалить эту заметку</div>\
		<div class=context_line id=add_note>Создать заметку</div>\
		<div class=context_line>Отметить время</div>\
		</div>\
		</div>';
		$('body').append($context_main);
		$('#del_note_'+this.id).click(function(){$('#'+this.id.slice(9)).remove();});
		$('#add_note').click(function(){add_note(++notes.count);});
		$('#fond').click(function(){change_bg();});
		e = event || window.event;
		var x = e.pageX || e.x;
		var y = e.pageY || e.y;
		$('.context').css({'left':x,'top':y});
		if (x+$('.context').width() > $(document).width()) $('.context').css('left',x-$('.context').width());
		if (y+$('.context').height() > $(document).height()) $('.context').css('top',y-$('.context').height());
		$('.context').fadeIn('slow');
		return false;
	});
}
