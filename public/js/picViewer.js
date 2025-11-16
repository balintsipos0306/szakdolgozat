function showPic(element){

    if (window.innerWidth > 576){

    const overlay = document.createElement("div");
    overlay.id = "overlay";
    document.body.appendChild(overlay);

    overlay.style.position = "fixed";
    overlay.style.top = "0";
    overlay.style.left = "0";
    overlay.style.width = "100%";
    overlay.style.height = "100%";
    overlay.style.backgroundColor = "rgba(0, 0, 0, 0.8)";
    overlay.style.zIndex = "999";
    overlay.style.transition = "opacity 0.5s";

    const zoomed = element.cloneNode(false);
    overlay.appendChild(zoomed);

    zoomed.style.position = "fixed";
    zoomed.style.width = "30%";
    zoomed.style.height = "auto";
    zoomed.style.top = "50%";
    zoomed.style.left = "50%";
    zoomed.style.transform = "translate(-50%, -50%)";
    zoomed.style.transition = "width 0.5s, opacity 0.5s";
    zoomed.style.zIndex = "1000";

    setTimeout(() => {
        overlay.style.opacity = "1";
        zoomed.style.width = "60%";
    }, 10);

    overlay.addEventListener("click", function(){
        overlay.style.opacity = "0";
        zoomed.style.width = "0%";
        setTimeout(()=>{
            overlay.remove();
        }, 200);
    });
    }
    
};
