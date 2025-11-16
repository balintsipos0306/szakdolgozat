document.addEventListener("DOMContentLoaded", function() {
    const hamburger = document.querySelector(".hamburger");
    const navMenu = document.getElementById("menu");

    if (hamburger && navMenu) {
        hamburger.addEventListener("click", mobileMenu);
        const navLink = document.querySelectorAll(".nav-link");
        navLink.forEach(n => n.addEventListener("click", closeMenu));
    }

    function mobileMenu() {
        hamburger.classList.toggle("active");
        navMenu.classList.toggle("active");
    }
    
    function closeMenu() {
        hamburger.classList.remove("active");
        navMenu.classList.remove("active");
    }
});

