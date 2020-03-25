<?php

/**
 * @var object $entertainment \CIBlockElement
 */

use LapkinLab\{Core, Helper, Content\Entertainment};
use Bitrix\Main\Localization\Loc;

require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

if ($entertainment):
    $arFields = $entertainment->GetFields();
    $arProperties = $entertainment->GetProperties();

    $APPLICATION->SetTitle($arFields['NAME']);
    $APPLICATION->AddChainItem(Loc::getMessage('Entertainments'), '/entertainment/');

    ?>
    <h1 class="page-title"><?= $arFields['NAME'] ?></h1>

    <div class="entertainment-detail">

        <?php if (!empty($arFields['DETAIL_PICTURE'])): ?>
            <div class="entertainment-detail--image-main">
                <?= Entertainment::getDetailImage($arFields['DETAIL_PICTURE'], $arFields['NAME'], 'img-fluid') ?>
            </div>
        <?php endif; ?>

        <div class="entertainment-detail--content">

            <?php if (!empty($arFields['PREVIEW_TEXT'])): ?>
                <div class="entertainment-detail--description">
                    <div class="entertainment-detail--description--content">
                        <?= $arFields['PREVIEW_TEXT'] ?>
                    </div>
                </div>
            <?php endif; ?>

        </div>

        <?php if (!empty($arProperties['MORE_PHOTOS']['VALUE'])): ?>
            <div class="entertainment-detail--images">
                <?= Entertainment::getMoreImages($arProperties['MORE_PHOTOS']['VALUE'], $arFields['NAME']) ?>
                <?php if (count($arProperties['MORE_PHOTOS']['VALUE']) > 1): ?>
                    <div class="entertainment-detail--images--nav">
                        <?= view('common.slider_navigation', ['type' => 'entertainment'], false) ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <div class="entertainment-detail--content">

            <?php if (!empty($arFields['DETAIL_TEXT'])): ?>
                <div class="entertainment-detail--description">
                    <div class="entertainment-detail--description--content">
                        <?= $arFields['DETAIL_TEXT'] ?>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (!empty($arProperties['PROMO']['VALUE'])): ?>
                <div class="entertainment-detail--promo">
                    <div class="delimiter"><?= renderIcon('delimiter') ?></div>
                    <div class="entertainment-detail--promo--content">
                        <?= html_entity_decode($arProperties['PROMO']['VALUE']['TEXT']) ?>
                    </div>
                </div>
            <?php endif; ?>

        </div>

    </div>

<?php endif; ?>
