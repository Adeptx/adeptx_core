 var $count = 0,selected_el,selected_element,record=0,$elements_parametrs='',$changed_style=[],$changed_attr;
 for(i=0;i<100;i++)$changed_style[i]=[];

 var desc=[];

 desc['Блок' /* (прямоугольник/овал) */] = '<div new>Блок - это контейнер, в который вы можете поместить другие объекты или ввести текст. Он служит для управления расположением и видом вложенных элементов.</div>';
 desc['Ссылка'] = '<a href="javascript:" target=_blank contentEditable=false>Ссылка - это текст или другие вложенные элементы, нажатие по которым приводит к переходу на указанную страницу в интернете.<br>Переда вами - типичная текстовая ссылка. Нажатие по этому тексту пока что оставляет вас на текущей странице без её обновления.</a>';
 desc['Изображение' /* (презентация) */] = '<img new src=http://kxcad.net/autodesk/3ds_max/autodesk_3ds_max_9_reference/graphics/il_advtransp_filter.jpg>';
 desc['Поле ввода' /* (строка/текст) */] = '<textarea new value="Поле ввода текстa."></textarea>';
 desc['Таблица'] = '<table class=Fnew_el contentEditable=true><tr><td>Таблица</td><td>разделяет</td><td>элементы.</td><td></td></tr><tr><td>Каждому</td><td>отводится</td><td>определённое</td><td>место.</td></tr><tr><td>Ширина</td><td>строк</td><td>одинакова</td><td>в столбце.</td></tr><tr><td>Высота</td><td>рядов</td><td>одинакова</td><td>в строке.</td></tr><tr><td>Очень</td><td>удобно</td><td>для громоздких</td><td>данных.</td></tr></table>';
 desc['Плеер' /*  (музыка/видео) */] = 'Устанавливайте на свои страницы любой аудио или видео плеер на ваш вкус. Вы можете как угодно изменять его.';
 desc['Холст' /* (схемы/графики) */] = 'Разместив холст на своей странице вы можете выводить на него изображение алгоритмами либо позволить посетителям сделать это.';
 desc['Плагин'] = 'Плагин - это рабочий элемент который создан для того чтобы работать на разных страницах. Например, вы можете не писать свой календарь, а разместить уже готовый.';
 desc['Сторонний код' /* (или свой) */] = 'Вы можете подключить к своей странице уже существующий код.';
 desc['Текст' /* (стилевой/обычный) */] = '<span new contentEditable=true>Вводите текст прямо в это поле и меняйте его шрифт.</span>';
 desc['Кнопка'] = '<input class=Fnew_el type=button value="Кнопка - указывает куда нажать, чтоб запустить обработчик.">';
 desc['Ползунок (полоса загрузки)'] = '';
 desc['Меню (всплывающее/подсказка/список)'] = '';
 desc['Пункт (галочка/радио)'] = '';
 desc['Окно (алерт/обзор/внутреннее)'] = '';
 desc['Палитра'] = '';
 desc['Раздел страницы (блок)'] = '';
 desc['Фрейм (просмотр страницы)'] = '';
 desc['Эллипс '] = 'Эллипс - элемент, такой же как и другие (блок, изображение), но принимает произвольную форму (круг, овал).';









 $('#alg .name ~ div').mouseover(function()
 {
  $('#sub_menu').remove();
  $('#r').append('<div id=sub_menu class=block><div class=name>Подменю</div><div>Пункт1</div><div>Пункт2</div><div>Пункт3</div></div>');
  $('#sub_menu .name').text(this.innerHTML);
  $('#sub_menu').css({'top':$(this).offset().top-18+'px'});
 });




$('[u1_am_text_edit_button="remove"]').click(function(){$(selected_element).remove();});


/*
$('[u1_am_text_edit_button="copy"]').click(function(){

   $count++;
   $('#u1_p1_el0').append($(selected_element).html());
   $('[new]:last').attr('id','u1_p1_el'+$count);
   $('[new]:last').click(function(e){sel_el(e,this);});
   $('[new]:last').mousedown( function(){mouse( 'move', $(this) );} );

   //$.each( $css,function(i,el){$('[new]:last').css(el,$(selected_element).css(el));} );

  
   //$.each( $attr, function(i,el){$('[u1_am_attr_fild="'+el+'"]').attr('value',$(t).attr(el));} );
   //$('[u1_am_attr_fild="text"]').attr('value',$(t).html());

   //$(selected_element).css($(this).attr('u1_am_css_fild'),$(this).attr('value'));
   //$(selected_element).attr($(this).attr('u1_am_attr_fild'),$(this).attr('value'));
   //$(selected_element).html($(this).attr('value'));});
});
*/

