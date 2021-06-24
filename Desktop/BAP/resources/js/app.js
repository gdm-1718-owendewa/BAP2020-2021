


/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');

  


/*check device type of user*/
let deviceType = '';
const getDeviceType = () => {
    const ua = navigator.userAgent;
    if (/(tablet|iPad|playbook|silk)|(android(?!.*mobi))/i.test(ua)) {
        deviceType =  "tablet";
        // console.log(deviceType);
    }
    if (/Mobile|iP(hone|od)|Android|BlackBerry|IEMobile|Kindle|Silk-Accelerated|(hpw|web)OS|Opera M(obi|ini)/.test(ua)) {
        deviceType = "mobile";
        // console.log(deviceType);
    }
    else{
        deviceType = "desktop"; 
        // console.log(deviceType);   
    }
    
  };
  getDeviceType();
/* smoothscroll function */
function smoothScroll(targetelement, duration){
    let target = document.querySelector(targetelement);
    let targetPosition = target.getBoundingClientRect().top;
    let startposition = window.pageYOffset;
    let distance = targetPosition - startposition;
    let startTime = null

    function animation(currentTime){
        if(startTime === null) startTime = currentTime;
        let timeElapsed = currentTime - startTime;
        let run  = ease(timeElapsed, startposition,distance,duration);
        window.scrollTo(0,run);
        if(timeElapsed < duration) requestAnimationFrame(animation);
    }
    function ease(t,b,c,d){
        t /= d/2;
        if (t < 1) return c/2*t*t + b;
        t--;
        return -c/2 * (t*(t-2) - 1) + b;

    }
    requestAnimationFrame(animation);
}
function noScroll() {
    window.scrollTo(0, 0);
  }
/*Storage delete Modal*/
let storageDeleteButtons = document.querySelectorAll('.delete-design-button');
for(let i=0; i < storageDeleteButtons.length; i++){
    storageDeleteButtons[i].addEventListener('click', (e)=>{
        console.log(storageDeleteButtons[i]);
        window.scrollTo(0, 0);
        window.addEventListener('scroll', noScroll);
        let baseURL = window.location.origin;
        let id = storageDeleteButtons[i].getAttribute('data-id');
        let name = storageDeleteButtons[i].getAttribute('data-name');
        let message = document.getElementById('storage-delete-modal-message');
        message.innerHTML = "Bent u zeker dat u " + name + " wilt verwijderen?"
        document.getElementById('storage-delete-accept').href = baseURL+'/storage/'+id+'/design/'+name+'/delete'
        document.getElementById('storage-delete-blackout').style.display = "block";
        document.getElementById('storage-delete-modal').style.display = "block";
        document.body.style.overflow = "hidden";
        document.body.style.height = "100vh";

    })
}
if(document.getElementById('storage-delete-blackout')!=null){
    document.getElementById('storage-delete-blackout').addEventListener('click', ()=>{
        document.getElementById('storage-delete-blackout').style.display = "none";
        document.getElementById('storage-delete-modal').style.display = "none";
        document.body.style.overflow = "";
        document.body.style.height = "";
        document.getElementById('storage-delete-accept').href = '';
            window.removeEventListener('scroll', noScroll);

    })
}
if(document.getElementById('storage-delete-modal-close-button') !=null){
    document.getElementById('storage-delete-modal-close-button').addEventListener('click', ()=>{
        document.getElementById('storage-delete-blackout').style.display = "none";
        document.getElementById('storage-delete-modal').style.display = "none";
        document.body.style.overflow = "";
        document.body.style.height = "";
        document.getElementById('storage-delete-accept').href = '';
            window.removeEventListener('scroll', noScroll);

    })
}
if(document.getElementById('storage-delete-decline') != null){
    document.getElementById('storage-delete-decline').addEventListener('click', ()=>{
        document.getElementById('storage-delete-blackout').style.display = "none";
        document.getElementById('storage-delete-modal').style.display = "none";
        document.body.style.overflow = "";
        document.body.style.height = "";
        document.getElementById('storage-delete-accept').href = '';
            window.removeEventListener('scroll', noScroll);

    })
}
/*Admin Delete Modal */
let adminDeleteButtons = document.querySelectorAll('.admin-delete-project-button');
for(let i=0; i < adminDeleteButtons.length; i++){
    adminDeleteButtons[i].addEventListener('click', (e)=>{
        console.log('test');
        e.preventDefault();
        window.scrollTo(0, 0);
        window.addEventListener('scroll', noScroll);
        let baseURL = window.location.origin;
        let typeUrl = ''
        let type = adminDeleteButtons[i].getAttribute('data-t');
        let title = adminDeleteButtons[i].getAttribute('data-title');
        let id = adminDeleteButtons[i].getAttribute('data-id');
        let message = document.getElementById('admin-delete-modal-message');
        if( type == "article"){
            typeUrl = '/article/delete/'+id;
            message.innerHTML = "Bent u zeker dat u " + title + " wilt verwijderen?"
        }else if(type == "event"){
            typeUrl = '/event/delete/'+id;
            message.innerHTML = "Bent u zeker dat u " + title + " wilt verwijderen?";
        }else if(type == "tutorial"){
            typeUrl = '/tutorial/delete/'+id;
            message.innerHTML = "Bent u zeker dat u " + title + " wilt verwijderen?";
        }else if(type == "thread"){
            typeUrl = '/thread/delete/'+id;
            message.innerHTML = "Bent u zeker dat u " + title + " wilt verwijderen?";
        }else if(type == "course"){
            typeUrl = '/course/delete/'+id;
            message.innerHTML = "Bent u zeker dat u " + title + " wilt verwijderen?";
        }else if(type == "user"){
            typeUrl = '/profile/delete/'+id;
            message.innerHTML = "Bent u zeker dat u " + title + " wilt verwijderen?";
        }else if(type =="comment"){
            typeUrl = '/delete-comment/'+id;
            message.innerHTML = "Bent u zeker dat u de comment van " + title + " wilt verwijderen?";
        }
        document.getElementById('admin-delete-accept').href = baseURL+typeUrl;
        document.getElementById('admin-delete-blackout').style.display = "block";
        document.getElementById('admin-delete-modal').style.display = "block";
        document.body.style.overflow = "hidden";
        document.body.style.height = "100vh";

    });
}
if(document.getElementById('admin-delete-blackout')!=null){
    document.getElementById('admin-delete-blackout').addEventListener('click', ()=>{
        document.getElementById('admin-delete-blackout').style.display = "none";
        document.getElementById('admin-delete-modal').style.display = "none";
        document.body.style.overflow = "";
        document.body.style.height = "";
        document.getElementById('admin-delete-accept').href = '';
            window.removeEventListener('scroll', noScroll);

    })
}
if(document.getElementById('admin-delete-modal-close-button') !=null){
    document.getElementById('admin-delete-modal-close-button').addEventListener('click', ()=>{
        document.getElementById('admin-delete-blackout').style.display = "none";
        document.getElementById('admin-delete-modal').style.display = "none";
        document.body.style.overflow = "";
        document.body.style.height = "";
        document.getElementById('admin-delete-accept').href = '';
            window.removeEventListener('scroll', noScroll);

    })
}
if(document.getElementById('admin-delete-decline') != null){
    document.getElementById('admin-delete-decline').addEventListener('click', ()=>{
        document.getElementById('admin-delete-blackout').style.display = "none";
        document.getElementById('admin-delete-modal').style.display = "none";
        document.body.style.overflow = "";
        document.body.style.height = "";
        document.getElementById('admin-delete-accept').href = '';
            window.removeEventListener('scroll', noScroll);

    })
}

