/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!************************************!*\
  !*** ./resources/js/eventforms.js ***!
  \************************************/
if (document.getElementById('event-create-div')) {
  var validateForm = function validateForm() {
    if (titleCheck && contentCheck && capacityCheck && locationCheck && mainimageCheck && datefromCheck && dateuntilCheck) {
      button.disabled = false;
      button.style.backgroundColor = "";
    } else {
      button.disabled = true;
      button.style.backgroundColor = "grey";
    }
  };

  var foo = function foo() {
    var contentLength = content.getAttribute('data-length');

    if (contentLength <= 49) {
      contentCheck = false;
      document.getElementById('contentSpan').innerHTML = '<i class="fas fa-times"></i>';
      document.getElementById('contentSpan').style.color = "red";
      setTimeout(foo, 2000);
    } else if (contentLength > 49) {
      contentCheck = true;
      document.getElementById('contentSpan').innerHTML = '<i class="fas fa-check"></i>';
      document.getElementById('contentSpan').style.color = "green";
      setTimeout(foo, 2000);
    }

    validateForm();
  };

  var fooDateFrom = function fooDateFrom() {
    if (datefrom.value != '') {
      datefromCheck = true;
      document.getElementById('datefromSpan').innerHTML = '<i class="fas fa-check"></i>';
      document.getElementById('datefromSpan').style.color = "green";
      setTimeout(fooDateFrom, 2000);
    } else {
      datefromCheck = false;
      setTimeout(fooDateFrom, 2000);
    }

    validateForm();
  };

  var fooDateUntil = function fooDateUntil() {
    if (dateuntil.value != '') {
      dateuntilCheck = true;
      document.getElementById('dateuntilSpan').innerHTML = '<i class="fas fa-check"></i>';
      document.getElementById('dateuntilSpan').style.color = "green";
      setTimeout(fooDateUntil, 2000);
    } else {
      dateuntilCheck = false;
      setTimeout(fooDateUntil, 2000);
    }

    validateForm();
  };

  var button = document.querySelector('#submit');
  button.disabled = true;
  button.style.backgroundColor = "grey";
  var title = document.getElementById('title');
  var titleCheck = false;
  document.getElementById('titleSpan').innerHTML = '<i class="fas fa-times"></i>';
  document.getElementById('titleSpan').style.color = "red";
  title.addEventListener('input', function (e) {
    if (title.value.length > 0 && title.value.length < 200) {
      titleCheck = true;
      document.getElementById('titleSpan').innerHTML = '<i class="fas fa-check"></i>';
      document.getElementById('titleSpan').style.color = "green";
    } else {
      titleCheck = false;
      document.getElementById('titleSpan').innerHTML = '<i class="fas fa-times"></i>';
      document.getElementById('titleSpan').style.color = "red";
    }

    validateForm();
  });
  var content = document.getElementById('inhoud');
  var contentCheck = false;
  foo();
  var capacityCheck = false;
  var capacity = document.getElementById('capacity');
  document.getElementById('capacitySpan').innerHTML = '<i class="fas fa-times"></i>';
  document.getElementById('capacitySpan').style.color = "red";
  capacity.addEventListener('input', function (e) {
    if (capacity.value != '' && capacity.value > 0) {
      capacityCheck = true;
      document.getElementById('capacitySpan').innerHTML = '<i class="fas fa-check"></i>';
      document.getElementById('capacitySpan').style.color = "green";
    }

    if (capacity.value == '' || capacity.value <= 0) {
      document.getElementById('capacitySpan').innerHTML = '<i class="fas fa-times"></i>';
      document.getElementById('capacitySpan').style.color = "red";
    }

    validateForm();
  });
  var locationCheck = false;
  var location = document.getElementById('location');
  document.getElementById('locationSpan').innerHTML = '<i class="fas fa-times"></i>';
  document.getElementById('locationSpan').style.color = "red";
  location.addEventListener('input', function (e) {
    if (location.value != '') {
      locationCheck = true;
      document.getElementById('locationSpan').innerHTML = '<i class="fas fa-check"></i>';
      document.getElementById('locationSpan').style.color = "green";
    }

    if (location.value == '') {
      document.getElementById('locationSpan').innerHTML = '<i class="fas fa-times"></i>';
      document.getElementById('locationSpan').style.color = "red";
    }

    validateForm();
  });
  var mainimageCheck = false;
  var mainimage = document.getElementById('main-image');
  document.getElementById('mainimageSpan').innerHTML = '<i class="fas fa-times"></i>';
  document.getElementById('mainimageSpan').style.color = "red";
  mainimage.addEventListener('change', function (e) {
    if (mainimage.files.length != 0) {
      mainimageCheck = true;
      document.getElementById('mainimageSpan').innerHTML = '<i class="fas fa-check"></i>';
      document.getElementById('mainimageSpan').style.color = "green";
    } else {
      mainimageCheck = false;
      document.getElementById('mainimageSpan').innerHTML = '<i class="fas fa-times"></i>';
      document.getElementById('mainimageSpan').style.color = "red";
    }

    validateForm();
  });
  var datefromCheck = false;
  var datefrom = document.getElementById('date-from');
  document.getElementById('datefromSpan').innerHTML = '<i class="fas fa-times"></i>';
  document.getElementById('datefromSpan').style.color = "red";
  fooDateFrom();
  var dateuntilCheck = false;
  var dateuntil = document.getElementById('date-until');
  document.getElementById('dateuntilSpan').innerHTML = '<i class="fas fa-times"></i>';
  document.getElementById('dateuntilSpan').style.color = "red";
  fooDateUntil();
  var timefromhourCheck = true;
  var timefromhour = document.getElementById('time-from-hour');
  var timefromminuteCheck = true;
  var timefromminute = document.getElementById('time-from-minute');
  var timeuntilhourCheck = true;
  var timeuntilhour = document.getElementById('time-until-hour');
  var timeuntilminuteCheck = true;
  var timeuntilminute = document.getElementById('time-until-minute');
  document.getElementById('timefromhourSpan').innerHTML = '<i class="fas fa-check"></i>';
  document.getElementById('timefromhourSpan').style.color = "green";
  document.getElementById('timeuntilhourSpan').innerHTML = '<i class="fas fa-check"></i>';
  document.getElementById('timeuntilhourSpan').style.color = "green";
} //////EDIT/////


