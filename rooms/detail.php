<?php

use LapkinLab\{Core, Content};

require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
?>

<?= Content::getRoomDetail($_REQUEST['ELEMENT_CODE']) ?>

<?php require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php'); ?>
