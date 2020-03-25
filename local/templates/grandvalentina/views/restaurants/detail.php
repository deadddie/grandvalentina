<?php

/**
 * @var object $restaurant \CIBlockElement
 */

use LapkinLab\{Core, Helper, Content\Restaurants};
use Bitrix\Main\Localization\Loc;

require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

if ($restaurant):
    $arFields = $restaurant->GetFields();
    $arProperties = $restaurant->GetProperties();

    $APPLICATION->SetTitle($arFields['NAME']);
    $APPLICATION->AddChainItem('Рестораны', '/restaurants/');

    ?>
    <h1 class="page-title"><?= $arFields['NAME'] ?></h1>

    <div class="restaurant-detail">

        <?php if (!empty($arFields['DETAIL_PICTURE'])): ?>
            <div class="restaurant-detail--image-main">
                <?= Restaurants::getDetailImage($arFields['DETAIL_PICTURE'], $arFields['NAME'], 'img-fluid') ?>
            </div>
        <?php endif; ?>

        <div class="restaurant-detail--content">

            <?php if (!empty($arFields['DETAIL_TEXT'])): ?>
                <div class="restaurant-detail--description">
                    <div class="restaurant-detail--description--content">
                        <?= $arFields['DETAIL_TEXT'] ?>
                    </div>
                </div>
            <?php endif; ?>

        </div>

        <?php if (!empty($arProperties['MORE_PHOTOS']['VALUE'])): ?>
            <div class="restaurant-detail--images">
                <?= Restaurants::getMoreImages($arProperties['MORE_PHOTOS']['VALUE'], $arFields['NAME']) ?>
                <?php if (count($arProperties['MORE_PHOTOS']['VALUE']) > 1): ?>
                    <div class="restaurant-detail--images--nav">
                        <?= view('common.slider_navigation', ['type' => 'restaurant'], false) ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <div class="restaurant-detail--content">
            <?php if (!empty($arProperties['MENU_ABOUT']['VALUE'])): ?>
                <div class="restaurant-detail--menu">
                    <h3 class="restaurant-detail--menu--title">Меню <?= $arFields['NAME'] ?></h3>
                    <div class="restaurant-detail--menu--delimiter delimiter"><?= renderIcon('delimiter') ?></div>
                    <div class="restaurant-detail--menu--about">
                        <?= $arProperties['MENU_ABOUT']['VALUE'] ?>
                    </div>
                    <?php if (!empty($arProperties['MENU']['VALUE'])): ?>
                        <div class="restaurant-detail--menu--download">
                            <?= Restaurants::getMenuLink($arProperties['MENU']['VALUE'], 'Меню ' . $arFields['NAME']) ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>

        <?php if (!empty($arProperties['ABOUT']['VALUE'])): ?>
            <div class="restaurant-detail--content restaurant-detail--content--wide">
                <div class="restaurant-detail--content--wide-wrapper">
                    <div class="restaurant-detail--detail-text">
                        <div class="delimiter"><?= renderIcon('delimiter') ?></div>
                        <div class="restaurant-detail--detail-text--content">
                            <?= html_entity_decode($arProperties['ABOUT']['VALUE']['TEXT']) ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if ($arProperties['FORM']['VALUE'] === 'Y'): ?>
            <div class="restaurant-detail--order">
                <?= view('forms.order', [
                    'APPLICATION' => $APPLICATION,
                    'id' => 'restaurant-order'
                ], false) ?>
            </div>
        <?php endif; ?>

    </div>

<?php endif; ?>
