document.querySelectorAll(".nav-link").forEach(n => n.addEventListener("click", () =>{
    hamburger.classList.remove("active");
    navMenu.classList.remove("active");
}))

jQuery(document).ready(function($){
const hamburger = document.querySelector(".hamburger");
const navMenu = document.querySelector(".nav-menu");
const form = document.querySelector(".signinForm");
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

function validateSignin(){
    try{
        fn = document.getElementById("firstName").value;
        ln = document.getElementById("lastName").value;
        em = document.getElementById("email").value;
        pd = document.getElementById("pass").value;
        pdC = document.getElementById("passConfirm").value;
        if(fn == null || fn == "" || ln == null || ln == "" || em == null || em == "" || pd == null || pd == "" || pdC == null || pdC == ""){
            alert("Both fields must be filled out");
            return false;
        }
        if( em.indexOf('@') == -1 ) {
            alert("Invalid email address");
            return false;
        }
        if(pd != pdC){
            alert("Passwords do not match!");
            return false;
        }
        return true;
    } catch(e) {
        return false;
    }
}

