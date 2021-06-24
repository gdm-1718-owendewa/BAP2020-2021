if(document.getElementById('thread-create-div') != null){
    function validateForm(){
        if(questionCheck && infoCheck){
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

    let question = document.getElementById('question');
    let questionCheck = false;
    document.getElementById('questionSpan').innerHTML = '<i class="fas fa-times"></i>'
    document.getElementById('questionSpan').style.color = "red"
    question.addEventListener('input', (e) => {
        if(question.value.length > 0 && question.value.length < 200){
            questionCheck = true;
            document.getElementById('questionSpan').innerHTML = '<i class="fas fa-check"></i>'
            document.getElementById('questionSpan').style.color = "green"

        }else{
            questionCheck = false;
            document.getElementById('questionSpan').innerHTML = '<i class="fas fa-times"></i>'
            document.getElementById('questionSpan').style.color = "red"
        }
        validateForm();
    })

    let info = document.getElementById('info');
    let infoCheck = false;
    document.getElementById('infoSpan').innerHTML = '<i class="fas fa-times"></i>'
    document.getElementById('infoSpan').style.color = "red"

    function fooInfo() {
        let contentLength = info.getAttribute('data-length');
        if(contentLength <= 49 ){
            infoCheck = false;
            document.getElementById('infoSpan').innerHTML = '<i class="fas fa-times"></i>'
            document.getElementById('infoSpan').style.color = "red"
            setTimeout(fooInfo, 2000);
        }
        else if(contentLength > 49){
            infoCheck = true;
            document.getElementById('infoSpan').innerHTML = '<i class="fas fa-check"></i>'
            document.getElementById('infoSpan').style.color = "green"
            setTimeout(fooInfo, 2000);
        }
        validateForm();
    }
    fooInfo();
}
if(document.getElementById('thread-edit-div') != null){

    let button = document.querySelector('#submit')
    function validateForm(){
        if(questionCheck && infoCheck){
            button.disabled = false
            button.style.backgroundColor= ""
        }else{
            button.disabled = true
            button.style.backgroundColor= "grey"
        }
    }
    let question = document.getElementById('question');
    let questionCheck = false;
    if(question.value.length > 0 && question.value.length < 200){
        document.getElementById('questionSpan').innerHTML = '<i class="fas fa-check"></i>'
        document.getElementById('questionSpan').style.color = "green"
        questionCheck = true;
    }else{
        document.getElementById('questionSpan').innerHTML = '<i class="fas fa-times"></i>'
        document.getElementById('questionSpan').style.color = "red"
        questionCheck = false;

    }
    question.addEventListener('input', (e) => {
        if(question.value.length > 0 && question.value.length < 200){
            questionCheck = true;
            document.getElementById('questionSpan').innerHTML = '<i class="fas fa-check"></i>'
            document.getElementById('questionSpan').style.color = "green"

        }else{
            questionCheck = false;
            document.getElementById('questionSpan').innerHTML = '<i class="fas fa-times"></i>'
            document.getElementById('questionSpan').style.color = "red"
        }
        validateForm()

    })


    let info = document.getElementById('info');
    let infoCheck = false;
    function fooInfo() {
        let contentLength = info.getAttribute('data-length');
        if(contentLength <= 49 ){
            infoCheck = false;
            document.getElementById('infoSpan').innerHTML = '<i class="fas fa-times"></i>'
            document.getElementById('infoSpan').style.color = "red"
            setTimeout(fooInfo, 2000);
        }
        else if(contentLength > 49){
            infoCheck = true;
            document.getElementById('infoSpan').innerHTML = '<i class="fas fa-check"></i>'
            document.getElementById('infoSpan').style.color = "green"
            setTimeout(fooInfo, 2000);
        }
        validateForm()

    }
    fooInfo();
}
if(document.getElementById('detail-thread-container') !=null ){
    let comment = document.getElementById('comment');
    let commentCheck = false;
    let button = document.querySelector('#commentsubmit')
    button.disabled = true
    button.style.borderColor= "grey"
    button.style.color= "grey"
    document.getElementById('commentSpan').innerHTML = '<i class="fas fa-times"></i>'
    document.getElementById('commentSpan').style.color = "red"
    function foo() {
        let contentLength = comment.getAttribute('data-length');
        if(contentLength == null || contentLength <= 9){
            commentCheck = false;
            button.disabled = true
            button.style.borderColor= "grey"
            button.style.color= "grey"
            document.getElementById('commentSpan').innerHTML = '<i class="fas fa-times"></i>'
            document.getElementById('commentSpan').style.color = "red"
            setTimeout(foo, 2000);
        }
        else if(contentLength >= 10){
            commentCheck = true;
            button.disabled = false
            button.style.borderColor= "rgb(203, 0, 0) "
            button.style.color= "rgb(203, 0, 0) "
            document.getElementById('commentSpan').innerHTML = '<i class="fas fa-check"></i>'
            document.getElementById('commentSpan').style.color = "green"
            setTimeout(foo, 2000);
        }
     }
     foo();
}

if(document.getElementById('comment-edit-form') !=null ){
    let button = document.querySelector('#commenteditsubmit')
    let comment = document.getElementById('inhoud');
    let commentCheck = false;
    function foo() {
        let contentLength = comment.getAttribute('data-length');
        if(contentLength < 10){
            commentCheck = false;
            button.disabled = true
            button.style.borderColor= "grey"
            button.style.color= "grey"
            setTimeout(foo, 2000);
        }
        else if(contentLength >= 10){
            commentCheck = true;
            button.disabled = false
            button.style.borderColor= "rgb(203, 0, 0) "
            button.style.color= "rgb(203, 0, 0) "
            setTimeout(foo, 2000);
        }
     }
     foo();
   
}





