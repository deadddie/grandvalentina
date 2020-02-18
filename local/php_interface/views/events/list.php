<?php

/**
 * @var string $mode
 * @var object $events \CIBlockElement
 */

use LapkinLab\{Core, Helper, Content\Events};

?>

<?php if ($mode === 'list'): ?>
    <ul>
        <?php while ($event = $events->GetNextElement()): ?>
            <?php $arFields = $event->GetFields(); ?>
            <li><a href="<?= $arFields['DETAIL_PAGE_URL'] ?>" data-id="<?= $arFields['ID'] ?>"><?= $arFields['NAME'] ?></a></li>
        <?php endwhile; ?>
    </ul>

<?php elseif ($mode === 'card'): ?>
    <div class="event-items">
        <?php while ($event = $events->GetNextElement()): ?>
            <?php $arFields = $event->GetFields(); ?>
            <?php $arProperties = $event->GetProperties(); ?>
            <div id="event-item-<?= $arFields['ID'] ?>" class="event-item" data-id="<?= $arFields['ID'] ?>">
                <div class="event-item--image">
                    <a href="<?= $arFields['DETAIL_PAGE_URL'] ?>">
                        <?= Events::getImage($arFields['PREVIEW_PICTURE'], $arFields['NAME'], 'img-fluid') ?>
                    </a>
                </div>
                <div class="event-item--content">
                    <div class="event-item--name">
                        <h2>
                            <a href="<?= $arFields['DETAIL_PAGE_URL'] ?>"><?= $arFields['NAME'] ?></a>
                        </h2>
                    </div>
                    <div class="event-item--actions">
                        <?php if (!empty($arProperties['NUMBER_SEATS'])): ?>
                            <div class="event-item--seats">Количество мест: до <?= $arProperties['NUMBER_SEATS']['VALUE'] ?> человек</div>
                        <?php endif; ?>
                        <a href="<?= $arFields['DETAIL_PAGE_URL'] ?>">Подробнее</a>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>

<?php endif; ?>
