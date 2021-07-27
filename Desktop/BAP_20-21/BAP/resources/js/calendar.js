$(document).ready(function(){
    let baseURL = window.location.origin;
    let clickedDay = getWithExpiry('clickedday');
    let currentTaskDayCheck = getWithExpiry('currentDayTask');
    let today = new Date();
    let currentMonth = '';
    let currentYear = '';
   
    if(currentTaskDayCheck){
        currentMonth = getWithExpiry('currentDayTaskMonth')
        currentYear = getWithExpiry('currentDayTaskYear')
    }else{
        currentMonth = today.getMonth();
        currentYear = today.getFullYear();
    }
    let months = [
        "Jan",
        "Feb",
        "Mar",
        "Apr",
        "May",
        "Jun",
        "Jul",
        "Aug",
        "Sep",
        "Oct",
        "Nov",
        "Dec",
    ]
//dag,jaar boven kalender
let monthAndYear = ''
if(document.getElementById("month-and-year") !=null){
    monthAndYear = document.getElementById("month-and-year");
}
//taken container
let tasksDiv = '';
if(document.getElementById('tasks-div') !=null){
    tasksDiv = document.getElementById('tasks-div');
}
let eventsDiv = '';

  if (document.getElementById('events-div') != null) {
    eventsDiv = document.getElementById('events-div');
  } //dagen container

//dagen container
let daydivcontainer = ''
if(document.getElementById("day-div") !=null){
    daydivcontainer = document.getElementById("day-div");
}
let calenderu = ''
if(document.querySelector('.calender') !=null){
    calenderu = document.querySelector('.calender').getAttribute('data-u');
}

//dag,maand,jaar boven taken
let MonthAndYear = ''
MonthAndYear = document.getElementById("month-and-year-left");
let showtoday = '';
if(today.getDate() < 10 ){
    showtoday = '0' + today.getDate();
}else{
    showtoday = today.getDate();
}
let showtodaymonth = '';
if((currentMonth+1) < 10){
    showtodaymonth = '0' + (currentMonth+1)
}else{
    showtodaymonth = (currentMonth+1)
}
MonthAndYear.innerHTML =  showtoday +' '+months[currentMonth]+' '+currentYear;
document.getElementById('add-task-open-modal-button').setAttribute('data-date', showtoday +'-'+showtodaymonth+'-'+currentYear)
document.getElementById('add-div').style.display ="flex";
tasksDiv.style.display ="flex";

//Voordat je de huidige dag ophaalt check of er een value aanwezig is in de localstorage van een dag waar juist een taak op is toegevoegd
if(currentTaskDayCheck){
   let day = getWithExpiry('currentDayTaskDay')
   let month = getWithExpiry('currentDayTaskMonth')
   let year = getWithExpiry('currentDayTaskYear')
   MonthAndYear.innerHTML = day+' '+months[month-1]+' '+year;
   document.getElementById('add-task-open-modal-button').setAttribute('data-date',day+'-'+month+'-'+year)
   showCurrentDayTasks(calenderu, day +'-'+month+'-'+year)

}else{
    showCurrentDayTasks(calenderu, showtoday +'-'+showtodaymonth+'-'+currentYear)
    localStorage.removeItem('currentDayTaskDay');
    localStorage.removeItem('currentDayTaskMonth');
    localStorage.removeItem('currentDayTaskYear');
    setWithExpiry('currentDayTaskDay', showtoday, 600000);
    setWithExpiry('currentDayTaskMonth', showtodaymonth, 600000);
    setWithExpiry('currentDayTaskYear', currentYear, 600000);
}
//Toon de taken voor de geselecteerde dag
function showCurrentDayTasks(calenderu, date){
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: baseURL + '/calender/daytasks', 
        data: { 
            user_id: calenderu,
            date: date,
        }, 
            success: function(response){ // What to do if we succeed
             tasksDiv.innerHTML = '';
             if(response.length > 0){
                tasksDiv.innerHTML = '<h4>Taken</h4>';
             }
            for(let i = 0; i < response.length; i ++){
                tasksDiv.innerHTML += `<div class="task-div"><div class="task-title-div"><p>${response[i]["hour"]}:${response[i]["minute"]} - ${response[i]["description"]}</p></div><div class="task-button-div"><a href="#" class="edit-task" data-i="${response[i]["id"]}" data-u="${response[i]["user_id"]}" data-d="${response[i]["description"]}" data-h="${response[i]["hour"]}" data-m="${response[i]["minute"]}"><i class="far fa-edit"></i></a><a href="#" data-i="${response[i]["id"]}" data-u="${response[i]["user_id"]}" class="delete-task"><i class="far fa-trash-alt"></i></a></div></div>`
            }
            let editTaskButtons = document.querySelectorAll(".edit-task");
            if(editTaskButtons){
            for(let i = 0; i < editTaskButtons.length; i++){
                editTaskButtons[i].addEventListener('click', (e)=>{
                    e.preventDefault();
                    document.getElementById('calendar-task-edit-div').style.display = "flex";
                    scrollTo(0,0);
                    document.body.style.overflow = "hidden";
                    document.body.style.height = "100vh";
                    let baseURL = window.location.origin;
                    let editTaskForm = document.getElementById('edit-task-form');
                    editTaskForm.action = baseURL +'/calender/' + editTaskButtons[i].getAttribute('data-u') + '/edittask/' + editTaskButtons[i].getAttribute('data-i') +'/submit';
                    document.getElementById('calendar-edit-task-title').value = editTaskButtons[i].getAttribute('data-d');
                    let hour = document.getElementById('task-edit-hour');
                    hour.value = editTaskButtons[i].getAttribute('data-h');
                    let minute = document.getElementById('task-edit-minute');
                    minute.value = editTaskButtons[i].getAttribute('data-m');
                    let button = document.querySelector('#edit-task-submit-button')
                    
                    function validateForm(){
                        if(titleCheck){
                            button.disabled = false
                            button.style.backgroundColor= ""
                        }else{
                            button.disabled = true
                            button.style.backgroundColor= "grey"
                        }
                    }
                    let title = document.getElementById('calendar-edit-task-title');
                    document.getElementById('titleSpan').innerHTML = '<i class="fas fa-check"></i>'
                    document.getElementById('titleSpan').style.color = "green"
                    title.addEventListener('input', (e) => {
                        if(title.value.length > 0 && title.value.length < 200){
                            titleCheck = true;
                            document.getElementById('titleSpan').innerHTML = '<i class="fas fa-check"></i>'
                            document.getElementById('titleSpan').style.color = "green"
                
                        }else{
                            titleCheck = false;
                            document.getElementById('titleSpan').innerHTML = '<i class="fas fa-times"></i>'
                            document.getElementById('titleSpan').style.color = "red"
                        }
                        validateForm();
                    })
                })
            }
            }
            let taskDeleteButtons = document.querySelectorAll('.delete-task');
            deleteModalShow(taskDeleteButtons);
        },
        error: function(response){
        console.log('Error'+response);
    }
    })
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: baseURL + '/calender/dayevents', 
        data: { 
            user_id: calenderu,
            date: date,
        }, 
            success: function(response){ // What to do if we succeed
                eventsDiv   .innerHTML = '';
                if(response.length > 0){
                    eventsDiv.innerHTML = '<h4>Evenementen</h4>';
                 }
                for(let i = 0; i < response.length; i ++){
                    eventsDiv.innerHTML += `<div><p>${response[i].start_time} - ${response[i].title}</p></div>`
                }
            },
        error: function(response){
        console.log('Error'+response);
    }
    })
}


