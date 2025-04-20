import { modal } from '../util/modal.js';
import { Validator } from '../util/Validator.js';
import { FetchService } from '../util/FetchService.js';

export function init() {
    const btnModal = document.querySelector('.btnAdd');
    const modalUpdate = document.getElementById('modalUpdate');
    const span = document.getElementsByClassName("close")[0];
    const formUpdateUser = document.getElementById('updateUser');
    const submit = document.getElementById('submit');

    const validator = new Validator(formUpdateUser);

    submit.addEventListener('click', async (evt) => {
        evt.preventDefault();
        const isValid = validator.validate();

        if (isValid) {
            const formData = new FormData(formUpdateUser);
            // Send data to server
            const data = Object.fromEntries(formData.entries());

            try {
                const response = await FetchService.post('/user/update/' + data.id, data);
                if (response.success) {
                    alert('Utilisateur  ' + response.user.username + ' mis à jour avec succès.');
                    location.reload();
                } else {
                    alert('Utilisateur  ' + response.user.username + ' erreur.');
                    location.reload();
                }
            } catch (err) {
                console.error(err);
            }
        } else {
            alert('Veuillez remplir tous les champs correctement.');
        }
    })

    modal(btnModal, modalUpdate, span);

}
