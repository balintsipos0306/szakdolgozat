const wh = window.innerHeight;
document.addEventListener("scroll", function(){
    var vonal = document.getElementById("hr");

    if (window.scrollY > (wh*0.2)){
        vonal.style.filter = "opacity(1.0)";
    }
    else{
        vonal.style.filter = "opacity(0.0)";
    }
});