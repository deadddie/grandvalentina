<?php

use Bitrix\Main\Localization\Loc;

?>
<!--noindex-->
<div class="cookie-apply">
    <h2 class="cookie-apply--title">Cookie</h2>
    <div class="cookie-apply--content">
        <p><?= Loc::getMessage("Cookie") ?></p>
        <button type="button" class="btn btn-sm cookie-apply--apply">Хорошо</button>
    </div>
    <div class="cookie-apply--close"><?= renderIcon('cross') ?></div>
</div>
<!--/noindex-->
