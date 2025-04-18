document.addEventListener("DOMContentLoaded", () => {
    const page = document.body.dataset.page;

    if (page) {
        const scriptUrl = `${window.location.origin}/js/pages/${page}.js`;
        import(scriptUrl)
            .then(module => module.init())
            .catch(err => console.warn(`Pas de script spécifique pour la page "${page}"`));
    }
});
