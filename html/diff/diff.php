<style>
td{
	font-size:12px;
}
tr.changed{
	background-color:yellow;
}
legend{
	font-size:70%;
}
dt { 
  width:200px;
  font-style: italic; 
}
dt { float:left;
}
.options,.method{
  margin-bottom:10px;
  padding:5px;
  border:1px dotted grey;
  background-color:#dddddd;
}
#out{
  margin-bottom:20px;
}
form {
  border:1px dotted grey;
  padding:10px;
   background-color:#eeeeee;
}
input.button{
  background-color:#ffffff;
  border:1px solid black;
  font-style: italic; 
  font-size:90%;
}
.to_submit{
  margin-top:5px;
  text-align:right;
}
textarea{
	width:500px;
	height:270px;
	font-size:88%;
}
del{
	background-color:#00FF00;
}
.output{
	font-family:Courier;
}
#how_to_use{
	display:none;
}
.hideshow {
	cursor: pointer;
	font-size: 15px;
}
	
	section {
		color: #3E3E3C;
		/* font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Helvetica, Arial, sans-serif;
		font-size:1em; */
	}
	
	#wrapper {
		min-width: 700px;
		margin: 0 auto;
	}
	
	form p.links {
		width: 50%;
		float: left;
	}
	
	form p.rechts {
		width: 49%;
		float: right;
	}
	
	label {
		display: block;
		cursor: pointer;
	}
	
	textarea {
		width: 92%;
		padding: 1em;
	}
	
	p.button {
		margin: 5px 0;
		text-align: center;
	}
	
	/* new clearfix */
	.clearfix:after {
		visibility: hidden;
		display: block;
		font-size: 0;
		content: " ";
		clear: both;
		height: 0;
		}
	* html .clearfix             { zoom: 1; } /* IE6 */
	*:first-child+html .clearfix { zoom: 1; } /* IE7 */
	
	.awesome{
		display: inline-block;
		outline: none;
		cursor: pointer;
		text-align: center;
		text-decoration: none;
		line-height: 1;
		padding: .5em 2em .55em;
		text-shadow: 1px 1px 1px rgba(0,0,0,.3);
		-webkit-border-radius: .5em;
		-moz-border-radius: .5em;
		border-radius: .5em;
		-webkit-box-shadow: 0 1px 2px rgba(0,0,0,.2);
		-moz-box-shadow: 0 1px 2px rgba(0,0,0,.2);
		box-shadow: 0 1px 2px rgba(0,0,0,.2);
		height: 40px;
	}
	
	.awesome:hover {
		text-decoration: none;
	}
	.awesome:active {
		position: relative;
		top: 1px;
	}
	
	/* white */
	.white {
		border: solid 1px #b7b7b7;
		background: #fff;
		background: -webkit-gradient(linear, left top, left bottom, from(#fff), to(#ededed));
		background: -moz-linear-gradient(top,  #fff,  #ededed);
		filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffff', endColorstr='#ededed');
	}
	.white:hover {
		background: #ededed;
		background: -webkit-gradient(linear, left top, left bottom, from(#fff), to(#dcdcdc));
		background: -moz-linear-gradient(top,  #fff,  #dcdcdc);
		filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffff', endColorstr='#dcdcdc');
	}
	.white:active {
		color: #999;
		background: -webkit-gradient(linear, left top, left bottom, from(#ededed), to(#fff));
		background: -moz-linear-gradient(top,  #ededed,  #fff);
		filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#ededed', endColorstr='#ffffff');
	}
	
	table {
		border-collapse: collapse;
		margin-top: 10px;
		width:100%;
		font-family: 'Bitstream Vera Sans Mono', Courier, monospace;
		border: 1px solid #CCC;
	}
	
	thead tr {
		font-weight: normal;
		text-aling: left;
		height: 2em;
		border-bottom: 1px solid #DDD;
		background-color: #ECECEC;
		background: -webkit-gradient(linear, left top, left bottom, from(#FAFAFA), to(#ECECEC));
		background: -moz-linear-gradient(top,  #FAFAFA,  #ECECEC);
		filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#FAFAFA', endColorstr='#ECECEC');
	}
	
	td {
		padding: 1px 2px;
	}
	
	td.bredecode {
		max-width: calc(954px - 12em);
		padding-left: 4px;
	}
	
	td.codekolom {
		text-align: right;
		min-width: 3em;
		background-color: #ECECEC;
		border-right: 1px solid #DDD;
		color: #AAA;
	}
	
	tr.add {
		background: #DFD;
	}
	
	tr.del {
		background: #FDD;
	}
	
	#res {
		background-color: rgba(255, 255, 255, 0.7);
	}
	</style>
		
	<section class="txt">
		<h1 style=\"clear:both;\">An Online Tool to do a \"quick and dirty\" diff of two text or code fragments</h1>

<h4>Introduction - why use an online diff?</h4>
	
<div>
<p>In my course as a developer I find myself constantly examining the differences between two pieces of text.
</p>
<p>Now, although pretty much every IDE (and various stand-alone products) have sophisticated diff utilities built in (like <a href=\"http:||www.eclipse.org\" target=\"eclipse\">Eclipse</a>), my favourite,
I got very tired of having to create two files just to paste in fragments of code or other bits of texts just in order to perform a diff and see the differences highlighted. </p>
<p>
This is why I made myself a quick online version that I have now decided to share with anyone else interested. (Update - Since the previous version of this tool stopped working,  this current version was created by Harmen Stoppels.)<br>
</p>
<h2><a class=\"hideshow\">Click here for instructions</a></h2>
<div id=\"how_to_use\">
<p>Simply paste your first text into the left text box and the other text into the right box and hit \"Submit\" to see the results.
</p>
<p>
I have added the following options :
<dl>
  <dt>Trim Lines</dt>
  <dd>Trims empty spaces on the beginning and end of each line on both inputs prior to comparing</dd>
  <dt>Remove Empty Lines</dt>
  <dd>Removes empty lines on both inputs prior to comparing</dd>
  <dt>Remove excess Whitespace</dt>
  <dd>Removes any instances of two or more subsequent whitespaces and replaces it with a single one</dd>
</dl>
</p>
<p>
I have also added the following options for diff algorithms:
<dl>
  <dt>Side-by-side</dt>
  <dd>Shows the differences side by side</dd>
  <dt>Inline</dt>
  <dd>Shows the differences inline, using the  <a href=\"http:||www.pear.php.net/package/Text_Diff\">Pear Diff Class</a></dd>
 
</dl>
</p>
<p>
For long comparisons to avoid scrolling all the way up to do a follow-up comparison, I have also included a copy of the form on the bottom of the page after a submit has taken place.
</p>

</div>
</div>
	</section>

<div id="wrapper">
		
		<form id="diffForm" method="post">
			<div class="clearfix">
				<p class="links">
					<label for="een"><?=$lang['before']?></label>
					<textarea name="een" id="een" cols="30" rows="10"></textarea>
				</p>
				<p class="rechts">
					<label for="twee"><?=$lang['after']?></label>
					<textarea name="twee" id="twee" cols="30" rows="10"></textarea>
				</p>
			</div>
			<p class="button"><input type="button" class="awesome white" value="<?=$lang['compare']?>"></p>
		</form>
		<table>
			<thead>
				<tr>
					<th colspan="3"><?=$lang['output']?></th>
				</tr>
			</thead>
			<tbody id="res"></tbody>
		</table>
	</div>
	
	<?=$lang->phrase('quickdiff_try')?>