//Open header menu
let SmallHeaderMenu = document.getElementById('small-header-menu');

//Sluit menu als je op de blackout klikt
let SmallMenuBlackout = document.getElementById('small-menu-blackout');
SmallMenuBlackout.addEventListener('click', ()=>{
    SmallHeaderMenu.style.width="0";
    setTimeout(function(){
        SmallMenuBlackout.style.display="none";
    },500)
})
//Open menu als je op de knop klikt
let OpenSmallMenuButton = document.getElementById('header-open-menu-button');
OpenSmallMenuButton.addEventListener('click', ()=>{
    SmallMenuBlackout.style.display ="block";
    if(document.body.clientWidth > 500){
        SmallHeaderMenu.style.width = '75%';
    }else{
        SmallHeaderMenu.style.width = '100%';

    }
});
//Sluit menu als je op de knop klikt

let CloseSmallMenuButton = document.getElementById('close-small-header-menu');
CloseSmallMenuButton.addEventListener('click', ()=>{
    SmallHeaderMenu.style.width="0";
    setTimeout(function(){
        SmallMenuBlackout.style.display="none";
    },500);

});
//check of zoekbalk is gefocused
let searchbarbig = document.querySelector('.header-search-input-big');
let headerblackoutbig = document.getElementById('headerblackout-big');
let headersearchresultsbig = document.querySelector('.header-search-results-big');

let searchbarsmall = document.querySelector('.header-search-input-small');
let headerblackoutsmall = document.getElementById('headerblackout-small');
let headersearchresultssmall = document.querySelector('.header-search-results-small');

if(searchbarbig){
    searchbarbig.addEventListener('click', ()=>{
        headerblackoutbig.style.display = "block";
        headersearchresultsbig.style.display = "block";
        document.body.style.overflow = "hidden";
        document.body.style.height = "100vh";
        window.addEventListener('scroll', noScroll);
    });
}
headerblackoutbig.addEventListener('click', ()=>{
    headerblackoutbig.style.display="none";
    headersearchresultsbig.style.display = "none";
    document.body.style.overflow = "";
    document.body.style.height = "";
    window.removeEventListener('scroll', noScroll);

});

if(searchbarsmall){
    
    searchbarsmall.addEventListener('click', ()=>{
        headerblackoutsmall.style.display = "block";
        headersearchresultssmall.style.display = "block";
        document.body.style.overflow = "hidden";
        document.body.style.height = "100vh";
        window.addEventListener('scroll', noScroll);
    });

}
headerblackoutsmall.addEventListener('click', ()=>{
    headerblackoutsmall.style.display="none";
    headersearchresultssmall.style.display = "none";
    document.body.style.overflow = "";
    document.body.style.height = "";
    window.removeEventListener('scroll', noScroll);
});
//Window resize functies
var onresize = function() {
    width = document.body.clientWidth;
    height = document.body.clientHeight;
    if(width > 1000){
        SmallHeaderMenu.style.width="0";
        SmallMenuBlackout.style.display="none";
        headerblackoutsmall.style.display = "none";
        if(headersearchresultssmall !=null){
            headersearchresultssmall.style.display ="none";
            headersearchresultssmall.innerHTML ="";
        }
        if(searchbarsmall != null){
            searchbarsmall.value = '';
        }
    }
    if(width < 1000){
        headerblackoutbig.style.display = "none";
        if(headersearchresultsbig !=null){
            headersearchresultsbig.style.display ="none";
            headersearchresultsbig.innerHTML ="";
        }
        if(searchbarbig != null){
            searchbarbig.value = '';
        }
    }
 }
 
