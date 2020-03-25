<?php

/**
 * @var object $file \CFile
 * @var string $download
 * @var string $button_name
 */

use Bitrix\Main\Localization\Loc;

?>
<a href="/upload/<?= $file['SUBDIR'] . '/' . $file['FILE_NAME'] ?>"<?= !empty($download) ? ' download=' . $download : '' ?> class="btn btn-gold" target="_blank"><?= Loc::getMessage('Download') ?><?= !empty($button_name) ? ' ' . $button_name : '' ?></a>
