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
        form.style.transform = "translate(-50%, 10%)";
        
    }
    else{
        form.style.transform = "translate(-50%, -50%)";
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


// Import the functions you need from the SDKs you need
import { initializeApp } from "firebase/app";
import { getAnalytics } from "firebase/analytics";
// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
const firebaseConfig = {
  apiKey: "AIzaSyBH62XEq9cwKDhaaDFn287AM-dq4diguD8",
  authDomain: "dietauthentication.firebaseapp.com",
  projectId: "dietauthentication",
  storageBucket: "dietauthentication.appspot.com",
  messagingSenderId: "550291683114",
  appId: "1:550291683114:web:9078570b73c000911b1053",
  measurementId: "G-9SSN2L0L9F"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const analytics = getAnalytics(app);


import { getAuth, createUserWithEmailAndPassword } from "firebase/auth";

const auth = getAuth();
createUserWithEmailAndPassword(auth, email, password)
  .then((userCredential) => {
    // Signed in
    const user = userCredential.user;
    // ...
  })
  .catch((error) => {
    const errorCode = error.code;
    const errorMessage = error.message;
    // ..
  });