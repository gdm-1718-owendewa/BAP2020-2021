/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**********************************!*\
  !*** ./resources/js/calendar.js ***!
  \**********************************/
$(document).ready(function () {
  var baseURL = window.location.origin;
  var clickedDay = getWithExpiry('clickedday');
  var currentTaskDayCheck = getWithExpiry('currentDayTask');
  var today = new Date();
  var currentMonth = '';
  var currentYear = '';

  if (currentTaskDayCheck) {
    currentMonth = getWithExpiry('currentDayTaskMonth');
    currentYear = getWithExpiry('currentDayTaskYear');
  } else {
    currentMonth = today.getMonth();
    currentYear = today.getFullYear();
  }

  var months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"]; //dag,jaar boven kalender

  var monthAndYear = '';

  if (document.getElementById("month-and-year") != null) {
    monthAndYear = document.getElementById("month-and-year");
  } //taken container


  var tasksDiv = '';

  if (document.getElementById('tasks-div') != null) {
    tasksDiv = document.getElementById('tasks-div');
  } //dagen container


  var daydivcontainer = '';

  if (document.getElementById("day-div") != null) {
    daydivcontainer = document.getElementById("day-div");
  }

  var calenderu = '';

  if (document.querySelector('.calender') != null) {
    calenderu = document.querySelector('.calender').getAttribute('data-u');
  } //dag,maand,jaar boven taken


  var MonthAndYear = '';
  MonthAndYear = document.getElementById("month-and-year-left");
  MonthAndYear.innerHTML = today.getDate() + ' ' + months[currentMonth] + ' ' + currentYear;
  document.getElementById('add-task-open-modal-button').setAttribute('data-date', today.getDate() + '-' + (currentMonth + 1) + '-' + currentYear);
  document.getElementById('add-div').style.display = "flex";
  tasksDiv.style.display = "flex"; //Voordat je de huidige dag ophaalt check of er een value aanwezig is in de localstorage van een dag war juist een taak op is toegevoegd

  if (currentTaskDayCheck) {
    var day = getWithExpiry('currentDayTaskDay');
    var month = getWithExpiry('currentDayTaskMonth');
    var year = getWithExpiry('currentDayTaskYear');
    MonthAndYear.innerHTML = day + ' ' + months[month - 1] + ' ' + year;
    document.getElementById('add-task-open-modal-button').setAttribute('data-date', day + '-' + month + '-' + year);
    showCurrentDayTasks(calenderu, day + '-' + month + '-' + year);
  } else {
    showCurrentDayTasks(calenderu, today.getDate() + '-' + (currentMonth + 1) + '-' + currentYear);
    localStorage.removeItem('currentDayTaskDay');
    localStorage.removeItem('currentDayTaskMonth');
    localStorage.removeItem('currentDayTaskYear');
  } //Toon de taken voor de geselecteerde dag


  function showCurrentDayTasks(calenderu, date) {
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type: "POST",
      url: baseURL + '/calender/daytasks',
      data: {
        user_id: calenderu,
        date: date
      },
      success: function success(response) {
        // What to do if we succeed
        tasksDiv.innerHTML = '';

        for (var _i = 0; _i < response.length; _i++) {
          tasksDiv.innerHTML += "<div class=\"task-div\"><div class=\"task-title-div\"><p>".concat(response[_i]["hour"], ":").concat(response[_i]["minute"], " - ").concat(response[_i]["description"], "</p></div><div class=\"task-button-div\"><a href=\"#\" class=\"edit-task\" data-i=\"").concat(response[_i]["id"], "\" data-u=\"").concat(response[_i]["user_id"], "\" data-d=\"").concat(response[_i]["description"], "\" data-h=\"").concat(response[_i]["hour"], "\" data-m=\"").concat(response[_i]["minute"], "\"><i class=\"far fa-edit\"></i></a><a href=\"#\" data-i=\"").concat(response[_i]["id"], "\" data-u=\"").concat(response[_i]["user_id"], "\" class=\"delete-task\"><i class=\"far fa-trash-alt\"></i></a></div></div>");
        }

        var editTaskButtons = document.querySelectorAll(".edit-task");

        if (editTaskButtons) {
          var _loop = function _loop(_i2) {
            editTaskButtons[_i2].addEventListener('click', function (e) {
              e.preventDefault();
              console.log(editTaskButtons[_i2]);
              document.getElementById('calendar-task-edit-div').style.display = "flex";
              scrollTo(0, 0);
              document.body.style.overflow = "hidden";
              document.body.style.height = "100vh";
              var baseURL = window.location.origin;
              var editTaskForm = document.getElementById('edit-task-form');
              editTaskForm.action = baseURL + '/calender/' + editTaskButtons[_i2].getAttribute('data-u') + '/edittask/' + editTaskButtons[_i2].getAttribute('data-i') + '/submit';
              document.getElementById('calendar-edit-task-title').value = editTaskButtons[_i2].getAttribute('data-d');
              var hour = document.getElementById('task-edit-hour');
              hour.value = editTaskButtons[_i2].getAttribute('data-h');
              var minute = document.getElementById('task-edit-minute');
              minute.value = editTaskButtons[_i2].getAttribute('data-m');
            });
          };

          for (var _i2 = 0; _i2 < editTaskButtons.length; _i2++) {
            _loop(_i2);
          }
        }

        var taskDeleteButtons = document.querySelectorAll('.delete-task');
        deleteModalShow(taskDeleteButtons);
      },
      error: function error(response) {
        console.log('Error' + response);
      }
    });
  } //check of er een datum in de localhost staat en toon uw kalender 


  if (currentTaskDayCheck) {
    var _month = getWithExpiry('currentDayTaskMonth');

    var _year = getWithExpiry('currentDayTaskYear');

    showCalendar(_month - 1, _year);
  } else {
    showCalendar(currentMonth, currentYear);
  }

  function showCalendar(month, year) {
    //Haal eerste dag nummer en laatste op van de maand
    daydivcontainer.innerHTML = '';
    var firstday = new Date(year, month, 1);
    var LastDay = new Date(year, month + 1, 0); //Haal het totaal aantal dagen op

    var daysInMonth = new Date(year, month + 1, 0).getDate();
    monthAndYear.innerHTML = months[month] + ' ' + currentYear; //Voor iedere dag in de maand maak een div aan

    for (i = 0; i < daysInMonth; i++) {
      var actualDay = i + 1;
      var actualMonth = month + 1;
      var daydiva = document.createElement("a");
      daydiva.href = '#';
      daydiva.setAttribute("class", 'calendar-date-button');
      daydiva.setAttribute("data-date", actualDay + '-' + actualMonth + '-' + currentYear);
      daydiva.setAttribute("data-day", actualDay);
      daydiva.setAttribute("data-month", months[month]);
      daydiva.setAttribute("data-year", currentYear);
      var daydiv = document.createElement("div");
      daydiva.appendChild(daydiv);
      daydiva.dataset.dayofmonth = actualDay;
      daydiva.dataset.u = calenderu;
      daydiv.classList.add('day-of-month');
      daydiv.setAttribute('day-date', actualDay + '-' + actualMonth + '-' + currentYear);
      daydiv.innerHTML = actualDay;

      if (daydivcontainer) {
        daydivcontainer.appendChild(daydiva);
      }
    } //Zet op iedere dag een click effect die de taken van die dag ophaalt


    var calendarDayButtons = document.querySelectorAll('.calendar-date-button');

    var _loop2 = function _loop2(_i3) {
      calendarDayButtons[_i3].addEventListener('click', function (e) {
        e.preventDefault();
        localStorage.clear();

        var clickedDay = calendarDayButtons[_i3].getAttribute('data-day');

        var clickedMonth = calendarDayButtons[_i3].getAttribute('data-month');

        var clickedYear = calendarDayButtons[_i3].getAttribute('data-year');

        setWithExpiry('clickedday', calendarDayButtons[_i3].getAttribute('data-date'), 300000);
        MonthAndYear.innerHTML = clickedDay + ' ' + clickedMonth + ' ' + clickedYear;
        /* AJAX CALL VOOR DE TAKEN VAN DE AANGEKLIKTE DAG*/

        $.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          type: "POST",
          url: baseURL + '/calender/daytasks',
          data: {
            user_id: calenderu,
            date: calendarDayButtons[_i3].getAttribute('data-date')
          },
          success: function success(response) {
            // What to do if we succeed
            tasksDiv.innerHTML = '';

            for (var _i4 = 0; _i4 < response.length; _i4++) {
              tasksDiv.innerHTML += "<div class=\"task-div\"><div class=\"task-title-div\"><p>".concat(response[_i4]["hour"], ":").concat(response[_i4]["minute"], " - ").concat(response[_i4]["description"], "</p></div><div class=\"task-button-div\"><a href=\"#\" class=\"edit-task\" data-i=\"").concat(response[_i4]["id"], "\" data-u=\"").concat(response[_i4]["user_id"], "\" data-d=\"").concat(response[_i4]["description"], "\" data-h=\"").concat(response[_i4]["hour"], "\" data-m=\"").concat(response[_i4]["minute"], "\"><i class=\"far fa-edit\"></i></a><a href=\"#\" data-i=\"").concat(response[_i4]["id"], "\" data-u=\"").concat(response[_i4]["user_id"], "\" class=\"delete-task\"><i class=\"far fa-trash-alt\"></i></a></div></div>");
            }

            var editTaskButtons = document.querySelectorAll(".edit-task");
            console.log(editTaskButtons);

            if (editTaskButtons) {
              var _loop3 = function _loop3(j) {
                editTaskButtons[j].setAttribute('data-date', calendarDayButtons[_i3].getAttribute('data-date'));
                setWithExpiry('currentDayTask', true, 300000);
                var dayDate = editTaskButtons[j].getAttribute('data-date').split('-');
                setWithExpiry('currentDayTaskDay', dayDate[0], 300000);
                setWithExpiry('currentDayTaskMonth', dayDate[1], 300000);
                setWithExpiry('currentDayTaskYear', dayDate[2], 300000);
                editTaskButtons[j].addEventListener('click', function (e) {
                  e.preventDefault();
                  document.getElementById('calendar-task-edit-div').style.display = "flex";
                  scrollTo(0, 0);
                  document.body.style.overflow = "hidden";
                  document.body.style.height = "100vh";
                  var baseURL = window.location.origin;
                  var editTaskForm = document.getElementById('edit-task-form');
                  editTaskForm.action = baseURL + '/calender/' + editTaskButtons[j].getAttribute('data-u') + '/edittask/' + editTaskButtons[j].getAttribute('data-i') + '/submit';
                  document.getElementById('calendar-edit-task-title').value = editTaskButtons[j].getAttribute('data-d');
                  var hour = document.getElementById('task-edit-hour');
                  hour.value = editTaskButtons[j].getAttribute('data-h');
                  var minute = document.getElementById('task-edit-minute');
                  minute.value = editTaskButtons[j].getAttribute('data-m');
                });
              };

              for (var j = 0; j < editTaskButtons.length; j++) {
                _loop3(j);
              }
            }

            var taskDeleteButtons = document.querySelectorAll('.delete-task');
            deleteModalShow(taskDeleteButtons);
          },
          error: function error(response) {
            console.log('Error' + response);
          }
        });
        /* Toon taken en zet add task div zichtbaar*/

        document.getElementById('add-task-open-modal-button').setAttribute('data-date', calendarDayButtons[_i3].getAttribute('data-date'));
        document.getElementById('add-div').style.display = "flex";
        tasksDiv.style.display = "flex";
      });
    };

    for (var _i3 = 0; _i3 < calendarDayButtons.length; _i3++) {
      _loop2(_i3);
    }

    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type: "POST",
      url: baseURL + '/calender/alltasks',
      data: {
        user_id: calenderu
      },
      success: function success(response) {
        // What to do if we succeed
        var taskDates = [];
        response.forEach(function (element) {
          if (!taskDates.includes(element['date'])) {
            taskDates.push(element['date']);
          }
        });
        taskDates.forEach(function (element) {
          var item = document.querySelector("[day-date='" + element + "']");
          var dayWithTaskDiv = document.createElement("div");
          dayWithTaskDiv.classList.add('task-indicator');

          if (item != null) {
            item.appendChild(dayWithTaskDiv);
          }
        });
      },
      error: function error(response) {
        console.log('Error' + response);
      }
    });
  } //Toon voeg taak toe modal


  var addTaskOpenModalButton = document.getElementById('add-task-open-modal-button');

  if (addTaskOpenModalButton) {
    addTaskOpenModalButton.addEventListener('click', function (e) {
      e.preventDefault();
      setWithExpiry('currentDayTask', true, 300000);
      var dayDate = addTaskOpenModalButton.getAttribute('data-date').split('-');
      setWithExpiry('currentDayTaskDay', dayDate[0], 300000);
      setWithExpiry('currentDayTaskMonth', dayDate[1], 300000);
      setWithExpiry('currentDayTaskYear', dayDate[2], 300000);
      scrollTo(0, 0);
      var baseURL = window.location.origin;
      var addTaskForm = document.getElementById('add-task-form');
      document.getElementById('calendar-task-add-div').style.display = "flex";
      addTaskForm.action = baseURL + '/calender/' + calenderu + '/' + addTaskOpenModalButton.getAttribute('data-date');
      document.body.style.overflow = "hidden";
      document.body.style.height = "100vh";
    });
  } //Zet effect op button die de voeg taak toe modal sluit


  var closeTaskModalButton = document.getElementById('close_calendar_modal_button');

  if (closeTaskModalButton) {
    closeTaskModalButton.addEventListener('click', function (e) {
      localStorage.removeItem('currentDayTask');
      var addTaskForm = document.getElementById('add-task-form');
      document.getElementById('calendar-task-add-div').style.display = "none";
      addTaskForm.action = '';
      document.body.style.overflow = "";
      document.body.style.height = "";
    });
  } //Zet effect op button die de edit taak  modal sluit


  var closeTaskModalEditButton = document.getElementById('close_calendar_modal_edit_button');

  if (closeTaskModalEditButton) {
    closeTaskModalEditButton.addEventListener('click', function (e) {
      localStorage.removeItem('currentDayTask');
      var editTaskForm = document.getElementById('edit-task-form');
      document.getElementById('calendar-task-edit-div').style.display = "none";
      editTaskForm.action = '';
      document.body.style.overflow = "";
      document.body.style.height = "";
    });
  } //Ga naar vorige maand


  function previousMonth() {
    localStorage.clear();
    currentYear = currentMonth === 0 ? currentYear - 1 : currentYear;
    currentMonth = currentMonth === 0 ? 11 : currentMonth - 1;
    showCalendar(currentMonth, currentYear);
  }

  var prevButton = document.getElementById("previous-button");

  if (prevButton) {
    prevButton.addEventListener('click', previousMonth);
  } //Ga naar volgende maand


  function nextMonth() {
    localStorage.clear();
    currentYear = currentMonth === 11 ? currentYear + 1 : currentYear;
    currentMonth = (currentMonth + 1) % 12;
    showCalendar(currentMonth, currentYear);
  }

  var nextButton = document.getElementById("next-button");

  if (nextButton) {
    nextButton.addEventListener('click', nextMonth);
  } //Verwijder taak


  function deleteModalShow(taskDeleteButtons) {
    var _loop4 = function _loop4(index) {
      taskDeleteButtons[index].addEventListener('click', function (e) {
        setWithExpiry('currentDayTask', true, 600000);
        var dayDate = addTaskOpenModalButton.getAttribute('data-date').split('-');
        setWithExpiry('currentDayTaskDay', dayDate[0], 600000);
        setWithExpiry('currentDayTaskMonth', dayDate[1], 600000);
        setWithExpiry('currentDayTaskYear', dayDate[2], 600000);
        e.preventDefault();
        var blackoutDiv = document.createElement('div');
        blackoutDiv.classList.add('calendar-full-blackout');
        document.getElementById('calendar-delete-modal-div').appendChild(blackoutDiv);
        document.body.style.overflow = "hidden";
        document.body.style.height = "100vh";
        blackoutDiv.style.display = 'flex';
        var deleteTaskModal = document.createElement('div');
        deleteTaskModal.classList.add('delete-task-modal');
        document.getElementById('calendar-delete-modal-div').appendChild(deleteTaskModal);
        deleteTaskModal.innerHTML = "\n            <a id=\"task-delete-modal-close-button\" href=\"#\">&#10005;</a> \n            <div id=\"task-delete-modal-content-div\">\n            <div id=\"task-delete-modal-message-div\">\n                <p id=\"task-delete-modal-message\"></p>\n            </div>\n            <div id=\"task-delete-modal-buttons-div\">\n                <a href=\"".concat(baseURL, "/calender/").concat(taskDeleteButtons[index].getAttribute('data-u'), "/deletetask/").concat(taskDeleteButtons[index].getAttribute('data-i'), "\" id=\"task-delete-accept\">Ja</a>\n                <a href=\"#\" id=\"task-delete-decline\">Nee</a>\n                </div>  \n            </div>");
        document.getElementById('task-delete-modal-message').innerHTML = "Bent u zeker dat u deze taak wilt verwijderen?";
        document.getElementById('task-delete-decline').addEventListener('click', function (e) {
          e.preventDefault();
          document.getElementById('calendar-delete-modal-div').removeChild(deleteTaskModal);
          document.getElementById('calendar-delete-modal-div').removeChild(blackoutDiv);
          document.body.style.overflow = "";
          document.body.style.height = "";
        });
        document.getElementById('task-delete-modal-close-button').addEventListener('click', function (e) {
          e.preventDefault();
          document.getElementById('calendar-delete-modal-div').removeChild(deleteTaskModal);
          document.getElementById('calendar-delete-modal-div').removeChild(blackoutDiv);
          document.body.style.overflow = "";
          document.body.style.height = "";
        });
      });
    };

    for (var index = 0; index < taskDeleteButtons.length; index++) {
      _loop4(index);
    }
  }
});

function setWithExpiry(key, value, ttl) {
  var now = new Date();
  var item = {
    value: value,
    expiry: now.getTime() + ttl
  };
  localStorage.setItem(key, JSON.stringify(item));
}

function getWithExpiry(key) {
  var itemStr = localStorage.getItem(key); // if the item doesn't exist, return null

  if (!itemStr) {
    return null;
  }

  var item = JSON.parse(itemStr);
  var now = new Date(); // compare the expiry time of the item with the current time

  if (now.getTime() > item.expiry) {
    // If the item is expired, delete the item from storage
    // and return null
    localStorage.removeItem(key);
    return null;
  }

  return item.value;
}
/******/ })()
;