window.addEventListener("resize", onresize);
window.addEventListener("scroll", function() {
    if (window.scrollY > window.innerHeight/2){
        if(document.getElementById('mytotopbutton') !=null){
            document.getElementById('mytotopbutton').style.display="block";
            document.getElementById('to-top-button').addEventListener('click', () => {
                    smoothScroll('#header-top-div', 1000);
            })   
        }

    }else{
        if(document.getElementById('mytotopbutton') !=null){
        document.getElementById('mytotopbutton').style.display="none";
        }
    }
})

// smooth scroll op homepage naar our goals kaders
let homescrolldownbutton = document.getElementById('home-scroll-down');
if(homescrolldownbutton != null){
    homescrolldownbutton.addEventListener('click', ()=>{
        smoothScroll('#our-goal-1', 1000);
    })
}

//Instant upload van bestanden bij Storage pagina na het kiezen
if(document.getElementById("design-files")!=null){
    document.getElementById("design-files").onchange = function() {
        document.getElementById("design-form").submit();
    };
}


// Searchbar //
let typingTimer;                //timer identifier
let doneTypingInterval = 1000;  //time in ms, 1 second for example
//grote searchbar
let input = $('#big-search-input');
//kleine searchbar
let inputsmall = $('#small-search-input');

//on keyup, start the countdown
input.on('keyup', function () {
  clearTimeout(typingTimer);
  typingTimer = setTimeout(doneTyping, doneTypingInterval);
});
inputsmall.on('keyup', function () {
    clearTimeout(typingTimer);
    typingTimer = setTimeout(doneTypingSmall, doneTypingInterval);
  });
//on keydown, clear the countdown 
input.on('keydown', function () {
  clearTimeout(typingTimer);
});
inputsmall.on('keydown', function () {
    clearTimeout(typingTimer);
  });
