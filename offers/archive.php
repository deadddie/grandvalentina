<?php

use LapkinLab\Content\Offers;

require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
$APPLICATION->AddChainItem('Специальные предложения', '/offers/');
$APPLICATION->SetPageProperty('title', 'Специальные предложения (архив)');
$APPLICATION->SetTitle('Специальные предложения (архив)');
?>

    <h1 class="page-title"><?= $APPLICATION->GetTitle() ?></h1>

<?= Offers::getList('archive') ?>

<?php require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php'); ?>
