<?php

/**
 * @var object $service \CIBlockElement
 */

use LapkinLab\{Core, Helper, Content\Services};

require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

if ($service):
    $arFields = $service->GetFields();
    $arProperties = $service->GetProperties();

    $APPLICATION->SetTitle($arFields['NAME']);
    $APPLICATION->AddChainItem('Услуги', '/services/');

    ?>
    <h1 class="page-title"><?= $arFields['NAME'] ?></h1>

    <div class="service-detail">

        <div class="service-detail--image-main">
            <?= Services::getPreviewImage($arFields['PREVIEW_PICTURE'], $arFields['NAME'], 'img-fluid') ?>
        </div>

        <div class="service-detail--content">

            <?php if (!empty($arFields['DETAIL_TEXT'])): ?>
                <div class="service-detail--description">
                    <div class="service-detail--description--content">
                        <?= $arFields['DETAIL_TEXT'] ?>
                    </div>
                </div>
            <?php endif; ?>

        </div>

    </div>

<?php endif; ?>

<?php require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/epilog_after.php'); ?>
