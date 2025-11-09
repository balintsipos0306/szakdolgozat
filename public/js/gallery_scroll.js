document.addEventListener("DOMContentLoaded", function() {
    const bodyWidth = document.body.offsetWidth;
    const footer = document.getElementById("footer");

    if (bodyWidth <= 1300) {
        footer.classList.add("bottom");
    }
    else{
        footer.classList.remove("bottom");
    }

});