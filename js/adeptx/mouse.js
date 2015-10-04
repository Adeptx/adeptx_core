function mouse(el, act, axis){	// position must be absolute
	var x, y, e = window.event, x0 = e.pageX || e.x, y0 = e.pageY || e.y;

	if (act == 'move') {
		x = el.offset().left;
		y = el.offset().top;
	}
	if (act == 'resize') {
		x = el.width();
		y = el.height();
	}

	document.onmousemove = function(e){
		e = e || window.event;
		var x1 = e.pageX || e.x, y1 = e.pageY || e.y;

		if (act == 'move') {
			if (x1 >= 0  && axis != 'y') el.css('left',	(x1 - x0 + x) + 'px');	// - margin ?
			if (y1 >= 30 && axis != 'x') el.css('top',	(y1 - y0 + y) + 'px');
		}

		if (act == 'resize') {
			if (x1 >= 0 && axis != 'y') el.css('width',		(x1 - x0 + x ) + 'px');
			if (y1 >= 0 && axis != 'x') el.css('height',	(y1 - y0 + y ) + 'px');
		}
	};
	document.onmouseup = function(){
		document.onmousemove = null;
		if (axis == 'up') {				 // сброс
			el.css('left', x);
			el.css('top', y);
		}
		
		if (el.offset().left	<	0)	el.css('left',	0	+ 'px');
		if (el.offset().top		<	30)	el.css('top',	30	+ 'px');
		document.onmouseup = null;
	};
}


/*
function mouse_old_without_all(myEvent,el,conf) {
  //xc=$('.content').width(),  // менять можно только у окна
  //yc=$('.content').height();
 document.onmousemove=function(e) { //document.ondragstart
  //$('.content').css({'width':(xc+x1-x0)+'px','height':(yc+x1-x0)+'px'});
  //$('.frame').css('line-height',($('.frame').height()-40)+'px');
  //onevent(myEvent,el);
  // return false;
 };
 //document.onmouseup=function(){document.onmousemove=null;
 //onevent(myEvent,el);
 };
}
*/












// Drag & Drop
/*


		// jQuery убирает у объектов событий "лишние" свойства, поэтому, если мы хотим использовать HTML5
// примочки вместе с jQuery, нужно включить для событий свойство dataTransfer.
jQuery.event.props.push('dataTransfer');

// И еще парочку.
jQuery.event.props.push('pageX');
jQuery.event.props.push('pageY');
		
		$('.draggable').on('click', function(e) {
        e.preventDefault();
        this.draggable = true;
    }).on('dragstart', function(e) {
        var html = '',
            // находим все выделенные элементы,
            $selectedItems = $('.items .selected');
        // собираем HTML выделенных элементов.
        $selectedItems.each(function() {
            html += this.outerHTML;
        });
        // Устанавливаем собранный HTML в качестве данных для перетаскивания.
        // Это никак не влияет на визуальную часть.
        e.dataTransfer.setData('text/html', html);

        return true;
    }).on('dragend', function(e) {
        resetUI();
    });
*/