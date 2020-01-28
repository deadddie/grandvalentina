<?php

use Bitrix\Main\Page\Asset;
use Bitrix\Main\Localization\Loc;
use LapkinLab\Core;


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
    <link href="https://fonts.googleapis.com/css?family=Roboto&amp;display=swap&amp;subset=cyrillic-ext" rel="stylesheet">
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
</head>
<body class="">
    <?php $APPLICATION->ShowPanel(); ?>

    <div id="svg-container" hidden></div>

    <div class="wrapper" id="top">

        <!--header-->
        <header id="header" class="header">
            <div class="container">
                <div class="row">
                    <div class="header--wrapper col-12">

                        <div class="header--hamburger js-mobile-menu">
                            <?= Core::renderIcon('hamburger') ?>
                        </div>

                        <div class="header--logo">
                            <a href="/">
                                <div class="logo-vertical">
                                    <img src="<?= SITE_TEMPLATE_PATH ?>/images/logo-colorful.svg" alt="<?= SITE_CONFIG['name_short'] ?>">
                                    <span class="header--logo-text"><?= SITE_CONFIG['name_short'] ?></span>
                                </div>
                            </a>
                        </div>

                        <div class="header--lang">
                            <div class="header--lang-current js-language-switch">RU <?= Core::renderIcon('romb') ?></div>
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
