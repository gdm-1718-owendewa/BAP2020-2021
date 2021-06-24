let eventSignOutButtons = document.querySelectorAll('.sign-out-of-event-button');
for (let index = 0; index < eventSignOutButtons.length; index++) {
    const element = eventSignOutButtons[index];
    let baseURL = window.location.origin;
    eventSignOutButtons[index].addEventListener('click', (e) => {
        e.preventDefault();
        console.log(element);
        let blackoutDiv = document.createElement('div')
        blackoutDiv.classList.add('event-sign-out-div')
        document.getElementById('dasbord-container').appendChild(blackoutDiv);

        let eventSignOutModal = document.createElement('div')
        eventSignOutModal.classList.add('event-sign-out-modal')
        document.getElementById('dasbord-container').appendChild(eventSignOutModal);

        eventSignOutModal.innerHTML =`
        <a id="event-sign-out-modal-close-button" href="#">&#10005;</a> 
        <div id="event-sign-out-modal-content-div">
        <div id="event-sign-out-modal-message-div">
            <p id="event-sign-out-modal-message"></p>
        </div>
        <div id="event-sign-out-modal-buttons-div">
            <a href="${baseURL+'/event/unsign/'+  eventSignOutButtons[index].getAttribute('data-uid')+'/'+eventSignOutButtons[index].getAttribute('data-eid')}" id="event-sign-out-accept">Ja</a>
            <a href="#" id="event-sign-out-decline">Nee</a>
            </div>  
        </div>`;
        document.getElementById('event-sign-out-modal-message').innerHTML = `Bent u zeker dat u zich wilt uitschrijven van dit event?`
        document.body.style.overflow = "hidden";
        document.body.style.height = "100vh";
        document.getElementById('event-sign-out-decline').addEventListener('click', (e)=>{
            e.preventDefault();
            document.getElementById('dasbord-container').removeChild(eventSignOutModal);
            document.getElementById('dasbord-container').removeChild(blackoutDiv);
            document.body.style.overflow = "";
            document.body.style.height = "";
        })
        document.getElementById('event-sign-out-modal-close-button').addEventListener('click', (e)=>{
            e.preventDefault();
            document.getElementById('dasbord-container').removeChild(eventSignOutModal);
            document.getElementById('dasbord-container').removeChild(blackoutDiv);
            document.body.style.overflow = "";
            document.body.style.height = "";
        })
        blackoutDiv.addEventListener('click', (e)=>{
            e.preventDefault();
            document.getElementById('dasbord-container').removeChild(eventSignOutModal);
            document.getElementById('dasbord-container').removeChild(blackoutDiv);
            document.body.style.overflow = "";
            document.body.style.height = "";
        })
    })
}