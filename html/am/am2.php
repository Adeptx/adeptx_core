<!doctype html>
<html lang="<?=$page_language;?>">
 <head>
  <meta charset="<?=$page_charset;?>">
  <title><?=$page_title;?></title>
  <link rel="shortcut icon" type="image/x-icon" href="<?=$page_favicon;?>">
  <?foreach($javascript_files as $js_file)echo '<script type="text/javascript" src="'.$js_file.'"></script>';?>
  <script>/*xlang();*/</script>
  <?require 'css';?>

  <!--fm--title>Управление файлами: <?=(($_GET['f'])?$_GET['f']:(($_GET['show'])?$_GET['show']:($_GET['dir'])?$_GET['dir']:'просмотр главного каталога.'));?></title>
  <link rel="shortcut icon" type="image/x-icon" href="files/favicon.ico"-->
 </head>
 <body>
 
 <script src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
<script src="mouse.js"></script>
<script src="am_js.js"></script>
<title>'Создавай.';</title>

<?
 $elements_count = 19;

 $unit='
    <sel val=mm>миллиметров</sel>
    <sel val=cm>сантиметров</sel>
    <sel val=%>процентов</sel>
    <sel val=in>дюймов (2.54 см)</sel>
    <sel val=pt>пунктов (1/72 дюйма)</sel>
    <sel val=pc>пика (12 пунктов)</sel>
    <sel val=em>ширин символа "м"</sel>
    <sel val=ex>ширин символа "х"</sel>
 ';
 $unit_rows='<sel sel val=rows>строк</sel><sel val=px>пикселей</sel>'.$unit;
 $unit_cols='<sel sel val=cols>символов</sel><sel val=px>пикселей</sel>'.$unit;
 $unit='<sel sel val=px>пикселей</sel>'.$unit;

 $attr = array(
  'id'=>'Имя',
  'alt'=>'Альтернатива',
  'class'=>'Классы',
  'tabindex'=>'Следование',
  'accesskey'=>'Горячая клавиша',
  'contenteditable'=>'Редактируемость',
  'onclick'=>'Щелчёк мышью',
  'onmouseover'=>'Курсор над элементом',
  'onmouseout'=>'Курсор убрали'
 );

 $css = array(
  'position'=>'Позиционирование',
  'width'=>'Ширина',
  'height'=>'Высота',
  'margin'=>'Внешние отступы',
  'padding'=>'Внутренние отступы',
  'border-top'=>'Верхняя граница', 
  'border-right'=>'Правая граница',
  'border-bottom'=>'Нижняя граница',
  'border-left'=>'Левая граница',
  'font-family'=>'Семейство шрифтов',
  'font-style'=>'Стиль шрифта',
  'font-variant'=>'Начертание',
  'font-size'=>'Размер текста',
  'font-weight'=>'Насыщенность',
  'text-shadow'=>'Тени текста',
  'box-shadow'=>'Тени блока',
  'background'=>'Фон',
  'color'=>'Основной цвет',
  'border-color'=>'Цвет границ',
  'display'=>'Отображение',
  'z-index'=>'z координата',
  'left'=>'Слева',
  'right'=>'Справа',
  'top'=>'Сверху',
  'bottom'=>'Снизу'
 );

 /* Перечень всех элементов для создания */

 $el = array(
  'Документ',
  'Текст',
  'Блок',
  'Ссылка',
  'Изображение',
  'Поле ввода',
  'Таблица',
  'Плеер',
  'Холст',
  'Плагин',
  'Сторонний код',
  'Ползунок',
  'Кнопка',
  'Меню',
  'Пункт',
  'Окно',
  'Палитра',
  'Раздел страницы',
  'Фрейм',
 );

  $el1 = array(
  'Документ',
  '<span></span>',
  '<div></div>',
  '<a></a>',
  '<img>',
  '<input>',
  '<table></table>',
  'Плеер',
  '<canvas></canvas>',
  'Плагин',
  'Сторонний код',
  'Ползунок',
  '<input type=button>',
  'Меню',
  '<checkbox>',
  'Окно',
  'Палитра',
  'Раздел страницы',
  '<iframe></iframe>',
 );

 $el2 = array(
  'Основные параметры нового документа',
  'Основные параметры нового текста',
  'Основные параметры нового блока',
  'Основные параметры новой ссылки',
  'Основные параметры нового изображения',
  'Основные параметры нового поля',
  'Основные параметры новой таблицы',
  'Основные параметры нового плеера',
  'Основные параметры нового холста',
  'Основные параметры нового плагина',
  'Основные параметры нового кода',
  'Основные параметры нового ползунка',
  'Основные параметры новой кнопки',
  'Основные параметры нового меню',
  'Основные параметры нового пункта',
  'Основные параметры нового окна',
  'Основные параметры новой палитры',
  'Основные параметры нового раздела',
  'Основные параметры нового фрейма',
 );

 /* Параметры создающихся элементов */

 $el3 = array(
  array('Прочее'=>'<input>'),
  array(
   'Сам текст'=>'<input id=u1_am_submenu_fild_span_text>',
   'Вариант написания'=>'<add sel val=bold><b>Выделен</b></add> <add val=italic><i>Рукопись</i></add> <add val=underline><u>Подчёркнут</u></add> <add val=sroke><s>Зачёркнут</s></add>',
   'Высота символов'=>'<input type=number min=1 value=14 max=60>'.$unit,
   'Шрифт'=>'<list u1_am_new_text_attr=font-family>
     <unit sel>Times New Roman</unit>
     <unit>Arial</unit>
     <unit>Helvetica</unit>
     <unit>Geneva</unit>
     <unit>Georgia</unit>
     <unit>Times</unit>
     <unit>Courier</unit>
     <unit>Cursive</unit>
     <unit>Monospace</unit>
     <unit>Serif</unit>
     <unit>Sans-serif</unit>
     <unit>Fantasy</unit>
    </list>',
   'Начертание'=>'<add val=oblique>Наклонён</add> <add val=overline>Под чертой</add> <add val=blink>Мигает</add>',
   'Ссылка'=>'<input>',
   'Отступы'=>''
  ),
  array(
   'Высота'=>'<input type=number min=0 value=300>'.$unit,
   'Ширина'=>'<input type=number min=0 value=300>'.$unit
  ),
  array(
   'Текст ссылки'=>'<input id=u1_am_submenu_fild_a_text>',
   'Адрес'=>'<input id=u1_am_submenu_fild_a_href>',
   'Способ перехода'=>'<blank id=u1_am_submenu_fild_a_target><sel sel val=_blank>Открывать в новом окне</sel><sel val=_self>Открывать в этом окне</sel><sel val=_top>Открывать разрушая все фреймы</sel><sel val=_parent>Открывать во фрейм-родитель</sel></blank>'
  ),
  array(
   'Ссылка на изображение'=>'<input id=u1_am_submenu_fild_img_src>',
   'Высота'=>'<input type=number min=0 value=300>'.$unit,
   'Ширина'=>'<input type=number min=0 value=300>'.$unit,
   'Угол наклона'=>'<input type=number min=-360 value=0 max=360><sel sel val=degrees>градусов</sel><sel val=radians>радиан</sel>',
   'Положение'=>'<sel sel val=left>Слева</sel><sel val=center>По центру</sel><sel val=right>Справа</sel>'
  ),
  array(
   'Ширина'=>'<input type=number min=0 value=50>'.$unit_cols.'<sel val=cols>символов</sel>',
   'Высота'=>'<input type=number min=0 value=1>'.$unit_rows.'<sel val=rows>строк</sel>',
   'Максимум символов'=>'<input type=number min=0>'
  ),
  array('Прочее'=>'<input>'),
  array('Прочее'=>'<input>'),
  array('Прочее'=>'<input>'),
  array('Прочее'=>'<input>'),
  array('Прочее'=>'<input>'),
  array('Прочее'=>'<input>'),
  array(
   'Надпись на кнопке'=>'<input>',
   'Фоновое изображение'=>'<input>'
  ),
  array('Прочее'=>'<input>'),
  array('Прочее'=>'<input>'),
  array('Прочее'=>'<input>'),
  array('Прочее'=>'<input>'),
  array('Прочее'=>'<input>'),
  array('Прочее'=>'<input>')
 );

