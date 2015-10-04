<?
  class img {

    function thumbnails($width, $height, $method="resize") {
      // функция для создания миниатюр группы изображений (например, фотографий товаров)
      // $method указывает на то, каким образом будет создаваться миниатюра
      // resize -- фотографии будут вгонятся в заданные размеры, что может повлечь искажение пропорций
      // crop -- фотографии обрежутся до заданного размера (полезно для миниатюр фотографий профилей)
      // smart -- фотография пропорционально уменьшается до заданных размеров, пока хотя бы одна из сторон не станео равной одному из размеров, затем у второй стороны обрезается лишнее
      // в папке группы изображений создается папка с именем WxH (напр. 30x30) и туда помешаются соответсвующие миниатюры всей группы, откуда их потом можно использовать

    }
	/*
	$x_o и $y_o - координаты левого верхнего угла выходного изображения на исходном
	$w_o и h_o - ширина и высота выходного изображения
	*/
	function crop($image, $x_o, $y_o, $w_o, $h_o) {
	// call: crop($img['tmp_name'], 0, 0, 400, 400);
		if (($x_o < 0) || ($y_o < 0) || ($w_o < 0) || ($h_o < 0)) {
			echo "Некорректные входные параметры";
			return false;
		}
		list($w_i, $h_i, $type) = getimagesize($image); // Получаем размеры и тип изображения (число)
		$types = array("", "gif", "jpeg", "png");
		$ext = $types[$type]; // Зная "числовой" тип изображения, узнаём название типа
		if ($ext) {
			$func = 'imagecreatefrom'.$ext; // Получаем название функции, соответствующую типу, для создания изображения
			$img_i = $func($image); // Создаём дескриптор для работы с исходным изображением
		} else {
			echo 'Некорректный формат изображения';
			return false;
		}
		if ($x_o + $w_o > $w_i) $w_o = $w_i - $x_o; // Если ширина выходного изображения больше исходного (с учётом x_o), то уменьшаем её
		if ($y_o + $h_o > $h_i) $h_o = $h_i - $y_o; // Если высота выходного изображения больше исходного (с учётом y_o), то уменьшаем её
		$img_o = imagecreatetruecolor($w_o, $h_o); // Создаём дескриптор для выходного изображения
		imagecopy($img_o, $img_i, 0, 0, $x_o, $y_o, $w_o, $h_o); // Переносим часть изображения из исходного в выходное
		$func = 'image'.$ext; // Получаем функция для сохранения результата
		return $func($img_o, $image); // Сохраняем изображение в тот же файл, что и исходное, возвращая результат этой операции
	}

	# $w_o и h_o - ширина и высота выходного изображения
	function resize($image, $w_o = false, $h_o = false) {
		if (($w_o < 0) || ($h_o < 0)) {
			echo "Некорректные входные параметры";
			return false;
		}
		list($w_i, $h_i, $type) = getimagesize($image); // Получаем размеры и тип изображения (число)
		$types = array("", "gif", "jpeg", "png");
		$ext = $types[$type]; // Зная "числовой" тип изображения, узнаём название типа
		if ($ext) {
			$func = 'imagecreatefrom'.$ext; // Получаем название функции, соответствующую типу, для создания изображения
			$img_i = $func($image); // Создаём дескриптор для работы с исходным изображением
		} else {
			echo 'Некорректный формат изображения';
			return false;
		}
		/* Если указать только 1 параметр, то второй подстроится пропорционально */
		if (!$h_o) $h_o = $w_o / ($w_i / $h_i);
		if (!$w_o) $w_o = $h_o / ($h_i / $w_i);
		$img_o = imagecreatetruecolor($w_o, $h_o); // Создаём дескриптор для выходного изображения
		imagecopyresampled($img_o, $img_i, 0, 0, 0, 0, $w_o, $h_o, $w_i, $h_i); // Переносим изображение из исходного в выходное, масштабируя его
		$func = 'image'.$ext; // Получаем функция для сохранения результата
		return $func($img_o, $image); // Сохраняем изображение в тот же файл, что и исходное, возвращая результат этой операции
	}
	/* Вызываем функцию с целью уменьшить изображение до ширины в 100 пикселей, а высоту уменьшив пропорционально, чтобы не искажать изображение */
}