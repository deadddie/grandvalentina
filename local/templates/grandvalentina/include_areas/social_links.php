<?php

/**
 * @var array $socials
 */

use LapkinLab\Core;

?>
<?php foreach ($socials as $social): ?>
    <a href="<?= $social ?>" rel="nofollow" target="_blank"><?= Core::renderIcon(Core::parseSocial($social)) ?></a>
<?php endforeach; ?>
