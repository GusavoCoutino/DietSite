document.querySelectorAll(".nav-link").forEach(n => n.addEventListener("click", () =>{
    hamburger.classList.remove("active");
    navMenu.classList.remove("active");
}))

jQuery(document).ready(function($){
const hamburger = document.querySelector(".hamburger");
const navMenu = document.querySelector(".nav-menu");
const store = document.querySelector(".storeTitle");
const map = document.querySelector("#map");
let counter = 0;


hamburger.addEventListener("click", ()=>{
    hamburger.classList.toggle("active");
    navMenu.classList.toggle("active");
    if(counter%2==0){
        store.style.transform = "translate(0, 200%)";
        map.style.transform = "translate(0, 200%)";
        
        
    }
    else{
        store.style.transform = "translate(0, 0)";
        map.style.transform = "translate(0, 0)";
    }

    counter++;
    });
});


var xhr = new XMLHttpRequest();
xhr.open('GET', "get_data.php", true);

xhr.onload = function() {
  if (xhr.status === 200) {
    var data = JSON.parse(xhr.responseText);

    var scriptTag = document.createElement('script');
    scriptTag.src = "https://maps.googleapis.com/maps/api/js?key=" + data.api_key + "&libraries=places";
    document.body.appendChild(scriptTag);
  } else {
    console.log('Error retrieving API data');
  }
};

xhr.send();