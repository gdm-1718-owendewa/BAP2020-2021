/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*************************************!*\
  !*** ./resources/js/courseforms.js ***!
  \*************************************/
if (document.getElementById('course-create-div')) {
  var validateForm = function validateForm() {
    if (titleCheck && infoCheck && inhoudCheck) {
      button.disabled = false;
      button.style.backgroundColor = "";
    } else {
      button.disabled = true;
      button.style.backgroundColor = "grey";
    }
  };

  var fooInfo = function fooInfo() {
    var contentLength = info.getAttribute('data-length');

    if (contentLength <= 99) {
      infoCheck = false;
      document.getElementById('infoSpan').innerHTML = '<i class="fas fa-times"></i>';
      document.getElementById('infoSpan').style.color = "red";
      setTimeout(fooInfo, 2000);
    } else if (contentLength > 99) {
      infoCheck = true;
      document.getElementById('infoSpan').innerHTML = '<i class="fas fa-check"></i>';
      document.getElementById('infoSpan').style.color = "green";
      setTimeout(fooInfo, 2000);
    }

    validateForm();
  };

  var fooContent = function fooContent() {
    var contentLength = inhoud.getAttribute('data-length');

    if (contentLength <= 99) {
      inhoudCheck = false;
      document.getElementById('contentSpan').innerHTML = '<i class="fas fa-times"></i>';
      document.getElementById('contentSpan').style.color = "red";
      setTimeout(fooContent, 2000);
    } else if (contentLength > 99) {
      inhoudCheck = true;
      document.getElementById('contentSpan').innerHTML = '<i class="fas fa-check"></i>';
      document.getElementById('contentSpan').style.color = "green";
      setTimeout(fooContent, 2000);
    }

    validateForm();
  }; // let datefrom = document.getElementById('from');
  // let datefromCheck = false;
  // document.getElementById('fromSpan').innerHTML = '<i class="fas fa-times"></i>'
  // document.getElementById('fromSpan').style.color = "red"
  // function fooDateFrom() {
  //     if(datefrom.value != ''){
  //         datefromCheck = true;
  //         document.getElementById('fromSpan').innerHTML = '<i class="fas fa-check"></i>'
  //         document.getElementById('fromSpan').style.color = "green"
  //         setTimeout(fooDateFrom, 2000);
  //     }else{
  //         datefromCheck = false;
  //         setTimeout(fooDateFrom, 2000);
  //     }
  //     validateForm();
  // }
  // let dateuntil = document.getElementById('until');
  // let dateuntilCheck = false;
  // document.getElementById('untilSpan').innerHTML = '<i class="fas fa-times"></i>'
  // document.getElementById('untilSpan').style.color = "red"
  // function fooDateUntil() {
  //     if(dateuntil.value != ''){
  //         dateuntilCheck = true;
  //         document.getElementById('untilSpan').innerHTML = '<i class="fas fa-check"></i>'
  //         document.getElementById('untilSpan').style.color = "green"
  //         setTimeout(fooDateUntil, 2000);
  //     }else{
  //         dateuntilCheck = false;
  //         setTimeout(fooDateUntil, 2000);
  //     }
  //     validateForm();
  // }


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
  var info = document.getElementById('info');
  var infoCheck = false;
  document.getElementById('infoSpan').innerHTML = '<i class="fas fa-times"></i>';
  document.getElementById('infoSpan').style.color = "red";
  var inhoud = document.getElementById('inhoud');
  var inhoudCheck = false;
  document.getElementById('contentSpan').innerHTML = '<i class="fas fa-times"></i>';
  document.getElementById('contentSpan').style.color = "red";
  fooInfo();
  fooContent(); // fooDateFrom();
  // fooDateUntil();
}

if (document.getElementById('course-edit-div')) {
  var _validateForm = function _validateForm() {
    if (_titleCheck && _infoCheck && _inhoudCheck) {
      _button.disabled = false;
      _button.style.backgroundColor = "";
    } else {
      _button.disabled = true;
      _button.style.backgroundColor = "grey";
    }
  };

  var _fooInfo = function _fooInfo() {
    var contentLength = _info.getAttribute('data-length');

    if (contentLength <= 99) {
      _infoCheck = false;
      document.getElementById('infoSpan').innerHTML = '<i class="fas fa-times"></i>';
      document.getElementById('infoSpan').style.color = "red";
      setTimeout(_fooInfo, 2000);
    } else if (contentLength > 99) {
      _infoCheck = true;
      document.getElementById('infoSpan').innerHTML = '<i class="fas fa-check"></i>';
      document.getElementById('infoSpan').style.color = "green";
      setTimeout(_fooInfo, 2000);
    }

    _validateForm();
  };

  var _fooContent = function _fooContent() {
    var contentLength = _inhoud.getAttribute('data-length');

    if (contentLength <= 99) {
      _inhoudCheck = false;
      document.getElementById('contentSpan').innerHTML = '<i class="fas fa-times"></i>';
      document.getElementById('contentSpan').style.color = "red";
      setTimeout(_fooContent, 2000);
    } else if (contentLength > 99) {
      _inhoudCheck = true;
      document.getElementById('contentSpan').innerHTML = '<i class="fas fa-check"></i>';
      document.getElementById('contentSpan').style.color = "green";
      setTimeout(_fooContent, 2000);
    }

    _validateForm();
  }; // let datefrom = document.getElementById('from');
  // let datefromCheck = true;
  // document.getElementById('fromSpan').innerHTML = '<i class="fas fa-check"></i>'
  // document.getElementById('fromSpan').style.color = "green"
  // function fooDateFrom() {
  //     if(datefrom.value != ''){
  //         datefromCheck = true;
  //         document.getElementById('fromSpan').innerHTML = '<i class="fas fa-check"></i>'
  //         document.getElementById('fromSpan').style.color = "green"
  //         setTimeout(fooDateFrom, 2000);
  //     }else{
  //         datefromCheck = false;
  //         setTimeout(fooDateFrom, 2000);
  //     }
  //     validateForm();
  // }
  // let dateuntil = document.getElementById('until');
  // let dateuntilCheck = true;
  // document.getElementById('untilSpan').innerHTML = '<i class="fas fa-check"></i>'
  // document.getElementById('untilSpan').style.color = "green"
  // function fooDateUntil() {
  //     if(dateuntil.value != ''){
  //         dateuntilCheck = true;
  //         document.getElementById('untilSpan').innerHTML = '<i class="fas fa-check"></i>'
  //         document.getElementById('untilSpan').style.color = "green"
  //         setTimeout(fooDateUntil, 2000);
  //     }else{
  //         dateuntilCheck = false;
  //         setTimeout(fooDateUntil, 2000);
  //     }
  //     validateForm();
  // }


  var _button = document.querySelector('#submit');

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

  var _info = document.getElementById('info');

  var _infoCheck = true;
  document.getElementById('infoSpan').innerHTML = '<i class="fas fa-check"></i>';
  document.getElementById('infoSpan').style.color = "green";

  var _inhoud = document.getElementById('inhoud');

  var _inhoudCheck = true;
  document.getElementById('contentSpan').innerHTML = '<i class="fas fa-check"></i>';
  document.getElementById('contentSpan').style.color = "green";

  _fooInfo();

  _fooContent(); // fooDateFrom();
  // fooDateUntil();

}
/******/ })()
;