document.querySelectorAll(".nav-link").forEach(n => n.addEventListener("click", () =>{
    hamburger.classList.remove("active");
    navMenu.classList.remove("active");
}))

jQuery(document).ready(function($){
const hamburger = document.querySelector(".hamburger");
const navMenu = document.querySelector(".nav-menu");
const table = document.querySelector(".dietContain");
let counter = 0;


hamburger.addEventListener("click", ()=>{
    hamburger.classList.toggle("active");
    navMenu.classList.toggle("active");
    if(counter%2==0){
        table.style.transform = "translate(0, 40%)";
        
    }
    else{
        table.style.transform = "translate(0, 0)";
    }

    counter++;
    
    })
});


