document.addEventListener('DOMContentLoaded', () => {
    // Smooth Scroll for Navigation Links
    const navLinks = document.querySelectorAll('nav a');
    navLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            const targetId = link.getAttribute('href').substring(1);
            document.getElementById(targetId).scrollIntoView({ behavior: 'smooth' });
        });
    });

    // Toggle Mobile Menu
    const menuIcon = document.getElementById('menu-icon');
    const navbar = document.querySelector('.navbar');
    menuIcon.addEventListener('click', () => {
        navbar.classList.toggle('active');
    });

    // Dark Mode Toggle
    const darkModeIcon = document.getElementById('darkMode-icon');
    darkModeIcon.addEventListener('click', () => {
        document.body.classList.toggle('dark-mode');
        darkModeIcon.classList.toggle('fa-moon');
        darkModeIcon.classList.toggle('fa-sun');
    });

    // Form Submission for Contact Section
    const contactForm = document.getElementById('contact-form');
    contactForm.addEventListener('submit', function(event) {
        event.preventDefault();

        fetch('send_email.php', {
            method: 'POST',
            body: new FormData(contactForm)
        })
        .then(response => response.text())
        .then(data => {
            alert(data);
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to send message. Please try again later.');
        });
    });
});