//check of er een datum in de localhost staat en toon uw kalender 
if(currentTaskDayCheck){
    let month = getWithExpiry('currentDayTaskMonth')
    let year = getWithExpiry('currentDayTaskYear')
    showCalendar(month-1, year);
}else{
    showCalendar(currentMonth, currentYear);


}
function showCalendar(month, year){
    //Haal eerste dag nummer en laatste op van de maand
    daydivcontainer.innerHTML = '';
    let firstday = new Date(year, month, 1);
    let LastDay = new Date(year, month + 1, 0);
    //Haal het totaal aantal dagen op
    let daysInMonth =  new Date(year, month+1, 0).getDate();
    monthAndYear.innerHTML = months[month] +' ' + currentYear;
    //Voor iedere dag in de maand maak een div aan
    for(i=0; i < daysInMonth; i++){
        let actualDay = '';
        if(i+1 < 10){
            actualDay = '0' + (i+1)
        }else{
            actualDay = (i+1)
        }
        let actualMonth = '';
        if(month+1 < 10){
            actualMonth = '0' + (month+1)
        }else{
            actualMonth = (month+1)
        }
        let daydiva = document.createElement("a");
        daydiva.href='#';
        daydiva.setAttribute("class", 'calendar-date-button');
        daydiva.setAttribute("data-date", actualDay+'-'+actualMonth+'-'+currentYear);
        daydiva.setAttribute("data-day", actualDay);
        daydiva.setAttribute("data-month", months[month]);
        daydiva.setAttribute("data-year", currentYear);

        let daydiv = document.createElement("div");
        daydiva.appendChild(daydiv);
        daydiva.dataset.dayofmonth = actualDay;
        daydiva.dataset.u = calenderu;
        daydiv.classList.add('day-of-month')
        daydiv.setAttribute('day-date',actualDay+'-'+actualMonth+'-'+currentYear)

        daydiv.innerHTML = actualDay;
        if(daydivcontainer){
        daydivcontainer.appendChild(daydiva);
        }
    }
    //Zet op iedere dag een click effect die de taken van die dag ophaalt
    let calendarDayButtons = document.querySelectorAll('.calendar-date-button');
    for( let i = 0; i < calendarDayButtons.length; i++){
        calendarDayButtons[i].addEventListener('click', (e)=>{
            e.preventDefault();
            localStorage.clear();
            let clickedDay =calendarDayButtons[i].getAttribute('data-day');
            let clickedMonth=calendarDayButtons[i].getAttribute('data-month');
            let clickedYear=calendarDayButtons[i].getAttribute('data-year');
            setWithExpiry('clickedday', calendarDayButtons[i].getAttribute('data-date') ,300000);

            MonthAndYear.innerHTML = clickedDay +' '+clickedMonth+' '+clickedYear;

            /* AJAX CALL VOOR DE TAKEN VAN DE AANGEKLIKTE DAG*/
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    url: baseURL + '/calender/daytasks', 
                    data: { 
                        user_id: calenderu,
                        date: calendarDayButtons[i].getAttribute('data-date'),
                    }, 
                        success: function(response){ // What to do if we succeed
                         tasksDiv.innerHTML = '';
                         if(response.length > 0){
                            tasksDiv.innerHTML = '<h4>Taken</h4>';
                         }
                        for(let i = 0; i < response.length; i ++){
                            tasksDiv.innerHTML += `<div class="task-div"><div class="task-title-div"><p>${response[i]["hour"]}:${response[i]["minute"]} - ${response[i]["description"]}</p></div><div class="task-button-div"><a href="#" class="edit-task" data-i="${response[i]["id"]}" data-u="${response[i]["user_id"]}" data-d="${response[i]["description"]}" data-h="${response[i]["hour"]}" data-m="${response[i]["minute"]}"><i class="far fa-edit"></i></a><a href="#" data-i="${response[i]["id"]}" data-u="${response[i]["user_id"]}" class="delete-task"><i class="far fa-trash-alt"></i></a></div></div>`
                        }
                        let editTaskButtons = document.querySelectorAll(".edit-task");
                        if(editTaskButtons){
                             /* EDIT TASKS FORM VALIDATION */
                                    let button = document.querySelector('#edit-task-submit-button')
                                    function validateForm(){
                                        if(titleCheck){
                                            button.disabled = false
                                            button.style.backgroundColor= ""
                                        }else{
                                            button.disabled = true
                                            button.style.backgroundColor= "grey"
                                        }
                                    }
                                    let title = document.getElementById('calendar-edit-task-title');
                                    document.getElementById('titleSpan').innerHTML = '<i class="fas fa-check"></i>'
                                    document.getElementById('titleSpan').style.color = "green"
                                    title.addEventListener('input', (e) => {
                                        if(title.value.length > 0 && title.value.length < 200){
                                            titleCheck = true;
                                            document.getElementById('titleSpan').innerHTML = '<i class="fas fa-check"></i>'
                                            document.getElementById('titleSpan').style.color = "green"
                                
                                        }else{
                                            titleCheck = false;
                                            document.getElementById('titleSpan').innerHTML = '<i class="fas fa-times"></i>'
                                            document.getElementById('titleSpan').style.color = "red"
                                        }
                                        validateForm();
                                    })
                            for(let j = 0; j < editTaskButtons.length; j++){
                                editTaskButtons[j].setAttribute('data-date', calendarDayButtons[i].getAttribute('data-date'));
                                setWithExpiry('currentDayTask', true, 300000);
                                let dayDate = editTaskButtons[j].getAttribute('data-date').split('-');
                                setWithExpiry('currentDayTaskDay', dayDate[0], 300000);
                                setWithExpiry('currentDayTaskMonth', dayDate[1], 300000);
                                setWithExpiry('currentDayTaskYear', dayDate[2], 300000);
                                editTaskButtons[j].addEventListener('click', (e)=>{
                                    e.preventDefault();
                                    document.getElementById('calendar-task-edit-div').style.display = "flex";
                                   
                                    scrollTo(0,0);

                                    document.body.style.overflow = "hidden";
                                    document.body.style.height = "100vh";
                                    let baseURL = window.location.origin;
                                    let editTaskForm = document.getElementById('edit-task-form');
                                    editTaskForm.action = baseURL +'/calender/' + editTaskButtons[j].getAttribute('data-u') + '/edittask/' + editTaskButtons[j].getAttribute('data-i') +'/submit';
                                    document.getElementById('calendar-edit-task-title').value = editTaskButtons[j].getAttribute('data-d');
                                    let hour = document.getElementById('task-edit-hour');
                                    hour.value = editTaskButtons[j].getAttribute('data-h');
                                    let minute = document.getElementById('task-edit-minute');
                                    minute.value = editTaskButtons[j].getAttribute('data-m');   
                                      
                                   
                                })
                            }
                        }
                        let taskDeleteButtons = document.querySelectorAll('.delete-task');
                        deleteModalShow(taskDeleteButtons);
                    },
                    error: function(response){
                    console.log('Error'+response);
                }
                })
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    url: baseURL + '/calender/dayevents', 
                    data: { 
                        user_id: calenderu,
                        date: calendarDayButtons[i].getAttribute('data-date'),
                    }, 
                        success: function(response){ // What to do if we succeed
                            eventsDiv.innerHTML = '';

                            if(response.length > 0){
                                eventsDiv.innerHTML = '<h4>Evenementen</h4>';
                             }
                            for(let i = 0; i < response.length; i ++){
                                eventsDiv.innerHTML += `<div><p>${response[i].start_time} - ${response[i].title}</p></div>`
                            }
                        },
                    error: function(response){
                    console.log('Error'+response);
                }
                })
            /* Toon taken en zet add task div zichtbaar*/
            document.getElementById('add-task-open-modal-button').setAttribute('data-date', calendarDayButtons[i].getAttribute('data-date'))
            document.getElementById('add-div').style.display ="flex";
            tasksDiv.style.display ="flex";
            
        })
    }
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: baseURL + '/calender/alltasks', 
        data: { 
            user_id: calenderu,
        }, 
            success: function(response){ // What to do if we succeed
                let taskDates = [];
                response.forEach(element => {
                    if(!taskDates.includes(element['date'])){
                        taskDates.push(element['date'])
                    }
                });
               taskDates.forEach(element => {
                    let item = document.querySelector("[day-date='"+element+"']");
                    let dayWithTaskDiv = document.createElement("div");
                    dayWithTaskDiv.classList.add('task-indicator')
                    if(item!=null){
                       item.appendChild(dayWithTaskDiv)
                    }
                }); 
        },
        error: function(response){
            console.log('Error'+response);
        }
    })
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: baseURL + '/calender/allevents', 
        data: { 
            user_id: calenderu,
        }, 
            success: function(response){ // What to do if we succeed
                let eventDates = [];
                response.forEach(element => {
                    if(!eventDates.includes(element['start_date'])){
                        eventDates.push(element['start_date'])
                    }
                });

               eventDates.forEach(element => {
                    let item = document.querySelector("[day-date='"+element+"']");
                    let dayWithTaskDiv = document.createElement("div");
                    dayWithTaskDiv.classList.add('event-indicator')
                    if(item!=null){
                       item.appendChild(dayWithTaskDiv)
                    }
                });
        },
        error: function(response){
            console.log('Error'+response);
        }
    })

}
//Toon voeg taak toe modal
let addTaskOpenModalButton = document.getElementById('add-task-open-modal-button');
if(addTaskOpenModalButton){
    addTaskOpenModalButton.addEventListener('click',(e)=>{
        e.preventDefault();
        setWithExpiry('currentDayTask', true, 300000);
        let dayDate = addTaskOpenModalButton.getAttribute('data-date').split('-');
        setWithExpiry('currentDayTaskDay', dayDate[0], 300000);
        setWithExpiry('currentDayTaskMonth', dayDate[1], 300000);
        setWithExpiry('currentDayTaskYear', dayDate[2], 300000);
        scrollTo(0,0);
        let baseURL = window.location.origin;
        let addTaskForm = document.getElementById('add-task-form');
        document.getElementById('calendar-task-add-div').style.display = "flex";
        addTaskForm.action = baseURL +'/calender/' + calenderu + '/' + addTaskOpenModalButton.getAttribute('data-date')
        document.body.style.overflow = "hidden";
        document.body.style.height = "100vh";
        /* ADD TASKS FORM VALIDATION */
        let button = document.querySelector('#add-task-submit-button')
        button.disabled = true
        button.style.backgroundColor= "grey"
        function validateForm(){
            if(titleCheck){
                button.disabled = false
                button.style.backgroundColor= ""
            }else{
                button.disabled = true
                button.style.backgroundColor= "grey"
            }
        }
        let title = document.getElementById('calendar-task-title');
        document.getElementById('titleSpanCreate').innerHTML = '<i class="fas fa-times"></i>'
        document.getElementById('titleSpanCreate').style.color = "red"
        title.addEventListener('input', (e) => {
            if(title.value.length > 0 && title.value.length < 200){
                titleCheck = true;
                document.getElementById('titleSpanCreate').innerHTML = '<i class="fas fa-check"></i>'
                document.getElementById('titleSpanCreate').style.color = "green"
    
            }else{
                titleCheck = false;
                document.getElementById('titleSpanCreate').innerHTML = '<i class="fas fa-times"></i>'
                document.getElementById('titleSpanCreate').style.color = "red"
            }
            validateForm();
        })
    })
}
//Zet effect op button die de voeg taak toe modal sluit
let closeTaskModalButton = document.getElementById('close_calendar_modal_button');
if(closeTaskModalButton){
    closeTaskModalButton.addEventListener('click', (e) => {
        localStorage.removeItem('currentDayTask');
        let addTaskForm = document.getElementById('add-task-form');
        document.getElementById('calendar-task-add-div').style.display = "none";
        addTaskForm.action = '';
        document.body.style.overflow = "";
        document.body.style.height = "";
    })
}
//Zet effect op button die de edit taak  modal sluit
let closeTaskModalEditButton = document.getElementById('close_calendar_modal_edit_button');
if(closeTaskModalEditButton){
    closeTaskModalEditButton.addEventListener('click', (e) => {
        localStorage.removeItem('currentDayTask');
        let editTaskForm = document.getElementById('edit-task-form');
        document.getElementById('calendar-task-edit-div').style.display = "none";
        editTaskForm.action = '';
        document.body.style.overflow = "";
        document.body.style.height = "";
    })
}
//Ga naar vorige maand
function previousMonth(){
    currentYear = (currentMonth === 0 )? currentYear - 1: currentYear;
    currentMonth = (currentMonth === 0 )? 11: currentMonth -1
    showCalendar(currentMonth, currentYear);
}
let prevButton = document.getElementById("previous-button")
if(prevButton){
    prevButton.addEventListener('click', previousMonth);
}
//Ga naar volgende maand
function nextMonth(){
    if(currentMonth == 11){
        currentYear = Number(currentYear) + 1
        currentMonth = 0
    }else{
        currentMonth = Number(currentMonth) + 1
    }
    // currentYear = (currentMonth === 11 ) ? currentYear + 1: currentYear;
    // currentMonth =  (currentMonth + 1 ) % 12;
    showCalendar(currentMonth, currentYear);
}
let nextButton = document.getElementById("next-button")
if(nextButton){
    nextButton.addEventListener('click', nextMonth);
}

