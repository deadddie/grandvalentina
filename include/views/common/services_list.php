<?php

/**
 * @var $services
 */

?>
<ul>
    <?php while ($service = $services->GetNextElement()): ?>
        <?php $arFields = $service->GetFields(); ?>
        <li data-id="<?= $arFields['ID'] ?>"><?= $arFields['NAME'] ?></li>
    <?php endwhile; ?>
</ul>
