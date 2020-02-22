<?php

/**
 * @var object $offer \CIBlockElement
 */

use LapkinLab\{Core, Helper, Content\Offers};

require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

if ($offer):
    $arFields = $offer->GetFields();
    $arProperties = $offer->GetProperties();

    $APPLICATION->SetTitle($arFields['NAME']);
    $APPLICATION->AddChainItem('Специальные предложения', '/offers/');

    ?>
    <h1 class="page-title"><?= $arFields['NAME'] ?></h1>

    <div class="offer-detail">

        <div class="offer-detail--content">
            <button type="button" class="btn btn-wide js-open-modal" data-action="openModal" data-modal="callback">Уточнить информацию</button>
        </div>

        <?php if (!empty($arProperties['MORE_PHOTOS']['VALUE'])): ?>
            <div class="offer-detail--images">
                <?= Offers::getMoreImages($arProperties['MORE_PHOTOS']['VALUE'], $arFields['NAME']) ?>
                <?php if (count($arProperties['MORE_PHOTOS']['VALUE']) > 1): ?>
                    <div class="offer-detail--images--nav">
                        <?= view('common.slider_navigation', ['type' => 'offer'], false) ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php elseif (!empty($arFields['PREVIEW_PICTURE'])): ?>
            <div class="offer-detail--image-main">
                <?= Offers::getImage($arFields['PREVIEW_PICTURE'], $arFields['NAME'], 'img-fluid') ?>
            </div>
        <?php endif; ?>

        <div class="offer-detail--content">

            <?php if (!empty($arFields['DETAIL_TEXT'])): ?>
                <div class="offer-detail--description">
                    <div class="offer-detail--description--content">
                        <?= $arFields['DETAIL_TEXT'] ?>
                    </div>
                </div>
            <?php endif; ?>

            <div class="offer-detail--backlink">
                <a href="/offers/">Вернуться к списку акций</a>
            </div>
            <div class="offer-detail--phone">
                Звоните: <?= Core::parsePhone(SITE_CONFIG['phones']['booking'], 'link') ?>
            </div>
        </div>

    </div>

<?php endif; ?>

<?php require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/epilog_after.php'); ?>
