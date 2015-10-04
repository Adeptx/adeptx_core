var links = {count: 0}, notes = {count: 0};

var rand, last;

function change_bg() {
	rand = Math.round(Math.random() * ($Adeptx.page.backgrounds.length - 1));
	if (last == rand) change_bg();
	else {
		$('body').css('background-image', 'url(' + $Adeptx.page.backgrounds[rand] + ')');
		last = rand;
	}
}$(function() {
	change_bg();
});

function clear_bg() {
	$('body').css('background-image', 'none');
}

function clear_desktop() {
	$('header, footer').toggle();
	var obj = $('.cloud').first();
	// obj.css({'width': '100%', 'height': '100%', 'max-width': '100%', 'max-height': '100%'});

	if (obj.requestFullScreen) {
		obj.requestFullScreen();
	} else if (obj.mozRequestFullScreen) {
		obj.mozRequestFullScreen();
	} else if (obj.webkitRequestFullScreen) {
		obj.webkitRequestFullScreen();
	}
}

//$(window).contextmenu(function(e){e=e||window.event;e.preventDefault();return false;});

function context(e){
	$('#context').remove();
	var $context_main, $ctx = '';
	if ($(e.target).is(".puddle")) $ctx = 'another ctx';
	$context_main = '<div class="context" id="context">\
<ul id="context_main">\
 <li class="context_line ajax_icon" id="refresh">' + $ctx + $Adeptx.global.dic.adeptx['refresh']+'</li>\
 <li class="context_line ajax plug" id="add_link">'+$Adeptx.global.dic.adeptx['create link']+'</li>\
 <li class="context_line ajax write" id="add_note">'+$Adeptx.global.dic.adeptx['create note']+'</li>\
 <li class="context_line ajax feedback" id="feedback">'+$Adeptx.global.dic.adeptx['feedback']+'</li>\
 <li class="context_line ajax cloud" id="change_bg">'+$Adeptx.global.dic.adeptx['change background']+'</li>\
 <!--li class="context_line ajax cloud" id="clear_bg">'+$Adeptx.global.dic.adeptx['clear background']+'</li-->\
 <li class="context_line ajax java" id="clear_desktop">'+$Adeptx.global.dic.adeptx['minimalism']+'</li>\
</ul>\
</div>';
	$('body').append($context_main);
	$('#refresh').click(function(){document.location.reload();});
	$('#add_link').click(function(){add_link(++links.count);});
	$('#add_note').click(function(){add_note(++notes.count);});
	$('#change_bg').click(function(){change_bg();});
	$('#clear_bg').click(function(){clear_bg();});
	$('#clear_desktop').click(function(){clear_desktop();});
	$('#feedback').click(function(){document.location.href='feedback';});
	e = e || window.event;
	var x = e.pageX || e.x;
	var y = e.pageY || e.y;
	$('.context').css({'left':x,'top':y});
	if (x+$('.context').width() > $(document).width()) $('.context').css('left',x-$('.context').width());
	if (y+$('.context').height() > $(document).height()) $('.context').css('top',y-$('.context').height());
	$('.context').show();

	$(window).contextmenu(null);
	
	$(window).click(function(){
		$('#context').remove();
		$(window).contextmenu(function(e){
			e.preventDefault();
			context();
			return false;
		});
	});
	return false;
}
	
$(document).on('contextmenu', function(e){
	e = e || window.event;
	e.preventDefault();
	e.stopPropagation();
	
	context(e, 0);
	
	return false;
});

	$('.context_line').mouseover(function(){$(this).css({'border':'1px solid #daf7ff'});}); //,'text-shadow':''
	$('.context_line').mouseout(function(){$(this).css('border-color','transparent');});



 function link_context(e,t)
 {
  $('#context').remove();
  var $context_main;
   $context_main = '<div class=context id=context>\
    <div id=context_main>\
     <div class=context_line id=del_el>Удалить этот значок</div>\
     <div class=context_line id=copy_link>Копировать значок</div>\
     <div class=context_line id=rename>Переименовать</div>\
     <div class=context_line>Открыть</div>\
    </div>\
   </div>';

  var Tobj_id=t.id;
  $('#del_el').click(function(){$('#'+Tobj_id).remove();});

  $('body').append($context_main);
 // $('#del_note_'+t.id).click(function(){$('#'+t.id.slice(9)).remove();});

  $('#copy_link').click(function(){/*$link[$link.length][NAME]=$link[$link.length-3][NAME]; //нужно знать какой линк копируется */add_link($link.length);});

  e = e || window.event;
  var x = e.pageX || e.x;
  var y = e.pageY || e.y;
  $('.context').css({'left':x,'top':y});
  if (x+$('.context').width() > $(document).width()) $('.context').css('left',x-$('.context').width());
  if (y+$('.context').height() > $(document).height()) $('.context').css('top',y-$('.context').height());
  $('.context').fadeIn('slow');
  return false;

 }
