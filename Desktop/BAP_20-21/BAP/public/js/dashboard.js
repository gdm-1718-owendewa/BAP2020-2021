/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***********************************!*\
  !*** ./resources/js/dashboard.js ***!
  \***********************************/
var eventSignOutButtons = document.querySelectorAll('.sign-out-of-event-button');

var _loop = function _loop(index) {
  var element = eventSignOutButtons[index];
  var baseURL = window.location.origin;
  eventSignOutButtons[index].addEventListener('click', function (e) {
    e.preventDefault();
    console.log(element);
    var blackoutDiv = document.createElement('div');
    blackoutDiv.classList.add('event-sign-out-div');
    document.getElementById('dasbord-container').appendChild(blackoutDiv);
    var eventSignOutModal = document.createElement('div');
    eventSignOutModal.classList.add('event-sign-out-modal');
    document.getElementById('dasbord-container').appendChild(eventSignOutModal);
    eventSignOutModal.innerHTML = "\n        <a id=\"event-sign-out-modal-close-button\" href=\"#\">&#10005;</a> \n        <div id=\"event-sign-out-modal-content-div\">\n        <div id=\"event-sign-out-modal-message-div\">\n            <p id=\"event-sign-out-modal-message\"></p>\n        </div>\n        <div id=\"event-sign-out-modal-buttons-div\">\n            <a href=\"".concat(baseURL + '/event/unsign/' + eventSignOutButtons[index].getAttribute('data-uid') + '/' + eventSignOutButtons[index].getAttribute('data-eid'), "\" id=\"event-sign-out-accept\">Ja</a>\n            <a href=\"#\" id=\"event-sign-out-decline\">Nee</a>\n            </div>  \n        </div>");
    document.getElementById('event-sign-out-modal-message').innerHTML = "Bent u zeker dat u zich wilt uitschrijven van dit event?";
    document.body.style.overflow = "hidden";
    document.body.style.height = "100vh";
    document.getElementById('event-sign-out-decline').addEventListener('click', function (e) {
      e.preventDefault();
      document.getElementById('dasbord-container').removeChild(eventSignOutModal);
      document.getElementById('dasbord-container').removeChild(blackoutDiv);
      document.body.style.overflow = "";
      document.body.style.height = "";
    });
    document.getElementById('event-sign-out-modal-close-button').addEventListener('click', function (e) {
      e.preventDefault();
      document.getElementById('dasbord-container').removeChild(eventSignOutModal);
      document.getElementById('dasbord-container').removeChild(blackoutDiv);
      document.body.style.overflow = "";
      document.body.style.height = "";
    });
    blackoutDiv.addEventListener('click', function (e) {
      e.preventDefault();
      document.getElementById('dasbord-container').removeChild(eventSignOutModal);
      document.getElementById('dasbord-container').removeChild(blackoutDiv);
      document.body.style.overflow = "";
      document.body.style.height = "";
    });
  });
};

for (var index = 0; index < eventSignOutButtons.length; index++) {
  _loop(index);
}
/******/ })()
;