//Verwijder taak
function deleteModalShow(taskDeleteButtons){
    for (let index = 0; index < taskDeleteButtons.length; index++) {
        taskDeleteButtons[index].addEventListener('click', (e) => {
            setWithExpiry('currentDayTask', true, 600000);
            let dayDate = addTaskOpenModalButton.getAttribute('data-date').split('-');
            setWithExpiry('currentDayTaskDay', dayDate[0], 600000);
            setWithExpiry('currentDayTaskMonth', dayDate[1], 600000);
            setWithExpiry('currentDayTaskYear', dayDate[2], 600000);
            e.preventDefault();
            let blackoutDiv = document.querySelector('.calendar-full-blackout')
            document.body.style.overflow = "hidden";
            document.body.style.height = "100vh";
            blackoutDiv.style.display ='flex';
            let deleteTaskModal = document.querySelector('.delete-task-modal')
            deleteTaskModal.style.display = "flex";
            let deleteForm = document.getElementById('delete-task-form');
            deleteForm.action = `${baseURL}/calender/${taskDeleteButtons[index].getAttribute('data-u')}/deletetask/${taskDeleteButtons[index].getAttribute('data-i')}`;
         
            document.getElementById('task-delete-modal-message').innerHTML = `Bent u zeker dat u deze taak wilt verwijderen?`
            document.getElementById('task-delete-decline').addEventListener('click', (e)=>{
                e.preventDefault();
                document.querySelector('.delete-task-modal').style.display = "none";
                document.querySelector('.calendar-full-blackout').style.display = "none";
                document.body.style.overflow = "";
                document.body.style.height = "";
            })
            document.getElementById('task-delete-modal-close-button').addEventListener('click', (e)=>{
                e.preventDefault();
                document.querySelector('.calendar-full-blackout').style.display = "none";
                document.querySelector('.delete-task-modal').style.display = "none";
                document.body.style.overflow = "";
                document.body.style.height = "";
            })
        })
    }
}
});




function setWithExpiry(key, value, ttl) {
    const now = new Date()
    const item = {
        value: value,
        expiry: now.getTime() + ttl,
    }
    localStorage.setItem(key, JSON.stringify(item))
}
function getWithExpiry(key) {
    const itemStr = localStorage.getItem(key)

    // if the item doesn't exist, return null
    if (!itemStr) {
        return null
    }

    const item = JSON.parse(itemStr)
    const now = new Date()

    // compare the expiry time of the item with the current time
    if (now.getTime() > item.expiry) {
        // If the item is expired, delete the item from storage
        // and return null
        localStorage.removeItem(key)
        return null
    }
    return item.value
}


/* task validation */
