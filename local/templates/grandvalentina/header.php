<?php

use Bitrix\Main\Page\Asset;
use Bitrix\Main\Localization\Loc;


if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

Loc::loadLanguageFile(__FILE__);

$asset = Asset::getInstance();

?>
<!doctype html>
<html lang="<?= LANGUAGE_ID ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php $APPLICATION->ShowTitle() ?></title>
    <?php $APPLICATION->ShowMeta('description') ?>
    <?php
    // Вывод CSS подключений
    $APPLICATION->ShowCSS();


    // Вывод JavaScript подключений
    $APPLICATION->ShowHeadStrings();
    $APPLICATION->ShowHeadScripts();
    ?>
</head>
<body>
    <?php $APPLICATION->ShowPanel(); ?>

</body>
</html>

