<?php

use LapkinLab\Core;

require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
$APPLICATION->SetPageProperty('title', 'Об отеле');
$APPLICATION->SetTitle('Об отеле');

?>
<div class="page-about">
    <div class="page-about--wrapper">

        <h1 class="page-title text-center"><?= $APPLICATION->GetTitle() ?></h1>

        <div class="col-12">
            ...
        </div>

    </div>

</div>
<?php require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php'); ?>
