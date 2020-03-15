<?php

/**
 * @var object $event \CIBlockElement
 */

use LapkinLab\{Core, Helper, Content\Events};

require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

if ($event):
    $arFields = $event->GetFields();
    $arProperties = $event->GetProperties();

    $APPLICATION->SetTitle($arFields['NAME']);
    $APPLICATION->AddChainItem('Мероприятия', '/events/');

    ?>
    <h1 class="page-title"><?= $arFields['NAME'] ?></h1>

    <div class="event-detail">

        <?php if (!empty($arProperties['MORE_PHOTOS']['VALUE'])): ?>
            <div class="event-detail--images">
                <?= Events::getMoreImages($arProperties['MORE_PHOTOS']['VALUE'], $arFields['NAME']) ?>
                <?php if (count($arProperties['MORE_PHOTOS']['VALUE']) > 1): ?>
                    <div class="event-detail--images--nav">
                        <?= view('common.slider_navigation', ['type' => 'event'], false) ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php elseif (!empty($arFields['DETAIL_PICTURE'])): ?>
            <div class="event-detail--image-main">
                <?= Events::getDetailImage($arFields['DETAIL_PICTURE'], $arFields['NAME'], 'img-fluid') ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($arProperties['NUMBER_SEATS'])): ?>
            <div class="event-detail--seats">
                <div class="event-detail--seats--value">до <span><?= $arProperties['NUMBER_SEATS']['VALUE'] ?></span> человек</div>
                <div class="delimiter"><?= renderIcon('delimiter') ?></div>
                <div class="event-detail--seats--description">Количество мест в<br><?= mb_strtolower($arFields['NAME']) ?>е</div>
            </div>
        <?php endif; ?>

        <div class="event-detail--content">
            <?php if (!empty($arFields['DETAIL_TEXT'])): ?>
                <div class="event-detail--description">
                    <div class="event-detail--description--content">
                        <?= $arFields['DETAIL_TEXT'] ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <?php if (!empty($arProperties['TEXT_BLOCK1']['VALUE'])): ?>
            <div class="event-detail--content event-detail--content--wide">
                <div class="event-detail--content--wide-wrapper">
                    <div class="event-detail--detail-text">
                        <div class="event-detail--detail-text--content">
                            <?= html_entity_decode($arProperties['TEXT_BLOCK1']['VALUE']['TEXT']) ?>
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

        <?php if (!empty($arProperties['ACTIONS']['VALUE'])): ?>
        <div class="event-detail--content">
            <div class="event-detail--description">
                <div class="event-detail--description--content">
                    <?= html_entity_decode($arProperties['ACTIONS']['VALUE']['TEXT']) ?>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <?php if (!empty($arProperties['TEXT_BLOCK2']['VALUE'])): ?>
            <div class="event-detail--content event-detail--content--wide">
                <div class="event-detail--content--wide-wrapper">
                    <div class="event-detail--detail-text">
                        <div class="delimiter"><?= renderIcon('delimiter') ?></div>
                        <div class="event-detail--detail-text--content">
                            <?= html_entity_decode($arProperties['TEXT_BLOCK2']['VALUE']['TEXT']) ?>
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
