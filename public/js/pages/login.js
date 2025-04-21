// public/js/pages/login.js
import { Validator } from '../util/Validator.js';
import { FetchService } from '../util/FetchService.js';
export function init() {
    console.log("login");
    const formLogin = document.getElementById('login');
    const submit = document.getElementById('submit');

    const validator = new Validator(formLogin);

    submit.addEventListener('click', async (evt) => {
        evt.preventDefault();
        const isValid = validator.validate();

        if (isValid) {
            const formData = new FormData(formLogin);
            // Send data to server
            const data = Object.fromEntries(formData.entries());

            console.log(data);

            try {
                const response = await FetchService.post('/handleLogin', data);
                if (response.success) {
                    location.href = '/';
                } else {
                    location.reload();
                }
            } catch (err) {
                console.error(err);
            }
        } else {
            alert('Veuillez remplir tous les champs correctement.');
        }
    })

}
