<?php

use LapkinLab\Content\Rooms;

require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
?>

<?= Rooms::getDetail($_REQUEST['ELEMENT_CODE']) ?>

<?php require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php'); ?>
