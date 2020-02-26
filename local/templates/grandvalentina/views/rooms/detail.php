<?php

/**
 * @var object $room \CIBlockElement
 */

use LapkinLab\{Core, Helper, Content\Rooms};

require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

if ($room):
    $arFields = $room->GetFields();
    $arProperties = $room->GetProperties();

    $APPLICATION->SetTitle($arFields['NAME']);
    $APPLICATION->AddChainItem('Номера', '/rooms/');

    ?>
    <h1 class="room-detail--title page-title"><?= $arFields['NAME'] ?></h1>

    <div class="room-detail">

        <? /*
        <div class="room-item--content">
            <div class="room-detail--promo"></div>
        </div>
        */ ?>

        <?php if (!empty($arProperties['MORE_PHOTO']['VALUE'])): ?>
            <div class="room-detail--images">
                <?= Rooms::getMoreImages($arProperties['MORE_PHOTO']['VALUE'], $arFields['NAME']) ?>
                <div class="room-detail--images--nav">
                    <?= view('common.slider_navigation', ['type' => 'room'], false) ?>
                </div>
                <div class="room-detail--stickers">
                    <?php if (!empty($arProperties['HIT']) && $arProperties['HIT']['VALUE'] === 'Y'): ?>
                        <div class="room-item--sticker room-item--sticker--hit"><span><?= $arProperties['HIT']['NAME'] ?></span></div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>

        <div class="room-detail--content">

            <div class="room-detail--price-wrapper">
                <div class="room-detail--price">
                    от <?= Helper::priceFormat($arProperties['PRICE']['VALUE']) ?> <?= renderIcon('rouble') ?>
                </div>

                <div class="room-detail--info">
                    <div class="room-detail--info--customers">
                        <?php if ($arProperties['CAPACITY']['VALUE'] > 0): ?>
                            <?php for ($i = (int)$arProperties['CAPACITY']['VALUE']; $i > 0; $i--): ?>
                                <?= renderIcon('user') ?>
                            <?php endfor; ?>
                        <?php endif; ?>
                    </div>

                    <div class="room-detail--info--room">
                        <?= renderIcon('info', 'js-room-detail-info') ?>
                        <?php $number = ($arProperties['NUMBER']['VALUE'] > 0) ? $arProperties['NUMBER']['VALUE'] : 1; ?>
                        <?= $number . '&nbsp;' . Helper::getWordForms('number', $number) ?>,
                        <?= $arProperties['SQUARE']['VALUE'] ?> кв.м.
                    </div>
                </div>

                <a href="<?= $arProperties['BOOKING_LINK']['VALUE'] ?>"
                   class="room-detail--price-book btn btn-wide btn-default">Забронировать номер</a>
            </div>

            <div class="room-detail--actions">
                <a href="<?= $arProperties['BOOKING_LINK']['VALUE'] ?>" class="btn btn-wide btn-default">Забронировать номер</a>
            </div>

            <?php if (!empty($arFields['DESCRIPTION'])): ?>
                <div class="room-detail--description">
                    <div class="room-detail--description--title">Описание <?= renderIcon('shevron') ?></div>
                    <div class="room-detail--description--content">
                        <?= Rooms::getRoomServices($arFields['DESCRIPTION']) ?>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (!empty($arProperties['ROOM_SERVICES']['VALUE'])): ?>
                <div class="room-detail--room-services js-wrap active">
                    <div class="room-detail--room-services--title js-wrap-title">Услуги <?= renderIcon('shevron') ?></div>
                    <div class="room-detail--room-services--content js-wrap-content">
                        <?= Rooms::getRoomServices($arProperties['ROOM_SERVICES']['VALUE']) ?>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (!empty($arProperties['ACCOMODATIONS']['VALUE'])): ?>
                <div class="room-detail--accomodations js-wrap">
                    <div class="room-detail--accomodations--title js-wrap-title">Условия проживания <?= renderIcon('shevron') ?></div>
                    <div class="room-detail--accomodations--content js-wrap-content">
                        <?= htmlspecialcharsBack($arProperties['ACCOMODATIONS']['VALUE']['TEXT']) ?>
                    </div>
                </div>
            <?php endif; ?>

            <div class="room-detail--3d">
                <button class="btn btn-link">3D-тур</button>
                <div class="delimiter"><?= renderIcon('delimiter') ?></div>
            </div>

            <div class="room-detail--image-main">
                <?= Rooms::getPreviewImage($arFields['PREVIEW_PICTURE'], $arFields['NAME'], 'img-fluid') ?>
            </div>
        </div>

        <div class="room-detail--content room-detail--content-bottom">

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
