<div id="login">
	<form action="<?=$site['alias'] . '/' . $page['from']?>" method="post">
		<span class="fontawesome-user"></span>
		<input name="login" type="text" value="<?=$lang->give("login")?>" onBlur="if(this.value == '') this.value = '<?=$lang->give("login")?>'" onFocus="if(this.value == '<?=$lang->give("login")?>') this.value = ''" required>
		<br>
		<span class="fontawesome-lock"></span>
		<input name="pass" type="password"  value="<?=$lang->give("password")?>" onBlur="if(this.value == '') this.value = '<?=$lang->give("password")?>'" onFocus="if(this.value == '<?=$lang->give("password")?>') this.value = ''" required>
		<br>
		<input type="submit" value="<?=$lang->give("log-in")?>">
		<br>
		<input hidden name="page" type="text" value="<?=$page['from']?>">
	</form>
</div>