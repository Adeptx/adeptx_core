<?php
	error_reporting(0);
	session_start();

	function pjencode( $var, $src )
	{
		$run=$s="";
		$b=[ "___", "__\$", "_\$_", "_\$\$", "\$__", "\$_\$", "\$\$_", "\$\$\$", "\$___", "\$__\$", "\$_\$_", "\$_\$\$", "\$\$__", "\$\$_\$", "\$\$\$_", "\$\$\$\$", ];
		$src = str_split($src);

		foreach ($src as $i => $src_sign){
			$n = ord($src_sign);
			// $n = htmlentities($src_sign, ENT_NOQUOTES, "utf-8");
			if( $n == 0x22 || $n == 0x5c ){
				$s .= "\\\\\\" . dechex($src_sign);
			} elseif( (0x21 <= $n && $n <= 0x2f) || (0x3A <= $n && $n <= 0x40) || ( 0x5b <= $n && $n <= 0x60 ) || ( 0x7b <= $n && $n <= 0x7f ) ){
			//} elseif( (0x20 <= $n && $n <= 0x2f) || (0x3A <= $n == 0x40) || ( 0x5b <= $n && $n <= 0x60 ) || ( 0x7b <= $n && $n <= 0x7f ) ){
				$s .= $src_sign;
			} elseif( (0x30 <= $n && $n <= 0x39 ) || (0x61 <= $n && $n <= 0x66 ) ){
				if( $s ) $run .= "\"" . $s ."\"+";
				$run .= $var . "." . $b[ $n < 0x40 ? $n - 0x30 : $n - 0x57 ] . "+";
				$s="";
			} elseif( $n == 0x6c ){ // 'l'
				if( $s ) $run .= "\"" . $s . "\"+";
				$run .= "(![]+\"\")[" . $var . "._\$_]+";
				$s = "";
			} elseif( $n == 0x6f ){ // 'o'
				if( $s ) $run .= "\"" . $s . "\"+";
				$run .= $var . "._\$+";
				$s = "";
			} elseif( $n == 0x74 ){ // 'u'
				if( $s ) $run .= "\"" . $s . "\"+";
				$run .= $var . ".__+";
				$s = "";
			} elseif( $n == 0x75 ){ // 'u'
				if( $s ) $run .= "\"" . $s . "\"+";
				$run .= $var . "._+";
				$s = "";
			} elseif( $n < 128 ){
				if( $s ) $run .= "\"" . $s;
				else $run .= "\"";
				$run .= "\\\\\"+";
				///
				$decoct = decoct($n);
				$decoct = str_split($decoct);
				foreach ($decoct as $oct) {
					$run .= $var.".".$b[ $oct ]."+";
				}
				///
				$s = "";
			}else{
				if( $s ) $run .= "\"" . $s;
				else $run .= "\"";
				///
				$run .= "\\\\\"+" . $var . "._+";
				$dechex = dechex($n);
				$dechex = str_split($dechex);
				foreach ($dechex as $hex) {
					$run .= $var . ".".$b[intval($hex,16)]."+";
				}
				///
				$s = "";
			}
		}
		if( $s ) $run .= "\"" . $s . "\"+";

		$encoded_text = 
		$var . "=~[];" . 
		$var . "={___:++" . $var .",\$\$\$\$:(![]+\"\")[".$var."],__\$:++".$var.",\$_\$_:(![]+\"\")[".$var."],_\$_:++".
		$var.",\$_\$\$:({}+\"\")[".$var."],\$\$_\$:(".$var."[".$var."]+\"\")[".$var."],_\$\$:++".$var.",\$\$\$_:(!\"\"+\"\")[".
		$var."],\$__:++".$var.",\$_\$:++".$var.",\$\$__:({}+\"\")[".$var."],\$\$_:++".$var.",\$\$\$:++".$var.",\$___:++".$var.",\$__\$:++".$var."};".
		$var.".\$_=".
		"(".$var.".\$_=".$var."+\"\")[".$var.".\$_\$]+".
		"(".$var."._\$=".$var.".\$_[".$var.".__\$])+".
		"(".$var.".\$\$=(".$var.".\$+\"\")[".$var.".__\$])+".
		"((!".$var.")+\"\")[".$var."._\$\$]+".
		"(".$var.".__=".$var.".\$_[".$var.".\$\$_])+".
		"(".$var.".\$=(!\"\"+\"\")[".$var.".__\$])+".
		"(".$var."._=(!\"\"+\"\")[".$var."._\$_])+".
		$var.".\$_[".$var.".\$_\$]+".
		$var.".__+".
		$var."._\$+".
		$var.".\$;".
		$var.".\$\$=".
		$var.".\$+".
		"(!\"\"+\"\")[".$var."._\$\$]+".
		$var.".__+".
		$var."._+".
		$var.".\$+".
		$var.".\$\$;".
		$var.".\$=(".$var.".___)[".$var.".\$_][".$var.".\$_];".
		$var.".\$(".$var.".\$(".$var.".\$\$+\"\\\"\"+" . $run . "\"\\\"\")())();";
		$encoded_text = str_replace('\0', '\"', $encoded_text);

		return $encoded_text;
	}

	function keyup($force) {
		$src = $_REQUEST["src"];
		$var = $_REQUEST["var"];
		$palindrome = $_REQUEST["palindrome"];

		if( $_SESSION["module"]["pjencode"]["_prev"] != ( $src . "\0" . $var . "\0" . $palindrome ) || $force ){
			$r = pjencode( $var, $src );
			if( $palindrome ){
				$r = preg_replace('/[,;]$/', '', $r);
				$r = "\"\'\\\"+\'+\"," . $r . ",\'," . strrev($r) .",\"+\'+\"\\\'\"";
			}
			$echo["dst"] = $r;
			$echo["letters"] = strlen($r);
			# баг с недописыванием значения чекбокса permalink
			$echo["get"] = "?src=" . urldecode($src) . "&var=" . urldecode($var) . "&palindrome=" . ($palindrome ? 1 : 0);

			$_SESSION["module"]["pjencode"]["_prev"] = $src . "\0" . $var;
			exit(JSON_encode($echo));
		}
	}

	if (isset($_REQUEST["run"]) && $_REQUEST["run"] == "keyup") {
		keyup($_REQUEST["force"]);
	}
