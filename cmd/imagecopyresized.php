<?
	/**
	 * Копирование и изменение размера части изображения
	 * @param resource $dst_image
	 * @param resource $src_image
	 * @param int $dst_x
	 * @param int $dst_y
	 * @param int $src_x
	 * @param int $src_y
	 * @param int $dst_w
	 * @param int $dst_h
	 * @param int $src_w
	 * @param int $src_h
	 * @return bool $status;
	 */
	if (imagecopyresized($dst_image, $src_image, $dst_x, $dst_y, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h )) {
		return 'Копирование и изменение размера части изображения успешно проведено';
	} else {
		return '<strong style="color:red">Копирование и изменение размера части изображения завершилось с ошибкой</strong>';
	} 