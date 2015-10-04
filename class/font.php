<?
	class font {
		function import($url) {
			echo "@import url($url);";
		}
		function face($dir, $family, $font) {
			echo "
				@font-face {
					font-family: '$family';
					src: url('../../font/$dir/$font.eot');
					src: local('☺'), url('../../font/$dir/$font.woff') format('woff'), url('../../font/$dir/$font.ttf') format('truetype'), url('../../font/$dir/$font.svg') format('svg');
					font-weight: normal;
					font-style: normal;
				}
			";
		}
	}