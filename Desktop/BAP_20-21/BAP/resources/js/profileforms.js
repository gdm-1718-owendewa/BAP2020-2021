let imageSpan = document.getElementById('imageSpan');
let image = document.getElementById('user-image');
let imageCheck = true;
let nameSpan = document.getElementById('nameSpan');
let name = document.getElementById('user-name');
let nameCheck = true;
let emailSpan = document.getElementById('emailSpan');
let email = document.getElementById('user-email');
let emailCheck = true;
let shopSpan = document.getElementById('studioSpan');
let shopname = document.getElementById('user-shopname');
let shopCheck = true;
let locationSpan = document.getElementById('locationSpan');
let shoplocation = document.getElementById('user-shoplocation');
let locationCheck = true;

imageSpan.innerHTML = '<i class="fas fa-check"></i>'
imageSpan.style.color = "green"
nameSpan.innerHTML = '<i class="fas fa-check"></i>'
nameSpan.style.color = "green"
emailSpan.innerHTML = '<i class="fas fa-check"></i>'
emailSpan.style.color = "green"
shopSpan.innerHTML = '<i class="fas fa-check"></i>'
shopSpan.style.color = "green"
locationSpan.innerHTML = '<i class="fas fa-check"></i>'
locationSpan.style.color = "green"

let button = document.querySelector('#editsubmit')
function validateForm(){
    if(imageCheck && nameCheck && emailCheck && shopCheck && locationCheck){
        button.disabled = false
        button.style.backgroundColor= ""
    }else{
        button.disabled = true
        button.style.backgroundColor= "grey"
    }
}
name.addEventListener('input', (e) =>{
    if(name.value.length > 0 && name.value.length < 200){
        nameCheck = true
        nameSpan.innerHTML = '<i class="fas fa-check"></i>'
        nameSpan.style.color = "green"
    }else{
        nameCheck = false
        nameSpan.innerHTML = '<i class="fas fa-times"></i>'
        nameSpan.style.color = "red"
    }
    validateForm()
})
email.addEventListener('input', (e) =>{
    if(email.value.length > 0 && email.value.length < 200){
        emailCheck = true
        emailSpan.innerHTML = '<i class="fas fa-check"></i>'
        emailSpan.style.color = "green"
    }else{
        emailCheck = false
        emailSpan.innerHTML = '<i class="fas fa-times"></i>'
        emailSpan.style.color = "red"
    }
    validateForm()
})
shopname.addEventListener('input', (e) =>{
    if(shopname.value.length > 0 && shopname.value.length < 200){
        shopCheck = true
        shopSpan.innerHTML = '<i class="fas fa-check"></i>'
        shopSpan.style.color = "green"
    }else{
        shopCheck = false
        shopSpan.innerHTML = '<i class="fas fa-times"></i>'
        shopSpan.style.color = "red"
    }
    validateForm()
})
shoplocation.addEventListener('input', (e) =>{
    if(shoplocation.value.length > 0 && shoplocation.value.length < 200){
        locationCheck = true
        locationSpan.innerHTML = '<i class="fas fa-check"></i>'
        locationSpan.style.color = "green"
    }else{
        locationCheck = false
        locationSpan.innerHTML = '<i class="fas fa-times"></i>'
        locationSpan.style.color = "red"
    }
    validateForm()
})