<?php

use LapkinLab\Content\Rooms;

require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
$APPLICATION->SetPageProperty('title', 'Номера');
$APPLICATION->SetTitle('Номера');
?>

<h1 class="page-title"><?= $APPLICATION->GetTitle() ?></h1>

<?= Rooms::getList('card') ?>

<?php require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php'); ?>
