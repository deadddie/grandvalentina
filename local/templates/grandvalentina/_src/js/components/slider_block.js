/**
 * Slider block.
 *
 * @type {{init(): void, instance: {}}}
 */
let SliderBlock = {

    instance: {},

    init(type) {

        require('jquery');
        require('owl.carousel');

        $(document).ready(() => {
            let slider = $('section.'+ type + '-block .' + type + '-items');
            this.instance = slider;
            if (slider.length !== 0) {
                slider.addClass('owl-carousel').owlCarousel({
                    items: 1,
                    slideBy: 1,
                    loop: false,
                    nav: true,
                    navContainer: '.' + type + '-slider--navigation',
                    navElement: 'div',
                    dots: true,
                    dotsContainer: '.' + type + '-slider--dots',
                    dotsEach: true,
                    autoplay: false,
                    lazyLoad: true,
                    responsive: {
                        0: {
                            items: 1
                        },
                        768: {
                            items: 2
                        },
                        1260: {
                            items: 3
                        }
                    }
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

};

export { SliderBlock };
