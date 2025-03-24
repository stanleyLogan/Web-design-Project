document.addEventListener("DOMContentLoaded", function() {
    const menuToggle = document.getElementById("menu-toggle");
    const menuToggle2 = document.getElementById("menu-toggle2");
    const navLinks = document.getElementById("nav-links");
    const navlinks2 = document.getElementById('nav-links2');
    

    menuToggle.addEventListener("click", function() {
        navLinks.classList.toggle("hide");
    });

    menuToggle2.addEventListener("click", function() {
        navlinks2.classList.toggle("hide");
    });

});

