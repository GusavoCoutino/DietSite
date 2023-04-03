document.querySelectorAll(".nav-link").forEach(n => n.addEventListener("click", () =>{
    hamburger.classList.remove("active");
    navMenu.classList.remove("active");
}))

jQuery(document).ready(function($){
const hamburger = document.querySelector(".hamburger");
const navMenu = document.querySelector(".nav-menu");
const form = document.querySelector(".loginForm");
let counter = 0;


hamburger.addEventListener("click", ()=>{
    hamburger.classList.toggle("active");
    navMenu.classList.toggle("active");
    if(counter%2==0){
        form.style.transform = "translate(-50%, -10%)";
        
    }
    else{
        form.style.transform = "translate(-50%, -50%)";
        if(form.offsetHeight==800){
            form.style.transform = "translate(-50%, -35%)";
        }
    }

    counter++;
    
})
     
});

function validateLogin(){
    try{

        em = document.getElementById("email").value;
        pd = document.getElementById("pass").value;
        if(em == null || em == "" || pd == null || pd == "" ){
            alert("Both fields must be filled out");
            return false;
        }
        if( em.indexOf('@') == -1 ) {
            alert("Invalid email address");
            return false;
        }
        return true;
    } catch(e) {
        return false;
    }
}
