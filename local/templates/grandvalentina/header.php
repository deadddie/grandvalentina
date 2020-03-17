<?php

use Bitrix\Main\Page\Asset;
use Bitrix\Main\Localization\Loc;
use LapkinLab\Core;
use LapkinLab\Content\Menu;


if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

Loc::loadLanguageFile(__FILE__);

$asset = Asset::getInstance();

?>
<!doctype html>
<html lang="<?= LANGUAGE_ID ?>">
<head>
    <title><?php $APPLICATION->ShowTitle() ?></title>
    <?php $APPLICATION->ShowMeta('description') ?>
    <?php $APPLICATION->ShowMeta('robots') ?>

    <!--meta-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--styles-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500  &amp;display=swap&amp;subset=cyrillic-ext" rel="stylesheet">
    <!--favicons-->
    <link rel="apple-touch-icon" sizes="76x76" href="<?= SITE_TEMPLATE_PATH ?>/images/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= SITE_TEMPLATE_PATH ?>/images/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= SITE_TEMPLATE_PATH ?>/images/favicons/favicon-16x16.png">
    <link rel="manifest" href="<?= SITE_TEMPLATE_PATH ?>/images/favicons/site.webmanifest">
    <link rel="mask-icon" href="<?= SITE_TEMPLATE_PATH ?>/images/favicons/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#c12032">
    <meta name="theme-color" content="#ffffff">

    <?php $scripts = array(
        '/js/vendor.app.min.js',
        '/js/app.min.js',
    );
    foreach ($scripts as $script) {
        $asset->addJs(SITE_TEMPLATE_PATH . $script);
    } ?>
    <?php
    $APPLICATION->ShowCSS();
    $APPLICATION->ShowHeadStrings();
    $APPLICATION->ShowHeadScripts();
    ?>
    <?php $asset->addString('<link rel="canonical" href="https://' . $_SERVER['HTTP_HOST'] . $APPLICATION->GetCurPage(false) . '">'); ?>

    <?php if (SITE_CONFIG['env'] === 'production'): ?>
        <?php $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . '/include_areas/seo_head.php') ?>
    <?php endif; ?>
</head>
<body class="<?= Core::setBodyClass($APPLICATION) ?>">
    <?php $APPLICATION->ShowPanel(); ?>

    <div id="svg-container" hidden></div>

    <?php $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . '/include_areas/loading.php') ?>
    <?php $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . '/include_areas/menu_mobile.php', array(), array('SHOW_BORDER' => true)) ?>

    <div class="wrapper" id="top">

        <!--header-->
        <header id="header" class="header">
            <div class="container">
                <div class="row">
                    <div class="header--wrapper col-12">

                        <div class="header--lang">
                            <div class="header--lang-current js-languages-switch">RU <?= renderIcon('romb') ?></div>
                            <?= view('common.languages', [], false) ?>
                        </div>

                        <?php if (!empty(SITE_CONFIG['phone'])): ?>
                            <div class="header--phone">
                                <?= Core::parsePhone(SITE_CONFIG['phone'], 'link') ?>
                            </div>
                        <?php endif; ?>

                        <div class="header--hamburger--float js-float-menu">
                            <?= renderIcon('hamburger') ?>
                            <div class="header--hamburger--float-text">меню</div>
                        </div>

                        <div class="header--logo">
                            <a href="/">
                                <div class="logo-vertical">
                                    <img src="<?= SITE_TEMPLATE_PATH ?>/images/logo-colorful.svg" alt="<?= SITE_CONFIG['name_short'] ?>">
                                    <span class="header--logo-text"><?= SITE_CONFIG['name_short'] ?></span>
                                </div>
                            </a>
                        </div>

                        <div class="header--hamburger active js-mobile-menu">
                            <?= renderIcon('hamburger') ?>
                        </div>

                        <div class="header--callback">
                            <button type="button" class="btn btn-white js-open-modal" data-action="openModal" data-modal="callback">Обратный звонок</button>
                        </div>

                        <div class="header--menu">
                            <?= Menu::getTopMenu() ?>
                        </div>

                    </div>
                </div>
            </div>

        </header><!--/header-->

        <!--main-->
        <main id="main-content">

            <?php if ($APPLICATION->GetCurDir() !== '/'): ?>
                <?php if (!(defined('ERROR_404') && ERROR_404 === 'Y')): ?>
                    <?php
                    $APPLICATION->AddChainItem('Главная', '/');
                    $APPLICATION->IncludeComponent(
                        'bitrix:breadcrumb',
                        'grandvalentina',
                        array(
                            'START_FROM' => '1',
                            'PATH'       => '/',
                            'SITE_ID' => SITE_ID
                        )
                    ); ?>
                <?php endif; ?>
            <?php endif; ?>
