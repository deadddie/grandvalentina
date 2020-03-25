<?php

/**
 * @var array $languages
 */

use Bitrix\Main\Localization\Loc;

$languages = [
    'ru' => [
        'name' => Loc::getMessage('Russian'),
        'active' => LANGUAGE_ID === 'ru',
    ],
    'en' => [
        'name' => 'English',
        'active' => LANGUAGE_ID === 'en',
    ],
];

?>
<ul class="languages-list">
    <?php foreach ($languages as $l => $language): ?>
        <li class="languages-item languages-item-<?= $l ?><?= $language['active'] ? ' active' : '' ?> js-language" data-lang="<?= $l ?>">
            <?= $language['name'] ?>
        </li>
    <?php endforeach; ?>
</ul>
