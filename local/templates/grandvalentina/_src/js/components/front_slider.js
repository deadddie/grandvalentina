/**
 * Front Slider.
 *
 * @type {{init(): void, instance: {}}}
 */
let FrontSlider = {

    instance: {},

    init() {

        require('jquery');
        require('owl.carousel');

        $(document).ready(() => {
            let owlFrontSlider = $('.slider--slides');
            this.instance = owlFrontSlider;
            if (owlFrontSlider.length !== 0) {
                owlFrontSlider.addClass('owl-carousel').owlCarousel({
                    items: 1,
                    loop: true,
                    nav: false,
                    //navContainer: '.slider--navigation',
                    //navElement: 'div',
                    dots: true,
                    dotsContainer: '.slider--navigation',
                    dotsEach: true,
                    autoplay: true,
                    lazyLoad: true,
                    //lazyLoadEager: 2,
                }).
                    on('mouseover', function () {
                        owlFrontSlider.trigger('stop.owl.autoplay');
                    }).
                    on('mouseleave', function () {
                        owlFrontSlider.trigger('play.owl.autoplay');
                    })
                    .on('change.owl.carousel', function (e) {
                    $('.slider-image').attr('style', 'background-image: url(' + $('.slide-'+ e.relatedTarget._current + ' > .slide-image').first().data('img') + ')');
                });
            }

            $(document).on('click', '.slide-nav', function (e) {
                let slide = $(this).data('slide');
                owlFrontSlider.trigger('to.owl.carousel', slide - 1);
            });
        });

    }

};

export { FrontSlider };
