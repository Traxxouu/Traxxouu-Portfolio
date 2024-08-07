document.addEventListener('DOMContentLoaded', function () {
    const intro = document.getElementById('intro');
    const navbar = document.getElementById('navbar');

    window.addEventListener('scroll', function () {
        if (window.scrollY > intro.offsetHeight - navbar.offsetHeight) {
            navbar.style.display = 'block';
        } else {
            navbar.style.display = 'none';
        }
    });

    // Ajout des animations d'apparition
    const sections = document.querySelectorAll('.cv-section');
    const options = {
        threshold: 0.2,
    };
    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (!entry.isIntersecting) return;
            entry.target.classList.add('animate__fadeInUp');
            observer.unobserve(entry.target);
        });
    }, options);

    sections.forEach(section => {
        observer.observe(section);
    });
});
