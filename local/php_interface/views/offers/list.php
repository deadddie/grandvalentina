<?php

/**
 * @var string $mode
 * @var object $offers \CIBlockElement
 */

use LapkinLab\{Core, Helper, Content\Offers};

?>

<?php if ($mode === 'list'): ?>
    <ul>
        <?php while ($offer = $offers->GetNextElement()): ?>
            <?php $arFields = $offer->GetFields(); ?>
            <li><a href="<?= $arFields['DETAIL_PAGE_URL'] ?>" data-id="<?= $arFields['ID'] ?>"><?= $arFields['NAME'] ?></a></li>
        <?php endwhile; ?>
    </ul>

<?php elseif ($mode === 'card'): ?>
    <div class="offer-items">
        <?php while ($offer = $offers->GetNextElement()): ?>
            <?php $arFields = $offer->GetFields(); ?>
            <?php $arProperties = $offer->GetProperties(); ?>
            <div id="offer-item-<?= $arFields['ID'] ?>" class="offer-item" data-id="<?= $arFields['ID'] ?>">
                <div class="offer-item--image">
                    <a href="<?= $arFields['DETAIL_PAGE_URL'] ?>">
                        <?= Offers::getImage($arFields['PREVIEW_PICTURE'], $arFields['NAME'], 'img-fluid') ?>
                    </a>
                </div>
                <div class="offer-item--content">
                    <div class="offer-item--name">
                        <h2>
                            <a href="<?= $arFields['DETAIL_PAGE_URL'] ?>"><?= $arFields['NAME'] ?></a>
                        </h2>
                    </div>
                    <div class="offer-item--actions">
                        <a href="<?= $arFields['DETAIL_PAGE_URL'] ?>" class="btn btn-white">Подробнее</a>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>

<?php endif; ?>