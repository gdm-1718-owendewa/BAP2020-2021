/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*************************************!*\
  !*** ./resources/js/threadforms.js ***!
  \*************************************/
if (document.getElementById('thread-create-div') != null) {
  var validateForm = function validateForm() {
    if (questionCheck && infoCheck) {
      button.disabled = false;
      button.style.backgroundColor = "";
    } else {
      button.disabled = true;
      button.style.backgroundColor = "grey";
    }
  };

  var fooInfo = function fooInfo() {
    var contentLength = info.getAttribute('data-length');

    if (contentLength <= 49) {
      infoCheck = false;
      document.getElementById('infoSpan').innerHTML = '<i class="fas fa-times"></i>';
      document.getElementById('infoSpan').style.color = "red";
      setTimeout(fooInfo, 2000);
    } else if (contentLength > 49) {
      infoCheck = true;
      document.getElementById('infoSpan').innerHTML = '<i class="fas fa-check"></i>';
      document.getElementById('infoSpan').style.color = "green";
      setTimeout(fooInfo, 2000);
    }

    validateForm();
  };

  var button = document.querySelector('#submit');
  button.disabled = true;
  button.style.backgroundColor = "grey";
  var question = document.getElementById('question');
  var questionCheck = false;
  document.getElementById('questionSpan').innerHTML = '<i class="fas fa-times"></i>';
  document.getElementById('questionSpan').style.color = "red";
  question.addEventListener('input', function (e) {
    if (question.value.length > 0 && question.value.length < 200) {
      questionCheck = true;
      document.getElementById('questionSpan').innerHTML = '<i class="fas fa-check"></i>';
      document.getElementById('questionSpan').style.color = "green";
    } else {
      questionCheck = false;
      document.getElementById('questionSpan').innerHTML = '<i class="fas fa-times"></i>';
      document.getElementById('questionSpan').style.color = "red";
    }

    validateForm();
  });
  var info = document.getElementById('info');
  var infoCheck = false;
  document.getElementById('infoSpan').innerHTML = '<i class="fas fa-times"></i>';
  document.getElementById('infoSpan').style.color = "red";
  fooInfo();
}

if (document.getElementById('thread-edit-div') != null) {
  var _validateForm = function _validateForm() {
    if (_questionCheck && _infoCheck) {
      _button.disabled = false;
      _button.style.backgroundColor = "";
    } else {
      _button.disabled = true;
      _button.style.backgroundColor = "grey";
    }
  };

  var _fooInfo = function _fooInfo() {
    var contentLength = _info.getAttribute('data-length');

    if (contentLength <= 49) {
      _infoCheck = false;
      document.getElementById('infoSpan').innerHTML = '<i class="fas fa-times"></i>';
      document.getElementById('infoSpan').style.color = "red";
      setTimeout(_fooInfo, 2000);
    } else if (contentLength > 49) {
      _infoCheck = true;
      document.getElementById('infoSpan').innerHTML = '<i class="fas fa-check"></i>';
      document.getElementById('infoSpan').style.color = "green";
      setTimeout(_fooInfo, 2000);
    }

    _validateForm();
  };

  var _button = document.querySelector('#submit');

  var _question = document.getElementById('question');

  var _questionCheck = false;

  if (_question.value.length > 0 && _question.value.length < 200) {
    document.getElementById('questionSpan').innerHTML = '<i class="fas fa-check"></i>';
    document.getElementById('questionSpan').style.color = "green";
    _questionCheck = true;
  } else {
    document.getElementById('questionSpan').innerHTML = '<i class="fas fa-times"></i>';
    document.getElementById('questionSpan').style.color = "red";
    _questionCheck = false;
  }

  _question.addEventListener('input', function (e) {
    if (_question.value.length > 0 && _question.value.length < 200) {
      _questionCheck = true;
      document.getElementById('questionSpan').innerHTML = '<i class="fas fa-check"></i>';
      document.getElementById('questionSpan').style.color = "green";
    } else {
      _questionCheck = false;
      document.getElementById('questionSpan').innerHTML = '<i class="fas fa-times"></i>';
      document.getElementById('questionSpan').style.color = "red";
    }

    _validateForm();
  });

  var _info = document.getElementById('info');

  var _infoCheck = false;

  _fooInfo();
}

if (document.getElementById('detail-thread-container') != null) {
  var foo = function foo() {
    var contentLength = comment.getAttribute('data-length');

    if (contentLength == null || contentLength <= 9) {
      commentCheck = false;
      _button2.disabled = true;
      _button2.style.borderColor = "grey";
      _button2.style.color = "grey";
      document.getElementById('commentSpan').innerHTML = '<i class="fas fa-times"></i>';
      document.getElementById('commentSpan').style.color = "red";
      setTimeout(foo, 2000);
    } else if (contentLength >= 10) {
      commentCheck = true;
      _button2.disabled = false;
      _button2.style.borderColor = "rgb(203, 0, 0) ";
      _button2.style.color = "rgb(203, 0, 0) ";
      document.getElementById('commentSpan').innerHTML = '<i class="fas fa-check"></i>';
      document.getElementById('commentSpan').style.color = "green";
      setTimeout(foo, 2000);
    }
  };

  var comment = document.getElementById('comment');
  var commentCheck = false;

  var _button2 = document.querySelector('#commentsubmit');

  _button2.disabled = true;
  _button2.style.borderColor = "grey";
  _button2.style.color = "grey";
  document.getElementById('commentSpan').innerHTML = '<i class="fas fa-times"></i>';
  document.getElementById('commentSpan').style.color = "red";
  foo();
}

if (document.getElementById('comment-edit-form') != null) {
  var _foo = function _foo() {
    var contentLength = _comment.getAttribute('data-length');

    if (contentLength < 10) {
      _commentCheck = false;
      _button3.disabled = true;
      _button3.style.borderColor = "grey";
      _button3.style.color = "grey";
      setTimeout(_foo, 2000);
    } else if (contentLength >= 10) {
      _commentCheck = true;
      _button3.disabled = false;
      _button3.style.borderColor = "rgb(203, 0, 0) ";
      _button3.style.color = "rgb(203, 0, 0) ";
      setTimeout(_foo, 2000);
    }
  };

  var _button3 = document.querySelector('#commenteditsubmit');

  var _comment = document.getElementById('inhoud');

  var _commentCheck = false;

  _foo();
}
/******/ })()
;