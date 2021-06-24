/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***************************************!*\
  !*** ./resources/js/tutorialforms.js ***!
  \***************************************/
if (document.getElementById('tutorial-create-div')) {
  var createNotification = function createNotification() {
    var notif = document.createElement('div');
    notif.classList.add('notif');
    document.getElementsByTagName('main')[0].appendChild(notif);
    notif.innerText = 'gekopieerd naar clipboard';
    setTimeout(function () {
      notif.remove();
    }, 3000);
  };

  var validateForm = function validateForm() {
    if (titleCheck && thumbnailCheck && descriptionCheck && kindCheck) {
      if (tuttype == 'video') {
        if (mainvideoCheck) {
          button.disabled = false;
          button.style.backgroundColor = "";
        } else {
          button.disabled = true;
          button.style.backgroundColor = "grey";
        }
      }

      if (tuttype == 'mixed') {
        if (mainvideoCheck && contentCheck) {
          button.disabled = false;
          button.style.backgroundColor = "";
        } else {
          button.disabled = true;
          button.style.backgroundColor = "grey";
        }
      }

      if (tuttype == 'written') {
        if (contentCheck) {
          button.disabled = false;
          button.style.backgroundColor = "";
        } else {
          button.disabled = true;
          button.style.backgroundColor = "grey";
        }
      }
    } else {
      button.disabled = true;
      button.style.backgroundColor = "grey";
    }
  };

  var foo = function foo() {
    var contentLength = description.getAttribute('data-length');

    if (contentLength <= 99) {
      descriptionCheck = false;
      document.getElementById('descriptionSpan').innerHTML = '<i class="fas fa-times"></i>';
      document.getElementById('descriptionSpan').style.color = "red";
      setTimeout(foo, 2000);
    } else if (contentLength > 99) {
      descriptionCheck = true;
      document.getElementById('descriptionSpan').innerHTML = '<i class="fas fa-check"></i>';
      document.getElementById('descriptionSpan').style.color = "green";
      setTimeout(foo, 2000);
    }

    validateForm();
  };

  var fooContent = function fooContent() {
    if (text) {
      var contentLength = content.getAttribute('data-length');

      if (contentLength <= 99) {
        contentCheck = false;
        document.getElementById('tutcontentSpan').innerHTML = '<i class="fas fa-times"></i>';
        document.getElementById('tutcontentSpan').style.color = "red";
        setTimeout(fooContent, 2000);
      } else if (contentLength > 99) {
        contentCheck = true;
        document.getElementById('tutcontentSpan').innerHTML = '<i class="fas fa-check"></i>';
        document.getElementById('tutcontentSpan').style.color = "green";
        setTimeout(fooContent, 2000);
      }

      validateForm();
    }
  }; //Check welk soort tutorial je hebt aangeduid om zo de juiste velden te tonen


  var dropdownresults = document.getElementById('imagedropdown');

  var _dropdownButton;

  if (document.getElementById('openDropdownButton') != undefined || document.getElementById('openDropdownButton') != null) {
    _dropdownButton = document.getElementById('openDropdownButton');

    _dropdownButton.addEventListener('click', function () {
      document.getElementById('imagedropdown').classList.toggle('notactive');
    });
  }

  var dorpdownimages = document.querySelectorAll('.tutorial-dropdown-image');
  dorpdownimages.forEach(function (element) {
    element.addEventListener('click', function () {
      var input_temp = document.createElement("input");
      input_temp.value = element.src;
      document.body.appendChild(input_temp);
      input_temp.select();
      document.execCommand("copy");
      document.body.removeChild(input_temp);
      createNotification();
      document.getElementById('imagedropdown').classList.add('notactive');
    });
  });
  document.getElementById('imagedropdown-close-button').addEventListener('click', function () {
    dropdownresults.classList.add('notactive');
  });
  var tuttype;
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
  var thumbnailCheck = false;
  document.getElementById('thumbnailSpan').innerHTML = '<i class="fas fa-times"></i>';
  document.getElementById('thumbnailSpan').style.color = "red";
  var thumbnail = document.getElementById('video-thumbnail');
  thumbnail.addEventListener('change', function (e) {
    if (thumbnail.files.length != 0) {
      thumbnailCheck = true;
      document.getElementById('thumbnailSpan').innerHTML = '<i class="fas fa-check"></i>';
      document.getElementById('thumbnailSpan').style.color = "green";
    } else {
      thumbnailCheck = false;
      document.getElementById('thumbnailSpan').innerHTML = '<i class="fas fa-times"></i>';
      document.getElementById('thumbnailSpan').style.color = "red";
    }

    validateForm();
  });
  var description = document.getElementById('description');
  var descriptionCheck = false;
  document.getElementById('descriptionSpan').innerHTML = '<i class="fas fa-times"></i>';
  document.getElementById('descriptionSpan').style.color = "red";
  foo();
  var videobutton = document.getElementById('video-type');
  var mixedbutton = document.getElementById('mixed-type');
  var writtenbutton = document.getElementById('written-type');
  var kindCheck = false;
  var file_div = document.getElementById('tutorial-file-div');
  var written_div = document.getElementById('tutorial-written-div');
  var mainvideo = document.getElementById('main-video');
  var mainvideoCheck = false;
  var content = document.getElementById('inhoud');
  var contentCheck = false;
  var text = false;
  document.getElementById('kindSpan').innerHTML = '<i class="fas fa-times"></i>';
  document.getElementById('kindSpan').style.color = "red";

  if (videobutton) {
    videobutton.addEventListener('click', function () {
      kindCheck = true;
      file_div.style.display = "block";
      written_div.style.display = "none";
      mainvideo.value = null;
      mainvideoCheck = false;
      document.getElementById('kindSpan').innerHTML = '<i class="fas fa-check"></i>';
      document.getElementById('kindSpan').style.color = "green";
      document.getElementById('tutvideoSpan').innerHTML = '<i class="fas fa-times"></i>';
      document.getElementById('tutvideoSpan').style.color = "red";
      text = false;
      tuttype = 'video';
      validateForm();
    });
    mixedbutton.addEventListener('click', function () {
      kindCheck = true;
      file_div.style.display = "block";
      written_div.style.display = "block";
      mainvideo.value = null;
      mainvideoCheck = false;
      document.getElementById('kindSpan').innerHTML = '<i class="fas fa-check"></i>';
      document.getElementById('kindSpan').style.color = "green";
      document.getElementById('tutvideoSpan').innerHTML = '<i class="fas fa-times"></i>';
      document.getElementById('tutvideoSpan').style.color = "red";
      document.getElementById('tutcontentSpan').innerHTML = '<i class="fas fa-times"></i>';
      document.getElementById('tutcontentSpan').style.color = "red";
      text = true;
      tuttype = 'mixed';
      fooContent();
    });
    writtenbutton.addEventListener('click', function () {
      kindCheck = true;
      file_div.style.display = "none";
      written_div.style.display = "block";
      document.getElementById('kindSpan').innerHTML = '<i class="fas fa-check"></i>';
      document.getElementById('kindSpan').style.color = "green";
      document.getElementById('tutcontentSpan').innerHTML = '<i class="fas fa-times"></i>';
      document.getElementById('tutcontentSpan').style.color = "red";
      text = true;
      tuttype = 'written';
      fooContent();
    });
  }

  mainvideo.addEventListener('change', function (e) {
    if (mainvideo.files.length != 0) {
      mainvideoCheck = true;
      document.getElementById('tutvideoSpan').innerHTML = '<i class="fas fa-check"></i>';
      document.getElementById('tutvideoSpan').style.color = "green";
    } else {
      mainvideoCheck = false;
      document.getElementById('tutvideoSpan').innerHTML = '<i class="fas fa-times"></i>';
      document.getElementById('tutvideoSpan').style.color = "red";
    }

    validateForm();
  });
} ////////////////////////////////////////////////////
//                     EDIT                       //
////////////////////////////////////////////////////


