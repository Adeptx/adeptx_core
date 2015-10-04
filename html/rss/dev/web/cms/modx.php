<div class="article">
          <h1>Настройка админ панели клиента Modx Revolution с настройкой прав доступа</h1>
<img src="http://bayguzin.ru/assets/images/2013/03/admin.gif">

          <p></p><p>Когда я начал работать на CMF Modx Revolution (до этого сажал сайты на Evolution) я открыл для себя неприятную новость - я не могу создать админку для клиента с теми правами доступа, чтобы клиент ничего не испортил на сайте. То есть с закрытыми "Элементами", рабочими файлами системы, системными настройками и так далее. Вообщем я не знал как настроить админку под клиента. Сейчас знаю :)) И хочу поделиться этими знаниями с вами!</p>
<p>В Evolution все было достаточно просто: создаешь права пользователю и готово! А здесь нужно проделать достаточно много шагов, но сдругой стороны - в Modx Revolution с правами на документы и файлы можно делать все, что угодно (если конечно разбираться в этом). Ну что ж, начнем!</p>
<p>1. Переходим в "Безопасность" - "Контроль доступа" в верхнем меню админ-панели</p>
<p><img src="http://bayguzin.ru/assets/images/2013/03/1.gif" alt="" height="300" width="605"></p>
<p>&nbsp;</p>
<p>2. Заходим во вкладку "Политика доступа"</p>
<p><img src="http://bayguzin.ru/assets/images/2013/03/2.gif" alt="" height="300" width="605"></p>
<p>&nbsp;</p>
<p>3. Нажимаем на кнопку "Создать политику доступа". У нас откроется окно с полями. В поле Имя пишем "manager", шаблон политики доступа - AdministratorTemplate. Жмем кнопку сохранить</p>
<p><img src="http://bayguzin.ru/assets/images/2013/03/3.gif" alt="" height="300" width="605"></p>
<p>&nbsp;</p>
<p>4. После сохранения политики доступа "manager" мы видим, что она появилась у нас в списке политик доступа</p>
<p><img src="http://bayguzin.ru/assets/images/2013/03/4.gif" alt="" height="300" width="605"></p>
<p>&nbsp;</p>
<p>5. Редактируем manager</p>
<p><img src="http://bayguzin.ru/assets/images/2013/03/5.gif" alt="" height="300" width="605"></p>
<p>&nbsp;</p>
<p>6. Внизу этой открывшейся страницы есть список параметров (разрешений). Нам нужно убрать галочки с тех параметров, которые отвечают за вывод каких либо ресурсов в админке, чтобы избежать редактирования или удаления нужных документов, файлов, элементов для правильной работы сайта.</p>
<p><img src="http://bayguzin.ru/assets/images/2013/03/6.gif" alt="" height="300" width="605"></p>
<p><span>Убираем галочки с следующих параметров:</span></p>
<p>access_permissions &nbsp; &nbsp; Вывод страницы с настройками прав доступов пользователей<br><span style="line-height: 1.8em;">dashboards &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Просмотр и управление панелями<br>element_tree &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Возможность просмотра дерева элементов в левой навигационной панели<br>menu_reports &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Показывать в верхнем меню пункт «Отчёты»<br>menu_security &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Показывать в верхнем меню пункт «Безопасность»<br>menu_system &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Показывать в верхнем меню пункт «Система»<br>menu_tools &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Показывать в верхнем меню пункт «Инструменты»<br>new_static_resource &nbsp; Создавать новые статичные ресурсы.<br>remove_locks &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Удалять все блокировки на сайте<br></span></p>
<p><span style="line-height: 1.8em;">Обязательно нажимаем кнопку "Сохранить"</span></p>
<p>
<span><span>7. Переходим во вкладку "Безопасность" - "Контроль доступа" - "Роли"</span></span></p>
<p><span><span><img src="http://bayguzin.ru/assets/images/2013/03/7.gif" alt="" height="300" width="605"></span></span></p>
<p>&nbsp;</p>
<p><span><span>8. Нажимаем кнопку "Создать новый", в поле Имя вбиваем Manager, Ранг - 9, нажимаем кнопку "Сохранить"</span></span></p>
<p><span><span><img src="http://bayguzin.ru/assets/images/2013/03/8.gif" alt="" height="300" width="605"></span></span></p>
<p>&nbsp;</p>
<p><span><span>9. Сохраняем изменения и переходим в меню "Безопасность" - "Контроль доступа" - "Группы пользователей"</span></span></p>
<p><span><span><img src="http://bayguzin.ru/assets/images/2013/03/9.gif" alt="" height="300" width="605"></span></span></p>
<p><span><span>Правой кнопкой мыши жмем на "Administrator" и нажимаем "Создать группу пользователей"</span></span></p>
<p>&nbsp;</p>
<p><span><span>10. Создаем новую группу: Имя - Manager, Политика бэкэнда - нет политики, жмем "Сохранить"</span></span></p>
<p><img src="http://bayguzin.ru/assets/images/2013/03/10.gif" alt="" height="300" width="605"></p>
<p>&nbsp;</p>
<p>11. Находим ее в списке Групп пользователей и жмем "редактировать"</p>
<p><img src="http://bayguzin.ru/assets/images/2013/03/11.gif" alt="" height="300" width="605"></p>
<p>&nbsp;</p>
<p>12. Заходим в меню "Доступ к контекстам" и нажимаем "Добавить контекст"</p>
<p><img src="http://bayguzin.ru/assets/images/2013/03/12.gif" alt=""></p>
<p>&nbsp;</p>
<p>13. Контекст - mgr, Минимальная роль - Manager - 9, Политика доступа - Manager</p>
<p><img src="http://bayguzin.ru/assets/images/2013/03/13.gif" alt="" height="300" width="605"></p>
<p>&nbsp;</p>
<p>14. Добавляем еще одни контекст, а точнее редактируем уже имеющийся web: Контекст - web, Минимальная роль - Manager - 9, Политика доступа - Administrator. Нажимаем кнопку "Сохранить"</p>
<p><img src="http://bayguzin.ru/assets/images/2013/03/14.gif" alt="" height="300" width="605"></p>
<p>&nbsp;</p>
<p>15. Мы увидим такую картину! Сохраняем все во вкладке "Группа пользователя: Manager"</p>
<p><img src="http://bayguzin.ru/assets/images/2013/03/15.gif" alt="" height="300" width="605"></p>
<p>&nbsp;</p>
<p>16. Далее: "Безопасность" - "Управление пользователями"</p>
<p><img src="http://bayguzin.ru/assets/images/2013/03/16.gif" alt="" height="300" width="605"></p>
<p>&nbsp;</p>
<p>17. Создаем нового пользователя (это будет наш клиент) - нажимаем кнопку "Новый пользователь". Имя вы ему можете задать какое угодно, я назову его - manager</p>
<p><img src="http://bayguzin.ru/assets/images/2013/03/17.gif" alt="" height="300" width="605"></p>
<p>&nbsp;</p>
<p>18. Имя пользователя - manager, жмем галочку - Активный, вбиваем email</p>
<p><img src="http://bayguzin.ru/assets/images/2013/03/18.gif" alt="" height="300" width="605"></p>
<p>&nbsp;</p>
<p>19. Указываем пароль</p>
<p><img src="http://bayguzin.ru/assets/images/2013/03/19.gif" alt="" height="300" width="605"></p>
<p>&nbsp;</p>
<p>20. Перед тем как сохранить, зайдите во вкладку "Права доступа"</p>
<p><img src="http://bayguzin.ru/assets/images/2013/03/20.gif" alt="" height="300" width="605"></p>
<p>&nbsp;</p>
<p>21. Жмем кнопку "Добавить пользователя в группу", Группа пользователя - "Manager", Роль - "Manager"</p>
<p><img src="http://bayguzin.ru/assets/images/2013/03/21.gif" alt="" height="300" width="605"></p>
<p>Сохраняем. На этом создание админ панели, где у клиента есть доступы только к правке и созданию страниц в дереве документов, закончено. Но этот пользователь до сих пор имеет доступ ко всем файлам системы. И поэтому мы сейчас сделаем так, что он имел доступ только к одной папке, которую мы создадим в корне сайта Modx Revolution</p>
<p>&nbsp;</p>
<p>22. Переходим во вкладку "Инструменты" - "Источники файлов"</p>
<p><img src="http://bayguzin.ru/assets/images/2013/03/22.gif" alt="" height="300" width="605"></p>
<p>&nbsp;</p>
<p>23. Откроется список всех источников файлов. По умолчанию создан одни единственный - Filesystem. Перед созданием нового источника файлов, нужно сначала изменить этот. Нажимаем на "<span>Filesystem</span>" правой кнопкой мыши и выбираем "Редактировать"</p>
<p><img src="http://bayguzin.ru/assets/images/2013/03/27.gif" alt="" height="300" width="605"></p>
<p>&nbsp;</p>
<p>24. Откроется такое окно. Жмем "Добавить группу пользователей"</p>
<p><img src="http://bayguzin.ru/assets/images/2013/03/28.gif" alt="" height="300" width="605"></p>
<p>&nbsp;</p>
<p>25. Группы пользователей - Administrator, Минимальная роль - Super User - 0, Политика - Media Source Admin. Нажимаем "Сохранить"</p>
<p><img src="http://bayguzin.ru/assets/images/2013/03/29.gif" alt="" height="300" width="605"></p>
<p>&nbsp;</p>
<p>26. Возвращаемся к Источникам файлов и создаем новый источник файлов. Назовем его "Manager", Тим источника файлов - Файловая система</p>
<p><img src="http://bayguzin.ru/assets/images/2013/03/24.gif" alt="" height="300" width="605"></p>
<p>Жмем "Сохранить"</p>
<p>&nbsp;</p>
<p>27. Нажимаем правой кнопкой мыши на новый источник файлов "Manager" и выбираем "Редактировать"</p>
<p><img src="http://bayguzin.ru/assets/images/2013/03/25.gif" alt="" height="300" width="605"></p>
<p>&nbsp;</p>
<p>28. Откроется такое окно! Нам нужно изменить первые 4 параметра. В basePath в поле значение мы вбиваем <strong>/manager/</strong>, basePathRelative и baseUrlRelative оставляем как есть со значениями "Да", в поле baseUrl пишем&nbsp;<strong>manager/</strong></p>
<p><img src="http://bayguzin.ru/assets/images/2013/03/26.gif" alt="" height="300" width="605"></p>
<p>Жмем сохранить! Теперь осталось только задать права доступа к источнику файлов, но перед этим нам нужно задать источник файлов ко всем tv параметрам, которые будет администрировать наш клиент</p>
<p>29. Заходим в tv параметр</p>
<p><img src="http://bayguzin.ru/assets/images/2013/03/30.gif" alt="" height="300" width="605"></p>
<p>&nbsp;</p>
<p>30. Нажимаем самую последнюю вкладку "Источники файлов" и меняем источник файлов с "Filesystem" на "Manager". Сохраняем!</p>
<p><img src="http://bayguzin.ru/assets/images/2013/03/31.gif" alt="" height="300" width="605"></p>
<p>&nbsp;</p>
<p>31. Теперь после всех проделанных шагов заходим в "Источник файлов" - "Manager" и добавляем группу пользователей в этот источник файлов</p>
<p><img src="http://bayguzin.ru/assets/images/2013/03/32.gif" alt="" height="300" width="605"></p>
<p>&nbsp;</p>
<p>32. Группы пользователей - Manager, Минимальная роль - Manager - 9, Политика - Media Source Admin. Жмем "Сохранить"</p>
<p><img src="http://bayguzin.ru/assets/images/2013/03/33.gif" alt="" height="300" width="605"></p>
<p><span>Сразу после сохранения источник файлов "Manager" исчезнет для администратора. Для того чтобы можно было редактировать этот источник файлов, нужно&nbsp;зайти в меню "Безопасность - Контроль доступа". Открыть на редактирование группу менеджера: Manager и во вкладке "Источники файлов" найти и удалить источник <span>Manager</span>. Только тогда мы сможем вновь редактировать данный источник из под администратора.</span></p>
<p>&nbsp;</p>
<p>33. На всякий случай очищаем кэш и наш пользователь с ограниченными правами и доступами к файловой системе создан! Все наилучшего!</p>
<p><img src="http://bayguzin.ru/assets/images/2013/03/34.gif" alt="" height="300" width="605"></p>
<p>&nbsp;</p>
<p>Не скажу ,что это достаточно легко, но если делать это на автоматизме, то это не покажется чем то тяжелым. Надеюсь у вас все получилось! Удачи в проектах!</p><p></p>

Иточник: http://bayguzin.ru/main/uroki/uroki-modx-revolution/nastrojka-admin-paneli-klienta-modx-revo.html