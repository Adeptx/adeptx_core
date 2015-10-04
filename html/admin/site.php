<?
	# здесь можно переключаться между сайтами-проектами
	# <select>-ом выбираем проект chairschairs/raid/adpetx и прочее, в конфигах меняется строка $site['default'], устанавливается сайт, который будет запускатся, над которым ты работаешь (в связи с чем эту строку стоит перенести в json для удобства манипуляпии)


	# по клику эта часть сохраняется в conf/user/settings.json
	# (считывается содержимое файла, меняется соответствующее значение и записывается pretty)
?>

<tr>
	<td>Создать новый:</td>
	<td><input placeholder="codename (alias)"></td>
</tr>
<tr>
	<td class="name">Выберите созданный проект в качестве основного проекта после создания:</td>
	<td class="value">
		<select>
			<?
				$sites = array(
					 'grinec' => 'grinec.tk'
					,'reid' => 'raid59.ru'
					,'chairschairs' => 'chairschairs.ru'
					,'adeptx' => 'adeptx.tk'
#					,'admin' => 'admin'
				);

				foreach ($sites as $alias=>$url) {
				?>
					<option value="<?=$alias?>"<? if ($alias == $site['default']) echo ' selected'; ?>><?=$url?></option>
				<?
				}
			?>
		</select>
	</td>
</tr>
<!-- далее необходимо настроить созданный сайт (conf) и rout ну и прочее -->

<!--tr><td class="name"><?=$name?></td><td class="value"><input value="<?=htmlspecialchars($directive);?>"></td></tr-->