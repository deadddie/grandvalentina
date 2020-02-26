<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("404 Not Found");
?>

<div class="error-404">
    <div class="container">
        <div class="row">
            <div class="error-404--wrapper col-12">
                <h1>404</h1>
                <p><em>Этой страницы<br> не существует</em></p>
                <p>
                    <a href="/" class="btn btn-white">Вернуться на главную</a>
                </p>
            </div>
        </div>
    </div>
</div>


<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
