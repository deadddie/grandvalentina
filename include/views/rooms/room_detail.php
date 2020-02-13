<?php

/**
 * @var object $room \CIBlockElement
 */

use LapkinLab\{Core, Content, Helper};

require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

if ($room):
    $arFields = $room->GetFields();
    $arProperties = $room->GetProperties();

    $APPLICATION->SetTitle($arFields['NAME']);
    $APPLICATION->AddChainItem('Номера', '/rooms/');

    //dump($arProperties['MORE_PHOTO']);
    ?>
    <h1 class="page-title"><?= $arFields['NAME'] ?></h1>

    <div class="room-detail">

        <?/*
        <div class="room-item--content">
            <div class="room-detail--promo"></div>
        </div>
        */?>

        <?php if (!empty($arProperties['MORE_PHOTO']['VALUE'])): ?>
        <div class="room-detail--images">
            <?= Content::getRoomMoreImages($arProperties['MORE_PHOTO']['VALUE'], $arFields['NAME']) ?>
            <div class="room-detail--images--nav">
                <div class="room-slider--navigation">
                    <div class="room-slider--counter"><span class="current"></span>/<span class="total"></span></div>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <div class="room-item--content">

            <div class="room-detail--price">
                от <?= Helper::priceFormat($arProperties['PRICE']['VALUE']) ?> <?= Core::renderIcon('rouble') ?>
            </div>

            <div class="room-detail--info">
                <div class="room-detail--info--customers">
                    <?php if ($arProperties['CAPACITY']['VALUE'] > 0): ?>
                        <?php for ($i = (int) $arProperties['CAPACITY']['VALUE']; $i > 0; $i--): ?>
                            <?= Core::renderIcon('user') ?>
                        <?php endfor; ?>
                    <?php endif; ?>
                </div>

                <div class="room-detail--info--room">
                    <?= Core::renderIcon('info', 'js-room-detail-info') ?>
                    <?php $number = ($arProperties['NUMBER']['VALUE'] > 0) ? $arProperties['NUMBER']['VALUE'] : 1; ?>
                    <?= $number . '&nbsp;' . Helper::getWordForms('number', $number) ?>,
                    <?= $arProperties['SQUARE']['VALUE'] ?> кв.м.
                </div>
            </div>

            <div class="room-detail--actions">
                <a href="<?= $arProperties['BOOKING_LINK']['VALUE'] ?>" class="btn btn-wide btn-default">Забронировать номер</a>
            </div>

            <?php if (!empty($arFields['DESCRIPTION'])): ?>
                <div class="room-detail--description">
                    <div class="room-detail--description--title">Описание <?= Core::renderIcon('shevron') ?></div>
                    <div class="room-detail--description--content">
                        <?= Content::getRoomServices($arFields['DESCRIPTION']) ?>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (!empty($arProperties['ROOM_SERVICES']['VALUE'])): ?>
                <div class="room-detail--room-services">
                    <div class="room-detail--room-services--title">Услуги <?= Core::renderIcon('shevron') ?></div>
                    <div class="room-detail--room-services--content">
                        <?= Content::getRoomServices($arProperties['ROOM_SERVICES']['VALUE']) ?>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (!empty($arProperties['ACCOMODATIONS']['VALUE'])): ?>
                <div class="room-detail--accomodations">
                    <div class="room-detail--accomodations--title">Условия проживания <?= Core::renderIcon('shevron') ?></div>
                    <div class="room-detail--accomodations--content">
                        <?= htmlspecialcharsBack($arProperties['ACCOMODATIONS']['VALUE']['TEXT']) ?>
                    </div>
                </div>
            <?php endif; ?>

            <div class="room-detail--3d">
                <button class="btn btn-link">3D-тур</button>
                <div class="delimiter"><?= Core::renderIcon('delimiter') ?></div>
            </div>

            <div class="room-item--stickers">
                <?php if (!empty($arProperties['HIT']) && $arProperties['HIT']['VALUE'] === 'Y'): ?>
                    <div class="room-item--stickers--hit"><span><?= $arProperties['HIT']['NAME'] ?></span></div>
                <?php endif; ?>
            </div>

        </div>

        <div class="room-detail--image-main">
            <?= Content::getRoomImage($arFields['PREVIEW_PICTURE'], $arFields['NAME'], 'img-fluid') ?>
            <?php
            $preview_image = \CFile::GetByID($arFields['PREVIEW_PICTURE'])->GetNext();
            $resized_preview = Core::resizeImage($preview_image, false, 720, 480);
            ?>
            <img src="<?= $resized_preview['src'] ?>" alt="<?= $arFields['NAME'] ?>" class="img-fluid">
        </div>

        <div class="room-item--content">

            <div class="room-detail--actions room-detail--actions--bottom">
                <a href="<?= $arProperties['BOOKING_LINK']['VALUE'] ?>" class="btn btn-wide btn-default">Забронировать номер</a>
            </div>

            <div class="room-detail--backlink">
                <a href="/rooms/">Вернуться к списку номеров</a>
            </div>

        </div>

    </div>

<?php endif; ?>

<?php require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/epilog_after.php'); ?>
