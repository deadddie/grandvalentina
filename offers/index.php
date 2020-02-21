<?php

use LapkinLab\Content\Offers;

require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
$APPLICATION->SetPageProperty('title', 'Специальные предложения');
$APPLICATION->SetTitle('Специальные предложения');
?>

    <h1 class="page-title"><?= $APPLICATION->GetTitle() ?></h1>

<?= Offers::getList('card') ?>

<?php require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php'); ?>
