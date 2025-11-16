window.addEventListener("load", () => {
    const loader = document.querySelector(".loader");

    loader.classList.add("loader-hidden");

    loader.addEventListener("transitioned", () => {
        document.body.removeChild("loader");
    })
});

document.addEventListener("scroll", function() {

    const logo = document.getElementById("logo");
    const header = document.getElementById("myheader");
    const nav = document.getElementById("navv");
    const links = document.querySelectorAll(".nav-link");

    if (window.innerWidth <= 768) return null
    if(window.scrollY > 10){
        logo.classList.add("scrolled")
        header.classList.add("scrolled")
        nav.style.justifyContent = "right";
        for (var i = 0; i < links.length; i++) {
            links[i].style.color = "white";
            links[i].style.fontSize = "medium";
            links[i].classList.add("white");
        }
    }
    else{
        logo.classList.remove("scrolled")
        header.classList.remove("scrolled")
        nav.style.justifyContent = "center";
        for (var i = 0; i < links.length; i++) {
            links[i].style.color = "black";
            links[i].style.fontSize = "medium";
            links[i].classList.remove("white");
        }
    }
});
