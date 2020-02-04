<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>

<?php if (!empty($arResult)): ?>

<div class="menu-top">
    <ul>
    <?php
    $previousLevel = 0;
    foreach($arResult as $arItem):
    ?>
        <?php if ($previousLevel && $arItem['DEPTH_LEVEL'] < $previousLevel): ?>
            <?= str_repeat('</ul></li>', ($previousLevel - $arItem['DEPTH_LEVEL'])) ?>
        <?php endif?>

        <?php if ($arItem['IS_PARENT']): ?>
            <li<?php if($arItem['CHILD_SELECTED'] !== true): ?> class="<?= $arItem['SELECTED'] ? 'active' : '' ?>"<?php endif?>>
                <a href="<?= $arItem['LINK'] ?>" class="<?= $arItem['SELECTED'] ? 'active' : '' ?>"><?= $arItem['TEXT'] ?></a>
                <ul>

        <?php else: ?>

            <?php if ($arItem['PERMISSION'] > 'D'): ?>
                <li class="<?= $arItem['SELECTED'] ? 'active' : '' ?>">
                    <a href="<?= $arItem['LINK'] ?>" class="<?= $arItem['SELECTED'] ? 'active' : '' ?>"><?= $arItem['TEXT'] ?></a>
                </li>
            <?php endif ?>

        <?php endif ?>

        <?php $previousLevel = $arItem['DEPTH_LEVEL']; ?>

    <?php endforeach ?>

    <?php if ($previousLevel > 1): //close last item tags ?>
        <?= str_repeat('</ul></li>', ($previousLevel-1) ) ?>
    <?php endif ?>

    </ul>
</div>
<?php endif ?>
