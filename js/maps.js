document.querySelectorAll(".nav-link").forEach(n => n.addEventListener("click", () =>{
    hamburger.classList.remove("active");
    navMenu.classList.remove("active");
}))

jQuery(document).ready(function($){
const hamburger = document.querySelector(".hamburger");
const navMenu = document.querySelector(".nav-menu");
const map = document.querySelector("#map");
let counter = 0;


hamburger.addEventListener("click", ()=>{
    hamburger.classList.toggle("active");
    navMenu.classList.toggle("active");
    if(counter%2==0){
        map.style.transform = "translate(0, 70%)";
        
    }
    else{
        map.style.transform = "translate(0, 0)";
    }

    counter++;
    
    })
});

var latd = 52.632469;
var longd =  -1.689423;


function initMap() {
    // Create the map.
        const map = new google.maps.Map(document.getElementById('map'), {
        zoom: 7,
        center: { lat: latd , lng: longd },
    });
} 



const options = {
    enableHighAccuracy: true,
    timeout: 5000,
    maximumAge: 0,
  };
  
  function success(pos) {
    const crd = pos.coords;
    console.log(crd.latitude);
    latd = crd.latitude;
    longd = crd.longtitude;
    map.setCenter({lat: latd, lng: longd}); 
  }
  
  function error(err) {
    console.warn(`ERROR(${err.code}): ${err.message}`);
  }


 