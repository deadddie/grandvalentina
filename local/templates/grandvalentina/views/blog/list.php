<?php

/**
 * @var string $mode
 * @var object $blogs \CIBlockElement
 */

use LapkinLab\{Core, Helper, Content\Blog};

?>

<?php if ($mode === 'list'): ?>
    <ul>
        <?php while ($blog = $blogs->GetNextElement()): ?>
            <?php $arFields = $blog->GetFields(); ?>
            <li><a href="<?= $arFields['DETAIL_PAGE_URL'] ?>" data-id="<?= $arFields['ID'] ?>"><?= $arFields['NAME'] ?></a></li>
        <?php endwhile; ?>
    </ul>

<?php elseif ($mode === 'card' || $mode === 'block'): ?>
    <div class="blog-items">
        <?php while ($blog = $blogs->GetNextElement()): ?>
            <?php $arFields = $blog->GetFields(); ?>
            <?php $arProperties = $blog->GetProperties(); ?>
            <div id="blog-item-<?= $arFields['ID'] ?>" class="blog-item" data-id="<?= $arFields['ID'] ?>">
                <div class="blog-item--image">
                    <a href="<?= $arFields['DETAIL_PAGE_URL'] ?>">
                        <?= Blog::getPreviewImage($arFields['PREVIEW_PICTURE'], $arFields['NAME'], 'img-fluid') ?>
                    </a>
                </div>
                <div class="blog-item--content">
                    <div class="blog-item--name">
                        <h2>
                            <a href="<?= $arFields['DETAIL_PAGE_URL'] ?>"><?= $arFields['NAME'] ?></a>
                        </h2>
                    </div>
                    <div class="blog-item--actions">
                        <a href="<?= $arFields['DETAIL_PAGE_URL'] ?>">Читать статью</a>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>

<?php endif; ?>