?>

  <div id=u1_am_el0 new>
   <h1 new>Это пример рабочего сайта.</h1>
   Редактируя и изменяя этот шаблон вы можете <a new target=_blank href=dinamic_link style="border-bottom:1px dashed #0ccfff;">создать свой сайт</a>.
   <div new></div><div new></div><div new></div>
  </div>

  <div u1_am_left_block>
   <div u1_am_block id=main>
    <div u1_am_block_name>Добавить элемент</div>
    <?for($element_number=0; $element_number<$elements_count; $element_number++){?>
     <div u1_am_line><?=$el[$element_number];?></div>
     <div u1_am_block u1_am_submenu u1_am_left174px u1_am_width348px>
      <table rules=none u1_am_width348px>
       <thead><div u1_am_block_name><?=$el2[$element_number];?></div></thead>
       <tbody>
        <?foreach($el3[$element_number] as $desc=>$fild)echo '<tr u1_am_width348px><td>',$desc,': </td><td u1_am_submenu_fild>',$fild,'</td></tr>';?>
       </tbody>
      </table>
     </div>
    <?}?>
   </div>
  </div>

  <div u1_am_right_block>
   <div u1_am_block id=u1_am_attr>

    <div u1_am_block_name>Изменить свойства</div>

    <div u1_am_line>Стиль элемента</div>
     <div u1_am_block u1_am_submenu u1_am_right174px u1_am_width348px>
      <div u1_am_block_name>Значения параметров</div>

      <table rules=cols>
      <tbody>
      <?foreach($css as $cs => $description)echo '<tr><td u1_am_submenu_description>',$description,': </td><td u1_am_submenu_fild><input u1_am_css_fild=',$cs,'></td></tr>';?>

      <?foreach($attr as $atr => $description)
       echo '<tr><td u1_am_submenu_description>',$description,': </td><td u1_am_submenu_fild><input u1_am_attr_fild=',$atr,'></td></tr>';?>
             <tr><td u1_am_submenu_description>Значение: </td><td u1_am_submenu_fild><input u1_am_attr_fild=text><!-select><option>Предыдущие вводы</option></select--></td></tr>
             <tr><td u1_am_submenu_description>Альтернатива: </td><td u1_am_submenu_fild><input u1_am_attr_fild=ttt><!--checkbox>Первый класс</checkbox><checkbox>Второй класс</checkbox><checkbox>... </checkbox--></td></tr>
      </tbody>
      </table>

     </div>

    <div u1_am_line>События</div>
     <div u1_am_block u1_am_submenu u1_am_right174px>
      <div u1_am_block_name>Выполнить</div>
      <table rules=cols>
      <tbody>
       <tr><td u1_am_submenu_description>Щелчок мышью по элементу: </td><td u1_am_submenu_fild><select><option>Алгоритм 1</option></select></td></tr>
       <tr><td u1_am_submenu_description>Курсор на элементе: </td><td u1_am_submenu_fild><select><option>Алгоритм 1</option></select></td></tr>
       <tr><td u1_am_submenu_description>Курсор уходит с элемента: </td><td u1_am_submenu_fild><select><option>Алгоритм 1</option></select></td></tr>
       <tr><td u1_am_submenu_description>Нажатие правок кнопки мыши: </td><td u1_am_submenu_fild><select><option>Алгоритм 1</option></select></td></tr>
      </tbody>
      </table>
     </div>

   </div>

  <div u1_am_right_block>
   <div u1_am_block id=u1_am_buttons>

    <div u1_am_block_name>Панель управления</div>
    <div u1_am_line u1_am_text_edit_button>Алгоритмы</div>
     <div u1_am_block u1_am_submenu u1_am_right174px>
      <div u1_am_block_name>Алгоритм</div>
      <div u1_am_algoritms_button=record>Записать действие</div>
      <div u1_am_algoritms_button=stop>Остановить запись</div>
      <div u1_am_algoritms_button=past>Вставить действие (пауза, пр.)</div>
      <div u1_am_algoritms_button=rename>Переименовать алгоритм</div>
     </div>

    <div u1_am_line u1_am_text_edit_button>Действия с элементами</div>
     <div u1_am_block u1_am_submenu u1_am_right174px>
      <div u1_am_block_name>С элементом сделать...</div>
      <div u1_am_text_edit_button=copy>Копировать элемент</div>
      <div u1_am_text_edit_button=remove>Удалить элемент</div>
     </div>

    <div u1_am_line u1_am_text_edit_button>Формат текста</div>
     <div u1_am_block u1_am_submenu u1_am_right174px>
      <div u1_am_block_name>Шрифт</div>
      <b><div u1_am_text_edit_button>Выделенный</div></b>
      <i><div u1_am_text_edit_button>Рукописный</div></i>
      <u><div u1_am_text_edit_button>Подчёркнутый</div></u>
      <s><div u1_am_text_edit_button>Зачёркнутый</div></s>
      <div u1_am_text_edit_button style="font-style:oblique;">Наклоненный</div>
      <div u1_am_text_edit_button style="text-decoration:overline;">Под чертой</div>
      <div u1_am_text_edit_button style="text-decoration:blink;">Мигающий</div>
      <div u1_am_text_edit_button style="text-align:left;">Слева</div>
      <div u1_am_text_edit_button>По центру</div>
      <div u1_am_text_edit_button style="text-align:justify;">По ширине</div>
      <div u1_am_text_edit_button style="text-align:right;">Справа</div>
     </div>

    <div u1_am_line u1_am_text_edit_button>Текущая страница</div>
     <div u1_am_block u1_am_submenu u1_am_right174px>
      <div u1_am_block_name>Действие над страницей</div>
      <a u1_am_page_edit_button=save target=_blank href=am_new_file.php>Сохранить новую версию и перейти</a>
      <div u1_am_page_edit_button=show>Просмотр предыдущей версии</div>
      <div u1_am_page_edit_button=copy>Копировать страницу</div>
      <div u1_am_page_edit_button=rename>Изменить адрес/переименовать</div>
      <div u1_am_page_edit_button=delete>Удалить страницу</div>
      <div u1_am_page_edit_button=delete>Создать новую страницу</div>
     </div>

    <div u1_am_line u1_am_text_edit_button> </div>

    </div>

   </div>
  </div>


<script>
 var $css=[ 
 <?foreach($css as $cs=>$desc)echo "'",$cs,"',";?>
 ''];$css.pop();

 var $attr=[<?foreach($attr as $atr=>$desc)echo "'",$atr,"',";?>''];$attr.pop();
</script>
