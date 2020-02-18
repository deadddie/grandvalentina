<?php

use LapkinLab\Content\Events;

require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
$APPLICATION->SetPageProperty('title', 'Мероприятия');
$APPLICATION->SetTitle('Мероприятия');
?>

    <h1 class="page-title"><?= $APPLICATION->GetTitle() ?></h1>

<?= Events::getList('card') ?>

<?php require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php'); ?>
