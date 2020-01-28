<?php

use Bitrix\Main\Localization\Loc;
use LapkinLab\Core;


if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

Loc::loadLanguageFile(__FILE__);

?>
        </main><!--/main-->

        <!--footer-->
        <footer id="footer" class="footer">

            <div class="container">
                <div class="row">
                    <div class="footer--wrapper col-12">

                        <div class="footer--logo">
                            <div class="logo-vertical">
                                <?= Core::renderIcon('logo') ?>
                                <span><?= SITE_CONFIG['name_short'] ?></span>
                            </div>
                        </div>

                        <div class="footer--rooms">
                            <div class="footer--rooms--title">Номера</div>
                            <div class="footer--rooms--items"></div>
                        </div>

                        <div class="footer--menu">
                            <div class="footer--menu--title">Меню</div>
                            <div class="footer--menu--items"></div>
                        </div>

                        <div class="footer--contacts">
                            <?php if (!empty(SITE_CONFIG['phone'])): ?>
                                <div class="footer--contacts-phone">
                                    <?= Core::parsePhone(SITE_CONFIG['phone'], 'link') ?>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty(SITE_CONFIG['email'])): ?>
                                <div class="footer--contacts-email">
                                    <?= Core::renderEmail(SITE_CONFIG['email']) ?>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty(SITE_CONFIG['address'])): ?>
                                <div class="footer--contacts-address"><?= SITE_CONFIG['address'] ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="footer--socials">
                            <?php $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . '/include_areas/social_links.php', array('socials' => SITE_CONFIG['socials'])) ?>
                        </div>

                        <div class="footer--copyrights">
                            &copy; <?= Core::autoCopyright(2019) ?> Официальный сайт <?= SITE_CONFIG['name_short'] ?>
                        </div>

                    </div>
                </div>
            </div>

        </footer><!--/footer-->

        <!--scroll to top-->
        <div class="hidden-xs" id="scroll-to-top"><a href="#top" title="наверх" rel="nofollow">↑</a></div>

    </div><!--/#top-->

    <!--modals container-->
    <div id="ajax-modals-container"></div>

    <?php $APPLICATION->IncludeFile('/include/seo.php') ?>

</body>
</html>
