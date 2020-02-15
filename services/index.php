<?php

use LapkinLab\Content\Services;

require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
$APPLICATION->SetPageProperty('title', 'Услуги');
$APPLICATION->SetTitle('Услуги');
?>

    <h1 class="page-title"><?= $APPLICATION->GetTitle() ?></h1>

<?= Services::getList('card') ?>

<?php require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php'); ?>
