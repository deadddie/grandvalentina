<?php

/**
 * @var object $file \CFile
 * @var string $download
 * @var string $button_name
 */

?>
<a href="/upload/<?= $file['SUBDIR'] . '/' . $file['FILE_NAME'] ?>"<?= !empty($download) ? ' download=' . $download : '' ?> class="btn btn-wide btn-gold" target="_blank">Скачать<?= !empty($button_name) ? ' ' . $button_name : '' ?></a>
