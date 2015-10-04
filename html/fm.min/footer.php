<footer>
	<form method=post enctype=multipart/form-data>
		<?=$lang['uploading files']?>
		<input name=file[] type=file multiple><br>
		<input type=submit class=button value="<?=$lang['upload']?>">
		<input type=button class=button value="<?=$lang['create new file']?>">
	</form>
</footer>
