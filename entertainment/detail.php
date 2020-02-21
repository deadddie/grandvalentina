<?php

use LapkinLab\Content\Entertainment;

require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
?>

<?= Entertainment::getDetail($_REQUEST['ELEMENT_CODE']) ?>

<?php require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php'); ?>
