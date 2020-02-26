<?php

/**
 * @var string $mode
 * @var object $services \CIBlockElement
 */

use LapkinLab\{Core, Helper, Content\Services};

?>

<?php if ($services->result->num_rows === 0): ?>
    <div class="empty-content">Пусто...</div>
<?php endif; ?>

<?php if ($mode === 'list'): ?>
    <ul>
        <?php while ($service = $services->GetNextElement()): ?>
            <?php $arFields = $service->GetFields(); ?>
            <li><a href="<?= $arFields['DETAIL_PAGE_URL'] ?>" data-id="<?= $arFields['ID'] ?>"><?= $arFields['NAME'] ?></a></li>
        <?php endwhile; ?>
    </ul>

<?php elseif ($mode === 'card' || $mode === 'block'): ?>
    <div class="service-items">
        <?php while ($service = $services->GetNextElement()): ?>
            <?php $arFields = $service->GetFields(); ?>
            <?php $arProperties = $service->GetProperties(); ?>
            <div id="service-item-<?= $arFields['ID'] ?>" class="service-item" data-id="<?= $arFields['ID'] ?>">
                <div class="service-item--image">
                    <a href="<?= $arFields['DETAIL_PAGE_URL'] ?>">
                        <?= Services::getPreviewImage($arFields['PREVIEW_PICTURE'], $arFields['NAME'], 'img-fluid') ?>
                    </a>
                </div>
                <div class="service-item--content">
                    <div class="service-item--name">
                        <h2>
                            <a href="<?= $arFields['DETAIL_PAGE_URL'] ?>"><?= $arFields['NAME'] ?></a>
                        </h2>
                    </div>
                    <div class="service-item--actions">
                        <a href="<?= $arFields['DETAIL_PAGE_URL'] ?>" class="btn btn-white">Подробнее</a>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>

<?php endif; ?>
