<style>
	.calcFrame {z-index:99;display:none;padding-left:5px}
	.cal-arrow {z-index:999;background-position:0 -383px;width:10px;height:17px;position:absolute;top:27%;left:-4px}
	.cal-close {display:block;position:absolute;right:5px;top:-10px;width:21px;height:21px;text-indent:-999px;background-position:0 -416px}
		.cal-close:hover {background-position:0 -437px}
.simplecalculator {width:200px;height:291px;position:relative}
	.simplecalculator .container {padding:6px;background:#e2e2e2;border:1px solid #ccc;margin:16px 16px 5px 5px;
		border-radius:3px;-webkit-border-radius:3px;-moz-border-radius:3px;
		box-shadow:1px 1px 3px #999;-webkit-box-shadow:1px 1px 3px #999;-moz-box-shadow:1px 1px 3px #999;
	}
	.simplecalculator .output {width:91%;text-align:right;margin-top: 5px;margin-bottom:10px;height:40px;background-color:#899d9b;font-size:1em;
		box-shadow:0 1px 0 #fff, 0 1px 3px #333 inset, 0 -15px 10px #666 inset, 0 0 0 #fff;
		-webkit-box-shadow:0 1px 0 #fff, 0 1px 3px #333 inset, 0 -15px 10px #666 inset, 0 0 0 #fff;
		-moz-box-shadow:0 1px 0 #fff, 0 1px 3px #333 inset, 0 -15px 10px #666 inset, 0 0 0 #fff;
		border-radius:5px;-webkit-border-radius:5px;-moz-border-radius:5px;
	}
	.simplecalculator input[type="button"]{border:1px solid #b6b6b6;border-bottom:1px solid #7a7a7a;width:30px;height:24px;padding-bottom:2px;margin:4px;font-weight:bold;text-shadow:0 -1px 0 #000;
			border-radius:3px;-webkit-border-radius:3px;-moz-border-radius:3px;
			background:#cbcbcb;/* Old browsers */
			background:-moz-linear-gradient(top,  #cbcbcb 0%, #b3b3b3 100%);/* FF3.6+ */
			background:-webkit-gradient(linear, left top, left bottom, color-stop(0%,#cbcbcb), color-stop(100%,#b3b3b3));/* Chrome,Safari4+ */
			background:-webkit-linear-gradient(top,  #cbcbcb 0%,#b3b3b3 100%);/* Chrome10+,Safari5.1+ */
			background:-o-linear-gradient(top,  #cbcbcb 0%,#b3b3b3 100%);/* Opera 11.10+ */
			background:-ms-linear-gradient(top,  #cbcbcb 0%,#b3b3b3 100%);/* IE10+ */
			background:linear-gradient(top,  #cbcbcb 0%,#b3b3b3 100%);/* W3C */
			/*filter:progid:DXImageTransform.Microsoft.gradient( startColorstr='#cbcbcb', endColorstr='#b3b3b3',GradientType=0 );*/ /* IE6-9 */
		}
		.simplecalculator input[disabled="disabled"]{
			background:#e2e2e2;
		}
	.simplecalculator input.operator{color:#fff;
			background:#7e7e7e;/* Old browsers */
			background:-moz-linear-gradient(top,  #7e7e7e 0%, #414141 100%);/* FF3.6+ */
			background:-webkit-gradient(linear, left top, left bottom, color-stop(0%,#7e7e7e), color-stop(100%,#414141));/* Chrome,Safari4+ */
			background:-webkit-linear-gradient(top,  #7e7e7e 0%,#414141 100%);/* Chrome10+,Safari5.1+ */
			background:-o-linear-gradient(top,  #7e7e7e 0%,#414141 100%);/* Opera 11.10+ */
			background:-ms-linear-gradient(top,  #7e7e7e 0%,#414141 100%);/* IE10+ */
			background:linear-gradient(top,  #7e7e7e 0%,#414141 100%);/* W3C */
			/*filter:progid:DXImageTransform.Microsoft.gradient( startColorstr='#7e7e7e', endColorstr='#414141',GradientType=0 );*/ /* IE6-9 */
		}
	.simplecalculator input.clear,.simplecalculator input.equal{color:#fff;
			background:#333333;/* Old browsers */
			background:-moz-linear-gradient(top,  #333333 0%, #1a1a1a 100%);/* FF3.6+ */
			background:-webkit-gradient(linear, left top, left bottom, color-stop(0%,#333333), color-stop(100%,#1a1a1a));/* Chrome,Safari4+ */
			background:-webkit-linear-gradient(top,  #333333 0%,#1a1a1a 100%);/* Chrome10+,Safari5.1+ */
			background:-o-linear-gradient(top,  #333333 0%,#1a1a1a 100%);/* Opera 11.10+ */
			background:-ms-linear-gradient(top,  #333333 0%,#1a1a1a 100%);/* IE10+ */
			background:linear-gradient(top,  #333333 0%,#1a1a1a 100%);/* W3C */
			/*filter:progid:DXImageTransform.Microsoft.gradient( startColorstr='#333333', endColorstr='#1a1a1a',GradientType=0 );*/ /* IE6-9 */
		}
	.simplecalculator input.zero{width:71px;}
	.simplecalculator input.equal{height:56px;float:right;margin-right:8px;}
	.simplecalculator input.number{text-shadow:0 1px 0 #fff;}
</style>

<script src="/js/adeptx/calc.js"></script>

<div class="calcFrame" id="calcFrame" style="width: 200px; height: 291px; overflow: hidden; display: block;">
	<div class="simplecalculator" style="left: 0px; display: block;">
		<div class="cal-arrow">
		</div>
		<form class="container" name="Calc">
			<input type="text" maxlength="16" name="Input" class="output">
			<input type="button" onclick="nextInput('C')" value="C" name="clear" class="clear">
			<input type="button" class="" value="" disabled="disabled" style="background: none; border: none; cursor: default;">
			<input type="button" onclick="nextInput('/')" value="÷" name="div" class="operator">
			<input type="button" onclick="nextInput('*')" value="x" name="times" class="operator">
			<input type="button" onclick="nextInput('7')" value="7" name="seven" class="number">
			<input type="button" onclick="nextInput('8')" value="8" name="eight" class="number">
			<input type="button" onclick="nextInput('9')" value="9" name="nine" class="number">
			<input type="button" onclick="nextInput('_')" value="-" name="minus" class="operator">
			<input type="button" onclick="nextInput('4')" value="4" name="four" class="number">
			<input type="button" onclick="nextInput('5')" value="5" name="five" class="number">
			<input type="button" onclick="nextInput('6')" value="6" name="six" class="number">
			<input type="button" onclick="nextInput('+')" value="+" name="plus" class="operator">
			<input type="button" onclick="nextInput('1')" value="1" name="one" class="number">
			<input type="button" onclick="nextInput('2')" value="2" name="two" class="number">
			<input type="button" onclick="nextInput('3')" value="3" name="three" class="number">
			<input type="button" onclick="nextInput('=')" value="=" name="DoIt" class="equal">
			<input type="button" onclick="nextInput('0')" value="0" name="zero" class="zero number">
			<input type="button" onclick="nextInput('.')" value="." name="decimal" class="number decimal">
		</form>
		<div class="cal-close">Close</div>
	</div>
</div>