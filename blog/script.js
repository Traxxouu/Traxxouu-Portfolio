// ...existing code...

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

    // Fixer la barre de navigation pour qu'elle reste visible
    window.addEventListener('scroll', function () {
        if (window.scrollY > 0) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });

    // Ajout d'une animation 3D interactive avec VanillaTilt.js
    const cards = document.querySelectorAll('.card');
    VanillaTilt.init(cards, {
        max: 25,
        speed: 400,
        glare: true,
        'max-glare': 0.5,
    });

    // Ajout d'une réaction de flou sur l'image de présentation
    const imageEtudiant = document.querySelector('.image-etudiant img');
    imageEtudiant.addEventListener('mouseenter', () => {
        imageEtudiant.style.filter = 'blur(3px)';
    });
    imageEtudiant.addEventListener('mouseleave', () => {
        imageEtudiant.style.filter = 'none';
    });

    // Animation sur les boutons de contact pour attirer l'attention
    const buttons = document.querySelectorAll('.button');
    buttons.forEach(button => {
        button.addEventListener('mouseenter', () => {
            button.style.transform = 'scale(1.1)';
            button.style.boxShadow = '0 0 20px rgba(255, 255, 255, 0.6)';
        });
        button.addEventListener('mouseleave', () => {
            button.style.transform = 'scale(1)';
            button.style.boxShadow = 'none';
        });
    });

    // Ajout d'une animation de particules de fond pour donner un effet plus immersif
    const canvas = document.createElement('canvas');
    document.body.appendChild(canvas);
    canvas.id = 'background-canvas';
    const ctx = canvas.getContext('2d');
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;

    let particlesArray;
    const numberOfParticles = 100;

    class Particle {
        constructor(x, y, directionX, directionY, size, color) {
            this.x = x;
            this.y = y;
            this.directionX = directionX;
            this.directionY = directionY;
            this.size = size;
            this.color = color;
        }
        draw() {
            ctx.beginPath();
            ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2, false);
            ctx.fillStyle = this.color;
            ctx.fill();
        }
        update() {
            if (this.x + this.size > canvas.width || this.x - this.size < 0) {
                this.directionX = -this.directionX;
            }
            if (this.y + this.size > canvas.height || this.y - this.size < 0) {
                this.directionY = -this.directionY;
            }
            this.x += this.directionX;
            this.y += this.directionY;
            this.draw();
        }
    }

    function init() {
        particlesArray = [];
        for (let i = 0; i < numberOfParticles; i++) {
            let size = Math.random() * 5 + 1;
            let x = Math.random() * (window.innerWidth - size * 2);
            let y = Math.random() * (window.innerHeight - size * 2);
            let directionX = (Math.random() * 0.4) - 0.2;
            let directionY = (Math.random() * 0.4) - 0.2;
            let color = '#ffffff';
            particlesArray.push(new Particle(x, y, directionX, directionY, size, color));
        }
    }

    function animate() {
        requestAnimationFrame(animate);
        ctx.clearRect(0, 0, window.innerWidth, window.innerHeight);
        for (let i = 0; i < particlesArray.length; i++) {
            particlesArray[i].update();
        }
    }

    window.addEventListener('resize', function () {
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
        init();
    });

    init();
    animate();

    // Ajouter un effet de typing sur l'introduction
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

    // Interaction avec la souris pour animer les sections
    document.addEventListener('mousemove', function (e) {
        const mouseX = e.clientX;
        const mouseY = e.clientY;
        sections.forEach(section => {
            const rect = section.getBoundingClientRect();
            const dx = mouseX - (rect.left + rect.width / 2);
            const dy = mouseY - (rect.top + rect.height / 2);
            const distance = Math.sqrt(dx * dx + dy * dy);
            const maxDistance = Math.max(window.innerWidth, window.innerHeight) / 2;
            const scale = Math.max(1 - distance / maxDistance, 0.85);
            section.style.transform = `scale(${scale})`;
        });
    });

    // Ajouter un effet de suivi de la souris sur les images de réseau
    const socialIcons = document.querySelectorAll('.reseau img');
    socialIcons.forEach(icon => {
        icon.addEventListener('mousemove', (e) => {
            const rect = icon.getBoundingClientRect();
            const offsetX = (e.clientX - rect.left) / rect.width - 0.5;
            const offsetY = (e.clientY - rect.top) / rect.height - 0.5;
            icon.style.transform = `rotateX(${offsetY * 10}deg) rotateY(${offsetX * 10}deg)`;
        });
        icon.addEventListener('mouseleave', () => {
            icon.style.transform = 'rotateX(0deg) rotateY(0deg)';
        });
    });
});

// ...existing code...

document.addEventListener('DOMContentLoaded', function() {
    const likeButtons = document.querySelectorAll('.like-btn');
    likeButtons.forEach(button => {
        button.addEventListener('click', function() {
            const blogId = this.getAttribute('data-id');
            fetch(`like_blog.php?id=${blogId}`, {
                method: 'POST'
            }).then(response => response.json())
              .then(data => {
                  if (data.success) {
                      alert('Blog liked!');
                  } else {
                      alert('Error liking blog.');
                  }
              });
        });
    });

    const coverImageInput = document.querySelector('input[name="cover_image"]');
    if (coverImageInput) {
        coverImageInput.addEventListener('change', function() {
            const file = this.files[0];
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.createElement('img');
                preview.src = e.target.result;
                document.body.appendChild(preview);
            };
            reader.readAsDataURL(file);
        });
    }
});

// ...existing code...
