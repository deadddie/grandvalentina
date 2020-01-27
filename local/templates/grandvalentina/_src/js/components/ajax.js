import { Common } from './common';

/**
 * Ajax Handlers.
 *
 * @type {{appendModal(*=, *): void, init(): void, ajaxUrl: string, clearModalsContainer(): void, clearErrors(): void, prepareAjaxOptions(): {type: string, url: string}, modalsContainer: string, setErrors(*, *): void}}
 */
let Ajax = {

    modalsContainer: '#ajax-modals-container',
    ajaxUrl: '/ajax/', // '/local/php_interface/ajax.php';

    /**
     * Init.
     */
    init() {
        // Открытие модалки
        $(document).on('click', '.js-open-modal', (e) => {
            e.preventDefault();
            let metrikaTarget = $(e.currentTarget).data('metrika-target');
            let modalId = $(e.currentTarget).data('modal');
            let options = this.prepareAjaxOptions();
            options.data = {
                action: $(e.currentTarget).data('action'),
                modalId: modalId,
            };
            let tarif = $(e.currentTarget).data('tarif');
            if (tarif !== undefined) options.data.tarif = tarif;
            let site_type = $(e.currentTarget).data('site-type');
            if (site_type !== undefined) options.data.siteType = site_type;
            $.ajax(options)
                .done((response) => {
                    if (!Common.isJsonString(response)) {
                        Ajax.appendModal(response, modalId);
                        ymReachGoal(metrikaTarget); // цель Яндекс.Метрики
                    } else {
                        console.error(response);
                    }
                })
                .fail(error => console.error(error));
        });

        // Отправка формы
        $(document).on('click', '.js-send-form', (e) => {
            e.preventDefault();
            this.clearErrors();
            let form = $($(e.currentTarget)[0].form);
            // Модалка
            let options = this.prepareAjaxOptions();
            options.data = form.serialize() + '&action=sendForm';
            $.ajax(options)
                .done((response) => {
                    let result = JSON.parse(response);
                    if (typeof result.errors === 'undefined') {

                        // Форма без ошибок
                        Ajax.clearErrors();
                        Ajax.clearModalsContainer();
                        form[0].reset();

                        // Модалка "Спасибо"
                        let options = Ajax.prepareAjaxOptions();
                        options.data = {
                            action: 'openModal',
                            modalId: 'thanks',
                        };
                        $.ajax(options)
                            .done((response) => {
                                if (!Common.isJsonString(response)) {
                                    Ajax.appendModal(response, 'thanks');
                                    ymReachGoal(form.find('.js-send-form').data('metrika-target')); // цель Яндекс.Метрики
                                } else {
                                    console.error(response);
                                }
                            })
                            .fail(error => console.error(error));

                    } else {

                        // Форма с ошибками
                        Ajax.setErrors(form, result.errors);

                    }
                })
                .fail(error => console.error(error));
        });
    },

    /**
     * Append content to modals container.
     *
     * @param content
     * @param modalId
     */
    appendModal(content, modalId) {
        $(this.modalsContainer).append(content);
        $('#' + modalId + '-modal').modal().on('hidden.bs.modal', () => {
            $('#' + modalId + '-modal').remove();
        });
    },

    /**
     * Clear modals container.
     */
    clearModalsContainer() {
        $(this.modalsContainer).empty();
        $('.modal-backdrop').remove();
    },

    /**
     * Prepare Ajax options.
     *
     * @returns {{type: string, url: string}}
     */
    prepareAjaxOptions() {
        return {
            url: this.ajaxUrl,
            type: 'post'
        };
    },

    /**
     * Set form errors.
     *
     * @param form
     * @param errors
     */
    setErrors(form, errors) {
        for (let field in errors) {
            if (field === 'sessid') {
                form.prepend('<div class="form-error">' + errors[field] + '</div>');
                continue;
            }
            errors[field].forEach(function (value) {
                form.find('[name="'+ field +'"]').closest('.form-field').prepend('<div class="form-field-error">' + value + '</div>');
            });
        }
    },

    /**
     * Remove errors divs.
     */
    clearErrors() {
        $('.form-field-error, .form-error').remove();
    }

};

export { Ajax };
