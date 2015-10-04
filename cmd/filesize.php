<?php
	# Выводит размер файла в удобном масштабированном представлении
	# Замечание: Так как тип integer в PHP является целым числом со знаком и многие платформы используют 32-х битные целые числа, то некоторые функции файловых систем могут возвращать неожиданные результаты для файлов размером больше 2ГБ.
	# Результат работы функции кешируется PHP, для очистки кеша нужно вызвать php функцию clearstatcache()
	
	return filesize($arg[1], $arg[2]);
	function filesize($bytes, $decimals = 2) {
	  $sz = 'BKMGTP';
	  $factor = floor((strlen($bytes) - 1) / 3);
	  return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$sz[$factor];
	}

	# for file more than 2Gb use this one:

	/**
   * Get the size of file, platform- and architecture-independant.
   * This function supports 32bit and 64bit architectures and works fith large files > 2 GB
   * The return value type depends on platform/architecture: (float) when PHP_INT_SIZE < 8 or (int) otherwise
   * @param   resource $fp
   * @return  mixed (int|float) File size on success or (bool) FALSE on error
   */
  // function my_filesize($fp) {
  //   $return = false;
  //   if (is_resource($fp)) {
  //     if (PHP_INT_SIZE < 8) {
  //       // 32bit
  //       if (0 === fseek($fp, 0, SEEK_END)) {
  //         $return = 0.0;
  //         $step = 0x7FFFFFFF;
  //         while ($step > 0) {
  //           if (0 === fseek($fp, - $step, SEEK_CUR)) {
  //             $return += floatval($step);
  //           } else {
  //             $step >>= 1;
  //           }
  //         }
  //       }
  //     } elseif (0 === fseek($fp, 0, SEEK_END)) {
  //       // 64bit
  //       $return = ftell($fp);
  //     }
  //   }
  //   return $return;
  // }

    # for remote files use this one:

//   function remote_filesize($url) {
//     static $regex = '/^Content-Length: *+\K\d++$/im';
//     if (!$fp = @fopen($url, 'rb')) {
//         return false;
//     }
//     if (
//         isset($http_response_header) &&
//         preg_match($regex, implode("\n", $http_response_header), $matches)
//     ) {
//         return (int)$matches[0];
//     }
//     return strlen(stream_get_contents($fp));
// }