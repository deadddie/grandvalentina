<?php

/**
 * @var $menu
 */

global $APPLICATION;
$curDir = $APPLICATION->GetCurDir();
$curDirArray = array_filter(explode('/', $curDir));

?>
<nav class="menu-top">
    <ul>

    <?php foreach ($menu['menu'] as $item): ?>
        <?php
        $name = $item[0];
        $link = '/' . $item[1];
        $link_trimmed = trim($link, '/');
        $class = $item[2]['EXT_CLASS'];
        $is_active = in_array($link_trimmed, $curDirArray, true) || ($curDir === $link);
        ?>
        <li class="<?= $is_active ? 'active' : '' ?>">
            <a href="<?= $link ?>" class="<?= $is_active ? 'active' : '' ?> <?= $class ?>"><?= $name ?></a>

            <?php if (array_key_exists($link_trimmed, $menu)): ?>
                <ul>

                <?php foreach ($menu[$link_trimmed] as $sub_item): ?>
                    <?php
                    $name = $sub_item[0];
                    $link = $sub_item[1];
                    $class = $sub_item[2]['EXT_CLASS'];
                    $is_active = ($curDir === $link);
                    ?>
                    <li class="<?= $is_active ? 'active' : '' ?>">
                        <a href="<?= $link ?>" class="<?= $is_active ? ' active' : '' ?> <?= $class ?>"><?= $name ?></a>
                    </li>
                <?php endforeach; ?>

                </ul>
            <?php endif; ?>

        </li>
    <?php endforeach; ?>

    </ul>
</nav>
