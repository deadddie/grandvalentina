/bitrix/main/include.php

после инициализации объекта приложения ```$GLOBALS['APPLICATION'] = new CMain;```

```
### set SITE_ID from cookies
$site_id = (isset($_COOKIE['LANG']) && $_COOKIE['LANG'] === 'en') ? 's2' : 's1';
define('SITE_ID', $site_id);
###
```
