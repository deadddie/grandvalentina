<?php

/**
 * @var string $mode
 * @var object $restaurants \CIBlockElement
 */

use LapkinLab\{Core, Helper, Content\Restaurants};

?>

<?php if ($restaurants->result->num_rows === 0): ?>
    <div class="empty-content">Пусто...</div>
<?php endif; ?>

<?php if ($mode === 'list'): ?>
    <ul>
        <?php while ($restaurant = $restaurants->GetNextElement()): ?>
            <?php $arFields = $restaurant->GetFields(); ?>
            <li><a href="<?= $arFields['DETAIL_PAGE_URL'] ?>" data-id="<?= $arFields['ID'] ?>"><?= $arFields['NAME'] ?></a></li>
        <?php endwhile; ?>
    </ul>

<?php elseif ($mode === 'card' || $mode === 'block'): ?>
    <div class="restaurant-items">
        <?php while ($restaurant = $restaurants->GetNextElement()): ?>
            <?php $arFields = $restaurant->GetFields(); ?>
            <?php $arProperties = $restaurant->GetProperties(); ?>
            <div id="restaurant-item-<?= $arFields['ID'] ?>" class="restaurant-item" data-id="<?= $arFields['ID'] ?>">
                <div class="restaurant-item--image">
                    <a href="<?= $arFields['DETAIL_PAGE_URL'] ?>">
                        <?= Restaurants::getPreviewImage($arFields['PREVIEW_PICTURE'], $arFields['NAME'], 'img-fluid') ?>
                    </a>
                </div>
                <div class="restaurant-item--content">
                    <div class="restaurant-item--name">
                        <h2>
                            <a href="<?= $arFields['DETAIL_PAGE_URL'] ?>"><?= $arFields['NAME'] ?></a>
                        </h2>
                    </div>
                    <?php if (!empty($arFields['PREVIEW_TEXT'])): ?>
                        <div class="restaurant-item--description">
                            <?= Core::mbCutString($arFields['PREVIEW_TEXT']) ?>
                        </div>
                    <?php endif; ?>
                    <div class="restaurant-item--actions">
                        <a href="<?= $arFields['DETAIL_PAGE_URL'] ?>" class="btn btn-white">Подробнее</a>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>

<?php endif; ?>
