<?php

use LapkinLab\Content\Entertainment;

require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
$APPLICATION->SetPageProperty('title', 'Развлечения');
$APPLICATION->SetTitle('Развлечения');
?>

    <h1 class="page-title"><?= $APPLICATION->GetTitle() ?></h1>

<?= Entertainment::getList('card') ?>

<?php require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php'); ?>
