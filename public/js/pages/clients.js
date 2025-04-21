import { modal } from '../util/modal.js';
import { Validator } from '../util/Validator.js';
import { FetchService } from '../util/FetchService.js';
export function init() {
    const btnModal = document.querySelector('.btnAdd');
    const modalAdd = document.getElementById('modalAdd');
    const span = document.getElementsByClassName("close")[0];
    const formUser = document.getElementById('addClient');
    const submit = document.getElementById('submit');

    const validator = new Validator(formUser);

    submit.addEventListener('click', async (evt) => {
        evt.preventDefault();

        const isValid = validator.validate();

        if (isValid) {
            const formData = new FormData(formUser);
            // Send data to server
            const data = Object.fromEntries(formData.entries());

            try {
                const response = await FetchService.post('/client/add', data);
                if (response.success) {
                    // alert('Utilisateur  ' + response.user.username + ' ajouté avec succès.');
                    location.reload();
                } else {
                    // alert('Utilisateur  ' + response.user.username + ' erreur.');
                    location.reload();
                }
            } catch (err) {
                console.error(err);
            }
        } else {
            alert('Veuillez remplir tous les champs correctement.');
        }

    });


    modal(btnModal, modalAdd, span);
}
