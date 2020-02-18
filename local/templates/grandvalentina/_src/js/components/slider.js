/**
 * Slider.
 *
 * @type {{init(): void, instance: {}}}
 */
let Slider = {

    instance: {},

    init(type) {

        require('jquery');
        require('owl.carousel');

        $(document).ready(() => {
            let slider = $('.'+ type + '-detail--images ul');
            this.instance = slider;
            if (slider.length !== 0) {
                slider.addClass('owl-carousel').owlCarousel({
                    items: 1,
                    loop: false,
                    nav: true,
                    navContainer: '.' + type + '-slider--navigation',
                    navElement: 'div',
                    dots: false,
                    //dotsContainer: '.slider--navigation',
                    //dotsEach: true,
                    autoplay: false,
                    lazyLoad: true,
                    //lazyLoadEager: 2,
                    onInitialized: (ev) => {
                        $('.' + type + '-slider--counter span.current').text(this.pad(ev.item.index + 1));
                        $('.' + type + '-slider--counter span.total').text(this.pad(ev.item.count));
                    },
                    onChanged: (ev) => {
                        $('.' + type + '-slider--counter span.current').text(this.pad(ev.item.index + 1));
                        $('.' + type + '-slider--counter span.total').text(this.pad(ev.item.count));
                    },
                }).
                    on('mouseover', function () {
                        slider.trigger('stop.owl.autoplay');
                    }).
                    on('mouseleave', function () {
                        slider.trigger('play.owl.autoplay');
                    });
            }

            $(document).on('click', '.slide-nav', function (e) {
                let slide = $(this).data('slide');
                slider.trigger('to.owl.carousel', slide - 1);
            });
        });

    },

    /**
     * Pad to 0.
     *
     * @param number
     * @returns {string}
     */
    pad(number) {
        return number.toString().padStart(2, '0');
    }

};

export { Slider };
