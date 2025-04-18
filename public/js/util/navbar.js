const btnMenu = document.getElementById('btnMenu');
const menu = document.getElementById('menu');
const path = location.pathname;
const links = document.querySelectorAll(".link");
btnMenu.addEventListener('click', () => {
    menu.classList.toggle('open');
});


links.forEach((link) => {
    link.classList.remove("active");
    if (path === link.pathname) {
        link.classList.add("active");
    }
})