/* Запись алгоритма */

$('[u1_am_algoritms_button="record"]').click(function(){record=1;});

/* Конец записи алгоритма */

$('[u1_am_algoritms_button="stop"]').click(function(){record=0;});

/* Сохранение страницы */

$('[u1_am_page_edit_button="save"]').click(function()
{
 $elements_parametrs='<style>#u1_p1_el0{position:absolute;top:20px;left:260px;width:500px;height:50%;background-color:#e3e7ee;color:#357;border:3px double #aaa;}';

 for($i=1;$i<=$count;$i++)
 {
  $elements_parametrs+='#u1_p1_el'+$i+'{';
  $.each( $css,function(i,css){$elements_parametrs+=css+':'+$('#u1_p1_el'+$i).css(css)+';';});
  $elements_parametrs+='}';
 }
 $elements_parametrs+='</style>';

 //$elements_parametrs+=document.getElementById('#u1_p1_el0').outerHTML;
 //for($i=1;$i<=$count;$i++) $elements_parametrs+=document.getElementById('#u1_p1_el'+$i).outerHTML;
 xchange($elements_parametrs);
});

/* Работа меню-подменю */

 $('[u1_am_line]').mouseover(function(){$('[u1_am_submenu]').css({'display':'none'});$(this).next().css({'display':'block','top':$(this).offset().top-1});});
 $('#u1_p1_el0').click(function(e){$('[u1_am_submenu]').css({'display':'none'});});

/* Изменение элемента через правый блок */

$('[u1_am_css_fild]').change(function(){$(selected_element).css($(this).attr('u1_am_css_fild'),$(this).attr('value'));});
$('[u1_am_attr_fild]').change(function(){$(selected_element).attr($(this).attr('u1_am_attr_fild'),$(this).attr('value'));});
$('[u1_am_attr_fild="text"]').change(function(){$(selected_element).html($(this).attr('value'));});

//$changed_style,$changed_attr

/* Создание элемента */

 $('[u1_am_line]').click(function(e)
 {
  $('[u1_am_submenu]').css({'display':'none'});

  e=e||window.event;                                                             //e.stopPropagation();el=e.target||e.srcElement;
  el=this;

    if(this.innerHTML=='Текст')
    {   //#u1_p1_el0 / .obj_select:last
     $('#u1_p1_el0').html($('#u1_p1_el0').html()+'<span new>'+$('#u1_am_submenu_fild_span_text').attr('value')+'</span>');
    }
/*
    if(this.innerHTML=='Ссылка')
    {
     $('#u1_p1_el0').append('<a new target='+$('#u1_am_submenu_fild_a_target').children('[sel]').attr('val')+' href='+$('#u1_am_submenu_fild_a_href').attr('value')+'>'+$('#u1_am_submenu_fild_a_text').attr('value')+'</a>');
    }
    if(this.innerHTML=='Изображение')
    {
     $('#u1_p1_el0').append('<img new src='+$('#u1_am_submenu_fild_img_src').attr('value')+'>');
     //$('[new]:last).css('width',$(this).next().children('input').attr('value'));
    }
*/

  $('[new]:last').attr('id','u1_p1_el1'+$count);
  $('[new]:last').click(function(e){sel_el(e,this);});
  $('[new]:last').mousedown( function(){mouse( 'move', $(this) );} );
 });


