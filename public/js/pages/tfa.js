import { FetchService } from '../util/FetchService.js';
import { Validator } from '../util/Validator.js';
export function init() {
    const formTfa = document.getElementById('tfa');
    const submit = document.getElementById('submit');

    const validator = new Validator(formTfa);

    submit.addEventListener('click', async (evt) => {
        evt.preventDefault();
        const isValid = validator.validate();

        if (isValid) {
            const formData = new FormData(formTfa);
            // Send data to server
            const data = Object.fromEntries(formData.entries());

            console.log(data);

            try {
                const response = await FetchService.post('/handleTfa', data);
                if (response.success) {
                    location.href = '/';
                } else {
                    location.reload();
                }
            } catch (err) {
                console.error(err);
            }
        }
    })
}