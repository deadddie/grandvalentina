<?php

/**
 * @var array $socials
 * @var $simple
 */

use LapkinLab\Core;

$simple = $simple ? '-simple' : '';
?>
<?php foreach ($socials as $social): ?>
    <a href="<?= $social ?>" rel="nofollow" target="_blank"><?= renderIcon(Core::parseSocial($social) . $simple) ?></a>
<?php endforeach; ?>
