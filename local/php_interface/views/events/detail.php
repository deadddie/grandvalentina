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
        <?php elseif (!empty($arFields['PREVIEW_PICTURE'])): ?>
            <div class="event-detail--image-main">
                <?= Events::getImage($arFields['PREVIEW_PICTURE'], $arFields['NAME'], 'img-fluid') ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($arProperties['NUMBER_SEATS'])): ?>
            <div class="event-detail--seats">
                <div class="event-detail--seats--value">до <span><?= $arProperties['NUMBER_SEATS']['VALUE'] ?></span> человек</div>
                <div class="delimiter"><?= Core::renderIcon('delimiter') ?></div>
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

        <div class="event-detail--order">
            <?= view('forms.event_order', [
                'APPLICATION' => $APPLICATION,
                'id' => 'event-order'
            ], false) ?>
        </div>

    </div>

<?php endif; ?>

<?php require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/epilog_after.php'); ?>
