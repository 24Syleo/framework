import { FetchService } from '../util/FetchService.js';
import { Validator } from '../util/Validator.js';
export function init() {
    const formTfa = document.getElementById('tfa');
    const submit = document.getElementById('submit');
    const btn = document.getElementById('text_code');
    const text = document.getElementById('text-to-copy');
    const labelView = document.getElementById('labelViewSecret');
    const checked = document.getElementById('viewSecret');

    labelView.addEventListener('click', () => {
        if (checked.checked) {
            text.setAttribute('type', 'password')
            checked.setAttribute('checked', '');
        } else {
            text.setAttribute('type', 'text')
            checked.removeAttribute('checked');
        }
    })

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

    btn.addEventListener('click', () => {
        navigator.clipboard.writeText(text.value).then(() => {
            alert("Secret copié dans le presse papier!")
        }).catch((err) => {
            alert("Erreur de copie : " + err);
        })
    })
}