<?php

use LapkinLab\Content\Blog;

require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
$APPLICATION->SetPageProperty('title', 'Блог');
$APPLICATION->SetTitle('Блог');
?>

    <h1 class="page-title"><?= $APPLICATION->GetTitle() ?></h1>

<?= Blog::getList('card') ?>

<?php require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php'); ?>
