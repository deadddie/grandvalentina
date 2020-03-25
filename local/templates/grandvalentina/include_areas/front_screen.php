<?php

use Bitrix\Main\Localization\Loc;

?>
<section class="front-screen">
    <h1 class="front-screen--title"><?= SITE_CONFIG['name_short'] ?></h1>
    <div class="front-screen--delimiter delimiter"><?= renderIcon('delimiter') ?></div>
    <div class="front-screen--slogan"><?= SITE_CONFIG['slogan'] ?></div>
    <div class="front-screen--scroller mouse-scroller"><?= renderIcon('mouse') ?></div>
</section>
<div class="front-screen--booking">
    <a href="/booking/" class="btn btn-wide"><?= Loc::getMessage('Select a room') ?></a>
</div>