?>
<!doctype html>
<html lang="en">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="Content-Language" content="en" />
	<meta http-equiv="Content-Style-Type" content="text/css" />
	<meta http-equiv="Content-Script-Type" content="text/javascript" />
	<title>pjencode - Encode any JavaScript program using only symbols</title>
	<script type="text/javascript" src="jquery-2.1.4.min.js"></script><!-- только для .ajax запроса -->
	<link rel="shortcut icon" href="/favicon.png">
<script type="text/javascript">
function keyup( $force )
{
	$.ajax({
		type: "post",
		dataType: "json",
		data: {
			"run": "keyup",
			"force": $force,
			"src": document.getElementById( "src" ).value,
			"var": document.getElementById( "var" ).value || "$",
			"palindrome": ( document.getElementById( "palindrome" ).checked ) ? 1 : 0
		},
		success: function(answr) {
			document.getElementById("dst").value = answr.dst;
			document.getElementById("letters").innerHTML = answr.letters;
			document.getElementById("permalink").setAttribute( "href", 
				location.href.replace( /\?.*$/, '' ) + answr.get );
		},
		error: function(e) {
			console.error('connection error: ' + e);
		}
	});
}
</script>
</head>
<body style="width:60%; background-color:#e0e0e0;" onload="keyup(1)">
<div>
<h1 style="font-size:120%;font-weight:bold">pjencode demo
	<span data-button="hatena-bookmark"></span>
	<span data-button="tweet"></span>
</h1>
Enter any JavaScript source:<br />
<textarea style="width:100%;height:5em" id="src" onkeyup="keyup(0)" cols="" rows="" autofocus><?=(isset($_REQUEST["src"])?$_REQUEST["src"]:'alert("Hello, PHP Encoder" )');
?></textarea>
</div>
<div>
<label for="var">global variable name used by pjencode: </label>
<input type="text" id="var" value="<?=isset($_REQUEST["var"])?$_REQUEST["var"]:'$';?>" onkeyup="keyup(0)" />

<input type="checkbox" id="palindrome" onclick="keyup(0)" <?=(isset($_REQUEST["palindrome"]) && $_REQUEST["palindrome"])?'checked':'';?> />
<label for="palindrome">palindrome</label>

</div>
<div style="text-align:right">
	<input type="button" value="pjencode" onclick="keyup(1)" />
</div>
<div>
<textarea style="width:100%;height:20em" id="dst" rows="" cols="" ></textarea>
</div>
<div>
	<span id="letters">0</span> letters
</div>
<div style="text-align:right">
	<input type="button" value=" eval " onclick="eval(document.getElementById('dst').value)" />
	[ <a href="" id="permalink">Permalink</a> ]
</div>
<div style="text-align:right;margin-top:2em;padding-top:0.5em;border-top:solid 1px black">[<a href="http://adeptx.tk/">adeptx.tk/</a>]
</div>
</body>
</html>

