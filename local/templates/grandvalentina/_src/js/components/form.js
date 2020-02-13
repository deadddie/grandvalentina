/**
 * Form Handlers.
 *
 * @type {{clearErrors(): void, setErrors(*, *): void}}
 */
let Form = {

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
            errors[field].forEach((value) => {
                form.find('[name="'+ field +'"]').addClass('has-error').closest('.form-field').append('<div class="form-field-error">' + value + '</div>');
            });
        }
    },

    /**
     * Remove errors divs.
     */
    clearErrors() {
        $('.form-field-error, .form-error').remove();
        $('.has-error').removeClass('has-error');
    },

};

export { Form };
