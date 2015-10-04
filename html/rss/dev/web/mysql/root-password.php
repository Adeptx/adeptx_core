<div class="item-page">
		<div class="page-header">
		<h1> Документация по MySql </h1>
	</div>
				<div class="page-header">
		<h2>
												<a href="page/dev/web/mysql/root_password"> Установка, изменение и сброс пароля root в MySQL</a>
									</h2>
							</div>
						<div class="btn-group pull-right">
			<a class="btn dropdown-toggle" data-toggle="dropdown" href="#"> <span class="icon-cog"></span> <span class="caret"></span> </a>
		</div>
			
			<div class="article-info muted">
			<dl class="article-info">
			<dt class="article-info-term">Подробности</dt>

													<dd class="category-name">
																Категория: <a href="page/dev/web/mysql">MySQL</a>									</dd>
			
							<dd class="published">
					<span class="icon-calendar"></span> Опубликовано: 04 Апрель 2013				</dd>
			
											
									<dd class="hits">
						<span class="icon-eye-open"></span> Просмотров: 40271					</dd>
										</dl>
		</div>
	
			
								<div style="clear:both;"></div><div style="clear:both;"></div><p><span>Это руководство объясняет, каким образом можно установить, измененить или сбросить (если вы забыли пароль) рутовый пароль в MySQL. Снова и снова я наблюдаю одну и ту же картину:</span></p>
 
