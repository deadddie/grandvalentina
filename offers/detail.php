<?php

use LapkinLab\Content\Offers;

require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
?>

<?= Offers::getDetail($_REQUEST['ELEMENT_CODE']) ?>

<?php require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php'); ?>
