<?php

/**
 * @var string $mode
 * @var object $events \CIBlockElement
 */

use LapkinLab\{Core, Helper, Content\Events};
use Bitrix\Main\Localization\Loc;

?>

<?php if ($events->result->num_rows === 0): ?>
    <div class="empty-content"><?= Loc::getMessage('Empty') ?></div>
<?php endif; ?>

<?php if ($mode === 'list'): ?>
    <ul>
        <?php while ($event = $events->GetNextElement()): ?>
            <?php $arFields = $event->GetFields(); ?>
            <?php $arProperties = $event->GetProperties(); ?>
            <li>
                <a href="<?= $arFields['DETAIL_PAGE_URL'] ?>" data-id="<?= $arFields['ID'] ?>">
                    <?= (LANGUAGE_ID === 'ru') ? $arFields['NAME'] : $arProperties['NAME' . LANG_PREFIX]['VALUE'] ?>
                </a>
            </li>
        <?php endwhile; ?>
    </ul>

<?php elseif ($mode === 'card' || $mode === 'block'): ?>
    <div class="event-items">
        <?php while ($event = $events->GetNextElement()): ?>
            <?php $arFields = $event->GetFields(); ?>
            <?php $arProperties = $event->GetProperties(); ?>
            <div id="event-item-<?= $arFields['ID'] ?>" class="event-item" data-id="<?= $arFields['ID'] ?>">
                <div class="event-item--image">
                    <a href="<?= $arFields['DETAIL_PAGE_URL'] ?>">
                        <?= Events::getPreviewImage($arFields['PREVIEW_PICTURE'], (LANGUAGE_ID === 'ru') ? $arFields['NAME'] : $arProperties['NAME' . LANG_PREFIX]['VALUE'], 'img-fluid') ?>
                    </a>
                </div>
                <div class="event-item--content">
                    <div class="event-item--name">
                        <h2>
                            <a href="<?= $arFields['DETAIL_PAGE_URL'] ?>">
                                <?= (LANGUAGE_ID === 'ru') ? $arFields['NAME'] : $arProperties['NAME' . LANG_PREFIX]['VALUE'] ?>
                            </a>
                        </h2>
                    </div>
                    <div class="event-item--actions">
                        <?php if (!empty($arProperties['NUMBER_SEATS'])): ?>
                            <div class="event-item--seats">
                                <?= Loc::getMessage('Number of seats until to the') ?> <?= $arProperties['NUMBER_SEATS']['VALUE'] ?> <?= Loc::getMessage('persons') ?>
                            </div>
                        <?php endif; ?>
                        <a href="<?= $arFields['DETAIL_PAGE_URL'] ?>" class="btn btn-white"><?= Loc::getMessage('Read more') ?></a>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>

<?php endif; ?>
