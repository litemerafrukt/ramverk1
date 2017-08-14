// import {sayHello} from "./helloworld"

(() => {
    const hamburgerMenuOpen = document.getElementById("hamburger-menu-open");
    const hamburgerMenuClose = document.getElementById("hamburger-menu-close");
    const hamburgerMenu = document.getElementById("hamburger-menu");

    const hamburgerMenuToggler = () => {
        hamburgerMenu.classList.toggle("fade-in");
    };

    hamburgerMenuOpen.addEventListener("click", hamburgerMenuToggler);
    hamburgerMenuClose.addEventListener("click", hamburgerMenuToggler);

})();
