<?php

/**
 * @var array $image
 */

?>
<?php if (!empty($image)): ?>
    <img src="<?= $image['src'] ?>" alt="<?= $image['alt'] ?>" class="<?= $image['class'] ?>">
<?php endif; ?>
