<?php

use LapkinLab\Content\Blog;

require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
?>

<?= Blog::getDetail($_REQUEST['ELEMENT_CODE']) ?>

<?php require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php'); ?>
