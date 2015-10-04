<section>
	<form id="upload" method="post" action="upload.php" enctype="multipart/form-data">
		<div id="drop">
			Drop Here
			<a>Browse</a>
			<input type="file" name="upl" multiple>
		</div>
		<ul><!-- Files uploads will be shown here --></ul>
	</form>

	<div id="footer">
		<h2>allowed = png, jpg, gif, zip, txt, ico, css, html, ttf, woff; dir = uploads; post max. size = <?=ini_get('post_max_size');?>; max. filesize = <?=ini_get('upload_max_filesize');?>; memory limit = <?=ini_get('memory_limit');?>; max. count = reccomend 20; max. execution time = <?=ini_get('max_execution_time');?> sec. per file</h2>
		<div id="tzine-actions">
			<!--a id="tzine-download" href="http://tutorialzine.com/2013/05/mini-ajax-file-upload-form/">Download</a-->
		</div>
	</div>
</section>
