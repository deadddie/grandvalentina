<?php

/**
 * @var string $mode
 * @var object $rooms \CIBlockElement
 */

use LapkinLab\{Core, Helper, Content\Rooms};

?>

<?php if ($mode === 'list'): ?>
    <ul>
        <?php while ($room = $rooms->GetNextElement()): ?>
            <?php $arFields = $room->GetFields(); ?>
            <li><a href="<?= $arFields['DETAIL_PAGE_URL'] ?>" data-id="<?= $arFields['ID'] ?>"><?= $arFields['NAME'] ?></a></li>
        <?php endwhile; ?>
    </ul>

<?php elseif ($mode === 'card'): ?>
    <div class="room-items">
        <?php while ($room = $rooms->GetNextElement()): ?>
            <?php $arFields = $room->GetFields(); ?>
            <?php $arProperties = $room->GetProperties(); ?>
            <div id="room-item-<?= $arFields['ID'] ?>" class="room-item" data-id="<?= $arFields['ID'] ?>">
                <div class="room-item--image">
                    <a href="<?= $arFields['DETAIL_PAGE_URL'] ?>">
                        <?= Rooms::getImage($arFields['PREVIEW_PICTURE'], $arFields['NAME'], 'img-fluid') ?>
                    </a>
                </div>
                <div class="room-item--content">
                    <div class="room-item--name">
                        <h2>
                            <a href="<?= $arFields['DETAIL_PAGE_URL'] ?>"><?= $arFields['NAME'] ?></a>
                        </h2>
                    </div>
                    <div class="room-item--description"><?= $arFields['PREVIEW_TEXT'] ?></div>
                    <div class="room-item--info">
                        <div class="room-item--info--customers">
                            <?php if ($arProperties['CAPACITY']['VALUE'] > 0): ?>
                                <?php for ($i = (int) $arProperties['CAPACITY']['VALUE']; $i > 0; $i--): ?>
                                    <?= Core::renderIcon('user') ?>
                                <?php endfor; ?>
                            <?php endif; ?>
                        </div>
                        <div class="room-item--info--room">
                            <?php $number = ($arProperties['NUMBER']['VALUE'] > 0) ? $arProperties['NUMBER']['VALUE'] : 1; ?>
                            <?= $number . '&nbsp;' . Helper::getWordForms('number', $number) ?>,
                            <?= $arProperties['SQUARE']['VALUE'] ?> кв.м.
                        </div>
                    </div>
                    <div class="room-item--actions">
                        <a href="<?= $arProperties['BOOKING_LINK']['VALUE'] ?>" class="btn btn-white">Забронировать</a>
                        <a href="<?= $arFields['DETAIL_PAGE_URL'] ?>" class="btn btn-link">Подробнее</a>
                    </div>
                    <div class="room-item--stickers">
                        <?php if (!empty($arProperties['HIT']) && $arProperties['HIT']['VALUE'] === 'Y'): ?>
                        <div class="room-item--stickers--hit"><span><?= $arProperties['HIT']['NAME'] ?></span></div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>

<?php endif; ?>
