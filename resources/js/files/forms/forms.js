export function formFieldsInit(options = {viewPass: false}) {
    const formFields = document.querySelectorAll('input[placeholder],textarea[placeholder]');
    if (formFields.length) {
        formFields.forEach(formField => {
            if (!formField.hasAttribute('data-placeholder-nohide')) {
                formField.dataset.placeholder = formField.placeholder;
            }
        });
    }
    document.body.addEventListener("focusin", function (e) {
        const targetElement = e.target;
        if ((targetElement.tagName === 'INPUT' || targetElement.tagName === 'TEXTAREA')) {
            if (targetElement.dataset.placeholder) {
                targetElement.placeholder = '';
            }
            if (!targetElement.hasAttribute('data-no-focus-classes')) {
                targetElement.classList.add('_form-focus');
                targetElement.parentElement.classList.add('_form-focus');
            }
        }
    });
    document.body.addEventListener("focusout", function (e) {
        const targetElement = e.target;
        if ((targetElement.tagName === 'INPUT' || targetElement.tagName === 'TEXTAREA')) {
            if (targetElement.dataset.placeholder) {
                targetElement.placeholder = targetElement.dataset.placeholder;
            }
            if (!targetElement.hasAttribute('data-no-focus-classes')) {
                targetElement.classList.remove('_form-focus');
                targetElement.parentElement.classList.remove('_form-focus');
            }
        }
    });
}


