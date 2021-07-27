/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**************************************!*\
  !*** ./resources/js/articleforms.js ***!
  \**************************************/
if (document.getElementById('article-create-div') != null) {
  var validateForm = function validateForm() {
    if (titleCheck && contentCheck && bannerCheck) {
      button.disabled = false;
      button.style.backgroundColor = "";
    } else {
      button.disabled = true;
      button.style.backgroundColor = "grey";
    }
  };

  var foo = function foo() {
    var contentLength = content.getAttribute('data-length');

    if (contentLength <= 299) {
      contentCheck = false;
      document.getElementById('contentSpan').innerHTML = '<i class="fas fa-times"></i>';
      document.getElementById('contentSpan').style.color = "red";
      setTimeout(foo, 2000);
    } else if (contentLength > 299) {
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
  var titleCheck = false;
  document.getElementById('titleSpan').innerHTML = '<i class="fas fa-times"></i>';
  document.getElementById('titleSpan').style.color = "red";
  var title = document.getElementById('title');
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
  var bannerCheck = false;
  document.getElementById('bannerSpan').innerHTML = '<i class="fas fa-times"></i>';
  document.getElementById('bannerSpan').style.color = "red";
  var bannerImage = document.getElementById('banner-image');
  bannerImage.addEventListener('change', function (e) {
    if (bannerImage.files.length != 0) {
      bannerCheck = true;
      document.getElementById('bannerSpan').innerHTML = '<i class="fas fa-check"></i>';
      document.getElementById('bannerSpan').style.color = "green";
    } else {
      bannerCheck = false;
      document.getElementById('bannerSpan').innerHTML = '<i class="fas fa-times"></i>';
      document.getElementById('bannerSpan').style.color = "red";
    }

    validateForm();
  });
}

if (document.getElementById('article-edit-div') != null) {
  var _validateForm = function _validateForm() {
    if (_titleCheck && _contentCheck && _bannerCheck) {
      _button.disabled = false;
      _button.style.backgroundColor = "";
    } else {
      _button.disabled = true;
      _button.style.backgroundColor = "grey";
    }
  };

  var _foo = function _foo() {
    var contentLength = _content.getAttribute('data-length');

    if (contentLength <= 299) {
      _contentCheck = false;
      document.getElementById('contentSpan').innerHTML = '<i class="fas fa-times"></i>';
      document.getElementById('contentSpan').style.color = "red";
      setTimeout(_foo, 2000);
    } else if (contentLength > 299) {
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

  var _bannerImage = document.getElementById('banner-image');

  var _bannerCheck = true;

  var _content = document.getElementById('inhoud');

  var _contentCheck = true;
  document.getElementById('titleSpan').innerHTML = '<i class="fas fa-check"></i>';
  document.getElementById('titleSpan').style.color = "green";
  document.getElementById('contentSpan').innerHTML = '<i class="fas fa-check"></i>';
  document.getElementById('contentSpan').style.color = "green";
  document.getElementById('bannerSpan').innerHTML = '<i class="fas fa-check"></i>';
  document.getElementById('bannerSpan').style.color = "green";

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

  _bannerImage.addEventListener('change', function (e) {
    if (_bannerImage.files.length != 0) {
      _bannerCheck = true;
      document.getElementById('bannerSpan').innerHTML = '<i class="fas fa-check"></i>';
      document.getElementById('bannerSpan').style.color = "green";
    } else {
      _bannerCheck = false;
      document.getElementById('bannerSpan').innerHTML = '<i class="fas fa-times"></i>';
      document.getElementById('bannerSpan').style.color = "red";
    }

    _validateForm();
  });

  _foo();
}
/******/ })()
;