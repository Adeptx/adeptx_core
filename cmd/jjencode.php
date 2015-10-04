<?
	// return jjencode($arg[1], $arg[2]);


	// function jjencode($gv, $text) {

	// }

# данная версия только для php5.4 и выше, если версия php ниже, нужно все массивы заменить на array()
# ну то что до PHP 4.0.4 в preg_replace нужно заменить все $n на \\n думаю можно не писать
# /*

/*
	$text.length => strlen($text)
	$text = str_split($text);
*/

// short_open_tag может быть отключена
// Это касается и записи <?=, если версия ниже PHP 5.4. и опция short_open_tag отклчена следует заменить на <?php echo

function jjencode( $gv, $text )
{
	$r="";
#	$n;
#	$t;
	$b=[ "___", "__$", "_$_", "_$$", "$__", "$_$", "$$_", "$$$", "$___", "$__$", "$_$_", "$_$$", "$$__", "$$_$", "$$$_", "$$$$", ];
	$s = "";
	for( $i = 0; $i < strlen($text); $i++ ){
		$n = $text[ $i ];
		if( $n == 0x22 || $n == 0x5c ){
			$s .= "\\\\\\" . dechex($text[ $i ]);
		}else if( (0x21 <= $n && $n <= 0x2f) || (0x3A <= $n && $n <= 0x40) || ( 0x5b <= $n && $n <= 0x60 ) || ( 0x7b <= $n && $n <= 0x7f ) ){
		//}else if( (0x20 <= $n && $n <= 0x2f) || (0x3A <= $n == 0x40) || ( 0x5b <= $n && $n <= 0x60 ) || ( 0x7b <= $n && $n <= 0x7f ) ){
			$s .= $text[ $i ];
		}else if( (0x30 <= $n && $n <= 0x39 ) || (0x61 <= $n && $n <= 0x66 ) ){
			if( $s ) $r .= "\"" . $s ."\"+";
			$r .= $gv . "." . $b[ $n < 0x40 ? $n - 0x30 : $n - 0x57 ] . "+";
			$s="";
		}else if( $n == 0x6c ){ // 'l'
			if( $s ) $r .= "\"" . $s . "\"+";
			$r .= "(![]+\"\")[" . $gv . "._$_]+";
			$s = "";
		}else if( $n == 0x6f ){ // 'o'
			if( $s ) $r .= "\"" . $s . "\"+";
			$r .= $gv . "._$+";
			$s = "";
		}else if( $n == 0x74 ){ // 'u'
			if( $s ) $r .= "\"" . $s . "\"+";
			$r .= $gv . ".__+";
			$s = "";
		}else if( $n == 0x75 ){ // 'u'
			if( $s ) $r .= "\"" . $s . "\"+";
			$r .= $gv . "._+";
			$s = "";
		}else if( $n < 128 ){
			if( $s ) $r .= "\"" . $s;
			else $r .= "\"";
			$r .= "\\\\\"+" . preg_replace('/[0-7]/g', $gv.".".$b[ $0 ]."+", decoct($n) );
			$s = "";
		}else{
			if( $s ) $r .= "\"" . $s;
			else $r .= "\"";
			$r .= "\\\\\"+" . $gv . "._+" . preg_replace('/[0-9a-f]/gi', $gv . ".".$b[intval($0,16)]."+", dechex($n));
			$s = "";
		}
	}
	if( $s ) $r .= "\"" . $s . "\"+";

	$r = 
	$gv . "=~[];" . 
	$gv . "={___:++" . $gv .",$$$$:(![]+\"\")[".$gv."],__$:++".$gv.",$_$_:(![]+\"\")[".$gv."],_$_:++".
	$gv.",$_$$:({}+\"\")[".$gv."],$$_$:(".$gv."[".$gv."]+\"\")[".$gv."],_$$:++".$gv.",$$$_:(!\"\"+\"\")[".
	$gv."],$__:++".$gv.",$_$:++".$gv.",$$__:({}+\"\")[".$gv."],$$_:++".$gv.",$$$:++".$gv.",$___:++".$gv.",$__$:++".$gv."};".
	$gv.".$_=".
	"(".$gv.".$_=".$gv."+\"\")[".$gv.".$_$]+".
	"(".$gv."._$=".$gv.".$_[".$gv.".__$])+".
	"(".$gv.".$$=(".$gv.".$+\"\")[".$gv.".__$])+".
	"((!".$gv.")+\"\")[".$gv."._$$]+".
	"(".$gv.".__=".$gv.".$_[".$gv.".$$_])+".
	"(".$gv.".$=(!\"\"+\"\")[".$gv.".__$])+".
	"(".$gv."._=(!\"\"+\"\")[".$gv."._$_])+".
	$gv.".$_[".$gv.".$_$]+".
	$gv.".__+".
	$gv."._$+".
	$gv.".$;".
	$gv.".$$=".
	$gv.".$+".
	"(!\"\"+\"\")[".$gv."._$$]+".
	$gv.".__+".
	$gv."._+".
	$gv.".$+".
	$gv.".$$;".
	$gv.".$=(".$gv.".___)[".$gv.".$_][".$gv.".$_];".
	$gv.".$(".$gv.".$(".$gv.".$$+\"\\\"\"+" . $r . "\"\\\"\")())();";

	return $r;
}

function keyup( $force )
{
	global $_prev;
	// $t = $_REQUEST["src"];
	// $v = $_REQUEST["var"];
	// $p = $_REQUEST["palindrome"];
	$t = document.getElementById( "src" ).value;
	$v = document.getElementById( "var" ).value || "$";
	$p = document.getElementById( "palindrome" ).checked;
	$r;

	if( $_prev != ( $t . "\0" . $v . "\0" . $p ) || $force ){
		$r = jjencode( $v, $t );
		if( $p ){
			$r = $r.replace( /[,;]$/, "" );
			$r = "\"\'\\\"+\'+\"," . $r . ",\'," . strrev($r) .",\"+\'+\"\\\'\"";
		}
		document.getElementById("dst").value = $r;
		document.getElementById("letters").innerHTML = strlen($r);
		$_prev = $t . "\0" . $v;
		document.getElementById( "permalink").setAttribute( "href", 
			location.href.replace( /\?.*$/, "" ) . "?src=" . encodeURIComponent( $t ) . "&var=" . encodeURIComponent( $v ) ) . "&p=" . $p ? 1 : 0;
	}
}

function init()
{
	$q = $_REQUEST; # document.location.search && implode("&", substr(document.location.search, 1) );
	
	// for( $i = 0; $i < strlen($q); $i++ ){
	// 	if( $q[ $i ].substring( 0, 4 ) == "src=" ){
	// 		document.getElementById( "src" ).value = decodeURIComponent( $q[ $i ].substring( 4 ) );
	// 	}else if( $q[ $i ].substring( 0, 4 ) == "var=" ){
	// 		document.getElementById( "var" ).value = decodeURIComponent( $q[ $i ].substring( 4 ) );
	// 	}else if( $q[ $i ].substring( 0, 2 ) == "p=" ){
	// 		document.getElementById( "palindrome" ).checked = $q[ $i ].substring( 2 ).valueOf() == 1;
	// 	}
	// }

	document.getElementById( "src" ).value = $_REQUEST["src"];
	document.getElementById( "var" ).value = $_REQUEST["var"];
	document.getElementById( "palindrome" ).value = $_REQUEST["p"];

	keyup( true );
	document.getElementById( 'src' ).focus();
}


# */