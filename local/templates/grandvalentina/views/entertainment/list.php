<?php

/**
 * @var string $mode
 * @var object $entertainments \CIBlockElement
 */

use LapkinLab\{Core, Helper, Content\Entertainment};

?>

<?php if ($mode === 'list'): ?>
    <ul>
        <?php while ($entertainment = $entertainments->GetNextElement()): ?>
            <?php $arFields = $entertainment->GetFields(); ?>
            <li><a href="<?= $arFields['DETAIL_PAGE_URL'] ?>" data-id="<?= $arFields['ID'] ?>"><?= $arFields['NAME'] ?></a></li>
        <?php endwhile; ?>
    </ul>

<?php elseif ($mode === 'card' || $mode === 'block'): ?>
    <div class="entertainment-items">
        <?php while ($entertainment = $entertainments->GetNextElement()): ?>
            <?php $arFields = $entertainment->GetFields(); ?>
            <?php $arProperties = $entertainment->GetProperties(); ?>
            <div id="entertainment-item-<?= $arFields['ID'] ?>" class="entertainment-item" data-id="<?= $arFields['ID'] ?>">
                <div class="entertainment-item--image">
                    <a href="<?= $arFields['DETAIL_PAGE_URL'] ?>">
                        <?= Entertainment::getImage($arFields['PREVIEW_PICTURE'], $arFields['NAME'], 'img-fluid') ?>
                    </a>
                </div>
                <div class="entertainment-item--content">
                    <div class="entertainment-item--name">
                        <h2>
                            <a href="<?= $arFields['DETAIL_PAGE_URL'] ?>"><?= $arFields['NAME'] ?></a>
                        </h2>
                    </div>
                    <div class="entertainment-item--actions">
                        <a href="<?= $arFields['DETAIL_PAGE_URL'] ?>" class="btn btn-white">Подробнее</a>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>

<?php endif; ?>
