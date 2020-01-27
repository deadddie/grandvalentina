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

        // Прокрутка страницы по хешу
        $(document).on('click', 'a[href^="#top"]', (e) => {
            let id = $(e.target).attr('href');
            let $id = $(id);
            if ($id.length === 0) {
                return;
            }
            e.preventDefault();
            let pos = $id.offset().top;
            $('body, html').animate({scrollTop: pos});
        });

        // Открытие/закрытие мобильного меню
        $(document)
            .on('click', '.js-mobile-menu', () => {
                $('.mobile-menu').addClass('active');
                $('body, #top').addClass('mobile-menu-open');
            })
            .on('click', '.js-mobile-menu--close', () => {
                $('.mobile-menu').removeClass('active');
                $('body, #top').removeClass('mobile-menu-open');
            })
            .on('mouseup', (e) => {
                let div = $('.mobile-menu');
                if (!div.is(e.target) && div.has(e.target).length === 0) {
                    div.removeClass('active');
                    $('body, #top').removeClass('mobile-menu-open');
                }
            });

        // Обработчик после загрузки страницы
        $(document).ready(() => {
            //Common.setEmailMask();
            Common.setPhoneMask();
        });

        // Обработчик при прокрутке страницы
        $(document).scroll(() => {
            Common.scrollToTop();
        });

        // Обработчик после завершения ajax
        $(document).ajaxComplete(() => {
            //Common.setEmailMask();
            Common.setPhoneMask();
        });

    },

    /**
     * Scroll to top.
     */
    scrollToTop() {
        let scrollingAtTop = $(document).scrollTop();
        if (scrollingAtTop > 480 && !Common.min) {
            $('#scroll-to-top').addClass('active');
            Common.min = true;
        }
        if (scrollingAtTop <= 480 && Common.min) {
            $('#scroll-to-top').removeClass('active');
            Common.min = false;
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
    }

};

export { Common };
