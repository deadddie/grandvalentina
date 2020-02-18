<?php

/**
 * @var object $blog \CIBlockElement
 */

use LapkinLab\{Core, Helper, Content\Blog};

require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

if ($blog):
    $arFields = $blog->GetFields();
    $arProperties = $blog->GetProperties();

    $APPLICATION->SetTitle($arFields['NAME']);
    $APPLICATION->AddChainItem('Блоги', '/blog/');

    ?>
    <h1 class="page-title"><?= $arFields['NAME'] ?></h1>

    <div class="blog-detail">

        <div class="blog-detail--image-main">
            <?= Blog::getImage($arFields['PREVIEW_PICTURE'], $arFields['NAME'], 'img-fluid') ?>
        </div>

        <div class="blog-detail--content">

            <?php if (!empty($arFields['DETAIL_TEXT'])): ?>
                <div class="blog-detail--description">
                    <div class="blog-detail--description--content">
                        <?= $arFields['DETAIL_TEXT'] ?>
                    </div>
                </div>
            <?php endif; ?>

        </div>

    </div>

<?php endif; ?>

<?php require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/epilog_after.php'); ?>
