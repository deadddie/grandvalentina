/**
 * Common scripts.
 *
 * @type {{appendModal(*=, *): void, setPhoneMask(): void, init(): void, min: boolean, ajaxUrl: string, scrollToTop(): void, clearModalsContainer(): void, setEmailMask(): void, isJsonString(*=): boolean, prepareAjaxOptions(): {type: string, url: string}, modalsContainer: string}}
 */
let Common = {

    min: false,

    /**
     * Init.
     */
    init() {
        let self = this;

        // Прокрутка страницы по хешу
        $(document)
            .on('click', 'a[href^="#top"]', (e) => {
                let id = $(e.target).attr('href');
                let $id = $(id);
                if ($id.length === 0) {
                    return;
                }
                e.preventDefault();
                let pos = $id.offset().top;
                $('body, html').animate({scrollTop: pos});
            })

            // Открытие/закрытие мобильного меню
            .on('click', '.js-mobile-menu', () => {
                $('.mobile-menu, .header--close-menu').addClass('active');
                $('body, #top').addClass('mobile-menu-open');
            })
            .on('click', '.js-mobile-menu--close', () => {
                $('.mobile-menu, .header--close-menu').removeClass('active');
                $('body, #top').removeClass('mobile-menu-open');
                $('.languages-switcher').removeClass('active');
            })
            .on('mouseup', (e) => {
                let div = $('.mobile-menu');
                if (!div.is(e.target) && div.has(e.target).length === 0) {
                    $(div + ', .header--close-menu').removeClass('active');
                    $('body, #top').removeClass('mobile-menu-open');
                }
            })

            // Открытие/закрытие плавающего меню
            .on('click', '.js-float-menu', () => {
                $('.header--menu').toggleClass('active');
            })

            // Показ переключателя языков
            .on('click', '.js-languages-switch', function () {
                $(this).next('.languages-switcher').toggleClass('active');
            })

            // Обработчик после загрузки страницы
            .ready(() => {
                //self.setEmailMask();
                self.setPhoneMask();
                self.cookieApply();
            })

            // Обработчик при прокрутке страницы
            .scroll(() => {
                self.scrollToTop();
            })

            // Обработчик после завершения ajax
            .ajaxComplete(() => {
                //self.setEmailMask();
                self.setPhoneMask();
            });

    },

    /**
     * Scroll to top.
     */
    scrollToTop() {
        let self = this;
        let scrollingAtTop = $(document).scrollTop();
        let header = $('.header');
        let scrollToTop = $('#scroll-to-top');
        if (scrollingAtTop > 0 && !self.min) {
            self.min = true;
            header.addClass('fixed');
        }
        if (scrollingAtTop === 0) {
            self.min = false;
            header.removeClass('fixed');
        }
        if (scrollingAtTop > 480) {
            scrollToTop.addClass('active');
        }
        if (scrollingAtTop <= 480) {
            scrollToTop.removeClass('active');
        }
    },

    /**
     * @return {boolean}
     */
    isJsonString(str) {
        try {
            JSON.parse(str);
        } catch (e) {
            return false;
        }
        return true;
    },

    /**
     * Set phone mask.
     */
    setPhoneMask() {
        require('inputmask/dist/jquery.inputmask.bundle');
        $('input[name="PHONE"], input[name="phone"]').inputmask({
            mask: '+7(999)999-9999',
            placeholder: '_',
        });
    },

    /**
     * Set email mask.
     */
    setEmailMask() {
        require('inputmask/dist/jquery.inputmask.bundle');
        new Inputmask('email').mask($('input[name="email"]'));
    },

    /**
     * Use of cookies.
     */
    cookieApply() {
        require('jquery.cookie');
        const COOKIE_APPLY = 'GHV_COOKIE_APPLY';
        const cookie_div = $('.cookie-apply');
        if ($.cookie(COOKIE_APPLY) === undefined || $.cookie(COOKIE_APPLY) === false) {
            cookie_div.addClass('active');
        }
        $(document).on('click', '.cookie-apply--close, .cookie-apply--apply', function () {
            cookie_div.removeClass('active');
            $.cookie(COOKIE_APPLY, true, {expires: 30, path: '/'});
        })
    }

};

export { Common };
