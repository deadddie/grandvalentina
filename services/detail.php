<?php

use LapkinLab\Content\Services;

require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
?>

<?= Services::getDetail($_REQUEST['ELEMENT_CODE']) ?>

<?php require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php'); ?>