if (document.getElementById('tutorial-edit-div')) {
  var _createNotification = function _createNotification() {
    var notif = document.createElement('div');
    notif.classList.add('notif');
    document.getElementsByTagName('main')[0].appendChild(notif);
    notif.innerText = 'gekopieerd naar clipboard';
    setTimeout(function () {
      notif.remove();
    }, 3000);
  };

  var _validateForm = function _validateForm() {
    if (_titleCheck && _thumbnailCheck && _descriptionCheck && _kindCheck) {
      if (_tuttype == 'video') {
        if (_mainvideoCheck) {
          _button.disabled = false;
          _button.style.backgroundColor = "";
        } else {
          _button.disabled = true;
          _button.style.backgroundColor = "grey";
        }
      }

      if (_tuttype == 'mixed') {
        if (_mainvideoCheck && _contentCheck) {
          _button.disabled = false;
          _button.style.backgroundColor = "";
        } else {
          _button.disabled = true;
          _button.style.backgroundColor = "grey";
        }
      }

      if (_tuttype == 'written') {
        if (_contentCheck) {
          _button.disabled = false;
          _button.style.backgroundColor = "";
        } else {
          _button.disabled = true;
          _button.style.backgroundColor = "grey";
        }
      }
    } else {
      _button.disabled = true;
      _button.style.backgroundColor = "grey";
    }
  };

  var _foo = function _foo() {
    var contentLength = _description.getAttribute('data-length');

    if (contentLength <= 99) {
      _descriptionCheck = false;
      document.getElementById('descriptionSpan').innerHTML = '<i class="fas fa-times"></i>';
      document.getElementById('descriptionSpan').style.color = "red";
      setTimeout(_foo, 2000);
    } else if (contentLength > 99) {
      _descriptionCheck = true;
      document.getElementById('descriptionSpan').innerHTML = '<i class="fas fa-check"></i>';
      document.getElementById('descriptionSpan').style.color = "green";
      setTimeout(_foo, 2000);
    }

    _validateForm();
  };

  var _fooContent = function _fooContent() {
    if (_text) {
      var contentLength = _content.getAttribute('data-length');

      if (contentLength <= 99) {
        _contentCheck = false;
        document.getElementById('tutcontentSpan').innerHTML = '<i class="fas fa-times"></i>';
        document.getElementById('tutcontentSpan').style.color = "red";
        setTimeout(_fooContent, 2000);
      } else if (contentLength > 99) {
        _contentCheck = true;
        document.getElementById('tutcontentSpan').innerHTML = '<i class="fas fa-check"></i>';
        document.getElementById('tutcontentSpan').style.color = "green";
        setTimeout(_fooContent, 2000);
      }

      _validateForm();
    }
  }; //Check welk soort tutorial je hebt aangeduid om zo de juiste velden te tonen


  var _dropdownresults = document.getElementById('imagedropdown');

  if (document.getElementById('openDropdownButton') != undefined || document.getElementById('openDropdownButton') != null) {
    dropdownButton = document.getElementById('openDropdownButton');
    dropdownButton.addEventListener('click', function () {
      document.getElementById('imagedropdown').classList.toggle('notactive');
    });
  }

  var _dorpdownimages = document.querySelectorAll('.tutorial-dropdown-image');

  _dorpdownimages.forEach(function (element) {
    element.addEventListener('click', function () {
      var input_temp = document.createElement("input");
      input_temp.value = element.src;
      document.body.appendChild(input_temp);
      input_temp.select();
      document.execCommand("copy");
      document.body.removeChild(input_temp);

      _createNotification();

      document.getElementById('imagedropdown').classList.add('notactive');
    });
  });

  document.getElementById('imagedropdown-close-button').addEventListener('click', function () {
    _dropdownresults.classList.add('notactive');
  });

  var _tuttype;

  if (document.getElementById('video-type').checked) {
    _tuttype = 'video';
    _mainvideoCheck = true;
  }

  if (document.getElementById('written-type').checked) {
    _tuttype = 'written';
    _text = true;
  }

  if (document.getElementById('mixed-type').checked) {
    _tuttype = 'mixed';
    _mainvideoCheck = true;
    _text = true;
  }

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

  var _thumbnailCheck = true;
  document.getElementById('thumbnailSpan').innerHTML = '<i class="fas fa-check"></i>';
  document.getElementById('thumbnailSpan').style.color = "green";

  var _thumbnail = document.getElementById('video-thumbnail');

  _thumbnail.addEventListener('change', function (e) {
    if (_thumbnail.files.length != 0) {
      _thumbnailCheck = true;
      document.getElementById('thumbnailSpan').innerHTML = '<i class="fas fa-check"></i>';
      document.getElementById('thumbnailSpan').style.color = "green";
    } else {
      _thumbnailCheck = false;
      document.getElementById('thumbnailSpan').innerHTML = '<i class="fas fa-times"></i>';
      document.getElementById('thumbnailSpan').style.color = "red";
    }

    _validateForm();
  });

  var _description = document.getElementById('description');

  var _descriptionCheck = true;
  document.getElementById('descriptionSpan').innerHTML = '<i class="fas fa-check"></i>';
  document.getElementById('descriptionSpan').style.color = "green";

  _foo();

  var _videobutton = document.getElementById('video-type');

  var _mixedbutton = document.getElementById('mixed-type');

  var _writtenbutton = document.getElementById('written-type');

  var _kindCheck = true;

  var _file_div = document.getElementById('tutorial-file-div');

  var _written_div = document.getElementById('tutorial-written-div');

  var _mainvideo = document.getElementById('main-video');

  var _mainvideoCheck = false;

  var _content = document.getElementById('inhoud');

  var _contentCheck = false;
  var _text = false;
  document.getElementById('kindSpan').innerHTML = '<i class="fas fa-check"></i>';
  document.getElementById('kindSpan').style.color = "green";

  if (_tuttype == 'mixed') {
    document.getElementById('kindSpan').innerHTML = '<i class="fas fa-check"></i>';
    document.getElementById('kindSpan').style.color = "green";
    document.getElementById('tutvideoSpan').innerHTML = '<i class="fas fa-check"></i>';
    document.getElementById('tutvideoSpan').style.color = "green";
    document.getElementById('tutcontentSpan').innerHTML = '<i class="fas fa-check"></i>';
    document.getElementById('tutcontentSpan').style.color = "green";
    _text = true;
    _mainvideoCheck = true;

    _fooContent();
  }

  if (_tuttype == 'video') {
    document.getElementById('kindSpan').innerHTML = '<i class="fas fa-check"></i>';
    document.getElementById('kindSpan').style.color = "green";
    document.getElementById('tutvideoSpan').innerHTML = '<i class="fas fa-check"></i>';
    document.getElementById('tutvideoSpan').style.color = "green";
    _mainvideoCheck = true;

    _validateForm();
  }

  if (_tuttype == 'written') {
    document.getElementById('kindSpan').innerHTML = '<i class="fas fa-check"></i>';
    document.getElementById('kindSpan').style.color = "green";
    document.getElementById('tutcontentSpan').innerHTML = '<i class="fas fa-check"></i>';
    document.getElementById('tutcontentSpan').style.color = "green";
    _text = true;

    _fooContent();
  }

  if (_videobutton) {
    _videobutton.addEventListener('click', function () {
      _kindCheck = true;
      _file_div.style.display = "block";
      _written_div.style.display = "none";
      _mainvideo.value = null;

      if (document.getElementById('tutorial-edit-video-prev')) {
        _mainvideoCheck = true;
      } else {
        _mainvideoCheck = false;
        document.getElementById('tutvideoSpan').innerHTML = '<i class="fas fa-times"></i>';
        document.getElementById('tutvideoSpan').style.color = "red";
      }

      _text = false;
      _tuttype = 'video';

      _validateForm();
    });

    _mixedbutton.addEventListener('click', function () {
      _kindCheck = true;
      _file_div.style.display = "block";
      _written_div.style.display = "block";
      _mainvideo.value = null;

      if (document.getElementById('tutorial-edit-video-prev')) {
        _mainvideoCheck = true;
      } else {
        _mainvideoCheck = false;
        document.getElementById('tutvideoSpan').innerHTML = '<i class="fas fa-times"></i>';
        document.getElementById('tutvideoSpan').style.color = "red";
      }

      _text = true;
      _tuttype = 'mixed';

      _fooContent();
    });

    _writtenbutton.addEventListener('click', function () {
      _kindCheck = true;
      _file_div.style.display = "none";
      _written_div.style.display = "block";
      _text = true;
      _tuttype = 'written';

      _fooContent();
    });
  }

  _mainvideo.addEventListener('change', function (e) {
    if (_mainvideo.files.length != 0) {
      _mainvideoCheck = true;
      document.getElementById('tutvideoSpan').innerHTML = '<i class="fas fa-check"></i>';
      document.getElementById('tutvideoSpan').style.color = "green";
    } else {
      _mainvideoCheck = false;
      document.getElementById('tutvideoSpan').innerHTML = '<i class="fas fa-times"></i>';
      document.getElementById('tutvideoSpan').style.color = "red";
    }

    _validateForm();
  });
}
/******/ })()
;