/**
 * Wrap/unwrap block.
 *
 * @type {{container: string, init(): void, title: string, content: string}}
 */
let Wrap = {

    container: '.js-wrap',
    title: '.js-wrap-title',
    content: '.js-wrap-content',

    /**
     * Init.
     */
    init() {
        let self = this;

        $(document).ready(function () {
            $(self.container + ':not(.active)').find(self.content).hide();
        });

        $(document).on('click', self.title, function (e) {
            $(this).closest(self.container).toggleClass('active');
            $(this).next(self.content).slideToggle();
        });
    }

};

export { Wrap };
