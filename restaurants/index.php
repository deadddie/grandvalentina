<?php

use LapkinLab\Content\Restaurants;

require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
$APPLICATION->SetPageProperty('title', 'Рестораны');
$APPLICATION->SetTitle('Рестораны');
?>

    <h1 class="page-title"><?= $APPLICATION->GetTitle() ?></h1>

<?= Restaurants::getList('card') ?>

<?php require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php'); ?>
