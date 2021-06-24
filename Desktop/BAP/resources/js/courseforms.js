if(document.getElementById('course-create-div')){
    function validateForm(){
        if(titleCheck && infoCheck && inhoudCheck){
            button.disabled = false
            button.style.backgroundColor= ""
        }else{
            button.disabled = true
            button.style.backgroundColor= "grey"
        }
    }
    let button = document.querySelector('#submit')
    button.disabled = true
    button.style.backgroundColor= "grey"
    let title = document.getElementById('title');
    let titleCheck = false;
    document.getElementById('titleSpan').innerHTML = '<i class="fas fa-times"></i>'
    document.getElementById('titleSpan').style.color = "red"
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

    let info = document.getElementById('info');
    let infoCheck = false;
    document.getElementById('infoSpan').innerHTML = '<i class="fas fa-times"></i>'
    document.getElementById('infoSpan').style.color = "red"
    function fooInfo() {
        let contentLength = info.getAttribute('data-length');
        if(contentLength <= 99 ){
            infoCheck = false;
            document.getElementById('infoSpan').innerHTML = '<i class="fas fa-times"></i>'
            document.getElementById('infoSpan').style.color = "red"
            setTimeout(fooInfo, 2000);
        }
        else if(contentLength > 99){
            infoCheck = true;
            document.getElementById('infoSpan').innerHTML = '<i class="fas fa-check"></i>'
            document.getElementById('infoSpan').style.color = "green"
            setTimeout(fooInfo, 2000);
        }
        validateForm();
    }
    let inhoud = document.getElementById('inhoud');
    let inhoudCheck = false;
    document.getElementById('contentSpan').innerHTML = '<i class="fas fa-times"></i>'
    document.getElementById('contentSpan').style.color = "red"
    function fooContent() {
        let contentLength = inhoud.getAttribute('data-length');
        if(contentLength <= 99 ){
            inhoudCheck = false;
            document.getElementById('contentSpan').innerHTML = '<i class="fas fa-times"></i>'
            document.getElementById('contentSpan').style.color = "red"
            setTimeout(fooContent, 2000);
        }
        else if(contentLength > 99){
            inhoudCheck = true;
            document.getElementById('contentSpan').innerHTML = '<i class="fas fa-check"></i>'
            document.getElementById('contentSpan').style.color = "green"
            setTimeout(fooContent, 2000);
        }
        validateForm();

    }

    // let datefrom = document.getElementById('from');
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
    fooInfo();
    fooContent();
    // fooDateFrom();
    // fooDateUntil();
}
if(document.getElementById('course-edit-div')){
    function validateForm(){
        if(titleCheck && infoCheck && inhoudCheck){
            button.disabled = false
            button.style.backgroundColor= ""
        }else{
            button.disabled = true
            button.style.backgroundColor= "grey"
        }
    }
    let button = document.querySelector('#submit')
    let title = document.getElementById('title');
    let titleCheck = true;
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
    let info = document.getElementById('info');
    let infoCheck = true;
    document.getElementById('infoSpan').innerHTML = '<i class="fas fa-check"></i>'
    document.getElementById('infoSpan').style.color = "green"
    function fooInfo() {
        let contentLength = info.getAttribute('data-length');
        if(contentLength <= 99 ){
            infoCheck = false;
            document.getElementById('infoSpan').innerHTML = '<i class="fas fa-times"></i>'
            document.getElementById('infoSpan').style.color = "red"
            setTimeout(fooInfo, 2000);
        }
        else if(contentLength > 99){
            infoCheck = true;
            document.getElementById('infoSpan').innerHTML = '<i class="fas fa-check"></i>'
            document.getElementById('infoSpan').style.color = "green"
            setTimeout(fooInfo, 2000);
        }
        validateForm();
    }
    let inhoud = document.getElementById('inhoud');
    let inhoudCheck = true;
    document.getElementById('contentSpan').innerHTML = '<i class="fas fa-check"></i>'
    document.getElementById('contentSpan').style.color = "green"
    function fooContent() {
        let contentLength = inhoud.getAttribute('data-length');
        if(contentLength <= 99 ){
            inhoudCheck = false;
            document.getElementById('contentSpan').innerHTML = '<i class="fas fa-times"></i>'
            document.getElementById('contentSpan').style.color = "red"
            setTimeout(fooContent, 2000);
        }
        else if(contentLength > 99){
            inhoudCheck = true;
            document.getElementById('contentSpan').innerHTML = '<i class="fas fa-check"></i>'
            document.getElementById('contentSpan').style.color = "green"
            setTimeout(fooContent, 2000);
        }
        validateForm();

    }
    // let datefrom = document.getElementById('from');
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
    fooInfo();
    fooContent();
    // fooDateFrom();
    // fooDateUntil();
}