/*
 $('[u1_am_line]').click(function(e)
 { 
  //$('[u1_am_submenu]').css({'display':'none'});

  e=e||window.event;
  //e.stopPropagation();
  //el=e.target||e.srcElement;
  el=this;

  //$count++;
   if(!record)       // не для записи - для создания
   {
    $('.obj_select:last').append(desc[el.innerText]);  // obj_select

    if(this.innerHTML=='Текст')
    {   //#u1_p1_el0 / .obj_select:last
     //$('.obj_select:last').removeAttr('new');
     $('.obj_select:last').append('<span new id=u1_p1_el'+$count+'>'+$('#u1_am_submenu_fild_span_text').attr('value')+'</span>');

     //$('#u1_p1_el'+$count).css('font-style',$('[u1_am_new_text_attr="font-style"]').children('[selected]').attr('value'));
     //$('#u1_p1_el'+$count).css('font-size',$('[u1_am_new_text_attr="font-size"]').attr('value')+$('[u1_am_new_text_attr="font-size-unit"]').children('[selected]').attr('value'));
     //$('[new]:last').click(function(e){sel_el(e,this);});

     //$('#code').attr('value','<span style="font-style:'+$('#u1_p1_el'+$count).css('font-style')+'">'+$('[u1_am_new_text_attr="text"]').attr('value')+'</span>');

     //$('#code').attr('value',$('#code').attr('value'+document.getElementById('u1_p1_el'+$count).outerHTML);
     //$.each( $css,function(i,el){$('#code').attr('value',$('#code').attr('value')+el+':'+$(element).css(el))+';';} );
     //$.each( $attr, function(i,el){$('#code').attr('value',$('#code').attr('value')+' '+el+'="'+$(element).attr(el))+'"';} );
    }

    if(this.innerHTML=='Ссылка')
    {
     $('#u1_p1_el0').append('<a new target='+$('#u1_am_submenu_fild_a_target').children('[sel]').attr('val')+' href='+$('#u1_am_submenu_fild_a_href').attr('value')+'>'+$('#u1_am_submenu_fild_a_text').attr('value')+'</a>');
    }

    if(this.innerHTML=='Изображение')
    {
     $('#u1_p1_el0').append('<img new src='+$('#u1_am_submenu_fild_img_src').attr('value')+'>');
     //$('[new]:last).css('width',$(this).next().children('input').attr('value'));
    }



    var imgy = document.createElement('img');
    imgy.new = '';
    imgy.width='200px';
    imgy.src='http://kxcad.net/autodesk/3ds_max/autodesk_3ds_max_9_reference/graphics/il_advtransp_filter.jpg';

    //$('[new]:last').attr('id','u1_p1_el'+$count);
    //$('[new]:last').click(function(e){sel_el(e,this);});
    //$('[new]:last').mousedown( function(){mouse( 'move', $(this) );} );
   }
   else              // запись действия для алгоритма
   {
    $('#u1_p1_el0').append(desc[el.innerText]);
    $('[new]:last').attr('id','u1_p1_el'+$count);
    $('#u1_p1_el'+$count).attr('value',$(el).next().text());
    $('[new]:last').click(function(e){sel_el(e,this);});
   }
 });
*/
/* Выбор элемента */

function sel_el(e,t)
{
 selected_element=$(t);
 $('.del_el,.muv_el,.siz_el').remove();
 $('[new]').removeClass('obj_select');
 $(t).append('<div class=muv_el></div><div class=siz_el></div>').addClass('obj_select');
 if(t!='#u1_p1_el0')$(t).append('<div class=del_el></div>');
 $('.del_el:last').click(function(e){$(t)/*.parent()*/.remove();$.each( $css,function(i,el){$('[u1_am_css_fild="'+el+'"]').attr('value','');} );});
 $('.muv_el:last').mousedown( function(){mouse( 'move',  $(t) );} );
 $('.siz_el:last').mousedown( function(){mouse( 'resize',$(t)/*.parent()*/ );} );
 e=e||window.event;
 e.stopPropagation();

 // $('[u1_am_css_fild]').attr('u1_am_css_fild')

 /* Заполнение полей параметров элемента */

 $.each( $css,function(i,css){$('[u1_am_css_fild="'+css+'"]').attr('value',$(t).css(css));} );
 $.each( $attr, function(i,attr){$('[u1_am_attr_fild="'+attr+'"]').attr('value',$(t).attr(attr));} );
 $('[u1_am_attr_fild="text"]').attr('value',$(t).html());

 return false;
}

$('[new]').click(function(e)
{
 $(this).removeClass('obj_select');
 sel_el(e,this);
});

/* Выбор одного элемента из списка */

$('sel').click(function()
{
 $(this).removeAttr('sel');
 $(this).next().attr('sel','');
 $(this).appendTo($(this).parent());
});

/* Выбор одного элемента из длинного перечня */

$('unit').click(function()
{
 if($(this).attr('sel')=='')
 {
  $(this).parent().children().css('display','block');
 }
 else
 {
  $(this).parent().children().removeAttr('sel');
  $(this).parent().children().css('display','none');
  $(this).attr('sel','').css('display','block');
 }
});

/* Выбор нескольких элементов из списка */

$('add').click(function()
{
 if($(this).attr('sel')=='')$(this).removeAttr('sel');
 else $(this).attr('sel','');
});
