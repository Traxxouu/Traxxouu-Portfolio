document.addEventListener('DOMContentLoaded', function () {
    // Assurez-vous que la barre de navigation reste toujours visible
    const navbar = document.getElementById('navbar');
    navbar.style.display = 'block';

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

    // Effet de survol sur les cartes avec VanillaTilt.js
    const cards = document.querySelectorAll('.card');
    VanillaTilt.init(cards, {
        max: 15,
        speed: 400,
        glare: true,
        "max-glare": 0.2,
    });

    // Effet de typing sur l'introduction
    const introText = document.querySelector('#intro p');
    const introContent = introText.textContent;
    introText.textContent = '';
    let index = 0;

    function typeEffect() {
        if (index < introContent.length) {
            introText.textContent += introContent.charAt(index);
            index++;
            setTimeout(typeEffect, 50);
        }
    }
    typeEffect();
});