//Gebruiker heeft zoekterm ingetyped
function doneTyping () {
  let baseURL = window.location.origin;
  //Toon zoektermen bij grote search
  searchbarResults = document.getElementById('header-search-results-big');
  if(document.querySelector('#big-search-input').value.length >= 2){
    searchbarResults.innerHTML = '';
    //Ajax cal voor resultaten
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: baseURL + '/searchbarresults',  
            data: { 
                searchterm: document.querySelector('#big-search-input').value, 
            },
            success: function(response){
                //Haal alle info op
                let articleCount = response['articles'].length;
                let eventCount = response['events'].length;
                let tutorialCount = response['tutorials'].length;
                let threadCount = response['threads'].length;
                let courseCount = response['course'].length;
                let userCount = response['users'].length;
                //Voeg content toe aan de result bar als deze groter is dan 1
                //Artikelen
                if(articleCount > 0){
                    searchbarResults.innerHTML += '<div class="search-bar-result-div" id="articles-results"><div class="result-title-div"><h4>Artikelen</h4></div><div id="articles-results-content-div" ></div></div>'
                    let articles = response['articles'];
                    let articlesResultContentDiv = document.getElementById('articles-results-content-div');
                    for(let i =0; i < articles.length; i++){
                        articlesResultContentDiv.innerHTML += '<a href="' + baseURL + '/article/article-detail/' + articles[i].id + '"><div class="articles-results-item"><i class="far fa-newspaper"></i><p>' + articles[i].title + '<br>Door: '+articles[i].author+'</p></div></a>'
                    }
                }
                //Events
                if(eventCount > 0){
                    searchbarResults.innerHTML += '<div class="search-bar-result-div" id="events-results"><div class="result-title-div"><h4>Evenementen</h4></div><div id="events-results-content-div" ></div></div>'
                    let eventsResultContentDiv = document.getElementById('events-results-content-div');
                    let events = response['events'];
                    for(let i =0; i < events.length; i++){

                        eventsResultContentDiv.innerHTML += '<a href="' + baseURL + '/event-detail/' + events[i].id + '"><div class="events-results-item"><i class="far fa-handshake"></i><p>' + events[i].title + '<br>Door: '+events[i].author+'</p></div></a>'
                    }
                }
                //Tutorials
                if(tutorialCount > 0){
                    searchbarResults.innerHTML += '<div class="search-bar-result-div" id="tutorials-results"><div class="result-title-div"><h4>Tutorials</h4></div><div class="results-content-div" id="tutorials-results-content-div"></div></div>'
                    let tutorials = response['tutorials'];
                    let tutorialResultContentDiv = document.getElementById('tutorials-results-content-div');
                    for(let i =0; i < tutorials.length; i++){
                    
                        tutorialResultContentDiv.innerHTML += '<a href="' + baseURL + '/tutorial-detail/' + tutorials[i].id + '"><div class="tutorials-results-item"><i class="fas fa-photo-video"></i><p>' + tutorials[i].title + '<br>Door: '+tutorials[i].author+'</p></div></a>'
                    }
                }
                //Discussies
                if(threadCount > 0){
                    searchbarResults.innerHTML += '<div class="search-bar-result-div" id="threads-results"><div class="result-title-div"><h4>Discussies</h4></div><div id="threads-results-content-div" ></div></div>'
                    let threads = response['threads'];
                    let threadsResultContentDiv = document.getElementById('threads-results-content-div');
                    for(let i =0; i < threads.length; i++){
                        threadsResultContentDiv.innerHTML += '<a href="' + baseURL + '/thread-detail/' + threads[i].id + '"><div class="threads-results-item"><i class="fas fa-bullhorn"></i><p>' + threads[i].title + '<br>Door: '+threads[i].author+'</p></div></a>'
                    }
                }
                //Cursussen
                if(courseCount > 0){
                    searchbarResults.innerHTML += '<div class="search-bar-result-div" id="courses-results"><div class="result-title-div"><h4>Cursussen</h4></div><div id="courses-results-content-div" ></div></div>'
                    let coursesResultContentDiv = document.getElementById('courses-results-content-div');
                    let courses = response['course'];
                    for(let i =0; i < courses.length; i++){
                        coursesResultContentDiv.innerHTML += '<a href="' + baseURL + '/course-detail/' + courses[i].id + '"><div class="courses-results-item"> <i class="fas fa-book"></i><p>' + courses[i].title + '<br>Door: '+courses[i].author+'</p></div></a>'
                    }
                }
                //Gebruikers
                if(userCount > 0){
                    let users = response['users'];
                    if(userCount == 1 && users[0].name == 'Admin' || users[0].email == 'admin@email.be' ){
                        searchbarResults.innerHTML = '<div class="search-bar-result-div" id="no-results"><p>Er zijn geen resultaten gevonden</p></div>';
                    }else{
                        searchbarResults.innerHTML += '<div class="search-bar-result-div" id="users-results"><div class="result-title-div"><h4>Gebruikers</h4></div><div id="users-results-content-div" ></div></div>'
                        let usersResultContentDiv = document.getElementById('users-results-content-div');
                        for(let i =0; i < users.length; i++){
                            if(users[i].name !='Admin' || users[i].email !='admin@email.be'){
                                usersResultContentDiv.innerHTML += '<a href="' + baseURL + '/profile/' + users[i].id + '"><div class="users-results-item"> <i class="fas fa-user-circle"></i><div id="user-info" ><p>' + users[i].name + '<br><em>'+ users[i].shopname +'</em></p> </div></div></a>'
                            }
                        }
                    }
                }
                //Als er geen resultaten gevonden zijn
                if(articleCount == 0 && eventCount == 0 && tutorialCount == 0 && threadCount == 0 && courseCount == 0 && userCount == 0 ){
                    searchbarResults.innerHTML = '<div class="search-bar-result-div" id="no-results"><p>Er zijn geen resultaten gevonden</p></div>';
                }

            },
            error: function(response, request,status,errorThrown){
            console.log('Error');
            console.log(response);
            console.log(request);
            console.log(status);
            console.log(errorThrown);
        }
        })
    }else   {
        searchbarResults.innerHTML = '<div class="search-bar-result-div" id="no-results"><p>Gelieve 2 of meer letters in te vullen</p></div>';
    }
    
    
}
//search small formaat
function doneTypingSmall () {
    let baseURL = window.location.origin;
    searchbarResults = document.getElementById('header-search-results-small');
    //Als de zoketerm niet langer is dan 2 characters
    if(document.querySelector('#small-search-input').value.length >= 2){
        searchbarResults.innerHTML = '';
        //Ajax cal voor resultaten
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: baseURL + '/searchbarresults',  
                data: { 
                    searchterm: document.querySelector('#small-search-input').value, 
                },
                success: function(response){
                    //Haal alle info op
                    let articleCount = response['articles'].length;
                    let eventCount = response['events'].length;
                    let tutorialCount = response['tutorials'].length;
                    let threadCount = response['threads'].length;
                    let courseCount = response['course'].length;
                    let userCount = response['users'].length;
                    //Voeg content toe aan de result bar als deze groter is dan 1
                    //Artikelen
                    if(articleCount > 0){
                        searchbarResults.innerHTML += '<div class="search-bar-result-div" id="articles-results"><div class="result-title-div"><h4>Artikelen</h4></div><div id="articles-results-content-div" ></div></div>'
                        let articles = response['articles'];
                        let articlesResultContentDiv = document.getElementById('articles-results-content-div');
                        for(let i =0; i < articles.length; i++){
                            articlesResultContentDiv.innerHTML += '<a href="' + baseURL + '/article/article-detail/' + articles[i].id + '"><div class="articles-results-item"><i class="far fa-newspaper"></i><p>' + articles[i].title + '<br>Door: '+articles[i].author+'</p></div></a>'
                        }
                    }
                    //Events
                    if(eventCount > 0){
                        searchbarResults.innerHTML += '<div class="search-bar-result-div" id="events-results"><div class="result-title-div"><h4>Evenementen</h4></div><div id="events-results-content-div" ></div></div>'
                        let eventsResultContentDiv = document.getElementById('events-results-content-div');
                        let events = response['events'];
                        for(let i =0; i < events.length; i++){
    
                            eventsResultContentDiv.innerHTML += '<a href="' + baseURL + '/event-detail/' + events[i].id + '"><div class="events-results-item"><i class="far fa-handshake"></i><p>' + events[i].title + '<br>Door: '+events[i].author+'</p></div></a>'
                        }
                    }
                    //Tutorials
                    if(tutorialCount > 0){
                        searchbarResults.innerHTML += '<div class="search-bar-result-div" id="tutorials-results"><div class="result-title-div"><h4>Tutorials</h4></div><div class="results-content-div" id="tutorials-results-content-div"></div></div>'
                        let tutorials = response['tutorials'];
                        let tutorialResultContentDiv = document.getElementById('tutorials-results-content-div');
                        for(let i =0; i < tutorials.length; i++){
                        
                            tutorialResultContentDiv.innerHTML += '<a href="' + baseURL + '/tutorial-detail/' + tutorials[i].id + '"><div class="tutorials-results-item"><i class="fas fa-photo-video"></i><p>' + tutorials[i].title + '<br>Door: '+tutorials[i].author+'</p></div></a>'
                        }
                    }
                    //Discussies
                    if(threadCount > 0){
                        searchbarResults.innerHTML += '<div class="search-bar-result-div" id="threads-results"><div class="result-title-div"><h4>Discussies</h4></div><div id="threads-results-content-div" ></div></div>'
                        let threads = response['threads'];
                        let threadsResultContentDiv = document.getElementById('threads-results-content-div');
                        for(let i =0; i < threads.length; i++){
                            threadsResultContentDiv.innerHTML += '<a href="' + baseURL + '/thread-detail/' + threads[i].id + '"><div class="threads-results-item"><i class="fas fa-bullhorn"></i><p>' + threads[i].title + '<br>Door: '+threads[i].author+'</p></div></a>'
                        }
                    }
                    //Cursussen
                    if(courseCount > 0){
                        searchbarResults.innerHTML += '<div class="search-bar-result-div" id="courses-results"><div class="result-title-div"><h4>Cursussen</h4></div><div id="courses-results-content-div" ></div></div>'
                        let coursesResultContentDiv = document.getElementById('courses-results-content-div');
                        let courses = response['course'];
                        for(let i =0; i < courses.length; i++){
                            coursesResultContentDiv.innerHTML += '<a href="' + baseURL + '/course-detail/' + courses[i].id + '"><div class="courses-results-item"> <i class="fas fa-book"></i><p>' + courses[i].title + '<br>Door: '+courses[i].author+'</p></div></a>'
                        }
                    }
                    //Gebruikers
                    if(userCount > 0){
                        let users = response['users'];
                        if(userCount == 1 && users[0].name == 'Admin' || users[0].email == 'admin@email.be' ){
                            searchbarResults.innerHTML = '<div class="search-bar-result-div" id="no-results"><p>Er zijn geen resultaten gevonden</p></div>';
                        }else{
                            searchbarResults.innerHTML += '<div class="search-bar-result-div" id="users-results"><div class="result-title-div"><h4>Gebruikers</h4></div><div id="users-results-content-div" ></div></div>'
                            let usersResultContentDiv = document.getElementById('users-results-content-div');
                            for(let i =0; i < users.length; i++){
                                if(users[i].name !='Admin' || users[i].email !='admin@email.be'){
                                    usersResultContentDiv.innerHTML += '<a href="' + baseURL + '/profile/' + users[i].id + '"><div class="users-results-item"> <i class="fas fa-user-circle"></i><div id="user-info" ><p>' + users[i].name + '<br><em>'+ users[i].shopname +'</em></p> </div></div></a>'
                                }
                            }
                        }
                    }
                    //Als er geen resultaten gevonden zijn
                    if(articleCount == 0 && eventCount == 0 && tutorialCount == 0 && threadCount == 0 && courseCount == 0 && userCount == 0 ){
                        searchbarResults.innerHTML = '<div class="search-bar-result-div" id="no-results"><p>Er zijn geen resultaten gevonden</p></div>';
                    }
    
                },
                error: function(response, request,status,errorThrown){
                console.log('Error');
                console.log(response);
                console.log(request);
                console.log(status);
                console.log(errorThrown);
            }
            })
    }else{
        searchbarResults.innerHTML = '<div class="search-bar-result-div" id="no-results"><p>Gelieve 2 of meer letters in te vullen</p></div>';

    }

}




 //Open cursus menu
 document.addEventListener('click',function(e){
    if(e.target.id == 'open_course_menu_button'){
        var el = document.getElementById('sidebar-upload');
        var parent = document.getElementById('open-close-course-menu-div');
        el.style.display ="flex";
        parent.innerHTML = ' <a href="#" id="close_course_menu_button"><i class="fas fa-chevron-up"></i></a>'
    }
});
//Close cursus menu
document.addEventListener('click',function(e){
    if(e.target.id== 'close_course_menu_button'){
          var el = document.getElementById('sidebar-upload');
          var parent = document.getElementById('open-close-course-menu-div');
          el.style.display ="none";
          parent.innerHTML = ' <a href="#" id="open_course_menu_button"><i class="fas fa-chevron-down"></i></a>'
     }
 });
 //Verwijder project buttons
 let deleteProjectButtons = document.querySelectorAll('.delete-project-button');
 if(deleteProjectButtons != null){
    for(let i =0; i < deleteProjectButtons.length; i++){
        deleteProjectButtons[i].addEventListener('click', () => {
            let baseURL = window.location.origin;
            let projectTitle = deleteProjectButtons[i].getAttribute('data-t');
            let projectDeleteLink = deleteProjectButtons[i].getAttribute('data-l');
            document.getElementById('projects-modal-message').innerHTML = "  <p>Ben u zeker dat u " + projectTitle + " wilt verwijderen?</p>"
            document.getElementById('projects-delete-modal').style.display = "block";
            document.getElementById('project-modal-confirm').href=baseURL+''+projectDeleteLink;
            document.body.style.overflow = "hidden";
            document.body.style.height = "100vh";
        })
    }
 }
 //Stop project delete
