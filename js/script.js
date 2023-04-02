document.querySelectorAll(".nav-link").forEach(n => n.addEventListener("click", () =>{
    hamburger.classList.remove("active");
    navMenu.classList.remove("active");
}))

jQuery(document).ready(function($){
    const hamburger = document.querySelector(".hamburger");
const navMenu = document.querySelector(".nav-menu");
const title = document.querySelector(".titleMessage");
const background = document.querySelector(".title");
let counter = 0;


hamburger.addEventListener("click", ()=>{
    hamburger.classList.toggle("active");
    navMenu.classList.toggle("active");
    if(counter%2==0){
        title.style.transform = "translate(-50%, -10%)";
        background.style.height = "1200px";
        
    }
    else{
        title.style.transform = "translate(-50%, -50%)";
        background.style.height = "900px";
        if(title.offsetHeight==800){
            title.style.transform = "translate(-50%, -35%)";
        }
    }

    counter++;
    
})
    console.log("Ready?");
    $('.owl-carousel').owlCarousel({
        loop:true,
        margin:10,
        nav:true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:3
            },
            1000:{
                items:5
            }
        }
    });

    
    
    $('.chart').easyPieChart({
        easing: 'easeInOut',
        barColor: '#fff',
        trackColor: false,
        scaleColor: false,
        lineWidth: 4,
        size: 152,
        onStep: function(from, to, percent){
            $(this.el).find('.percent').text(Math.round(percent))
        }
    });
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

