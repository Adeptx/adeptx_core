function mouse(myEvent,el,conf) /* грубо говоря - все эти мувы, резайзы - одно и тоже, с разными параметрами (пора объединить всё под одной функцией) */
{
 var
  x,y,
  e=window.event,
  x0=e.pageX||e.x,
  y0=e.pageY||e.y;

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