let deleteProjectCancel = document.getElementById('projects-modal-decline');
if(deleteProjectCancel != null){
    deleteProjectCancel.addEventListener('click', ()=>{
        document.getElementById('projects-modal-message').innerHTML = ""
        document.getElementById('projects-delete-modal').style.display = "none";
        document.getElementById('project-modal-confirm').href="";
        document.body.style.overflow = "";
        document.body.style.height = "";
    })
    }


/*search on admin dash */

let adminTypingTimer;                //timer identifier
let adminDoneTypingInterval = 1000;  //time in ms, 1 second for example
let admininput = $('#admin-dash-search');


//on keyup, start the countdown
admininput.on('keyup', function () {
  clearTimeout(adminTypingTimer);
  adminTypingTimer = setTimeout(adminDoneTyping, adminDoneTypingInterval);
});

//on keydown, clear the countdown 
admininput.on('keydown', function () {
  clearTimeout(adminTypingTimer);
});

function adminDoneTyping () {
    let baseURL = window.location.origin;
    let search_content_result = document.getElementById('search-content-result');
    let admin_content_table = document.getElementById('admin-content-table');
    //check of zoekterm langer is of gelijk aan 2
    if(document.querySelector('#admin-dash-search').value.length >= 2){
        admin_content_table.style.display = "none";
        search_content_result.innerHTML = '';
        search_content_result.style.display = 'block';
        //Ajax call
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: baseURL + '/adminsearchbarresults',  
            data: { 
                searchterm: document.querySelector('#admin-dash-search').value, 
            },
            success: function(response){
                let articleCount = response['articles'].length;
                let eventCount = response['events'].length;
                let tutorialCount = response['tutorials'].length;
                let threadCount = response['threads'].length;
                let courseCount = response['course'].length;
                let userCount = response['users'].length;
                let commentCount = response['comments'].length;
                //Voeg content toe aan de result bar als deze groter is dan 1
                //Artikelen
                if(articleCount > 0){
                    search_content_result.innerHTML += '<div class="content-item"><div id="admin-article-result"><h4>Artikelen</h4></div><table id="admin-article-table"></table></div>';
                    let admin_article_div = document.getElementById('admin-article-table');
                    for(let i = 0; i < articleCount; i++){
                        admin_article_div.innerHTML += '<tr><td>'+ response['articles'][i].author+'</td><td>'+ response['articles'][i].title+'</td><td><a href="' + baseURL + '/article/article-detail/' + response['articles'][i].id + '" class="detail-button"><i class="fas fa-info-circle"></i></a></td><td><a href="' + baseURL + '/article/edit/' + response['articles'][i].id + '" class="edit-button"><i class="far fa-edit"></i></a></td><td><a class="admin-delete-project-button" href="#" data-t="article" data-id="'+response['articles'][i].id+'" data-title="'+response['articles'][i].title+'"><i class="far fa-trash-alt"></i></a></td></tr>'
                    }
                }
                //Events
                if(eventCount > 0){
                    search_content_result.innerHTML += '<div class="content-item"><div id="admin-event-result"><h4>Evenementen</h4><table id="admin-event-table"></table></div></div>';
                    let admin_event_div = document.getElementById('admin-event-table');
                    for(let i = 0; i < eventCount; i++){
                        admin_event_div.innerHTML += '<tr><td>'+ response['events'][i].author+'</td><td>'+ response['events'][i].title+'</td><td><a href="' + baseURL + '/event-detail/' + response['events'][i].id + '" class="detail-button"><i class="fas fa-info-circle"></i></a></td><td><a href="' + baseURL + '/event/edit/' + response['events'][i].id + '" class="edit-button"><i class="far fa-edit"></i></a></td><td><a class="admin-delete-project-button" href="#" data-t="event" data-id="'+response['events'][i].id+'" data-title="'+response['events'][i].title+'"><i class="far fa-trash-alt"></i></a></td></tr>'
                    }
                }
                //Tutorials
                if(tutorialCount > 0){
                    search_content_result.innerHTML += '<div class="content-item"><div id="admin-tutorial-result"><h4>Tutorials</h4><table id="admin-tutorial-table"></table></div></div>';
                    let admin_tutorial_div = document.getElementById('admin-tutorial-table');
                    for(let i = 0; i < tutorialCount; i++){
                        admin_tutorial_div.innerHTML += '<tr><td>'+ response['tutorials'][i].author+'</td><td>'+ response['tutorials'][i].title+'</td><td><a href="' + baseURL + '/tutorial-detail/' + response['tutorials'][i].id + '" class="detail-button"><i class="fas fa-info-circle"></i></a></td><td><a href="' + baseURL + '/tutorial/edit/' + response['tutorials'][i].id + '" class="edit-button"><i class="far fa-edit"></i></a></td><td><a class="admin-delete-project-button" href="#"  data-t="tutorial" data-id="'+response['tutorials'][i].id+'" data-title="'+response['tutorials'][i].title+'"><i class="far fa-trash-alt"></i></a></td></tr>'
                    }
                }
                //Discussies
                if(threadCount > 0){
                    search_content_result.innerHTML += '<div class="content-item"><div id="admin-thread-result"><h4>Discussies</h4><table id="admin-thread-table"></table></div></div>';
                    let admin_thread_div = document.getElementById('admin-thread-table');
                    for(let i = 0; i < threadCount; i++){
                        admin_thread_div.innerHTML += '<tr><td>'+ response['threads'][i].author+'</td><td>'+ response['threads'][i].title+'</td><td><a href="' + baseURL + '/thread-detail/' + response['threads'][i].id + '" class="detail-button"><i class="fas fa-info-circle"></i></a></td><td><a href="' + baseURL + '/thread/edit/' + response['threads'][i].id + '" class="edit-button"><i class="far fa-edit"></i></a></td><td><a class="admin-delete-project-button" href="#" data-t="thread" data-id="'+response['threads'][i].id+'" data-title="'+response['threads'][i].title+'"><i class="far fa-trash-alt"></i></a></td></tr>'
                    }
                }
                //Cursussen
                if(courseCount > 0){
                    search_content_result.innerHTML += '<div class="content-item"><div id="admin-course-result"><h4>Cursussen</h4><table id="admin-course-table"></table></div></div>';
                    let admin_course_div = document.getElementById('admin-course-table');
                    for(let i = 0; i < courseCount; i++){
                        admin_course_div.innerHTML += '<tr><td>'+ response['course'][i].author+'</td><td>'+ response['course'][i].title+'</td><td><a href="' + baseURL + '/course-detail/' + response['course'][i].id + '" class="detail-button"><i class="fas fa-info-circle"></i></a></td><td><a href="' + baseURL + '/course/edit/' + response['course'][i].id + '" class="edit-button"><i class="far fa-edit"></i></a></td><td><a class="admin-delete-project-button" href="#"  data-t="course" data-id="'+response['course'][i].id+'" data-title="'+response['course'][i].title+'"><i class="far fa-trash-alt"></i></a></td></tr>'
                    }
                }
                //Gebruikers
                if(userCount > 0){
                    search_content_result.innerHTML += '<div class="content-item"><div id="admin-user-result"><h4>Gebruikers</h4><table id="admin-user-table"></table></div></div>';
                    let admin_user_div = document.getElementById('admin-user-table');
                    for(let i = 0; i < userCount; i++){
                        admin_user_div.innerHTML += '<tr><td>'+ response['users'][i].name+'</td><td>'+ response['users'][i].email+'</td><td><a href="' + baseURL + '/profile/' + response['users'][i].id + '" class="detail-button"><i class="fas fa-info-circle"></i></a></td><td><a href="' + baseURL + '/profile/edit/' + response['users'][i].id + '" class="edit-button"><i class="far fa-edit"></i></a></td><td><a class="admin-delete-project-button" href="#"  data-t="user" data-id="'+response['users'][i].id+'" data-title="'+response['users'][i].name+'"><i class="far fa-trash-alt"></i></a></td></tr>'
                    }
                }
                //comments
                if(commentCount > 0){
                    search_content_result.innerHTML += '<div class="content-item"><div id="admin-comment-result"><h4>Comments</h4><table id="admin-comment-table"></table></div></div>';
                    let admin_comment_div = document.getElementById('admin-comment-table');
                    for(let i = 0; i < commentCount; i++){
                        admin_comment_div.innerHTML += '<tr><td>'+ response['comments'][i].author+'</td><td>'+ response['comments'][i].content+'</td><td><a href="' + baseURL + '/thread-detail/' + response['comments'][i].thread_id + '" class="detail-button"><i class="fas fa-info-circle"></i></a></td><td><a href="' + baseURL + '/edit-comment/' + response['comments'][i].id + '" class="edit-button"><i class="far fa-edit"></i></a></td><td><a class="admin-delete-project-button" href="#"  data-t="comment" data-id="'+response['comments'][i].id+'" data-title="'+response['comments'][i].author+'"><i class="far fa-trash-alt"></i></a></td></tr>'
                    }
                }
                let adminDeleteButtons = document.querySelectorAll('.admin-delete-project-button');
                for(let i=0; i < adminDeleteButtons.length; i++){
                    adminDeleteButtons[i].addEventListener('click', (e)=>{
                        console.log(adminDeleteButtons[i]);
                        e.preventDefault();
                        window.scrollTo(0, 0);
                        window.addEventListener('scroll', noScroll);
                        let baseURL = window.location.origin;
                        let typeUrl = ''
                        let type = adminDeleteButtons[i].getAttribute('data-t');
                        let title = adminDeleteButtons[i].getAttribute('data-title');
                        let id = adminDeleteButtons[i].getAttribute('data-id');
                        let message = document.getElementById('admin-delete-modal-message');
                        if( type == "article"){
                            typeUrl = '/article/delete/'+id;
                            message.innerHTML = "Bent u zeker dat u " + title + " wilt verwijderen?"
                        }else if(type == "event"){
                            typeUrl = '/event/delete/'+id;
                            message.innerHTML = "Bent u zeker dat u " + title + " wilt verwijderen?";
                        }else if(type == "tutorial"){
                            typeUrl = '/tutorial/delete/'+id;
                            message.innerHTML = "Bent u zeker dat u " + title + " wilt verwijderen?";
                        }else if(type == "thread"){
                            typeUrl = '/thread/delete/'+id;
                            message.innerHTML = "Bent u zeker dat u " + title + " wilt verwijderen?";
                        }else if(type == "course"){
                            typeUrl = '/course/delete/'+id;
                            message.innerHTML = "Bent u zeker dat u " + title + " wilt verwijderen?";
                        }else if(type == "user"){
                            typeUrl = '/profile/delete/'+id;
                            message.innerHTML = "Bent u zeker dat u " + title + " wilt verwijderen?";
                        }else if(type =="comment"){
                            typeUrl = '/delete-comment/'+id;
                            message.innerHTML = "Bent u zeker dat u de comment van " + title + " wilt verwijderen?";
                        }
                        document.getElementById('admin-delete-accept').href = baseURL+typeUrl;
                        document.getElementById('admin-delete-blackout').style.display = "block";
                        document.getElementById('admin-delete-modal').style.display = "block";
                        document.body.style.overflow = "hidden";
                        document.body.style.height = "100vh";
                    })
                }
            },
            error: function(response, request,status,errorThrown){
            console.log('Error');
            console.log(response);
            console.log(request);
            console.log(status);
            console.log(errorThrown);
        }
        })
    }else{
        //Als er geen zoekterm is toon alles in het admin dashbord
        search_content_result.innerHTML = '';
        search_content_result.display = 'none';
        admin_content_table.style.display = "block";
    }
}

