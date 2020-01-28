<?php

use LapkinLab\Core;

?><section class="front-screen">
    <h1 class="front-screen--title"><?= SITE_CONFIG['name_short'] ?></h1>
    <div class="front-screen--delimiter delimiter"><?= Core::renderIcon('delimiter') ?></div>
    <div class="front-screen--slogan"><?= SITE_CONFIG['slogan'] ?></div>
    <div class="front-screen--scroller mouse-scroller"><?= Core::renderIcon('mouse') ?></div>
</section>


