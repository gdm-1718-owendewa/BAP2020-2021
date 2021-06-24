if(document.getElementById('event-create-div')){
    let button = document.querySelector('#submit')
    button.disabled = true
    button.style.backgroundColor= "grey"
    function validateForm(){
        if(titleCheck && contentCheck && capacityCheck && locationCheck && mainimageCheck && datefromCheck && dateuntilCheck){
            button.disabled = false
            button.style.backgroundColor= ""
        }else{
            button.disabled = true
            button.style.backgroundColor= "grey"
        }
    }
    let title = document.getElementById('title');
    let titleCheck = false;
    document.getElementById('titleSpan').innerHTML = '<i class="fas fa-times"></i>'
    document.getElementById('titleSpan').style.color = "red"
    title.addEventListener('input', (e) =>{
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
    });
    let content = document.getElementById('inhoud');
    let contentCheck = false;
    function foo() {
        let contentLength = content.getAttribute('data-length');
        if(contentLength <= 49 ){
            contentCheck = false;
            document.getElementById('contentSpan').innerHTML = '<i class="fas fa-times"></i>'
            document.getElementById('contentSpan').style.color = "red"
            setTimeout(foo, 2000);
        }
        else if(contentLength > 49){
            contentCheck = true;
            document.getElementById('contentSpan').innerHTML = '<i class="fas fa-check"></i>'
            document.getElementById('contentSpan').style.color = "green"
            setTimeout(foo, 2000);
        }
        validateForm();
    }
    foo();
    let capacityCheck = false;
    let capacity = document.getElementById('capacity');
    document.getElementById('capacitySpan').innerHTML = '<i class="fas fa-times"></i>'
    document.getElementById('capacitySpan').style.color = "red"
    capacity.addEventListener('input', (e)=>{
        if(capacity.value != '' && capacity.value > 0){
            capacityCheck = true;
            document.getElementById('capacitySpan').innerHTML = '<i class="fas fa-check"></i>'
            document.getElementById('capacitySpan').style.color = "green"
        }
        if(capacity.value == '' || capacity.value <= 0){
            document.getElementById('capacitySpan').innerHTML = '<i class="fas fa-times"></i>'
            document.getElementById('capacitySpan').style.color = "red"
        }
        validateForm();

    })
    let locationCheck = false;
    let location = document.getElementById('location');
    document.getElementById('locationSpan').innerHTML = '<i class="fas fa-times"></i>'
    document.getElementById('locationSpan').style.color = "red"
    location.addEventListener('input', (e)=>{
        if(location.value != ''){
            locationCheck = true;
            document.getElementById('locationSpan').innerHTML = '<i class="fas fa-check"></i>'
            document.getElementById('locationSpan').style.color = "green"
        }
        if(location.value == '' ){
            document.getElementById('locationSpan').innerHTML = '<i class="fas fa-times"></i>'
            document.getElementById('locationSpan').style.color = "red"
        }
        validateForm();

    })
    let mainimageCheck = false;
    let mainimage = document.getElementById('main-image');
    document.getElementById('mainimageSpan').innerHTML = '<i class="fas fa-times"></i>'
    document.getElementById('mainimageSpan').style.color = "red"
    mainimage.addEventListener('change', (e)=>{
        if(mainimage.files.length != 0){
            mainimageCheck = true
            document.getElementById('mainimageSpan').innerHTML = '<i class="fas fa-check"></i>'
            document.getElementById('mainimageSpan').style.color = "green"
        }else{
            mainimageCheck = false
            document.getElementById('mainimageSpan').innerHTML = '<i class="fas fa-times"></i>'
            document.getElementById('mainimageSpan').style.color = "red"
        }
        validateForm();

    })
    let datefromCheck = false;
    let datefrom = document.getElementById('date-from');

    document.getElementById('datefromSpan').innerHTML = '<i class="fas fa-times"></i>'
    document.getElementById('datefromSpan').style.color = "red"

    function fooDateFrom() {
        if(datefrom.value != ''){
            datefromCheck = true;
            document.getElementById('datefromSpan').innerHTML = '<i class="fas fa-check"></i>'
            document.getElementById('datefromSpan').style.color = "green"
            setTimeout(fooDateFrom, 2000);
        }else{
            datefromCheck = false;
            setTimeout(fooDateFrom, 2000);
        }
        validateForm();

    }
    fooDateFrom();
    let dateuntilCheck = false;
    let dateuntil = document.getElementById('date-until');
    document.getElementById('dateuntilSpan').innerHTML = '<i class="fas fa-times"></i>'
    document.getElementById('dateuntilSpan').style.color = "red"
    function fooDateUntil() {
        if(dateuntil.value != ''){
            dateuntilCheck = true;
            document.getElementById('dateuntilSpan').innerHTML = '<i class="fas fa-check"></i>'
            document.getElementById('dateuntilSpan').style.color = "green"
            setTimeout(fooDateUntil, 2000);
        }else{
            dateuntilCheck = false;
            setTimeout(fooDateUntil, 2000);
        }
        validateForm();

    }
    fooDateUntil();
    let timefromhourCheck = true;
    let timefromhour = document.getElementById('time-from-hour');
    let timefromminuteCheck = true;
    let timefromminute = document.getElementById('time-from-minute');
    let timeuntilhourCheck = true;
    let timeuntilhour = document.getElementById('time-until-hour');
    let timeuntilminuteCheck = true;
    let timeuntilminute = document.getElementById('time-until-minute');
    document.getElementById('timefromhourSpan').innerHTML = '<i class="fas fa-check"></i>'
    document.getElementById('timefromhourSpan').style.color = "green"
    document.getElementById('timeuntilhourSpan').innerHTML = '<i class="fas fa-check"></i>'
    document.getElementById('timeuntilhourSpan').style.color = "green"
}
//////EDIT/////
if(document.getElementById('event-edit-div')){
    function validateForm(){
        let button = document.querySelector('#submit')
        if(titleCheck && contentCheck && capacityCheck && locationCheck && mainimageCheck && datefromCheck && dateuntilCheck){
            button.disabled = false
            button.style.backgroundColor= ""
        }else{
            button.disabled = true
            button.style.backgroundColor= "grey"
        }
    }
    let title = document.getElementById('title');
    let titleCheck = true;
    document.getElementById('titleSpan').innerHTML = '<i class="fas fa-check"></i>'
    document.getElementById('titleSpan').style.color = "green"
    title.addEventListener('input', (e) =>{
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
    });
    let content = document.getElementById('inhoud');
    let contentCheck = true;
    function foo() {
        let contentLength = content.getAttribute('data-length');
        if(contentLength <= 49 ){
            contentCheck = false;
            document.getElementById('contentSpan').innerHTML = '<i class="fas fa-times"></i>'
            document.getElementById('contentSpan').style.color = "red"
            setTimeout(foo, 2000);
        }
        else if(contentLength > 49){
            contentCheck = true;
            document.getElementById('contentSpan').innerHTML = '<i class="fas fa-check"></i>'
            document.getElementById('contentSpan').style.color = "green"
            setTimeout(foo, 2000);
        }
        validateForm();
    }
    foo();
    let capacityCheck = true;
    let capacity = document.getElementById('capacity');
    document.getElementById('capacitySpan').innerHTML = '<i class="fas fa-check"></i>'
    document.getElementById('capacitySpan').style.color = "green"
    capacity.addEventListener('input', (e)=>{
        if(capacity.value != '' && capacity.value > 0){
            capacityCheck = true;
            document.getElementById('capacitySpan').innerHTML = '<i class="fas fa-check"></i>'
            document.getElementById('capacitySpan').style.color = "green"
        }
        if(capacity.value == '' || capacity.value <= 0){
            document.getElementById('capacitySpan').innerHTML = '<i class="fas fa-times"></i>'
            document.getElementById('capacitySpan').style.color = "red"
        }
        validateForm();
    })
    let locationCheck = true;
    let location = document.getElementById('location');
    document.getElementById('locationSpan').innerHTML = '<i class="fas fa-check"></i>'
    document.getElementById('locationSpan').style.color = "green"
    location.addEventListener('input', (e)=>{
        if(location.value != ''){
            locationCheck = true;
            document.getElementById('locationSpan').innerHTML = '<i class="fas fa-check"></i>'
            document.getElementById('locationSpan').style.color = "green"
        }
        if(location.value == '' ){
            document.getElementById('locationSpan').innerHTML = '<i class="fas fa-times"></i>'
            document.getElementById('locationSpan').style.color = "red"
        }
        validateForm();
    })
    let mainimageCheck = true;
    let mainimage = document.getElementById('main-image');
    document.getElementById('mainimageSpan').innerHTML = '<i class="fas fa-check"></i>'
    document.getElementById('mainimageSpan').style.color = "green"
    mainimage.addEventListener('change', (e)=>{
        if(mainimage.files.length != 0){
            mainimageCheck = true
            document.getElementById('mainimageSpan').innerHTML = '<i class="fas fa-check"></i>'
            document.getElementById('mainimageSpan').style.color = "green"
        }else{
            mainimageCheck = false
            document.getElementById('mainimageSpan').innerHTML = '<i class="fas fa-times"></i>'
            document.getElementById('mainimageSpan').style.color = "red"
        }
        validateForm();
    })
    let datefromCheck = true;
    let datefrom = document.getElementById('date-from');

    document.getElementById('datefromSpan').innerHTML = '<i class="fas fa-times"></i>'
    document.getElementById('datefromSpan').style.color = "red"

    function fooDateFrom() {
        if(datefrom.value != ''){
            datefromCheck = true;
            document.getElementById('datefromSpan').innerHTML = '<i class="fas fa-check"></i>'
            document.getElementById('datefromSpan').style.color = "green"
            setTimeout(fooDateFrom, 2000);
        }else{
            datefromCheck = false;
            setTimeout(fooDateFrom, 2000);
        }
        validateForm();
    }
    let dateuntilCheck = true;
    let dateuntil = document.getElementById('date-until');
    document.getElementById('dateuntilSpan').innerHTML = '<i class="fas fa-times"></i>'
    document.getElementById('dateuntilSpan').style.color = "red"
    function fooDateUntil() {
        if(dateuntil.value != ''){
            dateuntilCheck = true;
            document.getElementById('dateuntilSpan').innerHTML = '<i class="fas fa-check"></i>'
            document.getElementById('dateuntilSpan').style.color = "green"
            setTimeout(fooDateUntil, 2000);
        }else{
            dateuntilCheck = false;
            setTimeout(fooDateUntil, 2000);
        }
        validateForm();
    }
    fooDateFrom();
    fooDateUntil();
    document.getElementById('timefromhourSpan').innerHTML = '<i class="fas fa-check"></i>'
    document.getElementById('timefromhourSpan').style.color = "green"
    document.getElementById('timeuntilhourSpan').innerHTML = '<i class="fas fa-check"></i>'
    document.getElementById('timeuntilhourSpan').style.color = "green"
}