//Check of video file groter is dan 100mb bij tutorials
if(document.getElementById('main-video') != null){
    document.getElementById('main-video').addEventListener('change',()=>{
        let files = document.getElementById('main-video').files;
        if(files.length > 0){
            if(files[0].size < 100000000){
                if(document.getElementById('tut-file-size-error') != null){
                    document.getElementById('tut-file-size-error').innerHTML ='';

                    if(document.getElementById('tut-create-button')!= null){  
                        document.getElementById('tut-create-button').disabled = "";
                        document.getElementById('tut-create-button').style.background ='rgb(203,0,0)';
                    }
                    if(document.getElementById('tut-edit-button')!= null){  
                        document.getElementById('tut-edit-button').disabled = "";
                        document.getElementById('tut-edit-button').style.background ='rgb(203,0,0)';
                    }
                }
            }else{
                //Toon error als video file groter is dan 100mb
                let sizeInMb = (files[0].size / (1024*1024)).toFixed(2);
                if(document.getElementById('tut-file-size-error') != null){
                    document.getElementById('tut-file-size-error').innerHTML = 'Bestand is te groot uw bestand is ' + sizeInMb +'MB, uw tutorial zal niet aangemaakt worden!';
                    if(document.getElementById('tut-create-button')!= null){  
                        document.getElementById('tut-create-button').disabled = "disabled";
                        document.getElementById('tut-create-button').style.background ='lightgray';
                    }
                    if(document.getElementById('tut-edit-button')!= null){  
                        document.getElementById('tut-edit-button').disabled = "disabled";
                        document.getElementById('tut-edit-button').style.background ='lightgray';
                    }
                }
            
            }
        }
    });
}
//Check of video file groter is dan 100mb bij tutorials
if(document.getElementById('course-file-size') != null){
    document.getElementById('supporting-files').addEventListener('change',()=>{
        let files = document.getElementById('supporting-files').files;
        if(files.length > 0){
            filesizes = [];
            if(document.getElementById('course-content-size-error') != null){
                document.getElementById('course-content-size-error').innerHTML ='';
           }
            for(let i = 0; i<files.length; i++){
                if(files[i].size < 100000000){
                    let sizeInMb = (files[i].size / (1024*1024)).toFixed(2);
                    filesizes.push(sizeInMb);
                    if(document.getElementById('course-content-size-error') != null){
                        document.getElementById('course-content-size-error').innerHTML +='';
                    }
                }else{
                     //Toon error als er een file groter is dan 100mb
                    let sizeInMb = (files[i].size / (1024*1024)).toFixed(2);
                    filesizes.push(sizeInMb);
                    if(document.getElementById('course-content-size-error') != null){
                        document.getElementById('course-content-size-error').innerHTML += files[i].name + ' is te groot (' + sizeInMb +'MB), en hierdoor zullen uw bestanden niet toegevoegd worden!';
                    }
                
                }
            }
            const greaterthan = (element) => element > 100;
            //check of er een van de gekozen files groter is dan 100mb
            if(filesizes.some(greaterthan) == true){
                if(document.getElementById('addcontent-button')!= null){  
                    document.getElementById('addcontent-button').disabled = "disabled";
                    document.getElementById('addcontent-button').style.background ='lightgray';
                }
            }else if(filesizes.some(greaterthan) == false){
                document.getElementById('course-content-size-error').innerHTML ='';
                if(document.getElementById('addcontent-button')!= null){  
                    document.getElementById('addcontent-button').disabled = "";
                    document.getElementById('addcontent-button').style.background ='rgb(203,0,0)';
                }
            }
        }
    });
}

