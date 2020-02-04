import { Common } from './common';
import { Form } from './form';

/**
 * Modal Ajax Handlers.
 *
 * @type {{appendModal(*=, *): void, init(): void, ajaxUrl: string, clearModalsContainer(): void, prepareAjaxOptions(): {type: string, url: string}, modalsContainer: string}}
 */
let Modals = {

    modalsContainer: '#ajax-modals-container',
    ajaxUrl: '/ajax/', // '/local/php_interface/ajax.php';

    /**
     * Init.
     */
    init() {
        let self = this;

        // Открытие модалки
        $(document).on('click', '.js-open-modal', (e) => {
            e.preventDefault();
            //let metrikaTarget = $(e.currentTarget).data('metrika-target');
            let modalId = $(e.currentTarget).data('modal');
            let options = self.prepareAjaxOptions();
            options.data = {
                action: $(e.currentTarget).data('action'),
                modalId: modalId,
            };
            $.ajax(options)
                .done((response) => {
                    if (!Common.isJsonString(response)) {
                        self.appendModal(response, modalId);
                        //ymReachGoal(metrikaTarget); // цель Яндекс.Метрики
                    } else {
                        console.error(response);
                    }
                })
                .fail(error => console.error(error));
        });

        // Отправка формы
        $(document).on('click', '.js-send-form', (e) => {
            e.preventDefault();
            Form.clearErrors();
            let form = $($(e.currentTarget)[0].form);
            // Модалка
            let options = this.prepareAjaxOptions();
            options.data = form.serialize() + '&action=sendForm';
            $.ajax(options)
                .done((response) => {
                    let result = JSON.parse(response);
                    if (typeof result.errors === 'undefined') {

                        // Форма без ошибок
                        Form.clearErrors();
                        self.clearModalsContainer();
                        form[0].reset();

                        // Модалка "Спасибо"
                        let options = self.prepareAjaxOptions();
                        options.data = {
                            action: 'openModal',
                            modalId: 'thanks',
                        };
                        $.ajax(options)
                            .done((response) => {
                                if (!Common.isJsonString(response)) {
                                    self.appendModal(response, 'thanks');
                                    //ymReachGoal(form.find('.js-send-form').data('metrika-target')); // цель Яндекс.Метрики
                                } else {
                                    console.error(response);
                                }
                            })
                            .fail(error => console.error(error));

                    } else {

                        // Форма с ошибками
                        Form.setErrors(form, result.errors);

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

};

export { Modals };
