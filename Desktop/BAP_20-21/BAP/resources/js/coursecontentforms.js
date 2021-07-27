if(document.getElementById('course-content-create-div')){
    function validateForm(){
        if(supportingFilesCheck){
            button.disabled = false
            button.style.backgroundColor= ""
        }
        else if(titleCheck && contentCheck){
            button.disabled = false
            button.style.backgroundColor= ""
        }
        else{
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
        validateForm()
    })
    let inhoud = document.getElementById('inhoud');
    let contentCheck = false;
    document.getElementById('contentSpan').innerHTML = '<i class="fas fa-times"></i>'
    document.getElementById('contentSpan').style.color = "red"
    function foo() {
        let contentLength = inhoud.getAttribute('data-length');
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

    let supportingFiles = document.getElementById('supporting-files');
    let supportingFilesCheck = false;
    document.getElementById('fileSpan').innerHTML = '<i class="fas fa-times"></i>'
    document.getElementById('fileSpan').style.color = "red"
    supportingFiles.addEventListener('change', (e)=>{
        if(supportingFiles.files.length != 0){
        supportingFilesCheck = true
            document.getElementById('fileSpan').innerHTML = '<i class="fas fa-check"></i>'
            document.getElementById('fileSpan').style.color = "green"
        }else{
        supportingFilesCheck = false
            document.getElementById('fileSpan').innerHTML = '<i class="fas fa-times"></i>'
            document.getElementById('fileSpan').style.color = "red"
        }
        validateForm()
    })
}
if(document.getElementById('course-content-edit-div')){
    let button = document.querySelector('#submit')
    
    function validateForm(){
       if(titleCheck && contentCheck){
            button.disabled = false
            button.style.backgroundColor= ""
        }
        else{
            button.disabled = true
            button.style.backgroundColor= "grey"
        }
    }

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
        validateForm()
    })
    let inhoud = document.getElementById('inhoud');
    let contentCheck = true;
    document.getElementById('contentSpan').innerHTML = '<i class="fas fa-check"></i>'
    document.getElementById('contentSpan').style.color = "green"
    function foo() {
        let contentLength = inhoud.getAttribute('data-length');
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
}