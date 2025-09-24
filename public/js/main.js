const wh = window.innerHeight;
document.addEventListener("scroll", function(){
    const line = document.getElementById("hr");

    if (window.scrollY > (wh*0.3)){
        line.classList.add("show")
    }
    else{
       line.classList.remove("show")
    }
});