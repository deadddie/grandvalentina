<?php

/**
 * @var array $languages
 */

$languages = [
    'ru' => [
        'name' => 'Русский',
        'active' => true,
    ],
    'en' => [
        'name' => 'English',
        'active' => false,
    ],
];

?>
<div class="languages-switcher">
    <ul class="languages-list">
        <?php foreach ($languages as $l => $language): ?>
            <li class="languages-item languages-item-<?= $l ?><?= $language['active'] ? ' active' : '' ?> js-languages-set" data-lang="<?= $l ?>"><?= $language['name'] ?></li>
        <?php endforeach; ?>
    </ul>
</div>
