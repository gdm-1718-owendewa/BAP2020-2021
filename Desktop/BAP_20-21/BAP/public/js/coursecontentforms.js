/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!********************************************!*\
  !*** ./resources/js/coursecontentforms.js ***!
  \********************************************/
if (document.getElementById('course-content-create-div')) {
  var validateForm = function validateForm() {
    if (supportingFilesCheck) {
      button.disabled = false;
      button.style.backgroundColor = "";
    } else if (titleCheck && contentCheck) {
      button.disabled = false;
      button.style.backgroundColor = "";
    } else {
      button.disabled = true;
      button.style.backgroundColor = "grey";
    }
  };

  var foo = function foo() {
    var contentLength = inhoud.getAttribute('data-length');

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
  var inhoud = document.getElementById('inhoud');
  var contentCheck = false;
  document.getElementById('contentSpan').innerHTML = '<i class="fas fa-times"></i>';
  document.getElementById('contentSpan').style.color = "red";
  foo();
  var supportingFiles = document.getElementById('supporting-files');
  var supportingFilesCheck = false;
  document.getElementById('fileSpan').innerHTML = '<i class="fas fa-times"></i>';
  document.getElementById('fileSpan').style.color = "red";
  supportingFiles.addEventListener('change', function (e) {
    if (supportingFiles.files.length != 0) {
      supportingFilesCheck = true;
      document.getElementById('fileSpan').innerHTML = '<i class="fas fa-check"></i>';
      document.getElementById('fileSpan').style.color = "green";
    } else {
      supportingFilesCheck = false;
      document.getElementById('fileSpan').innerHTML = '<i class="fas fa-times"></i>';
      document.getElementById('fileSpan').style.color = "red";
    }

    validateForm();
  });
}

if (document.getElementById('course-content-edit-div')) {
  var _validateForm = function _validateForm() {
    if (_titleCheck && _contentCheck) {
      _button.disabled = false;
      _button.style.backgroundColor = "";
    } else {
      _button.disabled = true;
      _button.style.backgroundColor = "grey";
    }
  };

  var _foo = function _foo() {
    var contentLength = _inhoud.getAttribute('data-length');

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

  var _inhoud = document.getElementById('inhoud');

  var _contentCheck = true;
  document.getElementById('contentSpan').innerHTML = '<i class="fas fa-check"></i>';
  document.getElementById('contentSpan').style.color = "green";

  _foo();
}
/******/ })()
;