import { modal } from '../util/modal.js';
export function init() {
    const btnModal = document.querySelector('.btnAdd');
    const modalAdd = document.getElementById('modalAdd');
    const span = document.getElementsByClassName("close")[0];

    modal(btnModal, modalAdd, span);
}
