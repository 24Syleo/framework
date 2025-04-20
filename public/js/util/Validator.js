import { rules } from './Rules.js';

export class Validator {
    constructor(formElement) {
        this.form = formElement;
        this.fields = [...this.form.querySelectorAll('[name]')];
        this.rules = rules;
    }

    validate() {
        let isValid = true;

        this.fields.forEach(field => {
            const name = field.name;
            const value = field.value.trim();
            const rule = this.rules[name];
            const responseSpan = field.nextElementSibling;

            if (!rule) return;

            const result = rule.test(value);
            responseSpan.textContent = result ? rule.success : rule.error;
            responseSpan.className = "response " + (result ? "text-success" : "text-error");

            if (!result) isValid = false;
        });

        return isValid;
    }
}