<blockquote>
<p><span class="system"><em>mysqladmin:&nbsp; connect to server at 'localhost' failed error: 'Access denied for user 'root'@'localhost' (using password: YES)'.</em> </span></p>
</blockquote>
<p><span class="system">Поэтому я нашёл время, чтобы напомнить вам как решить связанную с этим проблему в <a href="http://www.mysql.com/" target="_blank"><em>MySQL</em></a>. Если вы ищете быстрое решение проблемы по сбросу пароля root, можете найте его в конце данного руководства.&nbsp; </span></p>
<p>&nbsp;</p>
<p><span style="font-size: medium; color: #800000;"><strong>mysqladmin -команда, при помощи которой меняется пароль root в <em>MySQL</em></strong></span></p>
<p>&nbsp;</p>
<h3><strong>Метод 1. Установка пароля root в первый раз.</strong></h3>
<p>Если вы никогда не устанавливали пароль root в <em>MySQL</em>, сервер не будет требовать пароля root для подключения к вашим базам данных. Чтобы впервые установить пароль <em>MySQL</em> используйте в консоли команду <span class="system"><em>mysqladmin</em> как показано далее:</span></p>
<p>&nbsp;</p>
<blockquote>
<p><strong><em>mysqladmin -u root password newpass </em></strong></p>
</blockquote>
<p>&nbsp;</p>
<p>где <em>newpass</em> будет пароль который вы устанавливаете.</p>
<p>Для изменения (обновления) пароля root воспользуйтесь следующей командой:</p>
<p>&nbsp;</p>
<blockquote>
<p><em><strong>mysqladmin -u root -p oldpassword newpass</strong></em></p>
</blockquote>
<address>&nbsp;</address>
<p>где <em>oldpassword</em> - ваш старый пароль, а newpassword соотвественно новый. Если же вы в ответ получили следующее сообщение:</p>
<p>&nbsp;</p>
<blockquote>
<p><em>mysqladmin: connect to server at 'localhost' failed<br> error: 'Access denied for user 'root'@'localhost' (using password: YES)'</em></p>
</blockquote>
<p>&nbsp;</p>
<p>то это означает, что пароль вы попросту забыли, либо его сменил кто-то другой. Воспользуйтесь следующей инструкцией для восстановления пароля к вашему <em>MySQL</em>.</p>
<p>&nbsp;</p>
<h4><span>Изменения пароля <em>MySQL</em> для других пользователей.</span></h4>
<p>Для изменения пароля обычного пользователя введите следующую команду:</p>
<p>&nbsp;</p>
<blockquote>
<p><strong><em>mysqladmin -u user-name -p oldpassword newpass</em></strong></p>
</blockquote>
<p>&nbsp;</p>
<p>где <em>user-name</em> - имя пользователя для которого вы меняете пароль.</p>
<h3><span>Метод 2 - Обновление или изменение пароля.</span></h3>
<p><span><em>MySQL</em> хранит имена пользователей и пароли в таблице пользователей внутри базы данных.</span> Вы можете обновить пароль используя следующий метод:</p>
<p>1. Залогиньтесь в <em>MySQL</em> и введите следующую команду:</p>
<p>&nbsp;</p>
<blockquote>
<p><strong><em>mysql -u root -p</em></strong></p>
</blockquote>
<p>&nbsp;</p>
<p>2.&nbsp; Начните работу с базой данных. В качестве приглашения для ввода команд вначале строки у вас должно быть <em><span class="system">mysql&gt;</span></em></p>
<p>&nbsp;</p>
<blockquote>
<p><strong><em>mysql&gt; use mysql;</em></strong></p>
</blockquote>
<p>&nbsp;</p>
<p>3. Смените пароль пользователя</p>
<p>&nbsp;</p>
<blockquote>
<p><strong><em>mysql&gt; update user set password=PASSWORD("newpass") where User='ENTER-USER-NAME-HERE';</em></strong></p>
</blockquote>
<p>&nbsp;</p>
<p>4. Перегрузите привелегии и отлогиньтесь</p>
<p>&nbsp;</p>
<blockquote>
<p><strong><em>mysql&gt; flush privileges;<br> mysql&gt; quit</em></strong></p>
</blockquote>
<p>&nbsp;</p>
<p>Этот метод применим в случае использования на вашем сервере <a href="http://php.net/" target="_blank"><em>PHP</em></a> и скриптов <a href="http://www.perl.org" target="_blank"><em>Perl</em></a>.</p>
<p>&nbsp;</p>
<h3><strong>Восстановление пароля root в <em>MySQL</em>. </strong></h3>
<p>Вы можете восстановить пароль от баз данных <em>MySQL</em> если повторите следующие 5 шагов:</p>
<ul>
<li>Остановите демон <em>MySQL</em>.</li>
<li>Запустите демон <em>MySQL (mysqld)</em> с опцией <span class="system"><em>--skip-grant-tables</em>, т.к. в этом случае </span><span class="system">пароль </span><span class="system">не запрашивается.</span></li>
<li><span class="system">Подключитесь к серверу <em>MySQL</em> c root-привелегиями</span></li>
<li><span class="system">Введите новый пароль.</span></li>
<li><span class="system">Выйдите и перегрузите демон <em>MySQL</em>.</span></li>
</ul>
<p><span class="system">Далее приводятся команды, которые необходимо</span> использовать для каждого шага, при условии, что вы вошли в систему с <em>root</em>-привелегиями.</p>
<p>1. Останавливаем службу <em>MySQL</em>:</p>
<p>&nbsp;</p>
<blockquote>
<p><strong><em>/etc/init.d/mysql stop <br></em><em>Stopping MySQL database server: mysqld.</em></strong></p>
</blockquote>
<p>&nbsp;</p>
<p>2.&nbsp; Запускаем службу с опцией <em>--skip-grant-tables</em></p>
<p>&nbsp;</p>
<blockquote>
<p><em><strong>mysqld_safe --skip-grant-tables &amp;</strong></em></p>
</blockquote>
<p>&nbsp;</p>
<p>Должен быть следующий вывод:</p>
<blockquote>
<p><em>[1] 5988<br> Starting mysqld daemon with databases from /var/lib/mysql<br> mysqld_safe[6025]: started</em></p>
</blockquote>
<p>&nbsp;</p>
<p>3. &nbsp; Подключаемся с серверу <em>MySQL</em> при помощи клиента <em>mysql</em>:</p>
<blockquote>
<p><strong><em>mysql -u root</em></strong></p>
<p><strong><em>Welcome to the MySQL monitor.&nbsp; Commands end with ; or \g.<br> Your MySQL connection id is 1 to server version: 4.1.15-Debian_1-log<br> Type 'help;' or '\h' for help. Type '\c' to clear the buffer.<br> mysql&gt;</em></strong></p>
</blockquote>
<p>&nbsp;</p>
<p>4. Вводим новый пароль для <em>root</em>:</p>
<p>&nbsp;</p>
<blockquote>
<p><strong><em>mysql&gt; use mysql;<br> mysql&gt; update user set password=PASSWORD("NEW-ROOT-PASSWORD") where User='root';<br> mysql&gt; flush privileges;<br> mysql&gt; quit </em></strong></p>
</blockquote>
<p>&nbsp;</p>
<p>5. Останавливаем сервер <em>MySQL</em>:</p>
<p>&nbsp;</p>
<blockquote>
<p><strong><em>/etc/init.d/mysql stop</em></strong></p>
<p><strong><em>Stopping MySQL database server: mysqld<br> STOPPING server from pid file /var/run/mysqld/mysqld.pid<br> mysqld_safe[6186]: ended<br> [1]+&nbsp; Done mysqld_safe --skip-grant-table</em></strong></p>
</blockquote>
<p>&nbsp;</p>
<p>Запускаем <em>MySQL</em>-сервер и логинимся с новым паролем:</p>
<p>&nbsp;</p>
<blockquote>
<p><strong><em>/etc/init.d/mysql start<br>&nbsp; mysql -u root -p</em></strong></p>
</blockquote>
<p>&nbsp;</p>
<p>Source: <a href="http://www.howtoforge.com/setting-changing-resetting-mysql-root-passwords" target="_blank">howtoforge.com</a></p>
						 </div>