<?php

/**
 * @var string $mode
 * @var object $offers \CIBlockElement
 */

use LapkinLab\{Core, Helper, Content\Offers};

?>

<?php if ($offers->result->num_rows === 0): ?>
    <div class="empty-content">Пусто...</div>
<?php endif; ?>

<?php if ($mode === 'list'): ?>
    <ul>
        <?php while ($offer = $offers->GetNextElement()): ?>
            <?php $arFields = $offer->GetFields(); ?>
            <li><a href="<?= $arFields['DETAIL_PAGE_URL'] ?>" data-id="<?= $arFields['ID'] ?>"><?= $arFields['NAME'] ?></a></li>
        <?php endwhile; ?>
    </ul>

<?php elseif ($mode === 'card' || $mode === 'archive' || $mode === 'block'): ?>
    <?php if ($mode === 'block'): ?>
        <section class="offer-block">
        <div class="offer-block--wrapper">
            <div class="offer-title">
                <h2>Спецпредложения</h2>
                <div class="delimiter"><?= renderIcon('delimiter') ?></div>
            </div>
    <?php endif; ?>
    <div class="offer-items">
        <?php while ($offer = $offers->GetNextElement()): ?>
            <?php $arFields = $offer->GetFields(); ?>
            <?php $arProperties = $offer->GetProperties(); ?>
            <div id="offer-item-<?= $arFields['ID'] ?>" class="offer-item" data-id="<?= $arFields['ID'] ?>">
                <div class="offer-item--image">
                    <a href="<?= $arFields['DETAIL_PAGE_URL'] ?>">
                        <?= Offers::getPreviewImage($arFields['PREVIEW_PICTURE'], $arFields['NAME'], 'img-fluid') ?>
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
    <?php if ($mode === 'block'): ?>
            <div class="offer-nav">
                <?= view('common.slider_navigation_block', ['type' => 'offer'], false) ?>
            </div>
            <div class="offer-all">
                <a href="/offers/">Cмотреть все акции</a>
            </div>
        </div>
        </section>
    <?php endif; ?>
    <?php if ($mode === 'archive' || $mode === 'card'): ?>
        <div class="offer-archive">
            <?php if ($mode === 'archive'): ?>
                <a href="/offers/">Смотреть активные акции</a>
            <?php else: ?>
                <a href="/offers/archive/">Смотреть архивные акции</a>
            <?php endif; ?>
        </div>
    <?php endif; ?>

<?php endif; ?>