if (document.getElementById('event-edit-div')) {
  var _validateForm = function _validateForm() {
    var button = document.querySelector('#submit');

    if (_titleCheck && _contentCheck && _capacityCheck && _locationCheck && _mainimageCheck && _datefromCheck && _dateuntilCheck) {
      button.disabled = false;
      button.style.backgroundColor = "";
    } else {
      button.disabled = true;
      button.style.backgroundColor = "grey";
    }
  };

  var _foo = function _foo() {
    var contentLength = _content.getAttribute('data-length');

    if (contentLength <= 49) {
      _contentCheck = false;
      document.getElementById('contentSpan').innerHTML = '<i class="fas fa-times"></i>';
      document.getElementById('contentSpan').style.color = "red";
      setTimeout(_foo, 2000);
    } else if (contentLength > 49) {
      _contentCheck = true;
      document.getElementById('contentSpan').innerHTML = '<i class="fas fa-check"></i>';
      document.getElementById('contentSpan').style.color = "green";
      setTimeout(_foo, 2000);
    }

    _validateForm();
  };

  var _fooDateFrom = function _fooDateFrom() {
    if (_datefrom.value != '') {
      _datefromCheck = true;
      document.getElementById('datefromSpan').innerHTML = '<i class="fas fa-check"></i>';
      document.getElementById('datefromSpan').style.color = "green";
      setTimeout(_fooDateFrom, 2000);
    } else {
      _datefromCheck = false;
      setTimeout(_fooDateFrom, 2000);
    }

    _validateForm();
  };

  var _fooDateUntil = function _fooDateUntil() {
    if (_dateuntil.value != '') {
      _dateuntilCheck = true;
      document.getElementById('dateuntilSpan').innerHTML = '<i class="fas fa-check"></i>';
      document.getElementById('dateuntilSpan').style.color = "green";
      setTimeout(_fooDateUntil, 2000);
    } else {
      _dateuntilCheck = false;
      setTimeout(_fooDateUntil, 2000);
    }

    _validateForm();
  };

  var _title = document.getElementById('title');

  var _titleCheck = true;
  document.getElementById('titleSpan').innerHTML = '<i class="fas fa-check"></i>';
  document.getElementById('titleSpan').style.color = "green";

  _title.addEventListener('input', function (e) {
    if (_title.value.length > 0 && _title.value.length < 200) {
      _titleCheck = true;
      document.getElementById('titleSpan').innerHTML = '<i class="fas fa-check"></i>';
      document.getElementById('titleSpan').style.color = "green";
    } else {
      _titleCheck = false;
      document.getElementById('titleSpan').innerHTML = '<i class="fas fa-times"></i>';
      document.getElementById('titleSpan').style.color = "red";
    }

    _validateForm();
  });

  var _content = document.getElementById('inhoud');

  var _contentCheck = true;

  _foo();

  var _capacityCheck = true;

  var _capacity = document.getElementById('capacity');

  document.getElementById('capacitySpan').innerHTML = '<i class="fas fa-check"></i>';
  document.getElementById('capacitySpan').style.color = "green";

  _capacity.addEventListener('input', function (e) {
    if (_capacity.value != '' && _capacity.value > 0) {
      _capacityCheck = true;
      document.getElementById('capacitySpan').innerHTML = '<i class="fas fa-check"></i>';
      document.getElementById('capacitySpan').style.color = "green";
    }

    if (_capacity.value == '' || _capacity.value <= 0) {
      document.getElementById('capacitySpan').innerHTML = '<i class="fas fa-times"></i>';
      document.getElementById('capacitySpan').style.color = "red";
    }

    _validateForm();
  });

  var _locationCheck = true;

  var _location = document.getElementById('location');

  document.getElementById('locationSpan').innerHTML = '<i class="fas fa-check"></i>';
  document.getElementById('locationSpan').style.color = "green";

  _location.addEventListener('input', function (e) {
    if (_location.value != '') {
      _locationCheck = true;
      document.getElementById('locationSpan').innerHTML = '<i class="fas fa-check"></i>';
      document.getElementById('locationSpan').style.color = "green";
    }

    if (_location.value == '') {
      document.getElementById('locationSpan').innerHTML = '<i class="fas fa-times"></i>';
      document.getElementById('locationSpan').style.color = "red";
    }

    _validateForm();
  });

  var _mainimageCheck = true;

  var _mainimage = document.getElementById('main-image');

  document.getElementById('mainimageSpan').innerHTML = '<i class="fas fa-check"></i>';
  document.getElementById('mainimageSpan').style.color = "green";

  _mainimage.addEventListener('change', function (e) {
    if (_mainimage.files.length != 0) {
      _mainimageCheck = true;
      document.getElementById('mainimageSpan').innerHTML = '<i class="fas fa-check"></i>';
      document.getElementById('mainimageSpan').style.color = "green";
    } else {
      _mainimageCheck = false;
      document.getElementById('mainimageSpan').innerHTML = '<i class="fas fa-times"></i>';
      document.getElementById('mainimageSpan').style.color = "red";
    }

    _validateForm();
  });

  var _datefromCheck = true;

  var _datefrom = document.getElementById('date-from');

  document.getElementById('datefromSpan').innerHTML = '<i class="fas fa-times"></i>';
  document.getElementById('datefromSpan').style.color = "red";
  var _dateuntilCheck = true;

  var _dateuntil = document.getElementById('date-until');

  document.getElementById('dateuntilSpan').innerHTML = '<i class="fas fa-times"></i>';
  document.getElementById('dateuntilSpan').style.color = "red";

  _fooDateFrom();

  _fooDateUntil();

  document.getElementById('timefromhourSpan').innerHTML = '<i class="fas fa-check"></i>';
  document.getElementById('timefromhourSpan').style.color = "green";
  document.getElementById('timeuntilhourSpan').innerHTML = '<i class="fas fa-check"></i>';
  document.getElementById('timeuntilhourSpan').style.color = "green";
}
/******/ })()
;