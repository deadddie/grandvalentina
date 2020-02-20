<?php

use LapkinLab\Content\Restaurants;

require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
?>

<?= Restaurants::getDetail($_REQUEST['ELEMENT_CODE']) ?>

<?php require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php'); ?>
