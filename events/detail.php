<?php

use LapkinLab\Content\Events;

require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
?>

<?= Events::getDetail($_REQUEST['ELEMENT_CODE']) ?>

<?php require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php'); ?>
