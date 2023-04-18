document.querySelectorAll(".nav-link").forEach(n => n.addEventListener("click", () =>{
    hamburger.classList.remove("active");
    navMenu.classList.remove("active");
}))

jQuery(document).ready(function($){
const hamburger = document.querySelector(".hamburger");
const navMenu = document.querySelector(".nav-menu");
const editDiet = document.querySelector(".editDiets");
let counter = 0;


hamburger.addEventListener("click", ()=>{
    hamburger.classList.toggle("active");
    navMenu.classList.toggle("active");
    if(counter%2==0){
        editDiet.style.transform = "translate(-50%, 30%)";
        
    }
    else{
        editDiet.style.transform = "translate(-50%, -50%)";
    }

    counter++;
    });
});