let commentDeleteButtons = document.querySelectorAll('.comment-delete-button');
for (let index = 0; index < commentDeleteButtons.length; index++) {
    let baseURL = window.location.origin;
    commentDeleteButtons[index].addEventListener('click', (e) => {
        e.preventDefault();
        let blackoutDiv = document.createElement('div')
        blackoutDiv.classList.add('thread-blackout-div')
        document.getElementById('detail-thread-container').appendChild(blackoutDiv);
        let deleteCommentModal = document.createElement('div')
        deleteCommentModal.classList.add('delete-comment-modal')
        document.getElementById('detail-thread-container').appendChild(deleteCommentModal);
        deleteCommentModal.innerHTML =`
        <a id="comment-delete-modal-close-button" href="#">&#10005;</a> 
        <div id="comment-delete-modal-content-div">
        <div id="comment-delete-modal-message-div">
            <p id="comment-delete-modal-message"></p>
        </div>
        <div id="comment-delete-modal-buttons-div">
            <a href="${baseURL+'/delete-comment/'+commentDeleteButtons[index].getAttribute('data-i')}" id="comment-delete-accept">Ja</a>
            <a href="#" id="comment-delete-decline">Nee</a>
            </div>  
        </div>`;
        document.getElementById('comment-delete-modal-message').innerHTML = `Bent u zeker dat u deze comment wilt verwijderen?`
        document.body.style.overflow = "hidden";
        document.body.style.height = "100vh";
        document.getElementById('comment-delete-decline').addEventListener('click', (e)=>{
            e.preventDefault();
            document.getElementById('detail-thread-container').removeChild(deleteCommentModal);
            document.getElementById('detail-thread-container').removeChild(blackoutDiv);
            document.body.style.overflow = "";
            document.body.style.height = "";
        })
        document.getElementById('comment-delete-modal-close-button').addEventListener('click', (e)=>{
            e.preventDefault();
            document.getElementById('detail-thread-container').removeChild(deleteCommentModal);
            document.getElementById('detail-thread-container').removeChild(blackoutDiv);
            document.body.style.overflow = "";
            document.body.style.height = "";
        })

    })
}

