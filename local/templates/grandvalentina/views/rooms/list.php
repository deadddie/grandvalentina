<?php

/**
 * @var string $mode
 * @var object $rooms \CIBlockElement
 */

use LapkinLab\{Helper, Content\Rooms};
use Bitrix\Main\Localization\Loc;

?>

<?php if ($events->result->num_rows === 0): ?>
    <div class="empty-content"><?= Loc::getMessage('Empty') ?></div>
<?php endif; ?>

<?php if ($mode === 'list'): ?>
    <ul>
        <?php while ($room = $rooms->GetNextElement()): ?>
            <?php $arFields = $room->GetFields(); ?>
            <?php $arProperties = $room->GetProperties(); ?>
            <li>
                <a href="<?= $arFields['DETAIL_PAGE_URL'] ?>" data-id="<?= $arFields['ID'] ?>">
                    <?= (LANGUAGE_ID === 'ru') ? $arFields['NAME'] : $arProperties['NAME' . LANG_PREFIX]['VALUE'] ?>
                </a>
            </li>
        <?php endwhile; ?>
    </ul>

<?php elseif ($mode === 'card' || $mode === 'block'): ?>
    <?php if ($mode === 'block'): ?>
        <section class="room-block">
        <div class="room-block--wrapper">
            <div class="room-title">
                <h2><?= Loc::getMessage('Rooms') ?></h2>
                <div class="delimiter"><?= renderIcon('delimiter') ?></div>
            </div>
    <?php endif; ?>
    <div class="room-items">
        <?php while ($room = $rooms->GetNextElement()): ?>
            <?php $arFields = $room->GetFields(); ?>
            <?php $arProperties = $room->GetProperties(); ?>
            <?php $booking_link = Helper::addGetParameters($arProperties['BOOKING_LINK']['VALUE'], ['id' => $arFields['ID']]); ?>
            <div id="room-item-<?= $arFields['ID'] ?>" class="room-item" data-id="<?= $arFields['ID'] ?>">
                <div class="room-item--image">
                    <a href="<?= $arFields['DETAIL_PAGE_URL'] ?>">
                        <?= Rooms::getPreviewImage($arFields['PREVIEW_PICTURE'], (LANGUAGE_ID === 'ru') ? $arFields['NAME'] : $arProperties['NAME' . LANG_PREFIX]['VALUE'], 'img-fluid') ?>
                    </a>
                </div>
                <div class="room-item--content">
                    <div class="room-item--name">
                        <h2>
                            <a href="<?= $arFields['DETAIL_PAGE_URL'] ?>">
                                <?= (LANGUAGE_ID === 'ru') ? $arFields['NAME'] : $arProperties['NAME' . LANG_PREFIX]['VALUE'] ?>
                            </a>
                        </h2>
                    </div>
                    <div class="room-item--description">
                        <?= Helper::mbCutString((LANGUAGE_ID === 'ru') ? $arFields['PREVIEW_TEXT'] : $arProperties['PREVIEW_TEXT' . LANG_PREFIX]['VALUE']) ?>
                    </div>
                    <div class="room-item--info">
                        <?php if (!empty($arProperties['CAPACITY']['VALUE'])): ?>
                            <div class="room-item--info--customers">
                                <?php switch ($arProperties['CAPACITY']['VALUE']):
                                    case '1+1':
                                        print renderIcon('user') . ' + ' . renderIcon('user');
                                        break;
                                    case '2+1':
                                        print renderIcon('user') . renderIcon('user') . ' + ' . renderIcon('user');
                                        break;
                                    case '3+1':
                                        print renderIcon('user') . renderIcon('user') . renderIcon('user') . ' + ' . renderIcon('user');
                                    default:
                                endswitch; ?>
                            </div>
                        <?php endif; ?>
                        <div class="room-item--info--room">
                            <?php $number = ($arProperties['NUMBER']['VALUE'] > 0) ? $arProperties['NUMBER']['VALUE'] : 1; ?>
                            <?= $number . '&nbsp;' . Helper::getWordForms('number', $number) ?>,
                            <?= $arProperties['SQUARE']['VALUE'] ?> <?= Loc::getMessage('square meters') ?>
                        </div>
                    </div>
                    <div class="room-item--actions">
                        <a href="<?= $booking_link ?>" class="btn btn-white"><?= Loc::getMessage('Booking room') ?></a>
                        <a href="<?= $arFields['DETAIL_PAGE_URL'] ?>" class="btn btn-link"><?= Loc::getMessage('More details') ?></a>
                    </div>
                    <div class="room-item--stickers">
                        <?php if (!empty($arProperties['HIT']) && $arProperties['HIT']['VALUE'] === 'Y'): ?>
                        <div class="room-item--sticker room-item--sticker--hit"><span><?= $arProperties['HIT']['NAME'] ?></span></div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
    <?php if ($mode === 'block'): ?>
            <div class="room-nav">
                <?= view('common.slider_navigation_block', ['type' => 'room'], false) ?>
            </div>
            <div class="room-all">
                <a href="/rooms/"><?= Loc::getMessage('Show all rooms') ?></a>
            </div>
        </div>
        </section>
    <?php endif; ?>
<?php endif; ?>
