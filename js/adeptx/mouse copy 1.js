function mouse(el, act){	// position must be absolute
	var x, y, e = window.event, x0 = e.pageX || e.x, y0 = e.pageY || e.y;

	if (act == 'resize') {
		x = el.width();
		y = el.height();
	}
	if (act == 'move') {
		x = el.offset().left;
		y = el.offset().top;
	}

	document.onmousemove = function(e){
		e = e || window.event;
		var x1 = e.pageX || e.x, y1 = e.pageY || e.y;

		if (x1>=0) el.css('left', x1 - x0 + x);
		if (y1>=0) el.css('top', y1 - y0 + y);
	};
	document.onmouseup = function(){
		document.onmousemove = null;
		document.onmouseup = null;
	};
}



function mouse(myEvent,el,conf)
{
 if(myEvent=='resize'){x=el.width();      y=el.height();}
 if(myEvent=='move')  {x=el.offset().left;y=el.offset().top;}

  //xc=$('.content').width(),  /* менять можно только у окна */
  //yc=$('.content').height();

 document.onmousemove=function(e) /*document.ondragstart*/
 {
  e = e || window.event;
  var x1=e.pageX||e.x;
  var y1=e.pageY||e.y;

  if(myEvent=='move')
  {
   if (x1>=0) el.css('left',x1-x0+x - $(el).css('margin'));
   if (y1>=0/* && con!='x'*/) el.css('top',y1-y0+y);
  }
  if(myEvent=='resize')el.css({'width':(x1-x0+x)+'px','height':(y1-y0+y)+'px'});

  //$('.content').css({'width':(xc+x1-x0)+'px','height':(yc+x1-x0)+'px'});
  //$('.frame').css('line-height',($('.frame').height()-40)+'px');
  //onevent(myEvent,el);
  /* return false;*/
 };
 //document.onmouseup=function(){document.onmousemove=null;/*onevent(myEvent,el);*/};

 document.onmouseup=function()
 {
  document.onmousemove=null;
  if(myEvent=='move'&&conf=='up')if(1)el.css('left',x); // если выполнено условие - либо на новое место, либо обратно
  if(myEvent=='move'&&conf=='up')if(1)el.css('top',y);
  document.onmouseup=null;
 };
}













// Drag & Drop



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