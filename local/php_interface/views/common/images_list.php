<?php

/**
 * @var array $images
 * @var string $class
 */

?>
<?php if (!empty($images)): ?>
    <ul class="<?= $class ?>">
        <?php foreach ($images as $image): ?>
            <li><img src="<?= $image['src'] ?>" alt="<?= $image['alt'] ?>"></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
