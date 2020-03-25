<?php

/**
 * @var object $event \CIBlockElement
 */

use LapkinLab\{Core, Helper, Content\Events};
use Bitrix\Main\Localization\Loc;

require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

if ($event):
    $arFields = $event->GetFields();
    $arProperties = $event->GetProperties();

    $APPLICATION->SetTitle((LANGUAGE_ID === 'ru') ? $arFields['NAME'] : $arProperties['NAME' . LANG_PREFIX]['VALUE']);
    $APPLICATION->AddChainItem(Loc::getMessage('Events'), '/events/');

    ?>
    <h1 class="page-title">
        <?= (LANGUAGE_ID === 'ru') ? $arFields['NAME'] : $arProperties['NAME' . LANG_PREFIX]['VALUE'] ?>
    </h1>

    <div class="event-detail">

        <?php if (!empty($arProperties['MORE_PHOTOS']['VALUE'])): ?>
            <div class="event-detail--images">
                <?= Events::getMoreImages($arProperties['MORE_PHOTOS']['VALUE'], (LANGUAGE_ID === 'ru') ? $arFields['NAME'] : $arProperties['NAME' . LANG_PREFIX]['VALUE']) ?>
                <?php if (count($arProperties['MORE_PHOTOS']['VALUE']) > 1): ?>
                    <div class="event-detail--images--nav">
                        <?= view('common.slider_navigation', ['type' => 'event'], false) ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php elseif (!empty($arFields['DETAIL_PICTURE'])): ?>
            <div class="event-detail--image-main">
                <?= Events::getDetailImage($arFields['DETAIL_PICTURE'], (LANGUAGE_ID === 'ru') ? $arFields['NAME'] : $arProperties['NAME' . LANG_PREFIX]['VALUE'], 'img-fluid') ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($arProperties['NUMBER_SEATS'])): ?>
            <div class="event-detail--seats">
                <div class="event-detail--seats--value"><?= Loc::getMessage('up to') ?><span><?= $arProperties['NUMBER_SEATS']['VALUE'] ?></span> <?= Loc::getMessage('persons') ?></div>
                <div class="delimiter"><?= renderIcon('delimiter') ?></div>
                <div class="event-detail--seats--description"><?= Loc::getMessage('Number of seats in the') ?><br>
                    <?= mb_strtolower((LANGUAGE_ID === 'ru') ? $arFields['NAME'] . 'е' : $arProperties['NAME' . LANG_PREFIX]['VALUE']) ?>
                </div>
            </div>
        <?php endif; ?>

        <div class="event-detail--content">
            <?php if (!empty($arFields['DETAIL_TEXT'])): ?>
                <div class="event-detail--description">
                    <div class="event-detail--description--content">
                        <?= (LANGUAGE_ID === 'ru') ? $arFields['DETAIL_TEXT'] : $arProperties['DETAIL_TEXT' . LANG_PREFIX]['VALUE']['TEXT'] ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <?php if (!empty($arProperties['TEXT_BLOCK1' . LANG_PREFIX]['VALUE'])): ?>
            <div class="event-detail--content event-detail--content--wide">
                <div class="event-detail--content--wide-wrapper">
                    <div class="event-detail--detail-text">
                        <div class="event-detail--detail-text--content">
                            <?= html_entity_decode($arProperties['TEXT_BLOCK1' . LANG_PREFIX]['VALUE']['TEXT']) ?>
                        </div>
                    </div>
                </div>
                <?php if (!empty($arProperties['MENU']['VALUE'])): ?>
                    <div class="event-detail--menu--download">
                        <?= Events::getMenuLink($arProperties['MENU']['VALUE']) ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($arProperties['ACTIONS' . LANG_PREFIX]['VALUE'])): ?>
        <div class="event-detail--content">
            <div class="event-detail--description">
                <div class="event-detail--description--content">
                    <?= html_entity_decode($arProperties['ACTIONS' . LANG_PREFIX]['VALUE']['TEXT']) ?>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <?php if (!empty($arProperties['TEXT_BLOCK2' . LANG_PREFIX]['VALUE'])): ?>
            <div class="event-detail--content event-detail--content--wide">
                <div class="event-detail--content--wide-wrapper">
                    <div class="event-detail--detail-text">
                        <div class="delimiter"><?= renderIcon('delimiter') ?></div>
                        <div class="event-detail--detail-text--content">
                            <?= html_entity_decode($arProperties['TEXT_BLOCK2' . LANG_PREFIX]['VALUE']['TEXT']) ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="event-detail--order">
            <?= view('forms.order', [
                'APPLICATION' => $APPLICATION,
                'id' => 'event-order'
            ], false) ?>
        </div>

    </div>

<?php endif; ?>
