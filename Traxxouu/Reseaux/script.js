document.addEventListener('DOMContentLoaded', function () {
    // Activer WOW.js pour les animations
    new WOW().init();

    // Smooth scrolling pour les liens de navigation
    document.querySelectorAll('a.nav-link').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });
});
