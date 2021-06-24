/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**************************************!*\
  !*** ./resources/js/profileforms.js ***!
  \**************************************/
var imageSpan = document.getElementById('imageSpan');
var image = document.getElementById('user-image');
var imageCheck = true;
var nameSpan = document.getElementById('nameSpan');
var name = document.getElementById('user-name');
var nameCheck = true;
var emailSpan = document.getElementById('emailSpan');
var email = document.getElementById('user-email');
var emailCheck = true;
var shopSpan = document.getElementById('studioSpan');
var shopname = document.getElementById('user-shopname');
var shopCheck = true;
var locationSpan = document.getElementById('locationSpan');
var shoplocation = document.getElementById('user-shoplocation');
var locationCheck = true;
imageSpan.innerHTML = '<i class="fas fa-check"></i>';
imageSpan.style.color = "green";
nameSpan.innerHTML = '<i class="fas fa-check"></i>';
nameSpan.style.color = "green";
emailSpan.innerHTML = '<i class="fas fa-check"></i>';
emailSpan.style.color = "green";
shopSpan.innerHTML = '<i class="fas fa-check"></i>';
shopSpan.style.color = "green";
locationSpan.innerHTML = '<i class="fas fa-check"></i>';
locationSpan.style.color = "green";
var button = document.querySelector('#editsubmit');

function validateForm() {
  if (imageCheck && nameCheck && emailCheck && shopCheck && locationCheck) {
    button.disabled = false;
    button.style.backgroundColor = "";
  } else {
    button.disabled = true;
    button.style.backgroundColor = "grey";
  }
}

name.addEventListener('input', function (e) {
  if (name.value.length > 0 && name.value.length < 200) {
    nameCheck = true;
    nameSpan.innerHTML = '<i class="fas fa-check"></i>';
    nameSpan.style.color = "green";
  } else {
    nameCheck = false;
    nameSpan.innerHTML = '<i class="fas fa-times"></i>';
    nameSpan.style.color = "red";
  }

  validateForm();
});
email.addEventListener('input', function (e) {
  if (email.value.length > 0 && email.value.length < 200) {
    emailCheck = true;
    emailSpan.innerHTML = '<i class="fas fa-check"></i>';
    emailSpan.style.color = "green";
  } else {
    emailCheck = false;
    emailSpan.innerHTML = '<i class="fas fa-times"></i>';
    emailSpan.style.color = "red";
  }

  validateForm();
});
shopname.addEventListener('input', function (e) {
  if (shopname.value.length > 0 && shopname.value.length < 200) {
    shopCheck = true;
    shopSpan.innerHTML = '<i class="fas fa-check"></i>';
    shopSpan.style.color = "green";
  } else {
    shopCheck = false;
    shopSpan.innerHTML = '<i class="fas fa-times"></i>';
    shopSpan.style.color = "red";
  }

  validateForm();
});
shoplocation.addEventListener('input', function (e) {
  if (shoplocation.value.length > 0 && shoplocation.value.length < 200) {
    locationCheck = true;
    locationSpan.innerHTML = '<i class="fas fa-check"></i>';
    locationSpan.style.color = "green";
  } else {
    locationCheck = false;
    locationSpan.innerHTML = '<i class="fas fa-times"></i>';
    locationSpan.style.color = "red";
  }

  validateForm();
});
/******/ })()
;